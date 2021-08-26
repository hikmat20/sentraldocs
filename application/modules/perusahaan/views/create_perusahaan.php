<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
 <form id="form-subject" method="post">
<div class="nav-tabs-salesorder">
     <div class="tab-content">
        <div class="tab-pane active" id="salesorder">			
            <div class="box box-success">
               	<?php //print_r($kode_customer)?>
                <div class="box-body">
                    <div class="col-sm-6 form-horizontal">
					    <div class="row">
                          <div class="form-group ">
                            <label for="nm_perusahaan" class="col-sm-4 control-label">Nama Perusahaan</label> 
                            <div class="col-sm-6">
                                <input type="text" class="form-control input-sm" name="nm_perusahaan" id="nm_perusahaan">
                            </div>
							
                          </div>						  
                        </div>
						<div class="row">
                          <div class="form-group ">
                            <label for="inisial_perusahaan" class="col-sm-4 control-label">Inisial Perusahaan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control input-sm" name="inisial_perusahaan" id="inisial_perusahaan">
                            </div>
							
                          </div>						  
                        </div>
						<div class="row" hidden>
                          <div class="form-group ">
                            <label for="alamat_perusahaan" class="col-sm-4 control-label">Alamat Perusahaan</label>
                            <div class="col-sm-6">
                                <textarea class="form-control input-sm" name="alamat_perusahaan" id="alamat_perusahaan"></textarea>
                            </div>
							
                          </div>						  
                        </div>
                       
            </div>
		</div>
	</div>
   </div>
</div>
</form>

<div class="text-center">
  <div class="box active"> 
    <div class="box-body">
        <button class="btn btn-success" type="button" onclick="savesubject()"> 
            <i class="fa fa-save"></i><b> Simpan</b>
        </button>
    </div>
  </div>
</div>


 <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
 <script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
  <script src="<?= base_url('assets/js/jquery.maskMoney.js')?>"></script>
 <script>
 
	function savesubject(){
	    if ($('#nm_perusahaan').val() == "") {
          swal({
            title	: "NAMA PERUSAHAAN TIDAK BOLEH KOSONG!",
            text	: "ISI NAMA PERUSAHAAN TERLEBIH DAHULU!",
            type	: "warning",
            timer	: 500,
            showCancelButton	: false,
            showConfirmButton	: false,
            allowOutsideClick	: false
          });
        }
		else if ($('#inisial_perusahaan').val() == "") {
          swal({
            title	: "INISIAL PERUSAHAAN TIDAK BOLEH KOSONG!",
            text	: "ISI INISIAL PERUSAHAAN TERLEBIH DAHULU!",
            type	: "warning",
            timer	: 500,
            showCancelButton	: false,
            showConfirmButton	: false,
            allowOutsideClick	: false
          });
        }
		else {		
        swal({
          title: "Peringatan !",
          text: "Pastikan data sudah lengkap dan benar",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya, simpan!",
          cancelButtonText: "Batal!",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm){
			if(isConfirm) {
				var formdata = $("#form-subject").serialize();
				$.ajax({
					url: siteurl+"perusahaan/savePerusahaan",
					dataType : "json",
					type: 'POST',
					data: formdata,
					success: function(data){
						if(data.status == 1){
						swal({
						  title	: "Save Success!",
						  text	: data.pesan,
						  type	: "success",
						  timer	: 15000,
						  showCancelButton	: false,
						  showConfirmButton	: false,
						  allowOutsideClick	: false
						});
						window.location.href = base_url + active_controller;
					  }else{

						if(data.status == 2){
						  swal({
							title	: "Save Failed!",
							text	: data.pesan,
							type	: "warning",
							timer	: 10000,
							showCancelButton	: false,
							showConfirmButton	: false,
							allowOutsideClick	: false
						  });
						}else{
						  swal({
							title	: "Save Failed!",
							text	: data.pesan,
							type	: "warning",
							timer	: 10000,
							showCancelButton	: false,
							showConfirmButton	: false,
							allowOutsideClick	: false
						  });
						}

					  }
					},
					error: function(){
						swal({
							title: "Gagal!",
							text: "Batal Proses, Data bisa diproses nanti",
							type: "error",
							timer: 1500,
							showConfirmButton: false
						});
					}
				});
			}
        });		
		}    
    }
	
	
	

</script>
