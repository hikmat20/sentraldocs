<?php

use Mpdf\Tag\Details;

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Folders
 */

class Cross_reference extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Aktifitas/aktifitas_model'
		));

		$this->template->set('title', 'List Procedures');
		$this->template->set('icon', 'fa fa-cog');

		date_default_timezone_set("Asia/Bangkok");
		$this->status = [
			'0' => '<span class="badge badge-danger">Invalid</span>',
			'1' => '<span class="badge badge-primary">Valid</span>'
		];
	}

	public function index()
	{
		$data		= $this->db->get_where('view_cross_references', ['status' => '1', 'deleted_at' => null])->result();

		$this->template->set('title', 'Cross Reference');
		$this->template->set('data', $data);
		$this->template->set('status', $this->status);
		$this->template->render('index');
	}

	public function pasal_to_process()
	{
		$data		= $this->db->get_where('requirements', ['deleted_at' => null])->result();

		$this->template->set('title', 'Cross Reference (Pasal to Proses)');
		$this->template->set('data', $data);
		$this->template->set('status', $this->status);
		$this->template->render('pasal_to_proses');
	}

	public function process_to_pasal()
	{
		$data		= $this->db->get_where('procedures', ['status' => '1', 'deleted_at' => null])->result();

		$this->template->set('title', 'Cross Reference (Pasal to Proses)');
		$this->template->set('data', $data);
		$this->template->set('status', $this->status);
		$this->template->render('proses_to_pasal');
	}

	public function select_procedure($id = '')
	{
		$Data 			= $this->db->get_where('view_cross_reference_details', ['procedure_id like' => "%$id%"])->result();

		$Data_detail 	= $this->db->get_where('requirement_details', ['requirement_id' => $id])->result();
		$procedure 		= $this->db->get_where('procedures', ['status' => '1', 'deleted_by' => null])->result();

		$this->template->set('Data', $Data);
		$this->template->set('Data_detail', $Data_detail);
		$this->template->set('procedure', $procedure);
		$this->template->render('load_proses');
	}
	public function select_standard($id = '')
	{
		$Data 			= $this->db->get_where('requirements', ['id' => $id])->row();
		$Data_detail 	= $this->db->get_where('requirement_details', ['requirement_id' => $id])->result();
		$procedure 		= $this->db->get_where('procedures', ['status' => '1', 'deleted_by' => null])->result();

		$this->template->set('Data', $Data);
		$this->template->set('Data_detail', $Data_detail);
		$this->template->set('procedure', $procedure);
		$this->template->render('load_pasal');
	}

	public function edit($id = '')
	{
		$Data 			= $this->db->get_where('view_cross_references', ['id' => $id])->row();
		$Detail 		= $this->db->get_where('view_cross_reference_details', ['reference_id' => $id])->result();
		$procedures 	= $this->db->get_where('procedures', ['status' => '1'])->result();
		$list_procedure = [];

		foreach ($procedures as $pro) {
			$list_procedure[$pro->id] = "<span class='badge badge-success m-1'>" . $pro->name . "</span>";
		}

		$this->template->set([
			'Data' 				=> $Data,
			'Detail' 			=> $Detail,
			'list_procedure' 	=> $list_procedure,
			'procedures' 		=> $procedures,
		]);
		$this->template->render('edit');
	}

	public function view($id = '')
	{
		$Data 			= $this->db->get_where('view_cross_references', ['id' => $id])->row();
		$Detail 		= $this->db->get_where('view_cross_reference_details', ['reference_id' => $id])->result();
		$procedures 	= $this->db->get_where('procedures', ['status' => '1'])->result();
		$list_procedure = [];

		foreach ($procedures as $pro) {
			$list_procedure[$pro->id] = "<span class='badge badge-success m-1'>" . $pro->name . "</span>";
		}

		$this->template->set([
			'Data' 				=> $Data,
			'Detail' 			=> $Detail,
			'list_procedure' 	=> $list_procedure,
		]);

		$this->template->render('view_pasal_to_process');
	}

	public function view_pasal($id = '')
	{
		$Data 		= $this->db->get_where('requirement_details', ['id' => $id])->row();
		echo json_encode($Data);
	}


	public function save()
	{
		$Data 			= $this->input->post();
		$Detail 		= $this->input->post('detail');
		$requirement_id = $Data['standard'];
		unset($Data['detail']);
		$reff_id = '';

		$this->db->trans_begin();

		if ($Data && $Detail) {
			if ($Data) {
				unset($Data['standard']);
				$Data['company_id'] 	= $this->company;
				$Data['requirement_id'] = $requirement_id;
				if (isset($Data['id'])) {
					$Data['modified_by'] = $this->auth->user_id();
					$Data['modified_at'] = date('Y-m-d H:i:s');
					$this->db->update('cross_references', $Data, ['id' => $Data['id']]);
					$reff_id = $Data['id'];
				} else {
					$Data['created_by'] = $this->auth->user_id();
					$Data['created_at'] = date('Y-m-d H:i:s');
					$this->db->insert('cross_references', $Data);
					$last = $this->db->order_by('id', 'DESC')->get_where('cross_references')->row()->id;
					$reff_id = $last;
				}
			}

			if ($Detail) {
				$procedure = '';
				foreach ($Detail as $dtl) :
					if (isset($dtl['procedure'])) {
						$procedure = implode(',', $dtl['procedure']);
					}
					unset($dtl['procedure']);

					$dtl['reference_id'] = $reff_id;
					$dtl['requirement_id'] = $requirement_id;
					$dtl['procedure_id'] = $procedure;

					if (isset($dtl['id']) && $dtl['id']) {
						$dtl['modified_by'] = $this->auth->user_id();
						$dtl['modified_at'] = date('Y-m-d H:i:s');
						$this->db->update('cross_reference_details', $dtl, ['id' => $dtl['id']]);
					} else {
						$dtl['created_by'] = $this->auth->user_id();
						$dtl['created_at'] = date('Y-m-d H:i:s');
						$this->db->insert('cross_reference_details', $dtl);
					}
				endforeach;
			}
		} else {
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Data not valid. Please try again.',
			);
			echo json_encode($Return);
			return false;
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Data Procedure failed to save. Please try again.',
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Data Procedure successfully saved..',
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
