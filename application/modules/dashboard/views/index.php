<div class="content d-flex flex-column flex-column-fluid p-0">
	<div class="d-flex flex-column-fluid justify-content-between align-items-top">
		<div class="container mt-5">
			<!-- <div class="row pb-10">
				<div class="col-md-6 offset-3">
					<div class="my-10">
						<input type="text" class="form-control h2 text-center shadow-lg bg-transparent text-white" placeholder="Pencarian" style="border-radius: 20px 1px 20px 1px  ;">
					</div>
				</div>
			</div> -->

			<h1 class="text-white mb-5 mt-0 pt-0 font-weight-bolder bg-white-o-0 rounded-lg px-10 py-5">PUBLUSHED DOCUMENTS</h1>
			<div class="row justify-content-center">
				<div class="col-md-10 mb-10">
					<div class="row">
						<div class="col-md-2 col-md-3 mb-lg-5">
							<div class="card border-0 shadow-lg " style="border-radius: 30px 5px 30px 5px;background-color: rgba(255, 255, 255, 0.50);">
								<div class="card-body pb-1 d-flex justify-content-center align-items-center" style="min-height: 120px;">
									<img src="<?= base_url('assets/images/dashboard/prosedur.png'); ?>" alt="List Procedure" class="img-fluid" style="height: 150px;">
								</div>
								<h6 class="card-title text-center pt-0 px-4 pb-5 m-0" style="min-height: 60px;">
									<a href="<?= base_url('/list/procedures/'); ?>" class="text-hover-primary" title="PROSEDUR, FORM, IK DAN RECORDS">
										<span class="card-label m-0 text-dark text-center font-weight-bolder">PROSEDUR, FORM, IK DAN RECORD</span>
									</a>
								</h6>
							</div>
						</div>

						<!-- <div class="col-md-2 col-md-3 px-5">
							<div class="card border-0 shadow-lg " style="border-radius: 30px 5px 30px 5px;background-color: rgba(255, 255, 255, 0.50);">
								<div class="card-body pb-1 d-flex justify-content-center align-items-center" style="min-height: 120px;">
									<img src="<?= base_url('assets/images/dashboard/manual-peraturan.png'); ?>" alt="MANUAL DAN PERATURAN PERUSAHAAN" class="img-fluid" style="height: 150px;">
								</div>
								<h6 class="card-title text-center pt-0 px-4 pb-5 m-0" style="min-height: 60px;">
									<a href="<?= base_url('/list/manual_peraturan'); ?>" class="text-hover-primary" title="MANUAL DAN PERATURAN PERUSAHAAN">
										<span class="card-label m-0 text-dark text-center font-weight-bolder">MANUAL DAN PERATURAN PERUSAHAAN</span>
									</a>
								</h6>
							</div>
						</div> -->

						<?php foreach ($Data as $dt) : ?>
							<div class="col-md-3 px-5">
								<div class="card border-0 shadow-lg " style="border-radius: 30px 5px 30px 5px;background-color: rgba(255, 255, 255, 0.50);">
									<div class="card-body pb-1 d-flex justify-content-center align-items-center" style="min-height: 120px;">
										<img src="<?= base_url('assets/images/dashboard/' . $dt->picture); ?>" alt="<?= $dt->name; ?>" class="img-fluid" style="height: 150px;">
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
			</div>
			<!-- <h1 class="text-white mb-5 mt-0 pt-0 font-weight-bolder bg-white-o-0 rounded-lg px-10 py-5">RECENT ACTIVITY</h1>
			<div class="container justify-content-center">
				<div class="card">
					<div class="card-body">
						<table class="table table-sm table-condensed">
							<thead>
								<tr>
									<th>Recent Documents</th>
									<th width="200" class="text-center">Category</th>
									<th width="200" class="text-center">Last Update</th>
									<th width="150" class="text-center">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php if ($RecentFiles) : ?>
									<?php foreach ($RecentFiles as $rf) : ?>
										<tr>
											<td><strong><?= $rf->name; ?></strong></td>
											<td></td>
											<td class="text-center"><strong><?= $rf->created_at; ?></strong></td>
											<td class="text-center"><strong><?= $rf->status; ?></strong></td>
										</tr>
								<?php endforeach;
								endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div> -->
		</div>
	</div>