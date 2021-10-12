<?php
$sts = [
	'0' => 'Revisi',
	'1' => 'Waiting Review',
	'2' => 'Waiting Approval',
	'3' => 'Approve',
]; ?>
<div class="content d-flex flex-column flex-column-fluid">
	<div class="container">
		<div class="card-stretch shadow card-custom">
			<div class="card-header pb-0">
				<h3 class="card-title"><a class="text-danger" href="<?= base_url('dashboard/create_documents'); ?>"><i class="fa fa-arrow-left"></i></a> &nbsp<?= $title; ?></h3>
			</div>
			<div class="card-body bg-white">
				<table id="example1" class="table table-bordered table-striped">
					<thead style="color:white">
						<tr>
							<th>Deskripsi</th>
							<th>Nama File</th>
							<th>Revisi</th>
							<th>Status Approval</th>
							<th>Created On</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$idjabatan = $jabatan;
						if ($doc1) :
							$n	= 0;
							foreach ($doc1 as $doc) : $n++; ?>
								<!-- // $dtid = $doc->id;
								// $appr = $this->db->query("SELECT approval_on as tgl_dt, keterangan as ket_dt FROM tbl_approval WHERE id_dokumen ='$dtid' AND nm_table='gambar'")->result_array(); -->
								<tr>
									<td><?= $doc->deskripsi; ?></td>
									<td><?= $doc->nama_file; ?></td>
									<td><?= $doc->revisi; ?></td>
									<td><?= $sts[$doc->status_approve]; ?></td>
									<td><?= $doc->created; ?></td>
									<td>
										<?php if ($doc->status_approve == '0') : ?>
											<button type="button" class="btn btn-xs btn-warning btn-icon btn-shadow edit" title="Edit Data" data-id="<?php echo $doc->id ?>" data-file="<?php echo $doc->nama_file ?>" data-table="gambar"> <i class="fa fa-pen"></i></button>
										<?php endif; ?>
									</td>
								</tr>
							<?php
							endforeach;
						endif;

						if ($doc2) :
							$n	= 0;
							foreach ($doc2 as $dc2) : ?>
								<tr>
									<td><?= $dc2->deskripsi; ?></td>
									<td><?= $dc2->nama_file; ?></td>
									<td><?= $dc2->revisi; ?></td>
									<td><?= $sts[$dc2->status_approve]; ?></td>
									<td><?= $dc2->created; ?></td>
									<td>
										<?php if ($dc2->status_approve == '0') : ?>
											<button type="button" class="btn btn-xs btn-warning btn-icon btn-shadow edit" title="Edit Data" data-id="<?php echo $dc2->id ?>" data-file="<?php echo $dc2->nama_file ?>" data-table="gambar1"><i class="fa fa-edit"></i></button>
										<?php endif; ?>
									</td>
								</tr>
							<?php
							endforeach;
						endif;

						if ($doc3) :
							$n	= 0;
							foreach ($doc3 as $dc3) : $n++; ?>
								<tr>
									<td><?= $dc3->deskripsi; ?></td>
									<td><?= $dc3->nama_file; ?></td>
									<td><?= $dc3->revisi; ?></td>
									<td><?= $sts[$dc3->status_approve]; ?></td>
									<td><?= $dc3->created; ?></td>
									<td>
										<?php if ($dc3->status_approve == '1' && $dc3->id_approval == $idjabatan) : ?>
											<button type="button" class="btn btn-xs btn-warning btn-icon btn-shadow edit" title="Edit Data" data-file="<?php echo $dc3->nama_file ?>" data-id="<?php echo $dc3->id ?>" data-table="gambar2"><i class="fa fa-edit"></i></button>
										<?php endif; ?>
									</td>
								</tr>
						<?php
							endforeach;
						endif; ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>

</div>

<form id="form-modal" action="" method="post">
	<div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" style="max-width: 1360px !Important;" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="head_title">Modal Title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<div class="modal-body">
					<div id="view"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- modal -->
</form>

<script>
	$('#example1').DataTable({
		orderCellsTop: false,
		fixedHeader: true,
		scrollX: true,
		ordering: false,
		info: false
	});

	$(document).ready(function() {
		$('#btn-add').click(function() {
			loading_spinner();
		});

	});

	function delData(id) {
		Swal.fire({
				title: "Are you sure?",
				text: "You will not be able to process again this data!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, Process it!",
				cancelButtonText: "No, cancel process!",
			},
			function(isConfirm) {
				if (isConfirm) {
					loading_spinner();
					window.location.href = base_url + active_controller + '/delete/' + id;
				} else {
					Swal.fire("Cancelled", "Data can be process again :)", "error");
					return false;
				}
			});
	}

	$(document).on('click', '.edit', function(e) {
		var id = $(this).data('id');
		var table = $(this).data('table');
		var file = $(this).data('file');
		$.ajax({
			url: siteurl + active_controller + 'addkoreksi',
			type: "POST",
			data: "id=" + id + "&table=" + table + "&file=" + file,
			success: function(result) {
				$(".modal-dialog").css('width', '90%');
				$("#head_title").html("<b>KOREKSI</b>");
				$("#view").html(result);
				$("#ModalView").modal('show');
			}
		})
	});
</script>