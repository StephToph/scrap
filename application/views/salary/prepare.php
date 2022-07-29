<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark"></h5>
	</div>

	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
			<li><a href="#"><span>Salary</span></a></li>
			<li class="active"><span>Prepare</span></li>
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
					<h6 class="panel-title txt-dark">Prepare Salary</h6>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<div class="form-wrap">
								<?php echo form_open_multipart('salary/prep', array('id'=>'bb_ajax_form', 'class'=>'form-horizotal')); ?>
    								<div class="form-body">
    									<div id="bb_ajax_msg"></div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Employee ID</label>
													<input type="text" id="emp_id" name="emp_id" class="form-control" placeholder="ST000" required oninput="check_emp();"> 
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6" id="emp_response">
												<div class="form-group">
													<label class="control-label mb-10">Employee Name</label>
													<input type="text" id="name" name="name" class="form-control" placeholder="John Doe" readonly> 
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Month Paid</label>
													<select class="form-control select2" name="month_paid" id="month_paid" required onchange="mnth();">
														<option value="">--Select Month--</option>
														<option value="January">January</option>
														<option value="February">February</option>
														<option value="March">March</option>
														<option value="April">April</option>
														<option value="May">May</option>
														<option value="June">June</option>
														<option value="July">July</option>
														<option value="August">August</option>
														<option value="September">September</option>
														<option value="October">October</option>
														<option value="November">November</option>
														<option value="December">December</option>
													</select> 
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Amount Paid</label>
													<input type="text" id="amount_paid" name="amount_paid" class="form-control" required value="0" min="0" oninput="cal();"> 
												</div>
											</div>

											<!--/span-->
											<div class="col-md-6" id="p_response">
												<div class="form-group">
													<label class="control-label mb-10">Days Present</label>
													<input class="form-control" type="number" name="days_present" id="days_present" min="0" value="0" required oninput="dayp();">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Days Absent</label>
													<input class="form-control" type="text" name="days_absent" id="days_absent" minlength="0" value="0" required readonly>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Amount Deducted</label>
													<input class="form-control" type="text" name="amount_deducted" id="amount_deducted" readonly required value="0">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Amount Balance</label>
													<input class="form-control" type="text" name="amount_balance" id="amount_balance" readonly required value="0">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Remark</label>
													<input class="form-control" type="text" name="remark" id="remark" required>
												</div>
											</div>

											<!--/span-->
										</div>

									</div>
									<div class="form-actions mt-10 pull-right" >
										<button type="submit" class="btn btn-success  mr-10"> Save</button>
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
    
	    function check_emp() {
	        var emp_id = $('#emp_id').val();
	        $.ajax({
	            url: '<?php echo base_url('salary/check_emp/'); ?>'+ emp_id,
	            success: function(data) {
	                $('#emp_response').html(data);
	            }
	        });

	    }

	    function mnth() {
	        var month_paid = $('#month_paid').val();
	        $.ajax({
	            url: '<?php echo base_url('salary/mnth/'); ?>'+ month_paid,
	            success: function(data) {
	                $('#p_response').html(data);
	            }
	        });
	        cal();
	    }

	    function cal() {
			var amount_paid = $('#amount_paid').val();
	        var amount_balance = parseInt($('#amount_balance').val());
	        var amount_deducted = parseInt($('#amount_deducted').val());
	        var days_present = $('#days_present').val();
	        var days_absent = parseInt($('#days_absent').val());
	       
	        ///////////////////////////////Script to Calculate Values/////////////////////////
	        if (amount_paid === 0 && days_present === 0) {
	        	document.getElementById('amount_paid').setCustomValidity('');
	        	document.getElementById('days_present').setCustomValidity('');
	        } else {
		       document.getElementById('amount_balance').value = amount_paid;
	        	
		    }
	        ////////////////////////////////////////End/////////////////////////////////////////////////////
	        dayp();
		}

		 function dayp() {
		 	//alert('dfdf');
			var amount_paid = $('#amount_paid').val();
	        var amount_deducted = parseInt($('#amount_deducted').val());
	        var amount_balance = parseInt($('#amount_balance').val());
	        var days_present = $('#days_present').val();
	        var day_present = $('#day_present').val();
	        var days_absent = $('#days_absent').val();
	        
	        ///////////////////////////////Script to Calculate Values/////////////////////////
	        if (amount_paid === 0 || amount_paid === '') {
	        	document.getElementById('amount_paid').setCustomValidity('');
	        } else {
	        	var ans = day_present - days_present;
	        	//alert (ans);
	        	$('#days_absent').val(ans);
		    }
		    updat();
		}

		function updat() {
	    	var amount_paid = $('#amount_paid').val();
	        var amount_deducted = parseInt($('#amount_deducted').val());
	        var amount_balance = parseInt($('#amount_balance').val());
	        var days_present = $('#days_present').val();
	        var day_present = $('#day_present').val();
	        var days_absent = $('#days_absent').val();

	        var dec = 500 * days_absent;
        	var res = amount_paid - dec;

        	$('#amount_deducted').val(dec);
        	$('#amount_balance').val(res);
        
	    }
	   
	</script>
</body>

</html>
