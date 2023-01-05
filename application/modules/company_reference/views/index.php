<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header">
					<h2 class="mt-5"><i class="<?= $icon; ?> mr-2"></i><?= $title; ?></h2>
					<div class="mt-4 float-right ">
						<a href="<?= base_url($this->uri->segment(1) . '/add'); ?>" class="btn btn-primary" title="Add Company Audit">
							<i class="fa fa-plus mr-1"></i>Add Company Audit
						</a>
					</div>
				</div>
				<div class="card-body">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs nav-pills pb-3" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active btn-sm" id="Process-tab" data-toggle="tab" data-target="#Process" type="button" role="tab" aria-controls="Process" aria-selected="true">Process <span class="badge badge-circle badge-white text-primary ml-2"><?= count($data); ?></span></button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link btn-sm" id="Done-tab" data-toggle="tab" data-target="#Done" type="button" role="tab" aria-controls="Done" aria-selected="false">Done <span class="badge badge-circle badge-white text-primary ml-2"><?= count($done); ?></span></button>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content mt-3">
						<div class="tab-pane fade active show" id="Process" role="tabpanel" aria-labelledby="Process-tab">
							<table id="example1" class="table table-bordered table-sm table-hover datatable">
								<thead class="text-center table-light">
									<tr class="text-center">
										<th width="50">No.</th>
										<th class="text-left">Company</th>
										<th>Standard</th>
										<th>Regulation</th>
										<th>Start Date</th>
										<th>Status</th>
										<th width="150">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if (isset($data) && $data) :
										$n = 0;
										foreach ($data as $dt) : $n++; ?>
											<tr class="text-center">
												<td><?= $n; ?></td>
												<td class="text-left"><?= $dt->nm_perusahaan; ?></td>
												<td>
													<ul class="text-left">
														<?php if (isset($ArrStd[$dt->id])) : ?>
															<?php foreach ($ArrStd[$dt->id] as $std) : ?>
																<li><?= $std; ?></li>
															<?php endforeach; ?>
														<?php endif; ?>
													</ul>
												</td>
												<td></td>
												<td><?= $dt->sdate; ?></td>
												<td><?= $dt->status; ?></td>
												<td>
													<button type="button" class="btn btn-sm btn-icon rounded-circle btn-info view" data-id="<?= $dt->id; ?>" title="View Data"><i class="fa fa-search"></i></button>
													<a href="<?= base_url($this->uri->segment(1) . '/edit/' . $dt->id); ?>" class="btn btn-sm btn-icon rounded-circle btn-warning edit" data-id="<?= $dt->id; ?>" title="View Data"><i class="fa fa-edit"></i></a>
													<button type="button" class="btn btn-sm btn-icon rounded-circle btn-danger delete" data-id="<?= $dt->id; ?>" title="View Data"><i class="fa fa-trash"></i></button>
												</td>
											</tr>
									<?php endforeach;
									endif; ?>
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="Done" role="tabpanel" aria-labelledby="Done-tab">
							<table id="example2" class="table table-bordered table-sm table-hover datatable">
								<thead class="text-center table-light">
									<tr class="text-center">
										<th width="50">No.</th>
										<th class="text-left">Nama</th>
										<th>Tahun</th>
										<th>Nomor</th>
										<th width="150">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php if (isset($done) && $done) :
										$n = 0;
										foreach ($done as $dn) : $n++; ?>
											<tr class="text-center">
												<td><?= $n; ?></td>
												<td class="text-left"><?= $dn->name; ?></td>
												<td><?= $dn->year; ?></td>
												<td><?= $dn->number; ?></td>
												<td>
													<button type="button" class="btn btn-sm btn-icon rounded-circle btn-info view" data-id="<?= $dn->id; ?>" title="View Data"><i class="fa fa-search"></i></button>
													<a href="<?= base_url($this->uri->segment(1) . '/edit/' . $dn->id); ?>" class="btn btn-sm btn-icon rounded-circle btn-warning edit" data-id="<?= $dn->id; ?>" title="View Data"><i class="fa fa-edit"></i></a>
													<button type="button" class="btn btn-sm btn-icon rounded-circle btn-danger delete" data-id="<?= $dn->id; ?>" title="View Data"><i class="fa fa-trash"></i></button>
												</td>
											</tr>
									<?php endforeach;
									endif; ?>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalView" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">View Standard</h5>
				<span class="close" data-dismiss="modal" aria-label="Close"></span>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('button[data-toggle="tab"]').on('shown.bs.tab', function(e) {
			$.fn.dataTable.tables({
				visible: true,
				api: true
			}).columns.adjust();
		});

		$('#example1,#example2').DataTable({
			orderCellsTop: false,
			// fixedHeader: true,
			// scrollX: true,
			ordering: false,
			// info: false
		});

		$(document).on('click', '.view', function() {
			let id = $(this).data('id')
			if (id) {
				$.ajax({
					url: base_url + active_controller + 'view/' + id,
					type: 'GET',
					success: function(res) {
						if (res) {
							$('.modal-body').html(res)
							$('#modalView').modal('show')
						} else {
							Swal.fire({
								title: 'Warinng!',
								icon: 'warning',
								text: 'Data not valid, please try again.',
								timer: 3000
							})
						}
					},
					error: function(res) {
						Swal.fire({
							title: 'Error!',
							icon: 'error',
							text: 'Server timeout, error..',
							timer: 3000
						})
					}
				})
			}
		})

	})
</script>