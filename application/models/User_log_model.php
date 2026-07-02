<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_log_model extends CI_Model {

    private $field_labels = [
        'name'     => 'ชื่อ',
        'role'     => 'Role',
        'password' => 'Password',
    ];

    private $role_labels = [
        'user'    => 'User',
        'admin'   => 'Admin',
        'program' => 'Programmer',
    ];

    public function log_changes($target_user, $old_data, $new_data, $editor_id, $editor_username)
    {
        $tracked = ['name', 'role', 'password'];

        foreach ($tracked as $field) {
            if (!isset($new_data[$field])) continue;

            if ($field === 'password') {
                $this->db->insert('user_logs', [
                    'user_id'             => $target_user->id,
                    'target_username'     => $target_user->username,
                    'changed_by_id'       => $editor_id,
                    'changed_by_username' => $editor_username,
                    'field'               => $field,
                    'old_value'           => '(รหัสผ่านเดิม)',
                    'new_value'           => '(รหัสผ่านใหม่)',
                ]);
                continue;
            }

            $old_val = $old_data->$field ?? null;
            $new_val = $new_data[$field];

            if ($old_val !== $new_val) {
                $this->db->insert('user_logs', [
                    'user_id'             => $target_user->id,
                    'target_username'     => $target_user->username,
                    'changed_by_id'       => $editor_id,
                    'changed_by_username' => $editor_username,
                    'field'               => $field,
                    'old_value'           => $old_val,
                    'new_value'           => $new_val,
                ]);
            }
        }
    }

    public function get_by_user($user_id, $limit = 50)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->order_by('created_at', 'DESC')
            ->limit($limit)
            ->get('user_logs')
            ->result();
    }

    public function get_all($limit = 100)
    {
        return $this->db
            ->order_by('created_at', 'DESC')
            ->limit($limit)
            ->get('user_logs')
            ->result();
    }

    public function field_label($field)
    {
        return $this->field_labels[$field] ?? $field;
    }

    public function display_value($field, $value)
    {
        if ($field === 'role') {
            return $this->role_labels[$value] ?? $value;
        }
        return $value;
    }
}
