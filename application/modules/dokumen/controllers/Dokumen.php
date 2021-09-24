<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Folders
 */

class Dokumen extends Admin_Controller
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
		$get_Data		= $this->Folders_model->getData('master_gambar');
		$this->template->page_icon('fa fa-folder-open');
		$this->template->set('title', 'Index Of Folders');
		$this->template->set_theme('dashboard');
		$this->template->set('row', $get_Data);
		$this->template->render('index_new');
	}

	public function subfolder()
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
		echo '<pre>';
		print_r($id . ", " . $table);
		echo '<pre>';
		exit;
		if ($nama_file) {
			$return = [
				'status' => 0,
				'msg' => 'File Tidak di distribusikan.'
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

		if ($file) {
			$path   	= file_get_contents("./assets/files/$file->nama_file");
			force_download($file->nama_file, $path);
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



	//SUB DOKUMEN 2

	public function detail2()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');

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
			$data['id_detail1']		= $id_detail1;


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
				$data['nama_file']	    = $gambar;
				$data['ukuran_file']	= $ukuran;
				$data['tipe_file']		= $ext;
				$data['lokasi_file']	= $lokasi;
				$data_session			= $this->session->userdata;
				$data['created_by']		= $this->auth->user_id();
				$data['created']		= date('Y-m-d H:i:s');
				$data['id_master']		= $id_master;
				$data['id_detail']		= $id_detail;
				$data['id_detail1']		= $id_detail1;
			} else {
				$data					= $this->input->post();
				$data_session			= $this->session->userdata;
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
		$id_master = $this->db->query("SELECT * FROM gambar2 WHERE id='$id'")->row();
		$iddetail = $id_master->id_detail;
		$nme    =   $id_master->nama_file;
		$pth    =   file_get_contents(base_url() . "./assets/files/" . $nme);

		force_download($nme, $pth);

		redirect(site_url('dokumen'));
	}



	function delete_detail2($id)
	{
		$id_master = $this->db->query("SELECT * FROM gambar2 WHERE id='$id'")->row();
		$iddetail   = $id_master->id_detail;
		$iddetail1  = $id_master->id_detail1;
		// print_r($idmaster);
		// exit;
		$this->db->where('id', $id);
		$query = $this->db->get('gambar2');
		$path = $query->row();
		unlink("./assets/files/$path->nama_file");
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
			redirect(site_url('Folders/detail2?id_detail1=' . $iddetail1));
		}
	}


	public function add_subdetail3()
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

	//END SUB DOKUMEN 2

	//APPROVE
	public function approve()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$jabatan = $session['id_jabatan'];
		$user    = $session['id_user'];
		$this->template->page_icon('fa fa-folder-open');
		$get_Data		= $this->Folders_model->getData('master_gambar');
		$this->template->set('row', $get_Data);
		$this->template->set('title', 'Index Of Dokumen');
		$this->template->set('jabatan', $jabatan);
		$this->template->set('user', $user);
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
		// print_r($nama_file);
		// exit;

		$data = $this->db->query("SELECT * FROM tbl_approval WHERE nm_table='$table' AND id_dokumen='$id'")->result();
		$data1 = $this->db->query("SELECT * FROM tbl_replace WHERE nm_table='$table' AND id_dokumen='$id'")->result();
		$data2 = $this->db->query("SELECT * FROM tbl_replace WHERE nm_table='$table' AND id_dokumen='$id'")->result();

		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$uri5 = $this->uri->segment(5);
		$uri6 = $this->uri->segment(4);

		$this->template->set('uri3', $uri3);
		$this->template->set('uri4', $uri4);
		$this->template->set('uri5', $uri5);
		$this->template->set('uri6', $uri6);


		$this->template->set('jabatan', $jabatan);
		$this->template->set('id', $id);
		$this->template->set('table', $table);
		$this->template->set('nama_file', $nama_file);
		$this->template->set('row', $data);
		$this->template->set('row1', $data1);
		$this->template->set('row2', $data2);
		$this->template->render('approval');
	}


	public function saveApproval()
	{


		$status = $this->input->post('status');
		$id = $this->input->post('id');
		$table = $this->input->post('table');

		// print_r($table);
		// exit;

		//$this->db->trans_begin();

		if ($status == 'approve') {

			$getRevisi = $this->db->query("SELECT * FROM $table WHERE id='$id' ")->row();
			if ($getRevisi->status_revisi == '1') {
				$revisi    = $getRevisi->revisi + 1;
				$statusrev = '0';
			} else {
				$revisi    = $getRevisi->revisi;
				$statusrev = $getRevisi->status_revisi;
			}

			$data_update = array(
				'revisi'           => $revisi,
				'status_approve'    => 2,
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
			$revisi    = $getRevisi->revisi;

			// print_r($revisi);
			// exit;

			$data_update = array(
				'status_approve'    => 0,
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
			$file = $this->db->get_where('xgambar1', ['id' => $id])->row();

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


	//APPROVE
	public function koreksi()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$jabatan = $session['id_jabatan'];
		$this->template->page_icon('fa fa-folder-open');
		$get_Data		= $this->Folders_model->getData('master_gambar');
		$this->template->set('row', $get_Data);
		$this->template->set('title', 'Index Of Dokumen');
		$this->template->set('jabatan', $jabatan);
		$this->template->render('index_koreksi');
	}

	public function addkoreksi()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$jabatan = $session['id_jabatan'];

		$id    = $this->input->post('id');
		$table    = $this->input->post('table');
		$nama_file = $this->input->post('file');
		// print_r($nama_file);
		// exit;

		$data = $this->db->query("SELECT * FROM tbl_approval WHERE nm_table='$table' AND id_dokumen='$id'")->result();

		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$uri5 = $this->uri->segment(5);
		$uri6 = $this->uri->segment(4);

		$this->template->set('uri3', $uri3);
		$this->template->set('uri4', $uri4);
		$this->template->set('uri5', $uri5);
		$this->template->set('uri6', $uri6);

		$id    = $this->input->post('id');
		$table    = $this->input->post('table');
		$nama_file = $this->input->post('file');

		if ($table == 'gambar') {
			$detail				= $this->Folders_model->getData('gambar', 'id', $id);
		} else if ($table == 'gambar1') {
			$detail				= $this->Folders_model->getData('gambar1', 'id', $id);
		} else if ($table == 'gambar2') {
			$detail				= $this->Folders_model->getData('gambar2', 'id', $id);
		}
		// print_r($detail);
		// exit;	

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
		$status = $this->input->post('status');
		$id = $this->input->post('id');
		$table = $this->input->post('table');

		// print_r($table);
		// exit;

		//$this->db->trans_begin();



		$getRevisi = $this->db->query("SELECT revisi FROM $table WHERE id='$id' ")->row();
		$revisi    = $getRevisi->revisi + 1;

		// print_r($revisi);
		// exit;

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
			$lokasi = './assets/files/' . $gbr['file_name'] . '.' . $ext;
		}

		$id_master 	= $this->input->post('id_master');
		$id_detail 	= $this->input->post('id');
		$table      = $this->input->post('table');
		// echo"<pre>";print_r($this->input->post());exit;

		$Arr_Kembali			= array();
		$insert = $this->db->query("SELECT * FROM $table WHERE id='$id_detail' ")->row();
		$norev  = $insert->revisi;

		if ($insert->id_review != '0') {
			$approve	= '3';
		} else {
			$approve	= '1';
		}

		if ($ukuran > 0) {
			//$data					= $this->input->post();
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data_session			= $this->session->userdata;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $id_master;
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data_session			= $this->session->userdata;
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
			//$data					= $this->input->post();
			$data_session			= $this->session->userdata;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $id_master;
			$data['id']		        = $id_detail;
			if ($insert->id_review != '0') {
				$data['status_approve']	= 3;
			} else {
				$data['status_approve']	= 1;
			}
			$update = $this->Folders_model->getUpdate('gambar', $data, 'id', $this->input->post('id'));
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
			$lokasi = './assets/files/' . $gbr['file_name'] . '.' . $ext;
		}

		$id_master 	= $this->input->post('id_master');
		$id_detail 	= $this->input->post('id');
		$table      = $this->input->post('table');
		// echo"<pre>";print_r($this->input->post());exit;

		$insert = $this->db->query("SELECT * FROM $table  WHERE id='$id_detail'")->row();
		$norev  = $insert->revisi;
		if ($insert->id_review != '0') {
			$approve	= '3';
		} else {
			$approve	= '1';
		}


		$insert = $this->db->query("SELECT * FROM $table  WHERE id='$id_detail'")->row();
		$norev  = $insert->revisi;

		$Arr_Kembali			= array();

		if ($ukuran > 0) {
			//$data					= $this->input->post();
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data_session			= $this->session->userdata;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $id_master;
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data_session			= $this->session->userdata;
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
			//$data					= $this->input->post();
			$data_session			= $this->session->userdata;
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
			$lokasi = './assets/files/' . $gbr['file_name'] . '.' . $ext;
		}

		$id_master 	= $this->input->post('id_master');
		$id_detail 	= $this->input->post('id');
		$table      = $this->input->post('table');
		// echo"<pre>";print_r($this->input->post());exit;

		$insert = $this->db->query("SELECT * FROM $table WHERE id='$id_detail' ")->row();
		$norev  = $insert->revisi;
		if ($insert->id_review != '0') {
			$approve	= '3';
		} else {
			$approve	= '1';
		}

		$insert = $this->db->query("SELECT * FROM $table WHERE id='$id_detail' ")->row();
		$norev  = $insert->revisi;

		$Arr_Kembali			= array();

		if ($ukuran > 0) {
			//$data					= $this->input->post();
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data_session			= $this->session->userdata;
			$data['created_by']		= $this->auth->user_id();
			$data['created']		= date('Y-m-d H:i:s');
			$data['id_master']		= $id_master;
			$data['nama_file']	    = $gambar;
			$data['ukuran_file']	= $ukuran;
			$data['tipe_file']		= $ext;
			$data['lokasi_file']	= $lokasi;
			$data_session			= $this->session->userdata;
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
		$session = $this->session->userdata('app_session');
		$jabatan = $session['id_jabatan'];


		$id    = $this->input->post('id');
		$table    = $this->input->post('table');
		$nama_file = $this->input->post('file');
		// print_r($nama_file);
		// exit;

		$data = $this->db->query("SELECT * FROM tbl_approval WHERE nm_table='$table' AND id_dokumen='$id'")->result();
		$data1 = $this->db->query("SELECT * FROM tbl_replace WHERE nm_table='$table' AND id_dokumen='$id'")->result();
		$data2 = $this->db->query("SELECT * FROM tbl_replace WHERE nm_table='$table' AND id_dokumen='$id'")->result();

		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$uri5 = $this->uri->segment(5);
		$uri6 = $this->uri->segment(4);

		$this->template->set('uri3', $uri3);
		$this->template->set('uri4', $uri4);
		$this->template->set('uri5', $uri5);
		$this->template->set('uri6', $uri6);


		$this->template->set('jabatan', $jabatan);
		$this->template->set('id', $id);
		$this->template->set('table', $table);
		$this->template->set('nama_file', $nama_file);
		$this->template->set('row', $data);
		$this->template->set('row1', $data1);
		$this->template->set('row2', $data2);
		$this->template->render('review');
	}

	public function saveReview()
	{


		$status = $this->input->post('status');
		$id = $this->input->post('id');
		$table = $this->input->post('table');

		// print_r($this->input->post());
		// exit;

		//$this->db->trans_begin();

		if ($status == 'approve') {

			$getRevisi = $this->db->query("SELECT revisi FROM $table WHERE id='$id' ")->row();
			$revisi    = $getRevisi->revisi;

			$data_update = array(

				'status_approve'    => 1,
				'approval_on'	    => date('Y-m-d H:i:s'),
				'approval_by'		=> $this->auth->user_id()
			);
			$where      = array(
				'id' => $this->input->post('id'),
			);

			$this->Folders_model->getUpdateData($table, $data_update, $where);

			if ($this->input->post('keterangan') != '') {
				$data_insert = array(

					'keterangan'        => $this->input->post('keterangan'),
					'id_dokumen'        => $this->input->post('id'),
					'nm_table'          => $this->input->post('table'),
					'revisi'           => $revisi,
					'approval_on'	    => date('Y-m-d H:i:s'),
					'approval_by'		=> $this->auth->user_id()
				);

				$this->db->insert("tbl_approval", $data_insert);
			}
		} elseif ($status == 'revisi') {

			$getRevisi = $this->db->query("SELECT revisi FROM $table WHERE id='$id' ")->row();
			$revisi    = $getRevisi->revisi;

			// print_r($revisi);
			// exit;

			$data_update = array(
				'status_approve'    => 0,
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
}
