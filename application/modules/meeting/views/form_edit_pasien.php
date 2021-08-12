<?php
    $ENABLE_ADD     = has_permission('Pendaftaran.Add');
    $ENABLE_MANAGE  = has_permission('Pendaftaran.Manage');
    $ENABLE_VIEW    = has_permission('Pendaftaran.View');
    $ENABLE_DELETE  = has_permission('Pendaftaran.Delete');
?>
<style type="text/css">
thead input {
	width: 100%;
}
</style>
<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">

<?php if(empty($results)){
		}
		else
		{
		foreach($results AS $record){ 
		} 
		}  
?>

<div class="box box-primary">
	<!-- /.box-header -->
	<div class="box-body">
	<font size="2">
	<div id="data_custommer" >
		<form id="data_form">
		<div class="row">
		<div id="input1">
			<div class="col-md-12">			    
                <div class="col-md-5">
				<div class="form-group row">
					<div class="col-md-5">
					  <label for="">No Rekam Medis</label>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="no_rm"  name="no_rm" placeholder="No Rekam Medis" value="<?= $record->medrec ?>" readonly>
					</div>
				</div>
				</div>
				<div class="col-md-5">
			    <div class="form-group row">
					<div class="col-md-5">
					  <label for="">Nama Pasien</label>
					</div>
					<div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="nama" name="nama" required placeholder="Nama Pasien" value="<?= $record->nama_pasien ?>" readonly>
					</div>
				</div>
				</div>				
				<div class="col-md-5">
					<div class="form-group row">
							<div class="col-md-5">
							<label for="">Titel</label>
							</div>
							<div class="col-md-8">
							<select class="form-control input-sm" id="titel" name="titel" value="<?= $record->status_pasien?>" readonly>
							<option value=".Tn">Tn</option>
							<option value=".Ny">Ny</option>
							<option value=".Nn">Nn</option>
							<option value=".An">An</option>
							<option value=".By">By</option>
						    </select>
							</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-5">
						<label for="">Jenis Kelamin</label>
						</div>
						<div class="col-md-8">
							<select class="form-control input-sm" id="jenis_kelamin" name="jenis_kelamin" value="<?= $record->jenis_kelamin ?>" readonly>
								<option value="L">Laki-Laki</option>
								<option value="P">Perempuan</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-5">
				<div class="form-group row">
					<div class="col-md-5">
					  <label for="">Tanggal Lahir</label>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="tgl_lahir"  name="tgl_lahir" placeholder="Tanggal Lahir" value="<?= $record->tgl_lahir ?>" readonly>
					</div>
				</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-5">
						<label for="">Agama</label>
						</div>
						<div class="col-md-8">
							<select class="form-control input-sm" id="agama" name="agama" value="<?= $record->agama ?>" readonly>
								<option value='Islam'>Islam</option>
								<option value='Kristen'>Kristen</option>
								<option value='Katolik'>Katolik</option>
								<option value='Hindu'>Hindu</option>
								<option value='Budha'>Budha</option>
								<option value='Khong Hu Cu'>Khong Hu Cu</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-5">
						<label for="">Provinsi</label>
						</div>
						<div class="col-md-8">
							<input type="text" id="provinsi" name="provinsi" class="form-control input-sm " value="<?= $record->nama_prov ?>"  required readonly>
					    </div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-5">
						<label for="">Kabupaten/Kota</label>
						</div>
						<div class="col-md-8">
							<input type="text"  id="kota" name="kota" class="form-control input-sm " value="<?= $record->nama_kab ?>" required readonly>
                           
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-5">
						<label for="">Kecamatan</label>
						</div>
						<div class="col-md-8">
							<input type="text"  id="kecamatan"  name="kecamatan"  class="form-control input-sm " value="<?= $record->nama_kec ?>"  required readonly>
							
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-5">
						<label for="">Kelurahan</label>
						</div>
						<div class="col-md-8">
							<input type="text"  id="kelurahan"  name="kelurahan"  class="form-control input-sm "  value="<?= $record->nama_kel ?>"required  readonly>
							
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-5">
						  <label for="">Alamat Lengkap</label>
						</div>
						 <div class="col-md-8">
						   <textarea type="text" class="form-control input-sm" id="alamat" name="alamat"  placeholder="Alamat" readonly><?= $record->alamat ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-5">
						  <label for="">No Telp Pasien</label>
						</div>
						 <div class="col-md-8">
						  <input type="text" class="form-control input-sm" id="telp_pasien"  name="telp_pasien" placeholder="No Telp Pasien" value="<?= $record->telp_pasien ?>" readonly>
						</div>
					</div>
				</div>	
				<div class="col-md-5">
				<div class="form-group row">
					<div class="col-md-5">
					  <label for="">Penanggung Jawab</label>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="pj"  name="pj" placeholder="Penanggung Jawab" value="<?= $record->penanggung_jawab ?>" readonly>
					</div>
				</div>
				</div>
				<div class="col-md-5">
				<div class="form-group row">
					<div class="col-md-5">
					  <label for="">No Telp PJ</label>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="telp_pj"  name="telp_pj" placeholder="No Telp Penanggung Jawab" value="<?= $record->telp_pj ?>" readonly>
					</div>
				</div>
				</div>
								
            </div>				
			</div>
		</div>
	</form>
	</div>
	</font>
	</div>
	<!-- /.box-body -->
