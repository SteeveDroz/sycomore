<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Score extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('score_model');
    }

    public function index()
    {
        $scores = $this->score_model->findAll(['name' => 'ASC']);

        $this->load->view('templates/header', ['title' => 'Liste des accords']);
        $this->load->view('pages/score/index', ['scores' => $scores]);
        $this->load->view('templates/footer');
    }
}
