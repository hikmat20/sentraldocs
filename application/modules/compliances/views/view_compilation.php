<!-- HEADER -->
<div class="row mb-3">
  <div class="col-md-6">
    <h2 class="mb-4"><i class="fa fa-desktop"></i> Current Compliance Overview</h2>
    <table class="table table-striped table-bordered table-sm">
      <tr>
        <th width="150">Company</th>
        <td><?= $reference->nm_perusahaan; ?></td>
      </tr>
      <tr>
        <th>State</th>
        <td><?= $reference->status; ?></td>
      </tr>
      <tr>
        <th>Created On</th>
        <td><?= $reference->created_at; ?></td>
      </tr>
      <tr>
        <th>Last Review</th>
        <td></td>
      </tr>
      <tr>
        <th>Count Review</th>
        <td></td>
      </tr>
      <tr>
        <th>Review By</th>
        <td></td>
      </tr>
    </table>
  </div>
  <div class="col-md-6">
    <h2 class="mb-4"><i class="fa fa-stream"></i> Summary Overview</h2>
    <table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <th>Compliance</th>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th>Not Compliance</th>
          <td class="text-center"></td>
        </tr>
        <tr>
          <th>Not Applicable</th>
          <td class="text-center"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <th>Total</th>
          <th class="text-center"></th>
        </tr>
        <tr>
          <th>% Compliance</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

<!-- <hr> -->
<div class="row">
  <div class="col-md-12">
    <div class="mb-3">
      <div class="row">
        <label for="" class="col-1 form-control-label">Sort by :</label>
        <div class="w-25">
          <select name="sort_status" id="sort_status" class="select2 form-control">
            <option value="">Show All</option>
            <option value="CMP">Compliance</option>
            <option value="NCM">Not Compliance</option>
            <option value="NAP">Not Applicable</option>
          </select>
        </div>
        <button type="button" id="show" class="btn btn-sm btn-primary mx-2">Show</button>
        <button type="button" id="export_pdf" class="btn btn-sm btn-light"><i class="fa fa-file-pdf"></i> Export PDF</button>
      </div>
    </div>

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

<script>
  $('.select2').select2({
    allowClear: true,
    placeholder: "Show All",
    dropdownParent: $('#modalView')
  })
</script>