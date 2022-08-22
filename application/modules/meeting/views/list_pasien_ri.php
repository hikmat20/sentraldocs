<?php
    $ENABLE_ADD     = has_permission('Perawat.Add');
    $ENABLE_MANAGE  = has_permission('Perawat.Manage');
    $ENABLE_VIEW    = has_permission('Perawat.View');
    $ENABLE_DELETE  = has_permission('Perawat.Delete');
?>
<style type="text/css">
thead input {
	width: 100%;
}
</style>
<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">

	
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
		 <tr>
			  <th width='5%'>No</th>
			  <th >Tgl Registrasi</th> 
			  <th >No Registrasi</th>
			  <th >No Medrec</th>
			  <th >Nama Pasien</th>
			  <th >Umur</th>
			  <th >Jaminan</th>
			  <th >Dokter</th>
			  <th >Kelas</th>
			  <th >Ruang</th>
			  <th >Status Pasien</th>
			  <th >Action</th>
			
		  </tr>
		</thead>

		<tbody>
		<?php if(empty($results)){
		}else{
			$numb=0; foreach($results AS $record){ $numb++;
     
          if ($record->jenis_kelamin=='L') {
		  $sex = 'Laki-laki';
		  }else{
			  $sex = 'Perempuan';
		  }
		  
		  if ($record->status_pulang==0) {
			  $statusplg = 'Belum Pulang';
		  }
		  elseif ($record->status_pulang==1) {
			  $statusplg = 'Boleh Pulang';
		  }
		  elseif($record->status_pulang==2) {
			  $statusplg = 'Sudah Pulang';
		  }       
		?>
		<tr>
			  <td align='center'><?=$numb?></td>
			  <td align='left'><?= tgl_indo($record->tgl_registrasi)?></td>
			  <td ><?=$record->noreg ?></td>
			  <td ><?=$record->medrec?></td>
			  <td ><?=$record->nama_pasien,$record->status_pasien?></td>
			  <td ><?=$record->umur_th."Th/".$record->umur_bln."Bln"?></td>
			  <td ><?=$record->nama_customer?></td>
			  <td ><?=$record->nama_dokter?></td>
			  <td ><?=$record->nama_kelas?></td>
			  <td ><?=$record->nama_ruang."/".$record->nama_bed."/".$record->nomor_bed ?></td>
			  <td ><?="$statusplg"?></td>
			  <td align="center" style="padding-left:20px">
			<?php if($ENABLE_VIEW) : ?>
				<a class="btn btn-primary btn-xs view" href="javascript:void(0)" title="View" data-id_pasien="<?=$record->medrec?>"><i class="fa fa-eye"></i>
				</a>
			<?php endif; ?>

			<?php if($ENABLE_MANAGE) : ?>
				<a class="btn btn-success btn-xs edit" href="javascript:void(0)" title="Transaksi Rawat Inap" data-id_pasien="<?=$record->noreg?>"><i class="fa fa-edit"></i>
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

    $(document).on('click', '.edit', function(e){
		var id = $(this).data('id_pasien');
		 window.location.href = siteurl+"perawat/TrPendaftaranRi/"+id;
	});

    $(document).ready(function() {
	 $("#search").focus();
	});
	
	function get_pasien(){
        var search=$("#search").val();
        window.location.href = siteurl+"perawat/search_pasien_ri/"+search;
       		
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
