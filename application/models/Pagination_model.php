<?php

class Pagination_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    // Get total record
    public function allrecord($table)
    {
        return $this->db->get($table)->num_rows();
    }

    // fetch record list with search offset
    public function get_usov_data_list($limit, $offset, $search)
    {
        if (!empty($search)) {
            $this->db->like('usov', $search);
        }

        $this->db->select('*');
        $this->db->from('usov');
        $this->db->order_by('usov_id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    /*  function getusers()
    {
        $query = $this->db->get('users');
        return $query->result_array();
    } */

    function get_usovs($perPage, $start_index, $search_text = null, $is_count = 0)
    {
        if ($perPage != '' && $start_index != '') {
            $this->db->limit($perPage, $start_index);
        }

        if ($search_text != NULL) {
            $this->db->like('usov', $search_text, 'both');
        }

        if ($is_count == 1) {
            $query = $this->db->get('usov');
            return $query->num_rows();
        } else {
            $query = $this->db->get('usov');
            return $query->result_array();
        }
    }
}
