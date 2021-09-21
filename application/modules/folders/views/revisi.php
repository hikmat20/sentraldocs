<div class="row">

	<div class="col-md-4">
		<form id="form_proses_bro" method="post">
			<input type="hidden" id="id" name="id" value="<?= (isset($row->id) ? $row->id : '') ?>" />
			<input type="hidden" id="id_master" name="id_master" value="<?= (isset($row->id_master) ? $row->id_master : '') ?>" />
			<input type="hidden" id="table" name="table" value="<?= (isset($table) ? $table : '-') ?>" />
			<input type="hidden" id="uri1" name="uri1" value="<?php echo $uri3 ?>" />
			<input type="hidden" id="uri2" name="uri2" value="<?php echo $uri4 ?>" />
			<input type="hidden" id="uri3" name="uri3" value="<?php echo $uri5 ?>" />
			<input type="hidden" id="uri4" name="uri4" value="<?php echo $uri6 ?>" />
			<div class="">
				<div class="mb-3">
					<label for="deskripsi" class="form-label">Nama Dokumen </font></label>
					<input name="deskripsi" class="form-control bg-light" id="deskripsi" value="<?= $row->deskripsi ?>" ; readonly>
				</div>
				<div class="mb-3">
					<label for="deskripsi" class="form-label">Item Perubahan </font></label>
					<textarea name="keterangan" class="form-control input-sm" id="keterangan" valign="top" height="50"></textarea>
				</div>
				<div class="mb-3">
					<label for="image" class="form-label">Upload Dokumen </font></label>
					<?php
					echo form_input(array('type' => 'file', 'id' => 'image', 'name' => 'image', 'class' => 'form-control input-sm', 'autocomplete' => 'off', 'placeholder' => 'Image'));
					?>
				</div>
				<div class="mb-3">
					<div class="d-grid gap-2">
						<button class="btn btn-primary btn-block" id="simpan-com" type="button"><i class="fa fa-save"></i> Save</button>
					</div>
					<?php
					// echo form_button(array('type' => 'button', 'class' => 'btn btn-md btn-primary', 'value' => 'save', 'content' => 'Save', 'id' => 'simpan-com')) . ' ';
					// echo form_button(array('type' => 'button', 'class' => 'btn btn-md btn-danger', 'value' => 'back', 'content' => 'Back', 'onClick' => 'javascript:back()'));
					?>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-8">
		<iframe src='<?php echo site_url(); ?>assets/files/<?php echo "$nama_file"; ?>' width='100%' height='565px' frameborder='0'> </iframe>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#simpan-com').click(function(e) {
			e.preventDefault();
			var deskripsi = $('#deskripsi').val();
			var tabel = $('#table').val();
			var image = $('#image').val();
			var id_master = $('#id_master').val();
			if (deskripsi == '' || deskripsi == null) {
				Swal.fire({
					title: "Error Message!",
					text: 'Empty deskripsi, please input deskripsi  first.....',
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
					var baseurl = base_url + active_controller + '/simpan_koreksi';
					// if (tabel == 'gambar') {
					// } else if (tabel == 'gambar1') {
					// 	var baseurl = base_url + active_controller + '/simpan_koreksi1';
					// } else if (tabel == 'gambar2') {
					// 	var baseurl = base_url + active_controller + '/simpan_koreksi2';
					// }
					$.ajax({
						url: baseurl,
						type: "POST",
						data: formData,
						dataType: 'json',
						cache: false,
						processData: false,
						contentType: false,
						success: function(data) {
							if (data.status == 1) {
								Swal.fire({
									title: "Save Success!",
									text: data.pesan,
									icon: "success",
									timer: 5000,
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
										icon: "error",
										timer: 5000,
										showCancelButton: false,
										showConfirmButton: false,
										allowOutsideClick: false
									});
								} else {
									Swal.fire({
										title: "Save Failed!",
										text: data.pesan,
										icon: "error",
										timer: 5000,
										showCancelButton: false,
										showConfirmButton: false,
										allowOutsideClick: false
									});
								}

							}
						},
						error: function() {
							Swal.fire({
								title: "Error Message !",
								text: 'An Error Occured During Process. Please try again..',
								icon: "warning",
								timer: 7000,
								showCancelButton: false,
								showConfirmButton: false,
								allowOutsideClick: false
							});
						}
					});
				}
			})
		});
	});
</script>