<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Folders
 */

class Company_reference extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model('company_reference/Company_reference_model', 'ReferenceModel');

		$this->template->set('title', 'List of Company Audit');
		$this->template->set('icon', 'fa fa-cog');

		date_default_timezone_set("Asia/Bangkok");
	}

	public function index()
	{
		$data		= $this->db->get_where('view_references', ['status' => 'OPN'])->result();
		$done		= $this->db->get_where('view_references', ['status' => 'DONE'])->result();
		$lsStd 		= $this->db->get_where('view_ref_standards')->result();
		$ArrStd = [];
		foreach ($lsStd as $std) {
			$ArrStd[$std->reference_id][] = $std->name;
		}

		$this->template->set([
			'data' 		=> $data,
			'done' 		=> $done,
			'ArrStd' 	=> $ArrStd,
		]);

		$this->template->render('index');
	}

	public function add()
	{
		$Companies 		= $this->db->get_where('companies')->result();
		$standards		= $this->db->get_where('requirements', ['status' => '1'])->result();
		$regulations	= $this->db->get_where('regulations', ['status' => '1'])->result();

		$this->template->set([
			'title' 		=> 'Add Company Reference',
			'Companies' 	=> $Companies,
			'standards' 	=> $standards,
			'regulations' 	=> $regulations
		]);
		$this->template->render('add');
	}

	public function edit($id = '')
	{
		$Data 			= $this->db->get_where('view_references', ['id' => $id, 'status' => 'OPN'])->row();
		$datStd 		= $this->db->get_where('view_ref_standards', ['reference_id' => $id])->result();
		$companies 		= $this->db->get_where('companies')->result();
		$dataReg 		= $this->db->get_where('view_ref_regulations', ['reference_id' => $id])->result();
		$standards		= $this->db->get_where('requirements', ['status' => '1'])->result();
		$regulations	= $this->db->get_where('regulations', ['status' => 'PUB'])->result();

		if ($Data) {
			$this->template->set([
				'title' 		=> 'Edit Company Reference',
				'Data' 			=> $Data,
				'datStd' 		=> $datStd,
				'dataReg' 		=> $dataReg,
				'Companies' 	=> $companies,
				'standards' 	=> $standards,
				'regulations' 	=> $regulations,
			]);
			$this->template->render('edit');
		} else {
			$data = [
				'heading' => 'Error!',
				'message' => 'Data not found..'
			];
			$this->template->render('../views/errors/html/error_404_custome', $data);
		}
	}

	public function save()
	{
		$Data 		= $this->input->post();

		if ($Data) {
			$this->db->trans_begin();
			$saved 	= $this->ReferenceModel->saveData($Data);
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
					'id'			=> $saved['id']
				);
			}
		} else {
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Data not valid, please try again!',
			);
		}

		echo json_encode($Return);
	}

	public function delete()
	{
		$id = $this->input->post('id');

		if (($id)) {
			$this->db->trans_begin();
			$this->db->delete('ref_standards', ['id' => $id]);
		} else {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Data not valid. Please try again.',
			);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Failed to delete data.. Please try again.',
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Successfully deleted data..',
			);
		}

		echo json_encode($Return);
	}

	public function delete_reg()
	{
		$id = $this->input->post('id');
		if (($id)) {
			$this->db->trans_begin();
			$this->db->delete('ref_regulations', ['id' => $id]);
		} else {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Data not valid. Please try again.',
			);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Failed to delete data.. Please try again.',
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Successfully deleted data..',
			);
		}

		echo json_encode($Return);
	}
}
