<?php if ($detail) :
	$n = 0;
	foreach ($detail as $key => $dtl) : $n++; ?>
		<tr>

			<td style="vertical-align:middle;" class="text-center"><?= $dtl->number; ?></td>
			<td style="vertical-align:middle;" class="text-center"><?= $dtl->pic; ?></td>
			<td><?= $dtl->description; ?></td>
			<td style="vertical-align: middle;"><?= $dtl->relate_doc; ?></td>
			<td class="text-center" style="vertical-align: middle;">
				<button type="button" class="btn btn-warning btn-icon rounded-circle btn-sm edit_flow" data-id="<?= $dtl->id; ?>"><i class="fa fa-edit"></i></button>
				<button type="button" class="btn btn-danger btn-icon rounded-circle btn-sm delete_flow" data-id="<?= $dtl->id; ?>"><i class="fa fa-trash"></i></button>
			</td>
		</tr>
	<?php endforeach;
else : ?>
	<tr>
		<td colspan="5" class="text-center text-muted">~ No data avilable ~</td>
	</tr>
<?php endif; ?>