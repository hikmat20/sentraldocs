<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<form id="form-chapter">
				<div class="card card-stretch shadow card-custom">
					<div class="card-header justify-content-between d-flex align-items-center">
						<h2 class="m-0"><i class="fa fa-plus mr-2"></i><?= $title; ?></h2>
						<a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>Back</a>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3 row flex-nowrap">
									<label for="Name" class="col-2 col-form-label font-weight-bold">Name</label>
									<div class="col-10">
										<input type="text" name="name" class="form-control" id="Name" placeholder="Regulation Name" />
									</div>
								</div>
								<div class="mb-3 row flex-nowrap">
									<label for="" class="col-2 col-form-label font-weight-bold">Number</label>
									<div class="col-4">
										<input type="text" name="number" id="number" class="form-control" placeholder="--">
									</div>
								</div>
								<div class="mb-3 row flex-nowrap">
									<label for="" class="col-2 col-form-label font-weight-bold">Year</label>
									<div class="col-4">
										<input type="text" name="year" id="year" class="form-control" placeholder="2022">
									</div>
								</div>
								<div class="mb-3 row flex-nowrap">
									<label for="" class="col-2 col-form-label font-weight-bold">About</label>
									<div class="col-10">
										<textarea name="about" id="about" class="form-control" placeholder="Lorem ipsum dolor sit amet!"></textarea>
									</div>
								</div>
								<div class="mb-3 row flex-nowrap">
									<label for="" class="col-2 col-form-label font-weight-bold"></label>
									<div class="col-4">
										<button type="submit" class="btn btn-primary w-100px save"><i class="fa fa-save"></i>Save</button>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3 row flex-nowrap">
									<label for="" class="col-2 col-form-label font-weight-bold">Category</label>
									<div class="col-6">
										<select name="status" id="status" class="form-control select2">
											<option value=""></option>
											<?php foreach ($category as $cat) : ?>
												<option value="<?= $cat->id; ?>"><?= $cat->name; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="mb-3 row flex-nowrap">
									<label for="" class="col-2 col-form-label font-weight-bold">Status</label>
									<div class="col-6">
										<select name="category" id="category" class="form-control select2">
											<option value="1">Publish</option>
											<option value="DFT">Draft</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<hr>
						<div class="d-flex justify-content-between align-items-center mb-3">
							<h4 class="">List Pasal</h4>
							<button type="button" class="btn btn-primary btn-sm" id="add_bab"><i class="fa fa-plus mr-2"></i>Add New Title</button>

						</div>

						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-center mb-2">
									<h3>Title</h3>
								</div>
								<table class="table table-sm table-condensed table-bordered">
									<thead class="text-center">
										<tr class="table-light">
											<th width="80">No</th>
											<th>Pasal</th>
											<th>Deskipsi</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td colspan="4" class="text-center text-muted">~ No data avilable ~</td>
										</tr>
									</tbody>
								</table>
								<button type="button" class="btn btn-success btn-sm" id="add_pasal"><i class="fa fa-plus mr-2"></i>Add Pasal</button>
							</div>
						</div>
					</div>

				</div>
				<!-- Modal -->
				<div class="modal fade" id="modelId" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
						<div class="modal-content">
							<div id="contentModal"></div>
							<div class="modal-footer justify-content-between align-items-center">
								<button type="submit" class="btn btn-primary w-100px save" id="save_chapter"><i class="fa fa-save"></i>Save</button>
								<button type="button" class="btn btn-danger" onclick=";setTimeout(()=>{$('#contentModal').html('');tinymce.remove()},500)" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="modelTitle" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<form id="form-title">
					<div class="mb-5">
						<label class="col-form-label font-weight-bold">Title Point</label>
						<input type="text" name="title_point" class="form-control" id="point" placeholder="BAB I" />
					</div>
					<div class="mb-5">
						<label class="col-form-label font-weight-bold">Title</label>
						<textarea name="title_name" class="form-control" id="chapter" rows="5" placeholder="Lorem..."></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer justify-content-between align-items-center">
				<button type="submit" class="btn btn-primary w-100px" id="save_title"><i class="fa fa-save"></i>Save</button>
				<button type="button" class="btn btn-danger" id="reset" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: 'Choose an Option',
			width: '100%',
			allowClear: true,
		})

		$(document).on('click', '#add_pasal', function() {
			const url = siteurl + active_controller + 'loadForm'
			$('#modelId').modal('show')
			$('#contentModal').load(url)
		})
		$(document).on('click', '#add_bab', function() {

			$('#modelTitle').modal('show')
			// $('#contentModal').load(url)
		})

		$(document).on('submit', '#form-chapter', function(e) {
			e.preventDefault();
			let formdata = new FormData($(this)[0])
			let btn = $('.save')
			$.ajax({
				url: siteurl + active_controller + 'save',
				data: formdata,
				type: 'POST',
				dataType: 'JSON',
				processData: false,
				contentType: false,
				cache: false,
				beforeSend: function() {
					btn.attr('disabled', true)
					btn.html('<i class="spinner spinner-border-sm"></i>Loading...')
				},
				complete: function() {
					btn.attr('disabled', false)
					btn.html('<i class="fa fa-save"></i>Save')
				},
				success: function(result) {
					if (result.status == 1) {
						Swal.fire({
							title: 'Success!',
							icon: 'success',
							text: result.msg,
							timer: 2000
						})
						$('#modelId').modal('hide')
						location.href = siteurl + active_controller + '/edit/' + result.id
					} else {
						Swal.fire({
							title: 'Warning!',
							icon: 'warning',
							text: result.msg,
							timer: 2000
						})
					}
				},

				error: function(result) {
					Swal.fire({
						title: 'Error!',
						icon: 'error',
						text: 'Server timeout, becuase error!',
						timer: 4000
					})
				}
			})
		})

		$(document).on('click', '#save_title', function() {
			let formdata = new FormData($('#form-title')[0])
			let btn = $(this)
			$.ajax({
				url: siteurl + active_controller + 'save_title',
				data: formdata,
				type: 'POST',
				dataType: 'JSON',
				processData: false,
				contentType: false,
				cache: false,
				beforeSend: function() {
					btn.attr('disabled', true)
					btn.html('<i class="spinner spinner-border-sm"></i>Loading...')
				},
				complete: function() {
					btn.attr('disabled', false)
					btn.html('<i class="fa fa-save"></i>Save')
				},
				success: function(result) {
					if (result.status == 1) {
						Swal.fire({
							title: 'Success!',
							icon: 'success',
							text: result.msg,
							timer: 2000
						})
						$('#modelId').modal('hide')
						// location.href = siteurl + active_controller + '/edit/' + result.id
					} else {
						Swal.fire({
							title: 'Warning!',
							icon: 'warning',
							text: result.msg,
							timer: 2000
						})
					}
				},

				error: function(result) {
					Swal.fire({
						title: 'Error!',
						icon: 'error',
						text: 'Server timeout, becuase error!',
						timer: 4000
					})
				}
			})
		})

		$(document).on('click', '#reset', function() {
			$('#form-title').find("input[type=text], textarea").val("");

		})
	})
</script>