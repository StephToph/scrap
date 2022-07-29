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
				<div class="ro">
					<!-- Basic Table -->
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap mt-0">
										<div class="table-responsive">
											<table class="table mb-0" style="font-size: 13px">
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
											<table class="table mb-0" style="font-size: 10px">
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
											<?php if ($report_type == 'date_report') {?>
												<h5 class="txt-dark capitalize-font" align="center"><?php echo $title; ?></h5>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<?php $ser = $this->Crud->date_range($param2, 'date', $param3, 'date', 'inward');
														if (empty($ser)) { ?>
															<div align="right">0 Record</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table style="border: 1px;"> 
																			<thead style="color: black;" class="table">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered mb-0">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Code</td>
																		                            <td>Company</td>
																		                            <td >Payment Mode</td>
																		                            <td>Amount(&#8358;)</td>
																		                            <td>Cheque No</td>
																		                            <td>Account No</td>
																		                            <td align="center">Remark</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<tr>
																									<td colspan="17">NO RECORD</td>
																								</tr>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								<tr>
																		                            <td colspan="3" >GRAND TOTAL</td>
																		                            <td >0.00</td>
																		                            
																		                        </tr>
																							</tfoot>
																						</table>
																					</td>
																				</tr>
																			</thead>
																		</table>
																	</div>
																</div>
															</div>
													<?php } else {?>
															<div align="right"><?php echo count($ser); ?> Record(s)</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table  class="table"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered table-responsive">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Code</td>
																		                            <td>Company</td>
																		                            <td >Payment Mode</td>
																		                            <td>Amount(&#8358;)</td>
																		                            <td>Cheque No</td>
																		                            <td>Account No</td>
																		                            <td align="center">Remark</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<?php $f= 0; 
																									foreach ($ser as $key) {?>
																									
																									<tr>
																										<td><?php echo $key->date; ?></td>
																										<td><?php echo $key->code; ?></td>
																										<td><?php echo strtoupper($this->Crud->read_field('code', $key->company, 'company', 'name')); ?></td>
																										<td><?php echo strtoupper($key->pay_type); ?></td>
																										<td><?php echo number_format($key->amount); ?></td>
																										<td><?php echo strtoupper($key->cheque_no); ?></td>
																										<td><?php echo $this->Crud->read_field('id', $key->pay_account, 'account', 'account_num'); ?></td>
																										<td><?php echo $key->remark; ?></td>
																									</tr>
																								<?php $f += $key->amount; } 


																								?>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;" class="custom">
																								
																								<tr>
																		                            <td colspan="4" >GRAND TOTAL</td>
																		                            <td ><?php echo number_format($f, 2); ?></td>
																		                            </tr>
																		                        </tr>
																							</tfoot>
																						</table>
																					</td>
																				</tr>
																			</thead>
																		</table>
																	</div>
																</div>
															</div>
													<?php } ?>
												</div>
											<?php } elseif ($report_type == 'account_report') { ?>
												<h5 class="txt-dark capitalize-font" align="center"><?php echo $title; ?></h5>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<?php $ser = $this->Crud->date_range1($param3, 'date', $param2, 'date', 'pay_account', $param4, 'inward');//echo $param3.' '.$param2.' '.$param4;
														if (empty($ser)) { ?>
															<div align="right">0 Record</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table style="border: 1px;"class="table"> 
																			<thead style="color: black;" >
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered mb-0">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Code</td>
																		                            <td>Company</td>
																		                            <td >Payment Mode</td>
																		                            <td>Amount(&#8358;)</td>
																		                            <td>Cheque No</td>
																		                            <td>Account No</td>
																		                            <td align="center">Remark</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<tr>
																									<td colspan="17">NO RECORD</td>
																								</tr>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								<tr>
																		                            <td colspan="3" >GRAND TOTAL</td>
																		                            <td >0.00</td>
																		                            
																		                        </tr>
																							</tfoot>
																						</table>
																					</td>
																				</tr>
																			</thead>
																		</table>
																	</div>
																</div>
															</div>
													<?php } else {?>
															<div align="right"><?php echo count($ser); ?> Record(s)</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table  class="table"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered table-responsive">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Code</td>
																		                            <td>Company</td>
																		                            <td >Payment Mode</td>
																		                            <td>Amount(&#8358;)</td>
																		                            <td>Cheque No</td>
																		                            <td>Account No</td>
																		                            <td align="center">Remark</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<?php $f= 0; 
																									foreach ($ser as $key) {?>
																									
																									<tr>
																										<td><?php echo $key->date; ?></td>
																										<td><?php echo $key->code; ?></td>
																										<td><?php echo strtoupper($this->Crud->read_field('code', $key->company, 'company', 'name')); ?></td>
																										<td><?php echo strtoupper($key->pay_type); ?></td>
																										<td><?php echo number_format($key->amount); ?></td>
																										<td><?php echo strtoupper($key->cheque_no); ?></td>
																										<td><?php echo $this->Crud->read_field('id', $key->pay_account, 'account', 'account_num'); ?></td>
																										<td><?php echo $key->remark; ?></td>
																									</tr>
																								<?php $f += $key->amount; } 


																								?>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;" class="custom">
																								
																								<tr>
																		                            <td colspan="4" >GRAND TOTAL</td>
																		                            <td ><?php echo number_format($f, 2); ?></td>
																		                            </tr>
																		                        </tr>
																							</tfoot>
																						</table>
																					</td>
																				</tr>
																			</thead>
																		</table>
																	</div>
																</div>
															</div>
													<?php } ?>
												</div>
											<?php } elseif ($report_type == 'company_report') { ?>
												<h5 class="txt-dark capitalize-font" align="center"><?php echo $title; ?></h5>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<?php $ser = $this->Crud->read_single('company', $param2, 'inward');//echo $param3.' '.$param2.' '.$param4;
														if (empty($ser)) { ?>
															<div align="right">0 Record</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table style="border: 1px;"class="table"> 
																			<thead style="color: black;" >
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered mb-0">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Code</td>
																		                            <td>Company</td>
																		                            <td >Payment Mode</td>
																		                            <td>Amount(&#8358;)</td>
																		                            <td>Cheque No</td>
																		                            <td>Account No</td>
																		                            <td align="center">Remark</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<tr>
																									<td colspan="17">NO RECORD</td>
																								</tr>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								<tr>
																		                            <td colspan="3" >GRAND TOTAL</td>
																		                            <td >0.00</td>
																		                            
																		                        </tr>
																							</tfoot>
																						</table>
																					</td>
																				</tr>
																			</thead>
																		</table>
																	</div>
																</div>
															</div>
													<?php } else {?>
															<div align="right"><?php echo count($ser); ?> Record(s)</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table  class="table"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered table-responsive">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Code</td>
																		                            <td>Company</td>
																		                            <td >Payment Mode</td>
																		                            <td>Amount(&#8358;)</td>
																		                            <td>Cheque No</td>
																		                            <td>Account No</td>
																		                            <td align="center">Remark</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<?php $f= 0; 
																									foreach ($ser as $key) {?>
																									
																									<tr>
																										<td><?php echo $key->date; ?></td>
																										<td><?php echo $key->code; ?></td>
																										<td><?php echo strtoupper($this->Crud->read_field('code', $key->company, 'company', 'name')); ?></td>
																										<td><?php echo strtoupper($key->pay_type); ?></td>
																										<td><?php echo number_format($key->amount); ?></td>
																										<td><?php echo strtoupper($key->cheque_no); ?></td>
																										<td><?php echo $this->Crud->read_field('id', $key->pay_account, 'account', 'account_num'); ?></td>
																										<td><?php echo $key->remark; ?></td>
																									</tr>
																								<?php $f += $key->amount; } 


																								?>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;" class="custom">
																								
																								<tr>
																		                            <td colspan="4" >GRAND TOTAL</td>
																		                            <td ><?php echo number_format($f, 2); ?></td>
																		                            </tr>
																		                        </tr>
																							</tfoot>
																						</table>
																					</td>
																				</tr>
																			</thead>
																		</table>
																	</div>
																</div>
															</div>
													<?php } ?>
												</div>
											<?php } elseif ($report_type == 'date_comp_report') { ?>
												<h5 class="txt-dark capitalize-font" align="center"><?php echo $title; ?></h5>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<?php $ser = $this->Crud->date_range1($param3, 'date', $param2, 'date', 'company', $param4, 'inward');//echo $param3.' '.$param2.' '.$param4;
														if (empty($ser)) { ?>
															<div align="right">0 Record</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table style="border: 1px;"class="table"> 
																			<thead style="color: black;" >
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered mb-0">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Code</td>
																		                            <td>Company</td>
																		                            <td >Payment Mode</td>
																		                            <td>Amount(&#8358;)</td>
																		                            <td>Cheque No</td>
																		                            <td>Account No</td>
																		                            <td align="center">Remark</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<tr>
																									<td colspan="17">NO RECORD</td>
																								</tr>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								<tr>
																		                            <td colspan="3" >GRAND TOTAL</td>
																		                            <td >0.00</td>
																		                            
																		                        </tr>
																							</tfoot>
																						</table>
																					</td>
																				</tr>
																			</thead>
																		</table>
																	</div>
																</div>
															</div>
													<?php } else {?>
															<div align="right"><?php echo count($ser); ?> Record(s)</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table  class="table"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered table-responsive">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Code</td>
																		                            <td>Company</td>
																		                            <td >Payment Mode</td>
																		                            <td>Amount(&#8358;)</td>
																		                            <td>Cheque No</td>
																		                            <td>Account No</td>
																		                            <td align="center">Remark</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<?php $f= 0; 
																									foreach ($ser as $key) {?>
																									
																									<tr>
																										<td><?php echo $key->date; ?></td>
																										<td><?php echo $key->code; ?></td>
																										<td><?php echo strtoupper($this->Crud->read_field('code', $key->company, 'company', 'name')); ?></td>
																										<td><?php echo strtoupper($key->pay_type); ?></td>
																										<td><?php echo number_format($key->amount); ?></td>
																										<td><?php echo strtoupper($key->cheque_no); ?></td>
																										<td><?php echo $this->Crud->read_field('id', $key->pay_account, 'account', 'account_num'); ?></td>
																										<td><?php echo $key->remark; ?></td>
																									</tr>
																								<?php $f += $key->amount; } 


																								?>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;" class="custom">
																								
																								<tr>
																		                            <td colspan="4" >GRAND TOTAL</td>
																		                            <td ><?php echo number_format($f, 2); ?></td>
																		                            </tr>
																		                        </tr>
																							</tfoot>
																						</table>
																					</td>
																				</tr>
																			</thead>
																		</table>
																	</div>
																</div>
															</div>
													<?php } ?>
												</div>
											<?php } ?>
											<hr class="light-grey-hr">
											<i>This document should be treated as confidencial</i> | <a href="javascript:;" onClick="printdoc();"><b>Print SGR</b></a> | <a class="text-primary" href="<?php echo base_url('report'); ?>" data-toggle="tooltip" title="Go Back"><i class=" icon-arrow-left-circle fa-1x"></i></a>
											
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
	<script type="text/javascript">  
		var getSum = function (colNumber) {
	    var sum = 0;
	    var selector = '.col' + colNumber;

	    $('#sum_table').find(selector).each(function (index, element) {
	        sum += parseInt($(element).text());
	    });  

	    return sum;        
	};

	$('#sum_table').find('.total').each(function (index, element) {
	    $(this).text('' + getSum(index + 1)); 
	});
	 </script>
	
</body>

</html>
