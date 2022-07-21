<div class="content d-flex flex-column flex-column-fluid px-10 pb-0" id="kt_content">
	<div class="row">
		<div class="col-md-4">
			<div class="card card-custom">
				<div class="card-header my-0 min-h-10px">
					<span class="card-title text-dark-75"><i class="fa fa-folder mr-2 text-warning"></i>Directories</span>
				</div>
				<div class="card-body px-4 h-550px overflow-auto">
					<div id="kt_tree_2" class="tree-demo">
						<?= $loadFolder; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card card-custom">
				<div class="card-header my-0 min-h-10px">
					<span class="card-title text-dark-75"><i class="fa fa-file mr-2 text-success"></i>List File & Folder</span>
				</div>
				<div class="card-body h-550px overflow-auto py-2">
					<div id="data-file">
						<div class="d-flex justify-content-center align-items-center py-10">
							<img src="<?= base_url('assets\images\dashboard\folder-file.gif'); ?>" alt="" width="300px" class="img-responsive text-center opacity-30">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal-->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i aria-hidden="true" class="ki ki-close"></i>
				</button>
			</div>
			<div class="modal-body" id="viewData"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light-primary save-upload font-weight-bold">Save</button>
				<button type="button" class="btn btn-light-warning font-weight-bold" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">View File</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i aria-hidden="true" class="ki ki-close"></i>
				</button>
			</div>
			<div class="modal-body" id="viewDataFile"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light-warning font-weight-bold" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="new-folder" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create New Folder </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i aria-hidden="true" class="ki ki-close"></i>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<form id="create-folder">
						<div class="form-group row">
							<label for="inputName" class="col-md-12 col-form-label">Folder Name</label>
							<div class="col-md-12">
								<input type="hidden" class="form-control" name="parent_id" id="parent_id" placeholder="Folder Name">
								<input type="text" class="form-control" name="folder_name" id="folder_name" placeholder="Folder Name">
								<span class="invalid-feedback text-danger">Nama folder harus di isi</span>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light-primary font-weight-bold save-folder">Save</button>
				<button type="button" class="btn btn-light-warning font-weight-bold" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#kt_tree_2').jstree({
			"core": {
				"themes": {
					"responsive": true
				}
			},
			"types": {
				"default": {
					"icon": "fa fa-folder text-warning"
				},
				"file": {
					"icon": "fa fa-file  text-success"
				}
			},
			"plugins": ["types"]
		});

		// handle link clicks in tree nodes(support target="_blank" as well)
		$('#kt_tree_2').on('select_node.jstree', function(e, data) {
			var link = $('#' + data.selected).find('a');
			if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
				if (link.attr("target") == "_blank") {
					link.attr("href").target = "_blank";
				}
				document.location.href = link.attr("href");
				return false;
			}
		});
		// interaction and events
	})

	$(document).on("click", ".tree-folder", function() {
		const id = $(this).data('id');
		if (id) {
			$('#data-file').load(siteurl + active_controller + 'load_file/' + id)
		} else {
			$('#data-file').html('<tr class="text-center"><td colspan="3" class="text-center">Not available data</td></tr>')

		}
	});

	$(document).on("dblclick", ".folder", function() {
		const id = $(this).data('id');
		if (id) {
			$('#data-file').load(siteurl + active_controller + 'load_file/' + id)

		} else {
			$('#data-file').html('')

		}
	});

	$(document).on("dblclick", ".file", function() {
		const id = $(this).data('id');
		if (id) {
			$('#modal-view').modal('show')
			$('#viewDataFile').load(siteurl + active_controller + 'view_file/' + id)
		} else {
			$('#viewDataFile').html('')

		}
	});

	$(document).on("click", ".prev", function() {
		const id = $(this).data('id');
		if (id != '0') {
			$('#data-file').load(siteurl + active_controller + 'load_file/' + id)
		}
	});

	$(document).on('change', '#picture', function(event) {
		let old_picture = $('#old_picture').val();
		// alert(old_photo)
		var reader = new FileReader();
		reader.onload = function() {
			var output = document.getElementById('preview');
			output.src = reader.result;
			console.log(reader);
			let dataUpload = new FormData($('#dataUpload')[0]);
			$.ajax({
				url: baseurl + active_controller + 'upload',
				type: 'POST',
				data: dataUpload,
				dataType: 'JSON',
				cache: false,
				processData: false,
				contentType: false,
				success: function(result) {
					console.log(result.msg);
					if (result.status == 1) {
						$('#msg-upload').fadeIn('ease').html(`
							<div class="alert alert-custom py-3 alert-light-primary fade show mb-5" role="alert">
								<div class="alert-icon"><i class="fa fa-info-circle"></i></div>
								<div class="alert-text">` + result.msg + `</div>
								<div class="alert-close">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true"><i class="ki ki-close"></i></span>
									</button>
								</div>
							</div>`)
						$('#old_picture').val(result.photo);
						setTimeout(function() {
							$('#msg-upload').fadeOut('ease')
						}, 5000)
					} else {
						$('#msg-upload').fadeIn('ease').html(`\
							<div class="alert alert-danger">
								<div class="alert alert-custom py-3 alert-light-danger fade show mb-5" role="alert">
									<div class="alert-icon"><i class="fas fa-exclamation-triangle"></i></div>
									<div class="alert-text">` + result.msg + `</div>
									<div class="alert-close">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true"><i class="ki ki-close"></i></span>
										</button>
									</div>
								</div>`)
						// return false;
						setTimeout(function() {
							$('#msg-upload').fadeOut('ease')
							$('#preview').attr('src', './assets/img/' + old_picture);
						}, 5000)
					}
				},
				error: function(result) {
					alert('Internal Error!');
					console.log(result);
				}
			})
		}
		reader.readAsDataURL(event.target.files[0]);
	})

	$(document).on('click', '.change-picture', function() {
		let id = $(this).data('id')
		$.ajax({
			url: baseurl + active_controller + 'picture',
			type: 'POST',
			data: {
				id
			},
			success: function(result) {
				if (result) {
					$('#exampleModal').modal('show');
					$('#viewData').html(result);
				} else {
					$('#exampleModal').modal('show');
					$('#viewData').html('-- No Data --');
				}
			},
			error: function(result) {
				alert('Internal Error!');
				console.log(result);
			}
		})
	})

	$(document).on('click', '.save-folder', function() {
		let folder_name = $('#folder_name').val()
		let parent_id = $('#parent_id').val()
		if (folder_name == '') {
			$('#folder_name').addClass('is-invalid');
			$('#feedback').removeClass('d-none');
			return false;
		} else {
			return $.ajax({
				url: base_url + active_controller + 'create_folder',
				type: 'POST',
				dataType: 'JSON',
				data: {
					parent_id,
					folder_name,
				},
				success: function(res) {
					if (res.status == '1') {
						Swal.fire({
							title: 'Success!!',
							text: res.msg,
							icon: 'success',
							timer: 2000
						})
						$('#data-file').load(siteurl + active_controller + 'load_file/' + parent_id)
						$('#new-folder').modal('hide')
						$('#folder_name').val('')
					} else {
						Swal.fire({
							title: 'Failed!!',
							icon: 'warning',
							text: res.msg,
							timer: 2000
						})
					}
				},
				error: function(res) {
					Swal.fire({
						title: 'Error!',
						icon: 'error',
						text: 'Server timeout, because error.',
						timer: 3000
					})
				}
			})
		}
	})

	$(document).on('click', '.save-upload', function(e) {
		$('#description').removeClass('is-invalid')
		$('#prepared_by').removeClass('is-invalid')
		$('#id_approval').removeClass('is-invalid')
		$('#id_review').removeClass('is-invalid')
		$('#id_distribusi').removeClass('is-invalid')
		$('#image').removeClass('is-invalid')

		e.preventDefault();
		const deskripsi = $('#description').val();
		const prepared_by = $('#prepared_by').val();
		const id_review = $('#id_review').val();
		const id_approval = $('#id_approval').val();
		const id_distribusi = $('#id_distribusi').val();
		const id_master = $('#id_master').val();
		const image = $('#image').val();
		const parent_id = $('#parent_id').val();

		if (deskripsi == '' || deskripsi == null) {
			$('#description').addClass('is-invalid')
			return false;
		}
		if (prepared_by == '' || prepared_by == null) {
			Swal.fire({
				title: "Error Message!",
				text: 'Empty User Prepared, please input User Prepared  first.....',
				icon: "warning"
			});
			$('#prepared_by').addClass('is-invalid')

			return false;
		}

		if (id_approval == '' || id_approval == null) {
			Swal.fire({
				title: "Error Message!",
				text: 'Empty approval, please input approval first.....',
				icon: "warning"
			});
			$('#id_approval').addClass('is-invalid')

			return false;
		}

		if (id_review == '' || id_review == null) {
			Swal.fire({
				title: "Error Message!",
				text: 'Empty approval, please input approval first.....',
				icon: "warning"
			});
			$('#id_review').addClass('is-invalid')

			return false;
		}
		if (id_distribusi == '' || id_distribusi == null) {
			$('#id_distribusi').addClass('is-invalid')
			Swal.fire({
				title: "Error Message!",
				text: 'Empty distribusi, please input distribusi first.....',
				icon: "warning"
			});

			return false;
		}

		if (image == '' || image == null) {
			$('#image').addClass('is-invalid')
			Swal.fire({
				title: "Error Message!",
				text: 'Empty file, please input file first.....',
				icon: "warning"
			});

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
				var formData = new FormData($('#form-upload')[0]);
				var baseurl = siteurl + active_controller + 'save_upload';
				$.ajax({
					url: baseurl,
					type: "POST",
					data: formData,
					cache: false,
					dataType: 'json',
					processData: false,
					contentType: false,
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
							$('#upload').modal('hide')
							$('#data-file').load(siteurl + active_controller + 'load_file/' + parent_id)
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

	function new_folder(parent_id) {
		$('#new-folder').modal('show')
		$('#folder_name').focus()
		$('#parent_id').val(parent_id)
	}

	function upload_file(parent_id) {
		$('#upload').modal('show')
		$('#viewData').load(siteurl + active_controller + 'upload/' + parent_id)
		$('.parent_id').val(parent_id)
	}

	function edit_file(id) {
		$('#upload').modal('show')
		$('#viewData').load(siteurl + active_controller + 'edit_file/' + id)
	}
</script>