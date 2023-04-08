<div class="row mb-3">
	<label for="" class="col-md-2 control-label">Checksheet Name</label>
	<div class="col-md-4">:
		<input type="hidden" id="data-id" value="<?= $data->id; ?>">
		<label for=""><?= $data->checksheet_name; ?></label>
	</div>
</div>
<div class="row mb-3">
	<label for="" class="col-md-2 control-label">Frequency Execution</label>
	<div class="col-md-4">:
		<label for=""><?= $fExecution[$data->frequency_execution]; ?></label>
	</div>
</div>
<div class="row mb-3">
	<label for="" class="col-md-2 control-label">Periode</label>
	<div class="col-md-4">:
		<label><?= date_format(date_create($data->periode), 'M, Y'); ?></label>
	</div>
</div>
<div class="row mb-3">
	<label for="" class="col-md-2 control-label">Checksheet Name</label>
	<div class="col-md-4">:
		<label for=""><?= $data->checksheet_name; ?></label>
	</div>
</div>
<div class="row mb-3">
	<label for="" class="col-md-2 control-label">Frequency Checking</label>
	<div class="col-md-4">:
		<label for=""><?= $fChecking[$data->frequency_checking]; ?></label>
	</div>
</div>
<hr>
<h4>List Checksheets</h4>
<div class="table-responsive" style="overflow-x:auto;">
	<table class="table table-bordered" style="width:<?= $width; ?>;">
		<thead class="table-light">
			<tr>
				<th rowspan="2" class="p-2" width="50">No</th>
				<th rowspan="2" class="p-2" width="">Items</th>
				<th rowspan="2" class="p-2" width="">Standard</th>
				<th colspan="<?= $count; ?>" class="p-2 text-center" width="<?= $col_width; ?>">Result</th>
			</tr>
			<tr>
				<?php for ($i = 1; $i <= $count; $i++) : ?>
					<th class="text-center"><?= $name_col . " " . $i; ?>
						<?php if ($weekOfMonth) : ?>
							<?php if ($weekOfMonth == $i) : ?>
								<input type="hidden" id="field" value="<?= $i; ?>">
							<?php endif; ?>
						<?php else : ?>
							<?php if ($i == (date('d'))) : ?>
								<input type="hidden" id="field" value="<?= $i; ?>">
							<?php endif; ?>
						<?php endif; ?>
					</th>

				<?php endfor; ?>
			</tr>
		</thead>
		<tbody>
			<?php $n = 0;
			if ($details) foreach ($details as $it) : $n++; ?>
				<tr>
					<td>
						<?= $n; ?>
					</td>
					<td><?= $it->item_name; ?></td>
					<td><?= $it->standard_check; ?></td>
					<?php for ($i = 1; $i <= $count; $i++) : ?>
						<?php $nn = "n" . $i; ?>
						<?php $Nn = "note" . $i; ?>
						<td class="<?= ($it->$nn == '') ? 'bg-light' : ''; ?>">
							<?php if ($it->check_type == 'boolean') : ?>
								<?php if ($it->$nn == 'no') : ?>
									<label for="" class="label-danger label"><?= ucfirst($it->$nn); ?></label>
									<?php if (isset($ArrNotes[$it->id]->$Nn)) : ?>
										<div class="alert alert-light p-2 my-1 font-italic" role="alert">
											<?= $ArrNotes[$it->id]->$Nn; ?>
										</div>
									<?php endif; ?>
								<?php elseif ($it->$nn == 'yes') : ?>
									<label for="" class="label-success label"><?= ucfirst($it->$nn); ?></label>
								<?php endif; ?>
							<?php else : ?>
								<?= ($it->$nn) ?: ''; ?>
							<?php endif; ?>
						</td>
					<?php endfor; ?>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<th rowspan="" class="p-1" width=""></th>
				<th rowspan="" class="p-1" width=""></th>
				<th rowspan="" class="p-1 text-right" width="">Execution By</th>
				<?php
				$day = 'day';
				$date = 'date';
				for ($i = 1; $i <= $count; $i++) :
					$dayCheck = $day . $i;
					$dateCheck = $date . $i;
				?>
					<td class="text-muted p-1">
						<small for="">
							<?= isset($ArrExe[$data->id]->$dayCheck) ? $ArrUsers[$ArrExe[$data->id]->$dayCheck] . " | " : ''; ?>
						</small><small for="">
							<?= isset($ArrExeDate[$data->id]->$dateCheck) ? $ArrExeDate[$data->id]->$dateCheck : '' ?>
						</small>
					</td>
				<?php endfor; ?>
			</tr>
			<tr>
				<th rowspan="" class="p-1" width=""></th>
				<th rowspan="" class="p-1" width=""></th>
				<th rowspan="" class="p-1 text-right" width="">Checker By</th>
				<?php
				$day = 'day';
				$date = 'date';
				for ($i = 1; $i <= $count; $i++) :
					$dayCheck 	= $day . $i;
					$dateCheck 	= $date . $i; ?>

					<th class="text-muted p-1">
						<?php
						if (($weekOfMonth)) :
							if ($weekOfMonth == $i) :
								if (!isset($ArrCheck[$data->id]->$dayCheck)) : ?>
									<div class="" id="r_<?= $n . '_c_' . $i; ?>">
										<div class="d-flex justify-content-start align-items-center gap-4">
											<div class="form-check form-check-custom form-check-solid mr-10">
												<label class="form-check-label font-weight-bolder text-dark">
													<input class="form-check-input yes required" type="radio" value="yes" <?= ($weekOfMonth) ? (($weekOfMonth != $i) ? 'disabled' : '') : ($i != (date('d')) ? 'disabled' : ''); ?> name="detail[<?= $n; ?>][n<?= $i; ?>]" data-row="<?= $n . $i; ?>" id="boolean_<?= $i . $n; ?>" <?= ($it->$nn == 'yes') ? 'checked' : ''; ?>>
													Yes
													<span class="invalid-feedback font-weight-normal">
														<i class="text-danger fa fa-exclamation-circle"></i>
													</span>
												</label>
											</div>
											<div class="form-check form-check-custom form-check-danger form-check-solid mr-10">
												<label class="form-check-label font-weight-bolder text">
													<input class="form-check-input no required" type="radio" value="no" <?= ($weekOfMonth) ? (($weekOfMonth != $i) ? 'disabled' : '') : ($i != (date('d')) ? 'disabled' : ''); ?> name="detail[<?= $n; ?>][n<?= $i; ?>]" data-row="<?= $n . $i; ?>" id="boolean_<?= $i . $n; ?>" <?= ($it->$nn == 'no') ? 'checked' : ''; ?>>
													No
													<span class="invalid-feedback font-weight-normal">
														<i class="text-danger fa fa-exclamation-circle fa-md"></i>
													</span>
												</label>
											</div>
										</div>
										<textarea type="text" name="detail[<?= $n; ?>][note<?= $i; ?>]" id="note<?= $n . $i; ?>" <?= ($weekOfMonth) ? (($weekOfMonth != $i) ? 'disabled' : ((!$it->$nn || $it->$nn == 'yes') ? 'disabled' : '')) : ($i != (date('d')) ? 'disabled' : ((!$it->$nn || $it->$nn == 'yes') ? 'disabled' : '')); ?> class="form-control <?= $i == (date('d')) ? 'required' : ''; ?>" placeholder="Reason"><?= isset($ArrNote[$it->id]) ? $ArrNote[$it->id]->$Nn : ''; ?></textarea>
										<span class="invalid-feedback">Can not be empty</span>
									</div>
								<?php endif;
							endif;
						elseif ($i == (date('d'))) :
							if (!isset($ArrCheck[$data->id]->$dayCheck)) : ?>
								<div id="r_<?= '_c_' . $i; ?>">
									<div class="d-flex justify-content-start align-items-center gap-4">
										<div class="form-check form-check-custom form-check-solid mr-10">
											<label class="form-check-label font-weight-bolder text-dark">
												<input class="form-check-input yes required" type="radio" value="yes" name="checker[n<?= $i; ?>]" data-row="<?= "checker_" . $i; ?>" id="boolean_checker_<?= $i; ?>" <?= isset($ArrCheck[$data->id]->$dayCheck) ? 'checked' : ''; ?>>
												Yes
												<span class="invalid-feedback font-weight-normal">
													<i class="text-danger fa fa-exclamation-circle"></i>
												</span>
											</label>
										</div>
										<div class="form-check form-check-custom form-check-danger form-check-solid mr-10">
											<label class="form-check-label font-weight-bolder text-dark">
												<input class="form-check-input no required" type="radio" value="no" name="checker[n<?= $i; ?>]" data-row="<?= "checker_" . $i; ?>" id="boolean_checker_<?= $i; ?>" <?= ($it->$nn == 'no') ? 'checked' : ''; ?>>
												No
												<span class="invalid-feedback font-weight-normal">
													<i class="text-danger fa fa-exclamation-circle fa-md"></i>
												</span>
											</label>
										</div>
									</div>
								</div>
						<?php endif;
						endif; ?>
					</th>
				<?php endfor; ?>
			</tr>
		</tfoot>
	</table>
</div>
<br>

<div class="form-group row">
	<div class="col-md-2 text-right">
		<label for="">Note</label>
	</div>
	<div class="col-md-6">
		<textarea name="note" id="note" class="form-control mb-3 form-control-solid" readonly rows="5" placeholder="Notes..."></textarea>
		<button type="button" class="btn btn-primary" id="save-checker"><i class="fa fa-save"></i> Save</button>
	</div>
</div>

<br>
<h4>List Notes Checker</h4>
<div class="-3">
	<table class="table table-bordered table-sm">
		<thead class="bg-light">
			<tr>
				<td class="p-2 text-center" width="20">No</td>
				<td class="p-2 text-center" width="150">Date</td>
				<td class="p-2 text-center">Note</td>
				<td class="p-2 text-center" width="150">Created at</td>
				<td class="p-2 text-center" width="150">Created by</td>
				<td class="p-2 text-center" width="50">Action</td>
			</tr>
		</thead>
	</table>
</div>