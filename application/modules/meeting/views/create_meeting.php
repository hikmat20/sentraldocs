<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
 <form id="form-meeting" method="post">
<div class="nav-tabs-salesorder">
     <div class="tab-content">
        <div class="tab-pane active" id="salesorder">			
            <div class="box box-success">
               	<?php //print_r($kode_customer)?>
                <div class="box-body">
                    <div class="col-sm-6 form-horizontal">
					    <div class="row">
                          <div class="form-group ">
                            <label for="tgl_bayar" class="col-sm-4 control-label">SUBJECT :</label>
                            <div class="col-sm-6" id="select_subject">
                                 <select class="form-control input-sm select2" name="subject" id="subject">
									<option value="">Pilih Subject</option>								
								  </select> 								  
                            </div>
							 <button class="btn btn-sm btn-success" id="addsubject" type="button">
									<i class="fa fa-plus"></i></button>	
                          </div>						  
                        </div>
                        <div class="row">
                          <div class="form-group">
                              <label class="col-sm-4 control-label">SUB SUBJECT </font></label>
                              <div class="col-sm-6" id="select_subsubject">   
                                  <select class="form-control input-sm select2" name="subsubject" id="subsubject">
									<option value="">Pilih Sub Subject</option>								
								  </select> 							  
                              </div>
							  <button class="btn btn-sm btn-success" id="addsubsubject" type="button">
							  <i class="fa fa-plus"></i></button>	
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label for="deskripsi" class="col-sm-4 control-label">DESKRIPSI </font></label>
                            <div  class="col-sm-6">
                              <textarea name="deskripsi" class="form-control input-sm" id="deskripsi" height=100></textarea>                       
                            </div>
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
        <button class="btn btn-warning" onclick="kembali_inv()">
           <i class="fa fa-refresh"></i><b> Kembali</b>
        </button>
        <button class="btn btn-success" type="button" onclick="savemeeting()"> 
            <i class="fa fa-save"></i><b> Simpan Data</b>
        </button>
    </div>
  </div>
</div>

<div class="modal modal-success" id="dialog-data-lebihbayar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Add Data</h4>
      </div>
      <div class="modal-body" id="MyModalBodyLebihbayar" style="background: #FFF !important;color:#000 !important;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        <span class="glyphicon glyphicon-remove"></span>  Tutup</button> 
        </div>
    </div>
  </div>
</div>

<div class="modal modal-default fade" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span>&nbsp;List Invoice</h4>
      </div>
      <div class="modal-body" id="ModalView">
		...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">
        <span class="glyphicon glyphicon-remove"></span>  Tutup</button>
        </div>
    </div>
  </div>
</div>



 <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
 <script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
  <script src="<?= base_url('assets/js/jquery.maskMoney.js')?>"></script>
 <script>
	$(document).ready(function(){
		swal.close();
		get_subject();
		get_subsubject();
	});	
	 function savemeeting(){
	    if ($('#subject').val() == "") {
          swal({
            title	: "SUBJECT TIDAK BOLEH KOSONG!",
            text	: "ISI SUBJECT TERLEBIH DAHULU!",
            type	: "warning",
            timer	: 1000,
            showCancelButton	: false,
            showConfirmButton	: false,
            allowOutsideClick	: false
          });
        }
		else if ($('#subsubject').val() == "") {
          swal({
            title	: "SUB SUBJECT TIDAK BOLEH KOSONG!",
            text	: "ISI SUBJECT TERLEBIH DAHULU!",
            type	: "warning",
            timer	: 1000,
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
				var formdata = $("#form-meeting").serialize();
				$.ajax({
					url: siteurl+"meeting/saveMeeting",
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
						window.location.href = base_url + active_controller+'detail/'+data.kode;
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
	
	function kembali_inv(){
        window.location.href = base_url + active_controller;
    }
	
	
	function get_subject(){
       
		$.ajax({
            type:"GET",
            url:siteurl+'meeting/getsubject',
            data:"",
            success:function(html){
               $("#select_subject").html(html);
            }
        });
	}
	
	$(document).on('click', '#addsubject', function(){
		
		var id_customer=0;
		
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Add Subject</b>"); 
		$.ajax({
			type:'POST',
			 url:siteurl+'meeting/addsubject/',
			data:{'id_customer':id_customer},
			success:function(data){
				$("#dialog-data-lebihbayar").modal();
				$("#MyModalBodyLebihbayar").html(data);
				
			}
		})
	});	
	
	
	$(document).on('click', '#addsubsubject', function(){
		
		var id_customer=0;
		
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Add Sub Subject</b>"); 
		$.ajax({
			type:'POST',
			 url:siteurl+'meeting/addsubsubject/',
			data:{'id_customer':id_customer},
			success:function(data){
				$("#dialog-data-lebihbayar").modal();
				$("#MyModalBodyLebihbayar").html(data);
				
			}
		})
	});	
	
	function get_subsubject(){
       
		$.ajax({
            type:"GET",
            url:siteurl+'meeting/getsubsubject',
            data:"",
            success:function(html){
               $("#select_subsubject").html(html);
            }
        });
	}
	
	
	

</script>
