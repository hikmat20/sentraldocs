<?php
$ENABLE_ADD     = has_permission('Dokumen.Add');
$ENABLE_MANAGE  = has_permission('Dokumen.Manage');
$ENABLE_VIEW    = has_permission('Dokumen.View');
$ENABLE_DELETE  = has_permission('Dokumen.Delete');
$ENABLE_DOWNLOAD  = has_permission('Dokumen.Download');

$session = $this->session->userdata('app_session');
$prsh    = $session['id_perusahaan'];
$cbg     = $session['id_cabang'];

$sts = [
	'0' => 'Revisi',
	'1' => 'Waiting Review',
	'2' => 'Waiting Approval',
	'3' => 'Approve',
]; ?>

<div class="content d-flex flex-column flex-column-fluid">
	<div class="container">
		<div class="card card-stretch shadow card-custom">
			<div class="card-header">
				<h3 class="card-title"><a href="<?= base_url('dashboard/create_documents'); ?>"><i class="fa fa-arrow-left"></i></a>&nbsp <?= $title; ?></h3>
				<input type="hidden" id="uri1" name="uri1" value="<?php echo $this->uri->segment(1) ?>" />
				<input type="hidden" id="uri2" name="uri2" value="<?php echo $this->uri->segment(2) ?>" />
				<input type="hidden" id="uri3" name="uri3" value="<?php echo $this->uri->segment(3) ?>" />
				<input type="hidden" id="uri4" name="uri4" value="<?php echo $this->uri->segment(4) ?>" />
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead style="color:white">
						<tr>
							<th>Deskripsi</th>
							<th>Nama File</th>
							<th>Revisi</th>
							<th>Review By</th>
							<th>Approve By</th>
							<th>Status Approval</th>
							<th>Created On</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// doc1
						$idjabatan = $jabatan;
						$iduser    = $user;

						if ($doc1) :
							$n	= 0;
							foreach ($doc1 as $dc1) :
								$jabreview1 	= $dc1->id_review;
								$jabapprove1 	= $dc1->id_approval;
								$approve_by 	= $dc1->id_approval;
								$n++; ?>
								<tr>
									<td><?= $dc1->deskripsi; ?></td>
									<td><?= $dc1->nama_file; ?></td>
									<td><?= $dc1->revisi; ?></td>
									<td><?= $dc1->nm_review; ?><br><?= $dc1->review_by_name; ?></td>
									<td><?= $dc1->approve_by_name; ?></td>
									<td><?= $sts[$dc1->status_approve]; ?></td>
									<td><?= $dc1->created; ?></td>
									<td>
										<?php if (($dc1->status_approve == '2') && ($dc1->id_approval == $idjabatan)) : ?>
											<button type="button" class="btn btn-xs btn-shadow btn-icon btn-shadow btn-icon btn-warning approve" title="Approve Data" data-id="<?php echo $dc1->id ?>" data-file="<?php echo $dc1->nama_file ?>" data-table="gambar"> <i class="fa fa-check"></i></button>
										<?php endif; ?>
									</td>
								</tr>
							<?php
							endforeach; ?>
							<?php
						endif;

						// doc2
						if ($doc2) :
							$n	= 0;
							foreach ($doc2 as $dc2) :
								$jabreview1 	= $dc2->id_review;
								$jabapprove1 	= $dc2->id_approval;
								$approve_by 	= $dc2->id_approval;
								$n++; ?>
								<tr>
									<td><?= $dc2->deskripsi; ?></td>
									<td><?= $dc2->nama_file; ?></td>
									<td><?= $dc2->revisi; ?></td>
									<td><?= $dc2->review_by_name; ?></td>
									<td><?= $dc2->approve_by_name; ?></td>
									<td><?= $sts[$dc2->status_approve]; ?></td>
									<td><?= $dc2->created; ?></td>
									<td>
										<?php
										if ($dc2->status_approve == '2' && $dc2->id_approval == $idjabatan) :	?>
											<button type="button" class="btn btn-xs btn-shadow btn-icon btn-warning approve" title="Approve Data" data-id="<?php echo $dc2->id ?>" data-file="<?php echo $dc2->nama_file ?>" data-table="gambar1"> <i class="fa fa-check"></i></button>
										<?php endif; ?>
									</td>
								</tr>
							<?php
							endforeach; ?>
							<?php
						endif;

						// doc3
						if ($doc3) :
							$n	= 0;
							foreach ($doc3 as $dc3) :
								$jabreview1 	= $dc3->id_review;
								$jabapprove1 	= $dc3->id_approval;
								$approve_by 	= $dc3->id_approval;
								$n++; ?>
								<tr>
									<td><?= $dc3->deskripsi; ?></td>
									<td><?= $dc3->nama_file; ?></td>
									<td><?= $dc3->revisi; ?></td>
									<td><?= $dc3->review_by_name; ?></td>
									<td><?= $dc3->approve_by_name; ?></td>
									<td><?= $sts[$dc3->status_approve]; ?></td>
									<td><?= $dc3->created; ?></td>
									<td>
										<?php
										if ($dc3->status_approve == '2' && ($dc3->id_approval == $idjabatan)) :	?>
											<button type="button" class="btn btn-xs btn-warning approve" title="Approve Data" data-id="<?php echo $dc3->id ?>" data-file="<?php echo $dc3->nama_file ?>" data-table="gambar2"> <i class="fa fa-check"></i></button>
										<?php endif; ?>
									</td>
								</tr>
							<?php
							endforeach; ?>
						<?php
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
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, Process it!",
				cancelButtonText: "No, cancel process!",
				closeOnConfirm: true,
				closeOnCancel: false
			},
			function(isConfirm) {
				if (isConfirm) {
					loading_spinner();
					window.location.href = base_url + 'index.php/' + active_controller + '/delete/' + id;
				} else {
					Swal.fire("Cancelled", "Data can be process again :)", "error");
					return false;
				}
			});
	}

	$(document).on('click', '.review', function(e) {
		var id = $(this).data('id');
		var table = $(this).data('table');
		var file = $(this).data('file');
		var uri1 = $('#uri1').val();
		var uri2 = $('#uri2').val();
		var uri3 = $('#uri3').val();
		var uri4 = $('#uri4').val();

		$.ajax({
			type: "post",
			url: siteurl + active_controller + 'review/' + uri1 + '/' + uri2 + '/' + uri3 + '/' + uri4,
			data: "id=" + id + "&table=" + table + "&file=" + file,
			success: function(result) {
				$(".modal-dialog").css('width', '90%');
				$("#head_title").html("<b>REVIEW DOKUMEN</b>");
				$("#view").html(result);
				$("#ModalView").modal('show');
			}
		})
	});

	$(document).on('click', '.approve', function(e) {
		var id = $(this).data('id');
		var table = $(this).data('table');
		var file = $(this).data('file');
		$.ajax({
			type: "post",
			url: siteurl + active_controller + 'approval/',

			data: "id=" + id + "&table=" + table + "&file=" + file,
			success: function(result) {
				$(".modal-dialog").css('width', '90%');
				$("#head_title").html("<b>APPROVAL DOKUMEN</b>");
				$("#view").html(result);
				$("#ModalView").modal('show');
			}
		})
	});

	function saveapproval() {
		if ($('#status').val() == "") {
			Swal.fire({
				title: "STATUS TIDAK BOLEH KOSONG!",
				text: "ISI STATUS TERLEBIH DAHULU!",
				icon: "warning",
				timer: 3000,
				showCancelButton: false,
				showConfirmButton: false,
				allowOutsideClick: false
			});
		} else {
			Swal.fire({
				title: "Peringatan !",
				text: "Pastikan data sudah lengkap dan benar",
				icon: "warning",
				showCancelButton: true,
				confirmButtonText: "Ya, simpan!",
				cancelButtonText: "Batal!",
			}).then((value) => {
				if (value.isConfirmed == true) {
					var formdata = $("#form-subsubject").serialize();
					$.ajax({
						url: siteurl + "dokumen/saveApproval",
						dataType: "json",
						type: 'POST',
						data: formdata,
						success: function(data) {
							if (data.status == 1) {
								Swal.fire({
									title: "Save Success!",
									text: data.pesan,
									icon: "success",
									timer: 3000,
									showCancelButton: false,
									showConfirmButton: false,
									allowOutsideClick: false
								}).then(() => {
									location.reload();
								})
								// window.location.href = siteurl + active_controller + '/' + uri2 + '/' + uri3 + '/' + uri4;
							} else {

								if (data.status == 2) {
									Swal.fire({
										title: "Save Failed!",
										text: data.pesan,
										icon: "warning",
										timer: 3000,
										showCancelButton: false,
										showConfirmButton: false,
										allowOutsideClick: false
									});
								} else {
									Swal.fire({
										title: "Save Failed!",
										text: data.pesan,
										icon: "warning",
										timer: 3000,
										showCancelButton: false,
										showConfirmButton: false,
										allowOutsideClick: false
									});
								}

							}
						},
						error: function() {
							Swal.fire({
								title: "Gagal!",
								text: "Batal Proses, Data bisa diproses nanti",
								icon: "error",
								timer: 3000,
								showConfirmButton: false
							});
						}
					});
				}

			})
		}
	}

	$(document).on('click', '#save', function() {
		if ($('#status').val() == "") {
			Swal.fire({
				title: "STATUS TIDAK BOLEH KOSONG!",
				text: "ISI STATUS TERLEBIH DAHULU!",
				icon: "warning",
				timer: 3000,
				allowOutsideClick: false
			});
		} else {
			Swal.fire({
				title: "Peringatan !",
				text: "Pastikan data sudah lengkap dan benar",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ya, simpan!",
				cancelButtonText: "Batal!",
				closeOnConfirm: false,
				closeOnCancel: true
			}).then((value) => {
				if (value.isConfirmed == true) {
					var formdata = $("#form-subsubject").serialize();
					$.ajax({
						url: siteurl + "dokumen/saveReview",
						dataType: "json",
						type: 'POST',
						data: formdata,
						success: function(data) {
							if (data.status == 1) {
								Swal.fire({
									title: "Save Success!",
									text: data.pesan,
									icon: "success",
									timer: 2000,
									showConfirmButton: false,
									allowOutsideClick: false
								}).then(function() {
									location.reload();
								})
							} else {
								if (data.status == 2) {
									Swal.fire({
										title: "Save Failed!",
										text: data.pesan,
										icon: "warning",
										timer: 3000,
										showConfirmButton: false,
										allowOutsideClick: false
									});
								} else {
									Swal.fire({
										title: "Save Failed!",
										text: data.pesan,
										icon: "warning",
										timer: 3000,
										showConfirmButton: false,
										allowOutsideClick: false
									});
								}

							}
						},
						error: function() {
							Swal.fire({
								title: "Gagal!",
								text: "Batal Proses, Data bisa diproses nanti",
								icon: "error",
								timer: 2000,
								showConfirmButton: false
							});
						}
					});
				}

			})
		}
	})
</script>