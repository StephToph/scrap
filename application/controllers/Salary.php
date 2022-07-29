<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Salary extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	/////////////////// Debit/Credit Manage Script Start////////////////////////
	public function index($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'salary';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'salary/index/'.$param1;
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
								$data['e_emp_id'] = $e->emp_id;
								$data['e_month_paid'] = $e->month_paid;
								$data['e_amount_paid'] = $e->amount_paid;
								$data['e_days_present'] = $e->days_present;
								$data['e_days_absent'] = $e->days_absent;
								$data['e_amount_deducted'] = $e->amount_deducted;
								$data['e_amount_balance'] = $e->amount_balance;
								$data['e_remark'] = $e->remark;
								

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
			$table = 'salary';
			$column_order = array('date', 'month_paid', 'emp_id', 'amount_paid', 'amount_balance');
			$column_search = array('date', 'month_paid', 'emp_id', 'amount_paid', 'amount_balance');
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
				$month_paid = $item->month_paid;
				$emp_id = $item->emp_id;
				$amount_paid = $item->amount_paid;
				$amount_balance = $item->amount_balance;
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('salary/index/manage/edit/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="EDIT">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('salary/index/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="DELETE">
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
				$row[] = $month_paid;
				$row[] = strtoupper($this->Crud->read_field('staff_id', $emp_id, 'staff', 'surname').' '.$this->Crud->read_field('staff_id', $emp_id, 'staff', 'firstname'));		
				$row[] = number_format($amount_paid);
				$row[] = number_format($amount_balance);
				//$row[] = 		
				
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
			$this->load->view('salary/manage_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'salary/index/list'; // ajax table url
			$data['order_sort'] = '0, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '5'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Salary | '.app_name;
			$data['page_active'] = 'salary';
			$this->load->view('designs/header', $data);
			$this->load->view('salary/manage', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////


	///////////////////Prepare Salary Script Start////////////////////////
	public function prepare() {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
	
		$data['title'] = 'Prepare Salary | '.app_name;
		$data['page_active'] = 'prepare';
		$this->load->view('designs/header', $data);
		$this->load->view('salary/prepare', $data);
		//$this->load->view('designs/footer', $data);
	}
	/////////////////////////////End////////////////////////////////////////////


	public function check_emp($emp_id='') {

		if($emp_id) {
			if($this->Crud->check('staff_id', $emp_id, 'staff') <= 0) {
				echo '
					<div class="form-group">
						<label class="control-label mb-10">Employee Name</label>
						<input type="text" id="name" name="name" class="form-control" value="No Staff with this ID" placeholder="John Doe" readonly> 
					</div>
				';
			} else {
				echo '
					<div class="form-group">
						<label class="control-label mb-10">Employee Name</label>
						<input type="text" id="name" name="name" class="form-control" value="'.strtoupper($this->Crud->read_field('staff_id', $emp_id, 'staff', 'surname').' '.$this->Crud->read_field('staff_id', $emp_id, 'staff', 'firstname')).'" readonly> 
					</div>
				';
			}
			die;
		} else {
			echo '
					<div class="form-group">
						<label class="control-label mb-10">Employee Name</label>
						<input type="text" id="name" name="name" class="form-control" value="No Staff with this ID" placeholder="John Doe" readonly> 
					</div>
				';
		}
	}

	public function mnth($param='') {

		if(empty($param)) {
			echo '
				<div class="form-group">
					<label class="control-label mb-10">Days Present</label>
					<input class="form-control" type="number" name="days_present" id="days_present" min="0" value="0" required oninput="dayp();">
				</div>
			';
		} else {
			$mth = date("m", strtotime($param));
			$res = days_in_month($mth, date('Y'));
			echo '
				<div class="form-group">
					<label class="control-label mb-10">Days Present</label>
					<input class="form-control" type="number" name="days_present" id="days_present" min="0" value="'.$res.'" required oninput="dayp();">
				</div>
				<input type="hidden" id="day_present" value="'.$res.'">
			';
		}
	}

	public function prep(){
		$log_user_id = $this->session->userdata('sc_user_id');
		$table = 'salary';
		if ($_POST) {
			$emp_id = $this->input->post('emp_id');
			$month_paid = $this->input->post('month_paid');
			$amount_paid = $this->input->post('amount_paid');
			$days_present = $this->input->post('days_present');
			$days_absent = $this->input->post('days_absent');
			$amount_deducted = $this->input->post('amount_deducted');
			$amount_balance = $this->input->post('amount_balance');
			$remark = $this->input->post('remark');
			

            $ins_data['emp_id'] = $emp_id;
			$ins_data['month_paid'] = $month_paid;
			$ins_data['amount_paid'] = $amount_paid;
			$ins_data['days_present'] = $days_present;
			$ins_data['days_absent'] = $days_absent;
			$ins_data['amount_deducted'] = $amount_deducted;
			$ins_data['amount_balance'] = $amount_balance;
			$ins_data['remark'] = $remark;
			$ins_data['paid_by'] = $log_user_id;
			$ins_data['date'] = date(fdate);
			
			if ($this->Crud->check2('emp_id', $emp_id, 'month_paid', $month_paid, $table) > 0) {
				echo $this->Crud->msg('warning', 'Record Already Exist');
			} else {
				$ins_rec = $this->Crud->create($table, $ins_data);
				if($ins_rec > 0) {
					
					echo $this->Crud->msg('success', 'Record Created');
					echo '<script>location.reload(false);</script>';
				} else {
					echo $this->Crud->msg('danger', 'Please Try Later');	
				}
				
			}	
			die;		

		}
	}

	public function get_report($param1='', $param2='', $param3='', $param4=''){
		$data['report_type'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$data['param4'] = $param4;

		if ($param1 == 'date_report') {
			$data['title'] = 'Salary by Dates { '.$param2.' to '.$param3.' }';
		} else {}
		$this->load->view('salary/get_report', $data);
	}

	public function salary_rep()	{
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$data['title'] = 'Monthly Report | '.app_name;
		$data['page_active'] = 'salary_rep';
		$this->load->view('designs/header', $data);
		$this->load->view('salary/report', $data);
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
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('salary/get_report/date_report/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='ADD' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY DATES</span></a>";
					
					echo $success;
					
				}
			}
		}
	}

}