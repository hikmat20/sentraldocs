<?php
$ENABLE_ADD     = has_permission('Dokumen.Add');
$ENABLE_MANAGE  = has_permission('Dokumen.Manage');
$ENABLE_VIEW    = has_permission('Dokumen.View');
$ENABLE_DELETE  = has_permission('Dokumen.Delete');
$ENABLE_DOWNLOAD  = has_permission('Dokumen.Download');
?>
<div class="content d-flex flex-column flex-column-fluid">
	<div class="container">
		<div class="card card-stretch shadow card-custom">
			<div class="card-header">
				<h3 class="card-title"><a href="<?= base_url('dashboard/create_documents'); ?>"><i class="fa fa-arrow-left"></i></a>&nbsp <?= $title; ?></h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead style="color:white">
						<tr>
							<th>Deskripsi</th>
							<th>Nama File</th>
							<th>Revisi</th>
							<th>Review</th>
							<th>Approve By</th>
							<th>Status</th>
							<th>Created On</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// doc1
						if ($doc1) :
							$n	= 0;
							foreach ($doc1 as $dc1) :
								$jabreview1 	= $dc1->id_review;
								$jabapprove1 	= $dc1->id_approval;
								$n++; ?>
								<tr>
									<td><?= $dc1->deskripsi; ?></td>
									<td><?= $dc1->nama_file; ?></td>
									<td><?= $dc1->revisi; ?></td>
									<td><?= $dc1->nm_review; ?></td>
									<td><?= $dc1->approve_by_name; ?></td>
									<td><?= $sts[$dc1->status_approve]; ?></td>
									<td><?= $dc1->created; ?></td>
									<td>
										<?php
										if (($dc1->status_approve == '1') && ($dc1->id_review == $idjabatan)) :	?>
											<button type="button" class="btn btn-xs btn-shadow btn-icon btn-shadow btn-icon btn-primary review" title="Review Data" data-id="<?php echo $dc1->id ?>" data-file="<?php echo $dc1->nama_file ?>" data-table="gambar"> <i class="fa fa-eye"></i></button>
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
								$n++; ?>
								<tr>
									<td><?= $dc2->deskripsi; ?></td>
									<td><?= $dc2->nama_file; ?></td>
									<td><?= $dc2->revisi; ?></td>
									<td><?= $dc2->nm_review; ?></td>
									<td><?= $dc2->approve_by_name; ?></td>
									<td><?= $sts[$dc2->status_approve]; ?></td>
									<td><?= $dc2->created; ?></td>
									<td>
										<?php
										if ($dc2->status_approve == '1' && ($dc2->id_review == $idjabatan)) :	?>
											<button type="button" class="btn btn-xs btn-shadow btn-icon btn-primary review" title="Review Data" data-id="<?php echo $dc2->id ?>" data-file="<?php echo $dc2->nama_file ?>" data-table="gambar1"> <i class="fa fa-eye"></i></button>
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
								$carireview1 	= $this->db->query("SELECT * FROM tbl_pejabat WHERE id_user ='$iduser' AND id_jabatan='$jabreview1' AND id_perusahaan='$prsh' AND id_cabang='$cbg'")->num_rows();
								$cariapproval1 	= $this->db->query("SELECT * FROM tbl_pejabat WHERE id_user ='$iduser' AND id_jabatan='$jabapprove1' AND id_perusahaan='$prsh' AND id_cabang='$cbg'")->num_rows();
								$approveby 		= $this->db->query("SELECT * FROM users WHERE id_user ='$approve_by'")->row();;
								$n++; ?>
								<tr>
									<td><?= $dc3->deskripsi; ?></td>
									<td><?= $dc3->nama_file; ?></td>
									<td><?= $dc3->revisi; ?></td>
									<td><?= $dc3->nm_review; ?></td>
									<td><?= $dc3->approve_by_name; ?></td>
									<td><?= $sts[$dc3->status_approve]; ?></td>
									<td><?= $dc3->created; ?></td>
									<td>
										<?php
										if ($dc3->status_approve == '3' && ($dc2->id_review == $idjabatan)) :	?>
											<button type="button" class="btn btn-xs btn-shadow btn-icon btn-primary review" title="Review Data" data-id="<?php echo $dc2->id ?>" data-file="<?php echo $dc2->nama_file ?>" data-table="gambar2"> <i class="fa fa-eye"></i></button>
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

	$(document).on('click', '.review', function(e) {
		var id = $(this).data('id');
		var table = $(this).data('table');
		var file = $(this).data('file');

		$.ajax({
			type: "post",
			url: siteurl + active_controller + 'review_form',
			data: "id=" + id + "&table=" + table + "&file=" + file,
			success: function(result) {
				$(".modal-dialog").css('width', '90%');
				$("#head_title").html("<b>REVIEW DOKUMEN</b>");
				$("#view").html(result);
				$("#ModalView").modal('show');
			}
		})
	});

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