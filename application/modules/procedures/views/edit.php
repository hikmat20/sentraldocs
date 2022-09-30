<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<form id="form-procedure">
				<div class="card card-stretch shadow card-custom">
					<div class="card-header justify-content-between d-flex align-items-center">
						<h2 class="m-0"><i class="fa fa-plus mr-2"></i><?= $title; ?></h2>
						<a href="<?= base_url($this->uri->segment(1)); ?>" class="btn btn-danger"><i class="fa fa-reply"></i>Back</a>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-size-h5"><strong>Nama Proses</strong></label>
									<div class="">
										<input type="hidden" name="id" value="<?= $data->id; ?>">
										<textarea name="name" id="name" required class="form-control" placeholder="Nama Proses" aria-describedby="helpId"><?= $data->name; ?></textarea>
										<small class="text-danger invalid-feedback">Nama Proses</small>
									</div>
								</div>
								<div class="form-group">
									<label class="font-size-h5"><strong>Objektif Proses</strong></label>
									<div class="">
										<textarea name="object" id="object" required class="form-control" placeholder="Objektif Proses" aria-describedby="helpId"><?= $data->object; ?></textarea>
										<small class="text-danger invalid-feedback">Objektif Proses</small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-size-h5"><strong>Performa Indikator</strong></label>
									<div class="">
										<textarea name="performance" id="performance" class="form-control" placeholder="Performa Indikator" aria-describedby="helpId"><?= $data->performance; ?></textarea>
										<small class="text-danger invalid-feedback">Performa Indikator</small>
									</div>
								</div>
								<div class="form-group">
									<label class="font-size-h5"><strong>Ruang Lingkup</strong></label>
									<div class="">
										<textarea name="scope" id="scope" class="form-control" placeholder="Ruang Lingkup" aria-describedby="helpId"><?= $data->scope; ?></textarea>
										<small class="text-danger invalid-feedback">Ruang Lingkup</small>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-size-h5"><strong>Definisi</strong></label>
									<div class="">
										<textarea name="define" id="define" class="form-control textarea" placeholder="Definisi" aria-describedby="helpId"><?= $data->define; ?></textarea>
										<small class="text-danger invalid-feedback">Definisi Proses</small>
									</div>
								</div>
								<div class="form-group">
									<label for="sipocor" class="font-weight-bold font-size-h5"><strong>SIPOCOR</strong></label>
									<div class="">
										<textarea name="sipocor" id="sipocor" class="form-control textarea" placeholder="SIPOCOR" aria-describedby="helpId"><?= $data->sipocor; ?></textarea>
										<small class="text-danger invalid-feedback">SIPOCOR</small>
									</div>
								</div>
								<button type="submit" class="btn btn-primary save"><i class="fa fa-save"></i>Save</button>
							</div>

						</div>

						<hr>
						<div class="d-flex justify-content-between align-items-center mb-3">
							<h4 class="">Flow</h4>
							<button type="button" class="btn btn-primary btn-sm" id="add_flow"><i class="fa fa-plus mr-2"></i>Add Flow</button>
						</div>
						<table class="table table-sm table-bordered">
							<thead class="text-center ">
								<tr class="table-light">
									<th width="80">No</th>
									<th width="15%">PIC</th>
									<th width="">Deskripsi</th>
									<th width="35%">Dokumen Terkait</th>
									<th width="100">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if ($detail) :
									$n = 0;
									foreach ($detail as $key => $dtl) : $n++; ?>
										<tr>

											<td style="vertical-align:middle;" class="text-center"><?= $dtl->number; ?></td>
											<td style="vertical-align:middle;" class="text-center"><?= $dtl->pic; ?></td>
											<td><?= $dtl->description; ?></td>
											<td style="vertical-align: middle;"><?= $dtl->relate_doc; ?></td>
											<td class="text-center" style="vertical-align: middle;">
												<button type="button" class="btn btn-warning btn-icon rounded-circle btn-sm edit_flow" data-id="<?= $dtl->id; ?>"><i class="fa fa-edit"></i></button>
												<button type="button" class="btn btn-danger btn-icon rounded-circle btn-sm delete_flow" data-id="<?= $dtl->id; ?>"><i class="fa fa-trash"></i></button>
											</td>
										</tr>
									<?php endforeach;
								else : ?>
									<tr>
										<td colspan="5" class="text-center text-muted">~ No data avilable ~</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>

				<!-- Modal -->
				<div class="modal fade" id="modelId" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modal title</h5>
								<button type="button" class="close" onclick="$('#content_modal').html('')" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="container-fluid" id="content_modal">
								</div>
							</div>
							<div class="modal-footer justify-content-between align-items-center">
								<button type="submit" class="btn btn-primary save"><i class="fa fa-save"></i>Save</button>
								<button type="button" class="btn btn-danger" onclick="$('#content_modal').html('')" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		tinymce.init({
			selector: '.textarea', // change this value according to the HTML
			// resize: true,
			height: 300,
			autosave_ask_before_unload: false,
			powerpaste_allow_local_images: true,
			plugins: [
				'a11ychecker', 'advcode', 'advlist', 'anchor', 'autolink', 'codesample', 'fullscreen', 'help',
				'image', 'editimage', 'tinydrive', 'lists', 'link', 'media', 'powerpaste', 'preview',
				'searchreplace', 'template', 'tinymcespellchecker', 'visualblocks', 'wordcount'
			],

			templates: [{
					title: 'Non-editable Example',
					description: 'Non-editable example.',
				},
				{
					title: 'Simple Table Example',
					description: 'Simple Table example.',
				}
			],
			toolbar: 'insertfile a11ycheck undo redo | bold italic | forecolor backcolor | template codesample | alignleft aligncenter alignright alignjustify | bullist numlist | link image',
			spellchecker_dialog: true,
			spellchecker_ignore_list: ['Ephox', 'Moxiecode'],
			tinydrive_demo_files_url: '../_images/tiny-drive-demo/demo_files.json',
			tinydrive_token_provider: (success, failure) => {
				success({
					token: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJqb2huZG9lIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.Ks_BdfH4CWilyzLNk8S2gDARFhuxIauLa8PwhdEQhEo'
				});
			},
			content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'

		});

		$(document).on('click', '#add_flow', function() {
			let html = `
			<div class="form-group">
				<label class="">Nomor</label>
				<div class="">
					<input type="text" name="flow[number]" id="number" class="form-control" required placeholder="Nomor" aria-describedby="helpId">
					<small class="text-danger invalid-feedback">Nomor</small>
				</div>
			</div>
			<div class="form-group">
				<label class="">PIC</label>
				<div class="">
					<input type="text" name="flow[pic]" id="pic" class="form-control" required placeholder="PIC" aria-describedby="helpId">
					<small class="text-danger invalid-feedback">PIC</small>
				</div>
			</div>
			<div class="form-group">
				<label for="description" class="">Deskripsi</label>
				<div class="">
					<textarea name="flow[description]" id="description" class="form-control" placeholder="Deskripsi" aria-describedby="helpId"></textarea>
					<small class="text-danger invalid-feedback">Deskripsi</small>
				</div>
			</div>
			<div class="form-group">
				<label class="">Dok. Terkait</label>
				<div class="">
					<textarea name="flow[relate_doc]" id="relate_doc" class="form-control" required placeholder="Dokumen terkait" aria-describedby="helpId" /></textarea>
					<small class="text-danger invalid-feedback">Dokumen terkait</small>
				</div>
			</div> 
			`;

			$('#content_modal').html(html)
			$('#modelId').modal('show')
		})

		$(document).on('click', '.edit_flow', function() {
			let id = $(this).data('id')
			let number = $(this).parents('tr').find('td:eq(0)').text();
			let pic = $(this).parents('tr').find('td:eq(1)').text();
			let desc = $(this).parents('tr').find('td:eq(2)').text();
			let reldoc = $(this).parents('tr').find('td:eq(3)').text();

			let html = `
			<div class="form-group">
				<label class="">Nomor</label>
				<div class="">
					<input type="hidden" name="flow[id]" class="form-control" value="` + id + `" >
					<input type="text" name="flow[number]" id="number" class="form-control" required placeholder="Nomor" value="` + number + `">
					<small class="text-danger invalid-feedback">Nomor</small>
				</div>
			</div>
			<div class="form-group">
				<label class="">PIC</label>
				<div class="">
					<input type="text" name="flow[pic]" id="pic" class="form-control" required placeholder="PIC" value="` + pic + `">
					<small class="text-danger invalid-feedback">PIC</small>
				</div>
			</div>
			<div class="form-group">
				<label for="description" class="">Deskripsi</label>
				<div class="">
					<textarea name="flow[description]" id="description" class="form-control" placeholder="Deskripsi" aria-describedby="helpId">` + desc + `</textarea>
					<small class="text-danger invalid-feedback">Deskripsi</small>
				</div>
			</div>
			<div class="form-group">
				<label class="">Dok. Terkait</label>
				<div class="">
					<textarea name="flow[relate_doc]" id="relate_doc" class="form-control" required placeholder="Dokumen terkait" aria-describedby="helpId">` + reldoc + `</textarea>
					<small class="text-danger invalid-feedback">Dokumen terkait</small>
				</div>
			</div> 
			`;

			$('#content_modal').html(html)
			$('#modelId').modal('show')
		})

		$(document).on('click', '.delete_flow', function() {
			let id = $(this).data('id')
			Swal.fire({
				title: 'Are you sure to delete this data?',
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Yes, Delete <i class="fa fa-trash"></i>',
			}).then((value) => {
				if (value.isConfirmed) {
					$.ajax({
						url: siteurl + active_controller + 'delete_flow/' + id,
						type: 'GET',
						dataType: 'JSON',
						success: function(result) {
							if (result.status == '1') {
								Swal.fire({
									title: 'Success!!',
									text: result.msg,
									icon: 'success',
									timer: 1500
								}).then(() => {
									location.reload()
								})

							} else {
								Swal.fire('Warning', "Can't delete data. Please try again!", 'warning', 2000)
							}
						},
						error: function() {
							Swal.fire('Error!', 'Server timeout. Please try again!', 'error', 3000)
						}
					})
				}
			})
		})


		$(document).on('submit', '#form-procedure', function(e) {
			e.preventDefault();
			let formdata = new FormData($(this)[0])
			let btn = $('.save')
			$.ajax({
				url: siteurl + active_controller + '/save',
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
						location.reload()
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
	})
</script>