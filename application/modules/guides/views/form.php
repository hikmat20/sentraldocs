<form id="form-upload">
	<input type="hidden" name="guide_detail_id" value="<?= $guide_detail_id; ?>">
	<div class="row">
		<div class="col-md-6">
			<div class="row mb-3">
				<label class="col-4 col-form-label">Nomor</label>
				<div class="col-8">
					<input type="text" name="number" id="number" readonly placeholder="Automate" class="form-control form-control-solid">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Kelompok</label>
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
				<label class="col-4 col-form-label">Jenis Alat</label>
				<div class="col-8">
					<input type="text" name="name" id="name" placeholder="Jenis Alat" class="form-control">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Rentang Ungkur</label>
				<div class="col-8">
					<input type="text" name="range_measure" id="range_measure" placeholder="0mm - 0mm" class="form-control">
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Tanggal Terbit</label>
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
		</div>
		<div class="col-6">
			<div class="row mb-3">
				<label class="col-4 col-form-label">Metode</label>
				<div class="col-8">
					<select name="methode" id="methode" class="form-control select2">
						<option value=""></option>
						<option value="INS">Insitu</option>
						<option value="LAB">Inlab</option>
					</select>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label">Reference</label>
				<div class="col-8">
					<select name="reference" id="reference" class="form-control select2">
						<option value=""></option>
						<?php if ($references) foreach ($references as $ref) : ?>
							<option value="<?= $ref->id; ?>"><?= $ref->name; ?></option>
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
					</div>
				</div>
			</div>
			<div class="row mb-3">
				<label class="col-4 col-form-label"> Upload Video</label>
				<div class="col-8">
					<div class="dropzone-wrapper mr-2 d-flex align-items-center" style="width: 150px;">
						<div class="dropzone-desc">
							<i class="fa fa-upload"></i>
							<p>Choose an image file or drag it here.</p>
						</div>
						<input type="file" id="video-file" name="video" accept="application/mp4" class="dropzone dropzone-1" />
						<canvas id="pdf-preview" width="150"></canvas>
						<div class="for-delete"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="d-flex justify-content-between">

		<span class="invalid-feedback">File or Document can't be empty</span>
		<!-- <div class="form flex-grow-1">
			<input type="hidden" name="guide_detail_id" class="form-control mb-3" placeholder="Document Name" value="<?= $guide_detail_id; ?>" aria-describedby="helpId">
			<input type="hidden" name="category" class="form-control mb-3" placeholder="Document Name" value="` + cat + `" aria-describedby="helpId">
			<input type="text" name="name-file" id="name-file" class="form-control mb-3" placeholder="Document Name" aria-describedby="helpId">
			<span class="invalid-feedback">Name document can't be empty</span>
			<button id="cancel-pdf" type="button" class="btn btn-danger d-none rounded-circle btn-icon btn-sm"><i class="fa fa-trash"></i></button>
		</div> -->
	</div>
</form>

<script>
	$('.select2').select2({
		width: '100%',
		placeholder: 'Choose an options'
	})
</script>