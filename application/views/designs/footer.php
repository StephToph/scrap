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
    
	<!-- Data table JavaScript -->
	<script src="<?php echo base_url(); ?>assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	
	<!-- Slimscroll JavaScript -->
	
	<!-- Fancy Dropdown JS -->
	<script src="<?php echo base_url(); ?>assets/dist/js/dropdown-bootstrap-extended.js"></script>
	<script src="<?php echo base_url(); ?>assets/dist/js/jquery.slimscroll.js"></script>
	
	<!-- Toast JavaScript -->
	<script src="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
	<!-- Init JavaScript -->
	<script src="<?php echo base_url(); ?>assets/dist/js/init.js"></script>
	<script src="<?php echo base_url(); ?>assets/jsform.js"></script>
			
	<?php if(!empty($table_rec)){ ?>
		<script type="text/javascript">
			
			$(document).ready(function() {
				//datatables
				var table = $('#dtable').DataTable({ 
					"processing": true, //Feature control the processing indicator.
					"serverSide": true, //Feature control DataTables' server-side processing mode.
					"order": [[<?php if(!empty($order_sort)){echo $order_sort;} ?>]], //Initial order.
					"language": {
						"processing": "<i class='fa fa-spinner fa-2x fa-spin' aria-hidden='true'></i> Processing... please wait"
					},
					"pagingType": "full",
			
					// Load data for the table's content from an Ajax source
					"ajax": {
						url: "<?php echo base_url($table_rec); ?>",
						type: "POST"
					},
					
					//Set column definition initialisation properties.
					"columnDefs": [
						{ 
							"targets": [<?php if(!empty($no_sort)){echo $no_sort;} ?>], //columns not sortable
							"orderable": false, //set not orderable
						},
					],
			
				});
			});
		</script>
	<?php } ?>
</body>

</html>
