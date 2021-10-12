<h3>History Koreksi</h3>
<table class="table table-bordered table-sm table-striped">
	<thead>
		<tr>
			<th width="150px">User</th>
			<th width="10%" class="text-center">Koreksi Ke</th>
			<th>Keterangan</th>
			<th width="150px" class="text-center">Terakhir di Update</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$idjabatan = $jabatan;
		if ($row) :
			foreach ($row as $dt) : ?>
				<tr>
					<td><?= $dt->nm_lengkap; ?></td>
					<td class="text-center"><?= $dt->revisi; ?></td>
					<td><?= $dt->keterangan; ?></td>
					<td class="text-center"><?= $dt->created_on; ?></td>
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
		<div class="col-md-6 mt-5">
			<label class="form-lable col-md-2">Keterangan</label>
			<div class="col-lg-8">
				<textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Keterangan"></textarea>
			</div>
		</div>
	</div>
	<div class="my-5">
		<button type="button" class="btn btn-success" id="simpan-com"><i class="fa fa-save"></i> Save</button>
	</div>
</form>
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

		if (image == '' || image == null) {
			Swal.fire({
				title: "Error Message!",
				text: 'Empty FILE, please input FILE first.....',
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
				console.log(tabel);
				if (tabel == 'gambar') {
					var baseurl = base_url + active_controller + 'simpan_koreksi';
				} else if (tabel == 'gambar1') {
					var baseurl = base_url + active_controller + 'simpan_koreksi1';
				} else if (tabel == 'gambar2') {
					var baseurl = base_url + active_controller + 'simpan_koreksi2';
				}
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