<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header">
					<h2 class="mt-5"><i class="<?= $icon; ?> mr-2"></i><?= $title; ?></h2>
					<div class="mt-4 float-right ">
						<a href="<?= base_url($this->uri->segment(1) . '/add'); ?>" class="btn btn-primary" title="Back">
							<i class="fa fa-plus mr-1"></i>Add New
						</a>
					</div>
				</div>
				<div class="card-body">
					<table id="example1" class="table table-bordered table-sm table-hover datatable">
						<thead class="text-center table-light">
							<tr class="text-center">
								<th width="80">No.</th>
								<th class="text-left">Nama</th>
								<th>Tahun</th>
								<th>Nomor</th>
								<th width="150">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if (isset($data) && $data) :
								$n = 0;
								foreach ($data as $dt) : $n++; ?>
									<tr class="text-center">
										<td><?= $n; ?></td>
										<td class="text-left"><?= $dt->name; ?></td>
										<td><?= $dt->year; ?></td>
										<td><?= $dt->number; ?></td>
										<td>
											<button type="button" class="btn btn-sm btn-icon rounded-circle btn-info view" data-id="<?= $dt->id; ?>" title="View Data"><i class="fa fa-search"></i></button>
											<a href="<?= base_url($this->uri->segment(1) . '/edit/' . $dt->id); ?>" class="btn btn-sm btn-icon rounded-circle btn-warning edit" data-id="<?= $dt->id; ?>" title="View Data"><i class="fa fa-edit"></i></a>
											<button type="button" class="btn btn-sm btn-icon rounded-circle btn-danger delete" data-id="<?= $dt->id; ?>" title="View Data"><i class="fa fa-trash"></i></button>
										</td>
									</tr>
								<?php endforeach;
							else : ?>
								<tr>
									<td colspan="5" class="text-center text-muted">~ Not available data ~</td>
								</tr>
							<?php
							endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#example1').DataTable({
			orderCellsTop: false,
			// fixedHeader: true,
			// scrollX: true,
			ordering: false,
			// info: false
		});
	})

	function new_folder() {
		Swal.fire({
			title: 'Create Folder',
			html: `<input id='folder_name' required class='form-control ' name='new-folder' placeholder='New Folder'>
			<div id="feedback" class="invalid-feedback d-none">Mohon mengisi nama folder terlebih dahulu.</div>
			<style>
			.swal2-content{
				text-align:left;
			}
			</style>`,
			showCancelButton: true,
			confirmButtonText: 'Save',
			showLoaderOnConfirm: true,
			allowOutsideClick: false,
			preConfirm: (create) => {
				let folder_name = $('#folder_name').val()
				if (folder_name == '') {
					$('#folder_name').addClass('is-invalid');
					$('#feedback').removeClass('d-none');
					return false;
				} else {
					console.log(folder_name);
					return $.ajax({
						url: base_url + active_controller + 'add',
						type: 'POST',
						dataType: 'JSON',
						data: {
							folder_name
						},
						success: function(res) {
							console.log(res)
							if (res.status == '1') {
								Swal.fire({
									title: 'Folder baru berhasil dibuat!',
									icon: 'success',
									timer: 1500
								}).then(function() {
									location.reload()
								})
							} else {
								Swal.fire({
									title: 'Gagal!',
									icon: 'warning',
									text: res.pesan,
									timer: 1500
								})
							}
						},
						error: function(res) {
							Swal.fire({
								title: 'Error!',
								icon: 'error',
								text: res.pesan,
								timer: 3000
							})
						}
					})
				}
			}

		})
	}

	function rename_folder() {
		let id = $('#btn-rename').data('id');
		let folder_name = $('#btn-rename').data('name');
		Swal.fire({
			title: 'Rename Folder',
			html: `<input id='folder_name' required class='form-control ' name='rename-folder' placeholder='New Folder' value='` + folder_name + `'>
			<div id="feedback" class="invalid-feedback d-none">Mohon mengisi nama folder terlebih dahulu.</div>
			<style>
			.swal2-content{
				text-align:left;
			}
			</style>`,
			showCancelButton: true,
			confirmButtonText: 'Save',
			showLoaderOnConfirm: true,
			allowOutsideClick: false,
			preConfirm: (create) => {
				let folder_name = $('#folder_name').val()
				if (folder_name == '') {
					$('#folder_name').addClass('is-invalid');
					$('#feedback').removeClass('d-none');
					return false;
				} else {
					console.log(folder_name);
					return $.ajax({
						url: base_url + active_controller + 'rename_folder',
						type: 'POST',
						dataType: 'JSON',
						data: {
							id,
							folder_name
						},
						success: function(res) {
							console.log(res)
							if (res.status == '1') {
								Swal.fire({
									title: res.msg,
									icon: 'success',
									timer: 1500
								}).then(function() {
									location.reload()
								})
							} else {
								Swal.fire({
									title: 'Gagal!',
									icon: 'warning',
									text: res.msg,
									timer: 1500
								})
							}
						},
						error: function(res) {
							Swal.fire({
								title: 'Error!',
								icon: 'error',
								text: res.msg,
								timer: 3000
							})
						}
					})
				}
			}

		})
	}

	$("input:checkbox").on('click', function() {
		// in the handler, 'this' refers to the box clicked on
		var $box = $(this);
		var group = "input:checkbox[name='" + $box.attr("name") + "']";
		$(group).parents('label').removeClass('btn-bg-secondary');
		if ($box.is(":checked")) {
			$(group).prop("checked", false);
			$box.prop("checked", true);
			$box.parents('label').addClass('btn-bg-secondary');
			$('#btn-rename').attr('data-id', $(this).data('id'))
			$('#btn-rename').attr('data-name', $(this).data('name'))
			$('#btn-rename').prop('disabled', false)
			$('#btn-delete').attr('data-id', $(this).data('id'))
			$('#btn-delete').prop('disabled', false)
		} else {
			$box.prop("checked", false);
			$('#btn-rename').attr('data-id', '')
			$('#btn-rename').attr('data-name', '')
			$('#btn-rename').prop('disabled', true)
			$('#btn-delete').attr('data-id', '')
			$('#btn-delete').prop('disabled', true)
		}
	});

	function delete_folder() {
		let id = $('#btn-delete').data('id');
		// alert(id)
		console.log(id);
		Swal.fire({
			title: "Are you sure?",
			text: "You will not be able to process again this data!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, Delete!",
			cancelButtonText: "No",
		}).then((value) => {
			if (value.isConfirmed) {
				loading_spinner();
				$.ajax({
					url: base_url + active_controller + 'delete_folder',
					type: 'POST',
					dataType: 'JSON',
					data: {
						id
					},
					success: function(result) {
						if (result.status == 1) {
							Swal.fire({
								title: "Success!",
								text: result.msg,
								icon: "success",
								timer: 1500
							}).then(() => {
								location.reload();
							})
						} else {
							Swal.fire({
								title: "Gagal!",
								text: result.msg,
								icon: "warning",
								timer: 3000
							})
						}
					},
					error: function(result) {
						Swal.fire({
							title: "Error",
							text: "Server Timeout!",
							icon: "error",
							timer: 3000
						})
					}
				})
			}

		})

	}

	$(document).on('blur', 'input:checkbox', function() {
		var group = "input:checkbox";
		$(group).parents('label').removeClass('btn-bg-secondary');
		$(group).prop("checked", false);
		$('#btn-rename').attr('data-id', '')
		$('#btn-rename').attr('data-name', '')
		$('#btn-rename').prop('disabled', true)
		$('#btn-delete').attr('data-id', '')
		$('#btn-delete').prop('disabled', true)
	});
</script>