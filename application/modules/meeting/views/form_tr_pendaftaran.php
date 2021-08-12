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

.modal-dialog{
width:90%;
}
</style>
<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">

<div class="box box-success">

<?php
foreach($results AS $record){
}
?>
	<!-- /.box-header -->
	<div class="box-body">
	<div id="data_custommer" >
		<form id="data_form">
		<div class="row">
		<div id="input1">
			<div class="col-md-12">
                <div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-4">
					  <label for="">No Registrasi</label>
					</div>
					 <div class="col-md-8">
					 <input type="hidden" class="form-control input-sm" id="no_tr"  name="no_tr" placeholder="No Transaksi" value='<?= $record->id_transaksi ?>' readonly>
					 <input type="text" class="form-control input-sm" id="noreg"  name="noreg" placeholder="No Registrasi" value='<?= $record->noreg ?>' readonly>
					</div>
				</div>
				</div>			
                <div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-4">
					  <label for="">No Rekam Medis</label>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="no_rm"  name="no_rm" placeholder="No Rekam Medis" value='<?= $record->medrec ?>' readonly>
					</div>
				</div>
				</div>
				<div class="col-md-4">
			    <div class="form-group row">
					<div class="col-md-4">
					  <label for="">Nama Pasien</label>
					</div>
					<div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="nama" name="nama" placeholder="Nama Pasien" value='<?= $record->nama_pasien.''.$record->status_pasien ?>'  readonly >
					</div>
				</div>
				</div>				
				<div class="col-md-4">
					<div class="form-group row">
						<div class="col-md-4">
						<label for="">Jenis Kelamin</label>
						</div>
						<div class="col-md-8">
						<?php 
						
						if($record->jenis_kelamin == 'L')
						{  
					    $jk = 'Laki-Laki';
						}
					    else if ($record->jenis_kelamin == 'P')
					    {  
					    $jk = 'Perempuan';
    					}
					     ?>
        				<input type="text" class="form-control input-sm" id="jenis_kelamin"  name="jenis_kelamin" placeholder="Jenis Kelamin" value='<?= $jk ?>' readonly>
						</div>
					</div>
				</div>
				<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-4">
					  <label for="">Tanggal Lahir</label>
					  <?php $tgl_lahir = $record->tgl_lahir; ?>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="tgl_lahir"  name="tgl_lahir" placeholder="Tanggal Lahir" value='<?=date('d-m-Y', strtotime(".$record->tgl_lahir"))?>' readonly>
					</div>
				</div>
				</div>
				<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-4">
					  <label for="">Umur</label>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="umur"  name="umur" placeholder="umur" value='<?= $record->umur_th.'Th'.','.$record->umur_bln.'Bln' ?>' readonly>
					</div>
				</div>
				</div>
				<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-4">
					  <label for="">Jaminan</label>
					</div>
					 <div class="col-md-8">
					 <input type="hidden" class="form-control input-sm" id="kd_jaminan"  name="kd_jaminan" placeholder="kd_jaminan" value='<?= $record->kode_jaminan ?>' readonly>
					 <input type="text" class="form-control input-sm" id="jaminan"  name="jaminan" placeholder="jaminan" value='<?= $record->nama_customer ?>' readonly>
					</div>
				</div>
				</div>
				<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-4">
					  <label for="">Kelas</label>
					</div>
					 <div class="col-md-8">
					  <input type="hidden" class="form-control input-sm" id="kd_kelas"  name="kd_kelas" placeholder="kd_kelas" value='<?= $record->kode_kelas ?>' readonly>
					  <input type="text" class="form-control input-sm" id="kelas"  name="kelas" placeholder="kelas" value='<?= $record->nama_kelas ?>' readonly>
					</div>
				</div>
				</div>
				<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-4">
					  <label for="">Poliklinik</label>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="poliklinik"  name="poliklinik" placeholder="poliklinik" value='<?= $record->nama_departemen ?>' readonly>
					</div>
				</div>
				</div>
				<div class="col-md-4">
				<div class="form-group row">
					<div class="col-md-4">
					  <label for="">Dokter</label>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="dokter"  name="dokter" placeholder="dokter" value='<?= $record->nama_dokter ?>' readonly>
					</div>
				</div>
				</div>
			</div>
				
			
		</div>
		</div>
	   
	</form>
	</div>
	
	</div>
	<!-- /.box-body -->
</div>

