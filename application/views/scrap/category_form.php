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
    <?php } else { // insert/edit view ?>
        <div class="row">
            <input type="hidden" name="id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
            <div class="rw">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Code</label>
                            <input type="text" id="code" name="code" class="form-control" required  value="<?php if(!empty($e_code)){echo $e_code;} ?>"> 
                        </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Description</label>
                            <input type="text" id="description" name="description" class="form-control" required value="<?php if(!empty($e_description)){echo $e_description;} ?>"> 
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="control-label mb-10">Extra</label>
                            <input class="form-control" type="text" name="extra" id="extra" required value="<?php if(!empty($e_extra)){echo $e_extra;} ?>">
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
