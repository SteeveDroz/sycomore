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

    public function findAll($orderBy = [])
    {
        foreach ($orderBy as $field => $direction) {
            $this->db->order_by($field, $direction);
        }
        $scores = $this->db->get(self::TABLE)->result_object();
        $this->loadAllAuthors($scores);
        return $scores;
    }

    public function find($id)
    {
        $scores = $this->db->get_where(self::TABLE, ['id' => $id])->result_object();
        $this->loadAllAuthors($scores);
        return $scores[0];
    }

    public function findBy($criterias, $orderBy)
    {
        $first = true;
        foreach($criterias as $criteria => $value)
        {
            if ($first)
            {
                $this->db->where($criteria, $value);
            }
            else {
                $this->db->and_where($criteria, $value);
            }
        }

        foreach ($orderBy as $field => $direction) {
            $this->db->order_by($field, $direction);
        }

        $scores = $this->db->get(self::TABLE)->result_object();
        $this->loadAllAuthors($scores);
        return $scores;
    }

    public function add($score)
    {
        $score->author = $score->author->id;
        $this->db->insert(self::TABLE, $score);
        return $this->db->insert_id();
    }

    private function loadAllAuthors($scores)
    {
        $this->load->model('author_model');
        array_walk($scores, function(&$score)
        {
            $score->author = $this->author_model->find($score->author);
        });
    }
}
