<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chord_model extends CI_Model
{
    const TABLE = 'chord';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function findAll($orderBy)
    {
        foreach ($orderBy as $field => $direction) {
            $this->db->order_by($field, $direction);
        }
        return $this->db->get(self::TABLE)->result_object();
    }

    public function find($id)
    {
        return $this->db->get_where(self::TABLE, ['id' => $id])->result_object()[0];
    }

    public function add($chord)
    {
        $this->db->insert(self::TABLE, $chord);
        return $this->db->insert_id();
    }
}
