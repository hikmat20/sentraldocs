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

		$this->sts = [
			'OPN' => '<span class="label label-light-primary label-pill label-inline mr-2">New Upload</span>',
			'REV' => '<span class="label label-light-warning label-pill label-inline mr-2">Waiting Review</span>',
			'COR' => '<span class="label label-light-danger label-pill label-inline mr-2">Need Correction</span>',
			'APV' => '<span class="label label-light-info label-pill label-inline mr-2">Waiting Approval</span>',
			'PUB' => '<span class="label label-light-success label-pill label-inline mr-2">Published</span>',
		];
	}

	public function index()
	{
		$data		= $this->db->get_where('procedures', ['company_id' => $this->company, 'deleted_at' => null])->result();
		$this->template->set('title', 'List of Procedures');
		$this->template->set('data', $data);
		$this->template->set('status', $this->status);
		$this->template->render('index');
	}

	public function add()
	{
		$grProcess	= $this->db->get_where('group_procedure', ['status' => 'ACT'])->result();

		$this->template->set([
			'grProcess' 	=> $grProcess,

		]);

		$this->template->set('title', 'Add Procedures');
		$this->template->render('add');
	}

	public function edit($id = '')
	{
		$Data 			= $this->db->get_where('procedures', ['company_id' => $this->company, 'id' => $id])->row();
		if ($Data) {
			$Data_detail 	= $this->db->get_where('procedure_details', ['procedure_id' => $id, 'status' => '1'])->result();
			$grProcess	= $this->db->get_where('group_procedure', ['status' => 'ACT'])->result();
			$getForms	= $this->db->get_where('dir_forms', ['procedure_id' => $id, 'status !=' => 'DEL'])->result();
			$getGuides	= $this->db->get_where('dir_guides', ['procedure_id' => $id, 'status !=' => 'DEL'])->result();
			$getRecords	= $this->db->get_where('dir_records', ['procedure_id' => $id, 'status !=' => 'DEL'])->result();
			$jabatan 	= $this->db->get('tbl_jabatan')->result();

			$this->template->set([
				'title' 		=> 'Edit Procedures',
				'data' 			=> $Data,
				'detail' 		=> $Data_detail,
				'getForms' 		=> $getForms,
				'getGuides' 	=> $getGuides,
				'getRecords' 	=> $getRecords,
				'jabatan' 		=> $jabatan,
			]);

			$this->template->set('grProcess', $grProcess);
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
		$Data 				= $this->db->get_where('procedures', ['id' => $id, 'company_id' => $this->company,  'status' => '1'])->row();
		if ($Data) {
			$Data_detail 		= $this->db->get_where('procedure_details', ['procedure_id' => $id])->result();
			$this->template->set([
				'title' => 'Procedures',
				'data' => $Data,
				'detail' => $Data_detail,
			]);
			$this->template->render('view');
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
		$Data 			= $this->input->post();
		$Data_flow 		= $this->input->post('flow');
		$Data_forms 		= $this->input->post('forms');
		unset($Data['forms']);
		$this->db->trans_begin();
		if ($Data) {
			if (isset($_FILES)) {
				$images = $this->upload_images();
				($images['image1']) ? $Data['image_flow_1'] = $images['image1'] : '';
				($images['image2']) ? $Data['image_flow_2'] = $images['image2'] : '';
				($images['image3']) ? $Data['image_flow_3'] = $images['image3'] : '';
			}


			// isset($Data['delete_image_1']) ? $Data['image_flow_1'] = null : null;
			// isset($Data['delete_image_2']) ? $Data['image_flow_2'] = null : null;
			// isset($Data['delete_image_3']) ? $Data['image_flow_3'] = null : null;

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

		if (isset($Data_forms) && $Data_forms) {
			$this->_save_upload();
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

	private function _save_upload()
	{
		$data = $this->input->post('forms');
		if ($_FILES['forms_image']) {
			if (!is_dir('./directory/FORMS')) {
				mkdir('./directory/FORMS', 0755, TRUE);
				chmod("./directory/FORMS", 0755);  // octal; correct value of mode
				chown("./directory/FORMS", 'www-data');
			}
			// $new_name 					= $this->fixForUri($data['description']);
			$config['upload_path'] 		= "./directory/FORMS"; //path folder
			$config['allowed_types'] 	= 'pdf|xlsx|docx'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] 	= true; //Enkripsi nama yang terupload
			// $config['file_name'] 		= $new_name;
			$id 						= (!$data['id']) ? uniqid(date('m')) : $data['id'];


			$this->upload->initialize($config);

			if ($this->upload->do_upload('forms_image')) :
				$file 		= $this->upload->data();
				$file_name  = $file['file_name'];
				$size  		= $file['file_size'];
				$ext     	= $file['file_ext'];

				$data['id']	    		= $id;
				$data['name']	    	= $data['description'];
				$data['file_name']		= $file_name;
				$data['size']			= $size;
				$data['ext']			= $ext;
				$data['company_id']		= $this->company;
				// $data['flag_type']		= 'FILE';
				$dist 					= isset($data['distribute_id']) ? implode(",", $data['distribute_id']) : null;
				$data['distribute_id']	= $dist;
				$old_file 				= isset($data['old_file']) ? $data['old_file'] : null;
				unset($data['old_file']);

				if ($old_file != null) {
					if (file_exists('./directory/FORMS/' . $old_file)) {
						unlink('./directory/FORMS/' . $old_file);
					}
				}

				$check = $this->db->get_where('dir_forms', ['id' => $id])->num_rows();
				$note = isset($data['note']) ? $data['note'] : null;
				unset($data['note']);
				if (intval($check) == '0') {
					$data['created_by']		= $this->auth->user_id();
					$data['created_at']		= date('Y-m-d H:i:s');
					$data['note']			= 'First Upload File';
					$data['status']			= isset($data['status']) ? $data['status'] : 'OPN';
					$this->db->insert('dir_forms', $data);
				} else {
					$data['modified_by']	= $this->auth->user_id();
					$data['modified_at']	= date('Y-m-d H:i:s');
					$data['note']			= 'Re-upload File';
					$this->db->update('ydir_forms', $data, ['id' => $id]);
				}

				$data['note'] = $note;
				$this->_update_history($data);

				if (isset($data['distribute_id'])) {
					foreach ($this->input->post('forms')['distribute_id'] as $key => $value) {
						$cek = $this->db->where(['id_jabatan' => $value, 'id_file' => $data['id']])->get('distribusi')->row();
						$arr_dist = [
							'id_file' => $this->input->post('id'),
							'id_jabatan' => $value,
							'created_by' => $this->auth->user_id(),
							'created_at' => date('Y-m-d H:i:s'),
						];

						if ($cek) {
							$this->db->update('distribusi', $arr_dist, ['id' => $cek->id]);
						} else if (!$cek) {
							$this->db->insert('distribusi', $arr_dist);
						} else {
							$this->db->delete('distribusi', ['id' => $cek->id]);
						}
					}
				};

			else :
				$error_msg = $this->upload->display_errors();
				$this->db->trans_rollback();
				$Return = [
					'status' => 0,
					'msg'	 => $error_msg
				];
				echo json_encode($Return);
				return false;
			endif;
		} else {
			$Return = [
				'status' => 0,
				'msg'	 => 'No file or data to upload document..'
			];
			echo json_encode($Return);
			return false;
		}
	}

	private function _update_history($data)
	{
		$dataLog = [
			'directory_id'  => $data['id'],
			'status' 	 	=> $data['status'],
			'note' 		    => $data['note'],
			'updated_by'    => $this->auth->user_id(),
			'updated_at'    => date('Y-m-d H:i:s'),
		];

		$this->db->insert('directory_log', $dataLog);
	}

	function delete_procedure($id)
	{
		$this->db->trans_begin();
		if (($id)) {
			$data['deleted_by'] = $this->auth->user_id();
			$data['deleted_at'] = date('Y-m-d H:i:s');
			$data['status'] = '0';
			$this->db->update('procedures', $data, ['company_id' => $this->company, 'id' => $id]);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Data Procedure failed to delete. Please try again.',
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Data Procedure successfully delete..',
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

	function delete_img($id, $dataImg)
	{
		$this->db->trans_begin();
		if (($id)) {
			$data['modified_by'] = $this->auth->user_id();
			$data['modified_at'] = date('Y-m-d H:i:s');
			$data["$dataImg"] = null;
			$this->db->update('procedures', $data, ['id' => $id]);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Failed to delete image.. Please try again.',
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Successfully deleted image..',
			);
		}

		echo json_encode($Return);
	}

	public function upload_images()
	{
		$this->load->library('upload');
		$dataInfo = array();
		$files = $_FILES;

		$cpt = count($_FILES['img_flow']['name']);
		for ($i = 0; $i < $cpt; $i++) {
			$_FILES['img_flow']['name'] = $files['img_flow']['name'][$i];
			$_FILES['img_flow']['type'] = $files['img_flow']['type'][$i];
			$_FILES['img_flow']['tmp_name'] = $files['img_flow']['tmp_name'][$i];
			$_FILES['img_flow']['error'] = $files['img_flow']['error'][$i];
			$_FILES['img_flow']['size'] = $files['img_flow']['size'][$i];

			$this->upload->initialize($this->set_upload_options());
			$this->upload->do_upload('img_flow');
			$dataInfo[] = $this->upload->data();
		}


		return array(
			'image1' => $dataInfo[0]['file_name'],
			'image2' => $dataInfo[1]['file_name'],
			'image3' => $dataInfo[2]['file_name'],
		);
	}

	private function set_upload_options()
	{
		//upload an image options
		$config = array();
		$config['upload_path'] = './image_flow/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '0';
		$config['overwrite']     = TRUE;
		$config['encrypt_name']  = TRUE;

		return $config;
	}

	public function view_form($id = null)
	{
		if ($id) {
			$file 		= $this->db->get_where('dir_forms', ['id' => $id])->row();
			// $dir_name 	= $this->db->get_where('dir_form', ['id' => $file->parent_id])->row()->name;
			$history	= $this->db->order_by('updated_at', 'ASC')->get_where('view_directory_log', ['directory_id' => $id])->result();
			// $this->template->set('dir_name', $dir_name);
			$this->template->set('sts', $this->sts);
			$this->template->set('file', $file);
			$this->template->set('history', $history);
			$this->template->render('show');
		} else {
			echo "~ Not data available ~";
		}
	}

	public function upload_form($id = null)
	{
		$users 		= $this->db->get_where('users', ['status' => 'ACT', 'id_user !=' => '1'])->result();
		$jabatan 	= $this->db->get('tbl_jabatan')->result();

		$this->template->set([
			'jabatan' 		=> $jabatan,
			'procedure_id' 	=> $id,
			'users' 		=> $users,
		]);
		$this->template->render('upload_file');
	}
	public function edit_form($id = null)
	{

		$users 		= $this->db->get_where('users', ['status' => 'ACT', 'id_user !=' => '1'])->result();
		$jabatan 	= $this->db->get('tbl_jabatan')->result();
		$data = $this->db->get_where('dir_forms', ['id' => $id])->row();


		$this->template->set([
			'data' 			=> $data,
			'jabatan' 		=> $jabatan,
			'procedure_id' 	=> $data->procedure_id,
			'users' 		=> $users,
		]);
		$this->template->render('upload_file');
	}

	/* upload ik */
	public function upload_guide($id = null)
	{
		$users 		= $this->db->get_where('users', ['status' => 'ACT', 'id_user !=' => '1'])->result();
		$jabatan 	= $this->db->get('tbl_jabatan')->result();

		$this->template->set([
			'jabatan' 		=> $jabatan,
			'procedure_id' 	=> $id,
			'users' 		=> $users,
		]);
		$this->template->render('upload_file');
	}
	public function edit_guide($id = null)
	{

		$users 		= $this->db->get_where('users', ['status' => 'ACT', 'id_user !=' => '1'])->result();
		$jabatan 	= $this->db->get('tbl_jabatan')->result();
		$data = $this->db->get_where('dir_guides', ['id' => $id])->row();


		$this->template->set([
			'data' 			=> $data,
			'jabatan' 		=> $jabatan,
			'procedure_id' 	=> $data->procedure_id,
			'users' 		=> $users,
		]);
		$this->template->render('upload_file');
	}
}
