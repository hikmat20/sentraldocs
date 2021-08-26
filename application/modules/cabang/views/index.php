<?php
    $ENABLE_ADD     = has_permission('Perusahaan.Add');
    $ENABLE_MANAGE  = has_permission('Perusahaan.Manage');
    $ENABLE_VIEW    = has_permission('Perusahaan.View');
    $ENABLE_DELETE  = has_permission('Perusahaan.Delete');
?>
<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">

<div class="box">
	<div class="box-header">
		<?php if ($ENABLE_ADD) : ?>
			<a class="btn btn-success" id="create" href="javascript:void(0)" title="Add" ><i class="fa fa-plus">&nbsp;</i>New</a>
		<?php endif; ?>

		<span class="pull-right">
				<?php //echo anchor(site_url('customer/downloadExcel'), ' <i class="fa fa-download"></i> Excel ', 'class="btn btn-primary btn-sm"'); ?>
		</span>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th width="10%">#</th>
			<th width="20%">Nama Perusahaan</th>
			<th width="20%">Nama Cabang</th>
			<th width="10%">Kode Cabang</th>
			<th width="30%">Alamat Cabang</th>
			<?php if($ENABLE_MANAGE) : ?>
			<th width="25">Action</th>
			<?php endif; ?>
		</tr>
		</thead>

		<tbody>
		<?php if(empty($results)){
		}else{
			$numb=0; foreach($results AS $record){ $numb++; 
			$idprsh = $record->id_perusahaan;
			$perusahaan = $this->db->query("SELECT nm_perusahaan FROM perusahaan WHERE id_perusahaan='$idprsh'")->row();
			$nm_perusahaan = $perusahaan->nm_perusahaan; 
		?>
		<tr>
		    <td><?= $numb; ?></td>
			<td><?= $nm_perusahaan ?></td>
			<td><?= $record->nm_cabang ?></td>
			<td><?= $record->inisial ?></td>
			<td><?= $record->alamat ?></td>			
			<td style="padding-left:20px">
			<?php if($ENABLE_MANAGE) : ?>
				<a class="text-green" id="edit" href="javascript:void(0)" title="Edit" data-cabang="<?=$record->id_cabang?>"><i class="fa fa-pencil"></i>
				</a>
			<?php endif; ?>

			<?php if($ENABLE_DELETE) : ?>
				<a class="text-red" href="javascript:void(0)" title="Delete" onclick="delete_data('<?=$record->id_cabang?>')"><i class="fa fa-trash"></i>
				</a>
			<?php endif; ?>
			</td>
		</tr>
		<?php } }  ?>
		</tbody>

		<tfoot>
		<tr>
			<th width="10%">#</th>
			<th width="20%">Nama Perusahaan</th>
			<th width="20%">Nama Cabang</th>
			<th width="10%">Kode Cabang</th>
			<th width="30%">Alamat Cabang</th>
			<?php if($ENABLE_MANAGE) : ?>
			<th width="25">Action</th>
			<?php endif; ?>
		</tr>
		</tfoot>
		</table>
	</div>
	<!-- /.box-body -->
</div>

<!-- awal untuk modal dialog -->
<!-- Modal -->
<div class="modal modal-success" id="dialog-data-lebihbayar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Add Cabang</h4>
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

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<!-- page script -->
<script type="text/javascript">

  	$(function() {
    	$("#example1").DataTable();
    	$("#form-area").hide();
  	});

  	function add_data(){
		var url = 'cabang/create/';
		$(".box").hide();
		$("#form-area").show();
		$("#form-area").load(siteurl+url);
		$("#title").focus();
	}

  	function edit_data(id){
		if(id!=""){
			var url = 'cabang/edit/'+id;
			$(".box").hide();
			$("#form-area").show();
			$("#form-area").load(siteurl+url);
		    $("#title").focus();
		}
	}

	//Delete
	function delete_data(id){
		//alert(id);
		swal({
		  title: "Anda Yakin?",
		  text: "Data Akan Terhapus secara Permanen!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Ya, delete!",
		  cancelButtonText: "Tidak!",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	$.ajax({
		            url: siteurl+'cabang/hapus_cabang/'+id,
		            dataType : "json",
		            type: 'POST',
		            success: function(msg){
		                if(msg['delete']=='1'){		                	
		                    swal({
		                      title: "Terhapus!",
		                      text: "Data berhasil dihapus",
		                      type: "success",
		                      timer: 1500,
		                      showConfirmButton: false
		                    });
		                    window.location.reload();
		                } else {
		                    swal({
		                      title: "Gagal!",
		                      text: "Data gagal dihapus",
		                      type: "error",
		                      timer: 1500,
		                      showConfirmButton: false
		                    });
		                };
		            },
		            error: function(){
		                swal({
	                      title: "Gagal!",
	                      text: "Gagal Eksekusi Ajax",
	                      type: "error",
	                      timer: 1500,
	                      showConfirmButton: false
	                    });
		            }
		        });
		  } else {
		    //cancel();
		  }
		});
	}

	function PreviewPdf(id)
	{
		param=id;
		tujuan = 'customer/print_request/'+param;

	   	$(".modal-body").html('<iframe src="'+tujuan+'" frameborder="no" width="570" height="400"></iframe>');
	}
	
	$(document).on('click', '#create', function(){
		
		var id_customer=0;
		
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Add Cabang</b>"); 
		$.ajax({
			type:'POST',
			 url:siteurl+'cabang/create/',
			data:{'id_customer':id_customer},
			success:function(data){
				$("#dialog-data-lebihbayar").modal();
				$("#MyModalBodyLebihbayar").html(data);
				
			}
		})
	});

    $(document).on('click', '#edit', function(){
		
		var id_cabang= $(this).data('cabang');
		
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Edit Cabang</b>"); 
		$.ajax({
			type:'POST',
			 url:siteurl+'cabang/edit/',
			data:{'id_cabang':id_cabang},
			success:function(data){
				$("#dialog-data-lebihbayar").modal();
				$("#MyModalBodyLebihbayar").html(data);
				
			}
		})
	});	
	
	

</script>
