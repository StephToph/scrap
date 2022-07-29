<?php echo form_open_multipart($form_url, array('id'=>'bb_ajax_form', 'class'=>'form-horiontal')); ?>

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
            <div class="ro">
               <div class="col-md-6" id="emp_response">
                    <div class="form-group">
                        <label class="control-label mb-10">Employee Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="John Doe" readonly value="<?php if(!empty($e_emp_id)){echo strtoupper($this->Crud->read_field('staff_id', $e_emp_id, 'staff', 'surname').' '.$this->Crud->read_field('staff_id', $e_emp_id, 'staff', 'firstname'));} ?>"> 
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label mb-10">Month Paid</label>
                        <select class="form-control select2" name="month_paid" id="month_paid" required onchange="mnth();">
                            <option value="">--Select Month--</option>
                            <option value="January" <?php if(!empty($e_month_paid)){if($e_month_paid == 'January'){echo "selected";}} ?>>January</option>
                            <option value="February" <?php if(!empty($e_month_paid)){if($e_month_paid == 'February'){echo "selected";}} ?>>February</option>
                            <option value="March" <?php if(!empty($e_month_paid)){if($e_month_paid == 'March'){echo "selected";}} ?>>March</option>
                            <option value="April" <?php if(!empty($e_month_paid)){if($e_month_paid == 'April'){echo "selected";}} ?>>April</option>
                            <option value="May" <?php if(!empty($e_month_paid)){if($e_month_paid == 'May'){echo "selected";}} ?>>May</option>
                            <option value="June" <?php if(!empty($e_month_paid)){if($e_month_paid == 'June'){echo "selected";}} ?>>June</option>
                            <option value="July" <?php if(!empty($e_month_paid)){if($e_month_paid == 'July'){echo "selected";}} ?>>July</option>
                            <option value="August" <?php if(!empty($e_month_paid)){if($e_month_paid == 'August'){echo "selected";}} ?>>August</option>
                            <option value="September" <?php if(!empty($e_month_paid)){if($e_month_paid == 'September'){echo "selected";}} ?>>September</option>
                            <option value="October" <?php if(!empty($e_month_paid)){if($e_month_paid == 'October'){echo "selected";}} ?>>October</option>
                            <option value="November" <?php if(!empty($e_month_paid)){if($e_month_paid == 'November'){echo "selected";}} ?>>November</option>
                            <option value="December" <?php if(!empty($e_month_paid)){if($e_month_paid == 'December'){echo "selected";}} ?>>December</option>
                        </select> 
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label mb-10">Amount Paid</label>
                        <input type="text" id="amount_paid" name="amount_paid" class="form-control" required value="<?php if(!empty($e_amount_paid)){echo $e_amount_paid; } else {echo 0;} ?>" min="0" oninput="cal();"> 
                    </div>
                </div>

                <!--/span-->
                <div class="col-md-6" id="p_response">
                    <div class="form-group">
                        <label class="control-label mb-10">Days Present</label>
                        <input class="form-control" type="number" name="days_present" id="days_present" min="0" value="<?php if(!empty($e_days_present)){echo $e_days_present; } else {echo 0;} ?>" required oninput="dayp();">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label mb-10">Days Absent</label>
                        <input class="form-control" type="text" name="days_absent" id="days_absent" minlength="0" value="<?php if(!empty($e_days_absent)){echo $e_days_absent; } else {echo 0;} ?>" required readonly>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label mb-10">Amount Deducted</label>
                        <input class="form-control" type="text" name="amount_deducted" id="amount_deducted" readonly required value="<?php if(!empty($e_amount_deducted)){echo $e_amount_deducted; } else {echo 0;} ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label mb-10">Amount Balance</label>
                        <input class="form-control" type="text" name="amount_balance" id="amount_balance" readonly required value="<?php if(!empty($e_amount_balance)){echo $e_amount_balance; } else {echo 0;} ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label mb-10">Remark</label>
                        <input class="form-control" type="text" name="remark" id="remark" required value="<?php if(!empty($e_remark)){echo $e_remark; } ?>">
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
            cal();dayp();
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
           updat();//cal();
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