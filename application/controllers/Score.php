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
            redirect(['score', 'show', xss_clean($id)]);
        }

        $authorNames = $this->author_model->getListForSelect();

        $this->load->view('templates/header', ['title' => 'Ajouter un accord']);
        $this->load->view('pages/score/add', ['score' => $score, 'authors' => $authorNames, 'fixedAuthor' => $authorId != null]);
        $this->load->view('templates/footer');
    }

    public function show($id)
    {
        $score = $this->score_model->find($id);

        $chords = $this->getChords($score->content);

        $score->content = $this->parse($score->content);

        $this->load->view('templates/header', ['title' => $score->name]);
        $this->load->view('pages/score/show', ['chords' => $chords, 'score' => $score]);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $this->load->model('author_model');

        $score = $this->score_model->find($id);
        $score->name = $this->input->post('name') ?? $score->name;
        $score->content = $this->input->post('content') ?? $score->content;
        $score->author->id = $this->input->post('author') ?? $score->author->id;

        $this->form_validation->set_rules('name', 'Nom', 'trim|required');
        $this->form_validation->set_rules('content', 'Texte', 'trim|required');
        $this->form_validation->set_rules('author', 'Auteur', 'required|integer');

        if ($this->form_validation->run())
        {
            $this->score_model->update($score);
            redirect(['score', 'show', xss_clean($score->id)]);
        }

        $authorNames = $this->author_model->getListForSelect();

        $this->load->view('templates/header', ['title' => $score->name]);
        $this->load->view('pages/score/edit', ['score' => $score, 'authors' => $authorNames]);
        $this->load->view('templates/footer');
    }

    private function getChords($content)
    {
        $this->load->model('chord_model');

        $chordNames = [];
        preg_match_all('/(?<=\[).*(?=\])/U', $content, $chordNames);
        $chordNames = array_unique($chordNames[0]);

        $chords = $this->chord_model->findArray('name', $chordNames);

        $chordList = [];
        foreach ($chordNames as $chordName)
        {
            foreach ($chords as $chord)
            {
                if ($chordName == $chord->name)
                {
                    $chordList[$chordName] = $chord;
                    break;
                }
            }
            if (!isset($chordList[$chordName]))
            {
                $chordList[$chordName] = (object)['id' => 0, 'name' => $chordName, 'fingers' => null];
            }
        }

        return $chordList;
    }

    private function parse($content)
    {
        return $content;
    }
}
