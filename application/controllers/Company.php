<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	/////////////////////Add New Customer View///////////////////
	public function new()	{
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$data['title'] = 'New Company | '.app_name;
		$data['page_active'] = 'new_company';
		$this->load->view('designs/header', $data);
		$this->load->view('company/new', $data);
		//$this->load->view('designs/footer', $data);
		
	}
	/////////////////////End/////////////////////////////////////////////


	/////////////////Script to Add new Customer//////////////////////////////
	public function add(){
		$table = 'company';
		if ($_POST) {
			$code = $this->input->post('code');
			$name = $this->input->post('name');
			$account_num = $this->input->post('account_num');
			$address = $this->input->post('address');
			

            $ins_data['code'] = $code;
			$ins_data['name'] = $name;
			$ins_data['account'] = $account_num;
			$ins_data['address'] = $address;
			$ins_data['reg_date'] = date(fdate);
			
			if ($this->Crud->check2('code', $code, 'name', $name, $table) > 0) {
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
	//////////////////////////////////////End//////////////////////////////////

	
	/////////////////// Customer Manage Script Start////////////////////////
	public function index($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'company';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'company/index/'.$param1;
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
								$data['e_code'] = $e->code;
								$data['e_name'] = $e->name;
								$data['e_account'] = $e->account;
								$data['e_address'] = $e->address;
								
							}
						}
					}
				}

				if($_POST){
					$id = $this->input->post('id');
					$code = $this->input->post('code');
					$name = $this->input->post('name');
					$account_num = $this->input->post('account_num');
					$address = $this->input->post('address');
					 
					// do create or update
					if($id) {
						$upd_data['code'] = $code;
						$upd_data['name'] = $name;
						$upd_data['address'] = $address;
						$upd_data['account'] = $account_num;
						
						if ($this->Crud->check2('code', $code, 'name', $name, $table) > 0) {
							echo $this->Crud->msg('warning', 'Email already Exist');
						} else {
							$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
							if($upd_rec > 0) {
								echo $this->Crud->msg('success', 'Record Updated' );
								echo '<script>location.reload(false);</script>';
							} else {
								echo $this->Crud->msg('info','No Changes' );	
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
			$table = 'company';
			$column_order = array('code', 'name', 'account', 'address');
			$column_search = array('code', 'name', 'account', 'address');
			$order = array('id' => 'desc');
			$where = '';
			
			// load data into table
			$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
			$data = array();
			// $no = $_POST['start'];
			$count = 1;
			foreach ($list as $item) {
				$id = $item->id;
				$code = $item->code;
				$name = $item->name;
				$reg_date = $item->reg_date;
				$account = $item->account;
				$address = $item->address;
				
				$date = date('d F, Y', strtotime($reg_date));
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('company/index/manage/edit/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="Edit">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('company/index/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="Delete">
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
				$row[] = $date;
				$row[] = $code;
				$row[] = strtoupper($name);		
				$row[] = $account;
				
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
			$this->load->view('company/manage_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'company/index/list'; // ajax table url
			$data['order_sort'] = '0, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '4'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Manage Company | '.app_name;
			$data['page_active'] = 'company';
			$this->load->view('designs/header', $data);
			$this->load->view('company/manage', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////

}
