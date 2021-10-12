<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Folders
 */

class Dokumen extends Front_Controller
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
			'folders/Folders_model',
			'Aktifitas/aktifitas_model'
		));

		$this->template->set('title', 'Manage Data Folder');
		$this->template->page_icon('fa fa-folder');

		date_default_timezone_set("Asia/Bangkok");
	}

	public function home()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-folder-open');
		// $get_Data		= $this->Folders_model->getData('master_gambar');
		// $this->template->set('row', $get_Data);
		$this->template->set('title', 'Index Of Documents');
		$this->template->render('home');
	}

	public function index()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		// $get_Data		= $this->Folders_model->getData('master_gambar');
		$get_Data		= $this->db->get('master_gambar')->result();
		$this->template->page_icon('fa fa-folder-open');
		$this->template->set('title', 'Index Of Folders');
		$this->template->set_theme('dashboard');
		$this->template->set('row', $get_Data);
		$this->template->render('index_new');
	}

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
			$files			= $this->db->get_where('view_gambar', ['id_master' => $id_master, 'status_approve' => '3', 'nama_file !=' => null, 'id_perusahaan' => $prsh, 'id_cabang' => $cbg])->result();
			$get_Data		= $this->db->get_where('view_gambar', 'id_master', $id_master);
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
			$files			= $this->db->get_where('view_gambar1', ['id_detail' => $id_sub, 'status_approve' => '3', 'nama_file !=' => null])->result();

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
			$files			= $this->db->get_where('view_gambar2', ['id_detail1' => $id_enddetail, 'status_approve' => '3', 'nama_file !=' => null])->result();

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

	public function _subfolder()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-folder-open');
		$idmaster       = $this->uri->segment(3);
		$idsub       = $this->uri->segment(4);
		// $get_Data		= $this->Folders_model->getData('master_gambar', 'id_master', $idmaster);
		// $this->template->set('row', $get_Data);
		$this->template->set('title', 'Index Of Folders');
		$this->template->set_theme('dashboard');

		if (!$this->uri->segment(4)) {
			$get_Data		= $this->Folders_model->getData('gambar', 'id_master', $idmaster);
			$this->template->set('list', false);
			$this->template->set('row', $get_Data);
			$this->template->render('index_new_subfolder');
		} else {
			$get_Data		= $this->Folders_model->getData('gambar1', 'id_detail', $idsub);
			$get_Master		= $this->Folders_model->getData('gambar', 'id', $idsub);
			$this->template->set('list', true);
			$this->template->set('row', $get_Data);
			$this->template->set('masDoc', $get_Master);
			$this->template->render('index_new_detail');
		}
	}

	public function add()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		if ($this->input->post()) {
			$Arr_Kembali			= array();
			$data['created_by']		= $session['username'];
			$data['created']		= date('Y-m-d H:i:s');
			$data['nama_master']	= $this->input->post('folder_name');

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
			$this->template->title('Create Folder ');
			$this->template->render('add');
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
			redirect(site_url('Folders'));
		}
	}

	public function detail()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');

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
		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip|vsd'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload


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
			// echo"<pre>";print_r($id_master);exit;	        


			$Arr_Kembali			= array();
			$data					= $this->input->post();
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data_session			= $this->session->userdata;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $id_master;


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
			$id_master 	= $this->input->get('id_master');
			$this->template->page_icon('fa fa-folder');
			$this->template->set('idmaster', $id_master);
			$this->template->set('action', 'add');
			$this->template->title('Add Documents');
			$this->template->render('add_detail');
		}
	}

	public function edit($id = '')
	{

		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload


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
			// echo"<pre>";print_r($id_master);exit;

			$Arr_Kembali			= array();

			if ($ukuran > 0) {
				$data					= $this->input->post();
				$data['nama_file']	    = $gambar;
				$data['ukuran_file']	= $ukuran;
				$data['tipe_file']		= $ext;
				$data['lokasi_file']	= $lokasi;
				$data_session			= $this->session->userdata;
				$data['created_by']		= $this->auth->user_id();
				$data['created']		= date('Y-m-d H:i:s');
				$data['id_master']		= $id_master;
			} else {
				$data					= $this->input->post();
				$data_session			= $this->session->userdata;
				$data['created_by']		= $this->auth->user_id();
				$data['created']		= date('Y-m-d H:i:s');
				$data['id_master']		= $id_master;
			}
			$update = $this->Folders_model->getUpdate('gambar', $data, 'id', $this->input->post('id'));
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
			$detail				= $this->Folders_model->getData('gambar', 'id', $id);
			$this->template->page_icon('fa fa-folder-open');
			$this->template->set('id', $id);
			$this->template->set('row', $detail);
			$this->template->set('action', 'edit');
			$this->template->title('Edit Documents');
			$this->template->render('edit_detail');
		}
	}

	public function confirm_download($id, $table)
	{
		$session 	= $this->session->userdata('app_session');
		$dist 		= $this->db->get_where('distribusi', ['id_file' => $id])->result();
		$nama_file 	= $this->db->get_where($table, ['id' => $id])->row();

		if (!$nama_file) {
			$return = [
				'status' => 0,
				'msg' => 'File Tidak ditemukan.'
			];
			echo json_encode($return);
			return false;
		}

		if ($dist) {
			$file = $this->db->get_where("distribusi", ['id_file' => $id, 'id_jabatan' => $session['id_jabatan']])->row();
			if ((isset($file->id_jabatan) == $session['id_jabatan']) && ($file->id_user  == "")) {
				$this->db->trans_begin();
				$this->db->where(['id_file' => $id, 'id_jabatan' => $session['id_jabatan']])->update('distribusi', ['id_user' => $session['id_user'], 'status_download' => 'Y', 'downloaded_at' => date('Y-m-d H:i:s')]);
				if ($this->db->trans_status() == FALSE) {
					$this->db->trans_rollback();
					$return = [
						'status' => 0,
						'msg' => 'Proses Download Gagal. Server timeout'
					];
				} else {
					$this->db->trans_commit();
					$return = [
						'status' => 1,
						'msg' => 'File Berhasil di download.'
					];
				}
			} else {
				$return = [
					'status' => 1,
					'msg' => 'File Berhasil di download.'
				];
			}
		} else {
			$return = [
				'status' => 0,
				'msg' => 'File Tidak di distribusikan.'
			];
		}



		echo json_encode($return);
	}

	public function download($id, $table)
	{
		$file 	= $this->db->get_where($table, ['id' => $id])->row();

		if ($file->nama_file) {
			$path   	= file_get_contents("./assets/files/$file->nama_file");
			force_download($file->nama_file, $path);
		} else {
			return false;
		}
	}

	function delete_detail($id)
	{
		$id_master = $this->db->query("SELECT id_master FROM gambar WHERE id='$id'")->row();
		$idmaster  = $id_master->id_master;
		// print_r($idmaster);
		// exit;
		$this->db->where('id', $id);
		$query = $this->db->get('gambar');
		$path = $query->row();
		unlink("./assets/files/$path->nama_file");
		$this->db->delete("gambar", array('id' => $id));
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata("alert_data", "<div class=\"alert alert-success\" id=\"flash-message\">Data has been successfully deleted...........!!</div>");
			$keterangan = 'Berhasil Hapus Dokumen';
			$status = 1;
			$nm_hak_akses = $this->addPermission;
			$kode_universal = $id;
			$jumlah = 1;
			$sql = $this->db->last_query();
			simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			redirect(site_url('Folders/detail?id_master=' . $idmaster));
		}
	}


	public function add_subdetail1()
	{
		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload


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
			$data					= $this->input->post();
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data_session			= $this->session->userdata;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $id_master;
			$data['id_detail']		= $id_detail;


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
			$this->template->set('idmaster', $id_master);
			$this->template->set('iddetail', $id_detail);
			$this->template->set('action', 'add');
			$this->template->title('Add Sub Dokumen');
			$this->template->render('add_subdetail1');
		}
	}

	//SUB DOKUMEN 1

	public function detail1()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');

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
		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload


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
			$data					= $this->input->post();
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data_session			= $this->session->userdata;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $id_master;
			$data['id_detail']		= $id_detail;


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
				$data['nama_file']	    = $gambar;
				$data['ukuran_file']	= $ukuran;
				$data['tipe_file']		= $ext;
				$data['lokasi_file']	= $lokasi;
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
		$id_master = $this->db->query("SELECT * FROM gambar1 WHERE id='$id'")->row();
		$iddetail = $id_master->id_detail;
		$nme    =   $id_master->nama_file;

		$pth    =   file_get_contents(base_url() . "assets/files/" . $nme);

		force_download($nme, $pth);

		redirect(site_url('dokumen'));
	}



	function delete_detail1($id)
	{
		$id_master = $this->db->query("SELECT id_detail FROM gambar1 WHERE id='$id'")->row();
		$iddetail  = $id_master->id_detail;
		// print_r($idmaster);
		// exit;
		$this->db->where('id', $id);
		$query = $this->db->get('gambar1');
		$path = $query->row();
		unlink("./assets/files/$path->nama_file");
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
			redirect(site_url('Folders/detail1?id_detail=' . $iddetail));
		}
	}


	public function add_subdetail2()
	{
		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload


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
			$data					= $this->input->post();
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data_session			= $this->session->userdata;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $id_master;
			$data['id_detail']		= $id_detail;


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
			$this->template->set('idmaster', $id_master);
			$this->template->set('iddetail', $id_detail);
			$this->template->set('action', 'add');
			$this->template->title('Add Sub Dokumen');
			$this->template->render('add_subdetail1');
		}
	}

	//END SUB DOKUMEN 1

	//APPROVE
	public function approve()
	{
		$this->auth->restrict($this->viewPermission);
		$session 	= $this->session->userdata('app_session');
		$prsh 		= $session['id_perusahaan'];
		$cbg 		= $session['id_cabang'];
		$jabatan 	= $session['id_jabatan'];
		$user    	= $session['id_user'];

		$doc1		= $this->db->where(['status_approve' => 2, 'id_approval' => $jabatan, 'nama_file !=' => null, 'id_perusahaan' => $prsh, 'id_cabang' => $cbg])->get('view_gambar')->result();
		$doc2		= $this->db->where(['status_approve' => 2, 'id_approval' => $jabatan, 'nama_file !=' => null, 'id_perusahaan' => $prsh, 'id_cabang' => $cbg])->get('view_gambar1')->result();
		$doc3		= $this->db->where(['status_approve' => 2, 'id_approval' => $jabatan, 'nama_file !=' => null, 'id_perusahaan' => $prsh, 'id_cabang' => $cbg])->get('view_gambar2')->result();

		$this->template->set([
			'doc1' 		=> $doc1,
			'doc2' 		=> $doc2,
			'doc3' 		=> $doc3,
			'title'		=> 'Index Approval Dokumen',
			'jabatan' 	=> $jabatan,
			'user' 		=> $user,
		]);
		$this->template->set_theme('dashboard');
		$this->template->page_icon('fa fa-folder-open');
		$this->template->render('index_approve');
	}

	public function approval_subfolder()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-folder-open');
		$idmaster       = $this->uri->segment(3);
		$get_Data		= $this->Folders_model->getData('master_gambar', 'id_master', $idmaster);
		$this->template->set('row', $get_Data);
		$this->template->title('Index Of Folders');
		$this->template->render('index_approve_subfolder');
	}

	public function approval()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$jabatan = $session['id_jabatan'];


		$id    = $this->input->post('id');
		$table    = $this->input->post('table');
		$nama_file = $this->input->post('file');

		$data = $this->db->query("SELECT * FROM view_koreksi WHERE nm_table='$table' AND id_dokumen='$id'")->result();
		$data1 = $this->db->query("SELECT * FROM tbl_replace WHERE nm_table='$table' AND id_dokumen='$id'")->result();
		$data2 = $this->db->query("SELECT * FROM tbl_replace WHERE nm_table='$table' AND id_dokumen='$id'")->result();
		$rev 		= $this->db->query("SELECT * FROM tbl_replace WHERE nm_table='$table' AND id_dokumen='$id'")->result();
		$this->template->set('jabatan', $jabatan);
		$this->template->set('id', $id);
		$this->template->set('table', $table);
		$this->template->set('nama_file', $nama_file);
		$this->template->set('row', $data);
		$this->template->set('row1', $data1);
		$this->template->set('row2', $data2);
		$this->template->set('rev', $rev);
		$this->template->render('approval');
	}

	public function saveApproval()
	{
		$id 		= $this->input->post('id');
		$table 		= $this->input->post('table');
		$status 	= $this->input->post('status');

		$this->db->trans_begin();
		if ($status == 'approve') {
			$getRevisi = $this->db->query("SELECT * FROM $table WHERE id='$id' ")->row();
			$statusrev = '0';
			// if ($getRevisi->status_revisi == '1') {
			// 	$revisi    = $getRevisi->revisi + 1;
			// } else {
			// 	$revisi    = $getRevisi->revisi;
			// }

			$data_update = array(
				// 'revisi'           => $revisi,
				'status_approve'    => 3,
				'status_revisi'     => $statusrev,
				'approval_on'	    => date('Y-m-d H:i:s'),
				'approval_by'		=> $this->auth->user_id()
			);
			$where      = array(
				'id' => $this->input->post('id'),
			);

			$data_approval = $this->db->query("SELECT * FROM  tbl_approval WHERE id_dokumen ='$id' AND nm_table='$table' ")->result();
			foreach ($data_approval as $val) {
				$data_insert = array(
					'id'                => $val->id,
					'keterangan'        => $val->keterangan,
					'id_dokumen'        => $val->id_dokumen,
					'nm_table'          => $val->nm_table,
					'revisi'            => $val->revisi,
					'approval_on'	    => $val->approval_on,
					'approval_by'		=> $val->approval_by
				);

				$this->db->insert("tbl_approval_history", $data_insert);
			}

			$this->Folders_model->getUpdateData($table, $data_update, $where);
			$this->db->delete("tbl_approval", array('id_dokumen' => $id, 'nm_table' => $table));
		} elseif ($status == 'revisi') {
			$getRevisi = $this->db->query("SELECT revisi FROM $table WHERE id='$id' ")->row();
			$revisi    = $getRevisi->revisi + 1;
			$data_update = array(
				'status_approve'    => 0,
				'revisi'    		=> $revisi,
				'approval_on'	    => date('Y-m-d H:i:s'),
				'approval_by'		=> $this->auth->user_id()
			);
			$where      = array(
				'id' => $this->input->post('id'),
			);

			$data_insert = array(
				'keterangan'        => $this->input->post('keterangan'),
				'id_dokumen'        => $this->input->post('id'),
				'nm_table'          => $this->input->post('table'),
				'revisi'            => $revisi,
				'approval_on'	    => date('Y-m-d H:i:s'),
				'approval_by'		=> $this->auth->user_id()
			);

			$this->Folders_model->getUpdateData($table, $data_update, $where);
			$this->db->insert("tbl_approval", $data_insert);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Arr_Return		= array(
				'status'		=> 2,
				'pesan'			=> 'Save Process Failed. Please Try Again...'
			);
		} else {
			$this->db->trans_commit();
			$Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. ',
				// 'kode'			=> $kode
			);
		}
		echo json_encode($Arr_Return);
	}

	public function history_revisi()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$jabatan = $session['id_jabatan'];

		$id    		= $this->input->post('id');
		$table    	= $this->input->post('table');
		$nama_file 	= $this->input->post('file');

		if ($table == 'gambar2') {
			$file = $this->db->get_where('gambar2', ['id' => $id])->row();
			$exp = explode(",", ($file->id_distribusi));
		} else if ($table == 'gambar1') {
			$file = $this->db->get_where('gambar1', ['id' => $id])->row();

			$exp = explode(",", ($file->id_distribusi));
		} else {
			$file = $this->db->get_where('gambar', ['id' => $id])->row();
			$exp = explode(",", ($file->id_distribusi));
		}

		$Jabatan = $this->db->get_where('tbl_jabatan', ['id_perusahaan' => $session['id_perusahaan'], 'id_cabang' => $session['id_cabang']])->result_array();
		// $arr = array(4, 5, 6);

		$arr_jbt = [];
		foreach ($Jabatan as $key => $jbt) {
			if (in_array($jbt['id'], $exp)) {
				$arr_jbt[] = $jbt;
			}
		}

		$data 	= $this->db->query("SELECT * FROM tbl_replace WHERE nm_table='$table' AND id_dokumen='$id'")->result();
		$data1 	= $this->db->query("SELECT * FROM tbl_replace WHERE nm_table='$table' AND id_dokumen='$id'")->result();
		$dist 	= $this->db->get_where("view_distribusi", ['id_file' => $id])->result();

		// $uri3 = $this->uri->segment(3);
		// $uri4 = $this->uri->segment(4);
		// $uri5 = $this->uri->segment(5);
		// $uri6 = $this->uri->segment(4);

		// $this->template->set('uri3', $uri3);
		// $this->template->set('uri4', $uri4);
		// $this->template->set('uri5', $uri5);
		// $this->template->set('uri6', $uri6);


		$this->template->set('jabatan', $jabatan);
		$this->template->set('arr_jbt', $arr_jbt);
		$this->template->set('id', $id);
		$this->template->set('table', $table);
		$this->template->set('nama_file', $nama_file);
		$this->template->set('row', $data);
		$this->template->set('row1', $data1);
		$this->template->set('dist', $dist);
		$this->template->render('history_revisi');
	}

	//KOREKSI
	public function koreksi()
	{
		$this->auth->restrict($this->viewPermission);
		$this->template->set_theme('dashboard');
		$this->template->page_icon('fa fa-folder-open');

		$session 			= $this->session->userdata('app_session');
		$jabatan 			= $session['id_jabatan'];
		$get_Data			= $this->Folders_model->getData('master_gambar');
		$doc1				= $this->db->get_where('gambar', ['status_approve' => 0, 'prepared_by' => $session['id_user'], 'nama_file !=' => null])->result();
		$doc2				= $this->db->get_where('gambar1', ['status_approve' => 0, 'prepared_by' => $session['id_user'], 'nama_file !=' => null])->result();
		$doc3				= $this->db->get_where('gambar2', ['status_approve' => 0, 'prepared_by' => $session['id_user'], 'nama_file !=' => null])->result();

		$this->template->set([
			'title' 	=> 'Index Koreksi Dokumen',
			'row' 		=> $get_Data,
			'jabatan' 	=> $jabatan,
			'doc1' 		=> $doc1,
			'doc2' 		=> $doc2,
			'doc3' 		=> $doc3,
		]);

		$this->template->render('index_koreksi');
	}

	public function addkoreksi()
	{
		$this->auth->restrict($this->viewPermission);
		$session 	= $this->session->userdata('app_session');
		$jabatan 	= $session['id_jabatan'];

		$id    		= $this->input->post('id');
		$table    	= $this->input->post('table');
		$nama_file 	= $this->input->post('file');

		$data = $this->db->query("SELECT * FROM view_koreksi WHERE nm_table='$table' AND id_dokumen='$id'")->result();

		// $uri3 = $this->uri->segment(3);
		// $uri4 = $this->uri->segment(4);
		// $uri5 = $this->uri->segment(5);
		// $uri6 = $this->uri->segment(4);

		// $this->template->set('uri3', $uri3);
		// $this->template->set('uri4', $uri4);
		// $this->template->set('uri5', $uri5);
		// $this->template->set('uri6', $uri6);

		$id    		= $this->input->post('id');
		$table    	= $this->input->post('table');
		$nama_file 	= $this->input->post('file');

		if ($table == 'gambar') {
			$detail				= $this->Folders_model->getData('gambar', 'id', $id);
		} else if ($table == 'gambar1') {
			$detail				= $this->Folders_model->getData('gambar1', 'id', $id);
		} else if ($table == 'gambar2') {
			$detail				= $this->Folders_model->getData('gambar2', 'id', $id);
		}

		$this->template->set('jabatan', $jabatan);
		$this->template->set('id', $id);
		$this->template->set('table', $table);
		$this->template->set('data', $detail);
		$this->template->set('nama_file', $nama_file);
		$this->template->set('row', $data);
		$this->template->render('input_koreksi');
	}

	public function saveKoreksi()
	{
		$id = $this->input->post('id');
		$table = $this->input->post('table');


		$getRevisi = $this->db->query("SELECT revisi FROM $table WHERE id='$id' ")->row();
		$revisi    = $getRevisi->revisi + 1;

		$data_update = array(
			'status_approve'    => 1,
			'modified_on'	    => date('Y-m-d H:i:s'),
			'modified_by'		=> $this->auth->user_id()
		);
		$where      = array(
			'id' => $this->input->post('id'),
		);

		$this->Folders_model->getUpdateData($table, $data_update, $where);
	}

	public function simpan_koreksi()
	{

		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload
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
		$id_detail 	= $this->input->post('id');
		$table      = $this->input->post('table');

		$Arr_Kembali			= array();
		$insert = $this->db->query("SELECT * FROM $table WHERE id='$id_detail'")->row();
		$norev  = $insert->revisi;

		if ($insert->id_review != '') {
			$approve	= '1';
			$data['review_by']		= null;
			$data['review_on']		= null;
		} else {
			$approve	= '2';
		}

		$this->db->trans_begin();
		if ($ukuran > 0) {
			$data['id_master']		= $id_master;
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data['revisi']	        = $norev;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['status_approve']	= $approve;
			$data['approval_by']	= null;
			$data['approval_on']	= null;

			$data_insert = array(
				'deskripsi'	        => $insert->deskripsi,
				'nama_file'        	=> $insert->nama_file,
				'ukuran_file'       => $insert->ukuran_file,
				'tipe_file'         => $insert->tipe_file,
				'lokasi_file'	    => $insert->lokasi_file,
				'created_by'		=> $insert->created_by,
				'created'	    	=> $insert->created,
				'id_master'	    	=> $insert->id_master,
				'id_approval'	    => $insert->id_approval,
				'status_approve'	=> $approve,
				'revisi'	        => $norev,
				'id_dokumen'	    => $insert->id,
				'nm_table'	        => $table

			);

			$update = $this->Folders_model->getUpdate('gambar', $data, 'id', $this->input->post('id'));
			if ($update) {
				$this->db->insert("tbl_history", $data_insert);
			}
		} else {
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $id_master;
			$data['id']		        = $id_detail;
			if ($insert->id_review != '') {
				$data['status_approve']	= 1;
			} else {
				$data['status_approve']	= 2;
			}
			$update = $this->Folders_model->getUpdate('gambar', $data, 'id', $this->input->post('id'));
		}
		$koreksi = [
			'id_dokumen'    => $insert->id,
			'nm_table'    	=> $table,
			'keterangan'    => $this->input->post('keterangan'),
			'created_by'	=> $insert->created_by,
			'created_on'	=> $insert->created,
			'revisi'    	=> $norev,
		];

		$this->db->insert('tbl_approval', $koreksi);

		if ($this->db->trans_status() === TRUE) {
			$this->db->trans_commit();
			$Arr_Kembali		= array(
				'status'		=> 1,
				'pesan'			=> 'Update Document Success. Thank you & have a nice day.......'
			);
			$keterangan 		= 'Berhasil Update Dokumen';
			$status 			= 1;
			$nm_hak_akses 		= $this->addPermission;
			$kode_universal 	= $this->input->post('id_master');
			$jumlah 			= 1;
			$sql 				= $this->db->last_query();
			simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
		} else {
			$this->db->trans_rollback();
			$Arr_Kembali		= array(
				'status'		=> 2,
				'pesan'			=> 'Add gambar failed. Please try again later......'
			);
		}
		echo json_encode($Arr_Kembali);
	}

	public function simpan_koreksi1()
	{
		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload
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
		$id_detail 	= $this->input->post('id');
		$table      = $this->input->post('table');

		$insert = $this->db->query("SELECT * FROM $table  WHERE id='$id_detail'")->row();
		$norev  = $insert->revisi;
		if ($insert->id_review != '') {
			$approve	= '1';
		} else {
			$approve	= '2';
		}

		$Arr_Kembali			= array();

		if ($ukuran > 0) {
			$data					= $this->input->post();
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data['revisi']			= $norev;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['status_approve']	= $approve;

			$data_insert = array(
				'deskripsi'	        => $insert->deskripsi,
				'nama_file'        	=> $insert->nama_file,
				'ukuran_file'       => $insert->ukuran_file,
				'tipe_file'         => $insert->tipe_file,
				'lokasi_file'	    => $insert->lokasi_file,
				'created_by'		=> $insert->created_by,
				'created'	    	=> $insert->created,
				'id_master'	    	=> $insert->id_master,
				'id_detail'	    	=> $insert->id_detail,
				'id_approval'	    => $insert->id_approval,
				'status_approve'	=> $insert->status_approve,
				'revisi'	        => $norev,
				'id_dokumen'	    => $insert->id,
				'nm_table'	        => $table

			);

			$update = $this->Folders_model->getUpdate('gambar1', $data, 'id', $this->input->post('id'));
			if ($update) {
				$this->db->insert("tbl_history", $data_insert);
			}
		} else {
			$data					= $this->input->post();
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $id_master;
			$data['id_detail']		= $id_detail;
			$data['status_approve']	= $approve;

			$update = $this->Folders_model->getUpdate('gambar1', $data, 'id', $this->input->post('id'));
		}

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
	}

	public function simpan_koreksi2()
	{

		$config['upload_path'] = './assets/files/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = false; //Enkripsi nama yang terupload


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
		$id_detail 	= $this->input->post('id');
		$table      = $this->input->post('table');
		$insert = $this->db->query("SELECT * FROM $table WHERE id='$id_detail' ")->row();
		$norev  = $insert->revisi;
		if ($insert->id_review != '0') {
			$approve	= '1';
		} else {
			$approve	= '2';
		}

		$Arr_Kembali			= array();

		if ($ukuran > 0) {
			$data					= $this->input->post();
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data['revisi']			= $norev;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');

			$data_insert = array(
				'deskripsi'	        => $insert->deskripsi,
				'nama_file'        	=> $insert->nama_file,
				'ukuran_file'       => $insert->ukuran_file,
				'tipe_file'         => $insert->tipe_file,
				'lokasi_file'	    => $insert->lokasi_file,
				'created_by'		=> $insert->created_by,
				'created'	    	=> $insert->created,
				'id_master'	    	=> $insert->id_master,
				'id_detail'	    	=> $insert->id_detail,
				'id_detail1'	    => $insert->id_detail1,
				'id_approval'	    => $insert->id_approval,
				'status_approve'	=> $approve,
				'revisi'	        => $norev,
				'id_dokumen'	    => $insert->id,
				'nm_table'	        => $table

			);

			$update = $this->Folders_model->getUpdate('gambar2', $data, 'id', $this->input->post('id'));
			if ($update) {
				$this->db->insert("tbl_history", $data_insert);
			}
		} else {
			//$data					= $this->input->post();
			$data_session			= $this->session->userdata;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $id_master;
			$data['id_detail']		= $id_detail;
			$data['status_approve']	= $approve;
			$update = $this->Folders_model->getUpdate('gambar2', $data, 'id', $this->input->post('id'));
		}

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
	}

	public function review()
	{
		$this->auth->restrict($this->viewPermission);
		$session 	= $this->session->userdata('app_session');
		$prsh 		= $session['id_perusahaan'];
		$cbg 		= $session['id_cabang'];
		$jabatan 	= $session['id_jabatan'];
		$user    	= $session['id_user'];

		$sts = [
			'0' => 'Revisi',
			'1' => 'Waiting Review',
			'2' => 'Waiting Approval',
			'3' => 'Approve',
		];

		$doc1		= $this->db->order_by("CASE WHEN id_review = '$jabatan' THEN 0 ELSE 1 END", "ASC")->where(['status_approve' => 1, 'id_review' => $jabatan, 'nama_file !=' => null, 'id_perusahaan' => $prsh, 'id_cabang' => $cbg])->get('view_gambar')->result();
		$doc2		= $this->db->order_by("CASE WHEN id_review = '$jabatan' THEN 0 ELSE 1 END", "ASC")->where(['status_approve' => 1, 'id_review' => $jabatan, 'nama_file !=' => null, 'id_perusahaan' => $prsh, 'id_cabang' => $cbg])->get('view_gambar1')->result();
		$doc3		= $this->db->order_by("CASE WHEN id_review = '$jabatan' THEN 0 ELSE 1 END", "ASC")->where(['status_approve' => 1, 'id_review' => $jabatan, 'nama_file !=' => null, 'id_perusahaan' => $prsh, 'id_cabang' => $cbg])->get('view_gambar2')->result();
		$docN1		= $this->db->where(['status_approve' => 1, 'nama_file !=' => null, 'id_perusahaan' => $prsh, 'id_cabang' => $cbg])->get('view_gambar')->result();
		$docN2		= $this->db->where(['status_approve' => 1, 'nama_file !=' => null, 'id_perusahaan' => $prsh, 'id_cabang' => $cbg])->get('view_gambar1')->result();
		$docN3		= $this->db->where(['status_approve' => 1, 'nama_file !=' => null, 'id_perusahaan' => $prsh, 'id_cabang' => $cbg])->get('view_gambar2')->result();

		$this->template->set([
			'doc1' 			=> $doc1,
			'doc2' 			=> $doc2,
			'doc3' 			=> $doc3,
			'docN1' 		=> $docN1,
			'docN2' 		=> $docN2,
			'docN3' 		=> $docN3,
			'prsh' 			=> $prsh,
			'cbg' 			=> $cbg,
			'sts' 			=> $sts,
			'title'			=> 'Index Review Dokumen',
			'idjabatan' 	=> $jabatan,
			'iduser' 		=> $user,
		]);

		$this->template->set_theme('dashboard');
		$this->template->page_icon('fa fa-folder-open');
		$this->template->render('index_review');
	}

	public function review_form()
	{
		$this->auth->restrict($this->viewPermission);
		$session 	= $this->session->userdata('app_session');
		$jabatan 	= $session['id_jabatan'];
		$id    		= $this->input->post('id');
		$table    	= $this->input->post('table');
		$nama_file 	= $this->input->post('file');
		$detail		= $this->Folders_model->getData($table, 'id', $id);
		$corr 		= $this->db->query("SELECT * FROM view_koreksi WHERE nm_table='$table' AND id_dokumen='$id'")->result();
		$rev 		= $this->db->query("SELECT * FROM tbl_replace WHERE nm_table='$table' AND id_dokumen='$id'")->result();

		$this->template->set('jabatan', $jabatan);
		$this->template->set('id', $id);
		$this->template->set('table', $table);
		$this->template->set('nama_file', $nama_file);
		$this->template->set('data', $detail);
		$this->template->set('row', $corr);
		$this->template->set('rev', $rev);
		$this->template->render('review');
	}

	public function saveReview()
	{
		$status 	= $this->input->post('status');
		$id 		= $this->input->post('id');
		$table 		= $this->input->post('table');

		if ($status == 'approve') {
			$getRevisi = $this->db->query("SELECT revisi FROM $table WHERE id='$id' ")->row();
			$revisi    = $getRevisi->revisi;

			$data_update = array(
				'status_approve'    => 2,
				'modified'	    => date('Y-m-d H:i:s'),
				'modified_by'		=> $this->auth->user_id()
			);
			$where      = array(
				'id' => $this->input->post('id'),
			);

			$this->db->trans_begin();
			$this->Folders_model->getUpdateData($table, $data_update, $where);

			if ($this->input->post('keterangan') != '') {
				$data_insert = array(
					'keterangan'        => $this->input->post('keterangan'),
					'id_dokumen'        => $this->input->post('id'),
					'nm_table'          => $this->input->post('table'),
					'revisi'            => $revisi,
					'created_on'	    => date('Y-m-d H:i:s'),
					'created_by'		=> $this->auth->user_id()
				);

				$this->db->insert("tbl_approval", $data_insert);
			}
		} elseif ($status == 'revisi') {

			$getRevisi = $this->db->query("SELECT revisi FROM $table WHERE id='$id' ")->row();
			$revisi    = $getRevisi->revisi + 1;

			$data_update = array(
				'status_approve'    => 0,
				'revisi'            => $revisi,
				'modified'	    	=> date('Y-m-d H:i:s'),
				'modified_by'		=> $this->auth->user_id()
			);
			$where      = array(
				'id' => $this->input->post('id'),
			);

			$data_insert = array(
				'keterangan'        => $this->input->post('keterangan'),
				'id_dokumen'        => $this->input->post('id'),
				'nm_table'          => $this->input->post('table'),
				'revisi'            => $revisi,
				'created_on'	    => date('Y-m-d H:i:s'),
				'created_by'		=> $this->auth->user_id()
			);

			$this->Folders_model->getUpdateData($table, $data_update, $where);
			$this->db->insert("tbl_approval", $data_insert);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Arr_Return		= array(
				'status'		=> 2,
				'pesan'			=> 'Save Process Failed. Please Try Again...'
			);
		} else {
			$this->db->trans_commit();
			$Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. ',
			);
		}
		echo json_encode($Arr_Return);
	}
}
