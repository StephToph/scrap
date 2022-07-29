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
                                <li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>Inward Cheque Info</span></a></li>
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
                                                    <td>Company</td>
                                                    <td><?php echo strtoupper($this->Crud->read_field('code', $e_company, 'company', 'name')); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Received Date</td>
                                                    <td><?php echo date('d, F Y', strtotime($e_date)); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Cheque No</td>
                                                    <td><?php echo $e_cheque_no; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Amount</td>
                                                    <td><?php echo number_format($e_amount); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Payment Type</td>
                                                    <td><?php echo $e_pay_type; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Payment Account</td>
                                                    <td><?php echo $this->Crud->read_field('id', $e_pay_account, 'account', 'account_num').' - '.$this->Crud->read_field('id', $e_pay_account, 'account', 'account_name'); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Remark</td>
                                                    <td><?php echo $e_remark; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>User</td>
                                                    <td><?php echo $this->Crud->read_field('id', $e_user, 'staff', 'surname').' '.$this->Crud->read_field('id', $e_user, 'staff', 'firstname'); ?></td>
                                                </tr>
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
    <?php } else { // insert/edit view ?>
		<input type="hidden" name="id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
        
        <div class="col-sm-6">
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="business_name">Company</label><br>    
                    <select class="form-control Select" id="company" name="company" required>
                        <option value="">--Select--</option>
                        <?php $pre = $this->Crud->read('company'); foreach ($pre as $key) {?>
                            <option value="<?php echo $key->code; ?>" <?php if(!empty($e_company)){if($e_company == $key->code){echo "selected";}} ?>><?php echo strtoupper($key->name); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="name">Cheque No</label><br>  
                    <input class="form-control" type="text" id="cheque_no" name="cheque_no" value="<?php if(!empty($e_cheque_no)){echo $e_cheque_no;} ?>" required>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="name">Mode of Payment</label><br>
                    <select class="form-control Select" id="pay_type" name="pay_type" required>
                        <option value="">--Select--</option>
                        <option value="CASH" <?php if(!empty($e_pay_type)){if($e_pay_type == 'CASH'){echo "selected";}} ?>>CASH</option>
                        <option value="CHEQUE" <?php if(!empty($e_pay_type)){if($e_pay_type == 'CHEQUE'){echo "selected";}} ?>>CHEQUE</option>
                        <option value="TRANSFER" <?php if(!empty($e_pay_type)){if($e_pay_type == 'TRANSFER'){echo "selected";}} ?>>TRANSFER</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="business_name">Amount</label><br>    
                    <input class="form-control" type="text" id="amount" name="amount" value="<?php if(!empty($e_amount)){echo $e_amount;} ?>" required>
                </div>
            </div>
        </div>

         <div class="col-sm-6">
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="business_name">Account Payment</label><br>    
                    <select class="form-control Select" id="pay_account" name="pay_account" required>
                        <option value="">--Select--</option>
                        <?php $pre = $this->Crud->read('account'); foreach ($pre as $key) {?>
                            <option value="<?php echo $key->id; ?>" <?php if(!empty($e_pay_account)){if($e_pay_account == $key->id){echo "selected";}} ?>><?php echo strtoupper($key->account_num.' - '.$key->account_name); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="name">Remark</label><br>  
                    <input class="form-control" type="text" id="remark" name="remark" value="<?php if(!empty($e_remark)){echo $e_remark;} ?>" required>
                </div>
            </div>
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
