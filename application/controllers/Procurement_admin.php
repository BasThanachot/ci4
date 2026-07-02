<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement_admin extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Procurement_model');
    }

    /** หน้าแอดมินหลัก - แสดง tree จัดการทุกระดับในหน้าเดียว */
    public function manage()
    {
        $this->check_role('admin');

        $data                = $this->session_data();
        $data['page_title']  = 'เอกสารจัดซื้อ-จัดจ้าง';
        $data['active_menu'] = 'procurement';
        $data['content']     = $this->load->view('procurement/manage', $data, TRUE);
        $this->load->view('layout', $data);
    }

    /** คืนโครงสร้าง tree เป็น JSON ให้หน้าแอดมิน render ผ่าน JS */
    public function tree()
    {
        $this->check_role('admin');
        $tree = $this->Procurement_model->get_full_tree();
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['status' => 'ok', 'data' => $tree], JSON_UNESCAPED_UNICODE));
    }

    // ================= หมวดหมู่ =================

    public function category_save()
    {
        $this->check_role('admin');
        $id   = $this->input->post('id', TRUE);
        $data = [
            'name'       => $this->input->post('name', TRUE),
            'icon'       => $this->input->post('icon', TRUE) ?: 'ti-folder',
            'color'      => $this->input->post('color', TRUE) ?: '#EAF3DE',
            'icon_color' => $this->input->post('icon_color', TRUE) ?: '#3B6D11',
            'sort_order' => (int) $this->input->post('sort_order', TRUE),
        ];

        if (empty($data['name'])) {
            return $this->_json(['status' => 'error', 'message' => 'กรุณาระบุชื่อหมวดหมู่']);
        }

        $id = $this->Procurement_model->save_category($id, $data);
        $this->_json(['status' => 'ok', 'id' => $id]);
    }

    public function category_delete($id)
    {
        $this->check_role('admin');
        $this->Procurement_model->delete_category($id);
        $this->_json(['status' => 'ok']);
    }

    // ================= หัวข้อย่อยระดับ 1 =================

    public function sub1_save()
    {
        $this->check_role('admin');
        $id   = $this->input->post('id', TRUE);
        $data = [
            'category_id' => (int) $this->input->post('category_id', TRUE),
            'name'        => $this->input->post('name', TRUE),
            'sort_order'  => (int) $this->input->post('sort_order', TRUE),
        ];

        if (empty($data['name']) || empty($data['category_id'])) {
            return $this->_json(['status' => 'error', 'message' => 'ข้อมูลไม่ครบ']);
        }

        $id = $this->Procurement_model->save_sub1($id, $data);
        $this->_json(['status' => 'ok', 'id' => $id]);
    }

    public function sub1_delete($id)
    {
        $this->check_role('admin');
        $this->Procurement_model->delete_sub1($id);
        $this->_json(['status' => 'ok']);
    }

    // ================= หัวข้อย่อยระดับ 2 =================

    public function sub2_save()
    {
        $this->check_role('admin');
        $id   = $this->input->post('id', TRUE);
        $data = [
            'sub1_id'    => (int) $this->input->post('sub1_id', TRUE),
            'name'       => $this->input->post('name', TRUE),
            'sort_order' => (int) $this->input->post('sort_order', TRUE),
        ];

        if (empty($data['name']) || empty($data['sub1_id'])) {
            return $this->_json(['status' => 'error', 'message' => 'ข้อมูลไม่ครบ']);
        }

        $id = $this->Procurement_model->save_sub2($id, $data);
        $this->_json(['status' => 'ok', 'id' => $id]);
    }

    public function sub2_delete($id)
    {
        $this->check_role('admin');
        $this->Procurement_model->delete_sub2($id);
        $this->_json(['status' => 'ok']);
    }

    // ================= รายการเอกสาร - แก้ไขข้อความโดยตรง =================

    public function item_save()
    {
        $this->check_role('admin');
        $id   = $this->input->post('id', TRUE);
        $data = [
            'sub2_id'    => (int) $this->input->post('sub2_id', TRUE),
            'title'      => $this->input->post('title', TRUE),
            'content'    => $this->input->post('content', FALSE), // ข้อความที่พิมพ์/แก้ไข ไม่ต้อง strip แท็กเพราะเป็นข้อความล้วน
            'sort_order' => (int) $this->input->post('sort_order', TRUE),
            'updated_by' => $this->session->userdata('user_id'),
        ];

        if (empty($data['title']) || empty($data['sub2_id'])) {
            return $this->_json(['status' => 'error', 'message' => 'ข้อมูลไม่ครบ']);
        }

        $id = $this->Procurement_model->save_item($id, $data);
        $this->_json(['status' => 'ok', 'id' => $id]);
    }

    public function item_delete($id)
    {
        $this->check_role('admin');
        $this->Procurement_model->delete_item($id);
        $this->_json(['status' => 'ok']);
    }

    private function _json($payload)
    {
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($payload, JSON_UNESCAPED_UNICODE));
    }
}
