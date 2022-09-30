<div class="container mt-10">

	<!--begin::Card-->
	<div class="card card-custom">
		<!--begin::Body-->
		<div class="card-body p-0">
			<div class="row justify-content-center px-8 py-5">
				<div class="col-xl-12 col-xxl-10">
					<!--begin::Wizard Form-->
					<form id="frm_users">
						<div class="row justify-content-center">
							<div class="col-xl-10">
								<!--begin::Wizard Step 1-->
								<div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
									<h3 class="text-dark text-center font-weight-bold mb-4">User's Profile Details</h3>
									<!--begin::Group-->
									<hr>
									<?php if (isset($data) && $data->id_user) : ?>
										<input type="hidden" name="id_user" value="<?= $data->id_user; ?>">
									<?php endif; ?>
									<!--end::Group-->
									<!--begin::Group-->
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Full Name</label>
										<div class="col-lg-9 col-xl-9">
											<input class="form-control required form-control-solid form-control-lg" id="full_name" placeholder="Full Name" name="full_name" maxlength="100" value="<?= isset($data->full_name) ? $data->full_name : ''; ?>" />
											<span class="form-text text-danger invalid-feedback">Full Name can't be empty..!</span>
										</div>
									</div>
									<!--end::Group-->
									<!--begin::Group-->
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
										<div class="col-lg-9 col-xl-9">
											<input type="text" class="form-control form-control-solid required form-control-lg" name="phone" value="<?= isset($data->phone) ? $data->phone : ''; ?>" placeholder="0812345567" />
											<span class="form-text text-danger invalid-feedback">Contact Phone can't be empty..!</span>
										</div>
									</div>
									<!--end::Group-->
									<!--begin::Group-->
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
										<div class="col-lg-9 col-xl-9">
											<input type="text" class="form-control form-control-solid required form-control-lg" placeholder="name@mail.com" name="email" value="<?= isset($data->email) ? $data->email : ''; ?>" />
											<span class="form-text text-danger invalid-feedback">Email Address can't be empty..!</span>
										</div>
									</div>
									<!--end::Group-->
									<!--begin::Group-->
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">City</label>
										<div class="col-lg-9 col-xl-9">
											<input type="text" class="form-control required form-control-solid form-control-lg" name="city" placeholder="City" value="<?= isset($data->city) ? $data->city : ''; ?>" />
											<span class="form-text text-danger invalid-feedback">City can't be empty..!</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Address</label>
										<div class="col-lg-9 col-xl-9">
											<textarea name="address" id="address" class="form-control required form-control-solid form-control-lg" placeholder="Address"><?= isset($data) ? $data->address : ''; ?></textarea>
											<span class="form-text text-danger invalid-feedback">Address can't be empty..!</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-3 text-left">Status</label>
										<div class="col-9">
											<div class="checkbox-inline">
												<label class="checkbox">
													<input type="checkbox" class="required" name="status" value="ACT" <?= (isset($data) && $data->status == 'ACT') ? 'checked' : ''; ?>>
													<span></span>Active
												</label>
											</div>
											<span class="form-text text-danger invalid-feedback">Address can't be empty..!</span>
											<div class="form-text text-muted"> Activation account</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Level</label>
										<div class="col-lg-9 col-xl-9">
											<select name="group_id" id="group_id" class="form-control required form-control-solid select2">
												<option value=""></option>
												<?php foreach ($levels as $level) : ?>
													<option value="<?= $level->id_group; ?>" <?= (isset($user_group) && $user_group->id_group == $level->id_group) ? 'selected' : ""; ?>><?= $level->nm_group; ?></option>
												<?php endforeach; ?>
											</select>
											<span class="form-text text-danger invalid-feedback">Level can't be empty..!</span>
										</div>
									</div>
									<!-- <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Company</label>
										<div class="col-lg-9 col-xl-9">
											<select name="company_id" id="company_id" class="form-control form-control-solid select2">
												<option value=""></option>
											</select>
										</div>
									</div> -->
									<!--end::Group-->
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label text-left">Photo</label>
										<div class="col-lg-9 col-xl-9">
											<div class="image-input image-input-outline" id="kt_user_add_avatar">
												<div id="preview" class="image-input-wrapper" style="background-image: url('<?= base_url('assets/img/') . set_value('photo', isset($data->photo) ? $data->photo : 'avatar.png') ?>')"></div>
												<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
													<i class="fa fa-pen icon-sm text-muted"></i>
													<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
													<input type="hidden" name="profile_avatar_remove" />
													<input type="file" name="profile_avatar" onchange="preview_image(event)" id="profile_avatar" class="hidden">
													<!-- <input type="hidden" name="old_photo" id="old_photo" value="<?= isset($data->photo) ? $data->photo : 'avatar.png' ?>"> -->
													<!-- <button class="btn btn-warning" onclick="$('#photo').click()" type="button"><i class="fa fa-upload"></i> Upload Gambar</button> -->

												</label>
												<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
													<i class="ki ki-bold-close icon-xs text-muted"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<!--end::Wizard Step 1-->
								<div class="my-5 step border-top pt-10 mt-15" data-wizard-type="step-content" data-wizard-state="current">
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Username</label>
										<div class="col-lg-9 col-xl-9">
											<input type="text" id="username" class="form-control form-control-solid form-control-lg" name="username" placeholder="username" <?= (isset($data) && $data->username) ? 'readonly' : '';; ?> value="<?= isset($data) ? $data->username : ''; ?>" />
											<span class="invalid-feedback">Username can't be empty..!</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Password</label>
										<div class="col-lg-9 col-xl-9">
											<input type="password" id="password" class="form-control  form-control-solid form-control-lg" name="password" placeholder="password" />
											<span class="invalid-feedback">Password can't be empty..!</span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Re-Password</label>
										<div class="col-lg-9 col-xl-9">
											<input type="password" id="re-password" class="form-control  form-control-solid form-control-lg" name="re-password" placeholder="re-password" />
											<span class="invalid-feedback">Re-Password can't be empty..!</span>
										</div>
									</div>
								</div>
								<!--begin::Wizard Actions-->
								<div class="d-flex justify-content-between border-top pt-10 mt-15">
									<a href="<?= base_url('users/setting'); ?>" class="btn btn-danger"><i class="fa fa-reply mr-2"></i>Back</a>
									<button type="button" name="save" id="save" class="btn btn-primary"><i class="fa fa-save"></i><?= lang('users_btn_save') ?></button>
								</div>
								<!--end::Wizard Actions-->
							</div>
						</div>
					</form>
					<!--end::Wizard Form-->
				</div>
			</div>
		</div>
		<!--end::Body-->
	</div>
	<!--end::Card-->
