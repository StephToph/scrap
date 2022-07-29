<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scrap extends CI_Controller {

	/////////////////// Scrap Category Manage Script Start////////////////////////
	public function category($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'category';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'scrap/category/'.$param1;
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
								$data['e_description'] = $e->description;
								$data['e_extra'] = $e->extra;
								

							}
						}
					}
				}
				
				if($_POST){
					$id = $this->input->post('id');
					$code = $this->input->post('code');
					$description = $this->input->post('description');
					$extra = $this->input->post('extra');
							 
					// do create or update
					if($id) {
						$upd_data['code'] = $code;
						$upd_data['description'] = $description;
						$upd_data['extra'] = $extra;
							
						$upd_rec = $this->Crud->update('id', $id, $table, $upd_data);
						if($upd_rec > 0) {
							echo $this->Crud->msg('success', 'Record Updated' );
							echo '<script>location.reload(false);</script>';
						} else {
							echo $this->Crud->msg('info','No Changes' );	
						}

					} else {
						if($this->Crud->check('code', $code, $table) > 0) {
							echo $this->Crud->msg('warning', 'Record Already Exist' );
						} else {
							$ins_data['code'] = $code;
							$ins_data['description'] = $description;
							$ins_data['extra'] = $extra;
							
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
			$table = 'category';
			$column_order = array('code', 'description', 'extra');
			$column_search = array('code', 'description', 'extra');
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
				$description = $item->description;
				$extra = $item->extra;
				
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				// edit 
				$edit_btn = '
					<a class="text-primary pop" href="javascript:;" pageTitle="Edit Record" pageName="'.base_url('scrap/category/manage/edit/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="Edit">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('scrap/category/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="Delete">
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
				$row[] = strtoupper($code);
				$row[] = $description;
				$row[] = strtoupper($extra);		
				
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
			$this->load->view('scrap/category_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'scrap/category/list'; // ajax table url
			$data['order_sort'] = '0, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '3'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Scrap Category | '.app_name;
			$data['page_active'] = 'company';
			$this->load->view('designs/header', $data);
			$this->load->view('scrap/category', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////

	/////////////////// Scrap Location Manage Script Start////////////////////////
	public function prepared($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'prepared';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'scrap/prepared/'.$param1;
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
			$table = 'prepared';
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
					<a class="text-primary pop" href="javascript:;" pageTitle="Edit Record" pageName="'.base_url('scrap/prepared/manage/edit/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="Edit">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('scrap/prepared/manage/delete/'.$id).'" pageSize="modal-sm" data-toggle="tooltip" title="Delete">
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
				$row[] = strtoupper($name);
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
			$this->load->view('scrap/prepared_form', $data);
		} else {
			// for datatable
			$data['table_rec'] = 'scrap/prepared/list'; // ajax table url
			$data['order_sort'] = '0, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '2'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Prepared | '.app_name;
			$data['page_active'] = 'prepared';
			$this->load->view('designs/header', $data);
			$this->load->view('scrap/prepared', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////

	/////////////////////Add New Daily Record View///////////////////
	public function new()	{
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$data['title'] = 'Daily Record | '.app_name;
		$data['page_active'] = 'daily';
		$this->load->view('designs/header', $data);
		$this->load->view('scrap/new', $data);
		//$this->load->view('designs/footer', $data);
		
	}
	/////////////////////End/////////////////////////////////////////////

	////////////////////////////Script to Add New Scrap Record//////////////////
	public function add(){

		$table = 'scrap';
		if ($_POST) {
			$customer_id = $this->input->post('customer_id');
			$vehicle = $this->input->post('vehicle');
			$slip_no = $this->input->post('slip_no');
			$commission = $this->input->post('commission');
			$date = $this->input->post('date');
			$cat1 = $this->input->post('cat1');
			$qty1 = $this->input->post('qty1');
			$cat2 = $this->input->post('cat2');
			$qty2 = $this->input->post('qty2');
			$price2 = $this->input->post('price2');
			$amount2 = $this->input->post('amount2');
			$cat3 = $this->input->post('cat3');
			$qty3 = $this->input->post('qty3');
			$price3 = $this->input->post('price3');
			$amount3 = $this->input->post('amount3');
			$cat4 = $this->input->post('cat4');
			$qty4 = $this->input->post('qty4');
			$price4 = $this->input->post('price4');
			$amount4 = $this->input->post('amount4');
			$cat5 = $this->input->post('cat5');
			$qty5 = $this->input->post('qty5');
			$price5 = $this->input->post('price5');
			$amount5 = $this->input->post('amount5');
			$prepared_by = $this->input->post('prepared_by');
			$supplied_to = $this->input->post('supplied_to');
			$remark = $this->input->post('remark');
			$netp_dust = $this->input->post('netp_dust');
			$netm_dust = $this->input->post('netm_dust');
			$comp_amountc = $this->input->post('comp_amountc');
			$comm_amountc = $this->input->post('comm_amountc');
			$comp_amount = $this->input->post('comp_amount');
			$comm_amount = $this->input->post('comm_amount');
			$dash_amount = $this->input->post('dash_amount');
			$dust_amount = $this->input->post('dust_amount');
			$gross = $this->input->post('gross');
			$tare = $this->input->post('tare');
			$shortage = $this->input->post('shortage');
			$month = $this->input->post('monh');
			$direct_advance = $this->input->post('direct_advance');
			$driver_advance = $this->input->post('driver_advance');
			$offloading = $this->input->post('offloading');
			$revenue = $this->input->post('revenue');
			$escort = $this->input->post('escort');
			$customer_rep = $this->input->post('customer_rep');
			$balance_paid = $this->input->post('balance_paid');
			$total_deduction = $this->input->post('total_deduction');
			$close_balance = $this->input->post('close_balance');
			$user_id = $this->session->userdata('sc_user_id');

			if ($this->Crud->check3('customer_id', $customer_id, 'vehicle_no', $vehicle, 'date', $date, 'scrap') > 0) {
				echo $this->Crud->msg('warning', 'Record Already Exist');
			} else {
				if (($cat2 != '') || ($cat3 != '') || ($cat4 != '') || ($cat5 != '')) {
					if (($cat2 != '' and $cat3 != '') and $cat2 == $cat3) {
						echo $this->Crud->msg('info', 'You cannot select the same Value for Category 2 and Category 3');
					} elseif (($cat2 != '' and $cat4 != '') and $cat2 == $cat4) {
						echo $this->Crud->msg('info', 'You cannot select the same Value for Category 2 and Category 4');
					} elseif (($cat2 != '' and $cat5 != '') and $cat2 == $cat5) {
						echo $this->Crud->msg('info', 'You cannot select the same Value for Category 2 and Category 5');
					} elseif (($cat3 != '' and $cat4 != '') and $cat3 == $cat4) {
						echo $this->Crud->msg('info', 'You cannot select the same Value for Category 3 and Category 4');
					} elseif (($cat3 != '' and $cat5 != '') and $cat3 == $cat5) {
						echo $this->Crud->msg('info', 'You cannot select the same Value for Category 3 and Category 5');
					} elseif (($cat4 != '' and $cat5 != '') and $cat4 == $cat5) {
						echo $this->Crud->msg('info', 'You cannot select the same Value for Category 4 and Category 5');
					} else {
						$ins_data['customer_id'] = $customer_id;
						$ins_data['scrap_id'] = 'PC-1000000';
						$ins_data['date'] = $date;
						$ins_data['slip_no'] = $slip_no;
						$ins_data['vehicle_no'] = $vehicle;
						$ins_data['commission'] = $commission;
						$ins_data['cat1'] = $cat1;
						$ins_data['cat2'] = $cat2;
						$ins_data['cat3'] = $cat3;
						$ins_data['cat4'] = $cat4;
						$ins_data['cat5'] = $cat5;
						$ins_data['qty1'] = $qty1;
						$ins_data['qty2'] = $qty2;
						$ins_data['qty3'] = $qty3;
						$ins_data['qty4'] = $qty4;
						$ins_data['qty5'] = $qty5;
						$ins_data['price2'] = $price2;
						$ins_data['price3'] = $price3;
						$ins_data['price4'] = $price4;
						$ins_data['price5'] = $price5;
						$ins_data['amount2'] = $amount2;
						$ins_data['amount3'] = $amount3;
						$ins_data['amount4'] = $amount4;
						$ins_data['amount5'] = $amount5;
						$ins_data['comm_amountc'] = $comm_amountc;
						$ins_data['comp_amountc'] = $comp_amountc;
						$ins_data['comm_amount'] = $comm_amount;
						$ins_data['comp_amount'] = $comp_amount;
						$ins_data['prepared_by'] = $prepared_by;
						$ins_data['supplied_to'] = $supplied_to;
						$ins_data['remark'] = $remark;
						$ins_data['netm_dust'] = $netm_dust;
						$ins_data['netp_dust'] = $netp_dust;
						$ins_data['dash_amount'] = $dash_amount;
						$ins_data['dust_amount'] = $dust_amount;
						$ins_data['gross'] = $gross;
						$ins_data['tare'] = $tare;
						$ins_data['shortage'] = $shortage;
						$ins_data['branch'] = 1;
						$ins_data['staff_id'] = $user_id;

						$in_data['month'] = $month;
						$in_data['direct_advance'] = $direct_advance;
						$in_data['driver_advance'] = $driver_advance;
						$in_data['offloading'] = $offloading;
						$in_data['revenue'] = $revenue;
						$in_data['escort'] = $escort;
						$in_data['custom_rep'] = $customer_rep;
						$in_data['balance_paid'] = $balance_paid;
						$in_data['total_deduction'] = $total_deduction;
						$in_data['close_bal'] = $close_balance;
						$in_data['scrap_id'] = 'PC-1000000';
						
						$sid = '1000000';
						$ins_rec = $this->Crud->create($table, $ins_data);
						$in_rec = $this->Crud->create('scrap_pay', $in_data);
						if($ins_rec > 0) {
							$scrap_id = $sid + $ins_rec;
							$scap = 'PC-'.($scrap_id);
							$upd_data['scrap_id'] = $scap;
							$this->Crud->update('id', $ins_rec, $table, $upd_data);
							$this->Crud->update('id', $in_rec, 'scrap_pay', $upd_data);
							echo $this->Crud->msg('success', 'Record Created <br> '.$scap.'');
							echo '<script>setTimeout(function(){location.reload(true);}, 5000);</script>';
						} else {
							echo $this->Crud->msg('danger', 'Please Try Later');	
						}
					}
				}
			}
		}
	}
	//////////////////////End//////////////////////////////////////////////

	
	/////////////////// Scrap Category Manage Script Start////////////////////////
	public function index($param1='', $param2='', $param3='') {
		if(empty($this->session->userdata('sc_user_id'))) {
			redirect(base_url('login'), 'refresh');
		} else {
			$log_user_id = $this->session->userdata('sc_user_id');
		}
		
		$table = 'scrap';
		
		// pass parameters to view
		$data['param1'] = $param1;
		$data['param2'] = $param2;
		$data['param3'] = $param3;
		$form_url = 'scrap/index/'.$param1;
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
								$data['e_customer_id'] = $e->customer_id;
								$data['e_vehicle_no'] = $e->vehicle_no;
								$data['e_slip_no'] = $e->slip_no;
								$data['e_commission'] = $e->commission;
								$data['e_date'] = $e->date;
								$data['e_cat1'] = $e->cat1;
								$data['e_qty1'] = $e->qty1;
								$data['e_cat2'] = $e->cat2;
								$data['e_qty2'] = $e->qty2;
								$data['e_price2'] = $e->price2;
								$data['e_amount2'] = $e->amount2;
								$data['e_cat3'] = $e->cat3;
								$data['e_qty3'] = $e->qty3;
								$data['e_price3'] = $e->price3;
								$data['e_amount3'] = $e->amount3;
								$data['e_cat4'] = $e->cat4;
								$data['e_qty4'] = $e->qty4;
								$data['e_price4'] = $e->price4;
								$data['e_amount4'] = $e->amount4;
								$data['e_cat5'] = $e->cat5;
								$data['e_qty5'] = $e->qty5;
								$data['e_price5'] = $e->price5;
								$data['e_amount5'] = $e->amount5;
								$data['e_supplied_to'] = $e->supplied_to;
								$data['e_prepared_by'] = $e->prepared_by;
								$data['e_remark'] = $e->remark;
								$data['e_netp_dust'] = $e->netp_dust;
								$data['e_netm_dust'] = $e->netm_dust;
								$data['e_comp_amountc'] = $e->comp_amountc;
								$data['e_comm_amountc'] = $e->comm_amountc;
								$data['e_comp_amount'] = $e->comp_amount;
								$data['e_comm_amount'] = $e->comm_amount;
								$data['e_dash_amount'] = $e->dash_amount;
								$data['e_dust_amount'] = $e->dust_amount;
								$data['e_shortage'] = $e->shortage;
								$data['e_gross'] = $e->gross;
								$data['e_tare'] = $e->tare;
								$data['e_scrap_id'] = $e->scrap_id;
								

							}
						}
					}
				}

				if ($param2 == 'view') {
					if ($param3) {
						$data['id'] = $param3;
						$data['title'] = 'SGR Report';
						$this->load->view('scrap/test', $data);
					}
				}
				
				
			}
		}

		// record listing
		if($param1 == 'list') {
			// DataTable parameters
			$table = 'scrap';
			$column_order = array('date', 'scrap_id', 'supplied_to', 'customer_id', 'vehicle_no', 'netm_dust', 'qty1');
			$column_search = array('date', 'scrap_id', 'supplied_to', 'customer_id', 'vehicle_no', 'netm_dust', 'qty1');
			$order = array('id' => 'desc');
			$where = '';
			
			// load data into table
			$list = $this->Crud->datatable_load($table, $column_order, $column_search, $order, $where);
			$data = array();
			// $no = $_POST['start'];
			$count = 1;
			foreach ($list as $item) {
				$ids = $item->id;
				$date = $item->date;
				$scrap_id = $item->scrap_id;
				$supplied_to = $item->supplied_to;
				$customer_id = $item->customer_id;
				$vehicle_no = $item->vehicle_no;
				$netm_dust = $item->netm_dust;
				$qty1 = $item->qty1;
				
				$id = $this->Crud->read_field('id', $this->session->userdata('sc_user_id'), 'user', 'user_id');
				// add scripts to last record
				if($count == count($list)){
					$script = '<script src="'.base_url('assets/jsform.js').'"></script>';
				} else {$script = '';}
				
				// edit 
				$edit_btn = '
					<a class="text-primary" href="'.base_url('scrap/index/manage/edit/'.$ids).'" data-toggle="tooltip" title="Edit Record">
						<i class="icon-pencil fa-1x"></i>
					</a>
				';
				// edit 
				$view_btn = '
					<a class="text-success"  href="'.base_url('scrap/index/manage/view/'.$ids).'" data-toggle="tooltip" title="Print Record">
						<i class="icon-printer fa-1x"></i>
					</a>
				';
				
				// delete 
				$del_btn = '
					<a class="text-danger pop" href="javascript:;" pageTitle="Delete Record" pageName="'.base_url('scrap/index/manage/delete/'.$ids).'" pageSize="modal-sm" data-toggle="tooltip" title="Delete Record">
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
				$row[] = $scrap_id;
				$row[] = strtoupper($this->Crud->read_field('code', $supplied_to, 'company', 'name'));		
				$row[] = strtoupper($this->Crud->read_field('customer_id', $customer_id, 'customer', 'surname').' '.$this->Crud->read_field('customer_id', $customer_id, 'customer', 'firstname'));		
				$row[] = strtoupper($vehicle_no);		
				$row[] = number_format($netm_dust, 2);
				$row[] = $qty1;
				$row[] = strtoupper($this->Crud->read_field('staff_id', $id, 'staff', 'surname').' '.$this->Crud->read_field('staff_id', $id, 'staff', 'firstname'));
				
				
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
			$this->load->view('scrap/manage_form', $data);
			if ($param2 == 'edit') {
				 $data['title'] = 'Edit Scrap Directory | '.app_name;
		        $data['page_active'] = 'directory';
		        $this->load->view('designs/header', $data);
		        $this->load->view('scrap/edit_scrap', $data); // insert/edit view 
		        
			}
		} else {
			// for datatable
			$data['table_rec'] = 'scrap/index/list'; // ajax table url
			$data['order_sort'] = '1, "desc"'; // default ordering (0, 'asc')
			$data['no_sort'] = '8'; // sort disable columns (1,3,5)

			//$data['user'] = $account_name;
			$data['title'] = 'Scrap Directory | '.app_name;
			$data['page_active'] = 'company';
			$this->load->view('designs/header', $data);
			$this->load->view('scrap/manage', $data);
			$this->load->view('designs/footer', $data);
		}
	}
	/////////////////////////////End////////////////////////////////////////////

	public function edit_scrap(){
		$table = 'scrap';
		if ($_POST) {
			$customer_id = $this->input->post('customer_id');
			$vehicle = $this->input->post('vehicle');
			$slip_no = $this->input->post('slip_no');
			$commission = $this->input->post('commission');
			$date = $this->input->post('date');
			$cat1 = $this->input->post('cat1');
			$qty1 = $this->input->post('qty1');
			$cat2 = $this->input->post('cat2');
			$qty2 = $this->input->post('qty2');
			$price2 = $this->input->post('price2');
			$amount2 = $this->input->post('amount2');
			$cat3 = $this->input->post('cat3');
			$qty3 = $this->input->post('qty3');
			$price3 = $this->input->post('price3');
			$amount3 = $this->input->post('amount3');
			$cat4 = $this->input->post('cat4');
			$qty4 = $this->input->post('qty4');
			$price4 = $this->input->post('price4');
			$amount4 = $this->input->post('amount4');
			$cat5 = $this->input->post('cat5');
			$qty5 = $this->input->post('qty5');
			$price5 = $this->input->post('price5');
			$amount5 = $this->input->post('amount5');
			$prepared_by = $this->input->post('prepared_by');
			$supplied_to = $this->input->post('supplied_to');
			$remark = $this->input->post('remark');
			$netp_dust = $this->input->post('netp_dust');
			$netm_dust = $this->input->post('netm_dust');
			$comp_amountc = $this->input->post('comp_amountc');
			$comm_amountc = $this->input->post('comm_amountc');
			$comp_amount = $this->input->post('comp_amount');
			$comm_amount = $this->input->post('comm_amount');
			$dash_amount = $this->input->post('dash_amount');
			$dust_amount = $this->input->post('dust_amount');
			$gross = $this->input->post('gross');
			$tare = $this->input->post('tare');
			$shortage = $this->input->post('shortage');
			$month = $this->input->post('monh');
			$direct_advance = $this->input->post('direct_advance');
			$driver_advance = $this->input->post('driver_advance');
			$offloading = $this->input->post('offloading');
			$revenue = $this->input->post('revenue');
			$escort = $this->input->post('escort');
			$scrap_id = $this->input->post('scrap_id');
			$id = $this->input->post('id');
			$customer_rep = $this->input->post('customer_rep');
			$balance_paid = $this->input->post('balance_paid');
			$total_deduction = $this->input->post('total_deduction');
			$close_balance = $this->input->post('close_balance');
			$user_id = $this->session->userdata('sc_user_id');

			if ($id) {
				if (($cat2 != '') || ($cat3 != '') || ($cat4 != '') || ($cat5 != '')) {
					if (($cat2 != '' and $cat3 != '') and $cat2 == $cat3) {
						echo $this->Crud->msg('info', 'You cannot select the same Value for Category 2 and Category 3');
					} elseif (($cat2 != '' and $cat4 != '') and $cat2 == $cat4) {
						echo $this->Crud->msg('info', 'You cannot select the same Value for Category 2 and Category 4');
					} elseif (($cat2 != '' and $cat5 != '') and $cat2 == $cat5) {
						echo $this->Crud->msg('info', 'You cannot select the same Value for Category 2 and Category 5');
					} elseif (($cat3 != '' and $cat4 != '') and $cat3 == $cat4) {
						echo $this->Crud->msg('info', 'You cannot select the same Value for Category 3 and Category 4');
					} elseif (($cat3 != '' and $cat5 != '') and $cat3 == $cat5) {
						echo $this->Crud->msg('info', 'You cannot select the same Value for Category 3 and Category 5');
					} elseif (($cat4 != '' and $cat5 != '') and $cat4 == $cat5) {
						echo $this->Crud->msg('info', 'You cannot select the same Value for Category 4 and Category 5');
					} else {
						$ins_data['customer_id'] = $customer_id;
						//$ins_data['scrap_id'] = 'PC-1000000';
						$ins_data['date'] = $date;
						$ins_data['slip_no'] = $slip_no;
						$ins_data['vehicle_no'] = $vehicle;
						$ins_data['commission'] = $commission;
						$ins_data['cat1'] = $cat1;
						$ins_data['cat2'] = $cat2;
						$ins_data['cat3'] = $cat3;
						$ins_data['cat4'] = $cat4;
						$ins_data['cat5'] = $cat5;
						$ins_data['qty1'] = $qty1;
						$ins_data['qty2'] = $qty2;
						$ins_data['qty3'] = $qty3;
						$ins_data['qty4'] = $qty4;
						$ins_data['qty5'] = $qty5;
						$ins_data['price2'] = $price2;
						$ins_data['price3'] = $price3;
						$ins_data['price4'] = $price4;
						$ins_data['price5'] = $price5;
						$ins_data['amount2'] = $amount2;
						$ins_data['amount3'] = $amount3;
						$ins_data['amount4'] = $amount4;
						$ins_data['amount5'] = $amount5;
						$ins_data['comm_amountc'] = $comm_amountc;
						$ins_data['comp_amountc'] = $comp_amountc;
						$ins_data['comm_amount'] = $comm_amount;
						$ins_data['comp_amount'] = $comp_amount;
						$ins_data['prepared_by'] = $prepared_by;
						$ins_data['supplied_to'] = $supplied_to;
						$ins_data['remark'] = $remark;
						$ins_data['netm_dust'] = $netm_dust;
						$ins_data['netp_dust'] = $netp_dust;
						$ins_data['dash_amount'] = $dash_amount;
						$ins_data['dust_amount'] = $dust_amount;
						$ins_data['gross'] = $gross;
						$ins_data['tare'] = $tare;
						$ins_data['shortage'] = $shortage;
						$ins_data['branch'] = 1;
						$ins_data['staff_id'] = $user_id;

						$in_data['month'] = $month;
						$in_data['direct_advance'] = $direct_advance;
						$in_data['driver_advance'] = $driver_advance;
						$in_data['offloading'] = $offloading;
						$in_data['revenue'] = $revenue;
						$in_data['escort'] = $escort;
						$in_data['custom_rep'] = $customer_rep;
						$in_data['balance_paid'] = $balance_paid;
						$in_data['total_deduction'] = $total_deduction;
						$in_data['close_bal'] = $close_balance;
						//$in_data['scrap_id'] = 'PC-1000000';
						
						$ins_rec = $this->Crud->update('id', $id, $table, $ins_data);
						if($ins_rec > 0) {
							$this->Crud->update('scrap_id', $scrap_id, 'scrap_pay', $in_data);
							echo $this->Crud->msg('success', 'Record Updated');
							echo '<script>window.location.replace("'.base_url('scrap').'");</script>';
						} else {
							echo $this->Crud->msg('danger', 'Please Try Later');	
						}
					}
				}
			}
		}
	}

}
