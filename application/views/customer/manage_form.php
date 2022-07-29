<?php echo form_open_multipart($form_url, array('id'=>'bb_ajax_form', 'class'=>'form-horizontal')); ?>

    <div id="bb_ajax_msg"></div>
    
    <?php if($param2 == 'delete') { // delete view ?>
        <div class="row">
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
    <?php } elseif ($param2 == 'view') { ?>
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div  class="panel-body pb-0">
                            <div  class="tab-struct custom-tab-1">
                                <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                                    <li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>Customer Info</span></a></li>
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
                                                        <td>Full Name</td>
                                                        <td><?php echo strtoupper($e_surname.' '.$e_firstname); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Customer ID</td>
                                                        <td><?php echo $e_customer_id; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gender</td>
                                                        <td><?php echo $e_gender; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>State</td>
                                                        <td><?php echo $e_state; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone</td>
                                                        <td><?php echo $e_phone; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email Address</td>
                                                        <td><?php echo $e_email; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Registration Date</td>
                                                        <td><?php echo date('d, F Y', strtotime($e_reg_date)); ?></td>
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
        </div>
    <?php } else { // insert/edit view ?>
        <div class="row">
            <input type="hidden" name="id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
            <div class="rw">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Surname</label>
                            <input type="text" id="surname" name="surname" class="form-control" placeholder="John" required  value="<?php if(!empty($e_surname)){echo $e_surname;} ?>"> 
                        </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">First Name</label>
                            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Doe" required value="<?php if(!empty($e_firstname)){echo $e_firstname;} ?>"> 
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Gender</label>
                            <select class="form-control select2" name="gender" id="gender" required>
                                <option value="">--Select Gender--</option>
                                <option value="Male" <?php if(!empty($e_gender)){if($e_gender == 'Male'){echo 'selected';}} ?>>Male</option>
                                <option value="Female" <?php if(!empty($e_gender)){if($e_gender == 'Female'){echo "selected";}}; ?>>Female</option>
                            </select> 
                        </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">State of Origin</label>
                            <select class="form-control select2" name="state" id="state" required>
                                <option value="">--Select State of Origin</option>
                                <?php $st = $this->Crud->read_single_order('country_id', '161', 'states', 'name', 'asc'); foreach ($st as $key) {?>                
                                <option value="<?php echo $key->name; ?>" <?php if(!empty($e_state)){if($e_state == $key->name){echo 'selected';}}; ?>><?php echo strtoupper($key->name); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Phone</label>
                            <input class="form-control" type="text" name="phone" maxlength="11" minlength="11" id="phone" required value="<?php if(!empty($e_phone)){echo $e_phone;} ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Email</label>
                            <input type="email" name="email" id="email" required class="form-control" oninput="check_email();" value="<?php if(!empty($e_email)){echo $e_email;} ?>">
                        </div><div id="email_response"></div>
                    </div>
                </div>
                <!--/span-->
            </div>

            <div class="col-sm-12 text-center">
                <button class="btn btn-success btn-sm text-uppercase" type="submit">
                    <span class="btn-label"><i class="fa fa-save"></i></span> Save
                </button>
            </div>
        </div>
    <?php } ?>
</div>
<?php echo form_close(); ?>

<script src="<?php echo base_url(); ?>assets/jsform.js"></script>
