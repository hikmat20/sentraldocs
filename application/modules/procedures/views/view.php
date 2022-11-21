<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="d-flex flex-column-fluid">
    <div class="container">

      <!-- DEFINE -->
      <table class="table table-bordered rounded-lg mb-6">
        <tr>
          <th class="table-dark text-center">
            <h1><?= $data->name; ?></h1>
          </th>
        </tr>
        <tr>
          <td class="py-6">
            <h2 class="fw-extra-bold"><strong><u>Tujuan</u></strong></h2>
            <di class="font-size-h4">
              <?= $data->object; ?>
            </di>
          </td>
        </tr>
        <tr>
          <td class="py-6">
            <h2 class="fw-extra-bold"><strong><u>RUANG LINGKUP</u></strong></h2>
            <di class="font-size-h4">
              <?= $data->scope; ?>
            </di>
          </td>
        </tr>
        <tr>
          <td class="py-6">
            <h2 class="fw-extra-bold"><strong><u>DEFINISI</u></strong></h2>
            <di class="font-size-h4">
              <?= $data->define; ?>
            </di>
          </td>
        </tr>
        <tr>
          <td class="py-6">
            <h2 class="fw-extra-bold"><strong><u>Performa Indikator</u></strong></h2>
            <di class="font-size-h4">
              <?= $data->performance; ?>
            </di>
          </td>
        </tr>
      </table>

      <!-- SIPOCOR -->
      <table class="table table-bordered mb-6">
        <thead>
          <tr class="table-secondary">
            <th colspan="2">
              <h3>SIPOCOR</h3>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td width="50%">
              <label for="Supplier" class="font-weight-bold font-size-"><strong>1. Supplier</strong></label>
              <div class="">
                <?= $data->supplier; ?>
              </div>
            </td>
            <td>
              <label for="Input" class="font-weight-bold font-size-"><strong>2. Input</strong></label>
              <div class="">
                <?= $data->input; ?>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <label for="Proses" class="font-weight-bold font-size-"><strong>3. Proses</strong></label>
              <div class="">
                <?= $data->process; ?>
              </div>
            </td>
            <td>
              <label for="Output" class="font-weight-bold font-size-"><strong>4. Output</strong></label>
              <div class="">
                <?= $data->output; ?>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <label for="Customer" class="font-weight-bold font-size-"><strong>5. Customer</strong></label>
              <div class="">
                <?= $data->customer; ?>
              </div>
            </td>
            <td>
              <label for="Objective" class="font-weight-bold font-size-"><strong>6. Objective</strong></label>
              <div class="">
                <?= $data->objective; ?>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <label for="Risk" class="font-weight-bold font-size-"><strong>7. Risk</strong></label>
              <div class="">
                <?= $data->risk; ?>
              </div>
            </td>
            <td>
              <label for="mitigation" class="font-weight-bold font-size-"><strong>8. Mitigation</strong></label>
              <div class="">
                <?= $data->mitigation; ?>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- FLOW IMAGE -->
      <table class="table table-bordered mb-6">
        <thead>
          <tr class="table-secondary">
            <th>
              <h3>FLOW IMAGE</h3>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <?php if ($data->image_flow_1 || $data->image_flow_2 || $data->image_flow_3) : ?>
                <div class="d-flex justify-content-start align-items-center">
                  <?php if ($data->image_flow_1) : ?>
                    <div class="dropzone-wrapper mr-2 d-flex align-items-center" style="width: 200px;height:200px;border:1px solid #eaeaea">
                      <div class="dropzone-desc">
                        <?php if ($data->image_flow_1) : ?>
                          <img src="<?= base_url("image_flow/$data->image_flow_1"); ?>" alt="image_flow_1" class="img-fluid">
                        <?php endif; ?>
                      </div>
                      <?php if ($data->image_flow_1) : ?>
                        <div class="middle d-flex justify-content-center align-items-center">
                          <button type="button" class="btn btn-sm mr-1 btn-icon btn-default view-image rounded-circle"><i class="fa fa-search"></i></button>
                        </div>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>

                  <?php if ($data->image_flow_2) : ?>
                    <div class="dropzone-wrapper mr-2 d-flex align-items-center" style="width: 200px;height:200px;border:1px solid #eaeaea">
                      <div class="dropzone-desc">
                        <?php if ($data->image_flow_2) : ?>
                          <img src="<?= base_url("image_flow/$data->image_flow_2"); ?>" alt="image_flow_2" class="img-fluid">
                        <?php endif; ?>
                      </div>
                      <?php if ($data->image_flow_2) : ?>
                        <div class="middle d-flex justify-content-center align-items-center">
                          <button type="button" class="btn btn-sm mr-1 btn-icon btn-default view-image rounded-circle"><i class="fa fa-search"></i></button>
                        </div>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>

                  <?php if ($data->image_flow_3) : ?>
                    <div class="dropzone-wrapper mr-2 d-flex align-items-center" style="width: 200px;height:200px;border:1px solid #eaeaea">
                      <div class="dropzone-desc">
                        <?php if ($data->image_flow_3) : ?>
                          <img src="<?= base_url("image_flow/$data->image_flow_3"); ?>" alt="image_flow_3" class="img-fluid">
                        <?php endif; ?>
                      </div>
                      <?php if ($data->image_flow_3) : ?>
                        <div class="middle d-flex justify-content-center align-items-center">
                          <button type="button" class="btn btn-sm mr-1 btn-icon btn-default view-image rounded-circle"><i class="fa fa-search"></i></button>
                        </div>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                </div>
              <?php else : ?>
                <span class="text-center">~ Not available data ~</span>
              <?php endif; ?>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- VIDEO -->
      <table class="table table-bordered mb-6">
        <thead>
          <tr class="table-secondary">
            <th>
              <h3>VIDEO</h3>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php if ($data->link_video) : ?>
            <tr>
              <td class="text-center">
                <?= ($data->link_video); ?>
              </td>
            </tr>
          <?php else : ?>
            <tr>
              <td class="text-center">~ Not available data ~</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>

      <!-- FLOW DETAIL -->
      <table class="table table-bordered">
        <thead>
          <tr class="table-secondary">
            <th>
              <h3>FLOW DETAIL</h3>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <table class="table table-condensed table-sm table-bordered">
                <thead>
                  <tr class="table-secondary">
                    <th class="py-1 text-center">No.</th>
                    <th class="py-1 text-center">PIC/TANGGUNG JAWAB</th>
                    <th class="py-1 text-center">DESKRIPSI</th>
                    <th class="py-1 text-center">DOKUMEN TERKAIT</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($detail) :
                    foreach ($detail as $dtl) : ?>
                      <tr>
                        <td class="text-center"><?= $dtl->number; ?></td>
                        <td class="text-center"><?= $dtl->pic; ?></td>
                        <td><?= $dtl->description; ?></td>
                        <td class="">
                          <?php $relDocs = json_decode($dtl->relate_doc); ?>
                          <?php if (is_array($relDocs)) : ?>
                            <?php foreach ($relDocs as $relDoc) { ?>
                              <span class="badge bg-success btn btn-success view-form mb-1" data-id="<?= $relDoc; ?>"><?= $ArrForms[$relDoc]->name; ?></span>
                            <?php } ?>
                          <?php else : ?>
                            <?= $dtl->relate_doc; ?>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach;
                  else : ?>
                    <tr>
                      <td colspan="4" class="text-center">~ Not available data ~</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- DATA APPROVAL -->
      <table class="table table-bordered">
        <thead>
          <tr class="table-secondary">
            <th>
              <h3>DATA APPROVAL</h3>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <table class="table table-bordered table-sm">
                <tr>
                  <th width="180">Prepared By</th>
                  <td><?= ($data->reviewer_id) ? $ArrUsr[$data->prepared_by]->full_name : '-'; ?></td>
                </tr>
                <tr>
                  <th style="vertical-align: middle;" rowspan="2">Review By</th>
                  <td><?= ($data->reviewer_id) ? $ArrJab[$data->reviewer_id]->nm_jabatan : '-'; ?></td>
                </tr>
                <tr>
                  <td><?= ($data->reviewed_by) ? $ArrUsr[$data->reviewed_by]->full_name : '-'; ?></td>
                </tr>
                <tr>
                  <th style="vertical-align: middle;" rowspan="2">Approval By</th>
                  <td><?= ($data->approval_id) ? $ArrJab[$data->approval_id]->nm_jabatan : '-'; ?></td>
                </tr>
                <tr>
                  <td><?= ($data->approved_by) ? $ArrUsr[$data->approved_by]->full_name : '-'; ?></td>
                </tr>
                <tr>
                  <th style="vertical-align: middle;">Distribution By</th>
                  <td>
                    <?php $lsJab = explode(',', $data->distribute_id);
                    foreach ($lsJab as $jab) {
                      echo ($jab) ? $ArrJab[$jab]->nm_jabatan . "<br>" : '-';
                    }
                    ?>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>