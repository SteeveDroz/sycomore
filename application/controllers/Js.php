<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Js extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->output->set_header('Content-type: text/javascript');
    }

    public function jquery()
    {
        $this->load->view('js/jquery-3.2.1.min.js');
    }

    public function author()
    {
        $this->load->view('js/author.js');
    }
}
