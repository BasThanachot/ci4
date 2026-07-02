<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_2026 extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect('main_2026/dashboard');
			return;
		}
		$data['error']   = $this->session->flashdata('error');
		$data['success'] = $this->session->flashdata('success');
		$this->load->view('main_2026', $data);
	}

	public function dashboard()
	{
		$this->check_login();
		$data                = $this->session_data();
		$data['page_title']  = 'หน้าหลัก';
		$data['active_menu'] = 'dashboard';
		$data['content']     = $this->load->view('dashboard_content', $data, TRUE);
		$this->load->view('layout', $data);
	}

}
