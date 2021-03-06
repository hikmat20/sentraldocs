<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Folders
 */

class Folders extends Admin_Controller
{

	//Permission
	protected $viewPermission   = "Folders.View";
	protected $addPermission    = "Folders.Add";
	protected $managePermission = "Folders.Manage";
	protected $deletePermission = "Folders.Delete";
	protected $approvalPermission = "Folders.Approval";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Folders/Folders_model',
			'Aktifitas/aktifitas_model'
		));

		$this->template->set('title', 'Manage Data Folder');
		$this->template->page_icon('fa fa-folder');

		date_default_timezone_set("Asia/Bangkok");
	}

	public function index()
	{
		$this->auth->restrict($this->viewPermission);
		$get_Data		= $this->Folders_model->getData('master_gambar');
		$this->template->page_icon('fa fa-folder-open');
		$this->template->set('row', $get_Data);
		$this->template->set_theme('dashboard');
		$this->template->render('index_new');
	}

	public function add()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		if ($this->input->post()) {

			$Arr_Kembali			= array();
			$data['created_by']		= $session['username'];
			$data['created']		= date('Y-m-d H:i:s');
			$data['nama_master']	= $this->input->post('folder_name');
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;

			if ($this->Folders_model->simpan('master_gambar', $data)) {
				$Arr_Kembali		= array(
					'status'		=> 1,
					'pesan'			=> 'Add gambar Success. Thank you & have a nice day.......'
				);

				$keterangan = 'Berhasil Simpan Folder';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('nama_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$Arr_Kembali		= array(
					'status'		=> 2,
					'pesan'			=> 'Add gambar failed. Please try again later......'
				);
			}
			echo json_encode($Arr_Kembali);
		} else {
			$this->template->page_icon('fa fa-folder-open');
			$this->template->title('Create Folder');
			$this->template->render('add');
		}
	}

	public function rename_folder()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		if ($this->input->post()) {

			$Arr_Kembali			= array();
			$id						= $this->input->post('id');
			$data['nama_master']	= $this->input->post('folder_name');
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;
			$this->db->trans_begin();
			$this->db->where('id_master', $id)->update('master_gambar', $data);;
			if ($this->db->trans_status() == TRUE) {
				$this->db->trans_commit();
				$Arr_Kembali		= array(
					'status'		=> 1,
					'msg'			=> 'Rename filder success.'
				);

				$keterangan = 'Berhasil Simpan Folder';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('nama_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$Arr_Kembali		= array(
					'status'		=> 0,
					'msg'			=> 'Gagal merubah nama folder'
				);
			}
			echo json_encode($Arr_Kembali);
		}
	}

	public function rename_subfolder()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		if ($this->input->post()) {

			$Arr_Kembali			= array();
			$id						= $this->input->post('id');
			$data['deskripsi']		= $this->input->post('folder_name');
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;
			$this->db->trans_begin();
			$this->db->where('id', $id)->update('gambar', $data);;
			if ($this->db->trans_status() == TRUE) {
				$this->db->trans_commit();
				$Arr_Kembali		= array(
					'status'		=> 1,
					'msg'			=> 'Rename filder success.'
				);

				$keterangan = 'Berhasil Simpan Folder';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('nama_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$Arr_Kembali		= array(
					'status'		=> 0,
					'msg'			=> 'Gagal merubah nama folder'
				);
			}
			echo json_encode($Arr_Kembali);
		}
	}


	public function rename_endfolder()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		if ($this->input->post()) {

			$Arr_Kembali			= array();
			$id						= $this->input->post('id');
			$data['deskripsi']		= $this->input->post('folder_name');
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;
			$this->db->trans_begin();
			$this->db->where('id', $id)->update('gambar1', $data);;
			if ($this->db->trans_status() == TRUE) {
				$this->db->trans_commit();
				$Arr_Kembali		= array(
					'status'		=> 1,
					'msg'			=> 'Rename filder success.'
				);

				$keterangan = 'Berhasil Simpan Folder';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('folder_name');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$Arr_Kembali		= array(
					'status'		=> 0,
					'msg'			=> 'Gagal merubah nama folder'
				);
			}
			echo json_encode($Arr_Kembali);
		}
	}


	function delete_master($id)
	{
		$this->db->delete("master_gambar", array('id_master' => $id));
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata("alert_data", "<div class=\"alert alert-success\" id=\"flash-message\">Data has been successfully deleted...........!!</div>");
			$keterangan = 'Berhasil Hapus Folder';
			$status = 1;
			$nm_hak_akses = $this->addPermission;
			$kode_universal = $id;
			$jumlah = 1;
			$sql = $this->db->last_query();
			simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			redirect(site_url('folders'));
		}
	}

	public function detail()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		$id_master 			= $this->input->get('id_master');
		$get_Data		= $this->Folders_model->getData('gambar', 'id_master', $id_master);
		$get_Detail		= $this->Folders_model->getData('master_gambar', 'id_master', $id_master);
		foreach ($get_Detail as $folder);


		$this->template->page_icon('fa fa-folder-open');
		$this->template->set('mtr', $id_master);
		$this->template->set('row', $get_Data);
		$this->template->title($folder->nama_master . '/');
		$this->template->render('detail');
	}


	public function add_detail()
	{
		if ($this->input->post()) {
			$config['upload_path'] = './assets/files/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = false; //Enkripsi nama yang terupload

			$session = $this->session->userdata('app_session');
			$prsh    = $session['id_perusahaan'];
			$cbg     = $session['id_cabang'];

			$this->upload->initialize($config);
			if ($this->upload->do_upload('image')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/files/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['umum'] = '50%';
				$config['width'] = 260;
				$config['height'] = 350;
				$config['new_image'] = './assets/files/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar  = $gbr['file_name'];
				$type    = $gbr['file_type'];
				$ukuran  = $gbr['file_size'];
				$ext1    = explode('.', $gambar);
				$ext     = $ext1[1];
				$lokasi = './assets/files/' . $gbr['file_name'];
			}

			$id_master 				= $this->input->post('id_master');
			$Arr_Kembali			= array();
			$data					= $this->input->post();
			$data['nama_file']	    = (isset($gambar)) ? $gambar : '';
			$data['ukuran_file']	= (isset($ukuran)) ? $ukuran : '';
			$data['tipe_file']		= (isset($ext)) ? $ext : '';
			$data['lokasi_file']	= (isset($lokasi)) ? $lokasi : '';
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;
			$dist 					= implode(",", $this->input->post('id_distribusi'));
			$data['id_distribusi']	= $dist;

			if ($this->input->post('id_review') != '') {
				$data['status_approve']	= 1;
			} else {
				$data['status_approve']	= 2;
			}

			$this->db->trans_begin();
			$this->Folders_model->simpan('gambar', $data);
			$idMax = $this->db->select('max(id) as maxId')
				->from('gambar')->get()->row();
			foreach ($this->input->post('id_distribusi') as $key => $value) {
				$arr_dist[$key] = [
					'id_file' => $idMax->maxId,
					'id_jabatan' => $value
				];
			}

			$this->db->insert_batch('distribusi', $arr_dist);
			if ($this->db->trans_status() === 0) {
				$this->db->trans_rollback();
				$Arr_Kembali		= array(
					'status'		=> 2,
					'pesan'			=> 'Add gambar failed. Please try again later......'
				);
				$keterangan = 'Berhasil Simpan Dokumen';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('id_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$this->db->trans_commit();
				$Arr_Kembali		= array(
					'status'		=> 1,
					'pesan'			=> 'Add gambar Success. Thank you & have a nice day.......'
				);
			}
			echo json_encode($Arr_Kembali);
		} else {
			$id_master 	= $this->input->get('id_master');
			$this->template->page_icon('fa fa-folder');
			$users	= $this->db->query("SELECT * FROM users WHERE nm_lengkap != 'Administrator' AND id_perusahaan='$prsh' AND id_cabang='$cbg' ORDER BY nm_lengkap ASC")->result_array();

			$option = '';
			foreach ($users as $key => $value) {
				$option .= "<option value='" . $value['id_user'] . "'>" . $value['nm_lengkap'] . "</option>";
			}

			$data = [
				'users' => $option
			];
			$this->template->set('results', $data);
			$this->template->set('idmaster', $id_master);
			$this->template->set('action', 'add');
			$this->template->title('Add Documents');
			$this->template->render('add_detail');
		}
	}

	public function edit()
	{
		$data					= $this->input->post();
		if ($this->input->post()) {
			if ($_FILES['nama_file']['name']) {
				$config['upload_path'] = './assets/files/'; //path folder
				$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
				$config['encrypt_name'] = false; //Enkripsi nama yang terupload
				$session = $this->session->userdata('app_session');
				$prsh    = $session['id_perusahaan'];
				$cbg     = $session['id_cabang'];

				$this->upload->initialize($config);
				$this->upload->do_upload('nama_file');
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/files/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['umum'] = '50%';
				$config['new_image'] = './assets/files/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar  = $gbr['file_name'];
				$type    = $gbr['file_type'];
				$ukuran  = $gbr['file_size'];
				$ext1    = explode('.', $gambar);
				$ext     = $ext1[1];
				$lokasi  = './assets/files/' . $gbr['file_name'];
				if ($this->input->post('old_file')) {
					if (file_exists('./assets/files/' . $this->input->post('old_file'))) {
						unlink('./assets/files/' . $this->input->post('old_file'));
					}
					// unlink('./assets/files/' . $this->input->post('old_file'));
				}
				$data['nama_file']	    = ($gambar) ? $gambar : '';
				$data['ukuran_file']	= ($ukuran) ? $ukuran : '';
				$data['tipe_file']		= ($ext) ? $ext : '';
				$data['lokasi_file']	= ($lokasi) ? $lokasi : '';
			} else {
				$error = $this->upload->display_errors();
				if ($error) {
					$Return		= array(
						'status'		=> 0,
						'pesan'			=> 'Error' . $error
					);
					echo json_encode($Return);
					return false;
				}
			}

			$table 					= $data['table'];
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$dist 					= implode(",", $this->input->post('id_distribusi'));
			$data['id_distribusi']	= $dist;
			unset($data['table']);
			unset($data['old_file']);

			$this->db->trans_begin();
			$this->Folders_model->getUpdate($table, $data, 'id', $this->input->post('id'));
			$id_dist = $this->db->get_where('distribusi', ['id_file' => $this->input->post('id')])->result();

			foreach ($this->input->post('id_distribusi') as $key => $value) {
				$cek = $this->db->where(['id_jabatan' => $value, 'id_file' => $this->input->post('id')])->get('distribusi')->row();
				$arr_dist = [
					'id_file' => $this->input->post('id'),
					'id_jabatan' => $value
				];
				if ($cek) {
					$this->db->update('distribusi', $arr_dist, ['id' => $cek->id]);
				} else if (!$cek) {
					$this->db->insert('distribusi', $arr_dist);
				} else {
					$this->db->delete('distribusi', ['id' => $cek->id]);
				}
			}

			// foreach ($this->input->post('id_distribusi') as $key => $value) {
			// 	$cek = $this->db->where(['id_file' => $this->input->post('id')])->get('distribusi')->result();
			// 	foreach ($cek as $jab) {
			// 		if ($value == $jab->id_jabatan) {
			// 			$arr_dist = [
			// 				'id_file' => $this->input->post('id'),
			// 				'id_jabatan' => $value
			// 			];
			// 			$this->db->update('distribusi', $arr_dist, ['id' => $jab->id]);
			// 		} else {
			// 			$this->db->delete('distribusi', ['id_file' => $this->input->post('id')]);
			// 			$arr_dist = [
			// 				'id_file' => $this->input->post('id'),
			// 				'id_jabatan' => $value
			// 			];
			// 			$this->db->insert('distribusi', $arr_dist);
			// 		}
			// 	}

			// if ($cek) {
			// } else if (!$cek) {
			// } else {
			// 	$this->db->delete('distribusi', ['id' => $cek->id]);
			// }
			// }

			// echo '<pre>';
			// print_r($arr_dist);
			// echo '<pre>';
			// exit;

			if ($this->db->trans_status() === TRUE) {
				$this->db->trans_commit();
				$Return		= array(
					'status'		=> 1,
					'pesan'			=> 'Update Document Success. Thank you & have a nice day.......'
				);
				$keterangan = 'Berhasil Update Dokumen';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('id_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$this->db->trans_rollback();
				$Return		= array(
					'status'		=> 0,
					'pesan'			=> 'Add gambar failed. Please try again later......'
				);
			}
			echo json_encode($Return);
		}
	}

	public function edit_file()
	{
		$id 				= $this->input->post('id');
		$table 				= $this->input->post('table');
		$file 				= $this->input->post('file');
		$data				= $this->db->get_where($table, ['id' => $id])->row();
		$jabatan 			= $this->db->get('tbl_jabatan')->result();
		$users 				= $this->db->order_by('nm_lengkap', 'ASC')->get_where('users', ['id_user !=' => '1'])->result();
		// $this->template->page_icon('fa fa-folder-open');
		$this->template->set('id', $id);
		$this->template->set('row', $data);
		$this->template->set('table', $table);
		$this->template->set('jabatan', $jabatan);
		$this->template->set('users', $users);
		$this->template->title('title', 'Edit Documents');
		$this->template->render('edit_detail');
	}

	public function download($id)
	{
		//echo"<pre>";print_r($id);exit;
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		$id_master = $this->db->query("SELECT id_master FROM gambar WHERE id='$id'")->row();
		$idmaster = $id_master->id_master;
		$pth    =   file_get_contents(base_url() . "./assets/files/" . $id);
		$nme    =   $id;
		force_download($nme, $pth);

		redirect(site_url('folders/detail?id_master=$id_master'));
	}

	function delete_folder()
	{
		$id 		= $this->input->post('id');
		$session 	= $this->session->userdata('app_session');
		$prsh    	= $session['id_perusahaan'];
		$cbg     	= $session['id_cabang'];

		// $this->db->where('id', $id);
		// $query 		= $this->db->get('gambar');
		// $path 		= $query->row();
		// unlink("./assets/files/$path->nama_file");

		$this->db->trans_begin();
		$this->db->delete("master_gambar", array('id_master' => $id));
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return = [
				'status' => 0,
				'msg'	=> 'Folder gagal dihapus.'
			];
		} else {
			$this->db->trans_commit();
			$return = [
				'status' => 1,
				'msg'	=> 'Folder berhasil dihapus.'
			];
		}

		$this->session->set_flashdata("alert_data", "<div class=\"alert alert-success\" id=\"flash-message\">Data has been successfully deleted...........!!</div>");
		$keterangan = 'Berhasil Hapus Dokumen';
		$status = 1;
		$nm_hak_akses = $this->addPermission;
		$kode_universal = $id;
		$jumlah = 1;
		$sql = $this->db->last_query();
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}

	function delete_subfolder()
	{
		$id 		= $this->input->post('id');
		$session 	= $this->session->userdata('app_session');
		$prsh    	= $session['id_perusahaan'];
		$cbg     	= $session['id_cabang'];

		// $this->db->where('id', $id);
		// $query 		= $this->db->get('gambar');
		// $path 		= $query->row();
		// unlink("./assets/files/$path->nama_file");

		$this->db->trans_begin();
		$this->db->delete("gambar", array('id' => $id));
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return = [
				'status' => 0,
				'msg'	=> 'Folder gagal dihapus.'
			];
		} else {
			$this->db->trans_commit();
			$return = [
				'status' => 1,
				'msg'	=> 'Folder berhasil dihapus.'
			];
		}

		$this->session->set_flashdata("alert_data", "<div class=\"alert alert-success\" id=\"flash-message\">Data has been successfully deleted...........!!</div>");
		$keterangan = 'Berhasil Hapus Dokumen';
		$status = 1;
		$nm_hak_akses = $this->addPermission;
		$kode_universal = $id;
		$jumlah = 1;
		$sql = $this->db->last_query();
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}

	function delete_endfolder()
	{
		$id 		= $this->input->post('id');
		$session 	= $this->session->userdata('app_session');
		$prsh    	= $session['id_perusahaan'];
		$cbg     	= $session['id_cabang'];

		$this->db->trans_begin();
		$this->db->delete("gambar1", array('id' => $id));
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$return = [
				'status' => 0,
				'msg'	=> 'Folder gagal dihapus.'
			];
		} else {
			$this->db->trans_commit();
			$return = [
				'status' => 1,
				'msg'	=> 'Folder berhasil dihapus.'
			];
		}

		$this->session->set_flashdata("alert_data", "<div class=\"alert alert-success\" id=\"flash-message\">Data has been successfully deleted...........!!</div>");
		$keterangan = 'Berhasil Hapus Dokumen';
		$status = 1;
		$nm_hak_akses = $this->addPermission;
		$kode_universal = $id;
		$jumlah = 1;
		$sql = $this->db->last_query();
		simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		echo json_encode($return);
	}

	public function add_subdetail1()
	{
		if ($this->input->post()) {
			$config['upload_path'] = './assets/files/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = false; //Enkripsi nama yang terupload
			$session = $this->session->userdata('app_session');
			$prsh    = $session['id_perusahaan'];
			$cbg     = $session['id_cabang'];
			$this->upload->initialize($config);
			if ($this->upload->do_upload('image')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/files/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['umum'] = '50%';
				$config['width'] = 260;
				$config['height'] = 350;
				$config['new_image'] = './assets/files/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar  = $gbr['file_name'];
				$type    = $gbr['file_type'];
				$ukuran  = $gbr['file_size'];
				$ext1    = explode('.', $gambar);
				$ext     = $ext1[1];
				$lokasi = './assets/files/' . $gbr['file_name'];
			}

			$id_master 	= $this->input->post('id_master');
			$id_detail 	= $this->input->post('id_detail');

			$Arr_Kembali			= array();
			$data					= $this->input->post();
			$data['nama_file']	    = (isset($gambar)) ? $gambar : '';
			$data['ukuran_file']	= (isset($ukuran)) ? $ukuran : '';
			$data['tipe_file']		= (isset($ext)) ? $ext : '';
			$data['lokasi_file']	= (isset($lokasi)) ? $lokasi : '';
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;
			$dist 					= implode(",", $this->input->post('id_distribusi'));
			$data['id_distribusi']	= $dist;

			if ($this->input->post('id_review') != '') {
				$data['status_approve']	= 1;
			} else {
				$data['status_approve']	= 2;
			}

			$this->db->trans_begin();
			$this->Folders_model->simpan('gambar1', $data);
			$idMax = $this->db->select('max(id) as maxId')
				->from('gambar1')->get()->row();
			foreach ($this->input->post('id_distribusi') as $key => $value) {
				$arr_dist[$key] = [
					'id_file' => $idMax->maxId,
					'id_jabatan' => $value
				];
			}

			$this->db->insert_batch('distribusi', $arr_dist);
			if ($this->db->trans_status() === TRUE) {
				$this->db->trans_commit();
				$Arr_Kembali		= array(
					'status'		=> 1,
					'pesan'			=> 'Add gambar Success. Thank you & have a nice day.......'
				);
				$keterangan = 'Berhasil Simpan Dokumen';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('id_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$this->db->trans_rollback();
				$Arr_Kembali		= array(
					'status'		=> 2,
					'pesan'			=> 'Add gambar failed. Please try again later......'
				);
			}
			echo json_encode($Arr_Kembali);
		} else {
			$id_master 	= $this->uri->segment('4');
			$id_detail 	= $this->uri->segment('3');
			$this->template->page_icon('fa fa-folder-open');
			$users	= $this->db->query("SELECT * FROM users WHERE nm_lengkap != 'Administrator' AND id_perusahaan='$prsh' AND id_cabang='$cbg' ORDER BY nm_lengkap ASC")->result_array();
			$option = '';
			foreach ($users as $key => $value) {
				$option .= "<option value='" . $value['id_user'] . "'>" . $value['nm_lengkap'] . "</option>";
			}

			$data = [
				'users' => $option
			];
			$this->template->set('results', $data);

			$this->template->set('idmaster', $id_master);
			$this->template->set('iddetail', $id_detail);
			$this->template->set('action', 'add');
			$this->template->title('Add Sub Dokumen');
			$this->template->render('add_subdetail1');
		}
	}

	// SUB FOLDER

	public function subfolder($subfolder = '', $detail = '', $enddetail = '')
	{
		$this->auth->restrict($this->viewPermission);
		$this->template->page_icon('fa fa-folder-open');
		$this->template->set('title', 'Index Of Folders');
		$this->template->set_theme('dashboard');
		$master 			= $this->db->get_where('master_gambar', ['nama_master' => str_replace('-', ' ', $subfolder)])->row();
		$id_master 			= $master->id_master;
		$nama_master 		= str_replace(' ', '-', strtolower($master->nama_master));
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];
		if (!$detail && !$enddetail) {
			$folders		= $this->db->get_where('view_gambar', ['id_master' => $id_master, 'nama_file' => null, 'id_perusahaan' => $prsh, 'id_cabang' => $cbg])->result();
			$files			= $this->db->get_where('view_gambar', ['id_master' => $id_master, 'nama_file !=' => null, 'id_perusahaan' => $prsh, 'id_cabang' => $cbg])->result();
			$get_Data		= $this->Folders_model->getData('view_gambar', 'id_master', $id_master);
			// $get_Master		= $this->Folders_model->getData('gambar', 'id', $id_sub);

			$this->template->set('list', false);
			$this->template->set('row', $get_Data);
			$this->template->set('folders', $folders);
			$this->template->set('files', $files);
			$this->template->set('nama_master', $nama_master);
			$this->template->set('id_master', $id_master);
			// $this->template->set('masDoc', $get_Master);
			$this->template->render('index_subfolder');
		} else if ($detail && !$enddetail) {
			$sub_folder 	= $this->db->get_where('gambar', ['deskripsi' => str_replace('-', ' ', $detail)])->row();
			$id_master 		= $sub_folder->id_master;
			$id_sub 		= $sub_folder->id;
			$folders		= $this->db->get_where('view_gambar1', ['id_detail' => $id_sub, 'nama_file' => null])->result();
			$files			= $this->db->get_where('view_gambar1', ['id_detail' => $id_sub, 'nama_file !=' => null])->result();
			$this->template->set('list', true);
			$this->template->set('files', $files);
			$this->template->set('folders', $folders);
			$this->template->set('id_sub', $id_sub);
			$this->template->set('id_master', $id_master);
			$this->template->set('nama_subfolder', $detail);
			$this->template->set('nama_master', $nama_master);
			$this->template->render('index_detail');
		} else {
			$endfolder 	= $this->db->get_where('gambar1', ['deskripsi' => str_replace('-', ' ', $enddetail)])->row();
			$id_master 		= $endfolder->id_master;
			$id_detail 		= $endfolder->id_detail;
			$id_enddetail	= $endfolder->id;

			$folders		= $this->db->get_where('view_gambar2', ['id_detail1' => $id_enddetail, 'nama_file' => null])->result();
			$files			= $this->db->get_where('view_gambar2', ['id_detail1' => $id_enddetail, 'nama_file !=' => null])->result();

			$this->template->set('list', true);
			$this->template->set('files', $files);
			$this->template->set('folders', $folders);
			$this->template->set('id_detail', $id_detail);
			$this->template->set('id_master', $id_master);
			$this->template->set('id_enddetail', $id_enddetail);
			$this->template->set('nama_subfolder', $detail);
			$this->template->set('nama_endfolder', $enddetail);
			$this->template->set('nama_master', $nama_master);
			$this->template->render('index_enddetail');
		}
	}

	public function load_form($id)
	{
		$session 	= $this->session->userdata('app_session');
		$prsh    	= $session['id_perusahaan'];
		$cbg     	= $session['id_cabang'];
		$users		= $this->db->query("SELECT * FROM users WHERE nm_lengkap != 'Administrator' AND id_perusahaan='$prsh' AND id_cabang='$cbg' ORDER BY nm_lengkap ASC")->result();
		$jabatan	= $this->db->query("SELECT * FROM tbl_jabatan WHERE id_perusahaan='$prsh' AND id_cabang='$cbg'")->result();
		$this->template->set('users', $users);
		$this->template->set('jabatan', $jabatan);
		$this->template->set('idmaster', $id);
		$this->template->render('add_detail');
	}

	public function load_form_detail($id_master = "", $id_sub = "")
	{
		$session 	= $this->session->userdata('app_session');
		$prsh    	= $session['id_perusahaan'];
		$cbg     	= $session['id_cabang'];
		$users		= $this->db->query("SELECT * FROM users WHERE nm_lengkap != 'Administrator' AND id_perusahaan='$prsh' AND id_cabang='$cbg' ORDER BY nm_lengkap ASC")->result();
		$jabatan	= $this->db->query("SELECT * FROM tbl_jabatan WHERE id_perusahaan='$prsh' AND id_cabang='$cbg'")->result();

		$this->template->set('users', $users);
		$this->template->set('jabatan', $jabatan);
		$this->template->set('id_sub', $id_sub);
		$this->template->set('id_master', $id_master);
		$this->template->render('add_subdetail1');
	}

	public function load_form_enddetail($id_master = "", $id_detail = "", $id_enddetail)
	{

		$session 	= $this->session->userdata('app_session');
		$prsh    	= $session['id_perusahaan'];
		$cbg     	= $session['id_cabang'];
		$users		= $this->db->query("SELECT * FROM users WHERE nm_lengkap != 'Administrator' AND id_perusahaan='$prsh' AND id_cabang='$cbg' ORDER BY nm_lengkap ASC")->result();
		$jabatan	= $this->db->query("SELECT * FROM tbl_jabatan WHERE id_perusahaan='$prsh' AND id_cabang='$cbg'")->result();
		$this->template->set('users', $users);
		$this->template->set('jabatan', $jabatan);
		$this->template->set('id_detail', $id_detail);
		$this->template->set('id_master', $id_master);
		$this->template->set('id_enddetail', $id_enddetail);
		$this->template->render('add_subdetail2');
	}

	public function add_subfolder()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		if ($this->input->post()) {

			$Arr_Kembali			= array();
			$data['created_by']		= $session['id_user'];
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $this->input->post('id_master');
			$data['deskripsi']		= $this->input->post('folder_name');
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;

			if ($this->Folders_model->simpan('gambar', $data)) {
				$Arr_Kembali		= array(
					'status'		=> 1,
					'pesan'			=> 'Add gambar Success. Thank you & have a nice day.......'
				);

				$keterangan 		= 'Berhasil Simpan Folder';
				$status 			= 1;
				$nm_hak_akses 		= $this->addPermission;
				$kode_universal 	= $this->input->post('folder_name');
				$jumlah 			= 1;
				$sql 				= $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$Arr_Kembali		= array(
					'status'		=> 2,
					'pesan'			=> 'Add gambar failed. Please try again later......'
				);
			}
			echo json_encode($Arr_Kembali);
		}
	}

	public function add_endfolder()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		if ($this->input->post()) {

			$Arr_Kembali			= array();
			$data['created_by']		= $session['id_user'];
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $this->input->post('id_master');
			$data['id_detail']		= $this->input->post('id_subfolder');
			$data['deskripsi']		= $this->input->post('folder_name');
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;

			$this->db->trans_begin();
			$this->db->insert('gambar1', $data);
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$return		= array(
					'status'		=> 0,
					'msg'			=> 'Add gambar failed. Please try again later......'
				);

				$keterangan 		= 'Berhasil Simpan Folder';
				$status 			= 0;
				$nm_hak_akses 		= $this->addPermission;
				$kode_universal 	= $this->input->post('folder_name');
				$jumlah 			= 1;
				$sql 				= $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$this->db->trans_commit();
				$return		= array(
					'status'		=> 1,
					'msg'			=> 'Add gambar Success. Thank you & have a nice day.......'
				);
			}
			echo json_encode($return);
		}
	}


	//SUB DOKUMEN 1
	public function detail1()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		$id_detail			= $this->input->get('id_detail');
		$get_Data		= $this->Folders_model->getData('gambar1', 'id_detail', $id_detail);
		$get_Detail		= $this->Folders_model->getData('gambar', 'id', $id_detail);

		foreach ($get_Detail as $detail);
		$id_master      = $detail->id_master;
		$get_Master		= $this->Folders_model->getData('master_gambar', 'id_master', $id_master);
		foreach ($get_Master as $folder);

		$this->template->page_icon('fa fa-folder-open');
		$this->template->set('mtr', $id_master);
		$this->template->set('dtl', $id_detail);
		$this->template->set('row', $get_Data);
		$this->template->title($folder->nama_master . '/' . $detail->deskripsi . '/');
		$this->template->render('detail1');
	}

	public function add_detail1()
	{
		if ($this->input->post()) {

			$config['upload_path'] = './assets/files/'; //path folder
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = false; //Enkripsi nama yang terupload
			$session = $this->session->userdata('app_session');
			$prsh    = $session['id_perusahaan'];
			$cbg     = $session['id_cabang'];

			$this->upload->initialize($config);
			if ($this->upload->do_upload('image')) {
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/files/' . $gbr['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['umum'] = '50%';
				$config['width'] = 260;
				$config['height'] = 350;
				$config['new_image'] = './assets/files/' . $gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();

				$gambar  = $gbr['file_name'];
				$type    = $gbr['file_type'];
				$ukuran  = $gbr['file_size'];
				$ext1    = explode('.', $gambar);
				$ext     = $ext1[1];
				$lokasi = './assets/files/' . $gbr['file_name'] . '.' . $ext;
			}


			$id_master 	= $this->input->post('id_master');
			$id_detail 	= $this->input->post('id_detail');
			// echo"<pre>";print_r($this->input->post());exit;	        


			$Arr_Kembali			= array();
			$data					= $this->input->post();
			$data['nama_file']	    = (isset($gambar)) ? $gambar : '';
			$data['ukuran_file']	= (isset($ukuran)) ? $ukuran : '';
			$data['tipe_file']		= (isset($ext)) ? $ext : '';
			$data['lokasi_file']	= (isset($lokasi)) ? $lokasi : '';
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;

			if ($this->input->post('id_review') != '') {
				$data['status_approve']	= 2;
			} else {
				$data['status_approve']	= 1;
			}

			if ($this->Folders_model->simpan('gambar', $data)) {
				$Arr_Kembali		= array(
					'status'		=> 1,
					'pesan'			=> 'Add gambar Success. Thank you & have a nice day.......'
				);
				$keterangan = 'Berhasil Simpan Dokumen';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('id_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$Arr_Kembali		= array(
					'status'		=> 2,
					'pesan'			=> 'Add gambar failed. Please try again later......'
				);
			}
			echo json_encode($Arr_Kembali);
		} else {
			$id_detail 	= $this->input->get('id_detail');
			$id_master  = $this->db->query("SELECT id_master FROM gambar WHERE id='$id_detail'")->row();
			$this->template->page_icon('fa fa-folder-open');

			$users	= $this->db->query("SELECT * FROM users WHERE nm_lengkap != 'Administrator' AND id_perusahaan='$prsh' AND id_cabang='$cbg' ORDER BY nm_lengkap ASC")->result_array();

			$option = '';
			foreach ($users as $key => $value) {
				$option .= "<option value='" . $value['id_user'] . "'>" . $value['nm_lengkap'] . "</option>";
			}

			$data = [
				'users' => $option
			];
			$this->template->set('results', $data);

			$this->template->set('iddetail', $id_detail);
			$this->template->set('idmaster', $id_master->id_master);
			$this->template->set('action', 'add');
			$this->template->title('Add Sub Documents I');
			$this->template->render('add_subdetail1');
		}
	}

	public function edit_detail1($id = '')
	{

		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];


		$this->upload->initialize($config);
		if ($this->upload->do_upload('image')) {
			$gbr = $this->upload->data();
			//Compress Image
			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/files/' . $gbr['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['umum'] = '50%';
			$config['width'] = 260;
			$config['height'] = 350;
			$config['new_image'] = './assets/files/' . $gbr['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$gambar  = $gbr['file_name'];
			$type    = $gbr['file_type'];
			$ukuran  = $gbr['file_size'];
			$ext1    = explode('.', $gambar);
			$ext     = $ext1[1];
			$lokasi = './assets/files/' . $gbr['file_name'] . '.' . $ext;
		}
		if ($this->input->post()) {
			$id_master 	= $this->input->post('id_master');
			$id_detail 	= $this->input->post('id_detail');
			// echo"<pre>";print_r($id_master);exit;

			$Arr_Kembali			= array();

			if ($ukuran > 0) {
				$data					= $this->input->post();
				$data['nama_file']	    = (isset($gambar)) ? $gambar : '';
				$data['ukuran_file']	= (isset($ukuran)) ? $ukuran : '';
				$data['tipe_file']		= (isset($ext)) ? $ext : '';
				$data['lokasi_file']	= (isset($lokasi)) ? $lokasi : '';
				$data_session			= $this->session->userdata;
				$data['created_by']		= $this->auth->user_id();
				$data['created']		= date('Y-m-d H:i:s');
				$data['id_master']		= $id_master;
				$data['id_detail']		= $id_detail;
			} else {
				$data					= $this->input->post();
				$data_session			= $this->session->userdata;
				$data['created_by']		= $this->auth->user_id();
				$data['created']		= date('Y-m-d H:i:s');
				$data['id_master']		= $id_master;
				$data['id_detail']		= $id_detail;
			}



			$update = $this->Folders_model->getUpdate('gambar1', $data, 'id', $this->input->post('id'));


			if ($update) {
				$Arr_Kembali		= array(
					'status'		=> 1,
					'pesan'			=> 'Update Document Success. Thank you & have a nice day.......'
				);
				$keterangan = 'Berhasil Update Dokumen';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('id_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$Arr_Kembali		= array(
					'status'		=> 2,
					'pesan'			=> 'Add gambar failed. Please try again later......'
				);
			}
			echo json_encode($Arr_Kembali);
		} else {


			$detail				= $this->Folders_model->getData('gambar1', 'id', $id);



			$this->template->page_icon('fa fa-folder-open');
			$this->template->set('id', $id);
			$this->template->set('row', $detail);
			$this->template->set('action', 'edit');
			$this->template->title('Edit Sub Documents I');
			$this->template->render('edit_detail1');
		}
	}

	public function download_detail1($id)
	{
		//echo"<pre>";print_r($id);exit;
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		$id_master = $this->db->query("SELECT * FROM gambar1 WHERE id='$id'")->row();
		$iddetail = $id_master->id_detail;
		$nme    =   $id_master->nama_file;
		$pth    =   file_get_contents(base_url() . "./assets/files/" . $nme);

		force_download($nme, $pth);

		redirect(site_url('folders/detail1?id_detail=' . $iddetail));
	}

	function delete_file()
	{

		$session 	= $this->session->userdata('app_session');
		$prsh    	= $session['id_perusahaan'];
		$cbg     	= $session['id_cabang'];
		$id 		= $this->input->post('id');
		$table 		= $this->input->post('table');
		$file = $this->db->where('id', $id)->get($table)->row();

		$this->db->trans_begin();
		$this->db->delete($table, array('id' => $id));
		$this->db->delete('distribusi', array('id_file' => $id));

		if ($this->db->trans_status() === TRUE) {
			$this->db->trans_commit();
			if (file_exists($file->lokasi_file)) {
				unlink($file->lokasi_file);
			}
			$return = [
				'status' => 1,
				'msg' => 'Hapus file berhasil'
			];
			$this->session->set_flashdata("alert_data", "<div class=\"alert alert-success\" id=\"flash-message\">Data has been successfully deleted...........!!</div>");
			$keterangan = 'Berhasil Hapus Dokumen';
			$status = 1;
			$nm_hak_akses = $this->addPermission;
			$kode_universal = $id;
			$jumlah = 1;
			$sql = $this->db->last_query();
			simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			// redirect(site_url('folders/detail1?id_detail=' . $iddetail));
		} else {
			$this->db->trans_rollback();
			$return = [
				'status' => 0,
				'msg' => 'Hapus file gagal'
			];
		}

		echo json_encode($return);
	}


	function delete_detail1($id)
	{
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		$id_master = $this->db->query("SELECT id_detail FROM gambar1 WHERE id='$id'")->row();
		$iddetail  = $id_master->id_detail;
		// print_r($idmaster);
		// exit;
		$this->db->where('id', $id);
		$query = $this->db->get('gambar1');
		$path = $query->row();
		if (file_exists($path->lokasi_file)) {
			unlink($path->lokasi_file);
		}
		// unlink("./assets/files/$path->nama_file");
		$this->db->delete("gambar1", array('id' => $id));
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata("alert_data", "<div class=\"alert alert-success\" id=\"flash-message\">Data has been successfully deleted...........!!</div>");
			$keterangan = 'Berhasil Hapus Dokumen';
			$status = 1;
			$nm_hak_akses = $this->addPermission;
			$kode_universal = $id;
			$jumlah = 1;
			$sql = $this->db->last_query();
			simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			redirect(site_url('folders/detail1?id_detail=' . $iddetail));
		}
	}


	public function add_subdetail2()
	{
		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];


		$this->upload->initialize($config);
		if ($this->upload->do_upload('image')) {
			$gbr = $this->upload->data();
			//Compress Image
			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/files/' . $gbr['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['umum'] = '50%';
			$config['width'] = 260;
			$config['height'] = 350;
			$config['new_image'] = './assets/files/' . $gbr['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$gambar  = $gbr['file_name'];
			$type    = $gbr['file_type'];
			$ukuran  = $gbr['file_size'];
			$ext1    = explode('.', $gambar);
			$ext     = $ext1[1];
			$lokasi = './assets/files/' . $gbr['file_name'];
		}
		if ($this->input->post()) {

			$Arr_Kembali			= array();
			$data					= $this->input->post();
			$data['nama_file']	    = (isset($gambar)) ? $gambar : '';
			$data['ukuran_file']	= (isset($ukuran)) ? $ukuran : '';
			$data['tipe_file']		= (isset($ext)) ? $ext : '';
			$data['lokasi_file']	= (isset($lokasi)) ? $lokasi : '';
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;
			$data['id_approval']	= $this->input->post('id_approval');
			$dist 					= implode(",", $this->input->post('id_distribusi'));
			$data['id_distribusi']	= $dist;

			if ($this->input->post('id_review') != '') {
				$data['status_approve']	= 1;
			} else {
				$data['status_approve']	= 2;
			}

			$this->db->trans_begin();
			$this->Folders_model->simpan('gambar2', $data);
			$idMax = $this->db->select('max(id) as maxId')
				->from('gambar2')->get()->row();
			foreach ($this->input->post('id_distribusi') as $key => $value) {
				$arr_dist[$key] = [
					'id_file' => $idMax->maxId,
					'id_jabatan' => $value
				];
			}
			$this->db->insert_batch('distribusi', $arr_dist);
			if ($this->db->trans_status() === TRUE) {
				$this->db->trans_commit();
				$Arr_Kembali		= array(
					'status'		=> 1,
					'msg'			=> 'Add File Success. Thank you & have a nice day.......'
				);
				$keterangan = 'Berhasil Simpan Dokumen';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('id_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$this->db->trans_rollback();
				$Arr_Kembali		= array(
					'status'		=> 0,
					'msg'			=> 'Add File failed. Please try again later......'
				);
			}
			echo json_encode($Arr_Kembali);
		} else {
			$id_master 	= $this->uri->segment('4');
			$id_detail 	= $this->uri->segment('3');
			$this->template->page_icon('fa fa-folder-open');

			$users	= $this->db->query("SELECT * FROM users WHERE nm_lengkap != 'Administrator' AND id_perusahaan='$prsh' AND id_cabang='$cbg' ORDER BY nm_lengkap ASC")->result_array();

			$option = '';
			foreach ($users as $key => $value) {
				$option .= "<option value='" . $value['id_user'] . "'>" . $value['nm_lengkap'] . "</option>";
			}

			$data = [
				'users' => $option
			];
			$this->template->set('results', $data);

			$this->template->set('idmaster', $id_master);
			$this->template->set('iddetail', $id_detail);
			$this->template->set('action', 'add');
			$this->template->title('Add Sub Dokumen');
			$this->template->render('add_subdetail1');
		}
	}

	//SUB DOKUMEN 2

	public function detail2()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		$id_detail1			= $this->input->get('id_detail1');
		$get_Data		= $this->Folders_model->getData('gambar2', 'id_detail1', $id_detail1);
		$get_Detail		= $this->Folders_model->getData('gambar1', 'id', $id_detail1);

		foreach ($get_Detail as $detail);
		$id_master      = $detail->id_master;
		$id_detail      = $detail->id_detail;

		$get_Master		= $this->Folders_model->getData('master_gambar', 'id_master', $id_master);
		foreach ($get_Master as $folder);

		$get_1		= $this->Folders_model->getData('gambar', 'id', $id_detail);
		foreach ($get_1 as $dt);

		$this->template->page_icon('fa fa-folder-open');
		$this->template->set('mtr', $id_master);
		$this->template->set('dtl1', $id_detail1);
		$this->template->set('dtl', $id_detail);
		$this->template->set('row', $get_Data);
		$this->template->title($folder->nama_master . '/' . $dt->deskripsi . '/' . $detail->deskripsi . '/');
		$this->template->render('detail2');
	}

	public function add_detail2()
	{
		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload

		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];


		$this->upload->initialize($config);
		if ($this->upload->do_upload('image')) {
			$gbr = $this->upload->data();
			//Compress Image
			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/files/' . $gbr['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['umum'] = '50%';
			$config['width'] = 260;
			$config['height'] = 350;
			$config['new_image'] = './assets/files/' . $gbr['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$gambar  = $gbr['file_name'];
			$type    = $gbr['file_type'];
			$ukuran  = $gbr['file_size'];
			$ext1    = explode('.', $gambar);
			$ext     = $ext1[1];
			$lokasi = './assets/files/' . $gbr['file_name'] . '.' . $ext;
		}
		if ($this->input->post()) {
			$id_master 	= $this->input->post('id_master');
			$id_detail 	= $this->input->post('id_detail');
			$id_detail1 	= $this->input->post('id_detail1');

			$Arr_Kembali			= array();
			$data					= $this->input->post();
			$data['nama_file']	    = (isset($gambar)) ? $gambar : '';
			$data['ukuran_file']	= (isset($ukuran)) ? $ukuran : '';
			$data['tipe_file']		= (isset($ext)) ? $ext : '';
			$data['lokasi_file']	= (isset($lokasi)) ? $lokasi : '';
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;

			if ($this->input->post('id_review') != '') {
				$data['status_approve']	= 2;
			} else {
				$data['status_approve']	= 1;
			}

			if ($this->Folders_model->simpan('gambar2', $data)) {
				$Arr_Kembali		= array(
					'status'		=> 1,
					'pesan'			=> 'Add gambar Success. Thank you & have a nice day.......'
				);
				$keterangan = 'Berhasil Simpan Dokumen';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('id_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$Arr_Kembali		= array(
					'status'		=> 2,
					'pesan'			=> 'Add gambar failed. Please try again later......'
				);
			}
			echo json_encode($Arr_Kembali);
		} else {
			$id_detail1 	= $this->input->get('id_detail1');
			$id_detail      = $this->db->query("SELECT id_detail FROM gambar1 WHERE id='$id_detail1'")->row();
			$id_master      = $this->db->query("SELECT id_master FROM gambar1 WHERE id='$id_detail1'")->row();
			$this->template->page_icon('fa fa-folder-open');
			$users	= $this->db->query("SELECT * FROM users WHERE nm_lengkap != 'Administrator' AND id_perusahaan='$prsh' AND id_cabang='$cbg' ORDER BY nm_lengkap ASC")->result_array();

			$option = '';
			foreach ($users as $key => $value) {
				$option .= "<option value='" . $value['id_user'] . "'>" . $value['nm_lengkap'] . "</option>";
			}

			$data = [
				'users' => $option
			];
			$this->template->set('results', $data);
			$this->template->set('iddetail1', $id_detail1);
			$this->template->set('iddetail', $id_detail->id_detail);
			$this->template->set('idmaster', $id_master->id_master);
			$this->template->set('action', 'add');
			$this->template->title('Add Sub Documents II');
			$this->template->render('add_subdetail2');
		}
	}

	public function edit_detail2($id = '')
	{

		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload

		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];


		$this->upload->initialize($config);
		if ($this->upload->do_upload('image')) {
			$gbr = $this->upload->data();
			//Compress Image
			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/files/' . $gbr['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['umum'] = '50%';
			$config['width'] = 260;
			$config['height'] = 350;
			$config['new_image'] = './assets/files/' . $gbr['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$gambar  = $gbr['file_name'];
			$type    = $gbr['file_type'];
			$ukuran  = $gbr['file_size'];
			$ext1    = explode('.', $gambar);
			$ext     = $ext1[1];
			$lokasi = './assets/files/' . $gbr['file_name'] . '.' . $ext;
		}
		if ($this->input->post()) {
			$id_master 	= $this->input->post('id_master');
			$id_detail 	= $this->input->post('id_detail');
			$id_detail1 	= $this->input->post('id_detail1');
			// echo"<pre>";print_r($id_master);exit;

			$Arr_Kembali			= array();

			if ($ukuran > 0) {
				$data					= $this->input->post();
				$data['nama_file']	    = (isset($gambar)) ? $gambar : '';
				$data['ukuran_file']	= (isset($ukuran)) ? $ukuran : '';
				$data['tipe_file']		= (isset($ext)) ? $ext : '';
				$data['lokasi_file']	= (isset($lokasi)) ? $lokasi : '';
				$data['created_by']		= $this->auth->user_id();
				$data['created']		= date('Y-m-d H:i:s');
				$data['id_master']		= $id_master;
				$data['id_detail']		= $id_detail;
				$data['id_detail1']		= $id_detail1;
			} else {
				$data					= $this->input->post();
				$data['created_by']		= $this->auth->user_id();
				$data['created']		= date('Y-m-d H:i:s');
				$data['id_master']		= $id_master;
				$data['id_detail']		= $id_detail;
				$data['id_detail1']		= $id_detail1;
			}

			$update = $this->Folders_model->getUpdate('gambar2', $data, 'id', $this->input->post('id'));
			if ($update) {
				$Arr_Kembali		= array(
					'status'		=> 1,
					'pesan'			=> 'Update Document Success. Thank you & have a nice day.......'
				);
				$keterangan = 'Berhasil Update Dokumen';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('id_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$Arr_Kembali		= array(
					'status'		=> 2,
					'pesan'			=> 'Add gambar failed. Please try again later......'
				);
			}
			echo json_encode($Arr_Kembali);
		} else {

			$detail				= $this->Folders_model->getData('gambar2', 'id', $id);
			$this->template->page_icon('fa fa-folder-open');
			$this->template->set('id', $id);
			$this->template->set('row', $detail);
			$this->template->set('action', 'edit');
			$this->template->title('Edit Sub Documents II');
			$this->template->render('edit_detail2');
		}
	}

	public function download_detail2($id)
	{
		//echo"<pre>";print_r($id);exit;
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		$id_master = $this->db->query("SELECT * FROM gambar1 WHERE id='$id'")->row();
		$iddetail = $id_master->id_detail;
		$nme    =   $id_master->nama_file;
		$pth    =   file_get_contents(base_url() . "./assets/files/" . $nme);

		force_download($nme, $pth);

		redirect(site_url('folders/detail1?id_detail=' . $iddetail));
	}



	function delete_detail2($id)
	{

		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		$id_master = $this->db->query("SELECT * FROM gambar2 WHERE id='$id'")->row();
		$iddetail   = $id_master->id_detail;
		$iddetail1  = $id_master->id_detail1;
		// print_r($idmaster);
		// exit;
		$this->db->where('id', $id);
		$query = $this->db->get('gambar2');
		$path = $query->row();
		if (file_exists($path->lokasi_file)) {
			unlink($path->lokasi_file);
		}
		// unlink("./assets/files/$path->nama_file");
		$this->db->delete("gambar2", array('id' => $id));
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata("alert_data", "<div class=\"alert alert-success\" id=\"flash-message\">Data has been successfully deleted...........!!</div>");
			$keterangan = 'Berhasil Hapus Dokumen';
			$status = 1;
			$nm_hak_akses = $this->addPermission;
			$kode_universal = $id;
			$jumlah = 1;
			$sql = $this->db->last_query();
			simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			redirect(site_url('folders/detail2?id_detail1=' . $iddetail1));
		}
	}


	public function add_subdetail3()
	{
		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		$this->upload->initialize($config);
		if ($this->upload->do_upload('image')) {
			$gbr = $this->upload->data();
			//Compress Image
			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/files/' . $gbr['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['umum'] = '50%';
			$config['width'] = 260;
			$config['height'] = 350;
			$config['new_image'] = './assets/files/' . $gbr['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$gambar  = $gbr['file_name'];
			$type    = $gbr['file_type'];
			$ukuran  = $gbr['file_size'];
			$ext1    = explode('.', $gambar);
			$ext     = $ext1[1];
			$lokasi = './assets/files/' . $gbr['file_name'] . '.' . $ext;
		}
		if ($this->input->post()) {
			$id_master 	= $this->input->post('id_master');
			$id_detail 	= $this->input->post('id_detail');
			// echo"<pre>";print_r($this->input->post());exit;	        


			$Arr_Kembali			= array();
			$data					= $this->input->post();
			$data['nama_file']	    = (isset($gambar)) ? $gambar : '';
			$data['ukuran_file']	= (isset($ukuran)) ? $ukuran : '';
			$data['tipe_file']		= (isset($ext)) ? $ext : '';
			$data['lokasi_file']	= (isset($lokasi)) ? $lokasi : '';
			$data_session			= $this->session->userdata;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $id_master;
			$data['id_detail']		= $id_detail;
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;
			$data['id_approval']	= $this->input->post('id_approval');

			if ($this->input->post('id_approval') != '') {
				$data['status_approve']	= 3;
				$data['id_review']	= $this->input->post('id_review');
			}


			if ($this->Folders_model->simpan('gambar1', $data)) {
				$Arr_Kembali		= array(
					'status'		=> 1,
					'pesan'			=> 'Add gambar Success. Thank you & have a nice day.......'
				);
				$keterangan = 'Berhasil Simpan Dokumen';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('id_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$Arr_Kembali		= array(
					'status'		=> 2,
					'pesan'			=> 'Add gambar failed. Please try again later......'
				);
			}
			echo json_encode($Arr_Kembali);
		} else {
			$id_master 	= $this->uri->segment('4');
			$id_detail 	= $this->uri->segment('3');
			$this->template->page_icon('fa fa-folder-open');
			$users	= $this->db->query("SELECT * FROM users WHERE nm_lengkap != 'Administrator' AND id_perusahaan='$prsh' AND id_cabang='$cbg' ORDER BY nm_lengkap ASC")->result_array();

			$option = '';
			foreach ($users as $key => $value) {
				$option .= "<option value='" . $value['id_user'] . "'>" . $value['nm_lengkap'] . "</option>";
			}

			$data = [
				'users' => $option
			];
			$this->template->set('results', $data);
			$this->template->set('idmaster', $id_master);
			$this->template->set('iddetail', $id_detail);
			$this->template->set('action', 'add');
			$this->template->title('Add Sub Dokumen');
			$this->template->render('add_subdetail1');
		}
	}

	//END SUB DOKUMEN 2

	function get_approval()
	{
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		$users	= $this->db->query("SELECT * FROM tbl_jabatan WHERE id_perusahaan='$prsh' AND id_cabang='$cbg'")->result();
		echo "<span class='input-group-addon'><i class='fa fa-check'></i></span>   
		<select id='id_approval' name='id_approval' class='form-control input-sm select2'>
				<option value=''>Pilih Approval</option>";
		foreach ($users as $pic) {
			echo "<option value='$pic->id'>$pic->nm_jabatan</option>";
		}
		echo "</select>";
	}


	function get_review()
	{

		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		$users	= $this->db->query("SELECT * FROM tbl_jabatan WHERE id_perusahaan='$prsh' AND id_cabang='$cbg'")->result();
		echo "<span class='input-group-addon'><i class='fa fa-check'></i></span>   
		<select id='id_review' name='id_review' class='form-control input-sm select2'>
				<option value=''>Pilih Review</option>";
		foreach ($users as $pic) {
			echo "<option value='$pic->id'>$pic->nm_jabatan</option>";
		}
		echo "</select>";
	}


}
