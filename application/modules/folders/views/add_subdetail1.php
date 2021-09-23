<?php
$ENABLE_ADD     = has_permission('Folders.Add');
$ENABLE_MANAGE  = has_permission('Folders.Manage');
$ENABLE_VIEW    = has_permission('Folders.View');
$ENABLE_DELETE  = has_permission('Folders.Delete');
?>
<form action="#" method="POST" id="form_proses_bro">
	<div class='form-group row'>
		<label class='label-control col-sm-2'><b>Deskripsi<span class='text-red'>*</span></b></label>
		<div class='col-sm-4'>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-file-alt"></i>
					</span>
				</div>
				<?php
				echo form_input(array('type' => 'hidden', 'id' => 'id_master', 'name' => 'id_master', 'class' => 'form-control input-sm', 'value' => $id_master, 'placeholder' => 'Id Master'));
				echo form_input(array('type' => 'hidden', 'id' => 'id_detail', 'name' => 'id_detail', 'class' => 'form-control input-sm', 'value' => $id_sub, 'placeholder' => 'Id Detail'));
				echo form_input(array('id' => 'deskripsi', 'name' => 'deskripsi', 'class' => 'form-control input-sm', 'autocomplete' => 'off', 'placeholder' => 'Deskripsi'));
				?>
			</div>
		</div>
		<label class='label-control col-sm-2'><b>Document <span class='text-red'>*</span></b></label>
		<div class='col-sm-4'>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-file"></i>
					</span>
				</div>
				<?php
				echo form_input(array('type' => 'file', 'id' => 'image', 'name' => 'image', 'class' => 'form-control input-sm', 'autocomplete' => 'off', 'placeholder' => 'Image'));
				?>
			</div>

		</div>
	</div>
	<div class='form-group row'>
		<label class='label-control col-sm-2'><b>Prepared By<span class='text-red'>*</span></b></label>
		<div class='col-sm-4'>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-user"></i>
					</span>
				</div>
				<select name="prepared_by" id="prepared_by" class="form-control select2">;
					<option value=""></option>
					<?php foreach ($users as $usr) : ?>
						<option value="<?= $usr->id_user; ?>"><?= $usr->nm_lengkap; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>

	<div class='form-group row'>
		<label class='label-control col-sm-2'><b>Review<span class='text-red'></span></b></label>
		<div class='col-sm-4'>
			<div class="input-group" id="select_review">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-user"></i>
					</span>
				</div>
				<select class="form-control select2" name="id_review" id="id_review">
					<option value=""></option>
					<?php foreach ($jabatan as $jbt) : ?>
						<option value="<?= $jbt->id; ?>"><?= $jbt->nm_jabatan; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<label class='label-control col-sm-2'><b>Approval <span class='text-red'>*</span></b></label>
		<div class='col-sm-4'>
			<div class="input-group" id="select_approval">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-user"></i>
					</span>
				</div>
				<select class="form-control select2" name="id_approval" id="id_approval">
					<option value=""></option>
					<?php foreach ($jabatan as $jbt) : ?>
						<option value="<?= $jbt->id; ?>"><?= $jbt->nm_jabatan; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

		</div>
	</div>

	<div class='form-group row'>
		<label class='label-control col-sm-2'><b>Distribusi<span class='text-red'></span></b></label>
		<div class='col-sm-4'>
			<div class="input-group" id="select_distribusi">
				<div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fas fa-user"></i>
					</span>
				</div>
				<select class="form-control select2" multiple name="id_distribusi[]" id="id_distribusi">
					<option value=""></option>
					<?php foreach ($jabatan as $jbt) : ?>
						<option value="<?= $jbt->id; ?>"><?= $jbt->nm_jabatan; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="offset-2">
			<button type="button" class="btn-primary btn" id="simpan-com"><i class="fa fa-save mr-1"></i>Save</button>
			<!-- <button type="button" class="btn-danger btn" id="back" onclick="history.go(-1)"><i class="fa fa-reply mr-1"></i>Back</button> -->
		</div>
	</div>
</form>
<style>
	.select2-container--default .select2-selection--single {
		border-radius: 0px .42em .42em 0px;
	}
</style>
<script>
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: 'Choose an option',
			width: '90%',
			allowClear: true
		});

		// get_approval();
		// get_review();


		$('#simpan-com').click(function(e) {
			e.preventDefault();
			var deskripsi = $('#deskripsi').val();
			var prepared_by = $('#prepared_by').val();
			var id_approval = $('#id_approval').val();
			var prepared_by = $('#prepared_by').val();
			var id_distribusi = $('#id_distribusi').val();
			var image = $('#image').val();
			var id_master = $('#id_master').val();
			var id_sub = $('#id_sub').val();
			if (deskripsi == '' || deskripsi == null) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty deskripsi, please input deskripsi  first.....',
					icon: "warning"
				});

				return false;
			}
			if (prepared_by == '' || prepared_by == null) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty User Prepared, please input User Prepared  first.....',
					icon: "warning"
				});

				return false;
			}

			if (image == '' || image == null) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty file, please input file first.....',
					icon: "warning"
				});

				return false;
			}

			if (id_approval == '' || id_approval == null) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty approval, please input approval first.....',
					icon: "warning"
				});

				return false;
			}
			if (id_distribusi == '' || id_distribusi == null) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty distribusi, please input distribusi first.....',
					icon: "warning"
				});

				return false;
			}

			Swal.fire({
				title: "Are you sure?",
				text: "You will not be able to process again this data!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonText: "Yes, Process it!",
				cancelButtonText: "No, cancel process!",
			}).then((value) => {
				if (value.isConfirmed) {
					var formData = new FormData($('#form_proses_bro')[0]);
					var baseurl = siteurl + active_controller + '/add_subdetail1';
					$.ajax({
						url: baseurl,
						type: "POST",
						data: formData,
						cache: false,
						dataType: 'json',
						processData: false,
						contentType: false,
						success: function(data) {
							console.log(data);
							// return false
							if (data.status == 1) {
								Swal.fire({
									title: "Save Success!",
									text: data.pesan,
									icon: "success",
									timer: 7000,
									showCancelButton: false,
									showConfirmButton: false,
									allowOutsideClick: false
								});
								location.reload();
							} else {

								if (data.status == 2) {
									Swal.fire({
										title: "Save Failed!",
										text: data.pesan,
										icon: "warning",
										timer: 3000,
									});
								} else {
									Swal.fire({
										title: "Save Failed!",
										text: data.pesan,
										icon: "warning",
										timer: 3000,
									});
								}

							}
						},
						error: function() {

							Swal.fire({
								title: "Error Message !",
								text: 'An Error Occured During Process. Please try again..',
								icon: "warning",
								timer: 3000,
							});
						}
					});
				} else {
					Swal.fire("Cancelled", "Data can be process again :)", "error");
					return false;
				}
			});
		});
	});


	function get_approval() {

		$.ajax({
			type: "GET",
			url: siteurl + 'folders/get_approval',
			data: "",
			success: function(html) {
				$("#select_approval").html(html);
			}
		});
	}

	function get_review() {

		$.ajax({
			type: "GET",
			url: siteurl + 'folders/get_review',
			data: "",
			success: function(html) {
				$("#select_review").html(html);
			}
		});
	}

	function back() {
		var id_detail = $('#id_master').val();
		window.location.href = base_url + active_controller + 'detail?id_master=' + id_detail;
	}
</script>