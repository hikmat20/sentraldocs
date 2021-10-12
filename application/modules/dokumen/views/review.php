<div class="row">
	<div class="col-lg-7">
		<form id="form-subsubject" method="post">
			<h3>Create Review</h3>
			<input type="hidden" id="id" name="id" value="<?= (isset($id) ? $id : '0') ?>" />
			<input type="hidden" id="table" name="table" value="<?= (isset($table) ? $table : '-') ?>" />
			<div class="mb-3">
				<label for="nm_subsubject" class="form-label">Status :</label>
				<div class="mb-3">
					<select class="form-control select2" name="status" id="status" aria-label="Default select example">
						<option value=""></option>
						<option value="revisi">Koreksi</option>
						<option value="approve">Lanjut Approval</option>
					</select>
				</div>
				<!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
			</div>
			<div class="mb-3">
				<label for="" class="form-label">Keterangan</label>
				<textarea name="keterangan" class="form-control" placeholder="Keterangan" id="keterangan" height=80></textarea>
			</div>
			<button class="btn btn-success" type="button" id="save">
				<i class="fa fa-save"></i><b> Simpan</b>
			</button>
		</form>
		<br>
		<h3 class="">History Koreksi</h3>
		<table class="table table-bordered table-condensed table-sm table-striped">
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
					$n	= 0;
					foreach ($row as $dt) :
						$n++; ?>
						<tr>
							<td><?= $dt->nm_lengkap; ?></td>
							<td class="text-center"><?= $dt->revisi; ?></td>
							<td><?= $dt->keterangan; ?></td>
							<td class="text-center"><?= $dt->created_on; ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr>
						<td colspan="4" class="text-center">Tidak ada history</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
		<div class="my-5">
			<h3>History Revisi</h3>
			<table class="table table-bordered table-sm table-striped">
				<thead>
					<tr>
						<th class="text-center" width="50px">No Rev</th>
						<th class="text-center">Keterangan</th>
						<th class="text-center" width="100px">File</th>
						<th class="text-center" width="100px">Waktu Pengajuan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($rev) :
						$n	= 0;
						foreach ($rev as $dt) :
							$n++; ?>
							<tr style="vertical-align: middle;">
								<td><?= $dt->revisi; ?></td>
								<td><?= $dt->keterangan_rev; ?></td>
								<td class="text-center"><a href="<?= base_url('assets/files/') . $dt->nama_file; ?>" target="_blank" title="Lihat File" class="btn btn-hover-icon-danger"><i class="fa fa-2x fa-file-pdf"></i></a></td>
								<td class="text-center"><?= $dt->created; ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="3" class="text-center">Tidak ada history</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>

		<!-- <div class="my-5">
			<h3>History Dokumen</h3>
			<table class="table table-bordered table-sm table-striped">
				<thead>
					<tr>
						<th width="20%">No Rev</th>
						<th>Nama File</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$idjabatan = $jabatan;
					if ($row2) :
						$n	= 0;
						foreach ($row2 as $dt) :
							$n++; ?>
							<tr>
								<td><?= $dt->revisi; ?></td>
								<td><?= $dt->nama_file; ?></td>
								<td>
									<a href="#" onClick="window.open('<?php echo site_url(); ?>assets/files/<?php echo "$datas2->nama_file"; ?>', '_blank')" class="btn btn-sm btn-success" title="View Data"><i class="fa fa-eye"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="3" class="text-center">Tidak ada history</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div> -->
	</div>
	<div class="col-lg-5">
		<iframe src='<?php echo site_url(); ?>assets/files/<?php echo "$nama_file"; ?>' width='100%' height='665px' frameborder='0'> </iframe></td>
	</div>
</div>


<script>
	$('.select2').select2({
		allowClear: true,
		width: '100%',
		placeholder: 'Choose an options'
	})
</script>