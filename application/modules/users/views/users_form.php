<div class="box box-primary">
	<!-- form start -->
	<?= form_open($this->uri->uri_string(), array('id' => 'frm_users', 'name' => 'frm_users', 'role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')) ?>
	<div class="box-body">
		<!-- <div class="row"> -->
		<div class="col-md-6">
			<div class="form-group <?= form_error('username') ? ' has-error' : ''; ?>">
				<label for="username" class="col-md-3 control-label"><?= lang('users_username') ?></label>
				<div class="col-sm-3 col-md-6">
					<input type="text" class="form-control" id="username" name="username" maxlength="45" value="<?= set_value('username', isset($data->username) ? $data->username : ''); ?>" autofocus />
				</div>
			</div>
			<div class="form-group <?= form_error('password') ? ' has-error' : ''; ?>">
				<label for="password" class="col-md-3 control-label"><?= lang('users_password') ?></label>
				<div class="col-md-6">
					<input type="password" class="form-control" id="password" name="password" maxlength="100" value="<?= set_value('password') ?>" />
				</div>
			</div>
			<div class="form-group <?= form_error('re-password') ? ' has-error' : ''; ?>">
				<label for="re-password" class="col-md-3 control-label"><?= lang('users_repassword') ?></label>
				<div class="col-md-6">
					<input type="password" class="form-control" id="re-password" name="re-password" maxlength="100" value="<?= set_value('re-password') ?>" />
				</div>
			</div>
			<div class="form-group <?= form_error('email') ? ' has-error' : ''; ?>">
				<label for="email" class="col-md-3 control-label"><?= lang('users_email') ?></label>
				<div class="col-md-6">
					<input type="email" class="form-control" id="email" name="email" maxlength="100" value="<?= set_value('email', isset($data->email) ? $data->email : ''); ?>" />
				</div>
			</div>
			<div class="form-group <?= form_error('nm_lengkap') ? ' has-error' : ''; ?>">
				<label for="nm_lengkap" class="col-md-3 control-label"><?= lang('users_nm_lengkap') ?></label>
				<div class="col-md-6">
					<input type="text" class="form-control" id="nm_lengkap" name="nm_lengkap" maxlength="100" value="<?= set_value('nm_lengkap', isset($data->nm_lengkap) ? $data->nm_lengkap : ''); ?>" />
				</div>
			</div>
			<div class="form-group <?= form_error('alamat') ? ' has-error' : ''; ?>">
				<label for="alamat" class="col-md-3 control-label"><?= lang('users_alamat') ?></label>
				<div class="col-md-6">
					<textarea class="form-control" id="alamat" name="alamat" maxlength="255"><?= set_value('alamat', isset($data->alamat) ? $data->alamat : ''); ?></textarea>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group <?= form_error('kota') ? ' has-error' : ''; ?>">
				<label for="kota" class="col-md-3 control-label"><?= lang('users_kota') ?></label>
				<div class="col-md-6">
					<input type="text" class="form-control" id="kota" name="kota" maxlength="20" value="<?= set_value('kota', isset($data->kota) ? $data->kota : ''); ?>" />
				</div>
			</div>
			<div class="form-group <?= form_error('hp') ? ' has-error' : ''; ?>">
				<label for="hp" class="col-md-3 control-label"><?= lang('users_hp') ?></label>
				<div class="col-md-6">
					<input type="text" class="form-control" id="hp" name="hp" maxlength="20" value="<?= set_value('hp', isset($data->hp) ? $data->hp : ''); ?>" />
				</div>
			</div>
			<div class="form-group <?= form_error('st_aktif') ? ' has-error' : ''; ?>">
				<label for="st_aktif" class="col-md-3 control-label"><?= lang('users_st_aktif') ?></label>
				<div class="col-md-6">
					<select name="st_aktif" id="st_aktif" class="form-control">
						<option value="1" <?= set_select('st_aktif', 1, isset($data->st_aktif) && $data->st_aktif == 1) ?>><?= lang('users_aktif') ?></option>
						<option value="0" <?= set_select('st_aktif', 0, isset($data->st_aktif) && $data->st_aktif == 0) ?>><?= lang('users_td_aktif') ?></option>
					</select>
				</div>
			</div>
			<div class="form-group <?= form_error('level') ? ' has-error' : ''; ?>">
				<label for="level" class="col-md-3 control-label"><?= lang('level') ?></label>
				<div class="col-md-6">
					<select name="level" id="level" class="form-control">
						<option value="admin" <?= set_select('admin', 1, isset($data->level) && $data->level == 'admin') ?>><?= lang('level_admin') ?></option>
						<option value="user" <?= set_select('user', 0, isset($data->level) && $data->level == 'user') ?>><?= lang('level_user') ?></option>
					</select>
				</div>
			</div>
			
			<div class="form-group <?= form_error('nm_perusahaan') ? ' has-error' : ''; ?>" ">
			<label for="nm_perusahaan" class="col-sm-3 control-label"><?= lang('nm_perusahaan') ?></label>	
            			
			<?php 
			$id = isset($data->username) ? $data->username : '';
			if($id==''){
				
			?>
			<div class="col-sm-6" id="select_nm_perusahaan">
				 <select class="form-control input-sm select2" name="nm_perusahaan" id="nm_perusahaan" 
				 onchange="get_cabang()">
				 <option value="">Pilih Perusahaan</option>								
				 </select> 								  
			</div>
			
			<?php
			}
			else{
					$users	= $this->db->query("SELECT * FROM perusahaan")->result();
					echo "
					        <div class='col-sm-6'>
							<select id='nm_perusahaan' name='nm_perusahaan' class='select2'  onchange='get_cabang()'>
							<option value=''>Pilih Perusahaan</option>";
							foreach($users as $pic){
					
					if($data->id_perusahaan == $pic->id_perusahaan){						
					$sel ='selected';
					}
					else{
					$sel ='';
					}
					echo "<option value='$pic->id_perusahaan' $sel>$pic->nm_perusahaan</option>";
							}
					echo "</select>
					
					</div>";
			}
			?>
		    </div>
			
			
			<div class="form-group">
			  <label class="col-sm-3 control-label"><?= lang('nm_cabang') ?></font></label>
			<?php 
			$id = isset($data->username) ? $data->username : '';
			if($id==''){
				
			?>
			  <div class="col-sm-6" id="select_nm_cabang">   
				  <select class="form-control input-sm select2" name="nm_cabang" id="nm_cabang">
					<option value="">Pilih Cabang</option>								
				  </select> 							  
			  </div>
            <?php
			}
		    else{
					$users	= $this->db->query("SELECT * FROM perusahaan_cbg")->result();
					echo "
					<div class='col-sm-6' id='select_nm_cabang'>
					<select id='nm_cabang' name='nm_cabang' class='select2' >
					<option value=''>Pilih Cabang</option>";
					foreach($users as $pic){
					
					if($data->id_cabang == $pic->id_cabang){						
					$sel ='selected';
					}
					else{
					$sel ='';
					}
					echo "<option value='$pic->id_cabang' $sel>$pic->nm_cabang</option>";
							}
					echo "</select>
					
					</div>";
			}
			?>
			  
		    </div>
			
			
			<div class="form-group">
				<label for="level" class="col-md-3 control-label">Photo</label>
				<div class="col-md-6">
					<img id="preview" src="<?= base_url('assets/img/') . set_value('photo', isset($data->photo) ? $data->photo : 'avatar.png') ?>" alt="<?= isset($data->photo) ? $data->photo : 'avatar.png' ?>" class="img-thumbnail img-responsive" width="150px" height="150px" style="margin-bottom: 10px;">
					<input type="file" name="photo" onchange="preview_image(event)" id="photo" class="hidden">
					<input type="hidden" name="old_photo" id="old_photo" value="<?= isset($data->photo) ? $data->photo : 'avatar.png' ?>">
					<button class="btn btn-warning" onclick="$('#photo').click()" type="button"><i class="fa fa-upload"></i> Upload Gambar</button>
					<div class="">
						<br>
						<span class="text-center text-muted text-sm">*) Ukuran Max. 500kb, Dimensi Max. 1000 x 1000 pixel</span>
					</div>
				</div>
			</div>

		</div>
		<!-- </div> -->
	</div>
	<div class="box-footer">
		<div class="row">
			<div class="col-md-6">
				<div class="text-center">
					<button type="submit" name="save" class="btn btn-primary"><?= lang('users_btn_save') ?></button>
					<?php
					echo anchor('users/setting', lang('users_btn_cancel'), array('class' => 'btn btn-danger'));
					?>
				</div>
			</div>
		</div>
	</div>
	<?= form_close() ?>
</div><!-- /.box -->

<!-- page script -->
<script type="text/javascript">
  
	
	$(document).ready(function(){
	  get_perusahaan();
	});	

	$(function() {
		$('.select2').select2();
	});

	function preview_image(event) {
		var reader = new FileReader();
		reader.onload = function() {
			var output = document.getElementById('preview');
			output.src = reader.result;
		}
		reader.readAsDataURL(event.target.files[0]);
	}
    
	function get_perusahaan(){
       
		$.ajax({
            type:"GET",
            url:siteurl+'users/get_perusahaan',
            data:"",
            success:function(html){
               $("#select_nm_perusahaan").html(html);
                $('.select2').select2();

            }
        });
	}
	
	function get_cabang(){
		
		var perusahaan=$('#nm_perusahaan').val();
       
		$.ajax({
            type:'POST',
            url:siteurl+'users/get_cabang',
            data:{'perusahaan':perusahaan},
            success:function(html){
               $("#select_nm_cabang").html(html);
               $('.select2').select2();
            }
        });
	}
</script>