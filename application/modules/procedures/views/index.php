<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header">
					<h2 class="mt-5"><i class="<?= $icon; ?> mr-2"></i><?= $title; ?></h2>
					<div class="mt-4 float-right ">
						<a href="<?= base_url($this->uri->segment(1) . '/add'); ?>" class="btn btn-primary" title="Add New Procedure">
							<i class="fa fa-plus mr-1"></i>Add New Procedure
						</a>
					</div>
				</div>
				<div class="card-body">
					<table id="example1" class="table table-bordered table-sm table-hover datatable">
						<thead class="text-center">
							<tr class="text-center">
								<th width="40">No.</th>
								<th class="text-left">Nama</th>
								<th width="100">Status</th>
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
										<td><?= $status[$dt->status]; ?></td>
										<td>
											<button type="button" class="btn btn-sm btn-icon rounded-circle btn-info view" data-id="<?= $dt->id; ?>" title="View Data"><i class="fa fa-search"></i></button>
											<a href="<?= base_url($this->uri->segment(1) . '/edit/' . $dt->id); ?>" class="btn btn-sm btn-icon rounded-circle btn-warning" data-id="<?= $dt->id; ?>" title="Edit Data"><i class="fa fa-edit"></i></a>
											<button type="button" class="btn btn-sm btn-icon rounded-circle btn-danger delete" data-id="<?= $dt->id; ?>" title="Delete Data"><i class="fa fa-trash"></i></button>
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

