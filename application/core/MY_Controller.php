<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $role_levels = ['user' => 1, 'admin' => 2, 'program' => 3];

    protected function check_login()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('/');
        }
    }

    protected function check_role($min_role)
    {
        $this->check_login();
        $user_level     = $this->role_levels[$this->session->userdata('role')] ?? 1;
        $required_level = $this->role_levels[$min_role] ?? 1;
        if ($user_level < $required_level) {
            show_error('คุณไม่มีสิทธิ์เข้าถึงหน้านี้', 403);
        }
    }

    protected function role_level()
    {
        return $this->role_levels[$this->session->userdata('role')] ?? 1;
    }

    protected function session_data()
    {
        return [
            'username'        => $this->session->userdata('username'),
            'name'            => $this->session->userdata('name'),
            'role'            => $this->session->userdata('role'),
            'role_level'      => $this->role_level(),
            'current_user_id' => $this->session->userdata('user_id'),
        ];
    }
}
