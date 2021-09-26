<div class="row">
	<div class="col-lg-6">
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

		<div class="mt-8 mb-3">
			<h3>History Koreksi</h3>
			<table class="table table-bordered table-condensed table-sm table-striped">
				<thead>
					<tr>
						<th width="20%">No Rev</th>
						<th>Keterangan</th>
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
								<td><?= $dt->revisi; ?></td>
								<td><?= $dt->keterangan; ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="2" class="text-center">Tidak ada history</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>

		<div class="my-5">
			<h3>History Revisi</h3>
			<table class="table table-bordered table-sm table-striped">
				<thead>
					<tr>
						<th width="20%">No Rev</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$idjabatan = $jabatan;
					if ($row1) :
						$n	= 0;
						foreach ($row1 as $dt) :
							$n++; ?>
							<tr>
								<td><?= $dt->revisi; ?></td>
								<td><?= $dt->keterangan_rev; ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="2" class="text-center">Tidak ada history</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>


		<div class="my-5">
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
		</div>
	</div>
	<div class="col-lg-6">
		<iframe src='<?php echo site_url(); ?>assets/files/<?php echo "$nama_file"; ?>' width='100%' height='565px' frameborder='0'> </iframe></td>
	</div>
</div>


<script>
	$('.select2').select2({
		allowClear: true,
		width: '100%',
		placeholder: 'Choose an options'
	})
</script>