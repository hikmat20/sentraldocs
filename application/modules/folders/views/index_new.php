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
				<div class="card-body">
					<button type="button" onclick="history.go(-1)" class="btn btn-icon text-dark-95 bg-white m-1 bg-hover-secondary " title="Back">
						<i class="fa fa-arrow-left"></i>
					</button>
					<button type="button" onclick="new_folder()" class="btn btn-icon text-dark-95 bg-white m-1 bg-hover-secondary " title="New Folder">
						<i class="fa fa-plus"></i>
					</button>
					<hr>
					<div class="row">
						<?php if ($row) :
							foreach ($row as $data) :
						?>
								<div class="col-lg-3 col-xl-2 col-md-3 col-sm-6 col-xs-6 m-0 px-2">
									<button type="button" ondblclick="location.href = base_url+active_controller+'subfolder/<?= str_replace(' ', '-', strtolower($data->nama_master)); ?>'" data-id="<?= $data->id_master; ?>" class="h-99px p-0 btn btn-block btn-text-dark-50 btn-icon-primary btn-bg-transparent font-weight-bold btn-hover-bg-secondary my-2 button-master">
										<i class="fa fa-folder" style="font-size:7rem;"></i><br>
										<?= $data->nama_master; ?>
									</button>
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
				<button type="button" onclick="new_folder()" class="btn btn-icon text-dark-95 bg-white m-1 bg-hover-secondary " title="New Folder">
				<i class="fa fa-plus"></i>
			</button>
			<button type="button" id="btn-rename" class="btn btn-icon text-dark-95 bg-white m-1 bg-hover-secondary" title="Rename">
				<i class="fa fa-pen"></i>
			</button>
			<button type="button" id="btn-delete" class="btn btn-icon text-dark-95 bg-white m-1 bg-hover-secondary" title="Delete">
				<i class="fa fa-trash"></i>
			</button> -->

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

	$(document).ready(function() {
		$('#btn-add').click(function() {
			loading_spinner();
		});

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
									icon: 'success',
									title: 'Folder baru berhasil dibuat!',
								}).then(function() {
									location.reload()
								})
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Terjadi Kesalahan!',
									text: res.pesan
								})
							}
						},
						error: function(res) {
							Swal.fire({
								icon: 'error',
								title: 'Terjadi kesalahan!',
								text: res.pesan
							})
						}
					})
				}
			},
			allowOutsideClick: false,
		})
	}

	$(document).on('focus', '.button-master', function() {
		$('.button-master').removeClass('active');
		$(this).toggleClass('active');
		$('#btn-rename').attr('data-id', $(this).data('id'))
		$('#btn-delete').attr('data-id', $(this).data('id'))
	})

	$(document).on('blur', 'body', function() {

		$('.button-master').removeClass('active');
		$('#btn-rename').attr('data-id', '')
		$('#btn-delete').attr('data-id', '')
	})


	function delData(id) {
		swal({
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
					swal("Cancelled", "Data can be process again :)", "error");
					return false;
				}
			});

	}
</script>