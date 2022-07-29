<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Debit extends CI_Controller {

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
		
		$table = 'debit';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'debit/index/'.$param1;
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
								$data['e_chq_no'] = $e->chq_no;
								$data['e_chq_date'] = $e->chq_date;
								$data['e_type'] = $e->type;
								$data['e_debtor_name'] = $e->debtor_name;
								$data['e_pay_mode'] = $e->pay_mode;
								$data['e_debt_amount'] = $e->debt_amount;
								$data['e_debt_remark'] = $e->debt_remark;
								$data['e_paid_by'] = $e->paid_by;
								$data['e_debtor_acct'] = $e->debtor_acct;
								$data['e_received_by'] = $e->received_by;
								$data['e_credit_source'] = $e->credit_source;
								$data['e_credit_amount'] = $e->credit_amount;
								$data['e_credit_status'] = $e->credit_status;
								$data['e_credit_acct'] = $e->credit_acct;
								$data['e_date'] = $e->date;
								$data['e_entry_code'] = $e->entry_code;
								

							}
						}
					}
				}

				if($param2 == 'view') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['e_id'] = $e->id;
								$data['e_chq_no'] = $e->chq_no;
								$data['e_chq_date'] = $e->chq_date;
								$data['e_type'] = $e->type;
								$data['e_debtor_name'] = $e->debtor_name;
								$data['e_pay_mode'] = $e->pay_mode;
								$data['e_debt_amount'] = $e->debt_amount;
								$data['e_debt_remark'] = $e->debt_remark;
								$data['e_paid_by'] = $e->paid_by;
								$data['e_debtor_acct'] = $e->debtor_acct;
								$data['e_received_by'] = $e->received_by;
								$data['e_credit_source'] = $e->credit_source;
								$data['e_credit_amount'] = $e->credit_amount;
								$data['e_credit_status'] = $e->credit_status;
								$data['e_credit_acct'] = $e->credit_acct;
								$data['e_date'] = $e->date;
								$data['e_entry_code'] = $e->entry_code;
								

							}
						}
					}
				}
				
				if($_POST){
					$id = $this->input->post('id');
					$type = $this->input->post('type');
					$chq_no = $this->input->post('chq_no');
					$chq_date = $this->input->post('chq_date');
					$debtor_name = $this->input->post('debtor_name');
					$pay_mode = $this->input->post('pay_mode');
					$debt_amount = $this->input->post('debt_amount');
					$debt_remark = $this->input->post('debt_remark');
					$debtor_acct = $this->input->post('debtor_acct');
					$received_by = $this->input->post('received_by');
					$debt_source = $this->input->post('debt_source');
					$credit_source = $this->input->post('credit_source');
					$credit_status = $this->input->post('credit_status');
					$credit_amount = $this->input->post('credit_amount');
					$credit_acct = $this->input->post('credit_acct');
					$date = date(fdate);
					// do create or update
					if($id) {
						$upd_data['debtor_name'] = $debtor_name;
						$upd_data['pay_mode'] = $pay_mode;
						$upd_data['chq_no'] = $chq_no;
						$upd_data['chq_date'] = $chq_date;
						$upd_data['debt_amount'] = $debt_amount;
						$upd_data['debt_remark'] = $debt_remark;
						$upd_data['debtor_acct'] = $debtor_acct;
						$upd_data['received_by'] = $received_by;
						$upd_data['credit_source'] = $credit_source;
						$upd_data['credit_status'] = $credit_status;
						$upd_data['credit_amount'] = $credit_amount;
						$upd_data['credit_acct'] = $credit_acct;
							
						$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
						if($upd_rec > 0) {
							echo $this->Crud->msg('success', 'Record Updated' );
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info','No Changes' );	
						}

					} else {
						if($this->Crud->check2('date', $date, 'type', $type, $table) > 0) {
							echo $this->Crud->msg('warning', 'Record Already Exist' );
						} else {
							$ins_data['type'] = $type;
							$ins_data['debtor_name'] = $debtor_name;
							$ins_data['pay_mode'] = $pay_mode;
							$ins_data['chq_no'] = $chq_no;
							$ins_data['chq_date'] = $chq_date;
							$ins_data['debt_amount'] = $debt_amount;
							$ins_data['debt_remark'] = $debt_remark;
							$ins_data['debtor_acct'] = $debtor_acct;
							$ins_data['received_by'] = $received_by;
							$ins_data['credit_source'] = $credit_source;
							$ins_data['credit_status'] = $credit_status;
							$ins_data['credit_amount'] = $credit_amount;
							$ins_data['credit_acct'] = $credit_acct;
							$ins_data['date'] = $date;
							$ins_data['entry_code'] = 'DC-000';
							$ins_data['paid_by'] = $this->session->userdata('sc_user_id');
							
							$ins_rec = $this->Crud->create($table, $ins_data);
							if($ins_rec > 0) {
								$up_data['entry_code'] = 'DC-000'.$ins_rec;
								$this->Crud->update('id', $ins_rec, 'debit', $up_data);
					
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
			$table = 'debit';
			$column_order = array('date', 'entry_code', 'type');
			$column_search = array('date', 'entry_code', 'type');
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
				$entry_code = $item->entry_code;
				$type = $item->type;
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('debit/index/manage/edit/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="EDIT">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('debit/index/manage/delete/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="DELETE">
						<i class="icon-trash fa-1x"></i>
					</a>
				';
				
				// delete 
				$view_btn = '
					<a class="text-success pop" href="javascript:;" pageTitle="View Record" pageName="'.base_url('debit/index/manage/view/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="VIEw">
						<i class="icon-eye fa-1x"></i>
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
				$row[] = date('d F, Y H:i:s a', strtotime($date));
				$row[] = $entry_code;
				$row[] = ucwords($type);		
				
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
			$this->load->view('debit/manage_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'debit/index/list'; // ajax table url
			$data['order_sort'] = '0, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '3'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Advance Payment | '.app_name;
			$data['page_active'] = 'debit';
			$this->load->view('designs/header', $data);
			$this->load->view('debit/manage', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////

	public function type($param=''){
		if (empty($param)) {
			
		} elseif ($param == 'Debit') {
			echo '
				<div class="col-sm-6">
	                <div class="form-group">
	                    <div class="col-xs-12">
	                        <label for="business_name">Cheque No</label><br>    
	                        <input class="form-control" type="text" name="chq_no" id="chq_no"  required>
	                    </div>
	                </div>
	            </div>

	            <div class="col-sm-6">
	                <div class="form-group">
	                    <div class="col-xs-12">
	                        <label for="business_name">Cheque Date</label><br>    
	                        <input class="form-control" type="date" name="chq_date" id="chq_date" required>
	                    </div>
	                </div>
	            </div>

	             <div class="col-sm-6">
	                <div class="form-group">
	                    <div class="col-xs-12">
	                        <label for="business_name">Debtor Name</label><br>    
	                        <select class="form-control" id="debtor_name" name="debtor_name" required>
	                            <option value="">--Select--</option>';
	                            	$act = $this->Crud->read('customer'); foreach ($act as $key ) {
	                                echo '<option value="'.$key->customer_id.'">'.strtoupper($key->surname.' '.$key->firstname).'</option>';
	                            	 }
	                           
	                       echo '</select>
	                    </div>
	                </div>
	            </div>

	            <div class="col-sm-6">
	                <div class="form-group">
	                    <div class="col-xs-12">
	                        <label for="business_name">Payment Mode</label><br>    
	                        <select class="form-control" id="pay_mode" name="pay_mode" required>
	                            <option value="">--Select--</option>
	                            <option value="Cash">Cash</option>
	                            <option value="Cheque">Cheque</option>
	                            <option value="Transfer">Transfer</option>
	                        </select>
	                    </div>
	                </div>
	            </div>

	             <div class="col-sm-6">
	                <div class="form-group">
	                    <div class="col-xs-12">
	                        <label for="business_name">Amount</label><br>    
	                        <input class="form-control" type="text" name="debt_amount" id="debt_amount"  required>
	                    </div>
	                </div>
	            </div>

	            <div class="col-sm-6">
	                <div class="form-group">
	                    <div class="col-xs-12">
	                        <label for="business_name">From Account</label><br>    
	                        <select class="form-control" id="debtor_acct" name="debtor_acct" required>
	                            <option value="">--Select--</option>';
	                            	$act = $this->Crud->read('account'); foreach ($act as $key ) {
	                                echo '<option value="'.$key->id.'">'.$key->account_num.' { '.$key->bank_name. ' }'.'</option>';
	                            	}
	                           
	                        echo '</select>
	                    </div>
	                </div>
	            </div>

	            <div class="col-sm-6">
	                <div class="form-group">
	                    <div class="col-xs-12">
	                        <label for="business_name">Remark</label><br>    
	                        <input class="form-control" type="text" name="debt_remark" id="debt_remark">
	                    </div>
	                </div>
	            </div>

	            <div class="col-sm-6">
	                <div class="form-group">
	                    <div class="col-xs-12">
	                        <label for="business_name">Received By</label><br>    
	                        <input class="form-control" type="text" name="received_by" id="received_by">
	                    </div>
	                </div>
	            </div>
			';
		} elseif ($param == 'Credit') {
			echo '
				<div class="col-sm-6">
	                <div class="form-group">
	                    <div class="col-xs-12">
	                        <label for="business_name">Payment Source</label><br>    
	                        <select class="form-control" id="credit_source" name="credit_source" required>
	                            <option value="">Select</option>
	                            <option value="CASH">CASH</option>
	                            <option value="CHEQUE">CHEQUE</option>
	                            <option value="COMMISSION">COMMISSION</option>
	                            <option value="SGR AMOUNT">SGR AMOUNT</option>
	                        </select>
	                    </div>
	                </div>
	            </div>

	            <div class="col-sm-6">
	                <div class="form-group">
	                    <div class="col-xs-12">
	                        <label for="business_name">Payment Status</label><br>    
	                        <select class="form-control Select" id="credit_status" name="credit_status" required >
	                            <option value="">--Select--</option>
	                            <option value="PAID">PAID</option>
	                            <option value="OWING">OWING</option>
	                        </select>
	                    </div>
	                </div>
	            </div>

	            <div class="col-sm-6">
	                <div class="form-group">
	                    <div class="col-xs-12">
	                        <label for="business_name">Credit Amount</label><br>    
	                        <input class="form-control" type="text" name="credit_amount" id="credit_amount"  required>
	                    </div>
	                </div>
	            </div>

	            <div class="col-sm-6">
	                <div class="form-group">
	                    <div class="col-xs-12">
	                        <label for="business_name">To Account</label><br>    
	                        <select class="form-control" id="credit_acct" name="credit_acct" required>
	                            <option value="">--Select--</option>';
	                            	$act = $this->Crud->read('account'); foreach ($act as $key ) {
	                                echo '<option value="'.$key->id.'">'.$key->account_num.' { '.$key->bank_name. ' }'.'</option>';
	                            	}
	                           
	                        echo '</select>
	                    </div>
	                </div>
	            </div>
			';
		}
	}


	public function debit_report()	{
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$data['title'] = 'Advance Payment Report | '.app_name;
		$data['page_active'] = 'debit_report';
		$this->load->view('designs/header', $data);
		$this->load->view('debit/report', $data);
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
					$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('debit/get_report/date_report/'.$param2.'/'.$param1.'')."' data-toggle='tooltip' title='ADD' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY DATES</span></a>";
					
					echo $success;
					
				}
			}
		}
	}


	public function customer($param1=''){
		//echo $param1.' '.$param2;
		if (empty($param1)) {
			echo $this->Crud->msg('warning', 'Please Select customer to Generate Report');
		} else {
			$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('debit/get_report/customer_report/'.$param1.'')."' data-toggle='tooltip' title='VIEW' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY CUSTOMER</span></a>";
			
			echo $success;
			
		}
	}


	public function account($param1=''){
		if (empty($param1)) {
			echo $this->Crud->msg('warning', 'Please Select Account to Generate Report');
		} else {
			
			$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('debit/get_report/account_report/'.$param1.'')."' data-toggle='tooltip' title='VIEW' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY ACCOUNT</span></a>";
			
			echo $success;
			
		}
	}

	public function staff($param1=''){
		if (empty($param1)) {
			echo $this->Crud->msg('warning', 'Please Select Staff to Generate Report');
		} else {
			
			$success = "<a class='btn btn-success btn-anim btn-block' href='".base_url('debit/get_report/staff_report/'.$param1.'')."' data-toggle='tooltip' title='VIEW' target='_blank' rel='noopener noreferrer'><i class='icon-rocket'></i><span class='btn-text'>CLICK TO VIEW REPORT BY AUTHORISED PERSON</span></a>";
			
			echo $success;
			
		}
	}

	public function get_report($param1='', $param2='', $param3='', $param4=''){
		$data['report_type'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$data['param4'] = $param4;

		if ($param1 == 'date_report') {
			$data['title'] = 'Advance Payments Report By Date { '.$param2.' to '.$param3.' }';
		} elseif ($param1 == 'account_report') {
			$data['title'] = 'Statement of Account of: '.strtoupper($this->Crud->read_field('id', $param2, 'account', 'account_num')).' { '.strtoupper($this->Crud->read_field('id', $param2, 'account', 'bank_name')).' }';
		} elseif ($param1 == 'customer_report') {
			$data['title'] = 'Statement of Account for '.strtoupper($this->Crud->read_field('customer_id', $param2, 'customer', 'surname').' '.$this->Crud->read_field('customer_id', $param2, 'customer', 'firstname'));
		} elseif ($param1 == 'staff_report') {
			$data['title'] = 'Statement of Account  by Authoried Person: '.strtoupper($this->Crud->read_field('id', $param2, 'staff', 'surname'));
		} else {}
		$this->load->view('debit/get_report', $data);
	}

}