<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	/////////////////// Bank Account Manage Script Start////////////////////////
	public function index($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'account';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'account/index/'.$param1;
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
								$data['e_account_name'] = $e->account_name;
								$data['e_account_num'] = $e->account_num;
								$data['e_bank_name'] = $e->bank_name;
								

							}
						}
					}
				}
				
				if($_POST){
					$id = $this->input->post('id');
					$account_name = $this->input->post('account_name');
					$account_num = $this->input->post('account_num');
					$bank_name = $this->input->post('bank_name');
							 
					// do create or update
					if($id) {
						$upd_data['account_num'] = $account_num;
						$upd_data['account_name'] = $account_name;
						$upd_data['bank_name'] = $bank_name;
							
						$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
						if($upd_rec > 0) {
							echo $this->Crud->msg('success', 'Record Updated' );
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info','No Changes' );	
						}

					} else {
						if($this->Crud->check2('account_num', $account_num, 'account_name', $account_name, $table) > 0) {
							echo $this->Crud->msg('warning', 'Record Already Exist' );
						} else {
							$ins_data['account_num'] = $account_num;
							$ins_data['account_name'] = $account_name;
							$ins_data['bank_name'] = $bank_name;
							
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
			$table = 'account';
			$column_order = array('account_num', 'account_name', 'bank_name');
			$column_search = array('account_num', 'account_name', 'bank_name');
			$order = array('id' => 'desc');
			$where = '';
			
			// load data into table
			$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
			$data = array();
			// $no = $_POST['start'];
			$count = 1;
			foreach ($list as $item) {
				$id = $item->id;
				$account_num = $item->account_num;
				$account_name = $item->account_name;
				$bank_name = $item->bank_name;
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('account/index/manage/edit/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="EDIT">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('account/index/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="DELETE">
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
				$row[] = $account_num;
				$row[] = ucwords($account_name);		
				$row[] = $bank_name;
				
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
			$this->load->view('account/manage_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'account/index/list'; // ajax table url
			$data['order_sort'] = '1, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '3'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Manage Accounts | '.app_name;
			$data['page_active'] = 'account';
			$this->load->view('designs/header', $data);
			$this->load->view('account/manage', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////


	/////////////////// Branch Manage Script Start//////////////////////////////
	public function branch($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'branch';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'account/branch/'.$param1;
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
			$table = 'branch';
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
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('account/branch/manage/edit/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="EDIT">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('account/branch/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="DELETE">
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
				$row[] = ucwords($name);		
				
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
			$this->load->view('account/branch_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'account/branch/list'; // ajax table url
			$data['order_sort'] = '0, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '2'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Manage Branch | '.app_name;
			$data['page_active'] = 'account';
			$this->load->view('designs/header', $data);
			$this->load->view('account/branch', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	///////////////////////////End//////////////////////////////////////////////

}