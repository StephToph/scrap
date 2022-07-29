<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {

	/////////////////////Add New Staff View///////////////////
	public function new()	{
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$data['title'] = 'New Staff | '.app_name;
		$data['page_active'] = 'dashboard';
		$this->load->view('designs/header', $data);
		$this->load->view('staff/new', $data);
		//$this->load->view('designs/footer', $data);
		
	}
	/////////////////////End/////////////////////////////////////////////


	/////////////////Script to Add new Staff//////////////////////////////
	public function add(){
		$table = 'staff';
		if ($_POST) {
			$surname = $this->input->post('surname');
			$firstname = $this->input->post('firstname');
			$gender = $this->input->post('gender');
			$dob = $this->input->post('dob');
			$branch = $this->input->post('branch');
			$marital = $this->input->post('marital');
			$qualification = $this->input->post('qualification');
			$designation = $this->input->post('designation');
			$address = $this->input->post('address');
			$postal = $this->input->post('postal');
			$state = $this->input->post('state');
			$nationality = $this->input->post('nationality');
			$phone = $this->input->post('phone');
			$email = $this->input->post('email');
			$relationship = $this->input->post('relationship');
			$name = $this->input->post('g_name');
			$g_address = $this->input->post('g_address');
			$occupation = $this->input->post('occupation');
			$g_phone = $this->input->post('g_phone');
			

            $ins_data['surname'] = $surname;
			$ins_data['firstname'] = $firstname;
			$ins_data['gender'] = $gender;
			$ins_data['dob'] = $dob;
			$ins_data['marital'] = $marital;
			$ins_data['branch'] = $branch;
			$ins_data['qualification'] = $qualification;
			$ins_data['designation'] = $designation;
			$ins_data['address'] = $address;
			$ins_data['email'] = $email;
			$ins_data['phone'] = $phone;
			$ins_data['postal'] = $postal;
			$ins_data['state'] = $state;
			$ins_data['nationality'] = $nationality;
			$ins_data['relationship'] = $relationship;
			$ins_data['name'] = $name;
			$ins_data['g_address'] = $g_address;
			$ins_data['g_phone'] = $g_phone;
			$ins_data['occupation'] = $occupation;
			$ins_data['reg_date'] = date(fdate);
			$ins_data['staff_id'] = 'ST000';
			
			if ($this->Crud->check2('email', $email, 'surname', $surname, $table) > 0) {
				echo $this->Crud->msg('warning', 'Record Already Exist');
			} else {
				if ($this->Crud->check('email', $email, $table) > 0) {
					echo $this->Crud->msg('warning', 'Email Already Exist');
				} else {
					$ins_rec = $this->Crud->create($table, $ins_data);
					if($ins_rec > 0) {
						$up_data['staff_id'] = 'ST00'.$ins_rec;
						$this->Crud->update('id', $ins_rec, 'staff', $up_data);
					
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
			if($this->Crud->check('email', $email, 'staff') <= 0) {
				echo '<span class="text-success small">Email Available</span>';
			} else {
				echo '<span class="text-danger small">Email Taken</span>';
			}
			die;
		}
	}
	//////////////////////////////////END//////////////////////////////////////////

	/////////////////// Designation Manage Script Start////////////////////////
	public function designation($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'designation';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'staff/designation/'.$param1;
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
			$table = 'designation';
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
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('staff/designation/manage/edit/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="Edit">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('staff/designation/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="Delete">
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
			$this->load->view('staff/designation_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'staff/designation/list'; // ajax table url
			$data['order_sort'] = '0, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '2'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Manage Designation | '.app_name;
			$data['page_active'] = 'designation';
			$this->load->view('designs/header', $data);
			$this->load->view('staff/designation', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////


	/////////////////// Staff Manage Script Start////////////////////////
	public function index($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'staff';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'staff/index/'.$param1;
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
								$data['e_dob'] = $e->dob;
								$data['e_staff_id'] = $e->staff_id;
								$data['e_marital'] = $e->marital;
								$data['e_qualification'] = $e->qualification;
								$data['e_designation'] = $e->designation;
								$data['e_branch'] = $e->branch;
								$data['e_address'] = $e->address;
								$data['e_postal'] = $e->postal;
								$data['e_state'] = $e->state;
								$data['e_nationality'] = $e->nationality;
								$data['e_phone'] = $e->phone;
								$data['e_email'] = $e->email;
								$data['e_name'] = $e->name;
								$data['e_relationship'] = $e->relationship;
								$data['e_g_address'] = $e->g_address;
								$data['e_occupation'] = $e->occupation;
								$data['e_g_phone'] = $e->g_phone;
								$data['e_reg_date'] = $e->reg_date;
								
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
								$data['e_dob'] = $e->dob;
								$data['e_staff_id'] = $e->staff_id;
								$data['e_marital'] = $e->marital;
								$data['e_qualification'] = $e->qualification;
								$data['e_designation'] = $e->designation;
								$data['e_branch'] = $e->branch;
								$data['e_address'] = $e->address;
								$data['e_postal'] = $e->postal;
								$data['e_state'] = $e->state;
								$data['e_nationality'] = $e->nationality;
								$data['e_phone'] = $e->phone;
								$data['e_email'] = $e->email;
								$data['e_name'] = $e->name;
								$data['e_relationship'] = $e->relationship;
								$data['e_g_address'] = $e->g_address;
								$data['e_occupation'] = $e->occupation;
								$data['e_g_phone'] = $e->g_phone;
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
					$dob = $this->input->post('dob');
					$branch = $this->input->post('branch');
					$marital = $this->input->post('marital');
					$qualification = $this->input->post('qualification');
					$designation = $this->input->post('designation');
					$address = $this->input->post('address');
					$postal = $this->input->post('postal');
					$state = $this->input->post('state');
					$nationality = $this->input->post('nationality');
					$phone = $this->input->post('phone');
					$email = $this->input->post('email');
					$relationship = $this->input->post('relationship');
					$name = $this->input->post('g_name');
					$g_address = $this->input->post('g_address');
					$occupation = $this->input->post('occupation');
					$g_phone = $this->input->post('g_phone');
					 
					// do create or update
					if($id) {
						$upd_data['surname'] = $surname;
						$upd_data['firstname'] = $firstname;
						$upd_data['gender'] = $gender;
						$upd_data['dob'] = $dob;
						$upd_data['marital'] = $marital;
						$upd_data['branch'] = $branch;
						$upd_data['qualification'] = $qualification;
						$upd_data['designation'] = $designation;
						$upd_data['address'] = $address;
						$upd_data['email'] = $email;
						$upd_data['phone'] = $phone;
						$upd_data['postal'] = $postal;
						$upd_data['state'] = $state;
						$upd_data['nationality'] = $nationality;
						$upd_data['relationship'] = $relationship;
						$upd_data['name'] = $name;
						$upd_data['g_address'] = $g_address;
						$upd_data['g_phone'] = $g_phone;
						$upd_data['occupation'] = $occupation;
							

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
			$table = 'staff';
			$column_order = array('surname', 'reg_date', 'staff_id', 'designation', 'phone');
			$column_search = array('surname', 'reg_date', 'staff_id', 'designation', 'phone');
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
				$staff_id = $item->staff_id;
				$designation = $item->designation;
				$phone = $item->phone;

				$date = date('d F, Y', strtotime($reg_date));
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Manage Record" pageName="'.base_url('staff/index/manage/edit/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="Edit">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('staff/index/manage/delete/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="Delete">
						<i class="icon-trash fa-1x"></i>
					</a>
				';
				
				// view 
				$view_btn = '
					<a class="text-success pop" href="javascript:;" pageTitle="View Record" pageName="'.base_url('staff/index/manage/view/'.$id).'" pageSize="modal-md" data-toggle="tooltip" title="View">
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
				$row[] = $staff_id;
				$row[] = strtoupper($surname.' '.$firstname);		
				$row[] = $designation;
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
			$this->load->view('staff/manage_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'staff/index/list'; // ajax table url
			$data['order_sort'] = '0, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '5'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Manage Staffs | '.app_name;
			$data['page_active'] = 'designation';
			$this->load->view('designs/header', $data);
			$this->load->view('staff/manage', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////

}
