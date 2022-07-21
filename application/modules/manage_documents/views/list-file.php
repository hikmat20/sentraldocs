<div class="py-4">
	<button type="button" class="btn btn- btn-icon prev " data-id="<?= $prev; ?>"><i class="fa fa-arrow-left mr-2 <?= ($prev != '0') ? 'text-dark-75' : ''; ?>"></i></button>
	<button type="button" class="btn btn-light-warning btn-md" onclick="new_folder('<?= $parent_id; ?>')"><i class="fa fa-folder-plus mr-2"></i>Add Folder</button>
	<button type="button" class="btn btn-light-success btn-md" onclick="upload_file('<?= $parent_id; ?>')"><i class="fa fa-file mr-2"></i>Upload File</button>
</div>
<hr class="my-0">
<table class="table table-hover">
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
									<a class="dropdown-item" onclick="edit_file('<?= $list->id; ?>','<?= $list->parent_id; ?>')" data-id="<?= $list->id; ?>" href="#"><i class="fa fa-file text-warning mr-2"></i>Edit File</a>
								<?php endif; ?>
								<a class="dropdown-item" href="#"><i class="fa fa-edit text-info mr-2"></i>Rename</a>
								<a class="dropdown-item" href="#"><i class="fa fa-arrows-alt text-primary mr-2"></i>Move</a>
								<a class="dropdown-item" href="#"><i class="fa fa-trash text-danger mr-2"></i>Delete</a>
							</div>
						</div>
						<?= ($list->flag_type == 'FOLDER') ? "<i class='fa fa-folder text-warning mr-2 fa-2x py-0' style='vertical-align:middle;'></i>" : "<i class='text-success fa-2x fa fa-file mr-2 py-0' style='vertical-align:middle;'></i>"; ?> <span class="my-auto"><?= $list->name; ?></span>
					</td>
					<td style="vertical-align: middle;"><?= $list->created_at; ?></td>
					<td style="vertical-align: middle;" class="mt-1"><?= $list->created_by; ?></td>
				</tr>
			<?php endforeach;
		else : ?>
			<tr>
				<td style="vertical-align: middle;" class="text-dark-50 py-4 text-center h5">Not available data</td>
			</tr>

		<?php endif; ?>
	</tbody>
</table>