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

<form id="form-upload">
	<div class="content d-flex flex-column flex-column-fluid p-0">
		<div class="d-flex flex-column-fluid justify-content-between align-items-top">
			<div class="container mt-10">
				<div class="card">
					<div class="card-header py-">
						<h3 class="card-title m-0">Edit</h3>
					</div>
					<div class="card-body">
						<input type="hidden" name="id" value="<?= $data->id; ?>">
						<input type="hidden" name="guide_detail_id" value="<?= $data->guide_detail_id; ?>">
						<div class="row pb-5">
							<div class="col-md-6">
								<div class="row mb-3">
									<label class="col-4 col-form-label">Nomor <span class="text-danger">*</span></label>
									<div class="col-8">
										<input type="text" name="number" id="number" readonly value="<?= $data->number; ?>" placeholder="Automate" class="form-control form-control-solid">
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-4 col-form-label">Kelompok <span class="text-danger">*</span></label>
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
									<label class="col-4 col-form-label">Jenis Alat <span class="text-danger">*</span></label>
									<div class="col-8">
										<input type="text" name="name" id="name" value="<?= $data->name; ?>" placeholder="Jenis Alat" class="form-control">
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-4 col-form-label">Metode <span class="text-danger">*</span></label>
									<div class="col-8">
										<select name="methode[]" id="methode" class="form-control select2" multiple data-placeholder="Choose an options" data-allow-clear="true">
											<option value="INS" <?= (in_array('INS', json_decode($data->methode))) ? 'selected' : ''; ?>>Insitu</option>
											<option value="LAB" <?= (in_array('LAB', json_decode($data->methode))) ? 'selected' : ''; ?>>Inlab</option>
										</select>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-4 col-form-label">Reference <span class="text-danger">*</span></label>
									<div class="col-8">
										<select name="reference[]" id="reference" class="form-control select2" multiple data-placeholder="Choose an options" data-allow-clear="true">
											<?php if ($references) foreach ($references as $ref) : ?>
												<option value="<?= $ref->id; ?>" <?= (in_array($ref->id, json_decode($data->reference))) ? 'selected' : ''; ?>><?= $ref->alias; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

							</div>
							<div class="col-6">
								<div class="row mb-3">
									<label class="col-4 col-form-label">Tanggal Terbit</label>
									<div class="col-8">
										<input type="text" name="publish_date" id="publish_date" value="<?= ($data->publish_date) ? date_format(date_create($data->publish_date), 'd/m/Y') : ''; ?>" placeholder="dd/mm/yyyy" class="form-control">
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-4 col-form-label">Tanggal Revisi</label>
									<div class="col-8">
										<input type="text" name="revision_date" id="revision_date" value="<?= ($data->revision_date) ? date_format(date_create($data->revision_date), 'd/m/Y') : ''; ?>" placeholder="dd/mm/yyyy" class="form-control">
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-4 col-form-label">Nomor Revisi</label>
									<div class="col-8">
										<input type="text" name="revision_number" id="revision_number" value="<?= ($data->revision_number) ?: ''; ?>" placeholder="Nomor" class="form-control">
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-4 col-form-label">Rentang Ungkur <span class="text-danger">*</span></label>
									<div class="col-8">
										<div class="list-range mb-2">
											<?php if ($data->range_measure) : ?>
												<?php foreach (json_decode($data->range_measure) as $k => $rm) : ?>
													<?php if ($k == 0) : ?>
														<input type="text" name="range_measure[]" value="<?= $rm; ?>" placeholder="0mm - 0mm" class="form-control mb-2">
													<?php else : ?>
														<div class="input-group mb-2">
															<input type="text" name="range_measure[]" value="<?= $rm; ?>" id="range_measure" placeholder="0mm - 0mm" class="form-control">
															<span class="input-group-append">
																<button type="button" class="btn btn-sm btn-light-danger remove-range-list"><i class="fa fa-times fa-sm"></i></button>
															</span>
														</div>
													<?php endif; ?>
											<?php endforeach;
											endif; ?>
										</div>
										<button type="button" id="add-range" class="btn btn-info btn-sm px-2 py-1"><i class="fa fa-plus fa-sm"></i> Add Range</button>
									</div>
								</div>
							</div>
						</div>

						<!-- <div class="text-center pb-5">
							<button type="button" class="btn btn-success px-5 save-files"><i class="fas fa-save"></i> Save</button>
						</div> -->

						<div class="d-flex justify-content-between align-items-center mb-2">
							<h5>Documents</h5>
							<button type="button" class="btn btn-outline-warning add-file"><i class="fa fa-upload" aria-hidden="true"></i> Upload File</button>
						</div>

						<!-- Nav tabs -->
						<ul class="nav nav-tabs nav-fill nav-success nav-pills mb-3 border-0" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link font-weight-bolder active w-100" id="IK-tab" data-toggle="tab" data-target="#IK" type="button" role="tab" aria-controls="IK" aria-selected="true">IK</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link font-weight-bolder w-100" id="CMC-tab" data-toggle="tab" data-target="#CMC" type="button" role="tab" aria-controls="CMC" aria-selected="false">CMC</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link font-weight-bolder w-100" id="Template-tab" data-toggle="tab" data-target="#Template" type="button" role="tab" aria-controls="Template" aria-selected="false">Template</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link font-weight-bolder w-100" id="UBLK-tab" data-toggle="tab" data-target="#UBLK" type="button" role="tab" aria-controls="UBLK" aria-selected="false">UBLK</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link font-weight-bolder w-100" id="Sertifikat-tab" data-toggle="tab" data-target="#Sertifikat" type="button" role="tab" aria-controls="Sertifikat" aria-selected="false">Format Sertifikat</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link font-weight-bolder w-100" id="Analisa-tab" data-toggle="tab" data-target="#Analisa" type="button" role="tab" aria-controls="Analisa" aria-selected="false">Analisa Drift</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link font-weight-bolder w-100" id="SertCalibrator-tab" data-toggle="tab" data-target="#SertCalibrator" type="button" role="tab" aria-controls="SertCalibrator" aria-selected="false">Sertifikat Calibrator</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link font-weight-bolder w-100" id="CekAntara-tab" data-toggle="tab" data-target="#CekAntara" type="button" role="tab" aria-controls="CekAntara" aria-selected="false">Cek Antara</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link font-weight-bolder w-100" id="Video-tab" data-toggle="tab" data-target="#Video" type="button" role="tab" aria-controls="Video" aria-selected="false">Video</button>
							</li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content ">
							<div class="tab-pane active" id="IK" role="tabpanel" aria-labelledby="IK-tab">
								<table class="table table-bordered table-striped table-hover table-sm">
									<thead>
										<tr class="bg-success text-white">
											<th width="50" class="text-center p-2">No</th>
											<th class="p-2">Name File</th>
											<th width="150" class="text-center p-2">Last Update</th>
											<th width="100" class="text-center p-2">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">1</td>
											<td>
												<a target="_blank" href="<?= base_url('/directory/MASTER_GUIDES/' . $data->company_id . '/' . $data->document); ?>#toolbar=0&navpanes=0">IK File</a>
											</td>
											<td class="text-center">2023-03-20 20:20:10</td>
											<td class="text-center">
												<button type="button" class="btn btn-xs btn-warning edit-ik btn-icon"><i class="fa fa-edit"></i></button>
												<button type="button" class="btn btn-xs btn-danger delete-ik btn-icon"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="tab-pane" id="CMC" role="tabpanel" aria-labelledby="CMC-tab">
								<table class="table table-bordered table-striped table-hover table-sm">
									<thead>
										<tr class="bg-success text-white">
											<th width="50" class="text-center p-2">No</th>
											<th class="p-2">Name File</th>
											<th width="150" class="text-center p-2">Last Update</th>
											<th width="100" class="text-center p-2">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">1</td>
											<td>
												<a target="_blank" href="<?= base_url('/directory/MASTER_GUIDES/' . $data->company_id . '/' . $data->document); ?>#toolbar=0&navpanes=0">IK File</a>
											</td>
											<td class="text-center">2023-03-20 20:20:10</td>
											<td class="text-center">
												<button type="button" class="btn btn-xs btn-warning edit-ik btn-icon"><i class="fa fa-edit"></i></button>
												<button type="button" class="btn btn-xs btn-danger delete-ik btn-icon"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="tab-pane" id="Template" role="tabpanel" aria-labelledby="Template-tab">
								<table class="table table-bordered table-striped table-hover table-sm">
									<thead>
										<tr class="bg-success text-white">
											<th width="50" class="text-center p-2">No</th>
											<th class="p-2">Name File</th>
											<th width="150" class="text-center p-2">Last Update</th>
											<th width="100" class="text-center p-2">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">1</td>
											<td>
												<a target="_blank" href="<?= base_url('/directory/MASTER_GUIDES/' . $data->company_id . '/' . $data->document); ?>#toolbar=0&navpanes=0">IK File</a>
											</td>
											<td class="text-center">2023-03-20 20:20:10</td>
											<td class="text-center">
												<button type="button" class="btn btn-xs btn-warning edit-ik btn-icon"><i class="fa fa-edit"></i></button>
												<button type="button" class="btn btn-xs btn-danger delete-ik btn-icon"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="tab-pane" id="UBLK" role="tabpanel" aria-labelledby="UBLK-tab">
								<table class="table table-bordered table-striped table-hover table-sm">
									<thead>
										<tr class="bg-success text-white">
											<th width="50" class="text-center p-2">No</th>
											<th class="p-2">Name File</th>
											<th width="150" class="text-center p-2">Last Update</th>
											<th width="100" class="text-center p-2">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">1</td>
											<td>
												<a target="_blank" href="<?= base_url('/directory/MASTER_GUIDES/' . $data->company_id . '/' . $data->document); ?>#toolbar=0&navpanes=0">IK File</a>
											</td>
											<td class="text-center">2023-03-20 20:20:10</td>
											<td class="text-center">
												<button type="button" class="btn btn-xs btn-warning edit-ik btn-icon"><i class="fa fa-edit"></i></button>
												<button type="button" class="btn btn-xs btn-danger delete-ik btn-icon"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="tab-pane" id="Sertifikat" role="tabpanel" aria-labelledby="Sertifikat-tab">
								<table class="table table-bordered table-striped table-hover table-sm">
									<thead>
										<tr class="bg-success text-white">
											<th width="50" class="text-center p-2">No</th>
											<th class="p-2">Name File</th>
											<th width="150" class="text-center p-2">Last Update</th>
											<th width="100" class="text-center p-2">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">1</td>
											<td>
												<a target="_blank" href="<?= base_url('/directory/MASTER_GUIDES/' . $data->company_id . '/' . $data->document); ?>#toolbar=0&navpanes=0">IK File</a>
											</td>
											<td class="text-center">2023-03-20 20:20:10</td>
											<td class="text-center">
												<button type="button" class="btn btn-xs btn-warning edit-ik btn-icon"><i class="fa fa-edit"></i></button>
												<button type="button" class="btn btn-xs btn-danger delete-ik btn-icon"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="tab-pane" id="Analisa" role="tabpanel" aria-labelledby="Analisa-tab">
								<table class="table table-bordered table-striped table-hover table-sm">
									<thead>
										<tr class="bg-success text-white">
											<th width="50" class="text-center p-2">No</th>
											<th class="p-2">Name File</th>
											<th width="150" class="text-center p-2">Last Update</th>
											<th width="100" class="text-center p-2">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">1</td>
											<td>
												<a target="_blank" href="<?= base_url('/directory/MASTER_GUIDES/' . $data->company_id . '/' . $data->document); ?>#toolbar=0&navpanes=0">IK File</a>
											</td>
											<td class="text-center">2023-03-20 20:20:10</td>
											<td class="text-center">
												<button type="button" class="btn btn-xs btn-warning edit-ik btn-icon"><i class="fa fa-edit"></i></button>
												<button type="button" class="btn btn-xs btn-danger delete-ik btn-icon"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="tab-pane" id="SertCalibrator" role="tabpanel" aria-labelledby="SertCalibrator-tab">
								<table class="table table-bordered table-striped table-hover table-sm">
									<thead>
										<tr class="bg-success text-white">
											<th width="50" class="text-center p-2">No</th>
											<th class="p-2">Name File</th>
											<th width="150" class="text-center p-2">Last Update</th>
											<th width="100" class="text-center p-2">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">1</td>
											<td>
												<a target="_blank" href="<?= base_url('/directory/MASTER_GUIDES/' . $data->company_id . '/' . $data->document); ?>#toolbar=0&navpanes=0">IK File</a>
											</td>
											<td class="text-center">2023-03-20 20:20:10</td>
											<td class="text-center">
												<button type="button" class="btn btn-xs btn-warning edit-ik btn-icon"><i class="fa fa-edit"></i></button>
												<button type="button" class="btn btn-xs btn-danger delete-ik btn-icon"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="tab-pane" id="CekAntara" role="tabpanel" aria-labelledby="CekAntara-tab">
								<table class="table table-bordered table-striped table-hover table-sm">
									<thead>
										<tr class="bg-success text-white">
											<th width="50" class="text-center p-2">No</th>
											<th class="p-2">Name File</th>
											<th width="150" class="text-center p-2">Last Update</th>
											<th width="100" class="text-center p-2">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center">1</td>
											<td>
												<a target="_blank" href="<?= base_url('/directory/MASTER_GUIDES/' . $data->company_id . '/' . $data->document); ?>#toolbar=0&navpanes=0">IK File</a>
											</td>
											<td class="text-center">2023-03-20 20:20:10</td>
											<td class="text-center">
												<button type="button" class="btn btn-xs btn-warning edit-ik btn-icon"><i class="fa fa-edit"></i></button>
												<button type="button" class="btn btn-xs btn-danger delete-ik btn-icon"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="tab-pane" id="Video" role="tabpanel" aria-labelledby="Video-tab">
								<label class="col-form-label"> Upload Video</label>
								<div class="">
									<button type="button" id="upload-video" class="btn btn-sm mb-3 btn-danger <?= ($data->video) ? 'd-none' : 'd-inline'; ?>"><i class="fa fa-video"></i>Upload Video</button>
									<input type="file" id="video-file" name="video" accept="video/mp4" class="d-none" />
									<video id="video-preview" width="290" class="<?= ($data->video) ? '' : 'd-none'; ?>" controls controlsList="nodownload" oncontextmenu="return false" height="180">
										Your browser does not support the video tag.
										<?php if ($data->video) : ?>
											<source src="<?= base_url('directory/MASTER_GUIDES/VIDEO/' . $data->company_id . '/') . $data->video; ?>" type="video/mp4">
										<?php endif; ?>
									</video>
									<div class="for-delete text-center">
										<!-- <input class="remove-video" name="remove-video" type="hidden"> -->
										<!-- <input type="hidden" name="oldFile[video]" id="<?= ($data->video) ?: ''; ?>"> -->
									</div>
								</div>
								<button type="button" id="remove-video" class="btn btn-sm btn-icon mb-3 btn-light-danger <?= ($data->video) ? '' : 'd-none'; ?>"><i class="fa fa-times"></i></button>
							</div>
						</div>

						<div class="text-center">
							<button type="button" class="btn btn-success btn-lg px-5 save-files"><i class="fa fa-save"></i>Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header py-3">
					<h5 class="modal-title"><i class="fa fa-upload" aria-hidden="true"></i> Upload File</h5>
					<button type="button" class="btn btn-xs btn-icon btn-default text-secondary" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
					</button>
				</div>
				<div class="modal-body pb-3">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs nav-pills nav-success border-0" id="navId" role="tablist">
						<li class="nav-item">
							<button type="button" data-target="#tab1Id" class="nav-link font-weight-bolder active" data-toggle="tab" aria-current="page">IK</button>
						</li>
						<li class="nav-item" role="presentation">
							<button type="button" data-target="#tab2Id" class="nav-link font-weight-bolder" data-toggle="tab">CMC</button>
						</li>
						<li class="nav-item" role="presentation">
							<button type="button" data-target="#tab3Id" class="nav-link font-weight-bolder" data-toggle="tab">Template</button>
						</li>
						<li class="nav-item" role="presentation">
							<button type="button" data-target="#tab4Id" class="nav-link font-weight-bolder" data-toggle="tab">UBLK</button>
						</li>
						<li class="nav-item" role="presentation">
							<button type="button" data-target="#tab5Id" class="nav-link font-weight-bolder" data-toggle="tab">Format Sertifikat</button>
						</li>
						<li class="nav-item" role="presentation">
							<button type="button" data-target="#tab6Id" class="nav-link font-weight-bolder" data-toggle="tab">Analisa Drift</button>
						</li>
						<li class="nav-item" role="presentation">
							<button type="button" data-target="#tab7Id" class="nav-link font-weight-bolder" data-toggle="tab">Sertifikat Calibrator</button>
						</li>
						<li class="nav-item" role="presentation">
							<button type="button" data-target="#tab8Id" class="nav-link font-weight-bolder" data-toggle="tab">Cek Antara</button>
						</li>
						<li class="nav-item" role="presentation">
							<button type="button" data-target="#tab9Id" class="nav-link font-weight-bolder" data-toggle="tab">Video</button>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content mt-3 border rounded p-4 mb-3" id="myTabContent">
						<div class="tab-pane fade show active" id="tab1Id" role="tabpanel">
							<div class="form-group mb-3">
								<label for="form-label">Document Name <span class="text-danger">*</span></label>
								<input type="text" name="documents[ik_name]" placeholder="Document Name" class="form-control">
							</div>
							<div class="form-group mb-0">
								<label class="col-form-label">Upload Document <span class="text-danger">*</span></label>
								<div class="">
									<div class="dropzone-wrapper mr-2 d-flex justify-content-center align-items-center" style="height: 250px;">
										<div class="dropzone-desc dropzone-desc-ik">
											<i class="fa fa-upload"></i>
											<p>Choose an PDF file or drag it here.</p>
										</div>
										<input type="file" id="ik-file" name="ik_file" accept="application/pdf" class="dropzone dropzone-1" />
										<div class="for-delete-ik d-none">
											<div class="middle d-flex justify-content-center align-items-center">
												<button type="button" class="btn btn-sm mr-1 btn-icon btn-warning change-image rounded-circle"><i class="fa fa-edit"></i></button>
												<button type="button" onclick="remove_file_ik(this)" class="btn btn-sm mr-1 btn-icon btn-danger remove-image rounded-circle"><i class="fa fa-trash"></i></button>
											</div>
										</div>
										<canvas id="ik-preview" class="d-none" width="150"></canvas>
										<!-- <input type="hidden" name="oldFiles[ik_file]" value=""> -->
										<!-- <input id="remove-document" name="remove-document" type="hidden"> -->
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="tab2Id" role="tabpanel">2</div>
						<div class="tab-pane fade" id="tab3Id" role="tabpanel">Template</div>
						<div class="tab-pane fade" id="tab4Id" role="tabpanel">UBLK</div>
						<div class="tab-pane fade" id="tab5Id" role="tabpanel">Format Sertifikat</div>
						<div class="tab-pane fade" id="tab6Id" role="tabpanel">Analisa Drift</div>
						<div class="tab-pane fade" id="tab7Id" role="tabpanel">Sertifikat Calibrator</div>
						<div class="tab-pane fade" id="tab8Id" role="tabpanel">Cek Antara</div>
						<div class="tab-pane fade" id="tab9Id" role="tabpanel">Video</div>
					</div>
				</div>
				<div class="modal-footer py-2">
					<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>

