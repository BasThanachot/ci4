<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement_admin extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Procurement_model');
        $this->load->model('Procurement_item_log_model');
    }

    /** หน้าแอดมินหลัก - แสดง tree จัดการทุกระดับในหน้าเดียว */
    public function manage()
    {
        $this->check_role('admin');

        $data                = $this->session_data();
        $data['page_title']  = 'จัดการเอกสารจัดซื้อ-จัดจ้าง';
        $data['active_menu'] = 'procurement_admin';
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

        $editor_id       = $this->session->userdata('user_id');
        $editor_username = $this->session->userdata('username');
        $old_item        = $id ? $this->Procurement_model->get_item($id) : null;

        if ($old_item) {
            $this->Procurement_item_log_model->log_changes($old_item, $old_item, $data, $editor_id, $editor_username);
        }

        $id = $this->Procurement_model->save_item($id, $data);

        if (!$old_item) {
            $this->Procurement_item_log_model->log_create($id, $data['title'], $editor_id, $editor_username);
        }

        $this->_json(['status' => 'ok', 'id' => $id]);
    }

    public function item_delete($id)
    {
        $this->check_role('admin');
        $item = $this->Procurement_model->get_item($id);
        if ($item) {
            $this->Procurement_item_log_model->log_delete(
                $item->id,
                $item->title,
                $this->session->userdata('user_id'),
                $this->session->userdata('username')
            );
        }
        $this->Procurement_model->delete_item($id);
        $this->_json(['status' => 'ok']);
    }

    /** ประวัติการแก้ไขของรายการเอกสารหนึ่งรายการ */
    public function item_history($id)
    {
        $this->check_role('admin');
        $item = $this->Procurement_model->get_item($id);
        if (!$item) { show_404(); return; }

        $data                = $this->session_data();
        $data['page_title']  = 'ประวัติการแก้ไข — ' . $item->title;
        $data['active_menu'] = 'procurement_admin';
        $data['item']        = $item;
        $data['logs']        = $this->Procurement_item_log_model->get_by_item($id);
        $data['log_model']   = $this->Procurement_item_log_model;
        $data['content']     = $this->load->view('procurement/item_history', $data, TRUE);
        $this->load->view('layout', $data);
    }

    private function _json($payload)
    {
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($payload, JSON_UNESCAPED_UNICODE));
    }
}
