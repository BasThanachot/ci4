<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement extends MY_Controller {

    public function index()
    {
        // ถ้าต้องการให้เฉพาะสมาชิกที่ login แล้วเท่านั้นดูได้ ให้เปิดบรรทัดนี้
        // $this->check_login();

        $this->load->view('procurement_view');
    }

    /**
     * คืนข้อมูลเป็น JSON ให้หน้า procurement_view.php ดึงไปแสดงผล
     * URL: procurement/data
     */
    public function data()
    {
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
}
