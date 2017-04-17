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
        $authors = $this->author_model->findAll(['name' => 'ASC']);

        $this->load->view('templates/header', ['title' => 'Liste des auteurs']);
        $this->load->view('pages/author/index', ['authors' => $authors]);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->load->library('form_validation');
        $name = trim($this->input->post('name'));

        $this->form_validation->set_rules('name', 'Nom', 'trim|required|is_unique[author.name]');

        if ($this->form_validation->run())
        {
            $author = new stdClass();
            $author->name = $name;
            $id = $this->author_model->add($author);
            redirect('author/show/' . $id);
        }

        $this->load->view('templates/header', ['title' => 'Ajouter un auteur']);
        $this->load->view('pages/author/add', ['name' => $name]);
        $this->load->view('templates/footer');
    }

    public function show($id)
    {
        $author = $this->author_model->find($id);
        $this->load->view('templates/header', ['title' => xss_clean($author->name)]);
        $this->load->view('pages/author/show', ['author' => $author]);
        $this->load->view('templates/footer');
    }
}
