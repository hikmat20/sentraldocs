<div class="content d-flex flex-column flex-column-fluid p-0">
	<div class="d-flex flex-column-fluid justify-content-between align-items-top">
		<div class="container mt-10">
			<div class="row pb-10">
				<div class="col-md-6 offset-3">
					<div class="my-10">
						<input type="text" class="form-control h2 text-center shadow-lg bg-transparent text-white" placeholder="Pencarian" style="border-radius: 20px 1px 20px 1px  ;">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 offset-1">
					<div class="row">
						<?php foreach ($Data as $dt) : ?>
							<div class="col-md-3 px-5">
								<div class="card border-2 border-warning shadow-lg " style="border-radius: 30px 5px 30px 5px;background-color: rgba(255, 255, 255, 0.60);">
									<div class="card-body pb-1 d-flex justify-content-center align-items-center" style="min-height: 190px;">
										<img src="<?= base_url('assets/images/dashboard/' . $dt->picture); ?>" alt="<?= $dt->name; ?>" class="img-fluid" style="width: 150px;">
									</div>
									<h6 class="card-title text-center pt-0 px-4 pb-5 m-0" style="min-height: 60px;">
										<a href="<?= base_url('/list/' . $dt->id); ?>" class="text-hover-primary" title="<?= $dt->name; ?>">
											<span class="card-label m-0 text-dark text-center font-weight-bolder"><?= $dt->name; ?></span>
										</a>
									</h6>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<!-- <div class="col-xl-6 col-sm-6 col-xs-12">
					<a href="<?= base_url('dashboard/create_documents') ?>" class="text-left btn btn-danger btn-md btn-block font-size-h2 py-5 mb-5 btn-shadow">
						<span class="svg-icon svg-icon-3x">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
									<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1" />
								</g>
							</svg>
						</span>
						Create Document</a>
				</div> -->
				<!-- <div class="col-xl-6 col-sm-6 col-xs-12">
					<a href="<?= base_url('dokumen') ?>" class="text-left btn btn-success btn-md btn-block font-size-h2 py-5 btn-shadow">
						<span class="svg-icon svg-icon-3x">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24" />
									<path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
									<path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" />
								</g>
							</svg>
						</span>
						Document List</a>
				</div>
			</div> -->
			</div>
		</div>
	</div>