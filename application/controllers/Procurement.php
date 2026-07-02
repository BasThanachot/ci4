<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement extends MY_Controller {

    public function index()
    {
        $this->check_login();

        $this->load->view('procurement_view');
    }

    /**
     * คืนข้อมูลเป็น JSON ให้หน้า procurement_view.php ดึงไปแสดงผล
     * URL: procurement/data
     */
    public function data()
    {
        $this->check_login();

        $this->load->model('Procurement_model');
        $tree = $this->Procurement_model->get_full_tree();

        $out = [];
        foreach ($tree as $cat) {
            $subsOut = [];
            foreach ($cat->sub1 as $s1) {
                $sub2Out = [];
                foreach ($s1->sub2 as $s2) {
                    $sub2Out[$s2->name] = array_map(function ($item) {
                        return [
                            'id'         => $item->id,
                            'title'      => $item->title,
                            'content'    => $item->content,
                            'updated_at' => $item->updated_at,
                        ];
                    }, $s2->items);
                }
                $subsOut[$s1->name] = $sub2Out;
            }
            $out[$cat->name] = [
                'color'     => $cat->color,
                'icon'      => $cat->icon,
                'iconColor' => $cat->icon_color,
                'subs'      => $subsOut,
            ];
        }

        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode($out, JSON_UNESCAPED_UNICODE));
    }

    /**
     * ดาวน์โหลดรายการเอกสารเป็นไฟล์ Word (.docx)
     * URL: procurement/download/<item_id>
     */
    public function download($id)
    {
        $this->check_login();

        $this->load->model('Procurement_model');
        $item = $this->Procurement_model->get_item($id);
        if (!$item) { show_404(); return; }

        require_once APPPATH . 'libraries/Simple_docx.php';
        $bytes = Simple_docx::build($item->title, $item->content);

        $filename     = $this->_safe_filename($item->title) . '.docx';
        $filenameUtf8 = rawurlencode($filename);

        $this->output
             ->set_content_type('application/vnd.openxmlformats-officedocument.wordprocessingml.document')
             ->set_header('Content-Disposition: attachment; filename="' . $filename . '"; filename*=UTF-8\'\'' . $filenameUtf8)
             ->set_header('Content-Length: ' . strlen($bytes))
             ->set_output($bytes);
    }

    private function _safe_filename($title)
    {
        $name = preg_replace('/[\\\\\/:*?"<>|]/', '_', (string) $title);
        $name = trim($name);
        return $name !== '' ? $name : 'document';
    }
}
