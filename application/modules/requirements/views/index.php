<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header">
					<h2 class="mt-5"><i class="<?= $icon; ?> mr-2"></i><?= $title; ?></h2>
					<div class="mt-4 float-right ">
						<a href="<?= base_url($this->uri->segment(1) . '/add'); ?>" class="btn btn-primary" title="Back">
							<i class="fa fa-plus mr-1"></i>Add New
						</a>
					</div>
				</div>
				<div class="card-body">
					<table id="example1" class="table table-bordered table-sm table-hover datatable">
						<thead class="text-center table-light">
							<tr class="text-center">
								<th width="80">No.</th>
								<th class="text-left">Nama</th>
								<th>Tahun</th>
								<th>Nomor</th>
								<th width="150">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if (isset($data) && $data) :
								$n = 0;
								foreach ($data as $dt) : $n++; ?>
									<tr class="text-center">
										<td><?= $n; ?></td>
										<td class="text-left"><?= $dt->name; ?></td>
										<td><?= $dt->year; ?></td>
										<td><?= $dt->number; ?></td>
										<td>
											<button type="button" class="btn btn-sm btn-icon rounded-circle btn-info view" data-id="<?= $dt->id; ?>" title="View Data"><i class="fa fa-search"></i></button>
											<a href="<?= base_url($this->uri->segment(1) . '/edit/' . $dt->id); ?>" class="btn btn-sm btn-icon rounded-circle btn-warning edit" data-id="<?= $dt->id; ?>" title="View Data"><i class="fa fa-edit"></i></a>
											<button type="button" class="btn btn-sm btn-icon rounded-circle btn-danger delete" data-id="<?= $dt->id; ?>" title="View Data"><i class="fa fa-trash"></i></button>
										</td>
									</tr>
								<?php endforeach;
							else : ?>
								<tr>
									<td colspan="5" class="text-center text-muted">~ Not available data ~</td>
								</tr>
							<?php
							endif; ?>
						</tbody>
					</table>
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
		$('#example1').DataTable({
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