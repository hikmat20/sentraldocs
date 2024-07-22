<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="d-flex flex-column-fluid">
    <div class="container">
      <div class="card card-stretch shadow card-custom">
        <div class="card-header">
          <h2 class="mt-5"><i class="<?= $icon; ?> mr-2"></i><?= $title; ?></h2>
          <div class="mt-4 float-right ">
            <button type="button" onclick="history.go(-1)" class="btn btn-danger"><i class="fa fa-reply"></i>Back</button>
          </div>
        </div>
        <div class="card-body">
          <form id="form-audit">
            <?php if (isset($audit) && $audit) : ?>
              <input type="hidden" name="id" value="<?= $audit->id; ?>">
            <?php endif; ?>
            <input type="hidden" name="checklist_id" value="<?= $cklst->id; ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-2 row">
                  <label for="" class="d-none" id="procedure_id"><?= $cklst->procedure_id; ?></label>
                  <label for="" class="col-md-4 h6 font-weight-bold">Procedure</label>
                  <label for="" class="col h6">: <?= isset($cklst->name) ? $cklst->name : ''; ?></label>
                </div>
                <div class="mb-2 row">
                  <label for="" class="col-md-4 h6 font-weight-bold">Date</label>
                  <label for="" class="col h6">
                    <input type="date" class="form-control required w-md-200px" name="date" value="<?= (isset($audit) && $audit) ? $audit->date : ''; ?>" id="date">
                  </label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-2 row">
                  <label for="" class="col-md-4 h6 font-weight-bold">Auditor</label>
                  <div for="" class="col h6">
                    <select name="auditor[]" class="form-control select2" data-placeholder="Select Auditor" data-allow-clear="true" data-width="100%" multiple id="auditor">
                      <option value=""></option>
                      <?php if ($users) foreach ($users as $a) : ?>
                        <option value="<?= $a->id_user; ?>" <?= ($audit && $audit->auditor) ? (in_array($a->id_user, json_decode($audit->auditor)) ? 'selected' : '') : ''; ?>><?= $a->full_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="mb-2 row">
                  <label for="" class="col-md-4 h6 font-weight-bold">Auditee</label>
                  <div for="" class="col h6">
                    <select name="auditee[]" class="form-control select2" data-placeholder="Select Auditee" data-allow-clear="true" data-width="100%" multiple id="auditee">
                      <?php if ($users) foreach ($users as $a) : ?>
                        <option value="<?= $a->id_user; ?>" <?= ($audit && $audit->auditee) ? (in_array($a->id_user, json_decode($audit->auditee)) ? 'selected' : '') : ''; ?>><?= $a->full_name; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="load_data mb-10">
              <div class="accordion" id="accordionExample">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h4 class="mb-0 p-5" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      List Standard
                    </h4>
                  </div>

                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      <?php if ($ArrStd) : ?>
                        <?php foreach ($ArrStd as $std) : ?>

                          <h3>Standard : <?= $std->name; ?></h3>
                          <table class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th width="100">Pasal</th>
                                <th>Desc. Indonesian</th>
                                <th>Desc. English</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if ($ArrData['standards'][$std->requirement_id]) : ?>
                                <?php $n = 0;
                                foreach ($ArrData['standards'][$std->requirement_id] as $dtStd) : $n++; ?>

                                  <tr>
                                    <td><?= $n; ?></td>
                                    <td><?= $dtStd->chapter; ?>
                                    </td>
                                    <td>
                                      <?= limit_text(strip_tags($dtStd->desc_indo), 100) . ' <a href="javascript:void(0)" class="link read" data-id="' . $dtStd->chapter_id . '">[read]</a>'; ?>
                                    </td>
                                    <td>
                                      <?= limit_text(strip_tags($dtStd->desc_eng), 100) . ' <a href="javascript:void(0)" class="link read" data-id="' . $dtStd->chapter_id . '">[read]</a>'; ?>
                                    </td>
                                  </tr>
                              <?php endforeach;
                              endif; ?>
                            </tbody>
                          </table>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <div class="text-center">~ Not available data ~</div>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- CHECKLIT TEMUAN -->
            <h4 class="card-title mb-3"><i class="fa fa-check-circle text-primary" aria-hidden="true"></i> Checklist</h4>
            <table id="tblChecklist" class="table table-sm table-bordered table-condensed table-hover">
              <thead class="table-light">
                <tr class="text-center">
                  <th width="30">No</th>
                  <th class="">Checklist</th>
                  <th class="w-md-400px">Temuan</th>
                  <th width="150">Kategori</th>
                  <th width="150">ISO</th>
                  <th width="250">Pasal</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($checklist) foreach ($checklist as $n => $v) : $n++; ?>
                  <tr>
                    <td class="text-center"><?= $n; ?>
                      <?php if (isset($ArrDtl)) : ?>
                        <input type="hidden" name="detail[<?= $n; ?>][id]" value="<?= $ArrDtl[$v->id]->id; ?>">
                      <?php endif; ?>
                    </td>
                    <td class="bg-light">
                      <input type="hidden" name="detail[<?= $n; ?>][checklist_detail_id]" value="<?= $v->id; ?>">
                      <?= $v->description; ?>
                    </td>
                    <td>
                      <textarea name="detail[<?= $n; ?>][description]" id="description_<?= $n; ?>" placeholder="Description" class="form-control summernote required description"><?= isset($ArrDtl)?$ArrDtl[$v->id]->description:''; ?></textarea>
                      <label class="invalid-feedback">This value not be empty</label>
                    </td>
                    <td>
                      <select name="detail[<?= $n; ?>][category]" data-row="<?= $n; ?>" id="category_<?= $n; ?>" class="form-control required select2" data-minimum-results-for-search="Infinity" data-placeholder="Kategori" data-allow-clear="true" data-width="100%">
                        <option value=""></option>
                        <option value="0" <?= (isset($ArrDtl) && ($ArrDtl[$v->id]->category == '0')) ? 'selected' : ''; ?>>OK</option>
                        <option value="1" <?= (isset($ArrDtl) && ($ArrDtl[$v->id]->category == '1')) ? 'selected' : ''; ?>>Minor</option>
                        <option value="2" <?= (isset($ArrDtl) && ($ArrDtl[$v->id]->category == '2')) ? 'selected' : ''; ?>>Major</option>
                        <option value="3" <?= (isset($ArrDtl) && ($ArrDtl[$v->id]->category == '3')) ? 'selected' : ''; ?>>OFI</option>
                      </select>
                    </td>
                    <td>
                      <select name="detail[<?= $n; ?>][standard]" data-row="<?= $n; ?>" id="standard_<?= $n; ?>" data-minimum-results-for-search="Infinity" class="form-control select2 required standard" data-placeholder="Standard" data-allow-clear="true" data-width="100%">
                        <option value=""></option>
                        <?php if ($ArrStd) foreach ($ArrStd as $k => $s) : ?>
                          <option value="<?= $s->requirement_id; ?>" <?= (isset($ArrDtl) && ($ArrDtl[$v->id]->standard == $s->requirement_id)) ? "selected" : ''; ?>><?= $s->name; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td>

                      <select name="detail[<?= $n; ?>][pasal]" data-row="<?= $n; ?>" id="pasal_<?= $n; ?>" class="form-control required select2" data-placeholder="Pasal" data-allow-clear="true" data-width="100%">
                        <option></option>
                        <?php if (isset($ArrDtl)) :
                          if (isset($ArrDtlStd[$ArrDtl[$v->id]->standard])) foreach ($ArrDtlStd[$ArrDtl[$v->id]->standard] as $k => $s) : ?>
                            <option value="<?= $s->id; ?>" <?= ($ArrDtl[$v->id]->pasal == $s->id) ? "selected" : ''; ?>><?= $s->chapter; ?></option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      </select>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <div class="text-center">
              <button type="submit" class="btn btn-info w-100px btn-lg" id="save"><i class="fa fa-save" aria-hidden="true"></i>Save</button>
            </div>
          </form>
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
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <span class="btn-close cursor-pointer" data-dismiss="modal" aria-label="Close">
          <div class="fa fa-times"></div>
        </span>
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
    $(document).on('change', '.standard', function() {
      const r = $(this).data('row')
      const std = $(this).val()
      const pro = $('#procedure_id').text()
      $('#pasal_' + r).html('')
      if (std && pro) {
        $.ajax({
          url: siteurl + active_controller + "listPasal/" + pro + "/" + std,
          type: 'GET',
          success: (res) => {
            $('#pasal_' + r).html(res)
            console.log(r);
          },
          error: () => {
            alert('Data not valid!')
          }
        })
      }
    })


    $(document).on('submit', '#form-audit', function(e) {
      e.preventDefault();
      let btn = $('#save')

      let valid = getValidation('#form-audit')
      let formdata = new FormData($(this)[0])

      if (valid) {
        Swal.fire({
          title: 'Confirmation!',
          icon: 'question',
          text: 'Are you sure to save this data?',
          showCancelButton: true,
        }).then((value) => {
          if (value.isConfirmed) {
            $.ajax({
              url: siteurl + active_controller + 'saveAudit',
              data: formdata,
              type: 'POST',
              dataType: 'JSON',
              processData: false,
              contentType: false,
              cache: false,
              beforeSend: function() {
                btn.attr('disabled', true).html('<i class="spinner spinner-border-sm mr-2"></i> Loading...')
              },
              complete: function() {
                btn.attr('disabled', false).html('<i class="fa fa-save"></i>Save')
              },
              success: function(result) {
                if (result.status == 1) {
                  Swal.fire({
                    title: 'Success!',
                    icon: 'success',
                    text: result.msg,
                    timer: 3000
                  }).then(function() {
                    location.reload();
                  })
                } else {
                  Swal.fire({
                    title: 'Warning!',
                    icon: 'warning',
                    text: result.msg,
                    timer: 3000
                  })
                }
              },
              error: function(result) {
                Swal.fire({
                  title: 'Error!',
                  icon: 'error',
                  text: 'Server timeout, becuase error!',
                  timer: 3000
                })
              }
            })
          }
        })
      }
    })
  })
</script>