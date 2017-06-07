<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CSS extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->output->set_header('Content-type: text/css');
    }

    public function score()
    {
        $this->load->view('css/score.css');
    }
}
