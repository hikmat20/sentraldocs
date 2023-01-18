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
  </style>

</head>

<body>
  <div class="text-center">
    <h4>TITLE</h4>
    <hr>
  </div>

  <!-- HEADER -->
  <table class="table-data-no-border">
    <tr>
      <th width="50" class="text-left">
        No. Dok
      </th>
      <td>
        :
      </td>
      <th width="100" class="text-left">
        Tanggal Update
      </th>
      <td>
        :
      </td>
      <th width="50" class="text-left">
        Revisi
      </th>
      <td>
        :
      </td>
      <th width="100" class="text-left">
        Tanggal Efektif
      </th>
      <td>
        :
      </td>
    </tr>
    <tr>
      <th width="50" class="text-left">
        Disetujui
      </th>
      <td>
        :
      </td>
      <th width="100" class="text-left">
        Dibuat
      </th>
      <td>
        :
      </td>
      <th width="50" class="text-left">

      </th>
      <td>

      </td>
      <th width="100" class="text-left">

      </th>
      <td>

      </td>
    </tr>
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
          foreach ($rg as $j => $dt) : $n++;
            if ($dt->status == 'CMP') :
              $compl++;
            endif;
            if ($dt->status == 'NCM') :
              $not_compl++;
            endif;
            if ($dt->status == 'NAP') :
              $not_apl++;
            endif;
          ?>
            <tr>
              <td><?= $n; ?></td>
              <?php if ($j == '0') : ?>
                <th width="200" rowspan="<?= count($rg); ?>" class="" style="vertical-align:middle;">
                  <span class=""><?= $dt->category_name; ?></span>
                </th>
              <?php endif; ?>
              <td width="300">
                <strong><?= $dt->pasal_name; ?></strong>
                <br>
                (<?= $dt->ayat; ?>) <?= $dt->description_ayat; ?>
              </td>
              <td><?= $dt->compliance_desc; ?></td>
              <td class="text-center"><?= $status[$dt->status]; ?></td>
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

  <br>
  <br>
  <?php
  $total = $compl + $not_compl + $not_apl; ?>

  <table class="table-data" width="20%">
    <thead>
      <tr>
        <th colspan="2">STATUS PEMENUHAN</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Memenuhi</td>
        <td class="text-center"><?= $compl; ?></td>
      </tr>
      <tr>
        <td>Belum Memenuhi</td>
        <td class="text-center"><?= $not_compl; ?></td>
      </tr>
      <tr>
        <td>Tidak Teraplikasi</td>
        <td class="text-center"><?= $not_apl; ?></td>
      </tr>
    <tfoot>
      <tr>
        <th>Total Regulasi</th>
        <th class="text-center"><?= $allReg; ?></th>
      </tr>
      <?php

      $percent = ($total / $allReg) * 100; ?>
      <tr>
        <th>% Pemenuhan</th>
        <th><?= $percent; ?>%</th>
      </tr>
    </tfoot>
    </tbody>
  </table>
</body>

</html>