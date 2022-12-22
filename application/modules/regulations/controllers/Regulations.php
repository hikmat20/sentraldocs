<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Regulations extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model('regulations/Regulations_model', 'RegModel');

		$this->template->set('title', 'Index of Regulations');
		$this->template->set('icon', 'fa fa-cog');

		date_default_timezone_set("Asia/Bangkok");
	}

	public function index()
	{
		$data			= $this->db->get_where('regulations', ['status' => 'PUB'])->result();
		$drafts			= $this->db->get_where('regulations', ['status' => 'DFT'])->result();

		$dataRegSjb 	= $this->db->get_where('regulation_subjects')->result();
		$dataRegScp 	= $this->db->get_where('regulation_scopes')->result();

		$ArrRegSjb = [];
		foreach ($dataRegSjb as $dtRegSjb) {
			$ArrRegSjb[$dtRegSjb->regulation_id][] = $dtRegSjb;
		}

		$ArrRegScp = [];
		foreach ($dataRegScp as $dtRegScp) {
			$ArrRegScp[$dtRegScp->regulation_id][] = $dtRegScp;
		}

		$this->template->set('data', $data);
		$this->template->set('drafts', $drafts);
		$this->template->set('ArrRegSjb', $ArrRegSjb);
		$this->template->set('ArrRegScp', $ArrRegScp);
		$this->template->render('index');
	}

	public function add()
	{
		$category 	= $this->db->get_where('regulation_category')->result();
		$scopes 	= $this->db->get_where('scopes')->result();
		$subjects 	= $this->db->get_where('subjects')->result();

		$this->template->set([
			'title' 	=> 'Add New Regulation',
			'category' 	=> $category,
			'scopes' 	=> $scopes,
			'subjects' 	=> $subjects,
		]);
		$this->template->render('add');
	}

	public function edit($id = '')
	{
		$Data 		= $this->db->get_where('regulations', ['id' => $id])->row();
		$category 	= $this->db->get_where('regulation_category')->result();
		$scopes 	= $this->db->get_where('scopes')->result();
		$subjects 	= $this->db->get_where('subjects')->result();

		$dataRegSjb 	= $this->db->get_where('regulation_subjects')->result();
		$dataRegScp 	= $this->db->get_where('regulation_scopes')->result();

		$ArrRegSjb = [];
		foreach ($dataRegSjb as $dtRegSjb) {
			$ArrRegSjb[$dtRegSjb->regulation_id][$dtRegSjb->subject_id] = $dtRegSjb->subject_id;
		}

		$ArrRegScp = [];
		foreach ($dataRegScp as $dtRegScp) {
			$ArrRegScp[$dtRegScp->regulation_id][$dtRegScp->scope_id] = $dtRegScp->scope_id;
		}

		$pasal 					= $this->db->get_where('regulation_pasal', ['regulation_id' => $id])->result();
		$regulation_paragraphs 	= $this->db->get_where('regulation_paragraphs', ['regulation_id' => $id])->result();

		$ArrPhar = [];
		foreach ($regulation_paragraphs as $regPh) {
			$ArrPhar[$regPh->pasal_id][] = $regPh;
		}

		if ($Data) {
			$this->template->set([
				'title' 		=> 'Edit Regulation',
				'data' 			=> $Data,
				'category' 		=> $category,
				'scopes' 		=> $scopes,
				'subjects' 		=> $subjects,
				'ArrRegSjb' 	=> $ArrRegSjb,
				'ArrRegScp' 	=> $ArrRegScp,
				'pasal' 		=> $pasal,
				'ArrPhar' 		=> $ArrPhar,
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

	public function load_form($id = '')
	{
		$data = '';
		$desc = '';

		if ($id) {
			$data 	= $this->db->get_where('regulation_pasal', ['id' => $id])->row();
			$desc 	= $this->db->get_where('regulation_paragraphs', ['pasal_id' => $id])->result();
		}

		$this->template->set([
			'data' => $data,
			'desc' => $desc,
		]);

		$this->template->render('form');
	}

	public function save_desc()
	{
		$data = $this->input->post();
		echo '<pre>';
		print_r($data);
		echo '<pre>';
		exit;
	}



	/* ======== */

	public function view($id = '')
	{
		$Data 	= $this->db->get_where('requirements', ['id' => $id, 'status' => '1'])->row();
		$Data_list 	= $this->db->get_where('requirement_details', ['requirement_id' => $id])->result();

		$this->template->set([
			'Data' => $Data,
			'List' => $Data_list
		]);

		$this->template->render('view');
	}

	public function view_detail($id = '')
	{
		$Data_list 	= $this->db->get_where('requirement_details', ['id' => $id])->row();
		echo  json_encode($Data_list);
	}

	public function loadForm()
	{
		$this->template->render('chapter_form');
	}

	public function save_pasal()
	{
		$Data = $this->input->post();
		if ($Data) {
			$checkname = $this->db->get_where('regulation_pasal', ['name' => $Data['pasal']])->num_rows();
			if ($checkname > 1) {
				$Return		= array(
					'status'		=> 2,
					'msg'			=> 'Pasal name "' . $Data['pasal'] . '" already exist, please use another name!',
				);
				echo json_encode($Return);
				return false;
			}
			$this->db->trans_begin();
			$this->RegModel->savePasal($Data);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$Return		= array(
					'status'		=> 0,
					'msg'			=> 'Failed to save pasal, please try again!',
				);
			} else {
				$this->db->trans_commit();
				$Return		= array(
					'status'		=> 1,
					'msg'			=> 'Successfull to save pasal',
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

	public function save()
	{
		$Data 		= $this->input->post();
		$this->db->trans_begin();
		if ($Data) {
			$result = $this->RegModel->saveData($Data);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Data Regulation failed to save. Please try again.',
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Data Regulation successfully saved..',
				'id'			=> $result,
			);
		}

		echo json_encode($Return);
	}

	public function delete($id)
	{
		$this->db->trans_begin();
		if (($id)) {
			$this->db->delete('requirements', ['id' => $id]);
			$this->db->delete('requirement_details', ['requirement_id' => $id]);
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

	public function delete_pasal($id)
	{
		$this->db->trans_begin();
		if (($id)) {
			$this->db->delete('requirement_details', ['id' => $id]);
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
