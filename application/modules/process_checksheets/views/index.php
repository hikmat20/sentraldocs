<style>
	.cursor-pointer:hover div.dir-tools .btn-dropdown {
		display: block !important;
	}
</style>

<div class="content d-flex flex-column flex-column-fluid">
	<div class="d-flex flex-column-fluid justify-content-between align-items-top">
		<div class="container">
			<div class="card card-stretch shadow card-custom">
				<div class="card-header justify-content-between d-flex align-items-center">
					<h2 class="m-0"><i class="fa fa-folder-open"></i> List Checksheets</h2>
					<button type="button" id="add" class="btn btn-primary"><i class="fa fa-plus"></i> New Checksheet</button>
				</div>
				<div class="card-body">
					<table class="table table-sm table-bordered datatable">
						<thead class="table-light">
							<tr>
								<th class="p-2" width="50">No</th>
								<th class="p-2">Checksheet Name</th>
								<th class="p-2">Sub Dir.</th>
								<th class="p-2">Directory</th>
								<th class="p-2" width="100">Opsi</th>
							</tr>
						</thead>
						<tbody>
							<?php $n = 0;
							if ($details_data) foreach ($details_data as $dt) : $n++; ?>
								<tr>
									<td class="py-2"><?= $n; ?></td>
									<td class="py-2"><?= $dt->checksheet_detail_data_name; ?></td>
									<td class="py-2"><?= $dt->checksheet_detail_name; ?></td>
									<td class="py-2"><?= $dt->checksheets_name; ?></td>
									<td class="py-2 text-center">
										<button type="button" data-id="<?= $dt->id; ?>" class="btn btn-xs btn-success btn-icon view"><i class="fa fa-eye"></i></button>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalId" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" style="max-width: 90%;" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<div class="btn-save">

				</div>
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalView" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" style="max-width: 90%;" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
			</div>
		</div>
	</div>
</div>

<style>
	div#DataTables_Table_0_filter {
		display: none;
	}
</style>

