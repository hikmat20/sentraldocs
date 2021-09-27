<div class="row">
	<div class="col-md-6">
		<form id="form-subsubject" method="post">
			<h3>Create Approval</h3>
			<div class="mb-3">
				<label for="input1" class="form-label">Status :</label>
				<input type="hidden" id="id" name="id" value="<?= (isset($id) ? $id : '0') ?>" />
				<input type="hidden" id="table" name="table" value="<?= (isset($table) ? $table : '-') ?>" />
				<select class="form-control select2" name="status" id="status">
					<option value=""></option>
					<option value="revisi">Koreksi</option>
					<option value="approve">Approve</option>
				</select>
			</div>
			<div class="mb-3">
				<label for="input1" class="form-label">Keterangan :</label>
				<textarea name="keterangan" class="form-control" id="keterangan" height=50></textarea>
			</div>
		</form>

		<button class="btn btn-success" type="button" onclick="saveapproval()">
			<i class="fa fa-save"></i><b> Simpan</b>
		</button>
		<div class="my-3">
			<h3>History Koreksi</h3>
			<table id="example1" class="table table-bordered table-sm table-striped">
				<thead>
					<tr>
						<th width="100px">No Rev</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($row) :
						$int	= 0;
						foreach ($row as $datas) : $int++; ?>
							<tr>
								<td><?= $datas->revisi; ?></td>
								<td><?= $datas->keterangan; ?></td>
							</tr>
						<?php endforeach;
					else : ?>
						<tr>
							<td colspan="2" class="text-center">Tidak ada history</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div class="mb-3">
			<h3>History Revisi</h3>
			<table id="example1" class="table table-bordered table-sm  table-striped">
				<thead>
					<tr>
						<th width="100px">No Rev</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($row1) :
						$int	= 0;
						foreach ($row1 as $dc1) : $int++; ?>
							<tr>
								<td><?= $dc1->revisi; ?></td>
								<td><?= $dc1->keterangan_rev; ?></td>
							</tr>
						<?php endforeach;
					else : ?>
						<tr>
							<td colspan="2" class="text-center">Tidak ada history</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
		<div class="mb-3">
			<h3>History Dokumen</h3>
			<table id="example1" class="table table-bordered table-sm table-striped">
				<thead>
					<tr>
						<th width="100px">No Rev</th>
						<th>Nama File</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($row2) :
						$int	= 0;
						foreach ($row2 as $dc2) : $int++; ?>
							<tr>
								<td><?= $dc2->revisi; ?></td>
								<td><?= $dc2->nama_file; ?></td>
								<td>
									<a href="#" onClick="window.open('<?php echo site_url(); ?>assets/files/<?php echo "$datas2->nama_file"; ?>', '_blank')" class="btn btn-sm btn-success" title="View Data"><i class="fa fa-eye"></i></a>
								</td>
							</tr>
						<?php endforeach;
					else : ?>
						<tr>
							<td colspan="3" class="text-center">Tidak ada history</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-6">
		<iframe src='<?php echo site_url(); ?>assets/files/<?php echo "$nama_file"; ?>' width='100%' height='565px' frameborder='0'> </iframe></td>
	</div>
</div>
<script>
	$('.select2').select2({
		placeholder: 'Choose an options',
		width: '100%',
		allowClear: true
	})

	function saveapproval() {
		if ($('#status').val() == "") {
			Swal.fire({
				title: "STATUS TIDAK BOLEH KOSONG!",
				text: "ISI STATUS TERLEBIH DAHULU!",
				icon: "warning",
				timer: 3000,
				showCancelButton: false,
				showConfirmButton: false,
				allowOutsideClick: false
			});
		} else {
			Swal.fire({
				title: "Peringatan !",
				text: "Pastikan data sudah lengkap dan benar",
				icon: "warning",
				showCancelButton: true,
				confirmButtonText: "Ya, simpan!",
				cancelButtonText: "Batal!",
			}).then((value) => {
				if (value.isConfirmed == true) {
					var formdata = $("#form-subsubject").serialize();
					$.ajax({
						url: siteurl + "dokumen/saveApproval",
						dataType: "json",
						type: 'POST',
						data: formdata,
						success: function(data) {
							if (data.status == 1) {
								Swal.fire({
									title: "Save Success!",
									text: data.pesan,
									icon: "success",
									timer: 3000,
									showCancelButton: false,
									showConfirmButton: false,
									allowOutsideClick: false
								}).then(() => {
									location.reload();
								})
								// window.location.href = siteurl + active_controller + '/' + uri2 + '/' + uri3 + '/' + uri4;
							} else {

								if (data.status == 2) {
									Swal.fire({
										title: "Save Failed!",
										text: data.pesan,
										icon: "warning",
										timer: 3000,
										showCancelButton: false,
										showConfirmButton: false,
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
								title: "Gagal!",
								text: "Batal Proses, Data bisa diproses nanti",
								type: "error",
								timer: 3000,
								showConfirmButton: false
							});
						}
					});
				}

			})
		}
	}
</script>