<div class="row mb-3">
	<label for="exampleInputEmail1" class="col-2 col-form-label"></label>
	<div class="col-12">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th width="100">Standard</th>
					<th width="100">Pasal</th>
					<th>Desc. Indonesian</th>
					<th>Desc. English</th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($Data) && $Data) :
					$n = 0;
					foreach ($Data as $key => $val) : $n++; ?>
						<tr>
							<td><?= $n; ?></td>
							<td><?= $val->name; ?>
							<td><?= $val->chapter; ?>
							</td>
							<td>
								<?= limit_text(strip_tags($val->desc_indo), 100) . ' <a href="javascript:void(0)" class="link read" data-id="' . $val->id . '">[read]</a>'; ?>
							</td>
							<td>
								<?= limit_text(strip_tags($val->desc_eng), 100) . ' <a href="javascript:void(0)" class="link read" data-id="' . $val->id . '">[read]</a>'; ?>
							</td>
						</tr>
				<?php endforeach;
				endif; ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$('.select2-modal').select2({
		placeholder: "Choose an options",
		width: "100%",
		allowClear: true
	})
</script>