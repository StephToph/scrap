<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	///////////////////Cost Center Manage Script Start////////////////////////
	public function cost($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'cost';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'expenses/cost/'.$param1;
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
								$data['e_name'] = $e->name;
								

							}
						}
					}
				}
				
				if($_POST){
					$id = $this->input->post('id');
					$name = $this->input->post('name');
							 
					// do create or update
					if($id) {
						$upd_data['name'] = $name;
							
						$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
						if($upd_rec > 0) {
							echo $this->Crud->msg('success', 'Record Updated' );
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info','No Changes' );	
						}

					} else {
						if($this->Crud->check('name', $name, $table) > 0) {
							echo $this->Crud->msg('warning', 'Record Already Exist' );
						} else {
							$ins_data['name'] = $name;
							
							$ins_rec = $this->Crud->create($table, $ins_data);
							if($ins_rec > 0) {
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
			$table = 'cost';
			$column_order = array('name');
			$column_search = array('name');
			$order = array('id' => 'desc');
			$where = '';
			
			// load data into table
			$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
			$data = array();
			// $no = $_POST['start'];
			$count = 1;
			foreach ($list as $item) {
				$id = $item->id;
				$name = $item->name;
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('expenses/cost/manage/edit/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="EDIT">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('expenses/cost/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="DELETE">
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
				$row[] = $count;
				$row[] = $name;
				
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
			$this->load->view('expenses/cost_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'expenses/cost/list'; // ajax table url
			$data['order_sort'] = '0, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '2'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Manage Cost Center | '.app_name;
			$data['page_active'] = 'cost';
			$this->load->view('designs/header', $data);
			$this->load->view('expenses/cost', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////


	/////////////////// Expenses Manage Script Start//////////////////////////////
	public function index($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'expenses';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'expenses/index/'.$param1;
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
								$data['e_cost_center'] = $e->cost_center;
								$data['e_amount'] = $e->amount;
								$data['e_details'] = $e->details;
								$data['e_remark'] = $e->remark;
								

							}
						}
					}
				}
				
				if($_POST){
					$id = $this->input->post('id');
					$cost = $this->input->post('cost');
					$amount = $this->input->post('amount');
					$details = $this->input->post('details');
					$remark = $this->input->post('remark');
							 
					// do create or update
					if($id) {
						$upd_data['cost_center'] = $cost;
						$upd_data['amount'] = $amount;
						$upd_data['details'] = $details;
						$upd_data['remark'] = $remark;
							
						$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
						if($upd_rec > 0) {
							echo $this->Crud->msg('success', 'Record Updated' );
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info','No Changes' );	
						}

					} else {
						if($this->Crud->check2('date', date(fdate), 'cost_center', $cost, $table) > 0) {
							echo $this->Crud->msg('warning', 'Record Already Exist' );
						} else {
							$ins_data['cost_center'] = $cost;
							$ins_data['amount'] = $amount;
							$ins_data['details'] = $details;
							$ins_data['remark'] = $remark;
							$ins_data['date'] = date(fdate);
							
							$ins_rec = $this->Crud->create($table, $ins_data);
							if($ins_rec > 0) {
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
			$table = 'expenses';
			$column_order = array('date', 'cost_center', 'amount', 'details', 'remark');
			$column_search = array('date', 'cost_center', 'amount', 'details', 'remark');
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
				$cost_center = $item->cost_center;
				$amount = $item->amount;
				$details = $item->details;
				$remark = $item->remark;
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('expenses/index/manage/edit/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="EDIT">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('expenses/index/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="DELETE">
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
				$row[] = ucwords($cost_center);		
				$row[] = number_format($amount);
				$row[] = strtoupper($details);
				$row[] = strtoupper($remark);
				
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
			$this->load->view('expenses/manage_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'expenses/index/list'; // ajax table url
			$data['order_sort'] = '0, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '5'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Manage Expenses | '.app_name;
			$data['page_active'] = 'expenses';
			$this->load->view('designs/header', $data);
			$this->load->view('expenses/manage', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	///////////////////////////End//////////////////////////////////////////////


	////////////////////////Expenses Report View///////////////////////////////
	public function exp_report()	{
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$data['title'] = 'Expenses Report | '.app_name;
		$data['page_active'] = 'exp_report';
		$this->load->view('designs/header', $data);
		$this->load->view('expenses/exp_report', $data);
		//$this->load->view('designs/footer', $data);
		
	}
	////////////////////////End///////////////////////////////////////////////////


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
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('expenses/get_report/date_report/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='ADD' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY DATES</span></a>";
					
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
			$data['title'] = 'Expenses Report by Dates { '.$param2.' to '.$param3.' }';
		} elseif ($param1 == 'cost_report') {
			$data['title'] = 'Expenses Report by Cost Center: '.str_replace('_', ' ', $param4);
		} else {}
		$this->load->view('expenses/get_report', $data);
	}



	public function cos($param1='', $param2='', $param3=''){
		if (empty($param1)) {
			echo $this->Crud->msg('warning', 'Please Select Cost Center to Generate Report');
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
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('expenses/get_report/cost_report/'.$param3.'/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='VIEW' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY COST CENETR</span></a>";
					echo $success;
				}
			}
		}
	}
}