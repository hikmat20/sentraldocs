<?php
    $ENABLE_ADD     = has_permission('Folders.Add');
    $ENABLE_MANAGE  = has_permission('Folders.Manage');
    $ENABLE_VIEW    = has_permission('Folders.View');
    $ENABLE_DELETE  = has_permission('Folders.Delete');
	$ENABLE_DOWNLOAD  = has_permission('Folders.Download');
?>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">     
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title"><?=$title;?></h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead style="color:white">
				<tr>
				  <th>No</th>
				  <th>Nama Folder</th>
				  <th>Sub Folder I</th>
				  <th>Sub Folder II</th>
				  <th>Sub Folder III</th>
				  <th>Created On</th>
				  <th align="center">Option</th>
				</tr>
			</thead>
			<tbody>
			  <?php 
			  if($row){
					$int	=0;
					foreach($row as $datas){
						$int++;
						$tgl =date_create($datas->created);
						echo"<tr>";	
						    echo "<td>".$int."</td>";
                            echo "<td>".$datas->nama_master."</td>";
							echo "<td></td>";
							echo "<td></td>";
							echo "<td></td>";
							echo "<td>".$datas->created."</td>";
							echo"<td align='left'>";
							if($ENABLE_VIEW){
							echo"<a href='".site_url('dokumen/subfolder/'.$datas->id_master)."' class='btn btn-sm btn-success' title='Detail Data' data-role='qtip'><i class='fa fa-folder-open'></i></a>";
							
							}
							echo"</td>";
   						    echo"</tr>";
							
			

					}
			  }
			  ?>
			</tbody>
		</table>
	</div>
	<!-- /.box-body -->
 </div>
  <!-- /.box -->
<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<script>

    $('#example1').DataTable( {
	        orderCellsTop: false,
	        fixedHeader: true,
			scrollX:true,
			ordering: false,
			info:     false
	    } );
	
	$(document).ready(function(){
		$('#btn-add').click(function(){
			loading_spinner();
		});
		
	});
	function delData(id){
		swal({
			  title: "Are you sure?",
			  text: "You will not be able to process again this data!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonClass: "btn-danger",
			  confirmButtonText: "Yes, Process it!",
			  cancelButtonText: "No, cancel process!",
			  closeOnConfirm: true,
			  closeOnCancel: false
			},
			function(isConfirm) {
			  if (isConfirm) {
					loading_spinner();
					window.location.href = base_url +'index.php/'+ active_controller+'/delete/'+id;
					
			  } else {
				swal("Cancelled", "Data can be process again :)", "error");
				return false;
			  }
		});
       
	} 
</script>