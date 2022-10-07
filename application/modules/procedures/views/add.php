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
										<textarea rows="5" name="name" id="name" required class="form-control" rows="5" placeholder="Nama Proses" aria-describedby="helpId"></textarea>
										<small class="text-danger invalid-feedback">Nama Proses</small>
									</div>
								</div>
								<div class="form-group">
									<label class="font-size-h5"><strong>Objektif Proses</strong></label>
									<div class="">
										<textarea rows="5" name="object" id="object" required class="form-control" rows="5" placeholder="Objektif Proses" aria-describedby="helpId"></textarea>
										<small class="text-danger invalid-feedback">Objektif Proses</small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="font-size-h5"><strong>Performa Indikator</strong></label>
									<div class="">
										<textarea rows="5" name="performance" id="performance" class="form-control" rows="5" placeholder="Performa Indikator" aria-describedby="helpId"></textarea>
										<small class="text-danger invalid-feedback">Performa Indikator</small>
									</div>
								</div>
								<div class="form-group">
									<label class="font-size-h5"><strong>Ruang Lingkup</strong></label>
									<div class="">
										<textarea rows="5" name="scope" id="scope" class="form-control" rows="5" placeholder="Ruang Lingkup" aria-describedby="helpId"></textarea>
										<small class="text-danger invalid-feedback">Ruang Lingkup</small>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="font-size-h5"><strong>Definisi</strong></label>
									<div class="">
										<textarea name="define" id="define" class="form-control textarea" placeholder="Definisi" aria-describedby="helpId"></textarea>
										<small class="text-danger invalid-feedback">Definisi Proses</small>
									</div>
								</div>
								<label for="sipocor" class="font-weight-bold font-size-h5"><strong>SIPOCOR</strong></label>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="Supplier" class="font-weight-bold font-size-"><strong>1. Supplier</strong></label>
									<div class="">
										<textarea rows="5" name="supplier" id="supplier" class="form-control" placeholder="Supplier" aria-describedby="helpId"></textarea>
										<small class="text-danger invalid-feedback">Supplier</small>
									</div>
								</div>
								<div class="form-group">
									<label for="Proses" class="font-weight-bold font-size-"><strong>3. Proses</strong></label>
									<div class="">
										<textarea rows="5" name="process" id="process" class="form-control" placeholder="Proses" aria-describedby="helpId"></textarea>
										<small class="text-danger invalid-feedback">Proses</small>
									</div>
								</div>
								<div class="form-group">
									<label for="Customer" class="font-weight-bold font-size-"><strong>5. Customer</strong></label>
									<div class="">
										<textarea rows="5" name="customer" id="customer" class="form-control" placeholder="Customer" aria-describedby="helpId"></textarea>
										<small class="text-danger invalid-feedback">Customer</small>
									</div>
								</div>
								<div class="form-group">
									<label for="Risk" class="font-weight-bold font-size-"><strong>7. Risk</strong></label>
									<div class="">
										<textarea rows="5" name="risk" id="risk" class="form-control" placeholder="Risk" aria-describedby="helpId"></textarea>
										<small class="text-danger invalid-feedback">Risk</small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="Input" class="font-weight-bold font-size-"><strong>2. Input</strong></label>
									<div class="">
										<textarea rows="5" name="input" id="input" class="form-control" placeholder="Input" aria-describedby="helpId"></textarea>
										<small class="text-danger invalid-feedback">Input</small>
									</div>
								</div>
								<div class="form-group">
									<label for="Output" class="font-weight-bold font-size-"><strong>4. Output</strong></label>
									<div class="">
										<textarea rows="5" name="output" id="output" class="form-control" placeholder="Output" aria-describedby="helpId"></textarea>
										<small class="text-danger invalid-feedback">Output</small>
									</div>
								</div>
								<div class="form-group">
									<label for="Objective" class="font-weight-bold font-size-"><strong>6. Objective</strong></label>
									<div class="">
										<textarea rows="5" name="objective" id="objective" class="form-control" placeholder="Objective" aria-describedby="helpId"></textarea>
										<small class="text-danger invalid-feedback">Order</small>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="mb-3">
							<h4 class="">Flow Images</h4>
							<div class="mt-1 mb-2">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Upload File</label>
											<div class="preview-zone hidden">
												<div class="box box-solid">
													<div class="box-body d-flex justify-content-start align-items-center">
														<div class="dropzone-wrapper mr-2 d-flex align-items-center" style="width: 150px;">
															<div class="dropzone-desc">
																<i class="fa fa-upload"></i>
																<p>Choose an image file or drag it here.</p>
															</div>
															<input type="file" name="img_flow[]" data-index="1" class="dropzone dropzone-1">
														</div>
														<div class="dropzone-wrapper mr-2 d-flex align-items-center" style="width: 150px;">
															<div class="dropzone-desc">
																<i class="fa fa-upload"></i>
																<p>Choose an image file or drag it here.</p>
															</div>

															<input type="file" name="img_flow[]" data-index="2" class="dropzone dropzone-2">
														</div>
														<div class="dropzone-wrapper mr-2 d-flex align-items-center" style="width: 150px;">
															<div class="dropzone-desc">
																<i class="fa fa-upload"></i>
																<p>Choose an image file or drag it here.</p>
															</div>
															<input type="file" name="img_flow[]" data-index="3" class="dropzone dropzone-3">
															<!-- <div class="middle m-auto text-center ">
																<button type="button" class="btn btn-sm btn-icon btn-danger remove-image rounded-circle"><i class="fa fa-trash"></i></button>
															</div> -->
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-center mb-3">
							<button type="submit" class="btn btn-primary save"><i class="fa fa-save"></i>Save</button>
						</div>
						<div class="d-flex justify-content-between align-items-center mb-3">
							<h4 class="">Flow Details</h4>
							<button type="button" class="btn btn-primary btn-sm" id="add_flow"><i class="fa fa-plus mr-2"></i>Add Flow</button>
						</div>
						<table class="table table-sm table-condensed table-bordered">
							<thead class="text-center ">
								<tr class="table-light">
									<th width="80">No</th>
									<th>PIC</th>
									<th>Deskripsi</th>
									<th>Dokumen Terkait</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td colspan="5" class="text-center text-muted">~ No data avilable ~</td>
								</tr>
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
		function handlePromise(promiseList) {
			return promiseList.map(promise =>
				promise.then((res) => ({
					status: 'ok',
					res
				}), (err) => ({
					status: 'not ok',
					err
				}))
			)
		}
		Promise.allSettled = function(promiseList) {
			return Promise.all(handlePromise(promiseList))
		}
		tinymce.init({
			selector: 'textarea.textarea',
			height: 500,
			resize: true,
			plugins: 'preview   importcss  searchreplace autolink autosave save ' +
				'directionality  visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
			toolbar: 'undo redo | blocks | ' +
				'bold italic backcolor forecolor | alignleft aligncenter ' +
				'alignright alignjustify | template codesample bullist numlist outdent indent | link image ' +
				'removeformat | help',
			content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
			// 	content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
		});

		$(document).on('click', '#add_flow', function() {
			let html = `
			<div class="form-group">
				<label class="">PIC/Penanggung Jawab</label>
				<div class="">
					<input type="text" name="flow[pic]" id="pic" class="form-control" required placeholder="PIC" aria-describedby="helpId">
					<small class="text-danger invalid-feedback">PIC</small>
				</div>
			</div>
			<div class="form-group">
				<label for="description" class="">Deskripsi</label>
				<div class="">
					<textarea rows="5" name="flow[description]" id="description" class="form-control" placeholder="Deskripsi" aria-describedby="helpId"></textarea>
					<small class="text-danger invalid-feedback">Deskripsi</small>
				</div>
			</div>
			<div class="form-group">
				<label class="">Dok. Terkait</label>
				<div class="">
					<textarea rows="5" name="flow[relate_doc]" id="relate_doc" class="form-control" required placeholder="Dokumen terkait" aria-describedby="helpId" /></textarea>
					<small class="text-danger invalid-feedback">Dokumen terkait</small>
				</div>
			</div> 
			`;

			$('#content_modal').html(html)
			$('#modelId').modal('show')
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
						location.href = siteurl + active_controller + 'edit/' + result.id
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

	function readFile(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			index = $(input).data('index')

			reader.onload = function(e) {
				console.log(e)
				var htmlPreview = '<img width="150" src="' + e.target.result + '" />';

				var overlay = `<div class="middle d-flex justify-content-center align-items-center">
				<button type="button" onclick="$(this).parent().parent().find('.dropzone').click()" class="btn btn-sm mr-1 btn-icon btn-warning change-image rounded-circle"><i class="fa fa-edit"></i></button>
				<button type="button" onclick="remove_image(this)" class="btn btn-sm mr-1 btn-icon btn-danger remove-image rounded-circle"><i class="fa fa-trash"></i></button>
				</div>`;
				var wrapperZone = $(input).parent();
				var previewZone = $(input).parent().parent().find('.preview-zone');
				var boxZone = $(input).parent().find('.dropzone-desc');

				wrapperZone.removeClass('dragover');
				previewZone.removeClass('hidden');
				boxZone.html('');
				boxZone.append(htmlPreview);
				wrapperZone.find('.middle').remove();
				wrapperZone.append(overlay);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}

	function reset(e) {
		// e.wrap('<form>').closest('form').get(0).reset();
		// e.unwrap();
	}

	function remove_image(e) {
		Swal.fire({
			title: 'Are you sure to delete this data?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#DD6B55',
			confirmButtonText: 'Yes, Delete <i class="fa fa-trash text-white"></i>',
		}).then((value) => {
			let srcFile = $(e).parent().parent().find('.dropzone-desc').find('img').attr('src')
			$(e).parent().parent().find('input.dropzone').val();
			$(e).parent().parent().find('input.dropzone').off();
			$(e).parent().parent().find('.dropzone-desc').empty().append('<i class="fa fa-upload"></i><p> Choose an image file or drag it here. </p>');
			// $(e).parent().parent().find('.for-delete').empty().append('<input type="hidden" name="delete_image[]" value="' + srcFile + '">');
			$(e).parent().remove();
		})

		// $(e).parent().parent().find('input.dropzone').val();
		// $(e).parent().parent().find('input.dropzone').off();
		// $(e).parent().parent().find('.dropzone-desc').empty().append('<i class="fa fa-upload"></i><p> Choose an image file or drag it here. </p>');
		// $(e).parent().remove();

	}

	$(document).on('change', ".dropzone", function() {
		readFile(this);
	});

	$('.dropzone-wrapper').on('dragover', function(e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).addClass('dragover');
	});

	$('.dropzone-wrapper').on('dragleave', function(e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).removeClass('dragover');
	});

	$('.remove-preview').on('click', function() {
		var boxZone = $(this).parents('.preview-zone').find('.box-body');
		var previewZone = $(this).parents('.preview-zone');
		var dropzone = $(this).parents('.form-group').find('.dropzone');
		boxZone.empty();
		previewZone.addClass('hidden');
		reset(dropzone);
	});
</script>