<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
 <form id="form-detail-meeting" method="post">
<div class="nav-tabs-salesorder">
     <div class="tab-content">
        <div class="tab-pane active" id="salesorder">			
            <div class="box box-success">
               	<?php
				foreach ($results as $header){
					
				}	
				
				// print_r($results);
				// exit;
				?>
                <div class="box-body">
				  
				    <div class="col-sm-4 form-horizontal">
					   
                          <div class="form-group ">
						    <label for="tgl_bayar" class="col-sm-4 control-label">SUBJECT :</label>
                            <div class="col-sm-6" >
							     <input type="hidden" class="form-control" id="kd_meeting" value="<?= $header->kd_meeting ?>"  required name="kd_meeting" readonly>		
                                 <input type="text" class="form-control" id="subject" value="<?= $header->subject ?>"  required name="subject" readonly>				  
                            </div>
							
                          </div>						  
                    </div>   
					
                    <div class="col-sm-4 form-horizontal">   
                          <div class="form-group">
                              <label class="col-sm-4 control-label">SUB SUBJECT </font></label>
                              <div class="col-sm-6">   
                               <input type="text" class="form-control" id="subsubject" value="<?= $header->sub_subject ?>"  required name="subsubject" readonly>							  
                              </div>
							
                          </div>
                    </div>   
                    <div class="col-sm-4 form-horizontal">    
                          <div class="form-group">
                            <label for="deskripsi" class="col-sm-4 control-label">DESKRIPSI </font></label>
                            <div  class="col-sm-6">
                              <textarea name="deskripsi" class="form-control input-sm" id="deskripsi" height=50 readonly><?php echo $header->description ?></textarea>            							  
                            </div>
                          </div>
                        
	                </div>
					
			<button type='button' onclick='kembali()' title='Kembali' class='btn btn-sm btn-success'><i class='fa fa-reply-all'></i></button>
	        </div>
			</div>
	</div>
   </div>
</div>


<div class="box box-success">
        <div class="box box-success">
		    &nbsp;&nbsp;Input Detail MOM
			<br>
			<table>
				<tr valign="top">
				<th width="5px"></th>
			    <th> <textarea name="problem" class="form-control input-sm" id="problem"  placeholder="Problem" cols="50" rows="1"></textarea>     </th>
				<th> <textarea name="action_plan" class="form-control input-sm" id="action_plan"  placeholder="Action Plan"  cols="50" rows="1"></textarea>     </th>
				<th id="get_pic">  
				     									 
				</th>
				<th> <input type="text" class="form-control tanggal" id="due_date" name="due_date" placeholder="Due Date"></th>
				<th width="5px"></th>
				<th><button type="button" class="btn btn-success" id="add" onclick="savedetailmeeting()"><i class="fa fa-check"></i>
			    </button></th>
				</tr>
			</table>
			<hr>
		</div>
	    
		
</div>

