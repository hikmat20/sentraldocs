<div class="row">
	<label class="col-2 col-form-label">Name</label>
	<div class="col-6">
		<?= $data->checksheet_detail_data_name; ?>
	</div>
</div>
<div class="row">
	<label class="col-2 col-form-label">Periode & Frequency</label>
	<div class="col-6">
		<?= $periode[$data->periode]; ?>
	</div>
</div>
<div class="row">
	<label class="col-2 col-form-label">Checking Date</label>
	<div class="col-6">
		<?= $data->date_checking; ?>
	</div>
</div>
<div class="row">
	<label class="col-2 col-form-label">Checked By</label>
	<div class="col-6">
		<?= $data->checked_by; ?>
	</div>
</div>
<hr>

<h6>List Item Checksheet</h6>
<table id="table-item" class="table table-sm table-bordered">
	<!-- <thead class="table-light">
		<tr>
			<th class="py-2 text-center" width="50">No</th>
			<th class="py-2" width="530">Item Check</th>
			<th class="py-2">Standard Check</th>
			<th class="py-2" width="180">Result Type Check</th>
		</tr>
	</thead>
	<tbody>
		<?php $n = 0;
		if ($data_detail) foreach ($data_detail as $item) : $n++ ?>
			<tr>
				<td class="py-2 text-center">
					<?= $n; ?>
				</td>
				<td class="py-2"><?= $item->item_name; ?></td>
				<td class="py-2"><?= $item->standard_check; ?></td>
				<td class="py-2">
					<?php if ($item->check_type == 'boolean') : ?>
						<label for="">Yes/No</label>
					<?php else : ?>
						<label for="">Input Text</label>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody> -->

	<div class="table-responsive" style="overflow-x:auto;">
		<table class="table table-bordered" style="width:<?= $width; ?>;">
			<thead class="table-light">
				<tr>
					<th rowspan="2" class="p-2" width="50">No</th>
					<th rowspan="2" class="p-2" width="">Items</th>
					<th rowspan="2" class="p-2" width="">Standard</th>
					<th colspan="7" class="p-2 text-center" width="20%">Result</th>
				</tr>
				<tr>
					<?php for ($i = 1; $i <= $count; $i++) : ?>
						<th><?= $name_col . " " . $i; ?></th>
					<?php endfor; ?>
				</tr>
			</thead>
			<tbody>
				<?php $n = 0;
				if ($data_detail) foreach ($data_detail as $it) : $n++; ?>
					<tr>
						<td>
							<?= $n; ?>
						</td>
						<td><?= $it->item_name; ?></td>
						<td><?= $it->standard_check; ?></td>
						<?php for ($i = 1; $i <= $count; $i++) : ?>
							<?php $nn = "n" . $i; ?>
							<td class="" width="6%">
								<?php if ($it->check_type == 'boolean') : ?>
									<?php if (($it->$nn) == 'yes') : ?>
										<span class="badge badge-success badge-pill" for="">Yes</span>
									<?php else : ?>
										<span class="badge badge-danger badge-pill" for="">No</span>
									<?php endif; ?>
								<?php else : ?>
									<?= $it->$nn; ?>
								<?php endif; ?>
							</td>
						<?php endfor; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</table>