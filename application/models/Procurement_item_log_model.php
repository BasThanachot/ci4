<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement_item_log_model extends CI_Model {

    private $field_labels = [
        'title'   => 'ชื่อรายการ',
        'content' => 'เนื้อหา',
        'created' => 'สร้างรายการ',
        'deleted' => 'ลบรายการ',
    ];

    public function log_changes($target_item, $old_data, $new_data, $editor_id, $editor_username)
    {
        $tracked = ['title', 'content'];

        foreach ($tracked as $field) {
            if (!isset($new_data[$field])) continue;

            $old_val = $old_data->$field ?? null;
            $new_val = $new_data[$field];

            if ($old_val !== $new_val) {
                $this->db->insert('procurement_item_logs', [
                    'item_id'             => $target_item->id,
                    'target_title'        => $target_item->title,
                    'changed_by_id'       => $editor_id,
                    'changed_by_username' => $editor_username,
                    'field'               => $field,
                    'old_value'           => $old_val,
                    'new_value'           => $new_val,
                ]);
            }
        }
    }

    public function log_create($item_id, $title, $editor_id, $editor_username)
    {
        $this->db->insert('procurement_item_logs', [
            'item_id'             => $item_id,
            'target_title'        => $title,
            'changed_by_id'       => $editor_id,
            'changed_by_username' => $editor_username,
            'field'               => 'created',
            'old_value'           => null,
            'new_value'           => $title,
        ]);
    }

    public function log_delete($item_id, $title, $editor_id, $editor_username)
    {
        $this->db->insert('procurement_item_logs', [
            'item_id'             => $item_id,
            'target_title'        => $title,
            'changed_by_id'       => $editor_id,
            'changed_by_username' => $editor_username,
            'field'               => 'deleted',
            'old_value'           => $title,
            'new_value'           => null,
        ]);
    }

    public function get_by_item($item_id, $limit = 100)
    {
        return $this->db
            ->where('item_id', $item_id)
            ->order_by('created_at', 'DESC')
            ->limit($limit)
            ->get('procurement_item_logs')
            ->result();
    }

    public function field_label($field)
    {
        return $this->field_labels[$field] ?? $field;
    }
}
