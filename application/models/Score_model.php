<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Score_model extends CI_Model
{
    const TABLE = 'score';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function findAll($order_by = [])
    {
        foreach ($order_by as $field => $direction) {
            $this->db->order_by($field, $direction);
        }
        return $this->db->get(self::TABLE)->result_object();
    }

    public function add($score)
    {
        $this->db->insert(self::TABLE, $score);
        return $this->db->insert_id();
    }
}
