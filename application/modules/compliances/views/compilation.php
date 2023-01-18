<!-- <hr> -->
<div class="row">
  <div class="col-md-12">
    <table class="table table-sm table-bordered" style="font-size:12px">
      <thead>
        <tr class="table-light">
          <th class="text-center" width="30">No.</th>
          <th class="text-center" width="150">REGULATION</th>
          <th class="text-center" width="350">PASAL</th>
          <th class="text-center" width="">COMPLIANCE DESC.</th>
          <th class="text-center" width="100">STATUS</th>
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
  </div>
</div>

<div class="text-center">
  <button type="button" class="btn btn-primary btn-lg w-250px" data-id="<?= $reference->id; ?>" id="process_compilation"><i class="fa fa-sync"></i>Process</button>
  <!-- <button type="button" class="btn btn-danger btn-lg w-150px"><i class="fa fa-times"></i>Cancel</button> -->
</div>

<script>
  $('.select2').select2({
    allowClear: true,
    placeholder: "Show All",
    dropdownParent: $('#modalView')
  })
</script>