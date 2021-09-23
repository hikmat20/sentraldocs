<?php
$ENABLE_ADD     = has_permission('Folders.Add');
$ENABLE_MANAGE  = has_permission('Folders.Manage');
$ENABLE_VIEW    = has_permission('Folders.View');
$ENABLE_DELETE  = has_permission('Folders.Delete');
$ENABLE_DOWNLOAD  = has_permission('Folders.Download');
$sts = [
    '0' => 'Revisi',
    '1' => 'Waiting Approval',
    '2' => 'Approval',
    '3' => 'Waiting Review',
];

function Size($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-stretch shadow-lg card-custom">
                <div class="card-header">
                    <h4 class="card-title text-muted">
                        <a href="<?= base_url('folders'); ?>"><i class="fa fa-home"></i></a>
                        &nbsp<a href=" <?= base_url('folders/subfolder/'); ?><?= $nama_master; ?>"><?= str_replace("-", " ", ucfirst($nama_master)); ?></a>
                    </h4>
                </div>
                <div class="card-body">
                    <button type="button" onclick="history.go(-1)" class="btn btn-icon btn-secondary m-1" title="Kembali">
                        <i class="fa fa-arrow-left"></i>
                    </button>
                    <button type="button" onclick="new_folder()" class="btn btn-icon btn-secondary m-1 " title="New Folder">
                        <i class="fas fa-folder-plus"></i>
                    </button>
                    <button type="button" onclick="add_file('<?= $id_master; ?>')" id="btn-file" class="btn btn-icon btn-secondary m-1" title="New File">
                        <i class="fas fa-file-medical"></i>
                    </button>
                    <button type="button" onclick="rename_folder()" id="btn-rename" class="btn btn-icon btn-secondary m-1" disabled title="Rename">
                        <i class="fa fa-pen"></i>
                    </button>
                    <button type="button" onclick="delete_folder()" id="btn-delete" class="btn btn-icon btn-secondary m-1" disabled title="Delete">
                        <i class="fa fa-trash"></i>
                    </button>
                    <hr>
                    <h4>Dokumen</h4>
                    <table id="example1" class="table table-borderless table-condensed table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama File</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col">Sts. Approve</th>
                                <th scope="col">Tgl. Approve</th>
                                <th scope="col">Revisi</th>
                                <th scope="col">Sts. Revisi</th>
                                <th scope="col">Prepered By</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($files) : $n = 0;
                                foreach ($files as $doc) : $n++
                            ?>
                                    <tr>
                                        <th scope="row"><?= $n; ?></th>
                                        <td><?= $doc->nama_file; ?></td>
                                        <td><?= Size($doc->ukuran_file); ?></td>
                                        <td><?= $sts[$doc->status_approve]; ?></td>
                                        <td><?= $doc->approval_on; ?></td>
                                        <td><?= $doc->revisi; ?></td>
                                        <td><?= $sts[$doc->status_revisi]; ?></td>
                                        <td><?= $doc->nm_lengkap; ?></td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="<?= $doc->id; ?>" data-file="<?= $doc->nama_file; ?>" data-table="gambar1" class="view btn btn-icon btn-warning btn-xs btn-shadow" title="View Dokumen"><i class="fa fa-eye"></i></a>
                                            <!-- <a href="javascript:void(0)" tooltip="qtip" onclick="location.href = siteurl+'dokumen/download_detail1/<?= $doc->id; ?>'" data-id="<?= $doc->id; ?>" data-file="<?= $doc->nama_file; ?>" data-table="gambar1" class="download btn btn-icon btn-info btn-xs btn-shadow ml-2" title="Download Dokumen"><i class="fa fa-download"></i></a> -->
                                            <a href="javascript:void(0)" tooltip="qtip" data-file="<?= $doc->nama_file ?>" data-id="<?= $doc->id ?>" data-table="gambar" class="btn btn-icon btn-primary btn-xs btn-shadow ml-2 edit" title="Revisi Dokumen"><i class="fa fa-pen"></i></a>
                                            <a href="javascript:void(0)" onclick="delete_file('<?= $doc->id ?>')" tooltip="qtip" data-table="gambar" class="download btn btn-icon btn-danger btn-xs btn-shadow ml-2" title="Hapus Dokumen"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <hr class="mt-5 mb-8">
                    <h4>Folder</h4>
                    <input type="hidden" id="id_master" value="<?= $id_master; ?>">
                    <div class="row">
                        <?php if ($folders) :
                            foreach ($folders as $data) :
                        ?>
                                <div class="col-lg-3 col-xl-2 col-md-3 col-sm-6 col-xs-6 m-0 px-2">
                                    <label ondblclick="location.href = base_url+active_controller+'subfolder/<?= $nama_master . '/' . str_replace(' ', '-', strtolower($data->deskripsi)); ?>'" data-id="<?= $data->id_master; ?>" class="h-99px p-0 btn btn-block btn-text-dark-50 btn-icon-primary font-weight-bold btn-hover-bg-secondary my-2 button-master">
                                        <i class="fa fa-folder" style="font-size:7rem;"></i><br>
                                        <input class="d-none" type="checkbox" data-id="<?= $data->id; ?>" data-name="<?= $data->deskripsi; ?>" name="folder[]" value="folder">
                                        <?= $data->deskripsi; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="d-flex justify-content-center col-md-12" style="padding:10rem 0">
                                <h5 class="text-muted">--Empty data--</h5>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 1360px !Important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="viewData"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#example1').DataTable({
        orderCellsTop: false,
        fixedHeader: true,
        scrollX: true,
        ordering: false,
        // info: false
    });

    function new_folder() {
        Swal.fire({
            title: 'Create Folder',
            html: `<input id='folder_name' required class='form-control ' name='new-folder' placeholder='New Folder'>
			<div id="feedback" class="invalid-feedback d-none">Mohon mengisi nama folder terlebih dahulu.</div>
			<style>
			.swal2-content{
				text-align:left;
			}
			</style>`,
            showCancelButton: true,
            confirmButtonText: 'Save',
            showLoaderOnConfirm: true,
            preConfirm: (create) => {
                let id_master = $('#id_master').val()
                let folder_name = $('#folder_name').val()
                if (folder_name == '') {
                    $('#folder_name').addClass('is-invalid');
                    $('#feedback').removeClass('d-none');
                    return false;
                } else {
                    // console.log(folder_name);
                    return $.ajax({
                        url: base_url + active_controller + 'add_subfolder',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id_master,
                            folder_name
                        },
                        success: function(res) {
                            // console.log(res)
                            if (res.status == '1') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Folder baru berhasil dibuat!',
                                }).then(function() {
                                    location.reload()
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan!',
                                    text: res.pesan
                                })
                            }
                        },
                        error: function(res) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi kesalahan!',
                                text: res.pesan
                            })
                        }
                    })
                }
            },
            allowOutsideClick: false,
        })
    }

    function add_file(id) {
        $("#viewData").html('');
        // console.log(id);
        $(".modal-title").html("Add File");
        $("#viewData").load(siteurl + active_controller + 'load_form/' + id);
        $("#ModalView").modal('show');
    }

    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).parents('label').removeClass('btn-bg-secondary');
        if ($box.is(":checked")) {
            $(group).prop("checked", false);
            $box.prop("checked", true);
            $box.parents('label').addClass('btn-bg-secondary');
            $('#btn-rename').attr('data-id', $(this).data('id'))
            $('#btn-rename').attr('data-name', $(this).data('name'))
            $('#btn-rename').prop('disabled', false)
            $('#btn-delete').attr('data-id', $(this).data('id'))
            $('#btn-delete').prop('disabled', false)
        } else {
            $box.prop("checked", false);
            $('#btn-rename').attr('data-id', '')
            $('#btn-rename').attr('data-name', '')
            $('#btn-rename').prop('disabled', true)
            $('#btn-delete').attr('data-id', '')
            $('#btn-delete').prop('disabled', true)
        }
    });

    function delete_folder() {
        let id = $('#btn-delete').data('id');
        // alert(id)
        console.log(id);
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to process again this data!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete!",
            cancelButtonText: "No",
        }).then((value) => {
            if (value.isConfirmed) {
                loading_spinner();
                $.ajax({
                    url: base_url + active_controller + 'delete_subfolder',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id
                    },
                    success: function(result) {
                        if (result.status == 1) {
                            Swal.fire({
                                title: "Success!",
                                text: result.msg,
                                icon: "success",
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: "Gagal!",
                                text: result.msg,
                                icon: "warning",
                                timer: 3000
                            })
                        }
                    },
                    error: function(result) {
                        Swal.fire({
                            title: "Error",
                            text: "Server Timeout!",
                            icon: "error",
                            timer: 3000
                        })
                    }
                })
            }

        })

    }

    function delete_file(id) {
        console.log(id);
        let table = 'gambar';
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to process again this data!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete!",
            cancelButtonText: "No",
        }).then((value) => {
            if (value.isConfirmed) {
                loading_spinner();
                $.ajax({
                    url: base_url + active_controller + 'delete_file',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id,
                        table
                    },
                    success: function(result) {
                        if (result.status == 1) {
                            Swal.fire({
                                title: "Success!",
                                text: result.msg,
                                icon: "success",
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: "Gagal!",
                                text: result.msg,
                                icon: "warning",
                                timer: 3000
                            })
                        }
                    },
                    error: function(result) {
                        Swal.fire({
                            title: "Error",
                            text: "Server Timeout!",
                            icon: "error",
                            timer: 3000
                        })
                    }
                })
            }

        })

    }

    $(document).on('click', '.view', function(e) {
        $("#viewData").html('');
        var id = $(this).data('id');
        var table = $(this).data('table');
        var file = $(this).data('file');
        loading_spinner();
        $.ajax({
            type: "post",
            url: siteurl + 'dokumen/history_revisi',
            data: "id=" + id + "&table=" + table + "&file=" + file,
            success: function(result) {
                // $(".modal-dialog").css('max-width', '1360px !important');
                $(".modal-title").html("<b>VIEW DATA</b>");
                $("#viewData").html(result);
                $("#ModalView").modal('show');
                Swal.close();
            }
        })
    })

    $(document).on('click', '.edit', function(e) {
        var id = $(this).data('id');
        var table = $(this).data('table');
        var file = $(this).data('file');
        $("#view").html('');
        $.ajax({
            type: "post",
            url: siteurl + active_controller + 'revisi/',
            data: {
                id,
                table,
                file
            },
            success: function(result) {
                // console.log(result);
                $(".modal-dialog").css('width', '90%');
                $("#head_title").html("<b>REVISI</b>");
                $("#viewData").html(result);
                $("#ModalView").modal('show');
            }
        })
    });

    function rename_folder() {
        let id = $('#btn-rename').data('id');
        let folder_name = $('#btn-rename').data('name');
        Swal.fire({
            title: 'Rename Folder',
            html: `<input id='folder_name' required class='form-control ' name='rename-folder' placeholder='New Folder' value='` + folder_name + `'>
			<div id="feedback" class="invalid-feedback d-none">Mohon mengisi nama folder terlebih dahulu.</div>
			<style>
			.swal2-content{
				text-align:left;
			}
			</style>`,
            showCancelButton: true,
            confirmButtonText: 'Save',
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            preConfirm: (create) => {
                let folder_name = $('#folder_name').val()
                if (folder_name == '') {
                    $('#folder_name').addClass('is-invalid');
                    $('#feedback').removeClass('d-none');
                    return false;
                } else {
                    console.log(folder_name);
                    return $.ajax({
                        url: base_url + active_controller + 'rename_subfolder',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id,
                            folder_name
                        },
                        success: function(res) {
                            console.log(res)
                            if (res.status == '1') {
                                Swal.fire({
                                    title: res.msg,
                                    icon: 'success',
                                    timer: 1500
                                }).then(function() {
                                    location.reload()
                                })
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    icon: 'warning',
                                    text: res.msg,
                                    timer: 1500
                                })
                            }
                        },
                        error: function(res) {
                            Swal.fire({
                                title: 'Error!',
                                icon: 'error',
                                text: res.msg,
                                timer: 3000
                            })
                        }
                    })
                }
            }

        })
    }
</script>