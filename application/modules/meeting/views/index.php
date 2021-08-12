<?php
    $ENABLE_ADD     = has_permission('Meeting.Add');
    $ENABLE_MANAGE  = has_permission('Meeting.Manage');
    $ENABLE_VIEW    = has_permission('Meeting.View');
    $ENABLE_DELETE  = has_permission('Meeting.Delete');
?>
<style type="text/css">
thead input {
	width: 100%;
}
</style>
<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
     
	<div class="box-header">
			<a href="<?= base_url('meeting/add') ?>" class="btn btn-success"> <i class="fa fa-plus"></i>  Add Meeting			
			
			</a>
	  </div>
	 	
		<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th width="5">#</th>
			<th>Tgl Meeting</th>
			<th>Subject</th>
			<th>Sub Subject</th>
			<th>Description</th>
			<?php if($ENABLE_MANAGE) : ?>
			<th align="center" width="10%">Action</th>
			<?php endif; ?>
		</tr>
		</thead>

		<tbody>
		<?php if(empty($results)){
		}else{
			$numb=0; foreach($results AS $record){ $numb++; 
		?>
		<tr>
		    <td><?= $numb; ?></td>
			<td><?= $record->tgl_meeting ?></td>
			<td><?= $record->subject ?></td>
			<td><?= $record->sub_subject ?></td>
			<td><?= $record->description ?></td>
			<td align="center" style="padding-left:20px">
			<?php if($ENABLE_VIEW) : ?>
				<a class="btn btn-primary btn-xs view" href="javascript:void(0)" title="View" data-id_meeting="<?=$record->kd_meeting?>"><i class="fa fa-eye"></i>
				</a>
			<?php endif; ?>
			</td>

		</tr>
		<?php } }  ?>
		</tbody>
		</table>
	</div>
	<!-- /.box-body -->
</div>

<!-- awal untuk modal dialog -->
<!-- Modal -->
<div class="modal modal-primary" id="dialog-rekap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Rekap Data Customer</h4>
      </div>
      <div class="modal-body" id="MyModalBody">
		...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        <span class="glyphicon glyphicon-remove"></span>  Close</button>
        </div>
    </div>
  </div>
</div>

<div class="modal modal-default fade" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span>&nbsp;Data Customer</h4>
      </div>
      <div class="modal-body" id="ModalView">
		...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
        <span class="glyphicon glyphicon-remove"></span>  Close</button>
        </div>
    </div>
  </div>
</div>

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<!-- page script -->
<script type="text/javascript">

    $(document).on('click', '.view', function(e){
		var id = $(this).data('id_meeting');
		 window.location.href = siteurl+"meeting/detail/"+id;
	});

    $(document).ready(function() {
	 $("#search").focus();
	});
	
	function get_pasien(){
        var search=$("#search").val();
        window.location.href = siteurl+"perawat/search_pasien/"+search;
       		
    }

  	$(function() {
    	 var table = $('#example1').DataTable( {
	        orderCellsTop: true,
	        fixedHeader: true,
			scrollX:true
	    } );
    	$("#form-area").hide();
  	});
	
</script>
