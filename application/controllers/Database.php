<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Database extends CI_Controller
{
    public function init()
    {
        $this->load->dbforge();
        $this->dbforge->create_database('sycomore');

        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'name' => [
                'type' => 'TEXT',
                'unique' => true
            ]
        ]);
        $this->dbforge->create_table('author', true);

        
    }
}
