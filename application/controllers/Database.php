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
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true
            ]
        ]);
        $this->dbforge->create_table('author', true);

        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true
            ],
            'fingers' => [
                'type' => 'VARCHAR',
                'constraint' => 6
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'unique' => true
            ]
        ]);
        $this->dbforge->create_table('chord', true);

        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'name' => [
                'type' => 'TEXT',
            ],
            'content' => [
                'type' => 'TEXT'
            ],
            'author' => [
                'type' => 'INTEGER'
            ]
        ]);
        $this->dbforge->create_table('score', true);
    }
}
