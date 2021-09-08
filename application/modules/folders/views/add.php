<form action="#" method="POST" id="form_proses_bro">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?= $title; ?></h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class='form-group row'>
				<label class='label-control col-sm-2'><b>Nama Folder<span class='text-red'>*</span></b></label>
				<div class='col-sm-4'>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-calculator"></i></span>
						<?php
						echo form_input(array('id' => 'nama_master', 'name' => 'nama_master', 'class' => 'form-control input-sm', 'autocomplete' => 'off', 'placeholder' => 'Nama Folder'));
						?>
					</div>

				</div>
			</div>
		</div>
		<div class='box-footer'>
			<button type="button" class="btn btn-primary" id="simpan-com"><i class="fa fa-save"></i> Simpan</button>
			<button type="button" class="btn btn-danger" id="back" onclick="history.go(-1)"><i class="fa fa-reply"></i> Kembali</button>

		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</form>

<script>
	$(document).ready(function() {
		$('#simpan-com').click(function(e) {
			e.preventDefault();
			var nama_master = $('#nama_master').val();
			if (nama_master == '' || nama_master == null) {
				swal({
					title: "Error Message!",
					text: 'Empty Nama Folder, please input Nama Folder  first.....',
					type: "warning"
				});
				return false;
			}

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
						var formData = new FormData($('#form_proses_bro')[0]);
						var baseurl = base_url + active_controller + '/add';
						$.ajax({
							url: baseurl,
							type: "POST",
							data: formData,
							cache: false,
							dataType: 'json',
							processData: false,
							contentType: false,
							success: function(data) {
								if (data.status == 1) {
									swal({
										title: "Save Success!",
										text: data.pesan,
										type: "success",
										timer: 7000,
										showCancelButton: false,
										showConfirmButton: false,
										allowOutsideClick: false
									});
									window.location.href = base_url + active_controller;
								} else {

									if (data.status == 2) {
										swal({
											title: "Save Failed!",
											text: data.pesan,
											type: "warning",
											timer: 7000,
											showCancelButton: false,
											showConfirmButton: false,
											allowOutsideClick: false
										});
									} else {
										swal({
											title: "Save Failed!",
											text: data.pesan,
											type: "warning",
											timer: 7000,
											showCancelButton: false,
											showConfirmButton: false,
											allowOutsideClick: false
										});
									}

								}
							},
							error: function() {

								swal({
									title: "Error Message !",
									text: 'An Error Occured During Process. Please try again..',
									type: "warning",
									timer: 7000,
									showCancelButton: false,
									showConfirmButton: false,
									allowOutsideClick: false
								});
							}
						});
					} else {
						swal("Cancelled", "Data can be process again :)", "error");
						return false;
					}
				});
		});
	});
</script>