<script>
	$(document).ready(function() {
		$('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
			$.fn.dataTable.tables({
				visible: true,
				api: true,
				searching: false,
				lengthChange: false,
				paging: true,
				info: false,
				stateSave: true,
				fixedHeader: true,
				pageLength: 10,
				scrollCollapse: true
			}).columns.adjust();
		});

		oTable = $('.datatable').DataTable({
			dom: 'Pfrtip',
			searchPanes: {
				cascadePanes: true
			},
			language: {
				searchPanes: {
					i18n: {
						emptyMessage: "<i></b>No results returned</b></i>"
					}
				},
				infoEmpty: "No results returned",
				zeroRecords: "No results returned",
				emptyTable: "No results returned",
			},
			lengthChange: true,
			paging: true,
			info: false,
			stateSave: false,
			pageLength: 20,
			// scrollCollapse: true
		})

		$(document).on('input paste', '#search', function() {
			oTable.search($(this).val()).draw();
		})

		$(document).on('change', '#checksheet_id', function() {
			const id = $(this).val();
			$.get(siteurl + active_controller + 'load_details/' + id, function(data) {
				$('#modalId .modal-body select#checksheet_detail_id').html(data).change()
			})
		})

		$(document).on('change', '#checksheet_detail_id', function() {
			const id = $(this).val();
			$.get(siteurl + active_controller + 'load_detail_data/' + id, function(data) {
				$('#modalId .modal-body table tbody').html(data)
			})
		})
	})

	/* DIRECTORY */

	$(document).on('click', '#add', function() {
		$('#modalId .modal-title').text('New Checksheet')
		$('#modalId').modal('show')
		$('#modalId .modal-body').load(siteurl + active_controller + 'load_sheet')
		$('.btn-save').html(`<button type="button" class="btn btn-primary save"><i class="fa fa-save"></i>Save</button>`)
	})


	$(document).on('click', '.edit_dir', function() {
		const id = $(this).data('id')
		$.getJSON(siteurl + active_controller + 'edit_dir/' + id, function(data) {
			var items = [];
			$('#modalId .modal-title').text('Edit Directory')
			$('#modalId').modal('show')
			$('#modalId .modal-body').html(`
			<label for="">Directory Name</label>
			<input type="text" id="id_dir" class="form-control d-none" value="` + data.data.id + `">
			<input type="text" id="dir_name" class="form-control" placeholder="New Folder" value="` + data.data.name + `">
			<span class="invalid-feedback">Directory Name not be empty</span>
			`)
			$('.save-sub-folder,.save-files,.update-files')
				.removeClass('save-sub-folder')
				.removeClass('save-files')
				.removeClass('update-files')
				.addClass('save')
		});
	})

	$(document).on('click', '.delete_dir', function() {
		const id = $(this).data('id')
		Swal.fire({
			title: 'Confirm',
			text: 'Are sure you want to delete this directory?',
			icon: 'question',
			showCancelButton: true,
		}).then((value) => {
			if (value.isConfirmed) {
				$.ajax({
					url: siteurl + active_controller + 'delete_dir',
					dataType: 'JSON',
					type: 'POST',
					data: {
						id
					},
					success: function(result) {
						if (result.status == 1) {
							Swal.fire("Success!", result.msg, "success", 3000).then(function() {
								location.reload()
							})
						} else {
							Swal.fire("Warning!", result.msg, "warning", 3000)
						}
					},
					error: function(result) {
						Swal.fire("Error!", "Server time out.", "error", 3000)

					}
				})
			}
		})
	})

	$(document).on('click', '.view', function() {
		const id = $(this).data('id')
		if (id) {
			$('#modalView .modal-title').text('View Checksheet')
			$('#modalView').modal('show')
			$('#modalView .modal-body').load(siteurl + active_controller + 'view_sheet/' + id)
		}
	})

	var _PDF_DOC,
		_CANVAS = document.querySelector('#pdf-preview'),
		_OBJECT_URL;

	function showPDF(pdf_url) {

		PDFJS.getDocument({
			url: pdf_url
		}).then(function(pdf_doc) {
			_PDF_DOC = pdf_doc;

			// Show the first page
			showPage(1);

			// destroy previous object url
			URL.revokeObjectURL(_OBJECT_URL);
		}).catch(function(error) {
			// trigger Cancel on error
			$("#cancel-pdf").click();

			// error reason
			alert(error.message);
		});;
	}

	function showPage(page_no) {
		var _CANVAS = document.querySelector('#pdf-preview');
		// fetch the page
		console.log(page_no);
		console.log(_PDF_DOC.getPage(page_no));
		_PDF_DOC.getPage(page_no).then(function(page) {
			// set the scale of viewport
			var scale_required = _CANVAS.width / page.getViewport(1).width;

			// get viewport of the page at required scale
			var viewport = page.getViewport(scale_required);

			// set canvas height
			_CANVAS.height = viewport.height;

			var renderContext = {
				canvasContext: _CANVAS.getContext('2d'),
				viewport: viewport
			};

			// render the page contents in the canvas
			page.render(renderContext).then(function() {
				$("#pdf-preview").css('display', 'inline-block');
				$("#pdf-loader").css('display', 'none');
			});
		});
	}

	$(document).on('click', '.change-image', function() {
		$('#pdf-file').click()
	})

	/* Selected File has changed */
	$(document).on('change', "#pdf-file", function() {
		// user selected file
		console.log($(this));
		var file = $(this)[0].files[0];

		// allowed MIME types
		var mime_types = ['application/pdf'];

		// Validate whether PDF
		if (mime_types.indexOf(file.type) == -1) {
			alert('Error : Incorrect file type');
			return;
		}

		// validate file size
		if (file.size > 10 * 1024 * 1024) {
			alert('Error : Exceeded size 10MB');
			return;
		}

		// validation is successful

		// hide upload dialog button
		$("#upload-dialog").css('display', 'none');

		// set name of the file
		// $("#pdf-name").text(file.name);
		// $("#pdf-name").css('display', 'inline-block');

		// show cancel and upload buttons now
		$("#cancel-pdf").removeClass('d-none');
		$("#remove-file").removeClass('d-none');
		// $("#upload-button").css('display', 'inline-block');

		// Show the PDF preview loader
		$("#pdf-loader").css('display', 'inline-block');

		// object url of PDF 
		// console.log(file);
		_OBJECT_URL = URL.createObjectURL(file)

		// send the object url of the pdf to the PDF preview function
		showPDF(_OBJECT_URL);
	});

	/* Reset file input */
	$(document).on('click', "#cancel-pdf,.remove-image", function() {
		// show upload dialog button
		$("#upload-dialog").css('display', 'inline-block');

		// reset to no selection
		$("#pdf-file").val('');

		// hide elements that are not required
		$("#pdf-name").css('display', 'none');
		$("#pdf-preview").css('display', 'none');
		$("#pdf-loader").css('display', 'none');
		$("#cancel-pdf").addClass('d-none');
		$("#upload-button").css('display', 'none');
	});

	$(document).on('click', "#remove-file", function() {
		// show upload dialog button
		$("#upload-dialog").css('display', 'inline-block');
		$("#remove-document").val('x');

		// reset to no selection
		$("#pdf-file").val('');

		// hide elements that are not required
		$("#pdf-name").css('display', 'none');
		$("#pdf-preview").css('display', 'none');
		$("#pdf-loader").css('display', 'none');
		$("#cancel-pdf").addClass('d-none');
		$("#upload-button").css('display', 'none');
	});

	/* Upload file to server */
	$(document).on('click', "#upload-button", function() {
		// AJAX request to server
		alert('This will upload file to server');
	});


	/* UPLOAD VIDEO */
	$(document).on('click', '#upload-video', function() {
		$('#video-file').click();
	})

	$(document).on('change', '#video-file', function() {
		let file = $(this)[0].files[0];

		// allowed MIME types
		var mime_types = ['video/mp4'];

		// Validate whether PDF
		if (mime_types.indexOf(file.type) == -1) {
			Swal.fire('Warning', 'Error : Incorrect file type', 'warning', 3000)
			return;
		}

		// validate file size
		if (file.size > 50 * 1024 * 1024) {
			Swal.fire('Warning', 'Error : Exceeded size 50MB', 'warning', 3000)
			return;
		}

		let blobURL = URL.createObjectURL(file);
		console.log(blobURL);
		$("#video-preview").attr('src', blobURL).removeClass('d-none');
		$('#remove-video').removeClass('d-none')
	})

	$(document).on('click', '#remove-video', function() {
		$('#remove-video').addClass('d-none')
		$("#video-preview").attr('src', '').addClass('d-none');
		$("#video-file").val('');
	})

	function remove_image(e) {
		$(".remove-video").val('x');
		// reset to no selection
		$("#video-file").val('');
	}

	/* MUlTI */

	$(document).on('click', '#add-item', function() {
		let e = '';
		let n = $('#table-item tbody tr').length + 1
		e = `
		<tr>
			<td class="text-center"><span class="h2">*</span></td>
			<td><textarea name="items[` + n + `][item_name]" class="form-control" placeholder="Item Check"></textarea></td>
			<td><textarea name="items[` + n + `][standard_check]" class="form-control" placeholder="Standard Check"></textarea></td>
			<td>
				<div class="form-check">
					<label class="form-check-label">
					<input type="radio" class="form-check-input" name="items[` + n + `][check_type]" id="check-type" value="boolean">
						Yes/No
					</label>
				</div>
				<div class="form-check">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="items[` + n + `][check_type]" id="check-type" value="text">
						Input Text
				</label>
				</div>
			</td>
			<td  class="text-center"><button type="button" class="remove-item btn btn-xs btn-icon btn-danger"><i class="fa fa-trash"</i></button></td>
		<tr>`
		$('#table-item tbody').append(e)
	})

	$(document).on('click', '.remove-item', function() {
		const id = $(this).data('id')
		const btn = $(this)
		if (id) {
			Swal.fire({
				title: 'Confirm!',
				text: 'Are you sure you want to delet this data?',
				icon: 'question',
				showCancelButton: true
			}).then((value) => {
				if (value.isConfirmed) {
					$.ajax({
						url: siteurl + active_controller + 'delete_item',
						dataType: 'JSON',
						type: 'POST',
						data: {
							id
						},
						success: function(result) {
							if (result.status == 1) {
								Swal.fire("Success!", result.msg, "success", 3000).then(function() {
									btn.parents('tr').remove();
								})
							} else {
								Swal.fire("Warning!", result.msg, "warning", 3000)
							}
						},
						error: function(result) {
							Swal.fire("Error!", "Server time out.", "error", 3000)

						}
					})
				}
			})
		} else {
			$(this).parents('tr').remove();
		}
	})

	$(function() {
		$("#myImg1").hover(
			function() {
				$(this).attr("src", "assets/images/dashboard/folder-file.gif");
			},
			function() {
				$(this).attr("src", "assets/images/dashboard/folder-file.png");
			}
		);
	});
</script>