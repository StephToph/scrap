


<!-- Title -->
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark">New Staff</h5>
	</div>

	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
			<li><a href="#"><span>Staff</span></a></li>
			<li class="active"><span>New Record</span></li>
		</ol>
	</div>
	<!-- /Breadcrumb -->

</div>
<!-- /Title -->

<!-- Row -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark">New Staff</h6>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<div class="form-wrap">
								<?php echo form_open_multipart('staff/add', array('id'=>'bb_ajax_form', 'class'=>'form-horizotal')); ?>
    								<div class="form-body">
										<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Person's Info</h6>
										<hr class="light-grey-hr"/>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Surname</label>
													<input type="text" id="surname" name="surname" class="form-control" placeholder="John" required> 
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">First Name</label>
													<input type="text" id="firstname" name="firstname" class="form-control" placeholder="Doe" required> 
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Gender</label>
													<select class="form-control select2" name="gender" id="gender" required>
														<option value="">--Select Gender--</option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select> 
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Date of Birth</label>
													<input type="date" class="form-control" id="dob" name="dob" placeholder="dd/mm/yyyy" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Marital Status</label>
													<select class="form-control select2" name="marital" id="marital" required>
														<option value="">Select</option>
														<option value="Single">Single</option>
														<option value="Married">Married</option>
														<option value="Divorced">Divorced</option>
														<option value="Widowed">Widowed</option>
													</select>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Qualification</label>
													<select class="form-control select2" name="qualification" id="qualification" required>
														<option value="">--Select Qualification--</option>
														<option value="OND">OND</option>
														<option value="HND">HND</option>
														<option value="BSc">BSc</option>
														<option value="NCE">NCE</option>
													</select>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Designation</label>
													<select class="form-control select2" name="designation" id="designation" required>
														<option value="">--Select Designation--</option>
														<?php $desig = $this->Crud->read('designation'); foreach ($desig as $key) { ?>
															<option value="<?php echo $key->name; ?>"><?php echo $key->name; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Branch</label>
													<select class="form-control select2" name="branch" id="branch" required>
														<option value="">--Select Branch--</option>
														<?php $desig = $this->Crud->read('branch'); foreach ($desig as $key) { ?>
															<option value="<?php echo $key->name; ?>"><?php echo $key->name; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										<!-- /Row -->
										
										<div class="seprator-block"></div>
										
										<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account-box mr-10"></i>address</h6>
										<hr class="light-grey-hr"/>
										<div class="row">
											<div class="col-md-12 ">
												<div class="form-group">
													<label class="control-label mb-10">Address</label>
													<input type="text" class="form-control" name="address" id="address" required>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label mb-10">Postal</label>
													<input type="text" class="form-control" name="postal" id="postal" required>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label mb-10">State of Origin</label>
													<select class="form-control select2" name="state" id="state" required>
														<option value="">--Select State of Origin</option>
														<?php $st = $this->Crud->read_single_order('country_id', '161', 'states', 'name', 'asc'); foreach ($st as $key) {?>					<option value="<?php echo $key->name; ?>"><?php echo strtoupper($key->name); ?></option>
														<?php } ?>
													</select>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label mb-10">Nationality</label>
													<select class="form-control select2" name="nationality" id="nationality" required>
														<option value="">--Select Nationality--</option>
														<option value="Nigeria">Nigeria</option>
													</select>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Phone</label>
													<input class="form-control" type="text" name="phone" maxlength="11" minlength="11" id="phone" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Email</label>
													<input type="email" name="email" id="email" required class="form-control" oninput="check_email();">
												</div><div id="email_response"></div>
											</div>
											<!--/span-->
										</div>

										<div class="seprator-block"></div>
										
										<h6 class="txt-dark capitalize-font"><i class="ti-github mr-10"></i>guarantor</h6>
										<hr class="light-grey-hr"/>
										<div class="row">
											<div class="col-md-6 ">
												<div class="form-group">
													<label class="control-label mb-10">Relationship</label>
													<select class="form-control" name="relationship" id="relationship" required>
														<option value="">--Select Relationship--</option>
														<option value="Family">Family</option>
														<option value="Friend">Friend</option>
														<option value="Acquaintance">Acquaintance</option>
													</select>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Full Name</label>
													<input type="text" class="form-control" name="g_name" id="g_name" required>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Address</label>
													<input type="text" class="form-control" id="g_address" name="g_address" required>
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Occupation</label>
													<input type="text" class="form-control" name="occupation" id="occupation" required>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Phone Number</label>
													<input class="form-control" type="text" name="g_phone" id="g_phone" maxlength="11" minlength="11" required>
												</div>
											</div>

										</div>
									</div>
									<div class="form-actions mt-10">
										<button type="submit" class="btn btn-success  mr-10"> Save</button>
										<button type="button" class="btn btn-default">Cancel</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><div id="bb_ajax_msg"></div>

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
    <!-- /#wrapper -->
	<div class="modal fade" id="modal_pop" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title"> </h5>
				</div>
				<div class="modal-body"> </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- JavaScript -->
	
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
	<script>
    
	    function check_email() {
	        var email = $('#email').val();
	        $.ajax({
	            url: '<?php echo base_url('staff/check_email/?email='); ?>'+ email,
	            success: function(data) {
	                $('#email_response').html(data);
	            }
	        });
	    }

	   
	</script>
</body>

</html>
