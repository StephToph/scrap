<!-- Title -->
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	  <h5 class="txt-dark">Report</h5>
	</div>
	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	  <ol class="breadcrumb">
		<li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
		<li class="active"><span>Scrap Report</span></li>
	  </ol>
	</div>
	<!-- /Breadcrumb -->
</div>
<!-- /Title -->
<!-- Row -->
<div class="row">
	<div class="col-lg-12 col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark">Scrap Tracking Report</h6>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<p class="text-info"><marquee>Enter Details to Generate Report</marquee></p>
					<div class="tab-struct vertical-tab custom-tab-1 mt-40">
						<ul role="tablist" class="nav nav-tabs ver-nav-tab" id="myTabs_8" style="min-height: 170px;">
							<li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="home_tab_8" href="#home_8"><h6 class="txt-dark capitalize-font"><i class="icon-calender mr-10"></i>SGR Report by Date</h6></a></li>
							<li role="presentation" class=""><a data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><h6 class="txt-dark capitalize-font"><i class="icon-people mr-10"></i>SGR Report by Customer</h6></a></li>
							<li role="presentation" class=""><a data-toggle="tab" id="rofile_tab_8" role="tab" href="#rofile_8" aria-expanded="false"><h6 class="txt-dark capitalize-font"><i class="icon-book-open mr-10"></i>SGR Report by Register</h6></a></li>
							<li role="presentation" class=""><a data-toggle="tab" id="pofile_tab_8" role="tab" href="#pofile_8" aria-expanded="false"><h6 class="txt-dark capitalize-font"><i class="fa fa-bank mr-10"></i>SGR Report by Company</h6></a></li>
							<li role="presentation" class=""><a data-toggle="tab" id="ofile_tab_8" role="tab" href="#ofile_8" aria-expanded="false"><h6 class="txt-dark capitalize-font"><i class="ti-car mr-10"></i>DPO (Driver Payment Operator) Report</h6></a></li>
							
						</ul>
						<div class="tab-content" id="myTabContent_8" style="min-height: 170px;">
							<div id="home_8" class="tab-pane fade active in" role="tabpanel">
								<div class="form-body">
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label class="control-label mb-10">Date From</label>
												<input type="date" id="date_from" name="date_from" class="form-control" required>
											</div>
										</div> 
										<!--/span-->
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">Date to</label>
												<input type="date" id="date_to" name="date_to" class="form-control" required>
											</div>
										</div>

										<div class="col-md-3">
											<label class="control-label mb-10">.</label><br>
											<button class="btn btn-success btn-rounded btn-block btn-anim" id="btn-date"><i class="icon-magnifier"></i><span class="btn-text">GENERATE</span></button>
										</div>
										
										<!--/span-->
									</div><div id="date_response" align="center"></div>
									
								</div>
							</div>
							<div id="profile_8" class="tab-pane fade" role="tabpanel">
								<div class="form-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">Customer</label>
												<select class="form-control select2" name="customer_id" id="customer_id" required oninvalid="this.setCustomValidity('Please Select a Customer')" onchange="setCustomValidity('')">
													<option value="">--Select--</option>
													<?php $cus = $this->Crud->read('customer'); foreach ($cus as $key) {?>
													<option value="<?php echo $key->customer_id; ?>"><?php echo strtoupper($key->surname.' '.$key->firstname); ?></option>
													<?php }?>
												</select>
											</div>
										</div> 

										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">Date From</label>
												<input type="date" id="date_from1" name="date_from1" class="form-control" required>
											</div>
										</div> 
										<!--/span-->
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">Date to</label>
												<input type="date" id="date_to1" name="date_to1" class="form-control" required>
											</div>
										</div>

										<div class="col-md-6">
											.
										</div>
										<div class="col-md-6">
											<label class="control-label mb-10">.</label><br>
											<button class="btn btn-success btn-rounded btn-block btn-anim" id="btn-customer"><i class="icon-magnifier"></i><span class="btn-text">GENERATE</span></button>
										</div>
										<div class="col-md-6">
											.
										</div>
										<!--/span-->
									</div><div id="customer_response" align="center"></div>
									
								</div>
							</div>
							<div id="rofile_8" class="tab-pane fade " role="tabpanel">
								<div class="form-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">Register</label>
												<select class="form-control select2" name="register" id="register" required oninvalid="this.setCustomValidity('Choose Register')" onchange="setCustomValidity('')">
													<option value="">Choose Register</option>
													<?php $cat = $this->Crud->read_order( 'prepared', 'name', 'ASC'); foreach ($cat as $key) {?>
													<option value="<?php echo str_replace(' ', '_', $key->name); ?>"><?php echo strtoupper($key->name); ?></option>
														
													<?php } ?>
												</select>
											</div>
										</div> 

										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">Date From</label>
												<input type="date" id="date_from2" name="date_from2" class="form-control" required>
											</div>
										</div> 
										<!--/span-->
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">Date to</label>
												<input type="date" id="date_to2" name="date_to2" class="form-control" required>
											</div>
										</div>

										
										<div class="col-md-6">
											<label class="control-label mb-10">.</label><br>
											<button class="btn btn-success btn-rounded btn-block btn-anim" id="btn-register"><i class="icon-magnifier"></i><span class="btn-text">GENERATE BY REGISTER</span></button>
										</div>
										<div class="col-md-6">
											<label class="control-label mb-10">.</label><br>
											<button class="btn btn-info btn-rounded btn-block btn-anim" id="btn-full-register"><i class="icon-magnifier"></i><span class="btn-text">GENERATE FULL DETAILS</span></button>
										</div>
										<!--/span--><div class="col-md-8">.</div>
									</div><div id="register_response" align="center"></div>
									
								</div>
							</div>
							<div id="pofile_8" class="tab-pane fade" role="tabpanel">
								<div class="form-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">Company</label>
												<select class="form-control select2" name="supplied_to" id="supplied_to" required>
													<option value="">Select Company</option>
													<?php $cat = $this->Crud->read_order( 'company', 'name', 'ASC'); foreach ($cat as $key) {?>
													<option value="<?php echo $key->code; ?>"><?php echo strtoupper($key->code.' - '.$key->name); ?></option>
													
													<?php } ?>
												</select>
											</div>
										</div> 
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">Date From</label>
												<input type="date" id="date_from3" name="date_from3" class="form-control" required>
											</div>
										</div> 
										<!--/span-->
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">Date to</label>
												<input type="date" id="date_to3" name="date_to3" class="form-control" required>
											</div>
										</div>
										<div class="col-md-4">
											<label class="control-label mb-10">.</label><br>
											<button class="btn btn-success btn-rounded btn-block btn-anim" id="btn-company"><i class="icon-magnifier"></i><span class="btn-text">GENERATE</span></button>
										</div><div class="col-md-9">.</div>
										<!--/span-->
									</div><div id="company_response"></div>
									
								</div>
							</div>
							<div id="ofile_8" class="tab-pane fade" role="tabpanel">
								<div class="form-body">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">Date From</label>
												<input type="date" id="date_from4" name="date_from4" class="form-control" required>
											</div>
										</div> 
										<!--/span-->
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label mb-10">Date to</label>
												<input type="date" id="date_to4" name="date_to4" class="form-control" required>
											</div>
										</div>
										
										<div class="col-md-4">
											<label class="control-label mb-10">.</label><br>
											<button class="btn btn-success btn-rounded btn-block btn-anim" id="btn-dpo"><i class="icon-magnifier"></i><span class="btn-text">GENERATE BY DPO</span></button>
										</div>
										<!--/span-->
									</div>
									<div id="dpo_response"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Row -->
