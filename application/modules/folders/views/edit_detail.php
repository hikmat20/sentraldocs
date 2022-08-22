<?php
$ENABLE_ADD     = has_permission('Folders.Add');
$ENABLE_MANAGE  = has_permission('Folders.Manage');
$ENABLE_VIEW    = has_permission('Folders.View');
$ENABLE_DELETE  = has_permission('Folders.Delete');

?>
<form action="#" method="POST" id="form_proses_bro">
	<div class="row">
		<div class="col-md-6">
			<div class='form-group row'>
				<label class='label-control col-sm-3'><b>Deskripsi<span class='text-red'>*</span></b></label>
				<div class="col-md-8">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fa fa-file-alt"></i>
							</span>
						</div>
						<?php
						echo form_input(array('type' => 'hidden', 'id' => 'id', 'name' => 'id', 'class' => 'form-control input-sm', 'value' => $row->id, 'placeholder' => 'Id File'));
						echo form_input(array('id' => 'deskripsi', 'name' => 'deskripsi', 'class' => 'form-control input-sm', 'autocomplete' => 'off', 'placeholder' => 'Deskripsi', 'value' => $row->deskripsi));
						?>
						<input type="hidden" name="table" value="<?= $table; ?>">
					</div>
				</div>
			</div>

			<div class='form-group row'>
				<label class='label-control col-sm-3'><b>Prepared By<span class='text-red'>*</span></b></label>
				<div class='col-sm-8'>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fa fa-user"></i>
							</span>
						</div>
						<select name="prepared_by" id="prepared_by" class="form-control select2">;
							<option value=""></option>
							<?php foreach ($users as $usr) : ?>
								<option value="<?= $usr->id_user; ?>" <?= ($usr->id_user == $row->prepared_by) ? 'selected' : ''; ?>><?= $usr->nm_lengkap; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<div class='form-group row'>
				<label class='label-control col-sm-3'><b>Review<span class='text-red'></span></b></label>
				<div class='col-sm-8'>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fa fa-user"></i>
							</span>
						</div>
						<select name="id_review" id="id_review" class="form-control select2">;
							<option value=""></option>
							<?php foreach ($jabatan as $jbt) : ?>
								<option value="<?= $jbt->id; ?>" <?= ($jbt->id == $row->id_review) ? 'selected' : ''; ?>><?= $jbt->nm_jabatan; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<div class='form-group row'>
				<label class='label-control col-sm-3'><b>Approval <span class='text-red'>*</span></b></label>
				<div class="col-md-8">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fa fa-user"></i>
							</span>
						</div>
						<select name="id_approval" id="id_approval" class="form-control select2">;
							<option value=""></option>
							<?php foreach ($jabatan as $jbt) : ?>
								<option value="<?= $jbt->id; ?>" <?= ($jbt->id == $row->id_approval) ? 'selected' : ''; ?>><?= $jbt->nm_jabatan; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<div class='form-group row'>
				<label class='label-control col-sm-3'><b>Distribusi<span class='text-red'></span></b></label>
				<div class='col-sm-8'>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fa fa-user"></i>
							</span>
						</div>
						<?php
						$explode = explode(',', $row->id_distribusi);
						$inarray = in_array('0', $explode);
						?>
						<select name="id_distribusi[]" multiple id="id_distribusi" class="form-control select2">;
							<option value=""></option>
							<?php foreach ($jabatan as $jbt) : ?>
								<option value="<?= $jbt->id; ?>" <?= (in_array($jbt->id, $explode)) ? 'selected' : ''; ?>><?= $jbt->nm_jabatan; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group row">
				<label class='label-control col-sm-3'><b>Document <span class='text-red'>*</span></b></label>
				<div class='col-sm-8'>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">
								<i class="fa fa-file"></i>
							</span>
						</div>
						<?php
						echo form_input(array('type' => 'file', 'id' => 'nama_file', 'name' => 'nama_file', 'class' => 'form-control input-sm', 'autocomplete' => 'off', 'placeholder' => 'Image'));
						?>
						<input type="hidden" name="old_file" value="<?= $row->nama_file; ?>">
					</div>
				</div>

			</div>
			<div class="form-group">
				<?php if ($row->lokasi_file) : ?>
					<iframe id="doc" width="100%" height="300px" src="<?= base_url(); ?><?= $row->lokasi_file; ?>" frameborder="0"></iframe>
				<?php else : ?>
					<div class="text-center">
						<h5 class="text-muted">no file to load</h5>
					</div>
				<?php endif; ?>
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

<script>
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: 'Choose an option',
			width: '90%',
			allowClear: true
		});

		$(document).on('change', '#nama_file', function(e) {
			let file = $(this).val();
			console.log(e);
			if (file) {
				$('#doc').attr('src', file);
			} else {
				$('#doc').attr('src', '');
			}
		});

		$('#simpan-com').click(function(e) {
			e.preventDefault();
			var deskripsi = $('#deskripsi').val();
			var prepared_by = $('#prepared_by').val();
			var id_approval = $('#id_approval').val();
			var id_distribusi = $('#id_distribusi').val();
			var nama_file = $('#nama_file').val();
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

			// if (nama_file == '' || nama_file == null) {
			// 	Swal.fire({
			// 		title: "Error Message!",
			// 		text: 'Empty file, please input file first.....',
			// 		icon: "warning"
			// 	});

			// 	return false;
			// }

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
					var baseurl = siteurl + active_controller + 'edit';
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
									timer: 3000,
									showCancelButton: false,
									showConfirmButton: false,
									allowOutsideClick: false
								});
								location.reload();
							} else {
								Swal.fire({
									title: "Save Failed!",
									text: data.pesan,
									icon: "warning",
									timer: 3000,
								});

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
</script>