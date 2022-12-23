<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Standard extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('download');
		$this->load->library(array('upload', 'Image_lib'));
		$this->load->model('standard/Standards_model', 'StdModel');

		$this->template->set('title', 'Index of Standards');
		$this->template->set('icon', 'fa fa-cog');

		date_default_timezone_set("Asia/Bangkok");
	}

	public function index()
	{
		$data			= $this->db->get_where('view_standards', ['status' => 'PUB'])->result();
		$drafts			= $this->db->get_where('view_standards', ['status' => 'DFT'])->result();
		$scopes 		= $this->db->get_where('tool_scopes')->result();
		$ArrScopes = [];
		foreach ($scopes as $sc) {
			$ArrScopes[$sc->id] = $sc->name;
		}

		$this->template->set([
			'data' 			=> $data,
			'drafts' 		=> $drafts,
			'ArrScopes' 	=> $ArrScopes,
		]);
		$this->template->render('index');
	}

	public function add()
	{
		$category 	= $this->db->get_where('standard_category')->result();
		$scopes 	= $this->db->get_where('tool_scopes')->result();

		$this->template->set([
			'title' 	=> 'Add New Standard',
			'category' 	=> $category,
			'scopes' 	=> $scopes,
		]);
		$this->template->render('add');
	}

	public function edit($id = '')
	{
		$standards 		= $this->db->get_where('standards', ['id' => $id])->row();
		$category 		= $this->db->get_where('standard_category')->result();
		$scopes 		= $this->db->get_where('tool_scopes')->result();

		if ($standards) {
			$this->template->set([
				'title' 		=> 'Edit Standards',
				'data' 			=> $standards,
				'category' 		=> $category,
				'scopes' 		=> $scopes,
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

	public function view($id = '')
	{
		$Data 	= $this->db->get_where('regulations', ['id' => $id])->row();
		$Pasal 	= $this->db->get_where('regulation_pasal', ['regulation_id' => $id])->result();
		$Desc 	= $this->db->get_where('regulation_paragraphs', ['regulation_id' => $id])->result();

		$ArrDesc = [];
		foreach ($Desc as $dsc) {
			$ArrDesc[$dsc->pasal_id] = $dsc;
		}

		$this->template->set([
			'Data' 		=> $Data,
			'Pasal' 	=> $Pasal,
			'ArrDesc' 	=> $ArrDesc
		]);

		$this->template->render('view');
	}

	public function save()
	{
		$Data 		= $this->input->post();
		if ($Data) {
			$this->db->trans_begin();
			$old_file 	= isset($Data['old_file']) ? $Data['old_file'] : '';
			unset($Data['old_file']);
			$result 	= $this->StdModel->saveData($Data);

			if ($_FILES['document']['name']) {
				$upload = $this->save_upload($result);
				if ($upload) {
					$Return			= array(
						'status'		=> 0,
						'msg'			=> $upload,
					);
					echo json_encode($Return);
					return false;
				}

				if ($old_file) {
					if (file_exists('./standards/' . $old_file)) {
						unlink('./standards/' . $old_file);
					}
				}
			}

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$Return		= array(
					'status'		=> 0,
					'msg'			=> 'Data Standard failed to save. Please try again.',
				);
			} else {
				$this->db->trans_commit();
				$Return		= array(
					'status'		=> 1,
					'msg'			=> 'Data Standard successfully saved..',
					'id'			=> $result,
				);
			}
		}


		echo json_encode($Return);
	}

	public function delete()
	{
		$id = $this->input->post('id');

		if (($id)) {
			$this->db->trans_begin();
			$this->db->delete('standards', ['id' => $id]);
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


	public function save_upload($id)
	{
		if (!is_dir('./standards/')) {
			mkdir('./standards/', 0755, TRUE);
			chmod("./standards/", 'www-data');
		}

		$config['upload_path'] 		= "./standards/"; //path folder
		$config['allowed_types'] 	= 'pdf'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] 	= true; //Enkripsi nama yang terupload

		$this->upload->initialize($config);
		if ($this->upload->do_upload('document')) :
			$file 					= $this->upload->data();
			$data['document']		= $file['file_name'];
			$data['modified_by']	= $this->auth->user_id();
			$data['modified_at']	= date('Y-m-d H:i:s');
			$this->db->update('standards', $data, ['id' => $id]);
			return '';
		else :
			$error_msg = $this->upload->display_errors();
			return $error_msg;
		endif;
	}
}
