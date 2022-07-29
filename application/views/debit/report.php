<!-- Title -->
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	  <h5 class="txt-dark">Advance Payment Report</h5>
	</div>
	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	  <ol class="breadcrumb">
		<li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
		<li><a href="#">Advance Payment</a></li>
		<li class="active"><span>Report</span></li>
	  </ol>
	</div>
	<!-- /Breadcrumb -->
</div>
<!-- /Title -->
<!-- Row -->
<div class="row">
	<div class="col-lg-12 col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<p class="text-info"><marquee>Enter Details to Generate Report</marquee></p>
					<div class="tab-struct vertical-tab custom-tab-1 mt-40">
						<ul role="tablist" class="nav nav-tabs ver-nav-tab" id="myTabs_8" style="min-height: 170px;">
							<li class="active" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="home_tab_8" href="#home_8"><h6 class="txt-dark capitalize-font"><i class="icon-calender mr-10"></i>Payment by Date</h6></a></li>
							<li role="presentation" class=""><a data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><h6 class="txt-dark capitalize-font"><i class="ti-user mr-10"></i>Payment by Customer</h6></a></li>
							<li role="presentation" class=""><a data-toggle="tab" id="rofile_tab_8" role="tab" href="#rofile_8" aria-expanded="false"><h6 class="txt-dark capitalize-font"><i class="ti-receipt mr-10"></i>Payment by Account</h6></a></li>
							<li role="presentation" class=""><a data-toggle="tab" id="rofie_tab_8" role="tab" href="#rofie_8" aria-expanded="false"><h6 class="txt-dark capitalize-font"><i class="ti-agenda mr-10"></i>Payment by Authorised Person</h6></a></li>
							
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
										<div class="col-md-7">
											<div class="form-group">
												<label class="control-label mb-10">Customer</label>
												<select class="form-control select2" name="customer" id="customer" required oninvalid="this.setCustomValidity('Please Select customer')" onchange="setCustomValidity('')">
													<option value="">--Select--</option>
													<?php $cus = $this->Crud->read('customer'); foreach ($cus as $key) {?>
													<option value="<?php echo $key->customer_id; ?>"><?php echo strtoupper($key->surname.' '.$key->firstname); ?></option>
													<?php }?>
												</select>
											</div>
										</div> 

										<div class="col-md-5">
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
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label mb-10">Account</label>
												<select class="form-control select2" name="account" id="account" required oninvalid="this.setCustomValidity('Choose Account')" onchange="setCustomValidity('')">
													<option value="">Choose</option>
													<?php $cat = $this->Crud->read( 'account'); foreach ($cat as $key) {?>
													<option value="<?php echo $key->id; ?>"><?php echo strtoupper($key->account_num.' '.$key->bank_name); ?></option>
														
													<?php } ?>
												</select>
											</div>
										</div> 
										
										<div class="col-md-4">
											<label class="control-label mb-10">.</label><br>
											<button class="btn btn-success btn-rounded btn-block btn-anim" id="btn-account"><i class="icon-magnifier"></i><span class="btn-text">GENERATE</span></button>
										</div>
										
									</div><div id="account_response" align="center"></div>
									
								</div>
							</div>
							<div id="rofie_8" class="tab-pane fade " role="tabpanel">
								<div class="form-body">
									<div class="row">
										<div class="col-md-7">
											<div class="form-group">
												<label class="control-label mb-10">Authorized Person</label>
												<select class="form-control select2" name="staff_id" id="staff_id" required oninvalid="this.setCustomValidity('Choose Person')" onchange="setCustomValidity('')">
													<option value="">Choose</option>
													<?php $cat = $this->Crud->read_order( 'staff', 'surname', 'ASC'); foreach ($cat as $key) {?>
													<option value="<?php echo $key->id; ?>"><?php echo strtoupper($key->surname.' '.$key->firstname); ?></option>
														
													<?php } ?>
												</select>
											</div>
										</div> 

										<div class="col-md-5">
											<label class="control-label mb-10">.</label><br>
											<button class="btn btn-info btn-rounded btn-block btn-anim" id="btn-staff"><i class="icon-magnifier"></i><span class="btn-text">GENERATE</span></button>
										</div>
										<!--/span--><div class="col-md-8">.</div>
									</div><div id="staff_response" align="center"></div>
									
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
		            url: '<?php echo base_url('debit/date/'); ?>'+ date_to +'/' + date_from,
		            success: function(data) {
		                $('#date_response').html(data);
		            }
		        });
	        	return false;
	        });


	        //Button to Generate Customer
	        $('#btn-customer').on('click', function(){
	        	var customer = $('#customer').val();
	        	
	        	// show prograss loading
				$('#customer_response').html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
	        	$.ajax({
		            url: '<?php echo base_url('debit/customer/'); ?>'+ customer,
		            success: function(data) {
		                $('#customer_response').html(data);
		            }
		        });
	        	return false;
	        });

	        //Button to Generate Register
	        $('#btn-account').on('click', function(){
	        	var account = $('#account').val();
	        	
	        	// show prograss loading
				$('#account_response').html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
	        	$.ajax({
		            url: '<?php echo base_url('debit/account/'); ?>'+ account,
		            success: function(data) {
		                $('#account_response').html(data);
		            }
		        });
	        	return false;
	        });


	        //Button to Generate Register
	        $('#btn-staff').on('click', function(){
	        	var staff = $('#staff_id').val();
	        	
	        	// show prograss loading
				$('#staff_response').html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
	        	$.ajax({
		            url: '<?php echo base_url('debit/staff/'); ?>'+ staff,
		            success: function(data) {
		                $('#staff_response').html(data);
		            }
		        });
	        	return false;
	        });

	    });
	</script>

</body>
</html>