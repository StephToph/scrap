<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php echo $title; ?></title>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.ico">
	<link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon">

	<!-- Custom CSS -->
	<link href="<?php echo base_url(); ?>assets/dist/css/style.css" rel="stylesheet" type="text/css">
	
</head>

<body>
	<!--Preloader-->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!--/Preloader-->
    <div class="wrapper  ">
		<!-- Right Sidebar Backdrop -->
		
		<!-- Main Content -->
		<div class="pagewrapper">
			<div class="containerfluid">
				<div class="row">
					<!-- Basic Table -->
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap mt-0">
										<div class="table-responsive">
											<table class="table mb-0">
												<thead>
												  <tr bgcolor="#e6b034 ">
													<td width="100px"><img src="<?php echo base_url('assets/logo.png'); ?>"></td>
													<td align="center" >
														<h3 style="color: white">A UMAR GLOBAL SERVICES LTD.</h3>
														<h6 style="color: white"><i>Dealer and Supplier of all kind of Metals</i></h6>
													</td>
													<td align="right" width="200" style="color: white"><b>
														Generated:<br><?php echo date("F j, Y, g:ia"); ?><br></b>
														<a href="javascript:;" onClick="printdoc();" style="font-family:Georgia, 'Times New Roman', Times, serif; color:#fff;"><b>Print Report</b></a>

													</td>
												  </tr>
												</thead>
											</table>
											<table class="table mb-0">
												<thead>
												  <tr>
													<td align=""><b>HEAD OFFICE:</b><br/>
							                            African Steel Plot 329,<br/>
							                            Odogunyan, Ikorodu, Lagos
							                        </td>
													<td align="ceter">
														<b>WORK TIME:</b><br/>
							                            Monday - Friday<br/>
							                            09:00 am to 06:00 pm
													</td>
													<td align="left">
														<b>TELEPHONES:</b><br/>
							                            +234 802 710 4353, +234 806 261 6980,<br/>
							                            +234 805 917 6111
													</td>
												  </tr>
												</thead>
											</table>
											<hr class="hr" style="color: #e6b034">
											<h5 class="txt-dark capitalize-font" align="center">SGR Report</h5>
											<hr class="light-grey-hr">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<div class="panel panel-default card-view">
													<div class="panel-wrapper collapse in">
														<div class="panel-body">
															<table class="table-responsive table mb-0"> 
																<thead style="color: black;">
																	<tr>
																		<td align="left"><h6>Received Date:</h6> <?php echo $this->Crud->read_field('id', $param3, 'scrap', 'date'); ?></td>
																		<td align="right"><h6>Code:</h6> <?php echo $this->Crud->read_field('id', $param3, 'scrap', 'scrap_id'); ?></td>
																	</tr>
																	<tr>
																		<td width="50%">
																			<table class="tableresponsive ">
																				<tr>
																					<td width="150px"><b>Customer:</b></td>
																					<td><?php $id= $this->Crud->read_field('id', $param3, 'scrap', 'customer_id');

																					 echo strtoupper($this->Crud->read_field('customer_id', $id, 'customer', 'surname').' '.$this->Crud->read_field('customer_id', $id, 'customer', 'firstname')); ?></td>
																				</tr>
																				<tr>
																					<td><b>Company:</b></td>
																					<td><?php echo $this->Crud->read_field('id', $param3, 'scrap', 'supplied_to'); ?></td>
																				</tr>
																				<tr>
																					<td><b>Commision:</b></td>
																					<td>&#8358; <?php echo number_format($this->Crud->read_field('id', $param3, 'scrap', 'commission'), 2);?></td>
																				</tr>
																				<tr>
																					<td><b>Vehicle Number:</b></td>
																					<td><?php echo strtoupper($this->Crud->read_field('id', $param3, 'scrap', 'vehicle_no')); ?></td>
																				</tr>
																				<tr>
																					<td><b>Slip Number:</b></td>
																					<td><?php echo $this->Crud->read_field('id', $param3, 'scrap', 'slip_no'); ?></td>
																				</tr>
																			</table>
																		</td>
																		<td></td>
																	</tr>
																	<tr>
																		<td>
																			<hr class="" style="color: black">
																			<h6 class="txt-dark capitalize-font">SCRAP DETAILS</h6>
																			<table class="table table-hovr table-bordered mb-0">
																				<tr>
																					<td width="200px"><b>Prepared By:</b></td>
																					<td><?php echo strtoupper($this->Crud->read_field('id', $param3, 'scrap', 'prepared_by')); ?></td>
																				</tr>
																				<tr>
																					<td><b>Supplied By:</b></td>
																					<td><?php $id = $this->Crud->read_field('id', $param3, 'scrap', 'supplied_to');
																						echo strtoupper($this->Crud->read_field('code', $id, 'company', 'name'));
																					 ?></td>
																				</tr>
																				<tr>
																					<td><b>Qty + Dust:</b></td>
																					<td><?php echo $this->Crud->read_field('id', $param3, 'scrap', 'netp_dust'); ?></td>
																				</tr>
																				<tr>
																					<td><b>Qty - Dust:</b></td>
																					<td><?php echo $this->Crud->read_field('id', $param3, 'scrap', 'netm_dust'); ?></td>
																				</tr>
																				<tr>
																					<td><b>Company Amount:</b></td>
																					<td>&#8358; <?php echo $this->Crud->read_field('id', $param3, 'scrap', 'comp_amount'); ?></td>
																				</tr>
																				<tr>
																					<td><b>AUG Amount:</b></td>
																					<td>&#8358; <?php echo number_format($this->Crud->read_field('id', $param3, 'scrap', 'comm_amount'), 2); ?></td>
																				</tr>
																				<tr>
																					<td><b>Shortage:</b></td>
																					<td>&#8358; <?php echo $this->Crud->read_field('id', $param3, 'scrap', 'shortage'); ?></td>
																				</tr>
																				<tr>
																					<td><b>Dash Amount:</b></td>
																					<td>&#8358; <?php echo number_format($this->Crud->read_field('id', $param3, 'scrap', 'dash_amount'), 2); ?></td>
																				</tr>
																				<tr>
																					<td><b>Dust Amount:</b></td>
																					<td>&#8358; <?php echo number_format($this->Crud->read_field('id', $param3, 'scrap', 'dust_amount'), 2); ?></td>
																				</tr>
																				<tr>
																					<td><b>Gross Weight (G/W):</b></td>
																					<td><?php echo number_format($this->Crud->read_field('id', $param3, 'scrap', 'gross'), 2); ?> Kg</td>
																				</tr>
																				<tr>
																					<td><b>Tare Weight (T/W):</b></td>
																					<td><?php echo number_format($this->Crud->read_field('id', $param3, 'scrap', 'tare'), 2); ?> Kg</td>
																				</tr>
																				<tr>
																					<td><b>Remark:</b></td>
																					<td><?php echo $this->Crud->read_field('id', $param3, 'scrap', 'remark'); ?></td>
																				</tr>
																			</table>
																		</td>
																		<td>
																			<hr class="" style="color: black">
																			<h6 class="txt-dark capitalize-font">PAYMENT CATEGORY</h6>
																			<table class="table table-hovr table-bordered mb-0">
																				<tr>
																					<td width="200px"><b>Month:</b></td>
																					<td><?php $id = $this->Crud->read_field('id', $param3, 'scrap', 'scrap_id'); 
																						echo $this->Crud->read_field('scrap_id', $id, 'scrap_pay', 'month');
																					?></td>
																				</tr>
																				<tr>
																					<td><b>Direct Advance:</b></td>
																					<td>&#8358; <?php echo number_format( $this->Crud->read_field('scrap_id', $id, 'scrap_pay', 'direct_advance'), 2); ?></td>
																				</tr>
																				<tr>
																					<td><b>Driver Advance:</b></td>
																					<td>&#8358; <?php echo number_format( $this->Crud->read_field('scrap_id', $id, 'scrap_pay', 'driver_advance'), 2); ?></td>
																				</tr>
																				<tr>
																					<td><b>Offloading:</b></td>
																					<td>&#8358; <?php echo number_format( $this->Crud->read_field('scrap_id', $id, 'scrap_pay', 'offloading'), 2); ?></td>
																				</tr>
																				<tr>
																					<td><b>Revenue:</b></td>
																					<td>&#8358; <?php echo number_format( $this->Crud->read_field('scrap_id', $id, 'scrap_pay', 'revenue'), 2); ?></td>
																				</tr>
																				<tr>
																					<td><b>Escort/Police:</b></td>
																					<td>&#8358; <?php echo number_format( $this->Crud->read_field('scrap_id', $id, 'scrap_pay', 'escort'), 2); ?></td>
																				</tr>
																				<tr>
																					<td><b>Customer Representation:</b></td>
																					<td>&#8358; <?php echo number_format( $this->Crud->read_field('scrap_id', $id, 'scrap_pay', 'custom_rep'), 2); ?></td>
																				</tr>
																				<tr>
																					<td style="background-color:#ddd;"><b>TOTAL DEDUCTION:</b></td>
																					<td style="background-color:#ddd;">&#8358; <?php echo number_format( $this->Crud->read_field('scrap_id', $id, 'scrap_pay', 'total_deduction'), 2); ?></td>
																				</tr>
																				<tr>
																					<td style="background-color:#ddd;"><b>CLOSE BALANCE:</b></td>
																					<td style="background-color:#ddd;">&#8358; <?php echo number_format( $this->Crud->read_field('scrap_id', $id, 'scrap_pay', 'close_bal'), 2); ?></td>
																				</tr>
																				<tr>
																					<td style="background-color:#ddd;"><b>BALANCE PAID:</b></td>
																					<td style="background-color:#ddd;">&#8358; <?php echo number_format( $this->Crud->read_field('scrap_id', $id, 'scrap_pay', 'balance_paid'), 2); ?></td>
																				</tr>
																				
																				<tr>
																					<td style="background-color:#ddd;"><b>BALANCE PAID + DUST AMT.:</b></td>
																					<td style="background-color:#ddd;">&#8358; <?php echo number_format(($this->Crud->read_field('scrap_id', $id, 'scrap_pay', 'balance_paid') + $this->Crud->read_field('id', $param3, 'scrap', 'dust_amount')), 2); ?></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</thead>
															</table>
														</div>
													</div>
												</div>
											</div>
											<hr class="light-grey-hr">
											<i>This document should be treated as confidencial</i> | <a href="javascript:;" onClick="printdoc();"><b>Print SGR</b></a> | <a class="text-primary" href="<?php echo base_url('scrap'); ?>" data-toggle="tooltip" title="Go Back"><i class=" icon-arrow-left-circle fa-1x"></i></a>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Basic Table -->
				</div>
				
			</div>
		</div>
		<!-- /Main Content -->

    </div>
    <!-- /#wrapper -->
	
	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/dist/js/jquery.slimscroll.js"></script>
	
	<!-- Piety JavaScript -->
	<script src="<?php echo base_url(); ?>assets/vendors/bower_components/peity/jquery.peity.min.js"></script>
	
	<!-- Init JavaScript -->
	<script src="<?php echo base_url(); ?>assets/dist/js/init.js"></script>
	
</body>

</html>
