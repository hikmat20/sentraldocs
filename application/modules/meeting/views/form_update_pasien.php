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
			<div class="col-md-12"><legend><h5><b><font color="green">Form Data Pasien</font></b></h5></legend></div>
			<div class="col-md-12">			    
                <div class="col-md-5">
				<div class="form-group row">
					<div class="col-md-4">
					  <label for="">No Rekam Medis</label>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="no_rm"  name="no_rm" placeholder="No Rekam Medis" value="<?= $record->medrec ?>" readonly>
					</div>
				</div>
				</div>
				<div class="col-md-5">
			    <div class="form-group row">
					<div class="col-md-4">
					  <label for="">Nama Pasien</label>
					</div>
					<div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="nama" name="nama" required placeholder="Nama Pasien" value="<?= $record->nama_pasien ?>" required >
					</div>
				</div>
				</div>				
				<div class="col-md-5">
					<div class="form-group row">
							<div class="col-md-4">
							<label for="">Titel</label>
							</div>
							<div class="col-md-8">
							<select class="form-control input-sm" id="titel" name="titel" value="<?= $record->status_pasien?>" required>
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
						<div class="col-md-4">
						<label for="">Jenis Kelamin</label>
						</div>
						<div class="col-md-8">
							<select class="form-control input-sm" id="jenis_kelamin" name="jenis_kelamin" value="<?= $record->jenis_kelamin ?>" required>
								<option value="L">Laki-Laki</option>
								<option value="P">Perempuan</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-5">
				<div class="form-group row">
					<div class="col-md-4">
					  <label for="">Tanggal Lahir</label>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="tgl_lahir"  name="tgl_lahir" placeholder="Tanggal Lahir" value="<?= $record->tgl_lahir ?>" required>
					</div>
				</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-4">
						<label for="">Agama</label>
						</div>
						<div class="col-md-8">
							<select class="form-control input-sm select2" id="agama" name="agama" value="<?= $record->agama ?>" required>
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
						<div class="col-md-4">
						<label for="">Provinsi</label>
						</div>
						<div class="col-md-8">
							<select id="provinsi" name="provinsi" class="form-control input-sm select2"  value="<?= $record->provinsi ?>" required onchange="get_kota()">
                            <option value=""></option>
                            <?php foreach ($datprov as $key => $st) : ?>
                            <option value="<?= $st->id_prov; ?>" <?= set_select('provinsi', $st->id_prov, isset($record->provinsi) && $record->provinsi == $st->id_prov) ?>>
                            <?= strtoupper($st->nama); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-4">
						<label for="">Kabupaten/Kota</label>
						</div>
						<div class="col-md-8">
							<select id="kota" name="kota" class="form-control input-sm select2"  value="<?= $record->kabupaten ?>" required onchange="get_kecamatan()">
                            <option value=""></option>
                            <?php foreach ($datkota as $key => $st) : ?>
                            <option value="<?= $st->id_kab; ?>" <?= set_select('kota', $st->id_kab, isset($record->kabupaten) && $record->kabupaten == $st->id_kab) ?>>
                            <?= $st->nama ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-4">
						<label for="">Kecamatan</label>
						</div>
						<div class="col-md-8">
							<select id="kecamatan"  name="kecamatan"  class="form-control input-sm select2" value="<?= $record->kecamatan ?>" required onchange="get_kelurahan()">
							<option value=""></option>
							<?php foreach ($datkec as $kota => $kt){
							?>
							 <option value="<?= $kt->id_kec; ?>" <?= set_select('kecamatan', $kt->id_kec, isset($record->kecamatan) && $record->kecamatan == $kt->id_kec) ?>>
                            <?= $kt->nama ?>
							</option>
							<?php } ?>
						  </select>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-4">
						<label for="">Kelurahan</label>
						</div>
						<div class="col-md-8">
							<select id="kelurahan"  name="kelurahan"  class="form-control input-sm select2" value="<?= $record->kelurahan ?>" required >
							<option value=""></option>
							<?php foreach ($datkel as $kota => $kl){
							?>
							 <option value="<?= $kl->id_kel; ?>" <?= set_select('kelurahan', $kl->id_kel, isset($record->kelurahan) && $record->kelurahan == $kl->id_kel) ?>>
                            <?= $kl->nama ?>
							</option>
							<?php } ?>
						  </select>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-4">
						  <label for="">Alamat Lengkap</label>
						</div>
						 <div class="col-md-8">
						   <textarea type="text" class="form-control input-sm" id="alamat" name="alamat"  placeholder="Alamat"><?= $record->kelurahan ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<div class="col-md-4">
						  <label for="">No Telp Pasien</label>
						</div>
						 <div class="col-md-8">
						  <input type="text" class="form-control input-sm" id="telp_pasien"  name="telp_pasien" placeholder="No Telp Pasien" value="<?= $record->telp_pasien ?>">
						</div>
					</div>
				</div>	
				<div class="col-md-5">
				<div class="form-group row">
					<div class="col-md-4">
					  <label for="">Penanggung Jawab</label>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="pj"  name="pj" placeholder="Penanggung Jawab" value="<?= $record->penanggung_jawab ?>">
					</div>
				</div>
				</div>
				<div class="col-md-5">
				<div class="form-group row">
					<div class="col-md-4">
					  <label for="">No Telp PJ</label>
					</div>
					 <div class="col-md-8">
					  <input type="text" class="form-control input-sm" id="telp_pj"  name="telp_pj" placeholder="No Telp Penanggung Jawab" value="<?= $record->telp_pasien ?>">
					</div>
				</div>
				</div>
				
				
            </div>				
			</div>
		</div>
	<hr>
	<center>
	<button type="submit" class="btn btn-success btn-sm" name="save" id="save"><i class="fa fa-save"></i>Update</button>
	<button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-close"></i> Cancel</button>
	<a class="btn btn-warning btn-sm" href="<?= base_url('pendaftaran') ?>" title="Back"> <i class="fa fa-reply">&nbsp;</i>Back</a>
	</center>
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
			  url:siteurl+'pendaftaran/savePendaftaranRj',
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
		
		
	function get_kota(){
        var provinsi=$("#provinsi").val();
        $.ajax({
            type:"GET",
            url:siteurl+"pendaftaran/get_kota",
            data:"provinsi="+provinsi,
            success:function(html){
               $("#kota").html(html);
            }
        });
    }
	
	function get_kecamatan(){
        var kota=$("#kota").val();
        $.ajax({
            type:"GET",
            url:siteurl+"pendaftaran/get_kecamatan",
            data:"kota="+kota,
            success:function(html){
               $("#kecamatan").html(html);
            }
        });
    }
	
	function get_kelurahan(){
        var kec=$("#kecamatan").val();
        $.ajax({
            type:"GET",
            url:siteurl+"pendaftaran/get_kelurahan",
            data:"kec="+kec,
            success:function(html){
               $("#kelurahan").html(html);
            }
        });
    }
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
