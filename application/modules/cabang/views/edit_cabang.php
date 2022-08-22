<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
 <form id="form-subject" method="post">
<div class="nav-tabs-salesorder">
     <div class="tab-content">
        <div class="tab-pane active" id="salesorder">			
            <div class="box box-success">
               	<?php 
				$id_cabang = $id;
				
			    $data=$this->db->query("SELECT * FROM perusahaan_cbg WHERE  id_cabang='$id_cabang' ")->row(); 
				$perusahaan = $data->id_perusahaan;
				
				?>
                <div class="box-body">
                    <div class="col-sm-6 form-horizontal">
					    <div class="row">
                          <div class="form-group ">
                            <label for="nm_perusahaan" class="col-sm-4 control-label">Nama Perusahaan</label> 
                            <div class="col-sm-6">
							    <input type="hidden" class="form-control input-sm" name="id_cabang" id="id_cabang" value="<?=$data->id_cabang ?>">
								<?php
                                  $users	= $this->db->query("SELECT * FROM perusahaan")->result();
									echo "<select id='nm_perusahaan' name='nm_perusahaan' class='select2'>
									<option value=''>Pilih Perusahaan</option>";
									foreach($users as $pic){
									if($perusahaan == $pic->id_perusahaan){
									$selected ='selected';										
									}
									else{
									$selected ='';		
									}
									echo "<option value='$pic->id_perusahaan' $selected>$pic->nm_perusahaan</option>";
											}
									echo "</select>";								
								?> 								  
                                   </div>
								
                            </div>
							
                          </div>						  
                        
						<div class="row">
                          <div class="form-group ">
                            <label for="nm_cabang" class="col-sm-4 control-label">Nama Cabang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control input-sm" name="nm_cabang" id="nm_cabang" value="<?=$data->nm_cabang ?>">
                            </div>
							
                          </div>						  
                        </div>
						<div class="row">
                          <div class="form-group ">
                            <label for="inisial" class="col-sm-4 control-label">Kode Cabang</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control input-sm" name="inisial" id="inisial" value="<?=$data->inisial ?>">
                            </div>
							
                          </div>						  
                        </div>
						<div class="row">
                          <div class="form-group ">
                            <label for="alamat_cabang" class="col-sm-4 control-label">Alamat Cabang</label>
                            <div class="col-sm-6">
                                <textarea class="form-control input-sm" name="alamat_cabang" id="alamat_cabang"><?=$data->alamat ?></textarea>
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
		else if ($('#nm_cabang').val() == "") {
          swal({
            title	: "NAMA CABANG TIDAK BOLEH KOSONG!",
            text	: "ISI NAMA CABANG TERLEBIH DAHULU!",
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
					url: siteurl+"cabang/saveEditCabang",
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
