<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header">
					<h2 class="mt-5"><i class="<?= $icon; ?> mr-2"></i><?= $title; ?></h2>
				</div>
				<div class="card-body">

					<div class="row mb-3">
						<div class="col-md-6">
							<h2 class="mb-4"><i class="fa fa-desktop"></i> Current Compliance Overview</h2>
							<table class="table table-striped table-bordered table-sm">
								<tr>
									<th width="150">Company</th>
									<td><?= $reference->nm_perusahaan; ?></td>
								</tr>
								<tr>
									<th>State</th>
									<td><?= $reference->status; ?></td>
								</tr>
								<tr>
									<th>Created On</th>
									<td><?= $reference->created_at; ?></td>
								</tr>
								<tr>
									<th>Last Review</th>
									<td></td>
								</tr>
								<tr>
									<th>Count Review</th>
									<td></td>
								</tr>
								<tr>
									<th>Review By</th>
									<td></td>
								</tr>
							</table>
						</div>
						<div class="col-md-6">
							<h2 class="mb-4"><i class="fa fa-tools"></i> Options</h2>
							<div class="row">
								<div class="col-md-4">
									<div class="btn-block">
										<button type="button" class="btn btn-success btn-block" data-id="<?= $reference->id; ?>" id="compilation"><i class="fa fa-bolt"></i> Compilation</button>
										<button type="button" class="btn btn-info btn-block" data-id="<?= $reference->id; ?>" id="view-compilation"><i class="fa fa-eye"></i> View Compilation</button>
										<a target="_blank" href="<?= base_url($this->uri->segment(1) . '/export_pdf/' . $reference->id); ?>" class="btn btn-light btn-block to-pdf" data-comp_id="<?= $reference->company_id; ?>"><i class="fa fa-file-pdf"></i>Export PDF</a>
									</div>
								</div>
								<div class="col-md-8">
									<div class="border rounded-lg h-100"></div>
								</div>
							</div>
						</div>
					</div>


					<!-- <hr> -->
					<div class="mb-5 mt-5">
						<h2 class="mb-5"><i class="fa fa-desktop"></i> List Regulations</h2>
						<table id="example1" class="table table-bordered table-sm table-condensed table-hover datatable">
							<thead class="text-center table-light">
								<tr class="text-center">
									<th width="3%">No.</th>
									<th class="text-left">Regulation</th>
									<th class="text-left">Last Update</th>
									<th class="text-center" width="60">C</th>
									<th class="text-center" width="60">NC</th>
									<th class="text-center" width="60">NA</th>
									<th width="100">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($regulations) && $regulations) :
									$n = 0;
									foreach ($regulations as $dt) : $n++; ?>
										<tr class="">
											<td><?= $n; ?></td>
											<td class="text-left"><?= $dt->name; ?></td>
											<td class="text-center"><?= $dt->last_update; ?></td>
											<td class="text-center"><?= $dt->total_compliance; ?></td>
											<td class="text-center"><?= $dt->total_not_compliance; ?></td>
											<td class="text-center"><?= $dt->total_not_applicable; ?></td>
											<td class="text-center">
												<button type="button" class="btn btn-primary btn-sm btn-icon rounded-circle"><i class="fa fa-eye"></i></button>
												<a href="<?= base_url($this->uri->segment(1) . "/details/" . $dt->id); ?>" class="btn btn-sm btn-icon rounded-circle btn-warning detail" data-id="<?= $dt->id; ?>" title="Edit Data"><i class="fas fa-tasks"></i></a>
											</td>
										</tr>
								<?php endforeach;
								endif; ?>
							</tbody>
						</table>
					</div>

					<div class="my-5">
						<h2 class="mb-5"><i class="fa fa-list"></i> Complete Review</h2>
						<table class="table table-bordered table-striped table-sm">
							<thead class="table-light">
								<tr class="text-center">
									<th width="50">No</th>
									<th>Review Date</th>
									<th>Compliance</th>
									<th>Not Compliance</th>
									<th>Not Aplicable</th>
									<th>%</th>
									<th>View</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalView" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel"></h5>
				<span class="close btn-cls" data-dismiss="modal" aria-label="Close"></span>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer justify-content-end">
				<!-- <button type="button" class="btn btn-primary save w-100px"><i class="fa fa-save"></i>Save</button> -->
				<button type="button" class="btn btn-danger text-end" onclick="clear($('.modal-body'));setTimeout(()=>{$('.save').removeClass('d-none')},500)" data-dismiss="modal">Close</button>
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

		$('#example1').DataTable({
			orderCellsTop: false,
			// fixedHeader: true,
			// scrollX: true,
			ordering: false,
			// info: false
		});

		$(document).on('click', '#view-compilation', function(e) {
			const id = $(this).data('id')
			$('#modalView .modal-dialog').addClass('modal-xl')
			$('#modalView').modal('show')
			$('#modalView .modal-body').load(siteurl + active_controller + 'view_compliance/' + id)
		})

		$(document).on('click', '#compilation', function(e) {
			const id = $(this).data('id')
			$('#modalView .modal-dialog').addClass('modal-xl')
			$('#modalView').modal('show')
			$('#modalView .modal-body').load(siteurl + active_controller + 'compilation/' + id)
		})

		$(document).on('click', '#process_compilation', function(e) {
			const id = $(this).data('id')
			Swal.fire({
				title: 'Confirm!',
				text: 'Are you sure you want to porcess review?',
				icon: 'question',
				showCancelButton: true
			}).then((value) => {
				// let formdata = new FormData($('#form')[0]);
				if (value.isConfirmed) {
					$.ajax({
						url: siteurl + active_controller + 'save_review',
						data: {
							id
						},
						dataType: 'JSON',
						type: 'POST',
						success: function(result) {
							if (result.status == 1) {
								Swal.fire({
									title: 'Success!',
									text: result.msg,
									icon: 'success',
								}).then(() => {
									location.reload();
								})
							} else {
								Swal.fire({
									title: 'Warning!',
									text: result.msg,
									icon: 'warning',
								})
							}
						},
						error: function() {
							Swal.fire('Error!!', 'Server timeout', 'error', 3000)
						}
					})
				}
			})
		})
	})

	function validation(field) {
		if (field.val() == '' || field.val() == null) {
			field.addClass('is-invalid')
		} else {
			field.removeClass('is-invalid')
		}
	}

	function clear(e) {
		setTimeout(() => {
			$(e).html('');
		}, 500)
	}
</script>