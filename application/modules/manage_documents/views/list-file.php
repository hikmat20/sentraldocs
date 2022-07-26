<div class="card-header px-0 py-1 min-h-10px">
	<!-- <button type="button" class="btn btn- btn-icon prev" data-id="<?= $prev; ?>"><i class="fa fa-arrow-left mr-2 <?= ($prev != '0') ? 'text-dark-75' : ''; ?>"></i></button>
	<button type="button" class="btn btn-light-warning btn-md" onclick="new_folder('<?= $parent_id; ?>')"><i class="fa fa-folder-plus mr-2"></i>Add Folder</button>
	<button type="button" class="btn btn-light-success btn-md" onclick="upload_file('<?= $parent_id; ?>')"><i class="fa fa-file mr-2"></i>Upload File</button> -->
	<div class="px-1">
		<ul class="nav nav-light-success nav-pills" id="myTab" role="tablist">
			<li class="nav-item prev" data-id="<?= $prev; ?>">
				<a class="nav-link prev pr-3" data-id="<?= $prev; ?>" href="javascript:void(0)">
					<span class="nav-icon">
						<i class="fa fa-arrow-left mr-2"></i>
					</span>
					<span class="nav-text">Back</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-2" href="javascript:void(0)" onclick="new_folder('<?= $parent_id; ?>')">
					<span class="nav-icon">
						<i class="fa fa-plus"></i>
					</span>
					<span class="nav-text">
						Add Folder
					</span>
				</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link px-2" href="javascript:void(0)" onclick="upload_file('<?= $parent_id; ?>')">
					<span class="nav-icon">
						<i class="fa fa-file mr-2"></i>
					</span>
					<span class="nav-text">
						Upload File
					</span>
				</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link px-2" href="javascript:void(0)" onclick="refresh('<?= $parent_id; ?>')">
					<span class="nav-icon">
						<i class="fa fa-redo mr-2"></i>
					</span>
					<span class="nav-text">
						Refresh
					</span>
				</a>
			</li>
		</ul>
	</div>
</div>
<div class="card-body px-1 overflow-auto py-2">
	<table class="table table-hover table-borderless">
		<tbody>
			<?php $n = 0;
			if ($list_file) :
				foreach ($list_file as $list) : $n++; ?>
					<tr class="cursor-pointer h6 py-0 <?= ($list->flag_type == 'FOLDER') ? 'folder' : 'file'; ?>" data-id="<?= $list->id; ?>">
						<td style="vertical-align: middle;" class="text-dark-75 py-2">
							<div class="dropdown dropdown-inline">
								<button type="button" class="btn btn-light-default btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="ki ki-bold-more-ver"></i>
								</button>
								<div class="dropdown-menu">
									<?php if ($list->flag_type == 'FILE') : ?>
										<a class="dropdown-item <?= ($list->status != 'OPN') ? 'disabled' : ''; ?>" onclick="edit_file('<?= $list->id; ?>','<?= $list->parent_id; ?>')" data-id="<?= $list->id; ?>" href="#"><i class="fa fa-file text-warning mr-2"></i>Edit File</a>
										<a class="dropdown-item <?= ($list->status != 'OPN' || $list->flag_record == 'Y') ? 'disabled' : ''; ?>" onclick=" review_process('<?= $list->id; ?>','<?= $list->parent_id; ?>')" href="#"><i class="fab fa-telegram text-success mr-2"></i>Process to Review</a>
										<div class="dropdown-divider"></div>
									<?php endif; ?>
									<a class="dropdown-item" onclick="rename('<?= $list->id; ?>')" href="#"><i class="fa fa-edit text-info mr-2"></i>Rename</a>
									<a class="dropdown-item" href="#"><i class="fa fa-arrows-alt text-primary mr-2"></i>Move</a>
									<a class="dropdown-item <?= ($list->status != 'OPN') ? 'disabled' : ''; ?>" onclick="delete_folder('<?= $list->id; ?>','<?= $list->parent_id; ?>')" href="#"><i class="fa fa-trash text-danger mr-2"></i>Delete</a>
								</div>
							</div>
							<?= ($list->flag_type == 'FOLDER') ? "<i class='fa fa-folder text-warning mr-2 fa-2x py-0' style='vertical-align:middle;'></i>" : "<i class='text-success fa-2x fa fa-file mr-2 py-0' style='vertical-align:middle;'></i>"; ?> <span class="my-auto"><?= $list->name; ?></span>
						</td>
						<td style="vertical-align: middle;"><?= $list->created_at; ?></td>
						<td style="vertical-align: middle;" class="mt-1"><?= $list->created_by; ?></td>
						<td style="vertical-align: middle;" class="mt-1">
							<?= ($list->flag_type == 'FILE') ? $sts[$list->status] : "" ?>
						</td>
					</tr>
				<?php endforeach;
			else : ?>
				<tr>
					<td style="vertical-align: middle;" class="text-dark-50 py-4 text-center h5">Not available data</td>
				</tr>

			<?php endif; ?>
		</tbody>
	</table>
</div>