<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Folders
 */

class Procedures extends Admin_Controller
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
		$data		= $this->db->get_where('procedures', ['deleted_at' => null])->result();
		$this->template->set('title', 'List of Procedures');
		$this->template->set('data', $data);
		$this->template->set('status', $this->status);
		$this->template->render('index');
	}

	public function add()
	{
		$this->template->set('title', 'Add Procedures');
		$this->template->render('add');
	}

	public function edit($id = '')
	{
		$Data 			= $this->db->get_where('procedures', ['id' => $id])->row();
		$Data_detail 	= $this->db->get_where('procedure_details', ['procedure_id' => $id, 'status' => '1'])->result();

		$this->template->set([
			'title' 	=> 'Edit Procedures',
			'data' 		=> $Data,
			'detail' 	=> $Data_detail,
		]);

		$this->template->render('edit');
	}

	public function view($id = '')
	{
		$Data 			= $this->db->get_where('procedures', ['id' => $id])->row();
		$Data_detail 		= $this->db->get_where('procedures', ['id' => $id])->row();

		$this->template->set([
			'title' => 'Add Procedures',
			'data' => $Data,
		]);

		$this->template->render('add');
	}

	public function save()
	{
		$Data 		= $this->input->post();
		$Data_flow 		= $this->input->post('flow');


		$this->db->trans_begin();
		if ($Data) {
			$Data['company_id'] = $this->company;
			unset($Data['flow']);
			if (isset($Data['id'])) {
				$Data['modified_by'] = $this->auth->user_id();
				$Data['modified_at'] = date('Y-m-d H:i:s');
				$pro_id = $Data['id'];
				$this->db->update('procedures', $Data, ['id' => $Data['id']]);
			} else {
				$Data['created_by'] = $this->auth->user_id();
				$Data['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('procedures', $Data);
				$pro_id = $this->db->order_by('id', 'DESC')->get_where('procedures')->row()->id;
			}
		}

		if ($Data_flow) {
			$Data_flow['procedure_id'] = $pro_id;
			if (isset($Data_flow['id'])) {
				$Data_flow['modified_by'] = $this->auth->user_id();
				$Data_flow['modified_at'] = date('Y-m-d H:i:s');
				$this->db->update('procedure_details', $Data_flow, ['id' => $Data_flow['id']]);
			} else {
				$Data_flow['created_by'] = $this->auth->user_id();
				$Data_flow['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('procedure_details', $Data_flow);
			}
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
				'id'			=> $pro_id,
			);
		}

		echo json_encode($Return);
	}

	function delete_flow($id)
	{
		$this->db->trans_begin();
		if (($id)) {
			$data['deleted_by'] = $this->auth->user_id();
			$data['deleted_at'] = date('Y-m-d H:i:s');
			$data['status'] = '0';
			$this->db->update('procedure_details', $data, ['id' => $id]);
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
