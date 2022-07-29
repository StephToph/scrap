<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cheque extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	/////////////////// Outward Cheque Manage Script Start////////////////////////
	public function outward($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'outward';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'cheque/outward/'.$param1;
		if($param2){$form_url .= '/'.$param2;}
		if($param3){$form_url .= '/'.$param3;}
		$data['form_url'] = $form_url;
		
		// manage record
		if($param1 == 'manage') {
			// prepare for delete
			if($param2 == 'delete') {
				if($param3) {
					$edit = $this->Crud->read_single('id', $param3, $table);
					if(!empty($edit)) {
						foreach($edit as $e) {
							$data['d_id'] = $e->id;
						}
					}
					
					if($_POST){
						$del_id = $this->input->post('d_id');
						if($this->Crud->delete('id', $del_id, $table) > 0) {
							echo $this->Crud->msg('success', 'Record Deleted' );
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('danger', 'Please Try Later');
						}
						exit;	
					}
				}
			} else {
				// prepare for edit
				if($param2 == 'edit') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['e_id'] = $e->id;
								$data['e_prepared_by'] = $e->prepared_by;
								$data['e_remark'] = $e->remark;
								$data['e_date'] = $e->date;
								$data['e_cheque_no'] = $e->cheque_no;
								$data['e_particular'] = $e->particular;
								$data['e_amount'] = $e->amount;
								

							}
						}
					}
				}
				
				if($_POST){
					$id = $this->input->post('id');
					$prepared_by = $this->input->post('prepared_by');
					$cheque_no = $this->input->post('cheque_no');
					$amount = $this->input->post('amount');
					$particular = $this->input->post('particular');
					$remark = $this->input->post('remark');
					$date = date(fdate);
					// do create or update
					if($id) {
						$upd_data['prepared_by'] = $prepared_by;
						$upd_data['cheque_no'] = $cheque_no;
						$upd_data['amount'] = $amount;
						$upd_data['particular'] = $particular;
						$upd_data['remark'] = $remark;
							
						$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
						if($upd_rec > 0) {
							echo $this->Crud->msg('success', 'Record Updated' );
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info','No Changes' );	
						}

					} else {
						if($this->Crud->check2('date', $date, 'prepared_by', $prepared_by, $table) > 0) {
							echo $this->Crud->msg('warning', 'Record Already Exist' );
						} else {
							$ins_data['prepared_by'] = $prepared_by;
							$ins_data['date'] = $date;
							$ins_data['amount'] = $amount;
							$ins_data['cheque_no'] = $cheque_no;
							$ins_data['particular'] = $particular;
							$ins_data['remark'] = $remark;
							$ins_data['code'] = 'CMC-100000';
							$ins_data['authorised'] = $this->session->userdata('sc_user_id');
							
							$ins_rec = $this->Crud->create($table, $ins_data);
							if($ins_rec > 0) {
								$up_data['code'] = 'CMC-10000'.$ins_rec;
								$this->Crud->update('id', $ins_rec, 'outward', $up_data);
					
								echo $this->Crud->msg('success', 'Record Created');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('danger', 'Please Try Later');	
							}	
						}
					}
					die;	
				}
			}
		}

		// record listing
		if($param1 == 'list') {
			// DataTable parameters
			$table = 'outward';
			$column_order = array('date', 'prepared_by', 'cheque_no', 'particular', 'amount', 'authorised', 'code');
			$column_search = array('date', 'prepared_by', 'cheque_no', 'particular', 'amount', 'authorised', 'code');
			$order = array('id' => 'desc');
			$where = '';
			
			// load data into table
			$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
			$data = array();
			// $no = $_POST['start'];
			$count = 1;
			foreach ($list as $item) {
				$id = $item->id;
				$date = $item->date;
				$prepared_by = $item->prepared_by;
				$cheque_no = $item->cheque_no;
				$particular = $item->particular;
				$amount = $item->amount;
				$authorised = $item->authorised;
				$code = $item->code;
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('cheque/outward/manage/edit/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="EDIT">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('cheque/outward/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="DELETE">
						<i class="icon-trash fa-1x"></i>
					</a>
				';
				
				// add manage buttons
				$all_btn = '
					<div class="text-center">
						'.$del_btn.'&nbsp;
						'.$edit_btn.'
					</div>
					'.$script.'
				';
				
				$row = array();
				$row[] = date('d F, Y', strtotime($date));
				$row[] = $code;
				$row[] = ucwords($prepared_by);		
				$row[] = $cheque_no;
				$row[] = number_format($amount);
				$row[] = strtoupper($this->Crud->read_field('1', $authorised, 'staff', 'surname').' '.$this->Crud->read_field('1', $authorised, 'staff', 'firstname'));		
				
				$row[] = $all_btn;
	
				$data[] = $row;
				$count += 1;

			}
	
			$output = array(
				"draw" => intval($_POST['draw']),
				"recordsTotal" => $this->Crud->datatable_count($table, $where),
				"recordsFiltered" => $this->Crud->datatable_filtered($table, $column_order, $column_search, $order, $where),
				"data" => $data,
			);
			
			//output to json format
			echo json_encode($output);
			die;
		}

			
		if($param1 == 'manage') {
			$this->load->view('cheque/outward_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'cheque/outward/list'; // ajax table url
			$data['order_sort'] = '1, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '6'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Outward Cheque | '.app_name;
			$data['page_active'] = 'outward';
			$this->load->view('designs/header', $data);
			$this->load->view('cheque/outward', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////


	/////////////////// Outward Cheque Manage Script Start////////////////////////
	public function inward($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'inward';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'cheque/inward/'.$param1;
		if($param2){$form_url .= '/'.$param2;}
		if($param3){$form_url .= '/'.$param3;}
		$data['form_url'] = $form_url;
		
		// manage record
		if($param1 == 'manage') {
			// prepare for delete
			if($param2 == 'delete') {
				if($param3) {
					$edit = $this->Crud->read_single('id', $param3, $table);
					if(!empty($edit)) {
						foreach($edit as $e) {
							$data['d_id'] = $e->id;
						}
					}
					
					if($_POST){
						$del_id = $this->input->post('d_id');
						if($this->Crud->delete('id', $del_id, $table) > 0) {
							echo $this->Crud->msg('success', 'Record Deleted' );
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('danger', 'Please Try Later');
						}
						exit;	
					}
				}
			} else {
				// prepare for edit
				if($param2 == 'edit') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['e_id'] = $e->id;
								$data['e_company'] = $e->company;
								$data['e_remark'] = $e->remark;
								$data['e_date'] = $e->date;
								$data['e_cheque_no'] = $e->cheque_no;
								$data['e_pay_type'] = $e->pay_type;
								$data['e_pay_account'] = $e->pay_account;
								$data['e_amount'] = $e->amount;
								

							}
						}
					}
				}

				// prepare for edit
				if($param2 == 'view') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['e_id'] = $e->id;
								$data['e_company'] = $e->company;
								$data['e_remark'] = $e->remark;
								$data['e_date'] = $e->date;
								$data['e_cheque_no'] = $e->cheque_no;
								$data['e_pay_type'] = $e->pay_type;
								$data['e_pay_account'] = $e->pay_account;
								$data['e_amount'] = $e->amount;
								$data['e_code'] = $e->code;
								$data['e_user'] = $e->user;
								

							}
						}
					}
				}
				
				if($_POST){
					$id = $this->input->post('id');
					$company = $this->input->post('company');
					$cheque_no = $this->input->post('cheque_no');
					$amount = $this->input->post('amount');
					$pay_account = $this->input->post('pay_account');
					$pay_type = $this->input->post('pay_type');
					$remark = $this->input->post('remark');
					$date = date(fdate);
					// do create or update
					if($id) {
						$upd_data['company'] = $company;
						$upd_data['cheque_no'] = $cheque_no;
						$upd_data['amount'] = $amount;
						$upd_data['remark'] = $remark;
						$upd_data['pay_account'] = $pay_account;
						$upd_data['pay_type'] = $pay_type;
							
						$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
						if($upd_rec > 0) {
							echo $this->Crud->msg('success', 'Record Updated' );
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info','No Changes' );	
						}

					} else {
						if($this->Crud->check3('date', $date, 'company', $company, 'cheque_no', $cheque_no, $table) > 0) {
							echo $this->Crud->msg('warning', 'Record Already Exist' );
						} else {
							$ins_data['company'] = $company;
							$ins_data['date'] = $date;
							$ins_data['amount'] = $amount;
							$ins_data['cheque_no'] = $cheque_no;
							$ins_data['pay_type'] = $pay_type;
							$ins_data['pay_account'] = $pay_account;
							$ins_data['remark'] = $remark;
							$ins_data['code'] = 'CHQ-100000';
							$ins_data['user'] = $this->session->userdata('sc_user_id');
							
							$ins_rec = $this->Crud->create($table, $ins_data);
							if($ins_rec > 0) {
								$up_data['code'] = 'CHQ-10000'.$ins_rec;
								$this->Crud->update('id', $ins_rec, 'inward', $up_data);
					
								echo $this->Crud->msg('success', 'Record Created');
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('danger', 'Please Try Later');	
							}	
						}
					}
					die;	
				}
			}
		}

		// record listing
		if($param1 == 'list') {
			// DataTable parameters
			$table = 'inward';
			$column_order = array('date', 'company', 'cheque_no', 'pay_account', 'amount', 'user', 'code');
			$column_search = array('date', 'company', 'cheque_no', 'pay_account', 'amount', 'user', 'code');
			$order = array('id' => 'desc');
			$where = '';
			
			// load data into table
			$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
			$data = array();
			// $no = $_POST['start'];
			$count = 1;
			foreach ($list as $item) {
				$id = $item->id;
				$date = $item->date;
				$code = $item->code;
				$company = $item->company;
				$cheque_no = $item->cheque_no;
				$amount = $item->amount;
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('cheque/inward/manage/edit/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="EDIT">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				// view 
				$view_btn = '
					<a class="text-success pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('cheque/inward/manage/view/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="VIEW">
						<i class="icon-eye fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('cheque/inward/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="DELETE">
						<i class="icon-trash fa-1x"></i>
					</a>
				';
				
				// add manage buttons
				$all_btn = '
					<div class="text-center">
						'.$del_btn.'&nbsp;
						'.$view_btn.'&nbsp;
						'.$edit_btn.'
					</div>
					'.$script.'
				';
				
				$row = array();
				$row[] = date('d F, Y', strtotime($date));
				$row[] = $code;
				$row[] = strtoupper($this->Crud->read_field('code', $company, 'company', 'name'));		
				$row[] = $cheque_no;
				$row[] = number_format($amount);
				
				$row[] = $all_btn;
	
				$data[] = $row;
				$count += 1;

			}
	
			$output = array(
				"draw" => intval($_POST['draw']),
				"recordsTotal" => $this->Crud->datatable_count($table, $where),
				"recordsFiltered" => $this->Crud->datatable_filtered($table, $column_order, $column_search, $order, $where),
				"data" => $data,
			);
			
			//output to json format
			echo json_encode($output);
			die;
		}

			
		if($param1 == 'manage') {
			$this->load->view('cheque/inward_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'cheque/inward/list'; // ajax table url
			$data['order_sort'] = '1, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '5'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Inward Cheque | '.app_name;
			$data['page_active'] = 'inward';
			$this->load->view('designs/header', $data);
			$this->load->view('cheque/inward', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////


	public function inward_report()	{
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$data['title'] = 'Inward Report | '.app_name;
		$data['page_active'] = 'inward_report';
		$this->load->view('designs/header', $data);
		$this->load->view('cheque/inward_report', $data);
		//$this->load->view('designs/footer', $data);
		
	}


	public function outward_report()	{
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$data['title'] = 'Outward Report | '.app_name;
		$data['page_active'] = 'outward_report';
		$this->load->view('designs/header', $data);
		$this->load->view('cheque/outward_report', $data);
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
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('cheque/get_report/date_report/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='ADD' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY DATES</span></a>";
					
					echo $success;
					
				}
			}
		}
	}

	public function out_date($param1='', $param2=''){
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
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('cheque/out_report/date_report/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='VIEW' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY DATES</span></a>";
					
					echo $success;
					
				}
			}
		}
	}

	public function out_code($param1='', $param2=''){
		//echo $param1.' '.$param2;
		if (empty($param1 or $param2)) {
			echo $this->Crud->msg('warning', 'Please Start Code and End Code to Generate Report');
		} else {
			if (!empty($param2) and empty($param1)) {
				echo $this->Crud->msg('warning', 'Please Enter End Code!');
			} elseif (empty($param2) and !empty($param1)) {
				echo $this->Crud->msg('warning', 'Please Enter Start Code!');
			} else{
				if ($param1 > $param2) {
					echo $this->Crud->msg('warning', 'End Code cannot be greater than Start Code!.<br>Please Check the Details you entered.');
				} else {
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('cheque/out_report/code_report/'.$param1.'/'.$param2.'')."' data-toggle='tooltip' title='VIEW' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY CODE</span></a>";
					
					echo $success;
					
				}
			}
		}
	}


	public function company($param1=''){
		if (empty($param1)) {
			echo $this->Crud->msg('warning', 'Please Select Company to Generate Report');
		} else {
			
			$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('cheque/get_report/company_report/'.$param1.'')."' data-toggle='tooltip' title='VIEW' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY COMPANY ONLY</span></a>";
			
			echo $success;
			
		}
	}

	public function get_report($param1='', $param2='', $param3='', $param4=''){
		$data['report_type'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$data['param4'] = $param4;

		if ($param1 == 'date_report') {
			$data['title'] = 'Inward Cheque by Dates { '.$param2.' to '.$param3.' }';
		} elseif ($param1 == 'account_report') {
			$data['title'] = 'Inward Cheque Report by Account Number: '.$this->Crud->read_field('id', $param4, 'account', 'account_num');
		} elseif ($param1 == 'company_report') {
			$data['title'] = 'Inward Cheque Report by Company: '.strtoupper($this->Crud->read_field('code', $param4, 'company', 'name'));
		} elseif ($param1 == 'date_comp_report') {
			$data['title'] = 'Inward Cheque Report by Company: '.strtoupper($this->Crud->read_field('code', $param4, 'company', 'name')).' during '.$param2.' to '.$param3;
		} else {}
		$this->load->view('cheque/get_report', $data);
	}

	public function out_report($param1='', $param2='', $param3='', $param4=''){
		$data['report_type'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$data['param4'] = $param4;

		if ($param1 == 'date_report') {
			$data['title'] = 'Outward Cheque Confirmation by Dates { '.$param2.' to '.$param3.' }';
		} elseif ($param1 == 'register_report') {
			$data['title'] = 'Outward Cheque Confirmation by Register: '.strtoupper($param4);
		} elseif ($param1 == 'code_report') {
			$data['title'] = 'Outward Cheque Confirmation by Code: { '.$param2.' to '.$param3.' }';
		} elseif ($param1 == 'date_comp_report') {
			$data['title'] = 'Inward Cheque Report by Company: '.strtoupper($this->Crud->read_field('code', $param4, 'company', 'name')).' during '.$param2.' to '.$param3;
		} else {}
		$this->load->view('cheque/out_report', $data);
	}

	public function out_register($param1='', $param2='', $param3=''){
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
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('cheque/out_report/register_report/'.$param3.'/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='VIEW' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY REGISTER</span></a>";
					echo $success;
				}
			}
		}
	}


	public function account($param1='', $param2='', $param3=''){
		if (empty($param1)) {
			echo $this->Crud->msg('warning', 'Please Select Account Number to Generate Report');
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
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('cheque/get_report/account_report/'.$param3.'/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='VIEW' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY ACCOUNT NUMBER</span></a>";
					echo $success;
				}
			}
		}
	}

	public function date_comp($param1='', $param2='', $param3=''){
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
					$success = "<a class='btn btn-info btn-anim btn-block' href='".base_url('cheque/get_report/date_comp_report/'.$param3.'/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='VIEW' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY DATE AND COMPANY</span></a>";
					echo $success;
				}
			}
		}
	}

}