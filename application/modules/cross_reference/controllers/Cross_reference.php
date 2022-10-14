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
		$data		= $this->db->get_where('requirements', ['company_id' => $this->company, 'status' => '1', 'deleted_at' => null])->result();

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
		$Data 			= $this->db->get_where('view_cross_reference_details', ['procedure_id like' => "%$id%"])->result();

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
		$Data 			= $this->db->get_where('requirements', ['company_id' => $this->company, 'id' => $id])->row();
		$Detail 		= $this->db->get_where('requirement_details', ['requirement_id' => $id])->result();
		$procedures 	= $this->db->get_where('procedures', ['company_id' => $this->company, 'status' => '1'])->result();
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
		$Data 			= $this->db->get_where('requirements', ['company_id' => $this->company, 'id' => $id])->row();
		$Detail 		= $this->db->get_where('requirement_details', ['requirement_id' => $id])->result();
		$procedures 	= $this->db->get_where('procedures', ['company_id' => $this->company, 'status' => '1'])->result();
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
		$id 			= ($Data['standard']) ?: '';

		$this->db->trans_begin();

		if ($Data && $Detail) {
			unset($Data['standard']);
			unset($Data['detail']);
			if ($Data) {
				$Data['company_id'] 	= $this->company;
				if (($id)) {
					$Data['modified_by'] = $this->auth->user_id();
					$Data['modified_at'] = date('Y-m-d H:i:s');
					$this->db->update('requirements', $Data, ['id' => $id]);
				}
			}

			if ($Detail) {
				$procedure = '';
				foreach ($Detail as $dtl) :

					$dtl['requirement_id'] 	= $id;
					if (isset($dtl['procedure'])) {
						$procedure 			= implode(',', $dtl['procedure']);
						$dtl['process'] 		= $procedure;

						unset($dtl['procedure']);
						if (isset($dtl['id']) && $dtl['id']) {
							$dtl['other_docs'] 		= ($dtl['other_docs']) ?: null;
							$dtl['modified_by'] = $this->auth->user_id();
							$dtl['modified_at'] = date('Y-m-d H:i:s');
							$this->db->update('requirement_details', $dtl, ['id' => $dtl['id']]);
						}
					}

					if ($dtl['other_docs']) {
						if (isset($dtl['id']) && $dtl['id']) {
							$dtl['other_docs'] 		= ($dtl['other_docs']) ?: null;
							$dtl['modified_by'] = $this->auth->user_id();
							$dtl['modified_at'] = date('Y-m-d H:i:s');
							$this->db->update('requirement_details', $dtl, ['id' => $dtl['id']]);
						}
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
