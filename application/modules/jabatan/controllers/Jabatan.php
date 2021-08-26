<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Jabatan
 */

class Jabatan extends Admin_Controller
{

	//Permission
	protected $viewPermission   = "Jabatan.View";
	protected $addPermission    = "Jabatan.Add";
	protected $managePermission = "Jabatan.Manage";
	protected $deletePermission = "Jabatan.Delete";
	protected $approvalPermission = "Jabatan.Approval";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Jabatan/Jabatan_model',
			'Aktifitas/aktifitas_model'
		));

		$this->template->set('title', 'Manage Data Folder');
		$this->template->page_icon('fa fa-folder');

		date_default_timezone_set("Asia/Bangkok");
	}

	public function index()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-user');
		$get_Data        = $this->Jabatan_model->getData('tbl_jabatan');
		$this->template->set('row', $get_Data);
		$this->template->set('title', 'Index Of Jabatan');
		$this->template->render('index');
	}

	public function add()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];


		if ($this->input->post()) {

			$Arr_Kembali			= array();
			$data_session			= $this->session->userdata;
			// $data['created_by']		= $data_session['User']['username']; 
			// $data['created']		= date('Y-m-d H:i:s');
			$data['nm_jabatan']	= $this->input->post('nm_jabatan');
			$data['id_perusahaan']  = $prsh;
			$data['id_cabang']		= $cbg;

			if ($this->Jabatan_model->simpan('tbl_jabatan', $data)) {
				$Arr_Kembali		= array(
					'status'		=> 1,
					'pesan'			=> 'Add Jabatan Success. Thank you & have a nice day.......'
				);

				$keterangan = 'Berhasil Simpan Folder';
				$status = 1;
				$nm_hak_akses = $this->addPermission;
				$kode_universal = $this->input->post('nama_master');
				$jumlah = 1;
				$sql = $this->db->last_query();
				simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
			} else {
				$Arr_Kembali        = array(
					'status'        => 2,
					'pesan'            => 'Add Jabatan failed. Please try again later......'
				);
			}
			echo json_encode($Arr_Kembali);
		} else {



			$this->template->page_icon('fa fa-user');
			$this->template->title('Create Jabatan ');
			$this->template->render('add_jabatan');
		}
	}

	public function add_pejabat()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');

		$id_jabatan		= $this->input->get('id_jabatan');
		$get_Data		= $this->Jabatan_model->getData('tbl_jabatan', 'id', $id_jabatan);

		$users	= $this->db->query("SELECT * FROM users WHERE nm_lengkap != 'Administrator' ORDER BY nm_lengkap ASC")->result_array();

		$option = '';
		foreach ($users as $key => $value) {
			$option .= "<option value='" . $value['id_user'] . "'>" . $value['nm_lengkap'] . "</option>";
		}

		$data = [
			'users' => $option
		];
		$this->template->set('results', $data);



		$this->template->page_icon('fa fa-folder-open');
		$this->template->set('jabatan', $id_jabatan);
		$this->template->set('row', $get_Data);
		$this->template->title('Add Pejabat');
		$this->template->render('add_pejabat');
	}

	public function savePejabat()
	{
		$this->auth->restrict($this->viewPermission);
		$session = $this->session->userdata('app_session');
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];
		// print_r($this->input->post());
		// exit;
		$this->db->trans_begin();
		$data = [
			'id_jabatan'	    => $this->input->post('id_jabatan'),
			'id_user'	        => $this->input->post('user'),
			'id_perusahaan'     => $prsh,
			'id_cabang'         => $cbg,

		];

		$insert = $this->db->insert("tbl_pejabat", $data);

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


	public function load_pejabat()
	{
		$session = $this->session->userdata('app_session');
		// $id_user = $session['id_user'];
		$prsh    = $session['id_perusahaan'];
		$cbg     = $session['id_cabang'];

		// $ENABLE_ADD     = has_permission('MoM.Add');
		// $ENABLE_MANAGE  = has_permission('MoM.Manage');
		// $ENABLE_VIEW    = has_permission('MoM.View');
		// $ENABLE_DELETE  = has_permission('MoM.Delete');
		// $ENABLE_APPROVE  = has_permission('Meeting.Approval');

		$kd_meeting	= $_POST['cari'];
		$session = $this->session->userdata('app_session');
		//$divisi  = $session['id_div']; 
		//$where   =array('kd_meeting'=> $kd_meeting, 'id_perusahaan'=>$prsh, 'id_cabang'=>$cbg );
		$numb = 1;
		$data = $this->db->query("SELECT a.*, b.nm_lengkap FROM tbl_pejabat a
        INNER JOIN users b on a.id_user = b.id_user
		WHERE a.id_jabatan='$kd_meeting' AND a.id_perusahaan='$prsh' AND a.id_cabang='$cbg'")->result();

		// print_r ($data);
		// exit;
		if ($data != 0) {

			echo "	<table id='example1' class='table table-bordered table-striped'>
					<tr>
						<td align='center' width='4%'><b>No</td>
						<td align='left' width='8%'><b>Nama Karyawan</td>
						
					</tr>";
			$n = 0;
			foreach ($data as $d) {
				$n++;

				echo "<tr class='view$n'>
				<td align='center'>$n</td>
				<td align='left'>$d->nm_lengkap</td>";







				echo "</tr>";
			}

			echo "</table>";
		} else {
			echo "Belum Ada Karyawan";
		}
	}
}
