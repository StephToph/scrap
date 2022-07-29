


<!-- Title -->
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark">New Customer</h5>
	</div>

	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
			<li><a href="#"><span>Customer</span></a></li>
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
					<h6 class="panel-title txt-dark">New Customer</h6>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<div class="form-wrap">
								<?php echo form_open_multipart('customer/add', array('id'=>'bb_ajax_form', 'class'=>'form-horizotal')); ?>
    								<div class="form-body">
    									<div id="bb_ajax_msg"></div>

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

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">State of Origin</label>
													<select class="form-control select2" name="state" id="state" required>
														<option value="">--Select State of Origin</option>
														<?php $st = $this->Crud->read_single_order('country_id', '161', 'states', 'name', 'asc'); foreach ($st as $key) {?>					<option value="<?php echo $key->name; ?>"><?php echo strtoupper($key->name); ?></option>
														<?php } ?>
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
</div>
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
	            url: '<?php echo base_url('customer/check_email/?email='); ?>'+ email,
	            success: function(data) {
	                $('#email_response').html(data);
	            }
	        });
	    }

	   
	</script>
</body>

</html>
