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

    public function add()
    {
        $chord = new stdClass();
        $chord->name = trim($this->input->post('name'));
        $chord->fingers = $this->input->post('fingers');

        $this->form_validation->set_rules('name', 'Nom', 'trim|required');
        $this->form_validation->set_rules('fingers', 'Doigts', 'trim|required|min_length[6]|max_length[6]');

        if ($this->form_validation->run())
        {
            $id = $this->chord_model->add($chord);
            redirect(['chord']);
        }

        $this->load->view('templates/header', ['title' => 'Nouvel accord']);
        $this->load->view('pages/chord/add', ['chord' => $chord]);
        $this->load->view('templates/footer');
    }
}
?>
