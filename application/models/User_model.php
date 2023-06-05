<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function user_details($user_id)
    {
        return $this->db->get_where('user', ['user_id' => $user_id])->row_array();
    }

    public function update_info($data)
    {
        if (array_key_exists('work_info', $data)) {
            if ($data['work_info']['appointment_id'] != NULL) {

                $this->db->where('user_id', $data['user_info']['user_id']);
                $this->db->update('user', $data['user_info']);

                $this->db->where('appointment_id', $data['work_info']['appointment_id']);
                return $this->db->update('appointment_details', $data['work_info']);
            }
        }

        $this->db->where('user_id', $data['user_info']['user_id']);
        return $this->db->update('user', $data['user_info']);
    }
}
