<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Folders
 */

class Audits extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model(array(
			'Aktifitas/aktifitas_model'
		));

		$this->template->set('title', 'List of Company Audit');
		$this->template->set('icon', 'fa fa-cog');

		date_default_timezone_set("Asia/Bangkok");
	}

	public function index()
	{
		$data			= $this->db->get_where('view_audits', ['status' => 'OPN'])->result();
		$done			= $this->db->get_where('view_audits', ['status' => 'DONE'])->result();
		$this->template->set([
			'data' => $data,
			'done' => $done
		]);
		$this->template->render('index');
	}

	public function add()
	{
		$Companies = $this->db->get_where('companies')->result();
		$this->template->set([
			'title' 		=> 'Add Company Audit',
			'Companies' 	=> $Companies
		]);
		$this->template->render('add');
	}

	public function edit($id = '')
	{
		$Data 		= $this->db->get_where('view_audits', ['id' => $id, 'status' => 'OPN'])->row();
		$datStd 	= $this->db->get_where('view_audit_standards', ['audit_id' => $id])->result();
		$dataReg 	= $this->db->get_where('view_audit_regulations', ['audit_id' => $id])->result();
		$companies 	= $this->db->get_where('companies')->result();

		if ($Data) {
			$this->template->set([
				'title' 	=> 'Edit Company Audit',
				'Data' 		=> $Data,
				'datStd' 	=> $datStd,
				'dataReg' 	=> $dataReg,
				'Companies' => $companies,
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

	public function edit_detail($id = '')
	{
		$Data_list 	= $this->db->get_where('requirement_details', ['id' => $id])->row();
		echo  json_encode($Data_list);
	}

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


	public function save()
	{
		$Data 		= $this->input->post();

		if ($Data) {
			$DataStd 	= (isset($Data['standard'])) ? $Data['standard'] : '';
			$DataReg 	= (isset($Data['regulation'])) ? $Data['regulation'] : '';

			unset($Data['standard']);
			unset($Data['regulation']);
			$this->db->trans_begin();
			if (isset($Data['id'])) {
				$Id = $Data['id'];
				$Data['modified_by'] = $this->auth->user_id();
				$Data['modified_at'] = date('Y-m-d H:i:s');
				$this->db->update('audits', $Data, ['id' => $Data['id']]);
			} else {

				$Data['created_by'] = $this->auth->user_id();
				$Data['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('audits', $Data);
				$Id = $this->db->order_by('id', 'DESC')->get_where('audits')->row()->id;
			}

			/* List Standard */
			if ($DataStd) {
				if (isset($DataStd['id'])) {
					$DataStd['modified_by'] = $this->auth->user_id();
					$DataStd['modified_at'] = date('Y-m-d H:i:s');
					$this->db->update('audit_detail_standards', $DataStd, ['id' => $DataStd['id']]);
				} else {
					foreach ($DataStd as $std) {
						$std['audit_id'] = $Id;
						$std['created_by'] = $this->auth->user_id();
						$std['created_at'] = date('Y-m-d H:i:s');
						$this->db->insert('audit_detail_standards', $std);
					}
				}
			}

			/* List Regulation */
			if ($DataReg) {
				if (isset($DataReg['id'])) {
					$DataReg['modified_by'] = $this->auth->user_id();
					$DataReg['modified_at'] = date('Y-m-d H:i:s');
					$this->db->update('audit_detail_regulations', $DataReg, ['id' => $DataReg['id']]);
				} else {
					foreach ($DataReg as $reg) {
						$reg['audit_id'] = $Id;
						$reg['created_by'] = $this->auth->user_id();
						$reg['created_at'] = date('Y-m-d H:i:s');
						$this->db->insert('audit_detail_regulations', $reg);
					}
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
					'id'			=> $Id
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
