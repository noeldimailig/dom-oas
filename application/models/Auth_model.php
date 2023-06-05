<?php

class Auth_model extends CI_Model
{
    public function is_user_verified($email)
    {
        $conditions = [
            'email' => $email,
            'is_verified' => 1
        ];

        return $this->db->get_where('user', $conditions)->row();
    }

    public function get_all()
    {
        return $this->db->get('user')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('user', array('user_id' => $id))->row();
    }

    public function get($condition)
    {
        return $this->db->get_where('user', $condition)->row();
    }

    public function insert($data)
    {
        return $this->db->insert('user', $data);
    }

    public function update($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->update('user', $data);
    }

    public function update_pass($data)
    {
        $this->db->where('token', $data['token']);
        $data['token'] = $data['new_token'];
        unset($data['new_token']);
        return $this->db->update('user', $data);
    }

    public function delete($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->delete('user');
    }
}
