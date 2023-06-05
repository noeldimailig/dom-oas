<?php

class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function count_booked()
    {
        return $this->db->get_where('appointment_details', ['status' => 'booked'])->num_rows();
    }

    public function count_cancelled()
    {
        return $this->db->get_where('appointment_details', ['status' => 'cancelled'])->num_rows();
    }
}
