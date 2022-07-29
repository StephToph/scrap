<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()	{
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$data['title'] = 'Dashboard | '.app_name;
		$data['page_active'] = 'dashboard';
		$this->load->view('designs/header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('designs/footer', $data);
		
	}
}
