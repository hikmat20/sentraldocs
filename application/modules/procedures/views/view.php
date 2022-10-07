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
        </tbody>
      </table>
      <table class="table table-bordered">
        <thead>
          <tr class="table-secondary">
            <th colspan="4">
              <h4>DETAIL FLOW PROCEDURE</h4>
            </th>
          </tr>
          <tr>
            <th class="text-center">No.</th>
            <th class="text-center">PIC/TANGGUNG JAWAB</th>
            <th class="text-center">DESKRIPSI</th>
            <th class="text-center">DOKUMEN TERKAIT</th>
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
          endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>