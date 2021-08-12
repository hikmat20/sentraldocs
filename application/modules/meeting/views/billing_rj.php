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

<form id="data_billing">

 <div class="box box-success" id="bill"> 
				<table id="example1" class="table table-bordered table-striped">
				<tr>
				    <th width="240px">
					<input type="hidden" class="form-control input-sm" id="no_tr"  name="no_tr" placeholder="No Transaksi" value='<?= $notr ?>' readonly>
					<input type="hidden" class="form-control input-sm" id="kelas"  name="kelas" placeholder="kelas" value='<?= $kelas ?>' readonly>
					<input type="hidden" class="form-control input-sm" id="jaminan"  name="jaminan" placeholder="jaminan" value='<?= $jaminan ?>' readonly>
					<input type="text" class="form-control input-sm" id="noreg"  name="noreg" placeholder="No Registrasi" value='<?= $noreg ?>' readonly>
					<th>
					<select id="itemlayanan" name="itemlayanan" class="form-control input-sm select2" style="width: 100%;" >
                             <option value="">Pilih Layanan</option>
							 <?php foreach ($layanan as $key => $st) :
							 ?>
                            <option value="<?= $st->id_grouplayanan; ?>">
                            <?= strtoupper($st->id_grouplayanan.'|'.$st->nama); ?>
                            </option>
                            <?php endforeach; ?>
                    </select>
					<th>
					<select id="dokterlayanan" name="dokterlayanan" class="form-control input-sm select2" style="width: 100%;" >
                             <option value="">Pilih Dokter</option>
							 <?php foreach ($dokter as $key => $dr) :
							 ?>
                            <option value="<?= $dr->id_dokter; ?>">
                            <?= strtoupper($dr->id_dokter.'|'.$dr->nama_dokter); ?>
                            </option>
                            <?php endforeach; ?>
                    </select><th>
					<button type="submit" class="btn btn-success btn-sm" name="save" id="save"><i class="fa fa-save"></i>&nbsp;Simpan</button>
					</th>
				</tr>
				</table>
			</div>
</form>

	<div class="box box-success" id="data_detail">
			
<script type="text/javascript">
$(document).ready(function(){
	
$('.select2').select2();

})
   
$(document).on('submit', '#data_billing', function(e){
	
		e.preventDefault()
		var data = $('#data_billing').serialize();
		var noreg = $('#noreg').val();
		// alert(data);
// exit();
		swal({
		  title: "Anda Yakin?",
		  text: "Data akan di simpan.",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-info",
		  confirmButtonText: "Ya, Simpan!",
		  cancelButtonText: "Batal",
		  closeOnConfirm: false
		},
		function(){
		  $.ajax({
			  type:'POST',
			  url:siteurl+'perawat/saveBilling',
			  dataType : "json",
			  data:data,
			  success:function(result){
				  if(result.status == '1'){
					 swal({
						  title: "Sukses",
						  text : "Data berhasil disimpan.",
						  type : "success"
						},
						function (){
							 //window.location.href=siteurl+'pendaftaran/TrPendaftaranRj/'+noreg;
							 DataDetail2();
						})
				  } else {
					swal({
					  title : "Error",
					  text  : "Data error. Gagal insert data",
					  type  : "error"
					})
					
				  }
			  },
			  error : function(){
				swal({
					  title : "Error",
					  text  : "Data error. Gagal request Ajax",
					  type  : "error"
					})
			  }
		  })
		});
		
		
	
		
	})
	
	
	
	function DataDetail2(){
		
		var	cari		= $("#noreg").val();		
		 
		$.ajax({
			type	: "POST",
			url		:siteurl+"perawat/load_billing",
			data	: "cari="+cari,
			success	: function(data){
				$("#data_detail").html(data);
				$("#loading").fadeOut(100);	
		   		$("#data_detail").fadeIn(500);				
			}
		});
	}
	
	function deleteRow(ID) {
	var	noreg		= $("#noreg").val();		
	var id	= ID;
	swal({
		  title: "Anda Yakin?",
		  text: "Data akan di hapus.",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-info",
		  confirmButtonText: "Ya, Hapus!",
		  cancelButtonText: "Batal",
		  closeOnConfirm: false
		},
	function(){
		  $.ajax({
			  type:'POST',
			  url:siteurl+'perawat/hapusDetail',
			  dataType : "json",
			  data	: "id="+id,
			  success:function(result){
				  if(result.status == '1'){
					 swal({
						  title: "Sukses",
						  text : "Data berhasil dihapus.",
						  type : "success"
						},
						function (){
							 // window.location.href=siteurl+'pendaftaran/TrPendaftaranRj/'+noreg;
							 DataDetail2();
						})
				  } else {
					swal({
					  title : "Error",
					  text  : "Data error. Gagal Hapus data",
					  type  : "error"
					})
					
				  }
			  },
			  error : function(){
				swal({
					  title : "Error",
					  text  : "Data error. Gagal request Ajax",
					  type  : "error"
					})
			  }
		  })
		});
}
	
</script>