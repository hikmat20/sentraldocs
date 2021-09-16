<div class="row">
	<div class="col-md-3">
		<h5>History Revisi</h5>
		<table class="table table-condensed table-bordered table-striped">
			<thead>
				<tr>
					<th width="30%">No Rev</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$idjabatan = $jabatan;

				if ($row) :
					$int	= 0;
					foreach ($row as $datas) :
						$int++;
						$tgl = date_create($datas->created);
				?>
						<tr>
							<td><?= $datas->revisi; ?></td>
							<td><?= $datas->keterangan_rev; ?></td>
						</tr>
					<?php endforeach;
				else : ?>
					<tr>
						<td colspan="2" class="text-center">Tidak ada history</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>

		<h5>History Dokumen</h5>
		<table class="table table-condensed table-bordered table-striped">
			<thead>
				<tr>
					<th width="30%">No Rev</th>
					<th>Nama File</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$idjabatan = $jabatan;
				if ($row1) :
					$int	= 0;
					foreach ($row1 as $datas1) :
						$int++;
						$tgl = date_create($datas1->created); ?>
						<tr>
							<td><?= $datas1->revisi_dokumen; ?></td>
							<td><?= $datas1->nama_file; ?></td>
							<td>
								<a href="#" onClick="window.open('<?php echo site_url(); ?>assets/files/<?php echo "$datas1->nama_file"; ?>', '_blank')" class="btn btn-sm btn-success" title="View Data"><i class="fa fa-eye"></i><a />
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

		<h5>Download</h5>
		<table class="table table-condensed table-bordered table-striped">
			<thead>
				<tr>
					<th width="30%">No</th>
					<th>Jabatan</th>
					<th>User</th>
					<th>Downloaded</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$idjabatan = $jabatan;
				if ($arr_jbt) :
					$int	= 0;
					foreach ($arr_jbt as $jbt) :
						$int++; ?>
						<tr>
							<td><?= $int; ?></td>
							<td><?= $jbt['nm_jabatan']; ?></td>
							<td></td>
							<td></td>
						</tr>
				<?php endforeach;
				endif; ?>
			</tbody>
		</table>
		<a href="<?= base_url("dokumen/download/$id"); ?>" type="button" id="download" class="btn btn-block btn-primary btn-outline-primary" data-id="<?= $id; ?>"><i class="fa fa-download"></i> Download</a>
	</div>
	<div class="col-md-9 p-2" style="border:1px solid #eaeaea ;">
		<iframe src='<?php echo site_url(); ?>assets/files/<?php echo "$nama_file"; ?>' width='100%' height='565px' frameborder='0'> </iframe>
	</div>
</div>

<div class="nav-tabs-salesorder">

	<script>
		function saveapproval() {
			var uri1 = $('#uri1').val();
			var uri2 = $('#uri2').val();
			var uri3 = $('#uri3').val();
			var uri4 = $('#uri4').val();


			if ($('#status').val() == "") {
				swal({
					title: "STATUS TIDAK BOLEH KOSONG!",
					text: "ISI STATUS TERLEBIH DAHULU!",
					type: "warning",
					timer: 500,
					showCancelButton: false,
					showConfirmButton: false,
					allowOutsideClick: false
				});
			} else {
				swal({
						title: "Peringatan !",
						text: "Pastikan data sudah lengkap dan benar",
						type: "warning",
						showCancelButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "Ya, simpan!",
						cancelButtonText: "Batal!",
						closeOnConfirm: false,
						closeOnCancel: true
					},
					function(isConfirm) {
						if (isConfirm) {
							var formdata = $("#form-subsubject").serialize();
							$.ajax({
								url: siteurl + "dokumen/saveApproval",
								dataType: "json",
								type: 'POST',
								data: formdata,
								success: function(data) {
									if (data.status == 1) {
										swal({
											title: "Save Success!",
											text: data.pesan,
											type: "success",
											timer: 15000,
											showCancelButton: false,
											showConfirmButton: false,
											allowOutsideClick: false
										});
										window.location.href = siteurl + active_controller + '/' + uri2 + '/' + uri3 + '/' + uri4;
									} else {

										if (data.status == 2) {
											swal({
												title: "Save Failed!",
												text: data.pesan,
												type: "warning",
												timer: 10000,
												showCancelButton: false,
												showConfirmButton: false,
												allowOutsideClick: false
											});
										} else {
											swal({
												title: "Save Failed!",
												text: data.pesan,
												type: "warning",
												timer: 10000,
												showCancelButton: false,
												showConfirmButton: false,
												allowOutsideClick: false
											});
										}

									}
								},
								error: function() {
									swal({
										title: "Gagal!",
										text: "Batal Proses, Data bisa diproses nanti",
										type: "error",
										timer: 1500,
										showConfirmButton: false
									});
								}
							});
						}
					});
			}
		}

		$(document).on('click', '#download', function() {
			let id = $(this).data('id');
			if (id) {
				$.ajax({
					url: siteurl + 'dokumen/download/' + id,
					type: 'GET',
					dataType: 'JSON',
					contentType:false,
					processData:false,
					data: {
						id
					},
					success: function(result) {
						if (result.status == 1) {
							console.log(result);
							Swal.fire({
								title: 'Success!',
								text: result.msg,
								icon: 'success',
								timer: 1500,
								showConfirmButton: false
							})
						} else {
							Swal.fire({
								title: 'Failed!',
								text: result.msg,
								icon: 'warning',
								timer: 1500,
								showConfirmButton: false
							})
						}
					},
					error: function(result) {
						Swal.fire({
							title: 'Error!',
							text: 'Internal server error',
							icon: 'error',
							timer: 1500,
							showConfirmButton: false
						})
					}
				})

			}
		})
	</script>