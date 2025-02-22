<style>
	.cursor-pointer:hover div.dir-tools .btn-dropdown {
		display: block !important;
	}
</style>

<div class="content d-flex flex-column flex-column-fluid">
	<div class="d-flex flex-column-fluid justify-content-between align-items-top">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header justify-content-between d-flex align-items-center">
					<h3 class="m-0"><i class="fa fa-home"></i> List Folder</h3>
					<button type="button" class="btn btn-primary" id="add-folder"><i class="fa fa-plus"></i> New Folder</button>
				</div>
				<div class="card-body">
					<div class="input-group  w-25">
						<div class="input-group-text input-group-prepend rounded-right-0"><i class="fa fa-search"></i></div>
						<input data type="text" name="search" id="search" class="form-control d-inline-block" placeholder="Search">
					</div>
					<table class="table table-sm table-bordered datatable">
						<thead class="table-light">
							<tr>
								<th class="py-2">Directory Name</th>
								<th class="py-2 text-center" width="20%">Last Created</th>
								<th class="py-2 text-center" width="50">Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php $n = 0;
							if ($parents) foreach ($parents as $dt) : $n++; ?>
								<tr>
									<td class="py-2">
										<a href="<?= base_url($this->uri->segment(1) . "/?p=" . $dt->id); ?>" class="<?= ($dt->status == '0') ? 'text-muted' : ''; ?>">
											<h4 class="mb-0 d-flex align-items-end">
												<i class="fa fa-folder mr-2 text-success" style="font-size: 28px;"></i><?= $dt->name; ?>
											</h4>
										</a>
									</td>
									<td class="py-2 text-center"><?= $dt->created_at; ?></td>
									<td class="py-2 text-center">
										<button type="button" class="btn btn-warning btn-xs btn-icon edit" data-id="<?= $dt->id; ?>"><i class="fa fa-edit"></i></button>
										<button type="button" class="btn btn-danger btn-xs btn-icon delete" data-id="<?= $dt->id; ?>"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalId" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<div class="btn-save"></div>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
			</div>
		</div>
	</div>
</div>

<style>
	div#DataTables_Table_0_filter {
		display: none;
	}
</style>

<script>
	$(document).ready(function() {
		oTable = $('.datatable').DataTable({
			dom: 'Pfrtip',
			searchPanes: {
				cascadePanes: true
			},
			language: {
				searchPanes: {
					i18n: {
						emptyMessage: "<i></b>No results returned</b></i>"
					}
				},
				infoEmpty: "No results returned",
				zeroRecords: "No results returned",
				emptyTable: "No results returned",
			},
			lengthChange: true,
			// paging: true,
			info: false,
			pageLength: 20,
		})

		$(document).on('input paste', '#search', function() {
			oTable.search($(this).val()).draw();
		})
	})

	/* DIRECTORY */

	$(document).on('click', '#add', function() {

		$('#modalId .modal-title').text('New Checksheet')
		$('#modalId').modal('show')
		$('#modalId .modal-body').load(siteurl + active_controller + 'load_sheet')
		// $('.btn-save').html(`<button type="button" class="btn btn-primary save"><i class="fa fa-save"></i>Save</button>`)
	})

	$(document).on('click', '#add-folder', function() {
		$('#modalId .modal-title').text('New Folder')
		$('#modalId').modal('show')
		$('#modalId .modal-body').html(`
		<label for="">Directory Name</label>
		<input type="text" id="folder-name" autocomplete="off" class="form-control" placeholder="New Folder">
		<span class="invalid-feedback">Directory Name not be empty</span>
		`)
		$('.btn-save').html(`
		<button type="button" class="btn btn-primary" id="save-folder"><i class="fas fa-save"></i>Save</button>
		`)
	})

	$(document).on('click', '#save-folder', function() {
		const name = $('#folder-name').val();
		const id = $('#id').val();

		if (!name) {
			$('#folder-name').addClass('is-invalid')
			return false;
		}

		$('#folder-name').removeClass('is-invalid')

		Swal.fire({
			title: 'Confirm!',
			text: 'Are you sure you want to save this new folder?',
			icon: 'question',
			showCancelButton: true,
		}).then((value) => {
			if (value.isConfirmed) {
				$.ajax({
					url: siteurl + active_controller + 'save_folder',
					dataType: 'JSON',
					type: 'POST',
					data: {
						name,
						id
					},
					success: function(result) {
						if (result.status == 1) {
							Swal.fire({
								title: "Success!",
								text: result.msg,
								icon: "success",
								timer: 3000
							}).then(function() {
								location.reload()
							})
						} else {
							Swal.fire({
								title: "Warning!",
								text: result.msg,
								icon: "warning",
								timer: 3000
							})
						}
					},
					error: function(result) {
						Swal.fire({
							title: "Error!",
							text: "Server time out.",
							icon: "error",
							timer: 3000
						})
					}
				})
			}
		})
	})

	$(document).on('click', '.edit', function() {
		const id = $(this).data('id')
		$.getJSON(siteurl + active_controller + 'edit_folder/' + id, function(data) {
			var items = [];
			$('#modalId .modal-title').text('Edit Folder')
			$('#modalId').modal('show')
			$('#modalId .modal-body').html(`
			<label for="">Folder Name</label>
			<input type="text" id="id" class="form-control d-none" value="` + data.data.id + `">
			<input type="text" id="folder-name" class="form-control" placeholder="New Folder" value="` + data.data.name + `">
			<span class="invalid-feedback">Folder Name not be empty</span>
			`)

			$('.btn-save').html(`
			<button type="button" class="btn btn-primary" id="save-folder"><i class="fa fa-save"></i> Save</button>
			`)
		});
	})

	$(document).on('click', '.delete', function() {
		const id = $(this).data('id')
		Swal.fire({
			title: 'Confirm',
			text: 'Are sure you want to delete this folder?',
			icon: 'question',
			showCancelButton: true,
		}).then((value) => {
			if (value.isConfirmed) {
				$.ajax({
					url: siteurl + active_controller + 'delete_folder',
					dataType: 'JSON',
					type: 'POST',
					data: {
						id
					},
					success: function(result) {
						if (result.status == 1) {
							Swal.fire({
								title: "Success!",
								text: result.msg,
								icon: "success",
								timer: 3000
							}).then(function() {
								location.reload()
							})
						} else {
							Swal.fire({
								title: "Warning!",
								text: result.msg,
								icon: "warning",
								timer: 3000
							})
						}
					},
					error: function(result) {
						Swal.fire({
							title: "Error!",
							text: "Server time out.",
							icon: "error",
							timer: 3000
						})

					}
				})
			}
		})
	})

	$(document).on('click', '.view', function() {
		const id = $(this).data('id')
		if (id) {
			$('#modalView .modal-title').text('View Checksheet')
			$('#modalView').modal('show')
			$('#modalView .modal-body').load(siteurl + active_controller + 'view_sheet/' + id)
		}
	})
</script>