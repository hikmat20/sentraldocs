<form id="form-upload">
	<input type="hidden" name="id" value="<?= $data->id; ?>">
	<input type="hidden" name="guide_detail_id" value="<?= $data->guide_detail_id; ?>">
	<div class="row">
		<div class="col-md-6">
			<div class="row mb-3">
				<label class="col-4 col-form-label">Nomor</label>
				<div class="col-8">
					<input type="text" name="number" id="number" readonly value="<?= $data->number; ?>" placeholder="Automate" class="form-control form-control-solid">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Kelompok</label>
				<div class="col-8">
					<select name="group_id" id="group_id" disabled class="form-control form-control-solid">
						<option value=""></option>
						<?php if ($group_tools) foreach ($group_tools as $grp) : ?>
							<option value="<?= $grp->id; ?>" <?= ($data->group_id == $grp->id) ? 'selected' : ''; ?>><?= $grp->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Jenis Alat</label>
				<div class="col-8">
					<input type="text" name="name" id="name" value="<?= $data->name; ?>" placeholder="Jenis Alat" class="form-control">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Rentang Ungkur</label>
				<div class="col-8">
					<input type="text" name="range_measure" id="range_measure" value="<?= $data->range_measure; ?>" placeholder="0mm - 0mm" class="form-control">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Tanggal Terbit</label>
				<div class="col-8">
					<input type="date" name="publish_date" id="publish_date" value="<?= $data->publish_date; ?>" placeholder="nate" class="form-control">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Tanggal Revisi</label>
				<div class="col-8">
					<input type="date" name="revision_date" id="revision_date" value="<?= $data->revision_date; ?>" placeholder="nate" class="form-control">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Nomor Revisi</label>
				<div class="col-8">
					<input type="text" name="revision_number" id="revision_number" value="<?= $data->revision_number; ?>" placeholder="Nomor" class="form-control">
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="row mb-3">
				<label class="col-4 col-form-label">Metode</label>
				<div class="col-8">
					<select name="methode" id="methode" class="form-control select2">
						<option value=""></option>
						<option value="INS" <?= ($data->methode == 'INS') ? 'selected' : ''; ?>>Insitu</option>
						<option value="LAB" <?= ($data->methode == 'LAB') ? 'selected' : ''; ?>>Inlab</option>
					</select>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Reference</label>
				<div class="col-8">
					<select name="reference" id="reference" class="form-control select2">
						<option value=""></option>
						<?php if ($references) foreach ($references as $ref) : ?>
							<option value="<?= $ref->id; ?>" <?= ($ref->id == $data->reference) ? 'selected' : ''; ?>><?= $ref->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label"> Upload Document</label>
				<div class="col-8">
					<div class="dropzone-wrapper mr-2 d-flex align-items-center" style="width: 150px;">
						<div class="dropzone-desc">
							<i class="fa fa-upload"></i>
							<p>Choose an image file or drag it here.</p>
						</div>
						<input type="file" id="pdf-file" name="documents" accept="application/pdf" class="dropzone dropzone-1" />
						<div class="for-delete">
							<div class="middle d-flex justify-content-center align-items-center">
								<button type="button" class="btn btn-sm mr-1 btn-icon btn-warning change-image rounded-circle"><i class="fa fa-edit"></i></button>
								<button type="button" onclick="remove_image(this)" class="btn btn-sm mr-1 btn-icon btn-danger remove-image rounded-circle"><i class="fa fa-trash"></i></button>
							</div>
						</div>
						<canvas id="pdf-preview" width="150"></canvas>
						<input type="hidden" name="old_file" value="<?= $data->document; ?>">
						<input id="remove-document" name="remove-document" type="hidden">
					</div>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label"> Upload Video</label>
				<div class="col-8">
					<div class="col-8 px-0">
						<button type="button" id="upload-video" class="btn btn-sm mb-3 btn-info d-inline">Upload Video</button>
						<button type="button" id="remove-video" class="btn btn-sm btn-icon mb-3 btn-light-danger"><i class="fa fa-times"></i></button>
						<input type="file" id="video-file" name="video" accept="video/mp4" class="d-none" />
						<video id="video-preview" width="290" controls controlsList="nodownload" oncontextmenu="return false" height="180">
							Your browser does not support the video tag.
							<source src="<?= base_url('directory/MASTER_GUIDES/VIDEO/' . $data->company_id . '/') . $data->video; ?>" type="video/mp4">
						</video>
						<div class="for-delete text-center">
							<input class="remove-video" name="remove-video" type="hidden">
							<input type="hidden" name="old_video" id="<?= $data->video; ?>">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</form>
<style>
	video::-internal-media-controls-download-button {
		display: none;
	}

	video::-webkit-media-controls-enclosure {
		overflow: hidden;
	}

	video::-webkit-media-controls-panel {
		width: calc(100% + 30px);
		/* Adjust as needed */
	}
</style>
<script>
	$('.select2').select2({
		width: '100%',
		placeholder: 'Choose an options'
	})
</script>