</form>

<script>
	$(document).ready(function() {
		$('.select2').select2({
			width: '100%',
			placeholder: 'Choose an options'
		})

		/* DATEPICKER */
		$('#publish_date,#revision_date').flatpickr({
			dateFormat: "d/m/Y",
			static: true
		})

	})


	$(document).on('click', '#add-range', function() {
		const element = `
		<div class="input-group mb-2">
			<input type="text" name="range_measure[]" id="range_measure" placeholder="0mm - 0mm" class="form-control">
			<span class="input-group-append">
				<button type="button" class="btn btn-sm btn-light-danger remove-range-list"><i class="fa fa-times fa-sm"></i></button>
			</span>
		</div>`;
		$('.list-range').append(element);
	})

	$(document).on('click', '.remove-range-list', function() {
		$(this).parents('div.input-group').remove();
	})

	$(document).on('click', '.save-files', function() {
		const name = $('#name').val()
		const group_id = $('#group_id').val()
		const methode = $('#methode').val()
		const reference = $('#reference').val()
		const range_measure = $('input[name="range_measure[]"]');
		const publish_date = $('#publish_date').val()
		const revision_date = $('#revision_date').val()
		const revision_number = $('#revision_number').val()
		// const document = $('#pdf-file').val()
		const btn = $(this)

		$('select#group_id').next().find('span.selection .select2-selection.select2-selection--single').removeClass('is-invalid')
		if (!group_id) {
			$('select#group_id').next().find('span.selection .select2-selection.select2-selection--single').addClass('is-invalid')
			return false;
		}

		$('#name').removeClass('is-invalid')

		if (!name) {
			$('#name').addClass('is-invalid')
			return false;
		}

		// $('#range_maesure').removeClass('is-invalid')
		let c = 0;
		range_measure.each(function() {
			$(this).removeClass('is-invalid')
			if ($(this).val().length == 0) {
				$(this).addClass('is-invalid')
				c++
			}
		})

		if (c > 0) {
			return false;
		}

		$('#publish_date').removeClass('is-invalid')
		if (!publish_date) {
			$('#publish_date').addClass('is-invalid')
			return false;
		}

		$('select#methode').next().find('span.selection .select2-selection.select2-selection--multiple').removeClass('is-invalid')
		if (!methode) {
			$('select#methode').next().find('span.selection .select2-selection.select2-selection--multiple').addClass('is-invalid')
			return false;
		}

		$('select#reference').next().find('span.selection .select2-selection.select2-selection--multiple').removeClass('is-invalid')
		if (!reference) {
			$('select#reference').next().find('span.selection .select2-selection.select2-selection--multiple').addClass('is-invalid')
			return false;
		}

		// if (!document) {
		// 	$('#pdf-file').addClass('is-invalid')
		// 	Swal.fire('Warning!', "File or Document can't be empty. Please upload document first.", 'warning', 3000)
		// 	return false;
		// }

		// $('#name-file').removeClass('is-invalid')


		const formdata = new FormData($('#form-upload')[0])
		$.ajax({
			url: siteurl + active_controller + 'upload_document',
			type: 'POST',
			dataType: 'JSON',
			data: formdata,
			contentType: false,
			processData: false,
			cache: false,
			beforeSend: function() {
				btn.html('<i class="spinner-border spinner-border" aria-hidden="true"></i>Loading...').prop('disabled', true)
			},
			complete: function() {
				btn.html('<i class="fa fa-save" aria-hidden="true"></i>Save').prop('disabled', false)
			},
			success: function(result) {
				if (result.status == 1) {
					Swal.fire("Success!", result.msg, "success", 3000).then(function() {
						location.reload()
					})
				} else {
					Swal.fire("Warning!", result.msg, "warning", 3000)
				}
			},
			error: function(result) {
				Swal.fire("Error!", "Server time out.", "error", 3000)

			}
		})
	})

	$(document).on('click', '.add-file', function() {
		$('#modelId').modal('show')
		// $('#modelId .modal-body').load(siteurl + active_controller + 'upload')
	})

	/* DROPZONE */

	var _PDF_DOC,
		_CANVAS = document.querySelector('#ik-preview'),
		_OBJECT_URL;

	function remove_file_ik(e) {
		$("#remove-document").val('x');
		$("#ik-preview").addClass('d-none');
		$(".for-delete-ik").addClass('d-none');
		$('.dropzone-desc-ik').removeClass('d-none')

		// reset to no selection
		$("#ik-file").val('');
	}

	function showPDF(pdf_url) {

		PDFJS.getDocument({
			url: pdf_url
		}).then(function(pdf_doc) {
			_PDF_DOC = pdf_doc;

			// Show the first page
			showPage(1);

			// destroy previous object url
			URL.revokeObjectURL(_OBJECT_URL);
		}).catch(function(error) {
			// trigger Cancel on error
			$("#cancel-pdf").click();

			// error reason
			alert(error.message);
		});;
	}

	function showPage(page_no) {
		var _CANVAS = document.querySelector('#ik-preview');
		// fetch the page
		// console.log(page_no);
		console.log(_PDF_DOC.getPage(page_no));
		_PDF_DOC.getPage(page_no).then(function(page) {
			// set the scale of viewport
			var scale_required = _CANVAS.width / page.getViewport(1).width;

			// get viewport of the page at required scale
			var viewport = page.getViewport(scale_required);

			// set canvas height
			_CANVAS.height = viewport.height;

			var renderContext = {
				canvasContext: _CANVAS.getContext('2d'),
				viewport: viewport
			};

			// render the page contents in the canvas
			page.render(renderContext).then(function() {
				$("#ik-preview").removeClass('d-none');
				$(".for-delete-ik").removeClass('d-none');
				$('.dropzone-desc-ik').addClass('d-none')
				// $("#pdf-loader").css('display', 'none');
			});
		});
	}

	$(document).on('click', '.change-image', function() {
		$('#ik-file').click()
	})

	/* Selected File has changed */
	$(document).on('change', "#ik-file", function() {

		// user selected file
		var file = $(this)[0].files[0];

		// allowed MIME types
		var mime_types = ['application/pdf'];

		// Validate whether PDF
		if (mime_types.indexOf(file.type) == -1) {
			alert('Error : Incorrect file type');
			return;
		}

		// validate file size
		if (file.size > 10 * 1024 * 1024) {
			alert('Error : Exceeded size 10MB');
			return;
		}

		// validation is successful

		// hide upload dialog button
		// $("#upload-dialog").css('display', 'none');

		// set name of the file
		// $("#pdf-name").text(file.name);
		// $("#pdf-name").css('display', 'inline-block');

		// show cancel and upload buttons now
		// $("#cancel-pdf").removeClass('d-none');
		// $("#remove-file").removeClass('d-none');
		// $("#upload-button").css('display', 'inline-block');

		// Show the PDF preview loader
		// $("#pdf-loader").css('display', 'inline-block');

		// object url of PDF 
		// console.log(file);
		_OBJECT_URL = URL.createObjectURL(file)

		// send the object url of the pdf to the PDF preview function
		showPDF(_OBJECT_URL);
	});

	/* Reset file input */
	$(document).on('click', "#cancel-pdf,.remove-image", function() {
		// show upload dialog button
		$("#upload-dialog").css('display', 'inline-block');

		// reset to no selection
		$("#pdf-file").val('');

		// hide elements that are not required
		$("#pdf-name").css('display', 'none');
		$("#pdf-preview").css('display', 'none');
		$("#pdf-loader").css('display', 'none');
		$("#cancel-pdf").addClass('d-none');
		$("#upload-button").css('display', 'none');
	});

	$(document).on('click', "#remove-file", function() {
		// show upload dialog button
		$("#upload-dialog").css('display', 'inline-block');
		$("#remove-document").val('x');

		// reset to no selection
		$("#pdf-file").val('');

		// hide elements that are not required
		$("#pdf-name").css('display', 'none');
		$("#pdf-preview").css('display', 'none');
		$("#pdf-loader").css('display', 'none');
		$("#cancel-pdf").addClass('d-none');
		$("#upload-button").css('display', 'none');
	});

	/* Upload file to server */
	$(document).on('click', "#upload-button", function() {
		// AJAX request to server
		alert('This will upload file to server');
	});


	/* UPLOAD VIDEO */
	$(document).on('click', '#upload-video', function() {
		$('#video-file').click();
	})

	$(document).on('change', '#video-file', function() {
		let file = $(this)[0].files[0];

		// allowed MIME types
		var mime_types = ['video/mp4'];

		// Validate whether PDF
		if (mime_types.indexOf(file.type) == -1) {
			Swal.fire('Warning', 'Error : Incorrect file type', 'warning', 3000)
			return;
		}

		// validate file size
		if (file.size > 50 * 1024 * 1024) {
			Swal.fire('Warning', 'Error : Exceeded size 50MB', 'warning', 3000)
			return;
		}

		let blobURL = URL.createObjectURL(file);
		console.log(blobURL);
		$("#video-preview").attr('src', blobURL).removeClass('d-none');
		$('#remove-video').removeClass('d-none')
	})

	$(document).on('click', '#remove-video', function() {
		$('#remove-video').addClass('d-none')
		$("#video-preview").attr('src', '').addClass('d-none');
		$("#video-file").val('');
	})

	function remove_video(e) {
		$(".remove-video").val('x');
		// reset to no selection
		$("#video-file").val('');
	}
</script>