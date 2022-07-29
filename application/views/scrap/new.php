<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark">Daily Record</h5>
	</div>

	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard">Dashboard</a></li>
			<li><a href="#"><span>Scrap</span></a></li>
			<li class="active"><span>New Record</span></li>
		</ol>
	</div>
	<!-- /Breadcrumb -->

</div>
<!-- /Title -->
<?php echo form_open_multipart('scrap/add', array('id'=>'bb_ajax_form', 'class'=>'for-hoizontal')); ?>

<!-- Row -->
<div class="row">
		<div class="col-md-12">
			
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12 col-xs-12">
								<div class="form-wrap">
    								<div class="form-body">
    									<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label mb-10">Customer Name</label>
													<select class="form-control select2" name="customer_id" id="customer_id" required oninvalid="this.setCustomValidity('Please Select a Customer')" onchange="setCustomValidity('')">
														<option value="">Enter Customer Name</option>
														<?php $cus = $this->Crud->read('customer'); foreach ($cus as $key) {?>
														<option value="<?php echo $key->customer_id; ?>"><?php echo strtoupper($key->surname.' '.$key->firstname); ?></option>
														<?php }?>
													</select>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-2">
												<div class="form-group">
													<label class="control-label mb-10">Vehicle No</label>
													<input type="text" id="vehicle" name="vehicle" class="form-control" required  data-toggle="tooltip" title="Vehicle No"  oninvalid="this.setCustomValidity('Please Enter Vehicle Number')" oninput="setCustomValidity('')"> 
												</div>
											</div>

											<div class="col-md-2">
												<div class="form-group">
													<label class="control-label mb-10">Slip No</label>
													<input type="text" id="slip_no" name="slip_no" class="form-control" data-toggle="tooltip" title="Slip No"> 
												</div>
											</div>
											<!--/span-->
											<div class="col-md-2">
												<div class="form-group">
													<label class="control-label mb-10">C/M</label>
													<input type="text" id="commission" name="commission" class="form-control" oninput="amount();"  data-toggle="tooltip" title="C/M" value="0" > 
												</div>
											</div>
										
											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label mb-10">Received Date</label>
													<input type="date" id="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly required  data-toggle="tooltip" title="Received Date"> 
												</div>
											</div>
										</div>

									</div>
								</div>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default card-view">
				<div class="panel-heading">
					<div class="pull-left">
						<h6 class="panel-title txt-dark">Scrap Details</h6>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12 col-xs-12">
								<div class="form-wrap">
									<div class="form-body">
										<h6 class="txt-dark capitalize-font">Category 1</h6>
										<hr class="light-grey-hr"/>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Category</label>
													<select class="form-control select2" name="cat1" id="cat1" required>
														<?php $cat = $this->Crud->read('category'); foreach ($cat as $key) { if($key->code != 'DUST'){}else{			?>
														
														<option value="<?php echo $key->code; ?>" <?php if($key->code == 'DUST'){echo 'selected';} ?>><?php echo $key->description; ?></option>
														
														<?php }} ?>
													</select>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label mb-10">Qty</label>
													<input type="text" id="qty1" name="qty1" class="form-control" data-toggle="tooltip" title="Dust Quantity" required value="0" oninput="qty();"> 
												</div>
											</div>
										</div>
										
										<h6 class="txt-dark capitalize-font">Category 2</h6>
										<hr class="light-grey-hr"/>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label mb-10">Category</label>
													<select class="form-control select2" name="cat2" id="cat2" onchange="catr();">
														<option value="">Select Category</option>
														<?php $cat = $this->Crud->read('category'); foreach ($cat as $key) { if($key->code == 'DUST'){}else{			?>
														
														<option value="<?php echo $key->code; ?>"><?php echo $key->code.' | '.$key->description; ?></option>
														
														<?php }} ?>
													</select>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-2">
												<div class="form-group">
													<label class="control-label mb-10">Qty</label>
													<input type="text" id="qty2" name="qty2" class="form-control" data-toggle="tooltip" title="Quantity"  value="0" oninput="qty();"> 
												</div>
											</div>

											<div class="col-md-2">
												<div class="form-group">
													<label class="control-label mb-10">Price</label>
													<input type="text" id="price2" name="price2" class="form-control" data-toggle="tooltip" title="Price"  value="0" oninput="prices2();">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label mb-10">Amount</label>
													<input type="text" id="amount2" name="amount2" class="form-control amount" data-toggle="tooltip" title="Amount" readonly  value="0"> 
													<input type="hidden" id="hamount2" name="hamount2" class="form-control amount" data-toggle="tooltip" title="Amount" readonly  value="0"> 
												</div>
											</div>
										</div>
										
										<h6 class="txt-dark capitalize-font">Category 3</h6>
										<hr class="light-grey-hr"/>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label mb-10">Category</label>
													<select class="form-control select2" name="cat3" id="cat3" onchange="catr();">
														<option value="">Select Category</option>
														<?php $cat = $this->Crud->read('category'); foreach ($cat as $key) { if($key->code == 'DUST'){}else{			?>
														
														<option value="<?php echo $key->code; ?>"><?php echo $key->code.' | '.$key->description; ?></option>
														
														<?php }} ?>
													</select>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-2">
												<div class="form-group">
													<label class="control-label mb-10">Qty</label>
													<input type="text" id="qty3" name="qty3" class="form-control" data-toggle="tooltip" title="Quantity"  value="0" oninput="qty();"> 
												</div>
											</div>

											<div class="col-md-2">
												<div class="form-group">
													<label class="control-label mb-10">Price</label>
													<input type="text" id="price3" name="price3" class="form-control" data-toggle="tooltip" title="Price"  value="0"  oninput="prices3();">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label mb-10">Amount</label>
													<input type="text" id="amount3" name="amount3" class="form-control" data-toggle="tooltip" title="Amount" readonly  value="0">
													<input type="hidden" id="hamount3" name="hamount3" class="form-control amount" data-toggle="tooltip" title="Amount" readonly  value="0">  
												</div>
											</div>
										</div>

										<h6 class="txt-dark capitalize-font">Category 4</h6>
										<hr class="light-grey-hr"/>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label mb-10">Category</label>
													<select class="form-control select2" name="cat4" id="cat4" onchange="catr();">
														<option value="">Select Category</option>
														<?php $cat = $this->Crud->read('category'); foreach ($cat as $key) { if($key->code == 'DUST'){}else{			?>
														
														<option value="<?php echo $key->code; ?>"><?php echo $key->code.' | '.$key->description; ?></option>
														
														<?php }} ?>
													</select>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-2">
												<div class="form-group">
													<label class="control-label mb-10">Qty</label>
													<input type="text" id="qty4" name="qty4" class="form-control" data-toggle="tooltip" title="Quantity" required value="0" oninput="qty();"> 
												</div>
											</div>

											<div class="col-md-2">
												<div class="form-group">
													<label class="control-label mb-10">Price</label>
													<input type="text" id="price4" name="price4" class="form-control" data-toggle="tooltip" title="Price" required value="0"  oninput="prices4();">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label mb-10">Amount</label>
													<input type="text" id="amount4" name="amount4" class="form-control" data-toggle="tooltip" title="Amount" readonly required value="0">
													<input type="hidden" id="hamount4" name="hamount4" class="form-control amount" data-toggle="tooltip" title="Amount" readonly required value="0">  
												</div>
											</div>
										</div>

										<h6 class="txt-dark capitalize-font">Category 5</h6>
										<hr class="light-grey-hr"/>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="control-label mb-10">Category</label>
													<select class="form-control select2" name="cat5" id="cat5" onchange="catr();">
														<option value="">Select Category</option>
														<?php $cat = $this->Crud->read('category'); foreach ($cat as $key) { if($key->code == 'DUST'){}else{			?>
														
														<option value="<?php echo $key->code; ?>"><?php echo $key->code.' | '.$key->description; ?></option>
														
														<?php }} ?>
													</select>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-2">
												<div class="form-group">
													<label class="control-label mb-10">Qty</label>
													<input type="text" id="qty5" name="qty5" class="form-control" data-toggle="tooltip" title="Quantity" value="0" oninput="qty();"> 
												</div>
											</div>

											<div class="col-md-2">
												<div class="form-group">
													<label class="control-label mb-10">Price</label>
													<input type="text" id="price5" name="price5" class="form-control" data-toggle="tooltip" title="Price" value="0"  oninput="prices5();">
												</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
													<label class="control-label mb-10">Amount</label>
													<input type="text" id="amount5" name="amount5" class="form-control" data-toggle="tooltip" title="Amount" readonly value="0"> 
													<input type="hidden" id="hamount5" name="hamount5" class="form-control amount" data-toggle="tooltip" title="Amount" readonly value="0"> 
												</div>
											</div>
										</div>

										<hr class="light-grey-hr"/>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label mb-10">Prepared By</label>
													<select class="form-control select2" name="prepared_by" id="prepared_by" required>
														<option value="">Select</option>
														<?php $cat = $this->Crud->read_order( 'prepared', 'name', 'ASC'); foreach ($cat as $key) {?>
														<option value="<?php echo $key->name; ?>"><?php echo strtoupper($key->name); ?></option>
														
														<?php } ?>
													</select>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label mb-10">Supplied to</label>
													<select class="form-control select2" name="supplied_to" id="supplied_to" required>
														<option value="">Select</option>
														<?php $cat = $this->Crud->read_order( 'company', 'name', 'ASC'); foreach ($cat as $key) {?>
														<option value="<?php echo $key->code; ?>"><?php echo strtoupper($key->code).' - '.$key->name; ?></option>
														
														<?php } ?>
													</select>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label mb-10">Remark</label>
													<input type="text" id="remark" name="remark" class="form-control" data-toggle="tooltip" title="Remark">
												</div>
											</div>

										</div>

										<hr class="light-grey-hr"/>
										<div class="row" id="qty_response">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Net Weight + Dust(KG)</label>
													<input type="text" id="netp_dust" name="netp_dust" class="form-control weight-600 font-20 block txt-dark" data-toggle="tooltip" title="Net Weight + Dust" required readonly value="0.00">
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Net weight - Dust(KG)</label>
													<input type="text" id="netm_dust" name="netm_dust" class="form-control weight-600 font-20 block txt-dark" data-toggle="tooltip" title="Net Weight - Dust" required readonly value="0.00">
												</div>
											</div>

										</div>

										<hr class="light-grey-hr"/>
										<div class="row" id="price_response">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">Company Amount(&#8358;)</label>
													<input type="text" id="comp_amountc" name="comp_amountc" class="form-control weight-600 font-20 block txt-dark" data-toggle="tooltip" title="Company Amount" required readonly value="0.00">
												</div>
											</div>
											<!--/span-->
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label mb-10">AUG Amount(&#8358;)</label>
													<input type="text" id="comm_amountc" name="comm_amountc" class="form-control weight-600 font-20 block txt-dark" data-toggle="tooltip" title="AUG Amount" required readonly value="0.00">
												</div>
											</div>

										</div>

										<hr class="light-grey-hr"/>
										<div class="row">
											<div class="col-md-12 text-primary">Enter the same value show above (Amount ₦) into company Amt. Paid Column provided below without mistake or omittion.
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label mb-10">Company Amount Paid(&#8358;)</label>
													<input type="text" id="comp_amount" name="comp_amount" class="form-control" data-toggle="tooltip" title="Company Amount" required oninput="paid();">
												</div>
											</div>
											<!--/span-->
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label mb-10">AUG Amount Paid(&#8358;)</label>
													<input type="text" id="comm_amount" name="comm_amount" class="form-control" data-toggle="tooltip" title="AUG Amount" required oninput="paid();">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label mb-10">Dash Amount(&#8358;)</label>
													<input type="text" id="dash_amount" name="dash_amount" class="form-control" data-toggle="tooltip" title="Dash Amount" value="0">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label mb-10">Dust Amount(&#8358;)</label>
													<input type="text" id="dust_amount" name="dust_amount" class="form-control" data-toggle="tooltip" title="Dust Amount" value="0">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label mb-10">Gross Weight- G/W(KG)</label>
													<input type="text" id="gross" name="gross" class="form-control" data-toggle="tooltip" title="Gross Weight" value="0">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label mb-10">Tare Weight - T/W(KG)</label>
													<input type="text" id="tare" name="tare" class="form-control" data-toggle="tooltip" title="Tare Weight" value="0">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<h6 class="control-label txt-dark capitalize-font mb-10">Shortage(&#8358;)</h6>
													<input type="text" id="shortage" name="shortage" class="form-control weight-600 font-20 block txt-dark" data-toggle="tooltip" title="Shortage" readonly required value="0.00 ">
												</div>
											</div>

										</div>

									</div>
								</div>

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default card-view">
				<div class="panel-heading">
					<div class="pull-left">
						<h6 class="panel-title txt-dark">Payment Category</h6>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12 col-xs-12">
								<div class="form-wrap">
									<div class="form-body">
										<div class="row">
											<div class="col-md-8">
												<div class="form-group">
													<label class="control-label mb-10">Month</label>
													<select class="form-control select2" name="monh" id="monh" required readonly>
														<option value="">Select</option>
														<option value="January" <?php if(date('F') == 'January'){echo 'selected';} ?>>January</option>
														<option value="Febuary" <?php if(date('F') == 'Febuary'){echo 'selected';} ?>>Febuary</option>
														<option value="March" <?php if(date('F') == 'March'){echo 'selected';} ?>>March</option>
														<option value="April" <?php if(date('F') == 'April'){echo 'selected';} ?>>April</option>
														<option value="May" <?php if(date('F') == 'May'){echo 'selected';} ?>>May</option>
														<option value="June" <?php if(date('F') == 'June'){echo 'selected';} ?>>June</option>
														<option value="July" <?php if(date('F') == 'July'){echo 'selected';} ?>>July</option>
														<option value="August" <?php if(date('F') == 'August'){echo 'selected';} ?>>August</option>
														<option value="September" <?php if(date('F') == 'September'){echo 'selected';} ?>>September</option>
														<option value="October" <?php if(date('F') == 'October'){echo 'selected';} ?>>October</option>
														<option value="November" <?php if(date('F') == 'November'){echo 'selected';} ?>>November</option>
														<option value="December" <?php if(date('F') == 'December'){echo 'selected';} ?>>December</option>
													</select>
												</div>
											</div>
											<!--/span-->
											<div class="col-md-8">
												<div class="form-group">
													<label class="control-label mb-10">Direct Advance(&#8358;)</label>
													<input type="text" id="direct_advance" name="direct_advance" class="form-control" data-toggle="tooltip" title="Direct Advance"  value="0" oninput="balance();"> 
												</div>
											</div>

											<div class="col-md-8">
												<div class="form-group">
													<label class="control-label mb-10">Driver Advance(&#8358;)</label>
													<input type="text" id="driver_advance" name="driver_advance" class="form-control" data-toggle="tooltip" title="Driver Advance"  value="0" oninput="balance();"> 
												</div>
											</div>

											<!--/span-->
											<div class="col-md-8">
												<div class="form-group">
													<label class="control-label mb-10">Offloading(&#8358;)</label>
													<input type="text" id="offloading" name="offloading" class="form-control" data-toggle="tooltip" title="Offloading" value="0" oninput="balance();"> 
												</div>
											</div>

											<!--/span-->
											<div class="col-md-8">
												<div class="form-group">
													<label class="control-label mb-10">Revenue(&#8358;)</label>
													<input type="text" id="revenue" name="revenue" class="form-control" data-toggle="tooltip" title="Revenue" value="0" oninput="balance();"> 
												</div>
											</div>

											<!--/span-->
											<div class="col-md-8">
												<div class="form-group">
													<label class="control-label mb-10">Escort/Police(&#8358;)</label>
													<input type="text" id="escort" name="escort" class="form-control" data-toggle="tooltip" title="Escort/Police" value="0" oninput="balance();"> 
												</div>
											</div>

											<!--/span-->
											<div class="col-md-8">
												<div class="form-group">
													<label class="control-label mb-10">Customer Representation(&#8358;)</label>
													<input type="text" id="customer_rep" name="customer_rep" class="form-control" data-toggle="tooltip" title="Customer Representation" value="0" oninput="balance();"> 
												</div>
											</div>

											<!--/span-->
											<div class="col-md-8">
												<div class="form-group">
													<label class="control-label mb-10">Balance Paid(&#8358;)</label>
													<input type="text" id="balance_paid" name="balance_paid" class="form-control" data-toggle="tooltip" title="Balance Paid" value="0" oninput="balance();"> 
												</div>
											</div>

											<!--/span-->
											<div class="col-md-8">
												<div class="form-group">
													<label class="control-label mb-10">Total Deduction(&#8358;)</label>
													<input type="text" id="total_deduction" name="total_deduction" class="form-control weight-600 font-20 block txt-dark" required data-toggle="tooltip" title="Total Deduction" readonly value="0.00"> 
												</div>
											</div>

											<!--/span-->
											<div class="col-md-8">
												<div class="form-group">
													<h6 class="control-label txt-dark capitalize-font mb-10">Close Balance(&#8358;)</h6>
													<input type="text" id="close_balance" name="close_balance" class="form-control weight-600 font-20 block txt-dark" required readonly data-toggle="tooltip" title="Close Balance" value="0.00"> 
												</div>
											</div>										
											
										</div>


									</div>
								</div>

							</div>

						<div class="col-sm-12 text-center">
			                <button class="btn btn-success bb_orm_btn btn-sm text-uppercase" type="submit">
			                    <span class="btn-label"><i class="fa fa-save"></i></span> Save
			                </button>
			            </div>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		<div class="col-md-4">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12 col-xs-12">
								<div id="bb_ajax_msg"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
</div></form>
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
		function isEmpty(str) {
			return (!str || str.length === 0);
		}

		function catr() {
			var cat2 = $('#cat2').val();
	        var price2 = parseInt($('#price2').val());
	        var qty2 = parseInt($('#qty2').val());
	        var cat3 = $('#cat3').val();
	        var qty3 = parseInt($('#qty3').val());
	        var price3 = parseInt($('#price3').val());
	        var cat4 = $('#cat4').val();
	        var qty4 = parseInt($('#qty4').val());
	        var price4 = parseInt($('#price4').val());
	        var cat5 = $('#cat5').val();
	        var price5 = parseInt($('#price5').val());
	        var qty5 = parseInt($('#qty5').val());
	        
	        ///////////////////////////////Script to Validate Category 2 Values/////////////////////////
	        if (cat2 === '' && price2 === 0 && qty2 === 0) {
	        	document.getElementById('price2').setCustomValidity('');
	        	document.getElementById('cat2').setCustomValidity('');
	        	document.getElementById('qty2').setCustomValidity('');
	        } else {
		        if (!!cat2 && price2 === 0) {
		        	document.getElementById('price2').setCustomValidity('Please Enter Price 2');
		        } else{
		        	document.getElementById('price2').setCustomValidity('');
		        }
		        if (!!cat2 && qty2 === 0) {
		        	document.getElementById('qty2').setCustomValidity('Please Enter Quantity 2');
		        } else {
		        	document.getElementById('qty2').setCustomValidity('');
		        }
		        if (cat2 === '' && qty2 === 0) {
		        	document.getElementById('cat2').setCustomValidity('Please Select Category 2');
		        } else {
		        	document.getElementById('cat2').setCustomValidity('');
		        }
		        if (cat2 === '' && price2 === 0) {
		        	document.getElementById('cat2').setCustomValidity('Please Select Category 2');
		        } else{
		        	document.getElementById('cat2').setCustomValidity('');
		        }
		    }
	        ////////////////////////////////////////End/////////////////////////////////////////////////////
	        

	        ///////////////////////////////Script to Validate Category 3 Values/////////////////////////
	        if (cat3 === '' && price3 === 0 && qty3 === 0) {
	        	document.getElementById('price3').setCustomValidity('');
	        	document.getElementById('cat3').setCustomValidity('');
	        	document.getElementById('qty3').setCustomValidity('');
	        } else {
		        
		        if (!!cat3 && price3 === 0) {
		        	document.getElementById('price3').setCustomValidity('Please Enter Price 3');
		        } else{
		        	document.getElementById('price3').setCustomValidity('');
		        }
		        if (!!cat3 && qty3 === 0) {
		        	document.getElementById('qty3').setCustomValidity('Please Enter Quantity 3');
		        } else {
		        	document.getElementById('qty3').setCustomValidity('');
		        }
		        if (cat3 === '' && qty3 === 0) {
		        	document.getElementById('cat3').setCustomValidity('Please Select Category 3');
		        } else {
		        	document.getElementById('cat3').setCustomValidity('');
		        }
		        if (cat3 === '' && price3 === 0) {
		        	document.getElementById('cat3').setCustomValidity('Please Select Category 3');
		        } else{
		        	document.getElementById('cat3').setCustomValidity('');
		        }
		    }
	        ////////////////////////////////////////End/////////////////////////////////////////////////////
	        

	        ///////////////////////////////Script to Validate Category 4 Values/////////////////////////
	        if (cat4 === '' && price4 === 0 && qty4 === 0) {
	        	document.getElementById('price4').setCustomValidity('');
	        	document.getElementById('cat4').setCustomValidity('');
	        	document.getElementById('qty4').setCustomValidity('');
	        } else {
		        
		        if (!!cat4 && price4 === 0) {
		        	document.getElementById('price4').setCustomValidity('Please Enter Price 4');
		        } else{
		        	document.getElementById('price4').setCustomValidity('');
		        }
		        if (!!cat4 && qty4 === 0) {
		        	document.getElementById('qty4').setCustomValidity('Please Enter Quantity 4');
		        } else {
		        	document.getElementById('qty4').setCustomValidity('');
		        }
		        if (cat4 === '' && qty4 === 0) {
		        	document.getElementById('cat4').setCustomValidity('Please Select Category 4');
		        } else {
		        	document.getElementById('cat4').setCustomValidity('');
		        }
		        if (cat4 === '' && price4 === 0) {
		        	document.getElementById('cat4').setCustomValidity('Please Select Category 4');
		        } else{
		        	document.getElementById('cat4').setCustomValidity('');
		        }
		    }
	        ////////////////////////////////////////End/////////////////////////////////////////////////////
	        

	        ///////////////////////////////Script to Validate Category 5 Values/////////////////////////
	        if (cat5 === '' && price5 === 0 && qty5 === 0) {
	        	document.getElementById('price5').setCustomValidity('');
	        	document.getElementById('cat5').setCustomValidity('');
	        	document.getElementById('qty5').setCustomValidity('');
	        } else {
		        
		        if (!!cat5 && price5 === 0) {
		        	document.getElementById('price5').setCustomValidity('Please Enter Price 5');
		        } else{
		        	document.getElementById('price5').setCustomValidity('');
		        }
		        if (!!cat5 && qty5 === 0) {
		        	document.getElementById('qty5').setCustomValidity('Please Enter Quantity 5');
		        } else {
		        	document.getElementById('qty5').setCustomValidity('');
		        }
		        if (cat5 === '' && qty5 === 0) {
		        	document.getElementById('cat5').setCustomValidity('Please Select Category 5');
		        } else {
		        	document.getElementById('cat5').setCustomValidity('');
		        }
		        if (cat5 === '' && price5 === 0) {
		        	document.getElementById('cat5').setCustomValidity('Please Select Category 5');
		        } else{
		        	document.getElementById('cat5').setCustomValidity('');
		        }
		    }
	        ////////////////////////////////////////End/////////////////////////////////////////////////////
	        
	        
		}

		function prices2() {
	        var price2 = Number($('#price2').val());
	        var commission = parseInt($('#commission').val());
	        var qty2 = Number($('#qty2').val());
	        var cat2 = $('#cat2').val();

	        if (isEmpty(price2)) { var price2 = 0;}
	        if (isEmpty(commission)) { var commission = 0;}
	        if (isEmpty(qty2)) { var qty2 = 0;}

	        var tot = price2 * qty2;
	        document.getElementById('amount2').value = tot;
	        var tota = (price2 + commission) * qty2;
	        document.getElementById('hamount2').value = tota;
	       
	        amount();balance();catr();
	    }

	    function prices3() {
	        var price3 = parseInt($('#price3').val());
	        var qty3 = parseInt($('#qty3').val());
	        if (isEmpty(price3)) { var price3 = 0;}
	        if (isEmpty(qty3)) { var qty3 = 0;}
	        var tot = price3 * qty3;
	        document.getElementById('amount3').value = tot;
	        var tota = (price3 + commission) * qty3;
	        document.getElementById('hamount3').value = tota;
	        amount();balance();catr();
	    }

	    function prices4() {
	        var price4 = parseInt($('#price4').val());
	        var qty4 = parseInt($('#qty4').val());
	        if (isEmpty(price4)) { var price4 = 0;}
	        if (isEmpty(qty4)) { var qty4 = 0;}
	        var tot = price4 * qty4;
	        document.getElementById('amount4').value = tot;
	        var tota = (price4 + commission) * qty4;
	        document.getElementById('hamount4').value = tota;
	        amount();balance();catr();
	    }

	    function prices5() {
	        var price5 = parseInt($('#price5').val());
	        var qty5 = parseInt($('#qty5').val());
	        if (isEmpty(price5)) { var price5 = 0;}
	        if (isEmpty(qty5)) { var qty5 = 0;}
	        var tot = price5 * qty5;
	        document.getElementById('amount5').value = tot;
	        var tota = (price5 + commission) * qty5;
	        document.getElementById('hamount5').value = tota;
	        amount();balance();catr();
	    }

	</script>
	<script>
		function balance() {
			var direct_advance = parseInt($('#direct_advance').val());
	       	var driver_advance = parseInt($('#driver_advance').val());
	        var offloading = parseInt($('#offloading').val());
	        var revenue = parseInt($('#revenue').val());
	        var escort = parseInt($('#escort').val());
	        var customer_rep = parseInt($('#customer_rep').val());
	        var balance_paid = parseInt($('#balance_paid').val());
	        var total_deduction = parseInt($('#total_deduction').val());
	        var comm_amount = parseInt($('#comm_amount').val());
	        
	        if (isEmpty(comm_amount)) { var comm_amount = 0;}
	        if (isEmpty(driver_advance)) { var driver_advance = 0;}
	        if (isEmpty(direct_advance)) { var direct_advance = 0;}
	        if (isEmpty(offloading)) { var offloading = 0;}
	        if (isEmpty(revenue)) { var revenue = 0;}
	        if (isEmpty(escort)) { var escort = 0;}
	        if (isEmpty(customer_rep)) { var customer_rep = 0;}
	        if (isEmpty(balance_paid)) { var balance_paid = 0;}
	        if (isEmpty(total_deduction)) { var total_deduction = 0;}
	        if (isEmpty(close_balance)) { var close_balance = 0;}
	        
	        var tot = driver_advance + direct_advance + offloading + revenue + escort + customer_rep + balance_paid;
	        document.getElementById('total_deduction').value = tot.toFixed(2);
	        var tota = comm_amount - tot;
	        document.getElementById('close_balance').value = tota.toFixed(2);
	         
		}

		function paid() {
			var comp_amount = parseInt($('#comp_amount').val());
	        var comm_amount = parseInt($('#comm_amount').val());
	        
	        if (isEmpty(comp_amount)) { var comp_amount = 0;}
	        if (isEmpty(comm_amount)) { var comm_amount = 0;}

	        var tot =  comm_amount - comp_amount;
	        document.getElementById('shortage').value = tot.toFixed(2);
	        document.getElementById('close_balance').value = comm_amount.toFixed(2);
	     	balance();   
		}
    
	    function qty() {
	        var qty1 = parseInt($('#qty1').val());
	        var qty2 = parseInt($('#qty2').val());
	        var qty3 = parseInt($('#qty3').val());
	        var qty4 = parseInt($('#qty4').val());
	        var qty5 = parseInt($('#qty5').val());
	        
	        if (isEmpty(qty1)) { var qty1 = 0;}
	        if (isEmpty(qty2)) { var qty2 = 0;}
	        if (isEmpty(qty3)) { var qty3 = 0;}
	        if (isEmpty(qty4)) { var qty4 = 0;}
	        if (isEmpty(qty5)) { var qty5 = 0;}
	        var tot = qty1 + qty2 + qty3 + qty4 + qty5;
	        document.getElementById('netp_dust').value = tot.toFixed(2);
	        var tota = qty2 + qty3 + qty4 + qty5;
	        document.getElementById('netm_dust').value = tota.toFixed(2);
	        prices2();prices3();prices4();prices5();amount();balance();catr();
	    }

	    
	    function amount() {
	    	var amount2 = parseInt($('#amount2').val());
	        var amount3 = parseInt($('#amount3').val());
	        var amount4 = parseInt($('#amount4').val());
	        var amount5 = parseInt($('#amount5').val());
	        
	        if (isEmpty(amount2)) { var amount2 = 0;}
	        if (isEmpty(amount3)) { var amount3 = 0;}
	        if (isEmpty(amount4)) { var amount4 = 0;}
	        if (isEmpty(amount5)) { var amount5 = 0;}

	        var tot = amount2 + amount3 + amount4 + amount5;
	        document.getElementById('comp_amountc').value = tot.toFixed(2);
	        document.getElementById('comp_amount').value = tot.toFixed(2);

	        document.getElementById('comm_amountc').value = tot.toFixed(2);
	        
	        hamount();

	    }

	    function hamount() {
	    	var price2 = parseInt($('#price2').val());
	        var price3 = parseInt($('#price3').val());
	        var price4 = parseInt($('#price4').val());
	        var price5 = parseInt($('#price5').val());
	        var commission = parseInt($('#commission').val());
	        var qty2 = parseInt($('#qty2').val());
	        var qty3 = parseInt($('#qty3').val());
	        var qty4 = parseInt($('#qty4').val());
	        var qty5 = parseInt($('#qty5').val());
	        
	        if (isEmpty(price2)) { var price2 = 0;}
	        if (isEmpty(price3)) { var price3 = 0;}
	        if (isEmpty(price4)) { var price4 = 0;}
	        if (isEmpty(price5)) { var price5 = 0;}
	        if (isEmpty(commission)) { var commission = 0;}
	        if (isEmpty(qty2)) { var qty2 = 0;}
	        if (isEmpty(qty3)) { var qty3 = 0;}
	        if (isEmpty(qty4)) { var qty4 = 0;}
	        if (isEmpty(qty5)) { var qty5 = 0;}
	        
	        var tot2 = (price2 + commission) * qty2;
	        var tot3 = (price3 + commission) * qty3;
	        var tot4 = (price4 + commission) * qty4;
	        var tot5 = (price5 + commission) * qty5;

	        var total = tot2 + tot3 + tot4 + tot5;
	        document.getElementById('comm_amountc').value = total.toFixed(2);
	        balance();
	    }
	   
	</script>
</body>

</html>
