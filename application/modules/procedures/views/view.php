<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="d-flex flex-column-fluid">
    <div class="container">
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
      <table class="table table-bordered mb-6">
        <thead>
          <tr class="table-secondary">
            <th>
              <h3>FLOW PROCEDURE</h3>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php if ($data->image_flow_1 || $data->image_flow_2 || $data->image_flow_3) : ?>
            <?php if ($data->image_flow_1) : ?>
              <tr>
                <td>
                  <img src="<?= base_url("/image_flow/$data->image_flow_1"); ?>" alt="image_flow_1" class="img-fluid">
                </td>
              </tr>
            <?php endif; ?>
            <?php if ($data->image_flow_2) : ?>
              <tr>
                <td>
                  <img src="<?= base_url("/image_flow/$data->image_flow_2"); ?>" alt="image_flow_2" class="img-fluid">
                </td>
              </tr>
            <?php endif; ?>
            <?php if ($data->image_flow_3) : ?>
              <tr>
                <td>
                  <img src="<?= base_url("/image_flow/$data->image_flow_3"); ?>" alt="image_flow_3" class="img-fluid">
                </td>
              </tr>
            <?php endif; ?>
          <?php else : ?>
            <tr>
              <td class="text-center">~ Not available data ~</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
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
                        <td class=""><?= $dtl->relate_doc; ?></td>
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