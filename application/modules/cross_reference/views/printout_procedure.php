<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $procedure->name ; ?></title>
  <style>
    /* *,
    body {
      font-family: Tahoma, Helvetica, sans-serif !important;
    } */

    table.table-data {
      width: 100%;
    }

    table.table-data td,
    table.table-data th {
      padding: 2px;
      word-wrap: break-word;
      border: 1px solid #444
    }

    table,
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
    <h1 class="text-center"><?= $procedure->name; ?></h1>
    <h3><strong>TUJUAN</strong></h3>
    <table>
      <tr>
        <td>
          <div class="">
            <?= ($procedure->object); ?>
          </div>
        </td>
      </tr>
    </table>
    <br>

    <h3><strong>RUANG LINGKUP</strong></h3>
    <table class="">
      <tr>
        <td>
          <div class="">
            <?= $procedure->scope; ?>
          </div>
        </td>
      </tr>
    </table>
    <br>

    <h3><strong>DEFINISI</strong></h3>
    <table>
      <tr>
        <td>
          <div class="">
            <?= $procedure->define; ?>
          </div>
        </td>
      </tr>
    </table>
    <br>

    <h3><strong>PERFORMA INDIKATOR</strong></h3>
    <table>
      <tr>
        <td>
          <div class="">
            <?= $procedure->performance; ?>
          </div>
        </td>
      </tr>
    </table>
    <br>

    <h3>REFERENSI</h3>
    <table>
      <tbody>
        <tr>
          <td>
            <?php if ($ArrStd) : ?>
              <?php foreach ($ArrStd as $std) : ?>
                <h3><?= $std->name; ?></h3>
                <ul>
                  <?php if ($ArrData['standards'][$std->requirement_id]) : ?>
                    <?php $n = 0;
                    foreach ($ArrData['standards'][$std->requirement_id] as $dtStd) : $n++; ?>
                      <li><?= $dtStd->chapter; ?></li>
                  <?php endforeach;
                  endif; ?>
                </ul>
                <br>
              <?php endforeach; ?>
            <?php else : ?>
              <div class="text-center">~ Not available data ~</div>
            <?php endif; ?>
          </td>
        </tr>
      </tbody>
    </table>
    <br>

    <h3>FLOW PROCEDURE</h3>
    <table>
      <tbody>
        <?php if ($procedure->image_flow_1 || $procedure->image_flow_2 || $procedure->image_flow_3) : ?>
          <?php if ($procedure->image_flow_1) : ?>
            <tr>
              <td>
                <img height="600px" src="<?= base_url("directory/FLOW_IMG/$procedure->company_id/$procedure->image_flow_1"); ?>" alt="image_flow_1" class="img-fluid">
              </td>
            </tr>
          <?php endif; ?>
          <?php if ($procedure->image_flow_2) : ?>
            <tr>
              <td>
                <img height="600px" src="<?= base_url("directory/FLOW_IMG/$procedure->company_id/$procedure->image_flow_2"); ?>" alt="image_flow_2" class="img-fluid">
              </td>
            </tr>
          <?php endif; ?>
          <?php if ($procedure->image_flow_3) : ?>
            <tr>
              <td>
                <img height="600px" src="<?= base_url("directory/FLOW_IMG/$procedure->company_id/$procedure->image_flow_3"); ?>" alt="image_flow_3" class="img-fluid">
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
    <table class="table-data" style="font-size: 11px;">
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
                  <ul>
                    <?php foreach ($relDocs as $relDoc) { ?>
                      <li><?= $ArrForms[$relDoc]->name; ?></li>
                    <?php } ?>
                  </ul>

                  <?php $relIk = json_decode($dtl->relate_ik_doc); ?>
                  <?php if (is_array($relIk)) : ?>
                    <ul>
                      <?php foreach ($relIk as $ik) { ?>
                        <li><?= $ArrGuides[$ik]->name; ?></li>
                      <?php } ?>
                    </ul>
                  <?php endif; ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach;
        else : ?>
          <tr>
            <td colspan=" 4" class="text-center">~ Not available data ~</td>
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
        <td><?= ($procedure->reviewer_id) ? $ArrJab[$procedure->reviewer_id]->name : '-'; ?></td>
      </tr>
      <tr>
        <td><?= ($procedure->reviewed_by) ? $ArrUsr[$procedure->reviewed_by]->full_name : '-'; ?></td>
      </tr>
      <tr>
        <td class="text-left" style="vertical-align: middle;" rowspan="2">Approval By</td>
        <td><?= ($procedure->approval_id) ? $ArrJab[$procedure->approval_id]->name : '-'; ?></td>
      </tr>
      <tr>
        <td><?= ($procedure->approved_by) ? $ArrUsr[$procedure->approved_by]->full_name : '-'; ?></td>
      </tr>
      <tr>
        <td class="text-left" style="vertical-align: middle;">Distribution By</td>
        <td>
          <?php $lsJab = explode(',', $procedure->distribute_id);
          foreach ($lsJab as $jab) {
            echo ($jab) ? $ArrJab[$jab]->name . "<br>" : '-';
          }
          ?>
        </td>
      </tr>
    </table>
  </div>
</body>

</html>