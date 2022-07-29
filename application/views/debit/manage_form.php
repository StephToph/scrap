<?php echo form_open_multipart($form_url, array('id'=>'bb_ajax_form', 'class'=>'form-horizontal')); ?>
<div class="row">
    <div id="bb_ajax_msg"></div>
    
    <?php if($param2 == 'delete') { // delete view ?>
        <div class="col-xs-12 text-center">
            <h3><b>Are you sure</b></h3>
            <input type="hidden" name="d_id" value="<?php if(!empty($d_id)){echo $d_id;} ?>" />
        </div>
        <div class="form-group text-center m-t-40">
            <div class="col-xs-12">
                <button class="btn btn-danger text-uppercase" type="submit">
                    <span class="btn-label"><i class="fa fa-trash-o"></i></span> Yes - Delete
                </button>
            </div>
        </div>
    <?php }elseif($param2 == 'view'){ ?>

        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div  class="panel-body pb-0">
                        <div  class="tab-struct custom-tab-1">
                            <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                                <li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span><?php echo $e_type; ?>Info</span></a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent_8">
                                <div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
                                    <div class="col-md-12 pb-20">
                                        <table class="table table-hover mb-0" >
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Code</td>
                                                    <td><?php echo $e_entry_code; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Date</td>
                                                    <td><?php echo date('d, F Y H:i:sa', strtotime($e_date)); ?></td>
                                                </tr>
                                                <?php if ($e_type == 'Debit') { ?>
                                                    <tr>
                                                        <td>Cheque No</td>
                                                        <td><?php echo $e_chq_no; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cheque Date</td>
                                                        <td><?php echo date('d-m-Y', strtotime($e_chq_date)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Debtor Name</td>
                                                        <td><?php echo  strtoupper($this->Crud->read_field('customer_id', $e_debtor_name, 'customer', 'surname').' '.$this->Crud->read_field('customer_id', $e_debtor_name, 'customer', 'firstname')); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Payment Mode</td>
                                                        <td><?php echo $e_pay_mode; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Amount</td>
                                                        <td><?php echo number_format($e_debt_amount); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Remark</td>
                                                        <td><?php echo $e_debt_remark; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Received By</td>
                                                        <td><?php echo $e_received_by; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Account</td>
                                                        <td><?php echo $this->Crud->read_field('id', $e_debtor_acct, 'account', 'account_num').' - '.$this->Crud->read_field('id', $e_debtor_acct, 'account', 'bank_name'); ?></td>
                                                    </tr>
                                                    
                                                   <tr>
                                                        <td>Paid By</td>
                                                        <td><?php echo $this->Crud->read_field('id', $e_paid_by, 'staff', 'surname').' '.$this->Crud->read_field('id', $e_paid_by, 'staff', 'firstname'); ?></td>
                                                    </tr>
                                                <?php } elseif ($e_type == 'Credit') { ?>
                                                    <tr>
                                                        <td>Source</td>
                                                        <td><?php echo $e_credit_source; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Status</td>
                                                        <td><?php echo $e_credit_status; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Amount</td>
                                                        <td><?php echo number_format($e_credit_amount); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Account</td>
                                                        <td><?php echo $this->Crud->read_field('id', $e_credit_acct, 'account', 'account_num').' - '.$this->Crud->read_field('id', $e_credit_acct, 'account', 'bank_name'); ?></td>
                                                    </tr>
                                                <?php } ?> 
                                                
                                            </tbody>
                                        </table>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                
        </div>
    <?php } elseif ($param2 == 'edit') {?>
        <input type="hidden" name="id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
        <?php if ($e_type == 'Debit') {?>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="business_name">Cheque No</label><br>    
                        <input class="form-control" type="text" name="chq_no" id="chq_no"  required value="<?php if(!empty($e_chq_no)){echo $e_chq_no;} ?>">
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="business_name">Cheque Date</label><br>    
                        <input class="form-control" type="date" name="chq_date" id="chq_date" required value="<?php if(!empty($e_chq_date)){echo $e_chq_date;} ?>">
                    </div>
                </div>
            </div>

             <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="business_name">Debtor Name</label><br>    
                        <select class="form-control" id="debtor_name" name="debtor_name" required>
                            <option value="">--Select--</option>
                                <?php $act = $this->Crud->read('customer'); foreach ($act as $key ) { ?>
                                    <option value="<?php echo $key->customer_id; ?>" <?php if(!empty($e_debtor_name)){if($e_debtor_name == $key->customer_id){echo 'selected';}} ?>><?php echo strtoupper($key->surname.' '.$key->firstname); ?></option>
                                <?php }?>
                           
                       </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="business_name">Payment Mode</label><br>    
                        <select class="form-control" id="pay_mode" name="pay_mode" required>
                            <option value="">--Select--</option>
                            <option value="Cash"  <?php if(!empty($e_pay_mode)){if($e_pay_mode == 'Cash'){echo 'selected';}} ?>>Cash</option>
                            <option value="Cheque"  <?php if(!empty($e_pay_mode)){if($e_pay_mode == 'Cheque'){echo 'selected';}} ?>>Cheque</option>
                            <option value="Transfer"  <?php if(!empty($e_pay_mode)){if($e_pay_mode == 'Transfer'){echo 'selected';}} ?>>Transfer</option>
                        </select>
                    </div>
                </div>
            </div>

             <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="business_name">Amount</label><br>    
                        <input class="form-control" type="text" name="debt_amount" id="debt_amount"  required value="<?php if(!empty($e_debt_amount)){echo $e_debt_amount;} ?>">
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="business_name">From Account</label><br>    
                        <select class="form-control" id="debtor_acct" name="debtor_acct" required>
                            <option value="">--Select--</option>
                                <?php $act = $this->Crud->read('account'); foreach ($act as $key ) { ?>
                                    <option value="<?php echo $key->id; ?>"  <?php if(!empty($e_debtor_acct)){if($e_debtor_acct == $key->id){echo 'selected';}} ?>><?php echo $key->account_num.' { '.$key->bank_name. ' }'; ?></option>
                                <?php } ?>
                           
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="business_name">Remark</label><br>    
                        <input class="form-control" type="text" name="debt_remark" id="debt_remark" required value="<?php if(!empty($e_debt_remark)){echo $e_debt_remark;} ?>">
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="business_name">Received By</label><br>    
                        <input class="form-control" type="text" name="received_by" id="received_by" required value="<?php if(!empty($e_received_by)){echo $e_received_by;} ?>">
                    </div>
                </div>
            </div>

            <div class="col-sm-12 text-center">
                <button class="btn btn-success btn-sm text-uppercase" type="submit">
                    <span class="btn-label"><i class="fa fa-save"></i></span> Save
                </button>
            </div>
        <?php } elseif ($e_type == 'Credit') {?>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="business_name">Payment Source</label><br>    
                        <select class="form-control" id="credit_source" name="credit_source" required>
                            <option value="">Select</option>
                            <option value="CASH" <?php if(!empty($e_credit_source)){if($e_credit_source == 'CASH'){echo "selected";}} ?>>CASH</option>
                            <option value="CHEQUE" <?php if(!empty($e_credit_source)){if($e_credit_source == 'CHEQUE'){echo "selected";}} ?>>CHEQUE</option>
                            <option value="COMMISSION" <?php if(!empty($e_credit_source)){if($e_credit_source == 'COMMISSION'){echo "selected";}} ?>>COMMISSION</option>
                            <option value="SGR AMOUNT" <?php if(!empty($e_credit_source)){if($e_credit_source == 'SGR AMOUNT'){echo "selected";}} ?>>SGR AMOUNT</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="business_name">Payment Status</label><br>    
                        <select class="form-control Select" id="credit_status" name="credit_status" required >
                            <option value="">--Select--</option>
                            <option value="PAID" <?php if(!empty($e_credit_status)){if($e_credit_status == 'PAID'){echo "selected";}} ?>>PAID</option>
                            <option value="OWING" <?php if(!empty($e_credit_status)){if($e_credit_status == 'OWING'){echo "selected";}} ?>>OWING</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="business_name">Credit Amount</label><br>    
                        <input class="form-control" type="text" name="credit_amount" id="credit_amount" value="<?php if(!empty($e_credit_amount)){echo $e_credit_amount; } ?>" required>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label for="business_name">To Account</label><br>    
                        <select class="form-control" id="credit_acct" name="credit_acct" required>
                            <option value="">--Select--</option>
                                <?php $act = $this->Crud->read('account'); foreach ($act as $key ) { ?>
                                    <option value="<?php echo $key->id; ?>" <?php if(!empty($e_credit_acct)){if($e_credit_acct == $key->id){echo 'selected'; }} ?>><?php echo $key->account_num.' { '.$key->bank_name. ' }'; ?></option>
                               <?php  } ?>
                           
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 text-center">
                <button class="btn btn-success btn-sm text-uppercase" type="submit">
                    <span class="btn-label"><i class="fa fa-save"></i></span> Save
                </button>
            </div>
        <?php } ?>
    <?php } else { // insert/edit view ?>
		 
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="business_name">Entry Type</label><br>    
                    <select class="form-control Select" id="type" name="type" required onchange="typ();">
                        <option value="">--Select--</option>
                        <option value="Debit">DEBIT</option>
                        <option value="Credit">CREDIT</option>
                    </select>
                </div>
            </div>
        </div>

        <div id="typ_response">
            
        </div>

        <div class="col-sm-12 text-center">
			<button class="btn btn-success btn-sm text-uppercase" type="submit">
				<span class="btn-label"><i class="fa fa-save"></i></span> Save
			</button>
        </div>
    <?php } ?>
</div>
<?php echo form_close(); ?>

<script src="<?php echo base_url(); ?>assets/jsform.js"></script>
<script>
    function typ() {
        var type = $('#type').val();
        $.ajax({
            url: '<?php echo base_url('debit/type/'); ?>'+ type,
            success: function(data) {
                $('#typ_response').html(data);
            }
        });

    }

</script>