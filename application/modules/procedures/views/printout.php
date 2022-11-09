<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Procedure</title>
  <style>
    table.table-data {
      width: 100%;
    }

    table.table-data td,
    table.table-data th {
      padding: 2px;
      word-wrap: break-word;
      border: 1px solid #444
    }

    table.table-data {
      border-collapse: collapse;
    }

    table td {
      vertical-align: top;
    }

    /* Horizontal */
    .text-center {
      text-align: center;
    }

    .text-left {
      text-align: left;
    }

    .text-right {
      text-align: right;
    }

    /* Vertical */
    .text-middle {
      vertical-align: middle;
    }

    .text-top {
      vertical-align: top;
    }

    .text-bottom {
      vertical-align: bottom;
    }

    /* Padding */
    .p-1 {
      padding: 1px;
    }

    .p-2 {
      padding: 2px;
    }

    .p-3 {
      padding: 3px;
    }

    .p-4 {
      padding: 4px;
    }

    .p-5 {
      padding: 5px;
    }
  </style>

</head>

<body>
  <div class="">
    <!-- HEADER -->
    <table class="">
      <tr>
        <th class="table-dark text-center">
          <h1><?= $procedure->name; ?></h1>
        </th>
      </tr>
      <tr>
        <td class="py-6">
          <h2 class="p-2"><strong><u>TUJUAN</u></strong></h2>
          <div class="">
            <?= $procedure->object; ?>
          </div>
        </td>
      </tr>
      <tr>
        <td class="py-6">
          <h2 class="p-2"><strong><u>RUANG LINGKUP</u></strong></h2>
          <div class="">
            <?= $procedure->scope; ?>
          </div>
        </td>
      </tr>
      <tr>
        <td class="py-6">
          <h2 class="p-2"><strong><u>DEFINISI</u></strong></h2>
          <div class="">
            <?= $procedure->define; ?>
          </div>
        </td>
      </tr>
      <tr>
        <td class="py-6">
          <h2 class="p-2"><strong><u>PERFORMA INDIKATOR</u></strong></h2>
          <div class="">
            <?= $procedure->performance; ?>
          </div>
        </td>
      </tr>
    </table>

    <br>
    <h3>FLOW PROCEDURE</h3>
    <table>
      <tbody>
        <?php if ($procedure->image_flow_1 || $procedure->image_flow_2 || $procedure->image_flow_3) : ?>
          <?php if ($procedure->image_flow_1) : ?>
            <tr>
              <td>
                <img height="600px" src="<?= base_url("/image_flow/$procedure->image_flow_1"); ?>" alt="image_flow_1" class="img-fluid">
              </td>
            </tr>
          <?php endif; ?>
          <?php if ($procedure->image_flow_2) : ?>
            <tr>
              <td>
                <img height="600px" src="<?= base_url("/image_flow/$procedure->image_flow_2"); ?>" alt="image_flow_2" class="img-fluid">
              </td>
            </tr>
          <?php endif; ?>
          <?php if ($procedure->image_flow_3) : ?>
            <tr>
              <td>
                <img height="600px" src="<?= base_url("/image_flow/$procedure->image_flow_3"); ?>" alt="image_flow_3" class="img-fluid">
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

    <!-- <br>
    <h3>VIDEO</h3>
    <table class="table-data">
      <thead>
        <tr class="table-secondary">
          <th class="text-left">
          </th>
        </tr>
      </thead>
      <tbody>
        <?php if ($procedure->link_video) : ?>
          <tr>
            <td class="text-center">
              <?= ($procedure->link_video); ?>
            </td>
          </tr>
        <?php else : ?>
          <tr>
            <td class="text-center">~ Not available data ~</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table> -->

    <br>
    <h3>FLOW DETAIL</h3>
    <table class="table-data">
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

    <br>
    <h3>DATA APPROVAL</h3>
    <table class="table-data">
      <tr>
        <td class="text-left" width="180">Prepared By</td>
        <td><?= ($procedure->reviewer_id) ? $ArrUsr[$procedure->prepared_by]->full_name : '-'; ?></td>
      </tr>
      <tr>
        <td class="text-left" style="vertical-align: middle;" rowspan="2">Review By</td>
        <td><?= ($procedure->reviewer_id) ? $ArrJab[$procedure->reviewer_id]->nm_jabatan : '-'; ?></td>
      </tr>
      <tr>
        <td><?= ($procedure->reviewed_by) ? $ArrUsr[$procedure->reviewed_by]->full_name : '-'; ?></td>
      </tr>
      <tr>
        <td class="text-left" style="vertical-align: middle;" rowspan="2">Approval By</td>
        <td><?= ($procedure->approval_id) ? $ArrJab[$procedure->approval_id]->nm_jabatan : '-'; ?></td>
      </tr>
      <tr>
        <td><?= ($procedure->approved_by) ? $ArrUsr[$procedure->approved_by]->full_name : '-'; ?></td>
      </tr>
      <tr>
        <td class="text-left" style="vertical-align: middle;">Distribution By</td>
        <td>
          <?php $lsJab = explode(',', $procedure->distribute_id);
          foreach ($lsJab as $jab) {
            echo ($jab) ? $ArrJab[$jab]->nm_jabatan . "<br>" : '-';
          }
          ?>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>