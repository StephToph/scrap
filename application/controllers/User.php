<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
        parent::__construct();
    }
	
	public function index($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('co_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('co_user_id');
		}
		
		
		$img_id = $this->Crud->read_field('id', $log_user_id, 'staff', 'img_id');
		$pic = $this->Crud->read_field('id', $img_id, 'image', 'pics_small');
		$data['pic'] = $pic;
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
						$del_id = $this->input->post('d_staff_id');
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
				if($param2 == 'view') {
					if($param3) {
						$edit = $this->Crud->read_single('id', $param3, $table);
						if(!empty($edit)) {
							foreach($edit as $e) {
								$data['e_id'] = $e->id;
								$data['e_customer_id'] = $e->customer_id;
								$data['e_name'] = $e->name;
								$data['e_reg_date'] = $e->reg_date;
								$data['e_last_logged'] = $e->last_logged;
								$data['e_email'] = $e->email;
								$data['e_phone'] = $e->phone;
								$data['e_address'] = $e->address;
								$data['e_status'] = $e->status;
								

							}
						}
					}
				}
				
			}
		}

		// record listing
		if($param1 == 'list') {
			// DataTable parameters
			$table = 'customer';
			$column_order = array('customer_id', 'name', 'email', 'phone');
			$column_search = array('customer_id', 'name', 'email', 'phone');
			$order = array('id' => 'desc');
			$where = '';
			
			// load data into table
			$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
			$data = array();
			// $no = $_POST['start'];
			$count = 1;
			foreach ($list as $item) {
				$id = $item->id;
				$customer_id = $item->customer_id;
				$name = $item->name;
				$email = $item->email;
				$phone = $item->phone;
				$reg_date = $item->reg_date;
				$status = $item->status;
				
				if ($status == 0) {
					$stat = '<span class="label label-danger">Offline</span>';
				} else {
					$stat = '<span class="label label-success">Onine</span>';
				}
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				
				
				// delete 
				$del_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Delete '.$customer_id.'" pageName="'.base_url('customer/index/manage/view/'.$id).'">
						<i class="icon-eye fa-1x"></i>
					</a>
				';
				
				// add manage buttons
				$all_btn = '
					<div class="text-center">
						'.$del_btn.'&nbsp;
					</div>
					'.$script.'
				';
				
				$row = array();
				$row[] = $customer_id;
				$row[] = ucwords($name);		
				$row[] = $email;
				$row[] = $reg_date;		
				$row[] = $stat;		
				
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
			$data['order_sort'] = '0, "asc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '4,5'; // sort disable columns (1,3,5)

			$name = ucwords($this->Crud->read_field('id', 1, 'settings', 'title'));
		
			//$data['user'] = $account_name;
			$data['title'] = 'Manage Customers | '.$name;
			$data['page_active'] = 'customer';
			$this->load->view('designs/header', $data);
			$this->load->view('customer/manage', $data);
			$this->load->view('designs/footer', $data);
		}
	}

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

	public function check_password($param1 = '', $param2 = '') {
		if($param1 && $param2) {
			if($param1 == $param2) {
				echo '<span class="text-success small">Password Matched</span>';
			} else {
				echo '<span class="text-danger small">Password Not Matched</span>';
			}
			die;
		}
	}

	public function terms($param1 = '') {
		//echo $param1;
		if($param1) {
			echo '<button type="submit" class="btn btn-warning btn-rounded">sign Up</button>';
		} else {
			echo '<button type="submit" class="btn btn-warning btn-rounded" disabled>sign Up</button>';
		}
	}

	public function login() {
		if(!empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('dashboard'), 'refresh');
		}

		$table = 'user';
		if($_POST) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			if(!$email || !$password) {
				echo $this->Crud->msg('danger', 'All Fields are Required');
			} else {
				$user = $this->Crud->read2('email', $email, 'password', md5($password), $table);
				if(empty($user)) {
					echo $this->Crud->msg('danger', 'Authentication Failed');
				} else {
					
						$user_id = $this->Crud->read_field('email', $email, $table, 'id');
						$up_data['log_date'] = date(fdate);
						$up_data['status'] = 1;
						$this->Crud->update('id', $user_id, $table, $up_data);

						// save user_id in session
						$this->session->set_userdata('sc_user_id', $user_id);
						
						echo $this->Crud->msg('success', 'Login Successful');

						// redirect
						echo '<script>window.location.replace("'.base_url('dashboard').'");</script>';
						
				
				}
			}

			die;
		}

		
		$data['title'] = 'Login | '.app_name;
		$this->load->view('login', $data);
	}

	public function logout() {
		if(!empty($this->session->userdata('sc_user_id'))) {
			$user_id = $this->session->userdata('sc_user_id');
			$up_data['status'] = 0;
			if($this->Crud->update('id', $user_id, 'user', $up_data) > 0) {
				$this->session->set_userdata('sc_user_id', '');
				$this->session->sess_destroy();
				$this->Crud->msg('success', 'Sign Out Successfully');
			}
		}
		//$name = ucwords($this->Crud->read_field('id', 1, 'settings', 'title'));
		
		$data['title'] = 'Sign Out | '.app_name;
		$this->load->view('login', $data);
	}

	public function dashboard()	{
		if(empty($this->session->userdata('co_customer_id'))) {
			redirect(base_url('customer_login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('co_customer_id');
		}
		$name = ucwords($this->Crud->read_field('id', 1, 'settings', 'title'));
		$data['title'] = 'Customer Dashboard | '.$name;
		$data['page_active'] = 'dashboard';
		$this->load->view('designs/header', $data);
		$this->load->view('customer/dashboard', $data);
		$this->load->view('designs/footer', $data);
		
	}

}