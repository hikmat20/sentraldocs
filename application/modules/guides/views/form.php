<form id="form-upload" enctype="multipart/form-data">
	<input type="hidden" name="guide_detail_id" value="<?= $guide_detail_id; ?>">
	<div class="row">
		<div class="col-md-6">
			<div class="row mb-3">
				<label class="col-4 col-form-label">Nomor <span>*</span></label>
				<div class="col-8">
					<input type="text" name="number" id="number" readonly placeholder="Automate" class="form-control form-control-solid">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Kelompok <span class="text-danger">*</span></label>
				<div class="col-8">
					<select name="group_id" id="group_id" class="form-control select2">
						<option value=""></option>
						<?php if ($group_tools) foreach ($group_tools as $grp) : ?>
							<option value="<?= $grp->id; ?>"><?= $grp->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Jenis Alat <span class="text-danger">*</span></label>
				<div class="col-8">
					<input type="text" name="name" id="name" placeholder="Jenis Alat" class="form-control">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Metode <span class="text-danger">*</span></label>
				<div class="col-8">
					<select name="methode[]" id="methode" data-allow-clear="true" multiple="multiple" class="form-select select2">
						<option value="INS">Insitu</option>
						<option value="LAB">Inlab</option>
					</select>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Reference <span class="text-danger">*</span></label>
				<div class="col-8">
					<select name="reference[]" id="reference" data-allow-clear="true" multiple="multiple" class="form-select select2">
						<option value=""></option>
						<?php if ($references) foreach ($references as $ref) : ?>
							<option value="<?= $ref->id; ?>"><?= $ref->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Rentang Ungkur <span class="text-danger">*</span></label>
				<div class="col-8">
					<div class="list-range mb-2">
						<input type="text" name="range_measure[]" id="range_measure" placeholder="0mm - 0mm" class="form-control mb-2">
					</div>
					<button type="button" id="add-range" class="btn btn-success btn-sm"><i class="fa fa-plus fa-sm"></i> Add Range</button>
				</div>
			</div>
		</div>
		<div class="col-6">

			<div class="row mb-3">
				<label class="col-4 col-form-label">Tanggal Terbit <span class="text-danger">*</span></label>
				<div class="col-8">
					<input type="date" name="publish_date" id="publish_date" placeholder="nate" class="form-control">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Tanggal Revisi</label>
				<div class="col-8">
					<input type="date" name="revision_date" id="revision_date" placeholder="nate" class="form-control">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Nomor Revisi</label>
				<div class="col-8">
					<input type="text" name="revision_number" id="revision_number" placeholder="Nomor" class="form-control">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Upload Document <span class="text-danger">*</span></label>
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
					</div>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label"> Upload Video</label>
				<div class="col-8 px-0">
					<button type="button" id="upload-video" class="btn btn-sm mb-3 btn-danger d-block"><i class="fa fa-video"></i>Upload Video</button>
					<input type="file" id="video-file" name="video" accept="video/mp4" class="d-none" />
					<video id="video-preview" width="290" height="180" class="d-none">
						Your browser does not support the video tag.
					</video>
					<div class="for-delete text-center">
						<button type="button" id="remove-video" class="btn btn-xs btn-icon btn-light-danger rounded-circle d-none"><i class="fa fa-times"></i></button>
					</div>

				</div>
			</div>
		</div>
	</div>
</form>

<script>
	$('.select2').select2({
		width: '100%',
		placeholder: 'Choose an options',
		allowClear: true,
		closeOnSelect: false
	})
</script>