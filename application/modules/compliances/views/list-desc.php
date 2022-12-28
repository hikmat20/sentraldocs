<table class="table table-bordered table-sm">
	<thead>
		<tr class="text-center">
			<th width="50">No</th>
			<th width="100">Pasal</th>
			<th width="100">Ayat</th>
			<th>Description</th>
			<th width="500">Complience Description</th>
			<th width="150">Status</th>
		</tr>
	</thead>
	<tbody>
		<?php if (isset($data) && $data) :
			$n = 0;
			foreach ($ArrPasal as $k => $dt) : ?>
				<?php foreach ($dt as $j => $l) : $n++; ?>
					<tr class="">
						<td><?= $n; ?></td>
						<?php if ($j == '0') : ?>
							<th rowspan="<?= count($dt); ?>" class="text-center" style="vertical-align:middle;">
								<span class=""><?= $l->pasal_name; ?></span>
							</th>
						<?php endif; ?>
						<td><?= $l->name; ?></td>
						<td><?= $l->description; ?></td>
						<td><textarea name="complience_desc" class="form-control" rows="3" placeholder="Description"></textarea></td>
						<td>
							<select name="status" class="form-control select2" data-placeholder="Choose an options" data-allow-clear="true">
								<option value=""></option>
								<option value="1">Complience</option>
								<option value="2">Not Complience</option>
								<option value="3">Not Aplicable</option>
							</select>
						</td>
					</tr>
		<?php endforeach;
			endforeach;
		endif; ?>
	</tbody>
</table>

<script>
	$(document).ready(function() {
		$('.select2').select2({
			width: "100%"
		})
	})
</script>