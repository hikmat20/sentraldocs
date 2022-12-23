<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <div class="d-flex flex-column-fluid">
    <div class="container">
      <div class="card card-stretch shadow card-custom">
        <div class="card-body">
          <div class="mb-3 row flex-nowrap">
            <label for="Name" class="col-2 col-form-label font-weight-bold">Company Name</label>
            <div class="col-9">
              : <label class="col-form-label font-weight-bold"><?= $data->nm_perusahaan; ?></label>
            </div>
          </div>

          <div id="accordianId" role="tablist" aria-multiselectable="true">
            <div class="card">
              <div class="card-header" role="tab" id="section1HeaderId">
                <h5 class="mb-0">
                  <a data-toggle="collapse" data-parent="#accordianId" href="#section1ContentId" aria-expanded="true" aria-controls="section1ContentId">
                    Section 1
                  </a>
                </h5>
              </div>
              <div id="section1ContentId" class="collapse in" role="tabpanel" aria-labelledby="section1HeaderId">
                <div class="card-body">
                  Section 1 content
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>