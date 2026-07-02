<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function get_by_username($username)
    {
        return $this->db->get_where('users', ['username' => $username])->row();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function get_all()
    {
        return $this->db->order_by('id', 'ASC')->get('users')->result();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id)->update('users', $data);
    }

    public function count_users()
    {
        return $this->db->count_all('users');
    }
}
