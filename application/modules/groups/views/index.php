<div class="content d-flex flex-column flex-column-fluid p-0">
	<div class="d-flex flex-column-fluid justify-content-between align-items-top">
		<div class="container mt-10">
			<div class="card">
				<div class="card-header py-3 ">
					<div class="d-flex justify-content-between">
						<h1><i class="fa fa-users mr-2 text-dark"></i><?= $title; ?></h1>
						<a class="btn btn-success" id="create" href="javascript:void(0)" title="Add"><i class="fa fa-plus">&nbsp;</i>Add Group</a>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="card-body pt-2">
					<table id="example1" class="table table-condensed table-sm">
						<thead>
							<tr class="table-secondary">
								<th width="20">#</th>
								<th width="15%">Group Name</th>
								<th width="">Description</th>
								<th width="15%" class="text-center">Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php if ($results) : $n = 0;
								foreach ($results as $record) : $n++; ?>
									<tr>
										<td><?= $n; ?></td>
										<td><?= $record->nm_group ?></td>
										<td><?= $record->ket ?></td>
										<td class="text-center">
											<a class="btn btn-xs btn-icon btn-primary" id="view" data-id="<?= $record->id_group; ?>" title="Access Group"><i class="fa fa-search"></i>
											</a>
											<a class="btn btn-xs btn-icon btn-primary" id="access" href="<?= base_url($this->uri->segment(1) . '/permissions/' . $record->id_group); ?>" data-id="<?= $record->id_group; ?>" title="Access Group"><i class="fa fa-key"></i>
											</a>
											<?php if ($record->company_id) : ?>
												<a class="btn btn-xs btn-icon btn-warning" id="edit" href="javascript:void(0)" data-id="<?= $record->id_group; ?>" title="Edit"><i class="fa fa-pen"></i>
												</a>
												<a class="btn btn-icon btn-danger btn-xs" href="javascript:void(0)" data-id="<?= $record->id_group; ?>" title="Delete"><i class="fa fa-trash"></i>
												</a>
											<?php endif; ?>
										</td>
									</tr>
							<?php endforeach;
							endif; ?>
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="head_title">Title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid" id="modalData">
					<div class="text-center text-dark-25">
						Not availabel data
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-primary" id="save"><i class="fa fa-save mr-1"></i>Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="ModalView" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="head_title">View Access</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="modalDataView">

			</div>
			<div class="modal-footer justify-content-end">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	$('#exampleModal').on('show.bs.modal', event => {
		var button = $(event.relatedTarget);
		var modal = $(this);
		// Use above variables to manipulate the DOM

	});
</script>

<!-- page script -->
<script type="text/javascript">
	$(function() {
		$("#example1").DataTable();
		$("#form-area").hide();
	});

	$(document).on('click', '#create', function() {
		$("#head_title").html("<i class='fa fa-users mr-2'></i><b>Add Group</b>");
		$("#Modal").modal();
		$("#modalData").load(siteurl + active_controller + 'create');
	});

	$(document).on('click', '#view', function() {
		const id = $(this).data('id')
		$("#head_title").html("<i class='fa fa-users mr-2'></i><b>View Access</b>");
		$("#ModalView").modal();
		$("#modalDataView").load(siteurl + active_controller + 'view/' + id);
	});

	$(document).on('click', '#edit', function() {
		const id = $(this).data('id')
		$("#Modal").modal();
		$("#modalData").load(siteurl + active_controller + 'edit/' + id);
	});

	$(document).on('click', '#save', function() {
		const formData = new FormData($('#form-groups')[0])
		const name = $('#group_name').val()
		$('input').removeClass('is-invalid')

		if (!name) {
			$("#group_name").addClass('is-invalid')
			return false;
		} else {
			$.ajax({
				url: siteurl + active_controller + 'save',
				data: formData,
				dataType: 'JSON',
				type: "POST",
				contentType: false,
				processData: false,
				cache: false,
				success: function(result) {
					if (result.status == 1) {
						Swal.fire({
							title: 'Success!',
							text: result.msg,
							icon: 'success',
							timer: 2000,
							confirmButton: false
						}).then(function() {
							location.reload()
						})
					} else {
						Swal.fire({
							title: 'Warning!',
							text: result.msg,
							icon: 'warning',
							timer: 2000,
							confirmButton: false
						})
					}
				},
				error: function(result) {
					Swal.fire({
						title: 'Error!',
						text: 'Server timeout..!!',
						icon: 'error',
						timer: 3000,
						confirmButton: false
					})
				}
			})
		}
	})

	//Delete
	function delete_data(id) {
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
			function(isConfirm) {
				if (isConfirm) {
					$.ajax({
						url: siteurl + 'cabang/hapus_cabang/' + id,
						dataType: "json",
						type: 'POST',
						success: function(msg) {
							if (msg['delete'] == '1') {
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
						error: function() {
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

	function PreviewPdf(id) {
		param = id;
		tujuan = 'customer/print_request/' + param;

		$(".modal-body").html('<iframe src="' + tujuan + '" frameborder="no" width="570" height="400"></iframe>');
	}
</script>