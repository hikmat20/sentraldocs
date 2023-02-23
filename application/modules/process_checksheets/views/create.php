<form id="form-checksheet">
	<div class="row mb-3">
		<label for="" class="col-md-2 control-label">Directory</label>
		<div class="col-md-4">
			<select name="checksheet_id" id="checksheet_id" class="form-control select2">
				<option value=""></option>
				<?php foreach ($checksheets as $cs) : ?>
					<option value="<?= $cs->id; ?>"><?= $cs->name; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
	<div class="row mb-3">
		<label for="" class="col-md-2 control-label">Sub Directory</label>
		<div class="col-md-4">
			<select name="checksheet_detail_id" id="checksheet_detail_id" class="form-control select2">
			</select>
		</div>
	</div>
	<hr>
	<h5>List Checksheets</h5>
	<table class="table table-sm table-bordered">
		<thead class="table-light">
			<tr>
				<th class="p-2" width="50">No</th>
				<th class="p-2">Checksheet Name</th>
				<th class="p-2">Periode & Frequency</th>
				<th class="p-2" width="50">Opsi</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</form>

<script>
	$(document).ready(function() {
		$('.select2').select2({
			width: '100%',
			allowClear: true,
			placeholder: 'Choose an options'
		})
		$('.datatable').DataTable()
	})
</script>