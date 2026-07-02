<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement_model extends CI_Model {

    // ================= อ่านข้อมูล =================

    public function get_categories()
    {
        return $this->db->order_by('sort_order', 'ASC')->order_by('id', 'ASC')
                         ->get('procurement_categories')->result();
    }

    public function get_category($id)
    {
        return $this->db->get_where('procurement_categories', ['id' => $id])->row();
    }

    public function get_sub1($category_id)
    {
        return $this->db->where('category_id', $category_id)
                         ->order_by('sort_order', 'ASC')->order_by('id', 'ASC')
                         ->get('procurement_sub1')->result();
    }

    public function get_sub2($sub1_id)
    {
        return $this->db->where('sub1_id', $sub1_id)
                         ->order_by('sort_order', 'ASC')->order_by('id', 'ASC')
                         ->get('procurement_sub2')->result();
    }

    public function get_items($sub2_id)
    {
        return $this->db->where('sub2_id', $sub2_id)
                         ->order_by('sort_order', 'ASC')->order_by('id', 'ASC')
                         ->get('procurement_items')->result();
    }

    /**
     * คืนโครงสร้างข้อมูลทั้งหมดแบบ nested array
     * ใช้ทั้งฝั่ง public (แสดงผล) และฝั่งแอดมิน (จัดการ)
     */
    public function get_full_tree()
    {
        $tree = [];
        foreach ($this->get_categories() as $cat) {
            $cat->sub1 = [];
            foreach ($this->get_sub1($cat->id) as $s1) {
                $s1->sub2 = [];
                foreach ($this->get_sub2($s1->id) as $s2) {
                    $s2->items = $this->get_items($s2->id);
                    $s1->sub2[] = $s2;
                }
                $cat->sub1[] = $s1;
            }
            $tree[] = $cat;
        }
        return $tree;
    }

    // ================= หมวดหมู่ =================

    public function save_category($id, $data)
    {
        if ($id) {
            $this->db->where('id', $id)->update('procurement_categories', $data);
            return $id;
        }
        $this->db->insert('procurement_categories', $data);
        return $this->db->insert_id();
    }

    public function delete_category($id)
    {
        foreach ($this->get_sub1($id) as $s1) {
            $this->delete_sub1($s1->id);
        }
        $this->db->delete('procurement_categories', ['id' => $id]);
    }

    // ================= หัวข้อย่อยระดับ 1 =================

    public function save_sub1($id, $data)
    {
        if ($id) {
            $this->db->where('id', $id)->update('procurement_sub1', $data);
            return $id;
        }
        $this->db->insert('procurement_sub1', $data);
        return $this->db->insert_id();
    }

    public function delete_sub1($id)
    {
        foreach ($this->get_sub2($id) as $s2) {
            $this->delete_sub2($s2->id);
        }
        $this->db->delete('procurement_sub1', ['id' => $id]);
    }

    // ================= หัวข้อย่อยระดับ 2 =================

    public function save_sub2($id, $data)
    {
        if ($id) {
            $this->db->where('id', $id)->update('procurement_sub2', $data);
            return $id;
        }
        $this->db->insert('procurement_sub2', $data);
        return $this->db->insert_id();
    }

    public function delete_sub2($id)
    {
        $this->db->delete('procurement_items', ['sub2_id' => $id]);
        $this->db->delete('procurement_sub2', ['id' => $id]);
    }

    // ================= รายการเอกสาร (ข้อความ) =================

    public function save_item($id, $data)
    {
        if ($id) {
            $this->db->where('id', $id)->update('procurement_items', $data);
            return $id;
        }
        $this->db->insert('procurement_items', $data);
        return $this->db->insert_id();
    }

    public function delete_item($id)
    {
        $this->db->delete('procurement_items', ['id' => $id]);
    }

    public function get_item($id)
    {
        return $this->db->get_where('procurement_items', ['id' => $id])->row();
    }
}