</div>



<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<!-- page script -->
<script type="text/javascript">


  	$(function() {
		$('.select2').select2();
  	});
	
	
	// ADD CUSTOMER 
	
	$(document).on('submit', '#data_form', function(e){
		e.preventDefault()
		var data = $('#data_form').serialize();
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
			  url:siteurl+'pendaftaran/savePendaftaranRj_Lama',
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
							window.location.href=siteurl+'pendaftaran/list_pasienrj';
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
	
	$("#tgl_lahir").datepicker({
			format : "dd-mm-yyyy",
			showInputs: true,
			autoclose:true,
			todayHighlight: true,
			//startDate: "dateToday"
    	});
		
		
	// function get_kota(){
        // var provinsi=$("#provinsi").val();
        // $.ajax({
            // type:"GET",
            // url:siteurl+"pendaftaran/get_kota",
            // data:"provinsi="+provinsi,
            // success:function(html){
               // $("#kota").html(html);
            // }
        // });
    // }
	
	// function get_kecamatan(){
        // var kota=$("#kota").val();
        // $.ajax({
            // type:"GET",
            // url:siteurl+"pendaftaran/get_kecamatan",
            // data:"kota="+kota,
            // success:function(html){
               // $("#kecamatan").html(html);
            // }
        // });
    // }
	
	// function get_kelurahan(){
        // var kec=$("#kecamatan").val();
        // $.ajax({
            // type:"GET",
            // url:siteurl+"pendaftaran/get_kelurahan",
            // data:"kec="+kec,
            // success:function(html){
               // $("#kelurahan").html(html);
            // }
        // });
    // }
	function get_dokter(){
        var dept=$("#departemen").val();
		var hari=$("#jadwal").val();
		var jam =$("#jam").val();
        $.ajax({
            type:"GET",
            url:siteurl+"pendaftaran/get_dokter",
            data:"dept="+dept+"&hari="+hari+"&jam="+jam,
            success:function(html){
               $("#dokter").html(html);
            }
        });
    }
	
	function get_customer(){
        var cust=$("#penjamin").val();
        $.ajax({
            type:"GET",
            url:siteurl+"pendaftaran/get_jaminan",
            data:"cust="+cust,
            success:function(html){
               $("#nama_jaminan").html(html);
            }
        });
    }
	
	function get_jadwal(){
        var dept=$("#departemen").val();
        $.ajax({
            type:"GET",
            url:siteurl+"pendaftaran/get_jadwal",
            data:"dept="+dept,
            success:function(html){
               $("#jadwal").html(html);
            }
        });
    }
	
	function get_jam(){
        var dept=$("#departemen").val();
		var hari=$("#jadwal").val();
        $.ajax({
            type:"GET",
            url:siteurl+"pendaftaran/get_jam",
            data:"dept="+dept+"&hari="+hari,
            success:function(html){
               $("#jam").html(html);
            }
        });
    }
	
	function cek_dokter(){
		var rm  =$("#no_rm").val();
        var dept=$("#departemen").val();
		var hari=$("#jadwal").val();
		var jam =$("#jam").val();
		var dokter =$("#dokter").val();
		
		 $.ajax({
            type:"GET",
			dataType : "json",
            url:siteurl+"pendaftaran/cek_dokter",
            data:"dept="+dept+"&hari="+hari+"&jam="+jam+"&rm="+rm+"&dokter="+dokter,
             success:function(result){
				 
				  if(result.status == '1'){
					 swal({
						 
						  title: "Pasien Sudah Terdaftar",
						  text : "Silahkan Pilih Jadwal Yang Lain.",
						  type : "warning",
			    	},					
					function (){
					window.location.reload(true);
					})				
					
				  } else {
					
					
				  }
			  }
        });
       
    }


	function PreviewPdf(id)
	{
		param=id;
		tujuan = 'customer/print_request/'+param;

	   	$(".modal-body").html('<iframe src="'+tujuan+'" frameborder="no" width="570" height="400"></iframe>');
	}

	function PreviewRekap()
	{
		tujuan = 'customer/rekap_pdf';
	   	$(".modal-body").html('<iframe src="'+tujuan+'" frameborder="no" width="100%" height="400"></iframe>');
	}
</script>
