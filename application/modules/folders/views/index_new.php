<?php
$ENABLE_ADD     = has_permission('Folders.Add');
$ENABLE_MANAGE  = has_permission('Folders.Manage');
$ENABLE_VIEW    = has_permission('Folders.View');
$ENABLE_DELETE  = has_permission('Folders.Delete');
$ENABLE_DOWNLOAD  = has_permission('Folders.Download');
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header">
					<h4 class="card-title text-muted">
						<a href="<?= base_url('folders'); ?>"><i class="fa fa-home"></i></a>
					</h4>
				</div>
				<div class="card-body">
					<button type="button" onclick="history.go(-1)" class="btn btn-icon btn-secondary m-1 " title="Back">
						<i class="fa fa-arrow-left"></i>
					</button>
					<button type="button" onclick="new_folder()" class="btn btn-icon btn-secondary m-1 " title="New Folder">
						<i class="far fa-folder"></i>
					</button>
					<button type="button" onclick="rename_folder()" id="btn-rename" class="btn btn-icon btn-secondary m-1" disabled title="Rename">
						<i class="fa fa-pen"></i>
					</button>
					<button type="button" onclick="delete_folder()" id="btn-delete" class="btn btn-icon btn-secondary m-1" disabled title="Delete">
						<i class="fa fa-trash"></i>
					</button>
					<!-- <button type="button" id="btn-move" class="btn btn-icon btn-secondary m-1" disabled title="Move">
						<i class="fa fa-move"></i>
					</button> -->
					<hr>
					<div class="row">
						<?php if ($row) :
							foreach ($row as $data) :
						?>
								<div class="checkbox col-lg-3 col-xl-2 col-md-3 col-sm-6 col-xs-6 m-0 px-2">
									<label ondblclick="location.href = base_url+active_controller+'subfolder/<?= str_replace(' ', '-', strtolower($data->nama_master)); ?>'" data-id="<?= $data->id_master; ?>" class="h-99px p-0 btn btn-block btn-text-dark-50 btn-icon-primary font-weight-bold btn-hover-bg-secondary my-2 button-master">
										<i class="fa fa-folder" style="font-size:7rem;"></i><br>
										<input class="d-none" type="checkbox" data-id="<?= $data->id_master; ?>" data-name="<?= $data->nama_master;; ?>" name="folder[]" value="folder">
										<?= $data->nama_master; ?>
									</label>
								</div>
							<?php endforeach;
						else : ?>
							<div class="col-md-12">
								<h5 class="text-center">--Empty--</h5>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<!-- 
			 -->

		</div>
	</div>
</div>

<script>
	$('#example1').DataTable({
		orderCellsTop: false,
		fixedHeader: true,
		scrollX: true,
		ordering: false,
		info: false
	});

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