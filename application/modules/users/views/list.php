<div class="container mt-10">
	<div class="card">
		<div class="card-header py-3">
			<div class="d-flex justify-content-between align-items-center">
				<h3 for=""><i class="fa fa-users mr-2"></i>Users</h3>
				<a href="<?= site_url('users/setting/create') ?>" class="shadow-sm shadow-primary btn btn-success" title="Add New User"><i class="fa fa-plus"></i>Add New User</a>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="card-body">
			<table id="example1" class="table table-hover table-condensed">
				<thead>
					<tr class="table-secondary">
						<th width="20">No.</th>
						<th><?= lang('users_username') ?></th>
						<th><?= lang('users_nm_lengkap') ?></th>
						<th><?= lang('users_email') ?></th>
						<th><?= lang('users_alamat') ?></th>
						<th><?= lang('users_kota') ?></th>
						<th><?= lang('users_hp') ?></th>
						<th><?= lang('users_st_aktif') ?></th>
						<th width="50"></th>
					</tr>
				</thead>

				<tbody>
					<?php $n = 0;
					foreach ($results as $record) : $n++; ?>
						<tr>
							<td class="text-center"><?= $n; ?></td>
							<td><?= $record->username ?></td>
							<td><?= $record->full_name ?></td>
							<td><?= $record->email ?></td>
							<td><?= $record->address ?></td>
							<td><?= $record->city ?></td>
							<td><?= $record->phone ?></td>
							<td><?= ($record->status == 'ACT') ? "<label class='label label-inline label-primary'>Active</label>" : "<label class='label label-danger label-inline'>Non Active</label>" ?></td>
							<td class="text-center">
								<a class="btn btn-xs btn-icon btn-warning" href="<?= site_url('users/setting/edit/' . $record->id_user); ?>" data-toggle="tooltip" data-placement="left" title="Edit Data"><i class="fa fa-pen"></i></a>
								<!-- <a class="btn btn-xs btn-icon btn-info" href="<?= site_url('users/setting/permission/' . $record->id_user); ?>" data-toggle="tooltip" data-placement="left" title="Edit Hak Akses"><i class="fa fa-shield-alt"></i></a> -->
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<!-- /.box-body -->
	</div>
</div>

<!-- page script -->
<script>
	$(function() {
		$("#example1").DataTable();
	});
</script>