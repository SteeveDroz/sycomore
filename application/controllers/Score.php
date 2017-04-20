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

    public function add($authorId = null)
    {
        $this->load->model('author_model');

        $score = new stdClass();
        $score->name = trim($this->input->post('name'));
        $score->content = trim($this->input->post('content'));
        $score->author = new stdClass();
        $score->author->id = $this->input->post('author') ?? $authorId;

        $this->form_validation->set_rules('name', 'Nom', 'trim|required');
        $this->form_validation->set_rules('content', 'Texte', 'trim|required');
        $this->form_validation->set_rules('author', 'Auteur', 'required|integer');

        if ($this->form_validation->run())
        {
            $id = $this->score_model->add($score);
            redirect(['score', 'show', $id]);
        }

        $authors = $this->author_model->findAll(['name' => 'ASC']);
        $authorNames = [];
        foreach ($authors as $author)
        {
            $authorNames[xss_clean($author->id)] = xss_clean($author->name);
        }

        $this->load->view('templates/header', ['title' => 'Ajouter un accord']);
        $this->load->view('pages/score/add', ['score' => $score, 'authors' => $authorNames, 'fixedAuthor' => $authorId != null]);
        $this->load->view('templates/footer');
    }

    public function show($id)
    {
        $score = $this->score_model->find($id);
        $this->load->view('templates/header', ['title' => $score->name]);
        $this->load->view('pages/score/show', ['score' => $score]);
        $this->load->view('templates/footer');
    }
}