</div>
<!-- Footer -->
		<footer class="footer container-fluid pl-30 pr-30">
			<div class="row">
				<div class="col-sm-12">
					<p><?php echo date('Y'); ?> &copy; EC. Developed by Tee-Fingerz</p>
				</div>
			</div>
		</footer>
		<!-- /Footer -->
		
	</div>
    <!-- /Main Content -->

</div>

	
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
	<script src="<?php echo base_url(); ?>assets/vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/bower_components/multiselect/js/jquery.multi-select.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
		
	
	<script src="<?php echo base_url(); ?>assets/dist/js/form-advance-data.js"></script>
	<script src="<?php echo base_url(); ?>assets/dist/js/jquery.slimscroll.js"></script>
	
	<!-- Init JavaScript -->
	<script src="<?php echo base_url(); ?>assets/dist/js/init.js"></script>
	<script src="<?php echo base_url(); ?>assets/jsform.js"></script>
	<script type="text/javascript">
	    $(document).ready(function(){
	        //Add Product to Cart
	        $('#btn-date').on('click', function(){
	        	var date_to = $('#date_to').val();
	        	var date_from = $('#date_from').val();
	        	// show prograss loading
				$('#date_response').html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
	        	$.ajax({
		            url: '<?php echo base_url('report/date/'); ?>'+ date_to +'/' + date_from,
		            success: function(data) {
		                $('#date_response').html(data);
		            }
		        });
	        	return false;
	        });


	        //Button to Generate Customer
	        $('#btn-customer').on('click', function(){
	        	var date_to1 = $('#date_to1').val();
	        	var date_from1 = $('#date_from1').val();
	        	var customer_id = $('#customer_id').val();
	        	
	        	// show prograss loading
				$('#customer_response').html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
	        	$.ajax({
		            url: '<?php echo base_url('report/customer/'); ?>'+ customer_id +'/' + date_from1 +'/' + date_to1,
		            success: function(data) {
		                $('#customer_response').html(data);
		            }
		        });
	        	return false;
	        });


	        //Button to Generate Customer
	        $('#btn-register').on('click', function(){
	        	var date_to2 = $('#date_to2').val();
	        	var date_from2 = $('#date_from2').val();
	        	var regis = $('#register').val();
	        	
	        	// show prograss loading
				$('#register_response').html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
	        	$.ajax({
		            url: '<?php echo base_url('report/register/'); ?>'+ regis +'/' + date_from2 +'/' + date_to2,
		            success: function(data) {
		                $('#register_response').html(data);
		            }
		        });
	        	return false;
	        });

	        //Button to Generate Register
	        $('#btn-full-register').on('click', function(){
	        	var date_to2 = $('#date_to2').val();
	        	var date_from2 = $('#date_from2').val();
	        	var regis = $('#register').val();
	        	
	        	// show prograss loading
				$('#register_response').html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
	        	$.ajax({
		            url: '<?php echo base_url('report/register/'); ?>'+ regis +'/' + date_from2 +'/' + date_to2,
		            success: function(data) {
		                $('#register_response').html(data);
		            }
		        });
	        	return false;
	        });


	        //Button to Generate Company
	        $('#btn-company').on('click', function(){
	        	var date_to3 = $('#date_to3').val();
	        	var date_from3 = $('#date_from3').val();
	        	var supplied_to = $('#supplied_to').val();
	        	
	        	// show prograss loading
				$('#company_response').html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
	        	$.ajax({
		            url: '<?php echo base_url('report/supplied/'); ?>'+ supplied_to +'/' + date_from3 +'/' + date_to3,
		            success: function(data) {
		                $('#company_response').html(data);
		            }
		        });
	        	return false;
	        });

	        //Button to Generate DPO
	        $('#btn-dpo').on('click', function(){
	        	var date_to4 = $('#date_to4').val();
	        	var date_from4 = $('#date_from4').val();
	        	
	        	// show prograss loading
				$('#dpo_response').html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
	        	$.ajax({
		            url: '<?php echo base_url('report/dpo/'); ?>'+ date_from4 +'/' + date_to4,
		            success: function(data) {
		                $('#dpo_response').html(data);
		            }
		        });
	        	return false;
	        });
	    });
	</script>

</body>
</html>