<!-- Modal -->
<div class="modal fade" id="modalForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
			<form class="form-horiontal" id="form-input">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
					<span type="button" onclick="$('#name').val('')" class="btn-close" data-dismiss="modal" aria-label="Close">
						<div class="fa fa-times"></div>
					</span>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="save"><i class="fa fa-save"></i>Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="$('#name').val('')"><i class="fa fa-times"></i>Close</button>
				</div>
			</form>
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

		$(document).on('click', '#add_new', function() {
			$('#modalForm').modal('show')
			let html = `
			
			`;
			$('.modal-body').html(html);
			load_tinymce('textarea')

		})

		$(document).on('click', '.edit', function() {
			let id = $(this).data('id')
			$('#modalForm').modal('show')
			$.ajax({
				url: siteurl + active_controller + 'edit/' + id,
				type: 'GET',
				dataType: 'JSON',
				success: function(result) {
					if (result) {
						let html = `
						<div class="form-group row">
							<label class="col-3">Name Procedure</label>
							<div class="col-9">
								<input type="hidden" name="id" id="id" class="form-control" value="` + result.id + `">
								<input type="text" name="name" id="name" class="form-control" required placeholder="Name Procedure" value="` + result.name + `">
								<small class="text-danger invalid-feedback">Name procedure</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">Objektif Proses</label>
							<div class="">
								<input type="text" name="object" id="object" class="form-control" value="` + result.object + `" required placeholder="Objektif Proses" aria-describedby="helpId">
								<small class="text-danger invalid-feedback">Objektif Proses</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">Definisi</label>
							<div class="">
								<input type="text" name="define" id="define" class="form-control" value="` + result.define + `" required placeholder="Definisi Proses" aria-describedby="helpId">
								<small class="text-danger invalid-feedback">Definisi Proses</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">Performa Indikator</label>
							<div class="">
								<input type="text" name="performance" id="performance" class="form-control" value="` + result.performance + `" required placeholder="Performa Indikator" aria-describedby="helpId">
								<small class="text-danger invalid-feedback">Performa Indikator</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">Ruang Lingkup</label>
							<div class="">
								<input type="text" name="scope" id="scope" class="form-control" value="` + result.scope + `" required placeholder="Ruang Lingkup" aria-describedby="helpId">
								<small class="text-danger invalid-feedback">Ruang Lingkup</small>
							</div>
						</div>
						<div class="form-group">
							<label for="sipocor" class="">SIPOCOR</label>
							<div class="">
								<textarea  name="sipocor" id="sipocor" class="form-control" placeholder="SIPOCOR"  aria-describedby="helpId">` + result.name + `</textarea>
								<small class="text-danger invalid-feedback">SIPOCOR</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">Nomor</label>
							<div class="">
								<input type="text" name="number" id="number" class="form-control" value="` + result.number + `" required placeholder="Nomor" aria-describedby="helpId">
								<small class="text-danger invalid-feedback">Nomor</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">PIC</label>
							<div class="">
								<input type="text" name="pic" id="pic" class="form-control" required placeholder="PIC" value="` + result.pic + `" aria-describedby="helpId">
								<small class="text-danger invalid-feedback">PIC</small>
							</div>
						</div>
						<div class="form-group">
							<label for="description" class="">Deskripsi</label>
							<div class="">
								<textarea name="description" id="description" class="form-control" placeholder="Deskripsi" aria-describedby="helpId">` + result.name + `</textarea>
								<small class="text-danger invalid-feedback">Deskripsi</small>
							</div>
						</div>
						<div class="form-group">
							<label class="">Dok. Terkait</label>
							<div class="">
								<input type="text" name="relate_doc" id="relate_doc" class="form-control" value="` + result.relate_doc + `" required placeholder="Dokumen terkait" aria-describedby="helpId"/>
								<small class="text-danger invalid-feedback">Dokumen terkait</small>
							</div>
						</div>
						`;
						$('.modal-body').html(html);

						load_tinymce('textarea')
					} else {
						Swal.fire('Warning', 'Data not valid. Please try again!', 'warning', 3000)
					}

				},
				error: function() {
					Swal.fire('Error!', 'Server timeout. Please try again!', 'error', 5000)
				}
			})
		})

		$(document).on('click', '.view', function() {
			let id = $(this).data('id')
			$.ajax({
				url: siteurl + active_controller + 'view/' + id,
				type: 'GET',
				dataType: 'JSON',
				success: function(result) {
					if (result) {
						let html = `
						<div class="form-group">
							<label class="font-weight-bold"><strong>NAMA PROSES</strong></label>
							<div class="">
							` + result.name + `
							</div>
						</div>
						<div class="form-group">
							<label class="font-weight-bold"><strong>OBJEDTIF PROSES</strong></label>
							<div class="">
								` + result.object + `
							</div>
						</div>
						<div class="form-group">
							<label class="font-weight-bold"><strong>DEFINISI</strong></label>
							<div class="">
								` + result.define + `
							</div>
						</div>
						<div class="form-group">
							<label class="font-weight-bold"><strong>PERFORMA INDIKATOR</strong></label>
							<div class="">
								` + result.performance + `
							</div>
						</div>
						<div class="form-group">
							<label class="font-weight-bold"><strong>RUANG LINGKUP</strong></label>
							<div class="">
								` + result.scope + `
							</div>
						</div>
						<div class="form-group">
							<label for="" class="font-weight-bold"><strong>SIPOCOR</strong></label>
							<div class="">
								` + result.sipocor + `
							</div>
						</div>
						<div class="form-group">
							<label class="font-weight-bold"><strong>NOMOR</strong></label>
							<div class="">
								` + result.number + `
							</div>
						</div>
						<div class="form-group">
							<label class="font-weight-bold"><strong>PIC</strong></label>
							<div class="">
								` + result.pic + `
							</div>
						</div>
						<div class="form-group">
							<label for="description" class="font-weight-bold"><strong>DESKRIPSI</strong></label>
							<div class="">
								` + result.description + `
							</div>
						</div>
						<div class="form-group">
							<label class="font-weight-bold"><strong>DOKUMEN TERKAIT</strong></label>
							<div class="">
								` + result.relate_doc + `
							</div>
						</div>
						`;
						$('.modal-body').html(html);
						$('#modalForm').modal('show')
					} else {
						Swal.fire('Warning', 'Data not valid. Please try again!', 'warning', 3000)
					}

				},
				error: function() {
					Swal.fire('Error!', 'Server timeout. Please try again!', 'error', 5000)
				}
			})
		})


		$(document).on('click', '.delete', function() {
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
						url: siteurl + active_controller + 'delete/' + id,
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

		$(document).on('submit', '#form-input', function(e) {
			e.preventDefault();
			let btn = $('#save')
			let formdata = new FormData($(this)[0])

			$.ajax({
				url: siteurl + active_controller + 'save',
				data: formdata,
				dataType: 'JSON',
				type: 'POST',
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
					if (result.status == '1') {
						Swal.fire({
							title: 'Success!',
							text: result.msg,
							icon: 'success',
							timer: 2000
						})
						$('#modalForm').modal('hide')
						$('#name').val('')
						location.reload();
					} else {
						Swal.fire({
							title: 'Warning!',
							text: result.msg,
							icon: 'warning',
							timer: 3000
						})
					}
				},
				error: function() {
					Swal.fire({
						title: 'Error!',
						text: 'Server timeout, becuase error. Please try again!',
						icon: 'error',
						timer: 5000
					})
				}
			})
		})
	})

	function load_tinymce(el) {
		tinymce.init({
			selector: el, // change this value according to the HTML
			resize: false,
			autosave_ask_before_unload: false,
			powerpaste_allow_local_images: true,
			plugins: [
				'a11ychecker', 'advcode', 'advlist', 'anchor', 'autolink', 'codesample', 'fullscreen', 'help',
				'image', 'tinydrive', 'lists', 'link', 'media', 'powerpaste', 'preview',
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
	}
</script>