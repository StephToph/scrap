<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	/////////////////////Add New Customer View///////////////////
	public function new()	{
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$data['title'] = 'New Customer | '.app_name;
		$data['page_active'] = 'new_customer';
		$this->load->view('designs/header', $data);
		$this->load->view('customer/new', $data);
		//$this->load->view('designs/footer', $data);
		
	}
	/////////////////////End/////////////////////////////////////////////


	/////////////////Script to Add new Customer//////////////////////////////
	public function add(){
		$table = 'customer';
		if ($_POST) {
			$surname = $this->input->post('surname');
			$firstname = $this->input->post('firstname');
			$gender = $this->input->post('gender');
			$state = $this->input->post('state');
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			

            $ins_data['surname'] = $surname;
			$ins_data['firstname'] = $firstname;
			$ins_data['gender'] = $gender;
			$ins_data['email'] = $email;
			$ins_data['phone'] = $phone;
			$ins_data['state'] = $state;
			$ins_data['reg_date'] = date(fdate);
			$ins_data['customer_id'] = 'CU000';
			
			if ($this->Crud->check2('email', $email, 'surname', $surname, $table) > 0) {
				echo $this->Crud->msg('warning', 'Record Already Exist');
			} else {
				if ($this->Crud->check('email', $email, $table) > 0) {
					echo $this->Crud->msg('warning', 'Email Already Exist');
				} else {
					$ins_rec = $this->Crud->create($table, $ins_data);
					if($ins_rec > 0) {
						$up_data['customer_id'] = 'CU00'.$ins_rec;
						$this->Crud->update('id', $ins_rec, 'customer', $up_data);
					
						echo $this->Crud->msg('success', 'Record Created');
						echo '<script>location.reload(false);</script>';
					} else {
						echo $this->Crud->msg('danger', 'Please Try Later');	
					}
				}
				
			}			

		}
	}
	//////////////////////////////////////End//////////////////////////////////

	///////////////Script to check if Email Exist in db////////////////////////////
	public function check_email() {
		$email = $this->input->get('email');
		if($email) {
			if($this->Crud->check('email', $email, 'customer') <= 0) {
				echo '<span class="text-success small">Email Available</span>';
			} else {
				echo '<span class="text-danger small">Email Taken</span>';
			}
			die;
		}
	}
	//////////////////////////////////END//////////////////////////////////////////

	/////////////////// Customer Manage Script Start////////////////////////
	public function index($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'customer';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'customer/index/'.$param1;
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
								$data['e_firstname'] = $e->firstname;
								$data['e_surname'] = $e->surname;
								$data['e_gender'] = $e->gender;
								$data['e_customer_id'] = $e->customer_id;
								$data['e_state'] = $e->state;
								$data['e_phone'] = $e->phone;
								$data['e_email'] = $e->email;
								
							}
						}
					}
				}

				// prepare for view
				if($param2 == 'view') {
					if($param3) {
						$view = $this->Crud->read_single('id', $param3, $table);
						if(!empty($view)) {
							foreach($view as $e) {
								$data['e_id'] = $e->id;
								$data['e_firstname'] = $e->firstname;
								$data['e_surname'] = $e->surname;
								$data['e_gender'] = $e->gender;
								$data['e_customer_id'] = $e->customer_id;
								$data['e_state'] = $e->state;
								$data['e_phone'] = $e->phone;
								$data['e_email'] = $e->email;
								$data['e_reg_date'] = $e->reg_date;
								
							}
						}
					}
				}
				
				if($_POST){
					$id = $this->input->post('id');
					$surname = $this->input->post('surname');
					$firstname = $this->input->post('firstname');
					$gender = $this->input->post('gender');
					$state = $this->input->post('state');
					$phone = $this->input->post('phone');
					$email = $this->input->post('email');
					 
					// do create or update
					if($id) {
						$upd_data['surname'] = $surname;
						$upd_data['firstname'] = $firstname;
						$upd_data['gender'] = $gender;
						$upd_data['phone'] = $phone;
						$upd_data['state'] = $state;

						if ($this->Crud->check('email', $email, $table) > 0) {
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
			$table = 'customer';
			$column_order = array('surname', 'reg_date', 'customer_id', 'email', 'phone');
			$column_search = array('surname', 'reg_date', 'customer_id', 'email', 'phone');
			$order = array('id' => 'desc');
			$where = '';
			
			// load data into table
			$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
			$data = array();
			// $no = $_POST['start'];
			$count = 1;
			foreach ($list as $item) {
				$id = $item->id;
				$surname = $item->surname;
				$firstname = $item->firstname;
				$reg_date = $item->reg_date;
				$customer_id = $item->customer_id;
				$state = $item->state;
				$phone = $item->phone;

				$date = date('d F, Y', strtotime($reg_date));
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('customer/index/manage/edit/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="Edit">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('customer/index/manage/delete/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="Delete">
						<i class="icon-trash fa-1x"></i>
					</a>
				';
				
				// view 
				$view_btn = '
					<a class="text-success pop" href="javascript:;" pageTitle="View Record" pageName="'.base_url('customer/index/manage/view/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="View">
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
				$row[] = $date;
				$row[] = $customer_id;
				$row[] = strtoupper($surname.' '.$firstname);		
				$row[] = $state;
				$row[] = $phone;
				
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
			$this->load->view('customer/manage_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'customer/index/list'; // ajax table url
			$data['order_sort'] = '0, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '5'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Manage Customers | '.app_name;
			$data['page_active'] = 'customer';
			$this->load->view('designs/header', $data);
			$this->load->view('customer/manage', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////

}