<div class="nav-tabs-custom">
			<div class="box active ">
            <ul class="nav nav-tabs">
			<li class="active"><a href="#" data-toggle="tab"  id="billing">Input Layanan</a></li>
			<li class=""><a href="#" data-toggle="tab"  id="alkes">Input Alkes</a></li>
			<li class=""><a href="#" data-toggle="tab"  id="obat">Input Farmasi</a></li>
			</ul> 
			</div>
			<div id="add_layanan">
			<button type="button" class="btn btn-success" id="add">
			<span class="glyphicon glyphicon-add"></span> Tambah Layanan</button>
			</div>
			<div id="add_alkes">
			<button type="button" class="btn btn-success" id="add_alk>
			<span class="glyphicon glyphicon-add"></span> Tambah Alkes</button>
			</div>
			<div id="add_obat">
			<button type="button" class="btn btn-success" id="add_obt">
			<span class="glyphicon glyphicon-add"></span> Tambah Obat Farmasi</button>
			</div>
			<div class="box box-success" id="data">
			</div>     
</div>
<div class="modal modal-default fade dialog-popup" id="dialog-popup" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span>&nbsp;Transaksi Rawat Jalan</h4>
      </div>
      <div class="modal-body" id="ModalView">
		...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger"  id="close" data-dismiss="modal">
        <span class="glyphicon glyphicon-remove"></span>  Close</button>
        </div>
    </div>
  </div>
</div>


<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<script src="<?= base_url('assets/js/jquery.maskMoney.js')?>"></script>

<script type="text/javascript">


	
$(document).ready(function() {
    
    $("#add_layanan").hide();
	$("#add_alkes").hide();
	$("#add_obat").hide();
	
	DataDetail();
	$("#data").show();
	
	$("#alkes").click(function(){
		$("#add_alkes").show();
		$("#add_layanan").hide();
		$("#add_obat").hide();
	    $("#data").hide();
		DataDetail();
			
	});
	
	$("#billing").click(function(){
		$("#add_layanan").show();
		$("#add_alkes").hide();
	    $("#add_obat").hide();
	    $("#data").hide();
		DataDetail();
			
	});
	
	$("#obat").click(function(){
		$("#add_obat").show();
		$("#add_layanan").hide();
	    $("#add_alkes").hide();
	    $("#data").hide();
		DataDetail();
			
	});
	
	$("#add").click(function(){
		
	    $("#data").hide();
		
		 var	id		= $("#noreg").val();
         var	tr		= $("#no_tr").val();
         var	kelas	= $("#kd_kelas").val();
         var	jaminan	= $("#kd_jaminan").val();		 
		// alert(id);
		$("#head_title").html("<i class='fa fa-list-alt'></i><b> Billing Pasien</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'perawat/Billing_Rj/',
			data	: "id="+id+"&tr="+tr+"&kelas="+kelas+"&jaminan="+jaminan,
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				
				DataDetail();
			}
		})
		
		
		$('.select2').select2();
		
	});
	
	function DataDetail(){
		
		 $("#data").hide();
		
		var	cari		= $("#noreg").val();		
		 
		$.ajax({
			type	: "POST",
			url		:siteurl+"perawat/load_billing",
			data	: "cari="+cari,
			success	: function(data){
				$("#data").html(data);
				$("#loading").fadeOut(100);	
		   		$("#data").fadeIn(500);	
                $("#add").fadeIn(500);						
			}
		});
	}
	
	$("#editdata").click(function(){		
	    $("#data").hide();
		$("#add").hide();
		
		 var	medrec		= $("#no_rm").val();
		 var	id		= $("#noreg").val();
         var	tr		= $("#no_tr").val();
         var	kelas	= $("#kd_kelas").val();
         var	jaminan	= $("#kd_jaminan").val();		 
		// alert(id);
		$("#head_title").html("<i class='fa fa-list-alt'></i><b> Edit Registrasi Rawat Jalan</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'perawat/Update_Tr_Rj/',
			data	: "noreg="+id+"&medrec="+medrec,
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);			
			}
		})
	});
	
	$("#close").click(function(){	
       
       var	noreg		= $("#noreg").val();		   
	   window.location.href=siteurl+'perawat/TrPendaftaranRj/'+noreg;
	   DataDetail();
	   
	});

    $(".close").click(function(){	
       
       var	noreg		= $("#noreg").val();		   
	   window.location.href=siteurl+'perawat/TrPendaftaranRj/'+noreg;
	   DataDetail();
	   
	});
	
	
	
	$(function() {
		$('.select2').select2();
  	});
	
	
	    	
});

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
							 window.location.href=siteurl+'perawat/TrPendaftaranRj/'+noreg;
							 DataDetail();
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
