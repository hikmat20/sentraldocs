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
						<th width="150px">User</th>
						<th width="10%" class="text-center">Koreksi Ke</th>
						<th>Keterangan</th>
						<th width="150px" class="text-center">Terakhir di Update</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($row) :
						$int	= 0;
						foreach ($row as $dt) : $int++; ?>
							<tr>
								<td><?= $dt->nm_lengkap; ?></td>
								<td class="text-center"><?= $dt->revisi; ?></td>
								<td><?= $dt->keterangan; ?></td>
								<td class="text-center"><?= $dt->created_on; ?></td>
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
						<th>File</th>
						<th class="text-center" width="100px">Waktu Pengajuan</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($rev) :
						$int	= 0;
						foreach ($rev as $rv) : $int++; ?>
							<tr>
								<td><?= $rv->revisi; ?></td>
								<td><?= $rv->keterangan_rev; ?></td>
								<td class="text-center"><a href="<?= base_url('assets/files/') . $rv->nama_file; ?>" target="_blank" title="Lihat File" class="btn btn-hover-icon-danger"><i class="fa fa-2x fa-file-pdf"></i></a></td>
								<td><?= $rv->created; ?></td>
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
		<!-- <div class="mb-3">
			<h3>History Dokumen</h3>
			<table id="example1" class="table table-bordered table-sm table-striped">
				<thead>
					<tr>
						<th width="150px">User</th>
						<th width="10%" class="text-center">Koreksi Ke</th>
						<th>Keterangan</th>
						<th width="150px" class="text-center">Terakhir di Update</th>
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
									<a href="#" onClick="window.open('<?php echo site_url(); ?>assets/files/<?php echo "$dc2->nama_file"; ?>', '_blank')" class="btn btn-sm btn-success" title="View Data"><i class="fa fa-eye"></i></a>
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
		</div> -->
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
</script>