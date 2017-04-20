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
}
?>
