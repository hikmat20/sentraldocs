<?php
    $ENABLE_ADD     = has_permission('Meeting.Add');
    $ENABLE_MANAGE  = has_permission('Meeting.Manage');
    $ENABLE_VIEW    = has_permission('Meeting.View');
    $ENABLE_DELETE  = has_permission('Meeting.Delete');
	$ENABLE_APPROVE  = has_permission('Meeting.Approval');
?>
<div class="box box-primary">
  <div class="box-body table-responsive">
	<input type="hidden" id="tampil" name="tampil" value="<?=(isset($status_payment)?$status_payment:'0')?>" />
    <table id="tableset" class="table-condensed table-bordered table-striped" width="100%">
      <thead>
        <tr>
			<th class="text-center" width='4%'>No</th>
			<th class="text-center">Tgl</th>
			<th class="text-center">Subject</th>
			<th class="text-center">Sub Subject</th>
			<th class="text-center">Problem</th>
			<th class="text-center">Action Plan</th>
			<th class="text-center">Pic</th>
			<th class="text-center">Due Date</th>
			<th class="text-center">Tgl Selesai</th>
	        <th class="text-center">Status</th>					
			<th class="text-center" width='11%'>Progress</th>
			
        </tr>
      </thead>
      <tbody id="tbody-detail" class="text-center">
      </tbody>
    </table>
<!--
-->
  </div>
</div>
<form id="form-modal" action="" method="post">
  <div class="modal fade" id="ModalView">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="head_title"></h4>
        </div>
        <div class="modal-body" id="view">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="ModalView2">
    <div class="modal-dialog" style='width:30%; '>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="head_title2"></h4>
        </div>
        <div class="modal-body" id="view2">
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-primary">Save</button> -->
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="ModalView3">
    <div class="modal-dialog" style='width:30%; '>
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="head_title3"></h4>
        </div>
        <div class="modal-body" id="view3">
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-primary">Save</button>-->
          <button type="button" class="btn btn-default close3" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->
</form>

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
		var tampil = $("#tampil").val();		
		DataTables(tampil);	 
		
	})

	
    function DataTables(tampil) {
	var type = null;
	var sp = '0';
	
	if(tampil=='all'){
	var link = siteurl + active_controller + 'getDataJSON';
	}
	else if(tampil=='late'){
	var link = siteurl + active_controller + 'getDataJSONlate';
	}
	else{
	var link = siteurl + active_controller + 'getDataJSONfilter';
	}
	
	var dataTable = $('#tableset').DataTable({
      "serverSide": true,
      "stateSave": true,
      "bAutoWidth": true,
      "destroy": true,
      "responsive": true,
      "oLanguage": {
        "sSearch": "<b>Search : </b>",
        "sLengthMenu": "_MENU_ &nbsp;&nbsp;<b>Records Per Page</b>&nbsp;&nbsp;",
        "sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
        "sInfoFiltered": "(filtered from _MAX_ total entries)",
        "sZeroRecords": "No matching records found",
        "sEmptyTable": "No data available",
        "sLoadingRecords": "Please wait - loading...",
        "oPaginate": {
          "sPrevious": "Prev",
          "sNext": "Next"
        }
      },
      "aaSorting": [
        [1, "asc"]
      ],
      "columnDefs": [{
        "targets": 'no-sort',
        "orderable": false,
      }],
      "sPaginationType": "simple_numbers",
      "iDisplayLength": 10,
      "aLengthMenu": [
        [5, 10, 20, 50, 100, 150],
        [5, 10, 20, 50, 100, 150]
      ],
      "ajax": {
        url: link,
        type: "post",
        data: function(d) {
          d.status = type,
		  d.status_payment = sp,
		  d.filter = tampil
        },
        cache: false,
        error: function() {
          $(".my-grid-error").html("");
          $("#my-grid").append('<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
          $("#my-grid_processing").css("display", "none");
        }
      }
    });
    }
	
		
	
    $(document).on('click', '.selesai1', function(e) {
      var id = $(this).data('id');
	  var kdMeeting = $(this).data('kd_meeting');
      $.ajax({
        type: "post",
        url: siteurl + active_controller + 'selesai',       
	    data: "id="+id+"&kode="+kdMeeting,		
        success: function(result) {
          window.location.href = base_url + active_controller+'listmom/';
        }
      })
    });
	
	
	$(document).on('click', '.selesai', function(e) {
      var id = $(this).data('id');
	  var kdMeeting = $(this).data('kd_meeting');
	  
	   
        swal({
          title: "Peringatan !",
          text: "Pastikan data sudah lengkap dan benar",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#8FBC8F",
          confirmButtonText: "Ya, simpan!",
          cancelButtonText: "Batal!",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm){
			if(isConfirm) {
				var formdata = $("#form-subsubject").serialize();
				$.ajax({
					type: "post",
					dataType : "json",
					url: siteurl + active_controller + 'selesai',       
					data: "id="+id+"&kode="+kdMeeting,	
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
						window.location.href = base_url + active_controller+'listmom/';
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
		});    
  
  
       $(document).on('click', '.done', function(e) {
		  var id = $(this).data('id');
		  var kdMeeting = $(this).data('kd_meeting');
     
      $.ajax({
        type: "post",
        url: siteurl + active_controller + 'approval',
        
	    data: "id="+id+"&kode="+kdMeeting,		
        success: function(result) {
          $(".modal-dialog").css('width', '90%');
          $("#head_title").html("<b>APPROVAL</b>");
          $("#view").html(result);
          $("#ModalView").modal('show');
        }
      })
    });
	
</script>