</div>

<!-- page script -->
<script type="text/javascript">
	$(document).ready(function() {
		// get_perusahaan();
		$('.select2').select2({
			placeholder: "Choose an options",
			width: "100%",
			allowClear: true

		});

		$(document).on('click', '#save', function() {
			const formdata = new FormData($('#frm_users')[0])
			const username = $('#username').val()
			const password = $('#password').val()
			const re_password = $('#re-password').val()

			if (username) {
				if (!password) {
					$('#password').addClass('is-invalid')
				} else if (password && !re_password) {
					$('#re-password').addClass('is-invalid')
				}
			}

			const valid = getValidation('#frm_users')
			console.log(formdata);
			if (valid) {
				$.ajax({
					url: base_url + active_controller + 'setting/save',
					type: 'POST',
					dataType: 'JSON',
					data: formdata,
					processData: false,
					contentType: false,
					cache: false,
					success: function(res) {
						if (res.status == '1') {
							Swal.fire({
								title: 'Success!!',
								text: res.msg,
								icon: 'success',
								timer: 2000
							}).then(function() {
								location.href = siteurl + active_controller;
							})

						} else {
							Swal.fire({
								title: 'Failed!!',
								icon: 'warning',
								text: res.msg,
								timer: 2000
							})
						}
					},
					error: function(res) {
						Swal.fire({
							title: 'Error!',
							icon: 'error',
							text: 'Server timeout, because error.',
							timer: 3000
						})
					}
				})
			} else {
				Swal.fire({
					title: 'Warning!!',
					text: 'Please fill the blank field(s)..!',
					icon: 'warning',
					timer: 2000
				})
			}
		})
	});


	function preview_image(event) {
		var reader = new FileReader();
		reader.onload = function() {
			var output = document.getElementById('preview');
			output.src = reader.result;
		}
		reader.readAsDataURL(event.target.files[0]);
	}

	function get_perusahaan() {

		$.ajax({
			type: "GET",
			url: siteurl + 'users/get_perusahaan',
			data: "",
			success: function(html) {
				$("#select_nm_perusahaan").html(html);
				$('.select2').select2();

			}
		});
	}

	function get_cabang() {

		var perusahaan = $('#nm_perusahaan').val();

		$.ajax({
			type: 'POST',
			url: siteurl + 'users/get_cabang',
			data: {
				'perusahaan': perusahaan
			},
			success: function(html) {
				$("#select_nm_cabang").html(html);
				$('.select2').select2();
			}
		});
	}
</script>