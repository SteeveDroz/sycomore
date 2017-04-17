<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author_model extends CI_Model
{
    const TABLE = 'author';

    public function __construct()
    {
        $this->load->database();
    }

    public function findAll()
    {
        return $this->db->get(self::TABLE)->result_object();
    }

    public function add($author)
    {
        $this->db->insert(self::TABLE, $author);
        return $this->db->insert_id();
    }
}
