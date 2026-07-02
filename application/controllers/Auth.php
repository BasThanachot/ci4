<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function login()
    {
        if ($this->input->method() !== 'post') {
            redirect('/');
            return;
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $this->load->model('User_model');
        $user = $this->User_model->get_by_username($username);

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata([
                'user_id'    => $user->id,
                'username'   => $user->username,
                'name'       => $user->name,
                'role'       => $user->role,
                'logged_in'  => TRUE,
            ]);
            redirect('main_2026/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username หรือ Password ไม่ถูกต้อง');
            redirect('/');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }

    public function setup()
    {
        $this->load->model('User_model');
        if ($this->User_model->count_users() > 0) {
            show_error('Setup ทำไปแล้ว ไม่สามารถเรียกซ้ำได้', 403);
            return;
        }
        $this->db->insert('users', [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'name'     => 'Administrator',
        ]);
        echo 'สร้าง admin user สำเร็จ<br>Username: <b>admin</b> | Password: <b>admin123</b><br>';
        echo '<a href="' . base_url() . '">ไปที่หน้า Login</a>';
    }
}
