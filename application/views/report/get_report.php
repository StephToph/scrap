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
													<?php $ser = $this->Crud->date_range($param2, 'date', $param3, 'date', 'scrap');
														if (empty($ser)) { ?>
															<div align="right">0 Record</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table style="border: 1px;"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered mb-0">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Customer</td>
																		                            <td>Company</td>
																		                            <td >Vehicle</td>
																		                            <td >Slip No.</td>
																		                            <td align="center">G/W</td>
																		                            <td align="center">T/W</td>
																		                            <td align="center">NET/W</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) { ?>
																		                             <td align="center"><?php echo $ke->code; ?></td><?php } ?>
																		                             <td align="center">Qty-Dust</td>
																		                            <td align="right">AUG Amt. (&#8358;)</td>
																		                            <td align="right">Company Amt. (&#8358;)</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<tr>
																									<td colspan="17">NO RECORD</td>
																								</tr>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								<tr>
																		                            <td colspan="5" >GRAND TOTAL</td>
																		                            <td ><div>G/W</div>0</td>
																		                            <td ><div>T/W</div>0</td>
																		                            <td ><div>NET/W</div>0</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             <td align="center"><div><?php echo $ke->code; ?></div>0</td><?php } ?>
																		                            <td><div>QTY - DUST</div>0</td>
																		                            <td  align="right"><div>AUG Amt</div>
																										&#8358;0.00</td>
																		                            <td  align="right"><div>Company Amt</div>
																										&#8358;0.00</td>
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
																		<table style="border: 1px; width: auto;height: auto;"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered table-responsive" id="sum_table">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Customer</td>
																		                            <td>Company</td>
																		                            <td >Vehicle</td>
																		                            <td >Slip No.</td>
																		                            <td align="center">G/W</td>
																		                            <td align="center">T/W</td>
																		                            <td align="center">NET/W</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             <td align="center"><?php echo $ke->code; ?></td>
																		                            <?php } ?>
																		                            <td align="center">Qty-Dust</td>
																		                            <td align="right">AUG Amt. (&#8358;)</td>
																		                            <td align="right">Company Amt. (&#8358;)</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<?php $f= 0; $g=0;$h=0;$a1=0;$a2=0;$a3=0;$a4=0;$a5=0;
																									foreach ($ser as $key) {?>
																									
																									<tr>
																										<td><?php echo $key->date; ?></td>
																										<td><?php echo strtoupper($this->Crud->read_field('customer_id', $key->customer_id, 'customer', 'surname').' '.$this->Crud->read_field('customer_id', $key->customer_id, 'customer', 'firstname')); ?></td>
																										<td><?php echo $key->supplied_to; ?></td>
																										<td><?php echo strtoupper($key->vehicle_no); ?></td>
																										<td><?php echo strtoupper($key->slip_no); ?></td>
																										<td><?php echo $key->gross; ?></td>
																										<td><?php echo $key->tare; ?></td>
																										<td>0</td>
																										<?php $cat = $this->Crud->read('category');
																												$i = 1;
																											foreach ($cat as $ky) { ?>
																										<td class="col<?php echo $i; ?>"><?php 
																											if($ky->code == $key->cat1){
																												echo $key->qty1;
																												
																											} elseif ($ky->code == $key->cat2) {
																												echo $key->qty2;
																											} elseif ($ky->code == $key->cat3) {
																												echo $key->qty3;
																											} elseif ($ky->code == $key->cat4) {
																												echo $key->qty4;
																											}  elseif ($ky->code == $key->cat5) {
																												echo $key->qty5;
																											} else { echo 0;}
																												?>
																																																							
																										</td><?php 
																										 
																										 $i++;
																										}
																											
																										 ?>
																										<td><?php echo round($key->netm_dust, 0); $f = $f+$key->netm_dust; ?></td>
																										<td><?php echo number_format($key->comm_amount);$g = $g+$key->comm_amount;  ?></td>
																										<td><?php echo number_format(round($key->comp_amount));$h = $h+$key->comp_amount;  ?></td>
																									</tr>
																								<?php } 


																								?>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;" class="custom">
																								
																								<tr>
																		                            <td colspan="5" rowspan="2">GRAND TOTAL</td>
																		                            <td>G/W</td>
																		                            <td>T/W</td>
																		                            <td>NET/W</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																			                            <td><?php echo $ke->code; ?></td>
																			                        <?php } ?>
																			                        <td>Qty-Dust</td>
																		                            <td>AUG Amt(&#8358;)</td>
																		                            <td>Company Amt(&#8358;)</td>
																		                            <tr>
																		                            	<td>0</td>
																		                            	<td>0</td>
																		                            	<td>0</td>
																		                            	 <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																				                            <td class="total"></td>
																				                        <?php } ?>
																				                        <td ><?php echo number_format($f);?></td>
																			                            <td  align="">
																											&#8358;<?php echo number_format($g, 2); ?></td>
																			                            <td  align="">
																											&#8358;<?php echo number_format($h, 2); ?></td>
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
											<?php } elseif ($report_type == 'summary_report') { ?>
												<h5 class="txt-dark capitalize-font" align="center"><?php echo $title; ?></h5>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<?php $ser = $this->Crud->date_range($param2, 'date', $param3, 'date', 'scrap');
														if (empty($ser)) {?>
															<div align="right">0 Record</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table style="border: 1px;"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered mb-0">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Company</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             <td align="center"><?php echo $ke->code; ?></td><?php } ?>
																		                             <td align="center">Qty-Dust</td>
																		                            <td align="right">AUG Amt. (&#8358;)</td>
																		                            <td align="right">Company Amt. (&#8358;)</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<tr>
																									<td colspan="17">NO RECORD</td>
																								</tr>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								<tr>
																		                            <td colspan="5" >GRAND TOTAL</td>
																		                           <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                            <td align="center"><div><?php echo $ke->code; ?></div>0</td><?php } ?>
																		                            <td ><div>QTY - DUST</div>0</td>
																		                            <td  align="right"><div>AUG Amt</div>
																										&#8358;0.00</td>
																		                            <td  align="right"><div>Company Amt</div>
																										&#8358;0.00</td>
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
																		<table class="table"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered0" id="sum_table">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Company</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             <td align="center"><?php echo $ke->code; ?></td>
																		                            <?php } ?>
																		                            <td align="center">Qty-Dust</td>
																		                            <td align="right">AUG Amt. (&#8358;)</td>
																		                            <td align="right">Company Amt. (&#8358;)</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<?php $a = 0; $b=0; $c=0;$d=0;$e=0;$f=0;$g=0;$h=0; 
																									
																								foreach ($ser as $key) {?>
																									
																									<tr>
																										<td><?php echo $key->supplied_to; ?></td>
																										<?php $cat = $this->Crud->read('category');
																												$i = 1;
																											foreach ($cat as $ky) { ?>
																										<td class="col<?php echo $i; ?>"><?php 
																											if($ky->code == $key->cat1){
																												echo $key->qty1;
																												
																											} elseif ($ky->code == $key->cat2) {
																												echo $key->qty2;
																											} elseif ($ky->code == $key->cat3) {
																												echo $key->qty3;
																											} elseif ($ky->code == $key->cat4) {
																												echo $key->qty4;
																											}  elseif ($ky->code == $key->cat5) {
																												echo $key->qty5;
																											} else { echo 0;}
																												?>
																																																							
																										</td><?php 
																										 
																										 $i++;
																										}
																											
																										 ?>
																										<td><?php echo round($key->netm_dust, 0); $f = $f+$key->netm_dust; ?></td>
																										<td><?php echo number_format($key->comm_amount);$g = $g+$key->comm_amount;  ?></td>
																										<td><?php echo number_format(round($key->comp_amount));$h = $h+$key->comp_amount;  ?></td>
																									</tr>
																								<?php  } ?>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								
																								<tr>
																		                            <td colspan="1" rowspan="2">GRAND TOTAL</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																			                            <td><?php echo $ke->code; ?></td>
																			                        <?php } ?>
																			                        <td>Qty-Dust</td>
																		                            <td>AUG Amt(&#8358;)</td>
																		                            <td>Company Amt(&#8358;)</td>
																		                            <tr>
																		                            	<?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             	<td align="center" class="total"></td>
																			                            <?php } ?>
																			                            <td ><?php echo number_format($f);?></td>
																			                            <td  align="">
																											&#8358;<?php echo number_format($g, 2); ?></td>
																			                            <td  align="">
																											&#8358;<?php echo number_format($h, 2); ?></td>
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
											<?php } elseif ($report_type == 'customer_report') {// echo $param4; ?>
												<h5 class="txt-dark capitalize-font" align="center"><?php echo $title; ?></h5>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<?php $ser = $this->Crud->date_range1($param3, 'date', $param2, 'date', 'customer_id', $param4, 'scrap');
														if (empty($ser)) { ?>
															<div align="right">0 Record</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table style="border: 1px;"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered mb-0">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Customer</td>
																		                            <td>Company</td>
																		                            <td >Vehicle</td>
																		                            <td >Slip No.</td>
																		                            <td align="center">G/W</td>
																		                            <td align="center">T/W</td>
																		                            <td align="center">NET/W</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) { ?>
																		                             <td align="center"><?php echo $ke->code; ?></td><?php } ?>
																		                             <td align="center">Qty-Dust</td>
																		                            <td align="right">AUG Amt. (&#8358;)</td>
																		                            <td align="right">Company Amt. (&#8358;)</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<tr>
																									<td colspan="17">NO RECORD</td>
																								</tr>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								<tr>
																		                            <td colspan="5" >GRAND TOTAL</td>
																		                            <td ><div>G/W</div>0</td>
																		                            <td ><div>T/W</div>0</td>
																		                            <td ><div>NET/W</div>0</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             <td align="center"><div><?php echo $ke->code; ?></div>0</td><?php } ?>
																		                            <td><div>QTY - DUST</div>0</td>
																		                            <td  align="right"><div>AUG Amt</div>
																										&#8358;0.00</td>
																		                            <td  align="right"><div>Company Amt</div>
																										&#8358;0.00</td>
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
																		<table style="border: 1px; width: auto;height: auto;"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered0" id="sum_table">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Customer</td>
																		                            <td>Company</td>
																		                            <td >Vehicle</td>
																		                            <td >Slip No.</td>
																		                            <td align="center">G/W</td>
																		                            <td align="center">T/W</td>
																		                            <td align="center">NET/W</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             <td align="center"><?php echo $ke->code; ?></td>
																		                            <?php } ?>
																		                            <td align="center">Qty-Dust</td>
																		                            <td align="right">AUG Amt. (&#8358;)</td>
																		                            <td align="right">Company Amt. (&#8358;)</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<?php $a = 0; $b=0; $c=0;$d=0;$e=0;$f=0;$g=0;$h=0; foreach ($ser as $key) {?>
																									
																									<tr>
																										<td><?php echo $key->date; ?></td>
																										<td><?php echo strtoupper($this->Crud->read_field('customer_id', $key->customer_id, 'customer', 'surname').' '.$this->Crud->read_field('customer_id', $key->customer_id, 'customer', 'firstname')); ?></td>
																										<td><?php echo $key->supplied_to; ?></td>
																										<td><?php echo strtoupper($key->vehicle_no); ?></td>
																										<td><?php echo $key->slip_no; ?></td>
																										<td><?php echo $key->gross; ?></td>
																										<td><?php echo $key->tare; ?></td>
																										<td>0</td>
																										<?php $cat = $this->Crud->read('category');
																												$i = 1;
																											foreach ($cat as $ky) { ?>
																										<td class="col<?php echo $i; ?>"><?php 
																											if($ky->code == $key->cat1){
																												echo $key->qty1;
																												
																											} elseif ($ky->code == $key->cat2) {
																												echo $key->qty2;
																											} elseif ($ky->code == $key->cat3) {
																												echo $key->qty3;
																											} elseif ($ky->code == $key->cat4) {
																												echo $key->qty4;
																											}  elseif ($ky->code == $key->cat5) {
																												echo $key->qty5;
																											} else { echo 0;}
																												?>
																																																							
																										</td><?php 
																										 
																										 $i++;
																										}
																											
																										 ?>
																										<td><?php echo round($key->netm_dust, 0); $f = $f+$key->netm_dust; ?></td>
																										<td><?php echo number_format($key->comm_amount);$g = $g+$key->comm_amount;  ?></td>
																										<td><?php echo number_format(round($key->comp_amount));$h = $h+$key->comp_amount;  ?></td>
																									</tr>
																								<?php  } ?>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								
																								<tr>
																		                            <td colspan="5" rowspan="2">GRAND TOTAL</td>
																		                            <td>G/W</td>
																		                            <td>T/W</td>
																		                            <td>NET/W</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																			                            <td><?php echo $ke->code; ?></td>
																			                        <?php } ?>
																			                        <td>Qty-Dust</td>
																		                            <td>AUG Amt(&#8358;)</td>
																		                            <td>Company Amt(&#8358;)</td>
																		                            <tr>
																		                            	<td>0</td>
																		                            	<td>0</td>
																		                            	<td>0</td>
																		                            	<?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             	<td align="center" class="total">
																		                             	
																			                             	</td>
																			                            <?php } ?>
																			                            <td ><?php echo number_format($f);?></td>
																			                            <td  align="right">
																											&#8358;<?php echo number_format($g, 2); ?></td>
																			                            <td  align="right">
																											&#8358;<?php echo number_format($h, 2); ?></td>
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
											<?php } elseif ($report_type == 'register_report') {// echo $param4; ?>
												<h5 class="txt-dark capitalize-font" align="center"><?php echo $title; ?></h5>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<?php $ser = $this->Crud->date_range1($param3, 'date', $param2, 'date', 'prepared_by', $param4, 'scrap');
														if (empty($ser)) { ?>
															<div align="right">0 Record</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table style="border: 1px;"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered mb-0">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Customer</td>
																		                            <td>Company</td>
																		                            <td >Vehicle</td>
																		                            <td >Slip No.</td>
																		                            <td align="center">G/W</td>
																		                            <td align="center">T/W</td>
																		                            <td align="center">NET/W</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) { ?>
																		                             <td align="center"><?php echo $ke->code; ?></td><?php } ?>
																		                             <td align="center">Qty-Dust</td>
																		                            <td align="right">AUG Amt. (&#8358;)</td>
																		                            <td align="right">Company Amt. (&#8358;)</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<tr>
																									<td colspan="17">NO RECORD</td>
																								</tr>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								<tr>
																		                            <td colspan="5" >GRAND TOTAL</td>
																		                            <td ><div>G/W</div>0</td>
																		                            <td ><div>T/W</div>0</td>
																		                            <td ><div>NET/W</div>0</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             <td align="center"><div><?php echo $ke->code; ?></div>0</td><?php } ?>
																		                            <td><div>QTY - DUST</div>0</td>
																		                            <td  align="right"><div>AUG Amt</div>
																										&#8358;0.00</td>
																		                            <td  align="right"><div>Company Amt</div>
																										&#8358;0.00</td>
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
																		<table style="border: 1px; width: auto;height: auto;"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered0" id="sum_table">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Customer</td>
																		                            <td>Company</td>
																		                            <td >Vehicle</td>
																		                            <td >Slip No.</td>
																		                            <td align="center">G/W</td>
																		                            <td align="center">T/W</td>
																		                            <td align="center">NET/W</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             <td align="center"><?php echo $ke->code; ?></td>
																		                            <?php } ?>
																		                            <td align="center">Qty-Dust</td>
																		                            <td align="right">AUG Amt. (&#8358;)</td>
																		                            <td align="right">Company Amt. (&#8358;)</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<?php $a = 0; $b=0; $c=0;$d=0;$e=0;$f=0;$g=0;$h=0; foreach ($ser as $key) {?>
																									
																									<tr>
																										<td><?php echo $key->date; ?></td>
																										<td><?php echo strtoupper($this->Crud->read_field('customer_id', $key->customer_id, 'customer', 'surname').' '.$this->Crud->read_field('customer_id', $key->customer_id, 'customer', 'firstname')); ?></td>
																										<td><?php echo $key->supplied_to; ?></td>
																										<td><?php echo strtoupper($key->vehicle_no); ?></td>
																										<td><?php echo $key->slip_no; ?></td>
																										<td><?php echo $key->gross; ?></td>
																										<td><?php echo $key->tare; ?></td>
																										<td>0</td>
																										<?php $cat = $this->Crud->read('category');
																												$i = 1;
																											foreach ($cat as $ky) { ?>
																										<td class="col<?php echo $i; ?>"><?php 
																											if($ky->code == $key->cat1){
																												echo $key->qty1;
																												
																											} elseif ($ky->code == $key->cat2) {
																												echo $key->qty2;
																											} elseif ($ky->code == $key->cat3) {
																												echo $key->qty3;
																											} elseif ($ky->code == $key->cat4) {
																												echo $key->qty4;
																											}  elseif ($ky->code == $key->cat5) {
																												echo $key->qty5;
																											} else { echo 0;}
																												?>
																																																							
																										</td><?php 
																										 
																										 $i++;
																										}
																											
																										 ?>
																										<td><?php echo round($key->netm_dust, 0); $f = $f+$key->netm_dust; ?></td>
																										<td><?php echo number_format($key->comm_amount);$g = $g+$key->comm_amount;  ?></td>
																										<td><?php echo number_format(round($key->comp_amount));$h = $h+$key->comp_amount;  ?></td>
																									</tr>
																								<?php } ?>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								
																								<tr>
																		                            <td colspan="5" rowspan="2">GRAND TOTAL</td>
																		                            <td>G/W</td>
																		                            <td>T/W</td>
																		                            <td>NET/W</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																			                            <td><?php echo $ke->code; ?></td>
																			                        <?php } ?>
																			                        <td>Qty-Dust</td>
																		                            <td>AUG Amt(&#8358;)</td>
																		                            <td>Company Amt(&#8358;)</td>
																		                            <tr>
																		                            	<td>0</td>
																		                            	<td>0</td>
																		                            	<td>0</td>
																		                            	<?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             	<td align="center" class="total">
																		                             	
																			                             	</td>
																			                            <?php } ?>
																			                            <td ><?php echo number_format($f);?></td>
																			                            <td  align="right">
																											&#8358;<?php echo number_format($g, 2); ?></td>
																			                            <td  align="right">
																											&#8358;<?php echo number_format($h, 2); ?></td>
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
											<?php } elseif ($report_type == 'company_report') {// echo $param4; ?>
												<h5 class="txt-dark capitalize-font" align="center"><?php echo $title; ?></h5>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<?php $ser = $this->Crud->date_range1($param3, 'date', $param2, 'date', 'supplied_to', $param4, 'scrap');
														if (empty($ser)) { ?>
															<div align="right">0 Record</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table style="border: 1px;"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered mb-0">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Customer</td>
																		                            <td>Company</td>
																		                            <td >Vehicle</td>
																		                            <td >Slip No.</td>
																		                            <td align="center">G/W</td>
																		                            <td align="center">T/W</td>
																		                            <td align="center">NET/W</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) { ?>
																		                             <td align="center"><?php echo $ke->code; ?></td><?php } ?>
																		                             <td align="center">Qty-Dust</td>
																		                            <td align="right">AUG Amt. (&#8358;)</td>
																		                            <td align="right">Company Amt. (&#8358;)</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<tr>
																									<td colspan="17">NO RECORD</td>
																								</tr>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								<tr>
																		                            <td colspan="5" >GRAND TOTAL</td>
																		                            <td ><div>G/W</div>0</td>
																		                            <td ><div>T/W</div>0</td>
																		                            <td ><div>NET/W</div>0</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             <td align="center"><div><?php echo $ke->code; ?></div>0</td><?php } ?>
																		                            <td><div>QTY - DUST</div>0</td>
																		                            <td  align="right"><div>AUG Amt</div>
																										&#8358;0.00</td>
																		                            <td  align="right"><div>Company Amt</div>
																										&#8358;0.00</td>
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
																		<table style="border: 1px; width: auto;height: auto;"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered0" id="sum_table">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Customer</td>
																		                            <td>Company</td>
																		                            <td >Vehicle</td>
																		                            <td >Slip No.</td>
																		                            <td align="center">G/W</td>
																		                            <td align="center">T/W</td>
																		                            <td align="center">NET/W</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             <td align="center"><?php echo $ke->code; ?></td>
																		                            <?php } ?>
																		                            <td align="center">Qty-Dust</td>
																		                            <td align="right">AUG Amt. (&#8358;)</td>
																		                            <td align="right">Company Amt. (&#8358;)</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<?php $a = 0; $b=0; $c=0;$d=0;$e=0;$f=0;$g=0;$h=0; foreach ($ser as $key) {?>
																									
																									<tr>
																										<td><?php echo $key->date; ?></td>
																										<td><?php echo strtoupper($this->Crud->read_field('customer_id', $key->customer_id, 'customer', 'surname').' '.$this->Crud->read_field('customer_id', $key->customer_id, 'customer', 'firstname')); ?></td>
																										<td><?php echo $key->supplied_to; ?></td>
																										<td><?php echo strtoupper($key->vehicle_no); ?></td>
																										<td><?php echo $key->slip_no; ?></td>
																										<td><?php echo $key->gross; ?></td>
																										<td><?php echo $key->tare; ?></td>
																										<td>0</td>
																										<?php $cat = $this->Crud->read('category');
																												$i = 1;
																											foreach ($cat as $ky) { ?>
																										<td class="col<?php echo $i; ?>"><?php 
																											if($ky->code == $key->cat1){
																												echo $key->qty1;
																												
																											} elseif ($ky->code == $key->cat2) {
																												echo $key->qty2;
																											} elseif ($ky->code == $key->cat3) {
																												echo $key->qty3;
																											} elseif ($ky->code == $key->cat4) {
																												echo $key->qty4;
																											}  elseif ($ky->code == $key->cat5) {
																												echo $key->qty5;
																											} else { echo 0;}
																												?>
																																																							
																										</td><?php 
																										 
																										 $i++;
																										}
																											
																										 ?><td><?php echo round($key->netm_dust, 0); $f = $f+$key->netm_dust; ?></td>
																										<td><?php echo number_format($key->comm_amount);$g = $g+$key->comm_amount;  ?></td>
																										<td><?php echo number_format(round($key->comp_amount));$h = $h+$key->comp_amount;  ?></td>
																									</tr>
																								<?php } ?>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								
																								<tr>
																		                            <td colspan="5" rowspan="2">GRAND TOTAL</td>
																		                            <td>G/W</td>
																		                            <td>T/W</td>
																		                            <td>NET/W</td>
																		                            <?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																			                            <td><?php echo $ke->code; ?></td>
																			                        <?php } ?>
																			                        <td>Qty-Dust</td>
																		                            <td>AUG Amt(&#8358;)</td>
																		                            <td>Company Amt(&#8358;)</td>
																		                            <tr>
																		                            	<td>0</td>
																		                            	<td>0</td>
																		                            	<td>0</td>
																		                            	<?php $cat = $this->Crud->read('category'); foreach ($cat as $ke) {?>
																		                             	<td align="center" class="total">
																		                             	
																			                             	</td>
																			                            <?php } ?>
																			                            <td ><?php echo number_format($f);?></td>
																			                            <td  align="right">
																											&#8358;<?php echo number_format($g, 2); ?></td>
																			                            <td  align="right">
																											&#8358;<?php echo number_format($h, 2); ?></td>
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
											<?php } elseif ($report_type == 'dpo_report') {// echo $param4; ?>
												<h5 class="txt-dark capitalize-font" align="center"><?php echo $title; ?></h5>
												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<?php $ser = $this->Crud->date_range($param2, 'date', $param3, 'date', 'scrap');
														if (empty($ser)) { ?>
															<div align="right">0 Record</div>
															<div class="panel panel-default cardview">
																<div class="pane-wrapper collapse in">
																	<div class="panel-body">
																		<table class="table"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered mb-0">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Customer</td>
																		                            <td>Company</td>
																		                            <td >Vehicle</td>
																		                            <td align="right">Dir. Adv.(&#8358;)</td>
																		                            <td align="right">Dri. Adv.(&#8358;)</td>
																		                            <td align="right">Offload Amt.(&#8358;)</td>
																		                            <td align="right">Rev Amt. (&#8358;)</td>
																		                            <td align="right">Escort(&#8358;)</td>
																		                            <td align="right">Cus. Rep.(&#8358;)</td>
																		                            <td align="right">Total(&#8358;)</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<tr>
																									<td colspan="17">NO RECORD</td>
																								</tr>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								<tr>
																		                            <td colspan="4" >GRAND TOTAL</td>
																		                            <td><div>Dir. Adv.(&#8358;)</div>0.00</td>
																		                            <td><div>Dri. Adv.(&#8358;)</div>0.00</td>
																		                            <td><div>Offload Amt.(&#8358;)</div>0.00</td>
																		                            <td><div>Rev Amt. (&#8358;)</div>0.00</td>
																		                            <td><div>Escort(&#8358;)</div>0.00</td>
																		                            <td><div>Cus. Rep.</div>&#8358;0.00</td>
																		                            <td><div>Total</div>&#8358;0.00</td>
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
																		<table class="table"> 
																			<thead style="color: black;">
																				<tr>
																					<td>
																						<table class="table table-hovr table-bordered0">
																							<thead>
																								<tr style="font-weight: bold; font-size: 13px">
																									<td>Date</td>
																		                            <td>Customer</td>
																		                            <td>Company</td>
																		                            <td >Vehicle</td>
																		                            <td align="right">Dir. Adv.(&#8358;)</td>
																		                            <td align="right">Dri. Adv.(&#8358;)</td>
																		                            <td align="right">Offload Amt.(&#8358;)</td>
																		                            <td align="right">Rev Amt. (&#8358;)</td>
																		                            <td align="right">Escort(&#8358;)</td>
																		                            <td align="right">Cus. Rep.(&#8358;)</td>
																		                            <td align="right">Total(&#8358;)</td>
																								</tr>
																							</thead>
																							<tbody style="font-size: 12px; text-align: center;">
																								<?php  $a = 0;$b=0; $c=0;$d=0;$e=0;$f=0;$g=0;$h=0; foreach ($ser as $key) {

																									$total = $this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'total_deduction') - $this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'balance_paid');
																									//echo $total;
																									?>
																									
																									<tr>
																										<td><?php echo $key->date; ?></td>
																										<td><?php echo strtoupper($this->Crud->read_field('customer_id', $key->customer_id, 'customer', 'surname').' '.$this->Crud->read_field('customer_id', $key->customer_id, 'customer', 'firstname')); ?></td>
																										<td><?php echo $key->supplied_to; ?></td>
																										<td><?php echo strtoupper($key->vehicle_no); ?></td>
																										<td><?php echo number_format($this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'direct_advance')); $a += $this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'direct_advance'); ?></td>
																										<td><?php echo number_format($this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'driver_advance')); $b += $this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'driver_advance'); ?></td>
																										<td><?php echo number_format($this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'offloading'));$c += $this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'offloading'); ?></td>
																										<td><?php echo number_format($this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'revenue'));$d +=$this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'revenue'); ?></td>
																										<td><?php echo number_format($this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'escort')); $e +=$this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'escort');  ?></td>
																										<td><?php echo number_format($this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'custom_rep'));$f +=$this->Crud->read_field('scrap_id', $key->scrap_id, 'scrap_pay', 'custom_rep'); ?></td>
																										<td><?php echo number_format($total);$g += $total; ?></td>
																									</tr>
																								<?php } ?>
																							</tbody>
																							<tfoot style="background-color:#ddd;font-weight: bold;font-size: 12px; text-align: center;">
																								
																								<tr>
																		                            <td colspan="4" rowspan="2">GRAND TOTAL</td>
																		                            <td><div>Dir. Adv.(&#8358;)</div></td>
																		                            <td><div>Dri. Adv.(&#8358;)</div></td>
																		                            <td><div>Offload Amt.(&#8358;)</div></td>
																		                            <td><div>Rev Amt. (&#8358;)</div></td>
																		                            <td><div>Escort(&#8358;)</div></td>
																		                            <td><div>Cus. Rep.</div>&#8358;</td>
																		                            <td><div>Total</div>&#8358;</td>
																		                            <tr>
																		                            	<td><?php echo number_format($a, 2); ?></td>
																		                            	<td><?php echo number_format($b, 2); ?></td>
																		                            	<td><?php echo number_format($c, 2); ?></td>
																		                            	<td><?php echo number_format($d, 2); ?></td>
																		                            	<td ><?php echo number_format($e, 2);?></td>
																			                            <td  align="right">
																											&#8358;<?php echo number_format($f, 2); ?></td>
																			                            <td  align="right">
																											&#8358;<?php echo number_format($g, 2); ?></td>
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
