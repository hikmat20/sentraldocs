<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<div class="d-flex flex-column-fluid">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 col-sm-6 col-xs-12">
					<a href="<?= base_url('dashboard/create_documents') ?>" class="text-left btn btn-danger btn-md btn-block font-size-h2 py-5 mb-5 btn-shadow">
						<span class="svg-icon svg-icon-3x">
							<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/keen/releases/2021-04-21-040700/theme/demo6/dist/../src/media/svg/icons/Navigation/Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
									<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
						Create Document</a>
				</div>
				<div class="col-xl-6 col-sm-6 col-xs-12">
					<a href="<?= base_url('dokumen') ?>" class="text-left btn btn-success btn-md btn-block font-size-h2 py-5 btn-shadow">
						<span class="svg-icon svg-icon-3x">
							<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/keen/releases/2021-04-21-040700/theme/demo6/dist/../src/media/svg/icons/Files/Selected-file.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<polygon points="0 0 24 0 24 24 0 24" />
									<path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
									<path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
						Document List</a>
				</div>
			</div>
			<div class="card card-custom mt-5">
				<div class="card-header border-0 pt-7">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder font-size-h4 text-dark-75">Lead Categories</span>
						<span class="text-muted mt-3 font-weight-bold font-size-lg">49 Acual Tasks</span>
					</h3>
					<div class="card-toolbar">
						<ul class="nav nav-pills nav-pills-sm nav-dark">
							<li class="nav-item ml-0">
								<a class="nav-link py-2 px-4 font-weight-bolder font-size-sm" data-toggle="tab" href="#kt_tab_table_4_1">Pending</a>
							</li>
							<li class="nav-item ml-0">
								<a class="nav-link py-2 px-4 font-weight-bolder font-size-sm" data-toggle="tab" href="#kt_tab_table_4_2">Inactive</a>
							</li>
							<li class="nav-item">
								<a class="nav-link py-2 px-4 active font-weight-bolder font-size-sm" data-toggle="tab" href="#kt_tab_table_4_3">Active</a>
							</li>
						</ul>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
				<div class="card-body pt-1 pb-4">
					<div class="tab-content mt-5" id="myTabTable4">
						<!--begin::Tap pane-->
						<div class="tab-pane fade" id="kt_tab_table_4_1" role="tabpanel" aria-labelledby="kt_tab_table_4_1">
							<!--begin::Table-->
							<div class="table-responsive">
								<table class="table table-borderless table-vertical-center">
									<thead>
										<tr>
											<th class="p-0 w-50px"></th>
											<th class="p-0 min-w-120px"></th>
											<th class="p-0 min-w-100px"></th>
											<th class="p-0 min-w-100px"></th>
											<th class="p-0 min-w-150px"></th>
											<th class="p-0 w-80px"></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-success mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-success">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Home/Library.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
																	<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$570,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-success font-size-lg">+43%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-danger mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-danger">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Design/Select.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<polygon points="0 0 24 0 24 24 0 24" />
																	<path d="M18.5,8 C17.1192881,8 16,6.88071187 16,5.5 C16,4.11928813 17.1192881,3 18.5,3 C19.8807119,3 21,4.11928813 21,5.5 C21,6.88071187 19.8807119,8 18.5,8 Z M18.5,21 C17.1192881,21 16,19.8807119 16,18.5 C16,17.1192881 17.1192881,16 18.5,16 C19.8807119,16 21,17.1192881 21,18.5 C21,19.8807119 19.8807119,21 18.5,21 Z M5.5,21 C4.11928813,21 3,19.8807119 3,18.5 C3,17.1192881 4.11928813,16 5.5,16 C6.88071187,16 8,17.1192881 8,18.5 C8,19.8807119 6.88071187,21 5.5,21 Z" fill="#000000" opacity="0.3" />
																	<path d="M5.5,8 C4.11928813,8 3,6.88071187 3,5.5 C3,4.11928813 4.11928813,3 5.5,3 C6.88071187,3 8,4.11928813 8,5.5 C8,6.88071187 6.88071187,8 5.5,8 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 C14,5.55228475 13.5522847,6 13,6 L11,6 C10.4477153,6 10,5.55228475 10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,18 L13,18 C13.5522847,18 14,18.4477153 14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 C10,18.4477153 10.4477153,18 11,18 Z M5,10 C5.55228475,10 6,10.4477153 6,11 L6,13 C6,13.5522847 5.55228475,14 5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 C18.4477153,14 18,13.5522847 18,13 L18,11 C18,10.4477153 18.4477153,10 19,10 Z" fill="#000000" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$82,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-danger font-size-lg">+12%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-primary mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-primary">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Shopping/Cart3.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																	<path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$1,090,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-primary font-size-lg">+36%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-info mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-info">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Media/Equalizer.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
																	<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
																	<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
																	<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$3,400,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-info font-size-lg">+28%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-warning mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-warning">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
																	<path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$28,600,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-warning font-size-lg">-35%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<!--end::Tablet-->
						</div>
						<!--end::Tap pane-->
						<!--begin::Tap pane-->
						<div class="tab-pane fade" id="kt_tab_table_4_2" role="tabpanel" aria-labelledby="kt_tab_table_4_2">
							<!--begin::Table-->
							<div class="table-responsive">
								<table class="table table-borderless table-vertical-center">
									<thead>
										<tr>
											<th class="p-0 w-50px"></th>
											<th class="p-0 min-w-120px"></th>
											<th class="p-0 min-w-100px"></th>
											<th class="p-0 min-w-100px"></th>
											<th class="p-0 min-w-150px"></th>
											<th class="p-0 w-80px"></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-danger mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-danger">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Design/Select.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<polygon points="0 0 24 0 24 24 0 24" />
																	<path d="M18.5,8 C17.1192881,8 16,6.88071187 16,5.5 C16,4.11928813 17.1192881,3 18.5,3 C19.8807119,3 21,4.11928813 21,5.5 C21,6.88071187 19.8807119,8 18.5,8 Z M18.5,21 C17.1192881,21 16,19.8807119 16,18.5 C16,17.1192881 17.1192881,16 18.5,16 C19.8807119,16 21,17.1192881 21,18.5 C21,19.8807119 19.8807119,21 18.5,21 Z M5.5,21 C4.11928813,21 3,19.8807119 3,18.5 C3,17.1192881 4.11928813,16 5.5,16 C6.88071187,16 8,17.1192881 8,18.5 C8,19.8807119 6.88071187,21 5.5,21 Z" fill="#000000" opacity="0.3" />
																	<path d="M5.5,8 C4.11928813,8 3,6.88071187 3,5.5 C3,4.11928813 4.11928813,3 5.5,3 C6.88071187,3 8,4.11928813 8,5.5 C8,6.88071187 6.88071187,8 5.5,8 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 C14,5.55228475 13.5522847,6 13,6 L11,6 C10.4477153,6 10,5.55228475 10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,18 L13,18 C13.5522847,18 14,18.4477153 14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 C10,18.4477153 10.4477153,18 11,18 Z M5,10 C5.55228475,10 6,10.4477153 6,11 L6,13 C6,13.5522847 5.55228475,14 5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 C18.4477153,14 18,13.5522847 18,13 L18,11 C18,10.4477153 18.4477153,10 19,10 Z" fill="#000000" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$82,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-danger font-size-lg">+12%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-primary mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-primary">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Shopping/Cart3.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																	<path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$1,090,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-primary font-size-lg">+36%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-info mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-info">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Media/Equalizer.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
																	<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
																	<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
																	<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$3,400,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-info font-size-lg">+28%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-warning mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-warning">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
																	<path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$28,600,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-warning font-size-lg">-35%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-success mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-success">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Home/Library.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
																	<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$570,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-success font-size-lg">+43%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<!--end::Tablet-->
						</div>
						<!--end::Tap pane-->
						<!--begin::Tap pane-->
						<div class="tab-pane fade show active" id="kt_tab_table_4_3" role="tabpanel" aria-labelledby="kt_tab_table_4_3">
							<!--begin::Table-->
							<div class="table-responsive">
								<table class="table table-borderless table-vertical-center">
									<thead>
										<tr>
											<th class="p-0 w-50px"></th>
											<th class="p-0 min-w-120px"></th>
											<th class="p-0 min-w-100px"></th>
											<th class="p-0 min-w-100px"></th>
											<th class="p-0 min-w-150px"></th>
											<th class="p-0 w-80px"></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-info mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-info">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Media/Equalizer.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
																	<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
																	<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
																	<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$3,400,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-info font-size-lg">+28%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-warning mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-warning">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Communication/Group-chat.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
																	<path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$28,600,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-warning font-size-lg">-35%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-success mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-success">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Home/Library.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
																	<rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$570,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-success font-size-lg">+43%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-danger mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-danger">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Design/Select.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<polygon points="0 0 24 0 24 24 0 24" />
																	<path d="M18.5,8 C17.1192881,8 16,6.88071187 16,5.5 C16,4.11928813 17.1192881,3 18.5,3 C19.8807119,3 21,4.11928813 21,5.5 C21,6.88071187 19.8807119,8 18.5,8 Z M18.5,21 C17.1192881,21 16,19.8807119 16,18.5 C16,17.1192881 17.1192881,16 18.5,16 C19.8807119,16 21,17.1192881 21,18.5 C21,19.8807119 19.8807119,21 18.5,21 Z M5.5,21 C4.11928813,21 3,19.8807119 3,18.5 C3,17.1192881 4.11928813,16 5.5,16 C6.88071187,16 8,17.1192881 8,18.5 C8,19.8807119 6.88071187,21 5.5,21 Z" fill="#000000" opacity="0.3" />
																	<path d="M5.5,8 C4.11928813,8 3,6.88071187 3,5.5 C3,4.11928813 4.11928813,3 5.5,3 C6.88071187,3 8,4.11928813 8,5.5 C8,6.88071187 6.88071187,8 5.5,8 Z M11,4 L13,4 C13.5522847,4 14,4.44771525 14,5 C14,5.55228475 13.5522847,6 13,6 L11,6 C10.4477153,6 10,5.55228475 10,5 C10,4.44771525 10.4477153,4 11,4 Z M11,18 L13,18 C13.5522847,18 14,18.4477153 14,19 C14,19.5522847 13.5522847,20 13,20 L11,20 C10.4477153,20 10,19.5522847 10,19 C10,18.4477153 10.4477153,18 11,18 Z M5,10 C5.55228475,10 6,10.4477153 6,11 L6,13 C6,13.5522847 5.55228475,14 5,14 C4.44771525,14 4,13.5522847 4,13 L4,11 C4,10.4477153 4.44771525,10 5,10 Z M19,10 C19.5522847,10 20,10.4477153 20,11 L20,13 C20,13.5522847 19.5522847,14 19,14 C18.4477153,14 18,13.5522847 18,13 L18,11 C18,10.4477153 18.4477153,10 19,10 Z" fill="#000000" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$82,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-danger font-size-lg">+12%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
										<tr>
											<td class="pl-0 py-5">
												<div class="symbol symbol-45 symbol-light-primary mr-2">
													<span class="symbol-label">
														<span class="svg-icon svg-icon-2x svg-icon-primary">
															<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Shopping/Cart3.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																	<path d="M3.5,9 L20.5,9 C21.0522847,9 21.5,9.44771525 21.5,10 C21.5,10.132026 21.4738562,10.2627452 21.4230769,10.3846154 L17.7692308,19.1538462 C17.3034221,20.271787 16.2111026,21 15,21 L9,21 C7.78889745,21 6.6965779,20.271787 6.23076923,19.1538462 L2.57692308,10.3846154 C2.36450587,9.87481408 2.60558331,9.28934029 3.11538462,9.07692308 C3.23725479,9.02614384 3.36797398,9 3.5,9 Z M12,17 C13.1045695,17 14,16.1045695 14,15 C14,13.8954305 13.1045695,13 12,13 C10.8954305,13 10,13.8954305 10,15 C10,16.1045695 10.8954305,17 12,17 Z" fill="#000000" />
																</g>
															</svg>
															<!--end::Svg Icon-->
														</span>
													</span>
												</div>
											</td>
											<td class="pl-0">
												<a href="#" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">BP Industries</a>
												<span class="text-muted font-weight-bold d-block">Successful Fellas</span>
											</td>
											<td></td>
											<td class="text-right">
												<span class="text-muted font-weight-bold d-block">Paid</span>
												<span class="text-dark-75 font-weight-bolder d-block font-size-lg">$1,090,000</span>
											</td>
											<td class="text-right pr-10">
												<span class="text-muted font-weight-bold">ReactJs, HTML</span>
											</td>
											<td class="text-right pr-10">
												<span class="font-weight-bolder text-primary font-size-lg">+36%</span>
											</td>
											<td class="text-right pr-0">
												<a href="#" class="btn btn-icon btn-light btn-sm">
													<span class="svg-icon svg-icon-md svg-icon-success">
														<!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<polygon points="0 0 24 0 24 24 0 24" />
																<rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
																<path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
															</g>
														</svg>
														<!--end::Svg Icon-->
													</span>
												</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<!--end::Tablet-->
						</div>
						<!--end::Tap pane-->
					</div>
				</div>
				<!--end::Body-->
			</div>
		</div>
	</div>
</div>