<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chord extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('chord_model');
    }

    public function index()
    {
        $chords = $this->chord_model->findAll(['name' => 'ASC']);

        $this->load->view('templates/header', ['title' => 'Liste des accords']);
        $this->load->view('pages/chord/index', ['chords' => $chords]);
        $this->load->view('templates/footer');
    }

    public function add($name = null)
    {
        $chord = new stdClass();
        $chord->name = trim(urldecode($this->input->post('name') ?? $name));
        $chord->fingers = $this->input->post('fingers');

        $this->form_validation->set_rules('name', 'Nom', 'trim|required');
        $this->form_validation->set_rules('fingers', 'Doigts', 'trim|required|min_length[6]|max_length[6]');

        if ($this->form_validation->run())
        {
            $id = $this->chord_model->add($chord);
            redirect(['chord']);
        }

        $this->load->view('templates/header', ['title' => 'Nouvel accord']);
        $this->load->view('pages/chord/add', ['chord' => $chord, 'disabled' => $name != null]);
        $this->load->view('templates/footer');
    }

    public function show($id)
    {
        $chord = $this->chord_model->find($id);

        $this->load->view('templates/header', ['title' => $chord->name]);
        $this->load->view('pages/chord/show', ['chord' => $chord]);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $chord = $this->chord_model->find($id);
        $chord->name = trim($this->input->post('name') ?? $chord->name);
        $chord->fingers = trim($this->input->post('fingers') ?? $chord->fingers);

        $this->form_validation->set_rules('name', 'Nom', 'trim|required');
        $this->form_validation->set_rules('fingers', 'Doigts', 'trim|required|min_length[6]|max_length[6]');

        if ($this->form_validation->run())
        {
            $this->chord_model->update($chord);
            redirect(['chord', 'show', xss_clean($chord->id)]);
        }

        $this->load->view('templates/header', ['title' => $chord->name]);
        $this->load->view('pages/chord/edit', ['chord' => $chord]);
        $this->load->view('templates/footer');
    }

    public function draw($id)
    {
        $this->output->set_content_type('image/png');

        $chord = $this->chord_model->find($id);

        $image = imagecreate(80, 90);

        if ($chord != null) {
          $transparent = imagecolorallocate($image, 127, 127, 127);
          $black = imagecolorallocate($image, 0, 0, 0);

          imagestring($image, 5, 15, 5, utf8_decode($chord->name), $black);

          for ($i = 0; $i < 6; $i++) {
            imageline($image, 10 * $i + 25, 40, 10 * $i + 25, 80, $black);
          }

          for ($i = 0; $i < 5; $i++) {
            imageline($image, 25, 10 * $i + 40, 75, 10 * $i + 40, $black);
          }

          $min = 99;
          $hasEmpty = false;
          foreach (str_split($chord->fingers) as $finger) {
            if ($finger == 0) {
              $hasEmpty = true;
            }
            if (strtoupper($finger) != 'X') {
              $min = min($min, $finger);
            }
          }

          if ($min < 2) {
            $min = 1;
          }
          else {
            imagestring($image, 3, 10, 38, $min, $black);
          }

          for ($i = 0; $i < strlen($chord->fingers); $i++) {
            $finger = substr($chord->fingers, $i, 1);
            if (strtoupper($finger) == 'X') {
              imagestring($image, 3, 10 * $i + 22, 25, 'x', $black);
            }
            elseif ($finger == 0) {
              imagestring($image, 3, 10 * $i + 22, 25, 'o', $black);
            }
            else {
              imagefilledellipse($image, 10 * $i + 25, 10 * ($finger - $min + 1) + 35, 6, 6, $black);
            }
          }
          if (!$hasEmpty) {
            imagefilledrectangle($image, 25, 42, 75, 48, $black);
            imagefilledellipse($image, 25, 45, 6, 6, $black);
            imagefilledellipse($image, 75, 45, 6, 6, $black);
          }

          imagecolortransparent($image, $transparent);
        }
        else {
          $background = imagecolorallocate($image, 255, 0, 0);
          $color = imagecolorallocate($image, 255, 255, 255);
          imagestring($image, 5, 15, 5, utf8_decode($id), $color);
        }

        imagepng($image);
        imagedestroy($image);
    }
}
?>
