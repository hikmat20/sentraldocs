<div class="content d-flex flex-column flex-column-fluid p-0">
	<div class="container mt-5">
		<div class="mb-5">
			<div style="font-size: 36px;" class="text-white font-weight-bolder">
				<a style="font-size: 30px;" href="<?= base_url($this->uri->segment(1)); ?>" class="text-warning" title="Back to Monitoring">
					<span class="fa fa-chevron-left"></span>
				</a>
				CORRECTION PROCEDURES
			</div>
		</div>
		<div class="input-group mb-3 w-25">
			<span class="input-group-text rounded-right-0 "><i class="fa fa-search"></i></span>
			<input type="text" name="search" id="search" class="form-control w-300" placeholder="Search">
		</div>

		<div class="card">
			<div class="pt-1 px-3 card-body">
				<table class="table table-hover datatable">
					<thead>
						<tr class="table-light">
							<th width="40px">No</th>
							<th>Procedure Name</th>
							<th width="180px" class="text-center">Created Date</th>
							<th width="150px" class="text-center">Created By</th>
							<th width="150px" class="text-center">Status</th>
							<th width="100px" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $n = 0;
						if ($procedures) :
							foreach ($procedures as $list) : $n++; ?>
								<tr>
									<td style="vertical-align: middle;" class="text-center"><?= $n; ?></td>
									<td class="text-dark-75" style="vertical-align: middle;">
										<div class="d-flex justify-content-start">
											<i class='text-success fa fa-file-alt mr-2 fa-2x py-0' style='vertical-align:middle;'></i>
											<span class="h5 mb-0 pt-2"><?= $list->name; ?></span>
										</div>
									</td>
									<td class="text-center" style="vertical-align: middle;"><?= $list->created_at; ?></td>
									<td class="text-center" style="vertical-align: middle;" class="mt-1"><?= $ArrUsers[$list->created_by]->full_name; ?></td>
									<td class="text-center" style="vertical-align: middle;" class="mt-1">
										<?= $sts[$list->status] ?>
									</td>
									<td class="text-center">
										<button type="button" data-id="<?= $list->id; ?>" data-type="procedures" class="btn btn-pirmary btn-icon update-review btn-warning btn-xs shadow-sm"><i class="fa fa-cog"></i></button>
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

<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content" style="min-height: 650px;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Review File</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i aria-hidden="true" class="ki ki-close"></i>
				</button>
			</div>
			<div class="modal-body pt-0" data-scroll="true" id="viewReviewData"></div>
			<!-- <div class="modal-footer py-1">
				<button type="button" class="btn btn-light-primary save-upload font-weight-bold">Save</button>
				<button type="button" class="btn btn-light-warning font-weight-bold" data-dismiss="modal" onclick="setTimeout(function(){$('#viewData').html('')},1000)">Close</button>
			</div> -->
		</div>
	</div>
</div>
<style>
	.dataTables_filter {
		display: none;
	}
</style>
<script>
	$(document).ready(function() {
		table = $('.datatable').DataTable({
			lengthChange: false
		})

		// #column3_search is a <input type="text"> element
		$('#search').on('paste input', function() {
			table
				.columns(1)
				.search(this.value)
				.draw();
		});
	})
	$(document).on('click', '.update-correction', function() {
		const id = $(this).data('id')
		$('#reviewModal').modal('show')
		$('#viewReviewData').load(siteurl + active_controller + 'load_form_correction/' + id)
	})

	$(document).on('click', '#upload-file', function() {
		$('#file').removeClass('is-invalid')
		$('#note').removeClass('is-invalid')

		const id = $('#id').val();
		const file = $('#file').val();
		const note = $('#note').val();
		console.log(id + ", " + file + ", " + note);
		if (file == '' || file == null) {
			$('#file').addClass('is-invalid')
			return false;
		}
		if ((note == '') || (note == null)) {
			// Swal.fire({
			// 	title: "Error Message!",
			// 	text: 'Empty User Prepared, please input User Prepared  first.....',
			// 	icon: "warning"
			// });
			$('#note').addClass('is-invalid')
			return false;
		}

		Swal.fire({
			title: "Are you sure?",
			text: "You will not be able to process again this data!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, Process it!",
			cancelButtonText: "No, cancel process!",
		}).then((value) => {
			if (value.isConfirmed) {
				var formData = new FormData($('#form-review')[0]);
				var baseurl = siteurl + active_controller + 'save_upload';
				$.ajax({
					url: baseurl,
					type: "POST",
					data: formData,
					processData: false,
					contentType: false,
					cache: false,
					dataType: 'json',
					success: function(data) {
						if (data.status == 1) {
							Swal.fire({
								title: "Upload Success!",
								text: data.msg,
								icon: "success",
								timer: 2000,
								showCancelButton: false,
								showConfirmButton: false,
								allowOutsideClick: false
							});
							$('#reviewModal').modal('hide')
							$('#viewReviewData').html('')
							location.reload()
						} else {
							if (data.status == 0) {
								Swal.fire({
									title: "Failed!",
									html: data.msg,
									icon: "warning",
									timer: 5000,
								});
							}
						}
					},
					error: function() {
						Swal.fire({
							title: "Error Message !",
							text: 'An Error Occured During Process. Please try again..',
							icon: "warning",
							timer: 3000,
						});
					}
				});
			}
		});
	});
</script>