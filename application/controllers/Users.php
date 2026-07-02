<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    public function form()
    {
        if ($this->input->method() === 'post') {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            $confirm  = $this->input->post('confirm_password', TRUE);
            $name     = $this->input->post('name', TRUE);

            if (empty($username) || empty($password) || empty($confirm)) {
                $data['error'] = 'กรุณากรอกข้อมูลให้ครบทุกช่อง';
                return $this->load->view('register_view', $data);
            }
            if ($password !== $confirm) {
                $data['error'] = 'Password ไม่ตรงกัน';
                return $this->load->view('register_view', $data);
            }
            if (strlen($password) < 6) {
                $data['error'] = 'Password ต้องมีอย่างน้อย 6 ตัวอักษร';
                return $this->load->view('register_view', $data);
            }

            $this->load->model('User_model');
            if ($this->User_model->get_by_username($username)) {
                $data['error'] = 'Username นี้ถูกใช้ไปแล้ว';
                return $this->load->view('register_view', $data);
            }

            $this->db->insert('users', [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'name'     => $name,
                'role'     => 'user',
            ]);
            $this->session->set_flashdata('success', 'ลงทะเบียนสำเร็จ กรุณา Login');
            redirect('/');
        } else {
            $data['error'] = $this->session->flashdata('error');
            $this->load->view('register_view', $data);
        }
    }

    public function manage()
    {
        $this->check_role('admin');
        $this->load->model('User_model');

        $data                  = $this->session_data();
        $data['page_title']    = 'จัดการผู้ใช้';
        $data['active_menu']   = 'users';
        $data['users']         = $this->User_model->get_all();
        $data['flash_success'] = $this->session->flashdata('success');
        $data['flash_error']   = $this->session->flashdata('error');
        $data['content']       = $this->load->view('users/manage', $data, TRUE);
        $this->load->view('layout', $data);
    }

    public function edit($id = 0)
    {
        $this->check_role('admin');
        $this->load->model('User_model');
        $this->load->model('User_log_model');

        $user = $this->User_model->get_by_id($id);
        if (!$user) { show_404(); return; }

        if ($this->input->method() === 'post') {
            $name     = $this->input->post('name', TRUE);
            $role     = $this->input->post('role', TRUE);
            $password = $this->input->post('password', TRUE);
            $confirm  = $this->input->post('confirm_password', TRUE);

            $allowed_roles = ['user', 'admin', 'program'];
            if (!in_array($role, $allowed_roles)) $role = 'user';
            if ($this->role_level() < 3 && $role === 'program') $role = 'admin';

            $update = ['name' => $name, 'role' => $role];

            if (!empty($password)) {
                if ($password !== $confirm) {
                    return $this->_show_edit($user, 'Password ไม่ตรงกัน');
                }
                if (strlen($password) < 6) {
                    return $this->_show_edit($user, 'Password ต้องมีอย่างน้อย 6 ตัวอักษร');
                }
                $update['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $this->User_log_model->log_changes(
                $user,
                $user,
                $update,
                $this->session->userdata('user_id'),
                $this->session->userdata('username')
            );

            $this->User_model->update_user($id, $update);
            $this->session->set_flashdata('success', 'แก้ไขข้อมูล "' . $user->username . '" สำเร็จ');
            redirect('users/manage');
            return;
        }

        $this->_show_edit($user);
    }

    public function history($id = 0)
    {
        $this->check_role('admin');
        $this->load->model('User_model');
        $this->load->model('User_log_model');

        $user = $this->User_model->get_by_id($id);
        if (!$user) { show_404(); return; }

        $data                = $this->session_data();
        $data['page_title']  = 'ประวัติการแก้ไข — ' . $user->username;
        $data['active_menu'] = 'users';
        $data['user']        = $user;
        $data['logs']        = $this->User_log_model->get_by_user($id);
        $data['log_model']   = $this->User_log_model;
        $data['content']     = $this->load->view('users/history', $data, TRUE);
        $this->load->view('layout', $data);
    }

    public function delete($id = 0)
    {
        $this->check_role('admin');

        if ($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'ไม่สามารถลบบัญชีของตัวเองได้');
            redirect('users/manage');
            return;
        }

        $this->load->model('User_model');
        $user = $this->User_model->get_by_id($id);
        if (!$user) { show_404(); return; }

        $this->db->delete('users', ['id' => $id]);
        $this->session->set_flashdata('success', 'ลบผู้ใช้ "' . $user->username . '" สำเร็จ');
        redirect('users/manage');
    }

    private function _show_edit($user, $error = '')
    {
        $data                = $this->session_data();
        $data['page_title']  = 'แก้ไขผู้ใช้';
        $data['active_menu'] = 'users';
        $data['user']        = $user;
        $data['error']       = $error;
        $data['content']     = $this->load->view('users/edit', $data, TRUE);
        $this->load->view('layout', $data);
    }
}
