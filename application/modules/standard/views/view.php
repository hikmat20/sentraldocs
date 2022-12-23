<h1 class="text-center px-10 mb-10"><?= $Data->name; ?></h1>
<hr>
<?php if (isset($Pasal)) : ?>
  <?php foreach ($Pasal as $psl) : ?>
    <h3 class="text-center mb-10 font-weight-bolder"><u><?= $psl->name; ?></u></h3>
    <div class="col-9 m-auto">
      <table class="table table-sm table-borderless mb-10">
        <tbody>
          <?php if (isset($ArrDesc)) : $n = 0;
            foreach ($ArrDesc as $dsc) : $n++; ?>
              <tr>
                <td class="h4"><?= $n; ?></td>
                <td class="h4"><?= $dsc->description; ?></td>
              </tr>
          <?php endforeach;
          endif; ?>
        </tbody>
      </table>
    </div>
  <?php endforeach; ?>
<?php endif; ?>