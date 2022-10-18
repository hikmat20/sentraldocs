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
		$data		= $this->db->get_where('view_cross_references', ['company_id' => $this->company, 'status' => '1', 'deleted_at' => null])->result();

		$this->template->set('title', 'Cross Reference');
		$this->template->set('data', $data);
		$this->template->set('status', $this->status);
		$this->template->render('index');
	}

	public function pasal_to_process()
	{
		$data		= $this->db->get_where('requirements', ['company_id' => $this->company, 'deleted_at' => null])->result();

		$this->template->set('title', 'Cross Reference (Pasal to Proses)');
		$this->template->set('data', $data);
		$this->template->set('status', $this->status);
		$this->template->render('pasal_to_proses');
	}

	public function process_to_pasal()
	{
		$data		= $this->db->get_where('procedures', ['company_id' => $this->company, 'status' => '1', 'deleted_at' => null])->result();

		$this->template->set('title', 'Cross Reference (Pasal to Proses)');
		$this->template->set('data', $data);
		$this->template->set('status', $this->status);
		$this->template->render('proses_to_pasal');
	}

	public function select_procedure($id = '')
	{
		// $Data 			= $this->db->get_where('view_cross_reference_details', ['procedure_id like' => "%$id%"])->result();
		$this->db->select('*')->from('view_cross_reference_details');
		$this->db->group_start();
		$this->db->where("find_in_set($id, procedure_id)");
		// foreach ([$id] as $value) {
		// }
		$this->db->group_end();
		$Data = $this->db->get()->result();

		$Data_detail 	= $this->db->get_where('requirement_details', ['requirement_id' => $id])->result();
		$procedure 		= $this->db->get_where('procedures', ['company_id' => $this->company, 'status' => '1', 'deleted_by' => null])->result();

		$this->template->set('Data', $Data);
		$this->template->set('Data_detail', $Data_detail);
		$this->template->set('procedure', $procedure);
		$this->template->render('load_proses');
	}

	public function select_standard($id = '')
	{
		$Data 			= $this->db->get_where('requirements', ['company_id' => $this->company, 'id' => $id])->row();
		$Data_detail 	= $this->db->get_where('requirement_details', ['requirement_id' => $id])->result();
		$procedure 		= $this->db->get_where('procedures', ['company_id' => $this->company, 'status' => '1', 'deleted_by' => null])->result();

		$this->template->set('Data', $Data);
		$this->template->set('Data_detail', $Data_detail);
		$this->template->set('procedure', $procedure);
		$this->template->render('load_pasal');
	}

	public function cross_pasal($id = '')
	{
		$Detail 		= $ArrPro = [];
		$other_docs 	= '';

		$DataStd 		= $this->db->get_where('requirements', ['id' => $id])->row();
		$DetailStd 		= $this->db->get_where('requirement_details', ['requirement_id' => $id])->result_array();

		$Data 			= $this->db->get_where('view_cross_references', ['company_id' => $this->company, 'id' => $id])->row();

		if ($Data) {
			$Detail 		= $this->db->get_where('view_cross_reference_details', ['requirement_id' => $Data->requirement_id, 'reference_id' => $Data->id])->result_array();
			$combine = array_combine(array_column($Detail, 'chapter_id'), array_column($Detail, 'procedure_id'));
			foreach ($combine as $k => $com) {
				$ArrPro[$k] = explode(",", $com);
			}

			$other_docs = array_combine(array_column($Detail, 'chapter_id'), array_column($Detail, 'other_docs'));
		}

		$procedures 	= $this->db->get_where('procedures', ['company_id' => $this->company, 'status' => '1'])->result_array();
		$list_procedure = [];
		foreach ($procedures as $pro) {
			$list_procedure[$pro['id']] = "<span class='badge badge-success m-1'>" . $pro['name'] . "</span>";
		}

		$this->template->set([
			'DataStd' 			=> $DataStd,
			'Data' 				=> $Data,
			'Detail' 			=> $Detail,
			'list_procedure' 	=> $list_procedure,
			'procedures' 		=> $procedures,
			'DetailStd' 		=> $DetailStd,
			'ArrPro' 			=> $ArrPro,
			'other_docs' 		=> $other_docs,
		]);
		$this->template->render('edit');
	}

	public function cross()
	{
		$Data 			= $this->db->get_where('requirements', ['company_id' => $this->company, 'status' => '1'])->result();

		$this->template->set([
			'Data' 				=> $Data,
		]);

		$this->template->render('cross');
	}

	public function view($id = '')
	{
		$Data 			= $this->db->get_where('view_cross_references', ['company_id' => $this->company, 'id' => $id])->row();
		$Detail 		= $this->db->get_where('requirement_details', ['requirement_id' => $Data->requirement_id])->result();
		$DetailCross	= $this->db->get_where('view_cross_reference_details', ['reference_id' => $id])->result_array();
		$Procedure		= array_combine(array_column($DetailCross, 'chapter_id'), array_column($DetailCross, 'procedure_id'));

		$procedures 	= $this->db->get_where('procedures', ['company_id' => $this->company, 'status' => '1'])->result();
		$list_procedure = [];

		foreach ($procedures as $pro) {
			$list_procedure[$pro->id] = "<span class='badge badge-success m-1'>" . $pro->name . "</span>";
		}

		$this->template->set([
			'Data' 				=> $Data,
			'Detail' 			=> $Detail,
			'list_procedure' 	=> $list_procedure,
			'Procedure' 			=> $Procedure,
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
		$id 			= ($Data['id']) ?: '';
		$requirement_id = ($Data['requirement_id']) ?: '';

		$this->db->trans_begin();
		unset($Data['id']);
		unset($Data['detail']);
		if ($Data && $Detail) {
			if ($Data) {
				$Data['company_id'] 	 = $this->company;

				if (($id)) {
					$Data['modified_by'] = $this->auth->user_id();
					$Data['modified_at'] = date('Y-m-d H:i:s');
					$this->db->update('cross_references', $Data, ['id' => $id]);
				} else {
					$Data['created_by'] = $this->auth->user_id();
					$Data['created_at'] = date('Y-m-d H:i:s');
					$this->db->insert('cross_references', $Data);
				}
			}

			if ($Detail) {
				$reference_id = $this->db->order_by('id', 'DESC')->get_where('cross_references')->row();
				foreach ($Detail as $dtl) :
					$dtlId 					= $dtl['id'];
					$dtl['reference_id'] 	= ($id) ?: $reference_id->id;
					$dtl['requirement_id'] 	= $requirement_id;
					$dtl['other_docs'] 		= ($dtl['other_docs']) ?: null;

					$procedure = '';
					if (isset($dtl['procedure_id'])) {
						$procedure 			= implode(',', $dtl['procedure_id']);
						$dtl['procedure_id'] = $procedure;
					} else {
						$dtl['procedure_id'] = $procedure;
					}


					if ((isset($dtl['id']) && $dtl['id'])) {
						$dtl['modified_by'] = $this->auth->user_id();
						$dtl['modified_at'] = date('Y-m-d H:i:s');
						$this->db->update('cross_reference_details', $dtl, ['id' => $dtl['id']]);
					} else if (($dtl['procedure_id']) || ($dtl['other_docs'])) {
						unset($dtl['id']);
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
}