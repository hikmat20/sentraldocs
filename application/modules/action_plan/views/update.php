<form id="form">
  <div class="card border-0 rounded-lg mb-3" style="box-shadow: 2px 2px 6px #eaeaea;">
    <div class="card-body py-3">
      <div class="row">
        <label for="Name" class="col-3 font-weight-bolder">Company Name</label>
        <div class="col-9">:
          <input type="hidden" name="id" id="id" value="<?= $data->id; ?>">
          <label for="" class="font-weight-bolder"><?= $compliance->nm_perusahaan; ?></label>
        </div>
      </div>
    </div>
  </div>

  <div class="card border-0 rounded-lg mb-3" style="box-shadow: 2px 2px 6px #eaeaea;">
    <div class="card-body py-3">
      <div class="row">
        <label for="Name" class="col-3 font-weight-bold">Pasal</label>
        <div class="col-9">:
          <label for=""><?= $data->pasal_name; ?></label>
        </div>
      </div>
      <div class="row">
        <label for="Name" class="col-3 font-weight-bold">Ayat</label>
        <div class="col-9">:
          <label for=""><?= $data->ayat_name; ?></label>
        </div>
      </div>
      <div class="row">
        <label for="Name" class="col-3 font-weight-bold">Deskripsi Pasal</label>
        <div class="col-9">:
          <label for=""><?= $data->description; ?></label>
        </div>
      </div>
    </div>
  </div>

  <div class="card border-0 rounded-lg mb-3" style="box-shadow: 2px 2px 6px #eaeaea;">
    <div class="card-body py-3">
      <div class="row">
        <label for="Name" class="col-3 font-weight-bold">Pemenuhan</label>
        <div class="col-9">:
          <label for=""><?= $data->description_opports; ?></label>
        </div>
      </div>

      <div class="row">
        <label for="Name" class="col-3 font-weight-bold">Kategori</label>
        <div class="col-9">:
          <label for=""><?= $cat[$data->category]; ?></label>
        </div>
      </div>
      <div class="row">
        <label for="Name" class="col-3 font-weight-bold">Deskrpisi</label>
        <div class="col-9">:
          <label for=""><?= $data->description_opports; ?></label>
        </div>
      </div>
      <div class="row">
        <label for="Name" class="col-3 font-weight-bold">Rencana</label>
        <div class="col-9">:
          <label for=""><?= $data->action_plan; ?></label>
        </div>
      </div>
      <div class="row">
        <label for="Name" class="col-3 font-weight-bold">PIC</label>
        <div class="col-9">:
          <label for=""><?= $data->pic; ?></label>
        </div>
      </div>
      <div class="row">
        <label for="Name" class="col-3 font-weight-bold">Due Date</label>
        <div class="col-9">:
          <label for=""><?= $data->due_date; ?></label>
        </div>
      </div>
      <div class="row">
        <label for="Name" class="col-3 font-weight-bold">Status</label>
        <div class="col-9">
          <select name="status" class="form-control select2" data-placeholder="Choose an options" data-allow-clear="true" data-width="100%">
            <option value=""></option>
            <option value="OPN" <?= ($data->status == 'OPN') ? 'selected' : ''; ?>>OPEN</option>
            <option value="PRO" <?= ($data->status == 'PRO') ? 'selected' : ''; ?>>PROGRESS</option>
            <option value="CNL" <?= ($data->status == 'CNL') ? 'selected' : ''; ?>>CANCEL</option>
            <option value="DNE" <?= ($data->status == 'DNE') ? 'selected' : ''; ?>>DONE</option>
          </select>
        </div>
      </div>
    </div>
  </div>

</form>

<script>
  $(document).ready(function() {
    $('.select2').select2()
  })
</script>