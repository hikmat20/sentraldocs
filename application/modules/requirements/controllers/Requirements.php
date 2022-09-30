<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Folders
 */

class Requirements extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Aktifitas/aktifitas_model'
		));

		$this->template->set('title', 'Requirements');
		$this->template->set('icon', 'fa fa-cog');

		date_default_timezone_set("Asia/Bangkok");
	}

	public function index()
	{
		$data		= $this->db->get_where('requirements', ['deleted_at' => null])->result();
		$this->template->set('title', 'Index of Standard');
		$this->template->set('data', $data);
		$this->template->render('index');
	}

	public function add()
	{
		$this->template->set('title', 'Add New Standard');
		$this->template->render('add');
	}

	public function edit($id = '')
	{
		$Data 		= $this->db->get_where('requirements', ['id' => $id])->row();
		$Data_list 	= $this->db->get_where('requirement_details', ['requirement_id' => $id])->result();

		$this->template->set([
			'Data' => $Data,
			'Data_list' => $Data_list,
		]);

		$this->template->render('edit');
	}

	public function edit_detail($id = '')
	{
		$Data_list 	= $this->db->get_where('requirement_details', ['id' => $id])->row();
		echo  json_encode($Data_list);
	}

	public function view_detail($id = '')
	{
		$Data_list 	= $this->db->get_where('requirement_details', ['id' => $id])->row();
		echo  json_encode($Data_list);
	}


	public function save()
	{
		$Data 		= $this->input->post();
		$Data_list 	= (isset($Data['list'])) ? $Data['list'] : '';

		$this->db->trans_begin();
		if ($Data) {
			$Data['company_id'] = $this->company;
			unset($Data['list']);
			if (isset($Data['id'])) {
				$Data['modified_by'] = $this->auth->user_id();
				$Data['modified_at'] = date('Y-m-d H:i:s');
				$this->db->update('requirements', $Data, ['id' => $Data['id']]);
			} else {
				$Data['created_by'] = $this->auth->user_id();
				$Data['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('requirements', $Data);
			}
		}

		if ($Data_list) {
			if (isset($Data['id'])) {
				$Data_list['requirement_id'] = $Data['id'];
			} else {
				$req = $this->db->order_by('id', 'DESC')->get_where('requirements')->row();
				$Data_list['requirement_id'] = $req->id;
			}

			if (isset($Data_list['id'])) {
				$Data_list['modified_by'] = $this->auth->user_id();
				$Data_list['modified_at'] = date('Y-m-d H:i:s');
				$this->db->update('requirement_details', $Data_list, ['id' => $Data_list['id']]);
			} else {
				$Data_list['created_by'] = $this->auth->user_id();
				$Data_list['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('requirement_details', $Data_list);
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Data Chapter failed to save. Please try again.',

			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Data Chapter successfully saved..',
				'id'			=> $Data_list['requirement_id']
			);
		}

		echo json_encode($Return);
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
}
