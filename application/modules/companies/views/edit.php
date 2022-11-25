<form id="form-company">
  <div class="mb-3 row flex-nowrap">
    <label for="Name" class="col-3 col-form-label font-weight-bold">Company Name</label>
    <div class="col-9">
      <input type="hidden" name="id_perusahaan" id="" value="<?= $data->id_perusahaan; ?>">
      <input type="text" value="<?= $data->nm_perusahaan; ?>" name="nm_perusahaan" class="form-control" id="nm_perusahaan" placeholder="Company Name" />
      <span class="invalid-feedback">Company Name can't be empty</span>
    </div>
  </div>
  <div class="mb-3 row flex-nowrap">
    <label for="" class="col-3 col-form-label font-weight-bold">Address</label>
    <div class="col-9">
      <textarea type="text" name="alamat" id="alamat" class="form-control" placeholder="Jl. ..."><?= $data->alamat; ?></textarea>
      <span class="invalid-feedback">Address can't be empty</span>
    </div>
  </div>
  <div class="mb-3 row flex-nowrap">
    <label for="" class="col-3 col-form-label font-weight-bold">City</label>
    <div class="col-4">
      <input type="text" value="<?= $data->kota; ?>" name="kota" id="kota" class="form-control" placeholder="Jakarta">
      <span class="invalid-feedback">City can't be empty</span>
    </div>
  </div>
  <div class="mb-3 row flex-nowrap">
    <label for="" class="col-3 col-form-label font-weight-bold">Inisial</label>
    <div class="col-4">
      <input type="text" value="<?= $data->inisial; ?>" name="inisial" id="inisial" maxlength="3" class="form-control" placeholder="SSC">
      <span class="invalid-feedback">Inisial can't be empty</span>
    </div>
  </div>
</form>