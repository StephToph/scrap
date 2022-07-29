<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function index()	{
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$data['title'] = 'Report | '.app_name;
		$data['page_active'] = 'report';
		$this->load->view('designs/header', $data);
		$this->load->view('report/view', $data);
		//$this->load->view('designs/footer', $data);
		
	}

	public function date($param1='', $param2=''){
		if (empty($param1 or $param2)) {
			echo $this->Crud->msg('warning', 'Please Enter Date to and Date From to Generate Report');
		} else {
			if (!empty($param1) and empty($param2)) {
				echo $this->Crud->msg('warning', 'Please Enter Date To!');
			} elseif (!empty($param2) and empty($param1)) {
				echo $this->Crud->msg('warning', 'Please Enter Date From!');
			} else{
				if ($param2 > $param1) {
					echo $this->Crud->msg('warning', 'Date To cannot be greater than Date From!.<br>Please Check the Details you entered.');
				} else {
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('report/get_report/date_report/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='ADD' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY DATES</span></a>";
					$info = "<a class='btn btn-primary btn-anim btn-block' href='".base_url('report/get_report/summary_report/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='ADD' target='_blank' rel='noopener noreferrer'><i class='icon-magnifier'></i><span class='btn-text'>CLICK TO VIEW SUMMARY REPORT</span></a>";
					echo $success."<br>";
					echo $info;
				}
			}
		}
	}

	public function customer($param1='', $param2='', $param3=''){
		if (empty($param1)) {
			echo $this->Crud->msg('warning', 'Please Select Customer Name to Generate Report');
		} elseif (empty($param2 or $param3)) {
			echo $this->Crud->msg('warning', 'Please Enter Date To and Date From to Generate Report');
		} else {
			if (!empty($param2) and empty($param3)) {
				echo $this->Crud->msg('warning', 'Please Enter Date To!');
			} elseif (!empty($param3) and empty($param2)) {
				echo $this->Crud->msg('warning', 'Please Enter Date From!');
			} else{
				if ($param2 > $param3) {
					echo $this->Crud->msg('warning', 'Date To cannot be greater than Date From!.<br>Please Check the Details you entered.');
				} else {
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('report/get_report/customer_report/'.$param3.'/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='ADD' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY CUSTOMER</span></a>";
					echo $success;
				}
			}
		}
	}

	public function register($param1='', $param2='', $param3=''){
		if (empty($param1)) {
			echo $this->Crud->msg('warning', 'Please Select Register to Generate Report');
		} elseif (empty($param2 or $param3)) {
			echo $this->Crud->msg('warning', 'Please Enter Date To and Date From to Generate Report');
		} else {
			if (!empty($param2) and empty($param3)) {
				echo $this->Crud->msg('warning', 'Please Enter Date To!');
			} elseif (!empty($param3) and empty($param2)) {
				echo $this->Crud->msg('warning', 'Please Enter Date From!');
			} else{
				if ($param2 > $param3) {
					echo $this->Crud->msg('warning', 'Date To cannot be greater than Date From!.<br>Please Check the Details you entered.');
				} else {
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('report/get_report/register_report/'.$param3.'/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='ADD' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY REGISTER</span></a>";
					echo $success;
				}
			}
		}
	}

	public function supplied($param1='', $param2='', $param3=''){
		if (empty($param1)) {
			echo $this->Crud->msg('warning', 'Please Select Company to Generate Report');
		} elseif (empty($param2 or $param3)) {
			echo $this->Crud->msg('warning', 'Please Enter Date To and Date From to Generate Report');
		} else {
			if (!empty($param2) and empty($param3)) {
				echo $this->Crud->msg('warning', 'Please Enter Date To!');
			} elseif (!empty($param3) and empty($param2)) {
				echo $this->Crud->msg('warning', 'Please Enter Date From!');
			} else{
				if ($param2 > $param3) {
					echo $this->Crud->msg('warning', 'Date To cannot be greater than Date From!.<br>Please Check the Details you entered.');
				} else {
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('report/get_report/company_report/'.$param3.'/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='ADD' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY COMPANY</span></a>";
					echo $success;
				}
			}
		}
	}


	public function dpo($param1='', $param2=''){
		if (empty($param1 or $param2)) {
			echo $this->Crud->msg('warning', 'Please Enter Date To and Date From to Generate Report');
		} else {
			if (!empty($param1) and empty($param2)) {
				echo $this->Crud->msg('warning', 'Please Enter Date To!');
			} elseif (!empty($param2) and empty($param1)) {
				echo $this->Crud->msg('warning', 'Please Enter Date From!');
			} else{
				if ($param1 > $param2) {
					echo $this->Crud->msg('warning', 'Date To cannot be greater than Date From!.<br>Please Check the Details you entered.');
				} else {
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('report/get_report/dpo_report/'.$param1.'/'.$param2.'')."' data-toggle='tooltip' title='ADD' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY PDO</span></a>";
					echo $success;
				}
			}
		}
	}

	public function get_report($param1='', $param2='', $param3='', $param4=''){
		$data['report_type'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$data['param4'] = $param4;

		if ($param1 == 'date_report') {
			$data['title'] = 'Scrap Report by Dates { '.$param2.' to '.$param3.' }';
		} elseif ($param1 == 'summary_report') {
			$data['title'] = 'Scrap Summary Report by Dates { '.$param2.' to '.$param3.' } ';
		} elseif ($param1 == 'customer_report') {
			$data['title'] = 'Scrap Report by Customer: '.strtoupper($this->Crud->read_field('customer_id', $param4, 'customer', 'surname').' '.$this->Crud->read_field('customer_id', $param4, 'customer', 'firstname')).'  ';
		} elseif ($param1 == 'register_report') {
			$data['title'] = 'Scrap Report by Register: '.strtoupper(str_replace('_', ' ', $param4));
		} elseif ($param1 == 'company_report') {
			$data['title'] = 'Scrap Report by Company: '.strtoupper($this->Crud->read_field('code', $param4, 'company', 'name'));
		} elseif ($param1 == 'dpo_report') {
			$data['title'] = 'DPO (Driver Payment Report) By Date { '.$param2.' to '.$param3.' }';
		} else {}
		$this->load->view('report/get_report', $data);
	}
}
