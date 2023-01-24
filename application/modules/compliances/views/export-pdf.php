<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemenuhan Regulasi <?= $ArrReg[0]->nm_perusahaan; ?></title>
  <style>
    *,
    body {
      margin: 0px;
      padding: 0px;
    }

    table.table-data {
      width: 100%;
      font-size: 10px;
    }

    table.table-data-no-border {
      width: 100%;
      font-size: 10px;
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

    .bg-red {
      background-color: red;
    }
  </style>

</head>

<body>
  <div class="text-center">
    <h2><strong>IDENTIFIKASI DAN EVALUASI KEWAJIBAN PENAATAN</strong></h2>
  </div>

  <!-- HEADER -->
  <table class="table-data-no-border">
    <tr>
      <th width="100" class="text-left">Company</th>
      <td>: <?= $reference->nm_perusahaan; ?></td>
      <th width="100" class="text-left">State</th>
      <td>: <?= $reference->status; ?></td>
      <th width="100" class="text-left">Created On</th>
      <td width="100">: <?= $reference->sdate; ?></td>
    </tr>
    <tr>
      <th class="text-left">Last Review</th>
      <td>: <?= $reference->last_review; ?></td>
      <th class="text-left">Count Review</th>
      <td>: <?= $reference->counter_review; ?></td>
      <th class="text-left">Review By</th>
      <td>: <?= $ArrUsers[$reference->review_by]; ?></td>
    </tr>
  </table>
  <br>
  <table class="table-data-no-border">
    <tbody>
      <tr>
        <th width="100" class="text-left">Compliance</th>
        <td class="text-left">: <?= $summary['TC']; ?></td>
      </tr>
      <tr>
        <th class="text-left">Not Compliance</th>
        <td class="text-left">: <?= $summary['TNC']; ?></td>
      </tr>
      <tr>
        <th class="text-left">Not Applicable</th>
        <td class="text-left">: <?= $summary['TNA']; ?></td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <th class="text-left">% Compliance</th>
        <th class="text-left">:
          <?=
          ($summary['TC'] != 0 || $summary['TC'] != '') ? round(($summary['TC'] / ($summary['TC'] + $summary['TNC'])) * 100) : 0; ?>%</th>
      </tr>
    </tfoot>
  </table>
  <!-- <hr> -->
  <br>
  <table class="table-data" style="font-size: 10px;">
    <thead>
      <tr class="">
        <th class="text-center" width="30">No.</th>
        <th class="text-center">JENIS PERATURAN</th>
        <th class="text-center">PASAL/TOPIK</th>
        <th class="text-center">KONDISI AKTUAL</th>
        <th class="text-center">STATUS</th>
        <th class="text-center">PELUANG/RESIKO</th>
        <th class="text-center">TINDAKAN</th>
        <th class="text-center">PIC</th>
        <th class="text-center">DUE DATE</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $compl = $not_compl = $not_apl = $total = $percent = $allReg = 0;
      if ($ArrReg) : ?>
        <?php foreach ($ArrReg as $key => $rg) : ?>
          <?php $n = 0;
          $allReg = count($rg);
          foreach ($rg as $j => $dt) : $n++; ?>
            <tr>
              <?php if ($j == '0') : ?>
                <td class="text-center" rowspan="<?= count($rg); ?>"><?= $n; ?></td>
              <?php endif; ?>
              <?php if ($j == '0') : ?>
                <td width="200" rowspan="<?= count($rg); ?>">
                  <p><strong><?= $dt->category_name; ?></strong></p>
                  <p><?= $dt->about; ?></p>
                </td>
              <?php endif; ?>
              <td width="300">
                <strong><?= $dt->pasal_name; ?></strong>
                <br>
                (<?= $dt->ayat; ?>) <?= $dt->description_ayat; ?>
              </td>
              <td><?= $dt->compliance_desc; ?></td>
              <td class="text-center <?= ($dt->status == 'NCM') ? 'bg-red' : ''; ?>"><?= $status[$dt->status]; ?></td>
              <td style=" padding:0px;margin:0px;" width="100">
                <?php if (isset($ArrOpports[$dt->prgh_id])) :
                  foreach ($ArrOpports[$dt->prgh_id] as $opr) :
                ?>
                    <ol>
                      <li><?= $cat[$opr->category]; ?></li>
                    </ol>
                  <?php endforeach; ?>
                <?php endif; ?>
              </td>
              <td style="padding:0px;margin:0px;" width="100">
                <?php if (isset($ArrOpports[$dt->prgh_id])) :
                  foreach ($ArrOpports[$dt->prgh_id] as $opr) :
                ?>
                    <ol>
                      <li><?= $opr->description_opports; ?></li>
                    </ol>
                  <?php endforeach; ?>
                <?php endif; ?>
              </td>
              <td style="padding:0px;margin:0px;" width="100">
                <?php if (isset($ArrOpports[$dt->prgh_id])) :
                  foreach ($ArrOpports[$dt->prgh_id] as $opr) :
                ?>
                    <ol>
                      <li><?= $ArrUsers[$opr->pic]; ?></li>
                    </ol>
                  <?php endforeach; ?>
                <?php endif; ?>
              </td>
              <td style="padding:0px;margin:0px;" width="100">
                <?php if (isset($ArrOpports[$dt->prgh_id])) :
                  foreach ($ArrOpports[$dt->prgh_id] as $opr) :
                ?>
                    <ol>
                      <li><?= $opr->due_date; ?></li>
                    </ol>
                  <?php endforeach; ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

</body>

</html>