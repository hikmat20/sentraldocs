<div class="content d-flex flex-column flex-column-fluid p-0">
	<div class="d-flex flex-column-fluid justify-content-between align-items-top">
		<div class="container">
			<div class="d-flex align-items-baseline flex-wrap mr-5 mb-10">
				<a href="<?= base_url('dashboard'); ?>">
					<h4 class="text-dark font-weight-bold my-1 mr-2"><i class="fa fa-home"></i></h4>
				</a>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="<?= base_url('list/procedures/'); ?>" class="text-muted">PROSEDUR, FORM, IK DAN RECORD</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<span class="text-muted"><?= $procedure[0]->group_name; ?></span>
					</li>
				</ul>
			</div>
			<h1 class="text-white fa-3x"><?= $procedure[0]->name; ?></h1>
			<div class="row mb-10">
				<div class="col-md-4">
					<input type="text" name="serarch" id="search" placeholder="Pencarian" class="form-control rounded form-control-sm">
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">
					<ul class="nav nav-warning nav-pills nav-bolder" id="myTab2" role="tablist">
						<li class="nav-item mx-0">
							<a class="rounded-bottom-0 nav-link active" id="tab_procedure" data-toggle="tab" href="#data_procedure">
								<span class="nav-icon ">
									<i class="fa fa-file-alt"></i>
								</span>
								<span class="text-white h5 my-0">Prosedur
									<small class="">
										<div class="badge bg-white rounded-circle text-warning"><?= (isset($procedure)) ? count($procedure) : '0'; ?></div>
									</small>
								</span>
							</a>
						</li>
						<li class="nav-item mx-0">
							<a class="rounded-bottom-0 nav-link" id="tab_form" data-toggle="tab" href="#data_form">
								<span class="nav-icon ">
									<i class="fa fa-file-alt"></i>
								</span>
								<span class="text-white h5 my-0">Form
									<small class="">
										<div class="badge bg-white rounded-circle text-warning"><?= (isset($forms)) ? count($forms) : '0'; ?></div>
									</small>
								</span>
							</a>
						</li>
						<li class="nav-item mx-0">
							<a class="rounded-bottom-0 nav-link" id="tab_guide" data-toggle="tab" href="#data_guide">
								<span class="nav-icon ">
									<i class="fa fa-file-alt"></i>
								</span>
								<span class="text-white h5 my-0">IK
									<small class="">
										<div class="badge bg-white rounded-circle text-warning"><?= (isset($guides)) ? count($guides) : '0'; ?></div>
									</small>
								</span>
							</a>
						</li>
						<li class="nav-item mx-0">
							<a class="rounded-bottom-0 nav-link" id="tab_record" data-toggle="tab" href="#data_record">
								<span class="nav-icon ">
									<i class="fa fa-file-alt"></i>
								</span>
								<span class="text-white h5 my-0">Record
									<small class="">
										<div class="badge bg-white rounded-circle text-warning"><?= (isset($records)) ? count($records) : '0'; ?></div>
									</small>
								</span>
							</a>
						</li>
					</ul>
					<div class="card rounded-top-0 border-0" style="background-color: zrgba(255,255,255,0.85);">
						<div class="card-body py-3">
							<div class="tab-content" id="myTabContent2">
								<div class="tab-pane fade active show" id="data_procedure" role="tabpanel" aria-labelledby="tab_procedure">
									<table class="table table-condensed table-hover">
										<thead>
											<tr class="">
												<th class="h5 border-2 border-bottom-secondary" width="15px">No.</th>
												<th class="h5 border-2 border-bottom-secondary text-center">File Name</th>
												<th class="h5 border-2 border-bottom-secondary text-center" width="50px">View</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($procedure)) :
												$no = 0;
												foreach ($procedure as $lsPro) : $no++; ?>
													<tr class="cursor-pointer">
														<td class="h6 text-dark"><?= $no; ?></td>
														<td class="h4 text-dark d-flex align-items-center my-0"><i class="fa fa-file-alt text-success fa-2x mr-4"></i>
															<span class="mt-2"><?= $lsPro->name; ?></span>
														</td>
														<td class="h6 text-center" style="vertical-align: middle;">
															<button type="button" class="btn btn-icon btn-xs shadow-xs btn-info view-procedure" data-id="<?= $lsPro->id; ?>" data-toggle="tooltip" data-theme="dark" title="View Document"><i class="fa fa-eye"></i></button>
														</td>
													</tr>
												<?php endforeach;
											else : ?>
												<tr>
													<td colspan="2" class="text-center h4"><i>No data available</i></td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
								<div class="tab-pane fade" id="data_form" role="tabpanel" aria-labelledby="tab_form">
									<table class="table table-condensed table-hover">
										<thead>
											<tr class="">
												<th class="h5 border-2 border-bottom-secondary" width="15px">No.</th>
												<th class="h5 border-2 border-bottom-secondary text-center">File Name</th>
												<th class="h5 border-2 border-bottom-secondary text-center" width="50px">View</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($forms)) :
												$no = 0;
												foreach ($forms as $lsFrm) : $no++; ?>
													<tr class="cursor-pointer">
														<td class="h6 text-dark"><?= $no; ?></td>
														<td class="h4 text-dark d-flex align-items-center my-0"><i class="fa fa-file-alt text-primary fa-2x mr-4"></i>
															<span class="mt-2"><?= $lsFrm->name; ?></span>
														</td>
														<td class="h6 text-center" style="vertical-align: middle;">
															<button type="button" class="btn btn-icon btn-xs shadow-xs btn-info view-form" data-id="<?= $lsFrm->id; ?>" data-toggle="tooltip" data-theme="dark" title="View Document"><i class="fa fa-eye"></i></button>
														</td>
													</tr>
												<?php endforeach;
											else : ?>
												<tr>
													<td colspan="2" class="text-center h4"><i>No data available</i></td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
								<div class="tab-pane fade" id="data_guide" role="tabpanel" aria-labelledby="tab_guide">
									<table class="table table-condensed table-hover">
										<thead>
											<tr class="">
												<th class="h5 border-2 border-bottom-secondary" width="15px">No.</th>
												<th class="h5 border-2 border-bottom-secondary text-center">File Name</th>
												<th class="h5 border-2 border-bottom-secondary text-center" width="50px">View</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($guides)) :
												$no = 0;
												foreach ($guides as $lsGui) : $no++; ?>
													<tr class="cursor-pointer">
														<td class="h6 text-dark"><?= $no; ?></td>
														<td class="h4 text-dark d-flex align-items-center my-0"><i class="fa fa-file-alt text-info fa-2x mr-4"></i>
															<span class="mt-2"><?= $lsGui->name; ?></span>
														</td>
														<td class="h6 text-center" style="vertical-align: middle;">
															<button type="button" class="btn btn-icon btn-xs shadow-xs btn-info view-guide" data-id="<?= $lsGui->id; ?>" data-toggle="tooltip" data-theme="dark" title="View Document"><i class="fa fa-eye"></i></button>
														</td>
													</tr>
												<?php endforeach;
											else : ?>
												<tr>
													<td colspan="2" class="text-center h4"><i>No data available</i></td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
								<div class="tab-pane fade" id="data_record" role="tabpanel" aria-labelledby="tab_record">
									<table class="table table-condensed table-hover">
										<thead>
											<tr class="">
												<th class="h5 border-2 border-bottom-secondary" width="15px">No.</th>
												<th class="h5 border-2 border-bottom-secondary text-center">File Name</th>
												<th class="h5 border-2 border-bottom-secondary text-center" width="50px">View</th>
											</tr>
										</thead>
										<tbody>
											<?php if (isset($records)) :
												$no = 0;
												foreach ($records as $lsRec) : $no++; ?>
													<tr class="cursor-pointer">
														<td class="h6 text-dark"><?= $no; ?></td>
														<td class="h4 text-dark d-flex align-items-center my-0"><i class="fa fa-file-alt text-warning fa-2x mr-4"></i>
															<span class="mt-2"><?= $lsRec->name; ?></span>
														</td>
														<td class="h6 text-center" style="vertical-align: middle;">
															<button type="button" class="btn btn-icon btn-xs shadow-xs btn-info view-record" data-id="<?= $lsRec->id; ?>" data-toggle="tooltip" data-theme="dark" title="View Document"><i class="fa fa-eye"></i></button>
														</td>
													</tr>
												<?php endforeach;
											else : ?>
												<tr>
													<td colspan="2" class="text-center h4"><i>No data available</i></td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card mt-15 border-0 shadow-lg" style="background-color: srgba(255,255,255,0.85);">
						<div class="card-body pt-5 px-5">
							<?php foreach ($MainData as $main) : ?>
								<div class="d-flex flex-center mb-3">
									<span class="align-self-stretch mr-2 my-1 "><i class="fa fa-link text-warning"></i></span>
									<div class="d-flex flex-column flex-grow-1">
										<a href="<?= base_url($this->uri->segment(1) . '/' . $main->id); ?>" class="text-dark text-hover-warning font-weight-bolder font-size-lg mb-1"><?= $main->name; ?></a>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
			<div class="modal-content" data-scroll="true" data-height="700">
				<div class="modal-header">
					<h5 class="modal-title">View Document</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pt-1  py-5" id="data-file">
					<h3 class="text-center">File not found</h3>
				</div>
				<div class="modal-footer py-2">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		function show(id) {
			$('#modelId').modal('show')
			$('#data-file').load(siteurl + active_controller + 'show/' + id)
		}

		$(document).ready(function() {
			$(document).on('click', '.view-procedure', function() {
				const id = $(this).data('id') || ''

				if (id) {
					$('#modelId').modal('show')
					$('#data-file').load(siteurl + active_controller + 'view_procedure/' + id)
				}
			})
		})
	</script>