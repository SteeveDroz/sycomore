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
        foreach ($orderBy as $field => $direction)
        {
            $this->db->order_by($field, $direction);
        }
        return $this->db->get(self::TABLE)->result_object();
    }

    public function find($id)
    {
        $chords = $this->db->get_where(self::TABLE, ['id' => $id])->result_object();
        return $chords[0] ?? null;
    }

    public function findArray($field, $criterias)
    {
        $first = true;
        foreach ($criterias as $criteria)
        {
            if ($first)
            {
                $this->db->where($field, $criteria);
                $first = false;
            }
            else
            {
                $this->db->or_where($field, $criteria);
            }
        }
        return $this->db->get(self::TABLE)->result_object();
    }

    public function add($chord)
    {
        $slug = slugify($chord->name);
        $this->db->insert(self::TABLE, $chord);
        return $this->db->insert_id();
    }

    public function update($chord)
    {
        $this->db->where(['id' => $chord->id]);
        $this->db->update(self::TABLE, $chord);
    }
}
