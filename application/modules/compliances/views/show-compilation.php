<table class="table table-sm table-bordered" style="font-size:12px">
  <thead>
    <tr class="">
      <th class="text-center" width="30">No.</th>
      <th class="text-center" width="150">REGULATION</th>
      <th class="text-center" width="350">PASAL</th>
      <th class="text-center" width="">COMPLIANCE DESC.</th>
      <th class="text-center" width="100">STATUS</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($ArrReg) : ?>
      <?php foreach ($ArrReg as $key => $rg) : ?>
        <?php $n = 0;
        foreach ($rg as $j => $dt) : $n++; ?>
          <tr>
            <?php if ($j == '0') : ?>
              <th rowspan="<?= count($rg); ?>" class="text-center" style="vertical-align:middle;">
                <?= $n; ?>
              </th>
            <?php endif; ?>
            <?php if ($j == '0') : ?>
              <td rowspan="<?= count($rg); ?>" class="" style="vertical-align:middle;">
                <strong>
                  <p><?= $dt->category_name; ?></p>
                </strong>
                <p><?= $dt->about; ?></p>
              </td>
            <?php endif; ?>
            <td>
              <strong><?= $dt->pasal_name; ?></strong>
              <br>
              (<?= $dt->ayat; ?>) <?= $dt->description_ayat; ?>
            </td>
            <td><?= $dt->compliance_desc; ?></td>
            <td class="text-center"><?= ($dt->status) ? $status[$dt->status] : ''; ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>