<h3>History Koreksi</h3>
<table class="table table-bordered table-sm table-striped">
	<thead>
		<tr>
			<th width="100px">No Revisi</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$idjabatan = $jabatan;
		if ($row) :
			$int	= 0;
			foreach ($row as $datas) :
				$int++; ?>
				<tr>
					<td><?= $datas->revisi; ?></td>
					<td><?= $datas->keterangan; ?></td>
				</tr>
			<?php endforeach; ?>
		<?php else : ?>
			<tr>
				<td colspan="2" class="text-center">Tidak ada history</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>
<?php
foreach ($data as $dt) {
	$deskripsi = $dt->deskripsi;
	$idmaster  = $dt->id_master;
}
?>

<h3 class="card-title">Koreksi Dokumen</h3>
<form id="form_proses" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6">
			<label class='form-label col-md-2'><b>Deskripsi<span class='text-red'>*</span></b></label>
			<div class="col-lg-8">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-file"></i></span>
					</div>
					<?php
					// echo form_input(array('type' => 'hidden', 'id' => 'id', 'name' => 'id', 'class' => 'form-control input-sm', 'value' => $id, 'placeholder' => 'Id'));
					// echo form_input(array('type' => 'hidden', 'id' => 'id_master', 'name' => 'id_master', 'class' => 'form-control input-sm', 'value' => $idmaster, 'placeholder' => 'Id Master'));
					// echo form_input(array('id' => 'deskripsi', 'name' => 'deskripsi', 'class' => 'form-control input-sm', 'autocomplete' => 'off', 'placeholder' => 'Deskripsi', 'value' => $deskripsi,));
					// echo form_input(array('type' => 'hidden', 'id' => 'table', 'name' => 'table', 'class' => 'form-control input-sm', 'autocomplete' => 'off', 'placeholder' => 'Table', 'value' => $table,));
					?>
					<input type="hidden" name="id" id="id" class="form-control" placeholder="form-control" value="<?= $id; ?>">
					<input type="hidden" name="id_master" id="id_master" class="form-control" placeholder="form-control" value="<?= $idmaster; ?>">
					<input type="hidden" name="table" id="table" class="form-control" placeholder="form-control" value="<?= $table; ?>">
					<input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="form-control" value="<?= $deskripsi; ?>">
				</div>

			</div>
		</div>
		<div class="col-md-6">
			<label class='label-control col-sm-2'><b>Document <span class='text-red'>*</span></b></label>
			<div class="col-lg-8">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="fa fa-file"></i></span>
					</div>
					<input type="file" name="image" id="image" class="form-control">
					<?php
					// echo form_input(array('type' => 'file', 'id' => 'image', 'name' => 'image', 'class' => 'form-control input-sm', 'autocomplete' => 'off', 'placeholder' => 'Image'));
					?>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="my-5">
	<?php
	// echo form_button(array('type' => 'button', 'class' => 'btn btn-md btn-primary', 'value' => 'save', 'content' => 'Save', 'id' => 'simpan-com')) . ' ';
	// echo form_button(array('type' => 'button', 'class' => 'btn btn-md btn-danger', 'value' => 'back', 'content' => 'Back', 'onClick' => 'javascript:back()'));
	?>

	<button type="button" class="btn btn-success" id="simpan-com"><i class="fa fa-save"></i> Save</button>
</div>

<script>
	$(document).on('click', '#simpan-com', function(e) {
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
			if (value.isConfirmed == true) {
				var formData = new FormData($('#form_proses')[0]);
				if (tabel == 'gambar') {
					var baseurl = base_url + active_controller + 'simpan_koreksi';
				} else if (tabel == 'gambar1') {
					var baseurl = base_url + active_controller + 'simpan_koreksi1';
				} else if (tabel == 'gambar2') {
					var baseurl = base_url + active_controller + 'simpan_koreksi2';
				}
				console.log(tabel);
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
							Swal.fire({
								title: "Save Success!",
								text: data.pesan,
								icon: "success",
								timer: 3000,
								allowOutsideClick: false
							}).then(function() {
								location.reload();
							})
							// window.location.href = base_url + active_controller + 'koreksi';
						} else {

							if (data.status == 2) {
								Swal.fire({
									title: "Save Failed!",
									text: data.pesan,
									icon: "warning",
									timer: 3000,
									allowOutsideClick: false
								});
							} else {
								Swal.fire({
									title: "Save Failed!",
									text: data.pesan,
									icon: "warning",
									timer: 3000,
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
							timer: 3000,
							showCancelButton: false,
							showConfirmButton: false,
							allowOutsideClick: false
						});
					}
				});
			} else {
				Swal.fire("Cancelled", "Data can be process again :)", "error");
				return false;
			}

		})
	});
</script>