</form>
<form id='form-update' method='post'>
<div class="box box-success" id="data"></div>  
</form>




 <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
 <script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
  <script src="<?= base_url('assets/js/jquery.maskMoney.js')?>"></script>
 <script>
	$(document).ready(function(){
		swal.close();
		get_pic();
		DataDetail();
		$('.select2').select2();
	});	
	 function savedetailmeeting(){
	    if ($('#problem').val() == "") {
          swal({
            title	: "KOLOM PROBLEM TIDAK BOLEH KOSONG!",
            text	: "ISI PROBLEM TERLEBIH DAHULU!",
            type	: "warning",
            timer	: 1000,
            showCancelButton	: false,
            showConfirmButton	: false,
            allowOutsideClick	: false
          });
        }
		else if ($('#action_plan').val() == "") {
          swal({
            title	: "ACTION PLAN TIDAK BOLEH KOSONG!",
            text	: "ISI ACTION PLAN TERLEBIH DAHULU!",
            type	: "warning",
            timer	: 1000,
            showCancelButton	: false,
            showConfirmButton	: false,
            allowOutsideClick	: false
          });
        }
		else if ($('#pic').val() == "") {
          swal({
            title	: "PIC TIDAK BOLEH KOSONG!",
            text	: "ISI PIC TERLEBIH DAHULU!",
            type	: "warning",
            timer	: 1000,
            showCancelButton	: false,
            showConfirmButton	: false,
            allowOutsideClick	: false
          });
        }
		else if ($('#due_date').val() == "") {
          swal({
            title	: "DUE DATE TIDAK BOLEH KOSONG!",
            text	: "ISI DUE DATE TERLEBIH DAHULU!",
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
				var formdata = $("#form-detail-meeting").serialize();
				$.ajax({
					url: siteurl+"meeting/saveDetailmeeting",
					dataType : "json",
					type: 'POST',
					data: formdata,
					success: function(data){
						if(data.status == 1){
						swal({
						  title	: "Save Success!",
						  text	: data.pesan,
						  type	: "success",
						  timer	: 500,
						  showCancelButton	: false,
						  showConfirmButton	: false,
						  allowOutsideClick	: false
						});
						window.location.href = base_url + active_controller+'detail/'+data.kode;
						DataDetail();
					  }else{

						if(data.status == 2){
						  swal({
							title	: "Save Failed!",
							text	: data.pesan,
							type	: "warning",
							timer	: 1000,
							showCancelButton	: false,
							showConfirmButton	: false,
							allowOutsideClick	: false
						  });
						}else{
						  swal({
							title	: "Save Failed!",
							text	: data.pesan,
							type	: "warning",
							timer	: 1000,
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
							timer: 1000,
							showConfirmButton: false
						});
					}
				});
			}
        });		
		}    
    }
	
	
	
	$('.tanggal').datepicker({
			format: 'dd-mm-yyyy',
			startDate: '0',
			autoclose: true,
			todayHighlight: true
			});
			
	
	
	
	
	function get_pic(){
       
		$.ajax({
            type:"GET",
            url:siteurl+'meeting/get_pic',
            data:"",
            success:function(html){
               $("#get_pic").html(html);
			   $('.select2').select2();
            }
        });
	}
	
	
	function DataDetail(){
			
		var	cari		= $("#kd_meeting").val();		
		 
		$.ajax({
			type	: "POST",
			url		:siteurl+"meeting/load_detail",
			data	: "cari="+cari,
			success	: function(data){
				$("#data").html(data);
				$("#loading").fadeOut(100);	
		   		$("#data").fadeIn(500);	
				
				$('.tanggal2').datepicker({
				format: 'dd-mm-yyyy',
				startDate: '0',
				autoclose: true,
				todayHighlight: true
				});
               					
			}
		});
	}
	
	$(function() {
		$('.select2').select2();
  	});
	
	function edit(id){
		$('.view'+id).hide();
        $('.edit'+id).show();		
    }
	
	function kembali(){
        window.location.href = base_url + active_controller;
    }
	
	
	function update(id){
		if ($('#problem'+id).val() == "") {
          swal({
            title	: "KOLOM PROBLEM TIDAK BOLEH KOSONG!",
            text	: "ISI PROBLEM TERLEBIH DAHULU!",
            type	: "warning",
            timer	: 1000,
            showCancelButton	: false,
            showConfirmButton	: false,
            allowOutsideClick	: false
          });
        }
		else if ($('#action_plan'+id).val() == "") {
          swal({
            title	: "ACTION PLAN TIDAK BOLEH KOSONG!",
            text	: "ISI ACTION PLAN TERLEBIH DAHULU!",
            type	: "warning",
            timer	: 1000,
            showCancelButton	: false,
            showConfirmButton	: false,
            allowOutsideClick	: false
          });
        }
		else if ($('#pic'+id).val() == "") {
          swal({
            title	: "PIC TIDAK BOLEH KOSONG!",
            text	: "ISI PIC TERLEBIH DAHULU!",
            type	: "warning",
            timer	: 1000,
            showCancelButton	: false,
            showConfirmButton	: false,
            allowOutsideClick	: false
          });
        }
		else if ($('#due_date'+id).val() == "") {
          swal({
            title	: "DUE DATE TIDAK BOLEH KOSONG!",
            text	: "ISI DUE DATE TERLEBIH DAHULU!",
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
				var formdata = $("#form-update").serialize();
				$.ajax({
					url: siteurl+"meeting/updateDetailmeeting/"+id,
					dataType : "json",
					type: 'POST',
					data: formdata,
					success: function(data){
						if(data.status == 1){
						swal({
						  title	: "Save Success!",
						  text	: data.pesan,
						  type	: "success",
						  timer	: 500,
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
							timer	: 1000,
							showCancelButton	: false,
							showConfirmButton	: false,
							allowOutsideClick	: false
						  });
						}else{
						  swal({
							title	: "Save Failed!",
							text	: data.pesan,
							type	: "warning",
							timer	: 1000,
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
							timer: 1000,
							showConfirmButton: false
						});
					}
				});
			}
        });		
		}    
		
		
    }
	
	
	

</script>
