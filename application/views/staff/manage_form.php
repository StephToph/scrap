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
            <div class="col-lg-4 col-xs-12">
                <div class="panel panel-default card-view  pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body  pa-0">
                            <div class="profile-box">
                                <div class="profile-cover-pic">
                                    <div class="fileupload btn btn-default">
                                        <span class="btn-text"></span>
                                        <input class="upload" type="file">
                                    </div>
                                    <div class="profile-image-overlay"></div>
                                </div>
                                <div class="profile-info text-center">
                                    <div class="profile-img-wrap">
                                        <img class="inline-block mb-10" src="<?php echo base_url(); ?>assets/img/mock1.jpg" alt="user"/>
                                        <div class="fileupload btn btn-default">
                                            <span class="btn-text"></span>
                                            <input class="upload" type="file">
                                        </div>
                                    </div>  
                                    <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-orange"><?php echo strtoupper($e_surname.' '.$e_firstname); ?></h5>
                                    <h6 class="block capitalize-font pb-20"><?php echo $e_designation; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div  class="panel-body pb-0">
                            <div  class="tab-struct custom-tab-1">
                                <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                                    <li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>Basic Info</span></a></li>
                                    <li  role="presentation" class="next"><a aria-expanded="true"  data-toggle="tab" role="tab" id="follo_tab_8" href="#follo_8"><span>Contact</span></a></li>
                                    <li role="presentation" class=""><a  data-toggle="tab" id="photos_tab_8" role="tab" href="#photos_8" aria-expanded="false"><span>Guarantor</span></a></li>
                                    
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
                                                        <td>Gender</td>
                                                        <td><?php echo $e_gender; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date of Birth</td>
                                                        <td><?php echo date('d, F Y', strtotime($e_reg_date)); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Marital Status</td>
                                                        <td><?php echo $e_marital; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Qualification</td>
                                                        <td><?php echo $e_qualification; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Designation</td>
                                                        <td><?php echo $e_designation; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Branch</td>
                                                        <td><?php echo $e_branch; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>  
                                    </div>
                                    <div  id="follo_8" class="tab-pane fade " role="tabpanel">
                                        <div class="col-md-12">
                                            <div class="pt-20">
                                                <div class="streamline user-activity">
                                                    <table class="table table-hover mb-0" >
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Description</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Address</td>
                                                                <td><?php echo $e_address; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Postal</td>
                                                                <td><?php echo $e_postal; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>State of Origin</td>
                                                                <td><?php echo $e_state; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nationality</td>
                                                                <td><?php echo $e_nationality; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Phone Number</td>
                                                                <td><?php echo $e_phone; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Email Address</td>
                                                                <td><?php echo $e_email; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div  id="photos_8" class="tab-pane fade" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <table class="table table-hover mb-0" >
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Relationship</td>
                                                            <td><?php echo $e_relationship; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Guarantor Name</td>
                                                            <td><?php echo $e_name; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td><?php echo $e_g_address; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Occupation</td>
                                                            <td><?php echo $e_occupation; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone Number</td>
                                                            <td><?php echo $e_g_phone; ?></td>
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
        </div>
    <?php } else { // insert/edit view ?>
        <div class="row">
            <input type="hidden" name="id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Person's Info</h6>
            <hr class="light-grey-hr"/>
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
                            <label class="control-label mb-10">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" placeholder="dd/mm/yyyy" required value="<?php if(!empty($e_dob)){echo $e_dob;} ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Marital Status</label>
                            <select class="form-control select2" name="marital" id="marital" required>
                                <option value="">Select</option>
                                <option value="Single" <?php if(!empty($e_marital)){if($e_marital == 'Single'){echo 'selected';}}; ?>>Single</option>
                                <option value="Married" <?php if(!empty($e_marital)){if($e_marital == 'Married'){echo 'selected';}}; ?>>Married</option>
                                <option value="Divorced" <?php if(!empty($e_marital)){if($e_marital == 'Divorced'){echo 'selected';}}; ?>>Divorced</option>
                                <option value="Widowed" <?php if(!empty($e_marital)){if($e_marital == 'Widowed'){echo 'selected';}}; ?>>Widowed</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Qualification</label>
                            <select class="form-control select2" name="qualification" id="qualification" required>
                                <option value="">--Select Qualification--</option>
                                <option value="OND" <?php if(!empty($e_qualification)){if($e_qualification == 'OND'){echo 'selected';}}; ?>>OND</option>
                                <option value="HND" <?php if(!empty($e_qualification)){if($e_qualification == 'HND'){echo 'selected';}}; ?>>HND</option>
                                <option value="BSc" <?php if(!empty($e_qualification)){if($e_qualification == 'BSc'){echo 'selected';}}; ?>>BSc</option>
                                <option value="NCE" <?php if(!empty($e_qualification)){if($e_qualification == 'NCE'){echo 'selected';}}; ?>>NCE</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Designation</label>
                            <select class="form-control select2" name="designation" id="designation" required>
                                <option value="">--Select Designation--</option>
                                <?php $desig = $this->Crud->read('designation'); foreach ($desig as $key) { ?>
                                    <option value="<?php echo $key->name; ?>" <?php if(!empty($e_designation)){if($e_designation == $key->name){echo 'selected';}}; ?>><?php echo $key->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Branch</label>
                            <select class="form-control select2" name="branch" id="branch" required>
                                <option value="">--Select Branch--</option>
                                <?php $desig = $this->Crud->read('branch'); foreach ($desig as $key) { ?>
                                    <option value="<?php echo $key->name; ?>" <?php if(!empty($e_branch)){if($e_branch == $key->name){echo 'selected';}}; ?>><?php echo $key->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Row -->
            
            <div class="seprator-block"></div>
            
            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account-box mr-10"></i>address</h6>
            <hr class="light-grey-hr"/>
            <div class="ro">
                <div class="col-md-12 ">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Address</label>
                            <input type="text" class="form-control" name="address" id="address" required value="<?php if(!empty($e_address)){echo $e_address;} ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Postal</label>
                            <input type="text" class="form-control" name="postal" id="postal" required value="<?php if(!empty($e_postal)){echo $e_postal;} ?>">
                        </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-4">
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

                <div class="col-md-4">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Nationality</label>
                            <select class="form-control select2" name="nationality" id="nationality" required>
                                <option value="">--Select Nationality--</option>
                                <option value="Nigeria" <?php if(!empty($e_nationality)){if($e_nationality == 'Nigeria'){echo 'selected';}}; ?>>Nigeria</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--/span-->
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

            <div class="seprator-block"></div>
            
            <h6 class="txt-dark capitalize-font"><i class="ti-github mr-10"></i>guarantor</h6>
            <hr class="light-grey-hr"/>
            <div class="rw">
                <div class="col-md-6 ">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Relationship</label>
                            <select class="form-control" name="relationship" id="relationship" required>
                                <option value="">--Select Relationship--</option>
                                <option value="Family" <?php if(!empty($e_relationship)){if($e_relationship == 'Family'){echo 'selected';}}; ?>>Family</option>
                                <option value="Friend" <?php if(!empty($e_relationship)){if($e_relationship == 'Friend'){echo 'selected';}}; ?>>Friend</option>
                                <option value="Acquaintance" <?php if(!empty($e_relationship)){if($e_relationship == 'Acquaintance'){echo 'selected';}}; ?>>Acquaintance</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Full Name</label>
                            <input type="text" class="form-control" name="g_name" id="g_name" required value="<?php if(!empty($e_name)){echo $e_name;} ?>">
                        </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Address</label>
                            <input type="text" class="form-control" id="g_address" name="g_address" required value="<?php if(!empty($e_g_address)){echo $e_g_address;} ?>">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Occupation</label>
                            <input type="text" class="form-control" name="occupation" id="occupation" required value="<?php if(!empty($e_occupation)){echo $e_occupation;} ?>">
                        </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Phone Number</label>
                            <input class="form-control" type="text" name="g_phone" id="g_phone" maxlength="11" minlength="11" required value="<?php if(!empty($e_g_phone)){echo $e_g_phone;} ?>">
                        </div>
                    </div>
                </div>

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
