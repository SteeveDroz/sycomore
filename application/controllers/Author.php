<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('author_model');
    }

    public function index()
    {
        $authors = $this->author_model->findAll();

        $this->load->view('templates/header', ['title' => 'Liste des auteurs']);
        $this->load->view('pages/author/index', ['authors' => $authors]);
        $this->load->view('templates/footer');
    }

}
