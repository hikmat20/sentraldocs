<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manage_documents extends Admin_Controller
{
	/*
 * @author Hikmat A.R
 * @copyright Copyright (c) 2022, Hikmat A.R
 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model('manage_documents/manage_documents_model', 'DOCS');
		$this->load->library('upload');
		$this->template->page_icon('fa fa-file-alt');
		$this->MainData 	= $this->db->get_where('directory', ['parent_id' => '0'])->result();
		$this->company 		= $this->session->session_active_company->company_id;
		// $this->branch 		= $this->session->app_session['id_cabang'];
	}

	public function index()
	{
		//$this->template->set('sum_penacc', $sum_penacc);
		$this->template->render('index');
	}

	public function create()
	{
		$mainFolder = $this->db->get_where('directory', ['flag_type' => 'FOLDER', 'active' => 'Y', 'parent_id' => '0'])->result();
		$Data = $this->db->get_where('directory', ['flag_type' => 'FOLDER', 'active' => 'Y'])->result();
		$ArrFolder = [];
		foreach ($Data as $dir) {
			$ArrFolder[$dir->parent_id][] = $dir;
		}
		$loadFolder = $this->menus($ArrFolder);
		$this->template->set('loadFolder', $loadFolder);
		$this->template->render('create');
	}

	public function edit($id)
	{
		$this->template->render('create');
	}

	function menus($ArrFolder, $parent = '0')
	{
		// $result = ("SELECT a.id, a.label, a.link, Deriv1.Count FROM `menu` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `menu` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.parent=" . $parent);
		$html = "<ul class='h6 text-dark'>";
		foreach ($ArrFolder[$parent] as $val) {
			// exit;
			if (isset($ArrFolder[$val->id])) {

				$html .= "<li class='h6 py-1'><a href='" . $val->link . "' data-id='" . $val->id . "' class='tree-folder'>" . $val->name . "</a>";
				$html .= $this->menus($ArrFolder, $val->id);
				$html .= "</li>";
			} else {
				$html .= "<li class='h6 py-1'><a href='" . $val->link . "' data-id='" . $val->id . "' class='tree-folder'>" . $val->name . "</a></li>";
			}
		}
		$html .= "</ul>";
		return $html;
	}

	public function load_file($id = null)
	{
		if ($id) {
			$data_file = $this->db->get_where('directory', ['parent_id' => $id, 'flag_type !=' => 'LINK'])->result();
			$prev = $this->db->get_where('directory', ['id' => $id])->row()->parent_id;

			$this->template->set('prev', $prev);
			$this->template->set('parent_id', $id);
			$this->template->set('list_file', $data_file);
			$this->template->render('list-file');
		}
	}

	public function check_folder_name($name, $parent_id)
	{
		$check 	= $this->db->get_where('directory', ['name' => $name, 'parent_id' => $parent_id])->num_rows();
		if ($check > 0) {
			for ($i = 0; $i < $check; $i++) {
				$newName = $name . "(" . $i . ")";
				echo '<pre>';
				print_r($newName);
				echo '<pre>';
			}
			exit;
		}
	}

	public function new_folder($parent_id)
	{
		$this->template->set('parent_id', $parent_id);
		$this->template->render('create-folder');
	}

	public function rename($id)
	{
		$data = $this->db->get_where('directory', ['id' => $id])->row();
		$this->template->set('data', $data);
		$this->template->set('title', 'Rename');
		$this->template->render('create-folder');
	}

	public function delete_folder()
	{
		$id 		= $this->input->post('id');
		$parent_id 	= $this->input->post('parent_id');
		$this->db->trans_begin();
		$this->db->delete('directory', ['id' => $id]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'pesan'			=> 'Folder failed deleted'
			);
		} else {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Folder success deleted'
			);
		}

		echo json_encode($Return);
	}

	public function create_folder()
	{
		$data 				= $this->input->post();

		$check_folder_name 	= $this->db->get_where('directory', ['name' => $data['folder_name'], 'parent_id' => $data['parent_id']])->num_rows();
		$folder_name 		= ($check_folder_name > 0) ? $data['folder_name'] . "(" . $check_folder_name . ")" : $data['folder_name'];

		$ArrFolder = [
			'parent_id' => $data['parent_id'],
			'name' => $folder_name,
			'flag_type' => 'FOLDER',
			'company_id' => $this->company,
		];

		if ($data) {
			$this->db->trans_begin();
			if (isset($data['id'])) :
				$ArrFolder['modified_by'] = $this->auth->user_id();
				$ArrFolder['modified_at'] = date('Y-m-d H:i:s');
				$this->db->update('directory', $ArrFolder, ['id' => $data['id']]);
			else :
				$ArrFolder['id'] = uniqid();
				$ArrFolder['created_by'] = $this->auth->user_id();
				$ArrFolder['created_at'] = date('Y-m-d H:i:s');
				$this->db->insert('directory', $ArrFolder);
			endif;

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$Return		= array(
					'status'		=> 0,
					'pesan'			=> 'Folder faild created'
				);
			} else {
				$this->db->trans_commit();
				$Return		= array(
					'status'		=> 1,
					'msg'			=> 'Folder success created'
				);
			}
		} else {
			$Return		= array(
				'status'		=> 0,
				'pesan'			=> 'Data not valid'
			);
		}

		echo json_encode($Return);
	}

	public function upload($parent_id)
	{
		$users 		= $this->db->get_where('users', ['st_aktif' => '1', 'id_perusahaan' => $this->company, 'id_user !=' => '1'])->result();
		$jabatan 	= $this->db->get('tbl_jabatan')->result();

		$this->template->set([
			'jabatan' 		=> $jabatan,
			'parent_id' 	=> $parent_id,
			'users' 		=> $users,
		]);
		$this->template->render('upload_file');
	}

	public function edit_file($id)
	{
		$file 		= $this->db->get_where('directory', ['id' => $id])->row();

		$users 		= $this->db->get_where('users', ['st_aktif' => '1', 'id_perusahaan' => $this->company, 'id_user !=' => '1'])->result();
		$jabatan 	= $this->db->get('tbl_jabatan')->result();

		$this->template->set([
			'file' 			=> $file,
			'jabatan' 		=> $jabatan,
			'parent_id' 	=> $file->parent_id,
			'users' 		=> $users,
		]);

		$this->template->render('upload_file');
	}

	function fixForUri($string)
	{
		$slug = trim($string); // trim the string
		$slug = preg_replace('/[^a-zA-Z0-9 -]/', '', $slug); // only take alphanumerical characters, but keep the spaces and dashes too...
		$slug = str_replace(' ', '-', $slug); // replace spaces by dashes
		$slug = strtolower($slug);  // make it lowercase
		return $slug;
	}

	public function save_upload()
	{
		$data = $this->input->post();
		$parent_name = $this->db->get_where('directory', ['id' => $data['parent_id']])->row()->name;
		if ($_FILES['image']['name']) {
			if (!is_dir('./directory/' . $parent_name)) {
				mkdir('./directory/' . $parent_name, 0755, TRUE);
				chmod("./directory/" . $parent_name, 0755);  // octal; correct value of mode
				chown("./directory/" . $parent_name, 'www-data');
			}
			// $new_name 					= $this->fixForUri($data['description']);
			$config['upload_path'] 		= "./directory/$parent_name"; //path folder
			$config['allowed_types'] 	= 'pdf'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] 	= true; //Enkripsi nama yang terupload
			// $config['file_name'] 		= $new_name;
			$id 						= (!$data['id']) ? uniqid(date('m')) : $data['id'];


			$this->upload->initialize($config);
			if ($this->upload->do_upload('image')) :
				$file = $this->upload->data();
				$file_name  = $file['file_name'];
				$size  		= $file['file_size'];
				$ext     	= $file['file_ext'];

				$data['id']	    		= $id;
				$data['name']	    	= $data['description'];
				$data['file_name']		= $file_name;
				$data['size']			= $size;
				$data['ext']			= $ext;
				$data['flag_type']		= 'FILE';
				$dist 					= implode(",", $data['id_distribusi']);
				$data['id_distribusi']	= $dist;
				$old_file 				= isset($data['old_file']) ? $data['old_file'] : null;
				unset($data['old_file']);

				if ($old_file != null) {
					if (file_exists('./assets/files/' . $old_file)) {
						unlink('./assets/files/' . $old_file);
					}
				}
				$this->db->trans_begin();
				$check = $this->db->get_where('directory', ['id' => $id])->num_rows();

				if (intval($check) == '0') {
					$data['created_by']		= $this->auth->user_id();
					$data['created_at']		= date('Y-m-d H:i:s');
					$this->db->insert('directory', $data);
				} else {
					$data['modified_by']	= $this->auth->user_id();
					$data['modified_at']	= date('Y-m-d H:i:s');
					$this->db->update('directory', $data, ['id' => $id]);
				}

				$id_dist = $this->db->get_where('distribusi', ['id_file' => $this->input->post('id')])->result();
				foreach ($this->input->post('id_distribusi') as $key => $value) {
					$cek = $this->db->where(['id_jabatan' => $value, 'id_file' => $this->input->post('id')])->get('distribusi')->row();
					$arr_dist = [
						'id_file' => $this->input->post('id'),
						'id_jabatan' => $value
					];

					if ($cek) {
						$this->db->update('distribusi', $arr_dist, ['id' => $cek->id]);
					} else if (!$cek) {
						$this->db->insert('distribusi', $arr_dist);
					} else {
						$this->db->delete('distribusi', ['id' => $cek->id]);
					}
				}

			else :
				$error_msg = $this->upload->display_errors();
				$Return = [
					'status' => 0,
					'msg'	 => $error_msg
				];
				echo json_encode($Return);
				return false;
			endif;

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$Return = [
					'status' => 0,
					'msg'	 => 'Failed upload document file. Please try again later.!'
				];
			} else {
				$this->db->trans_commit();
				$Return = [
					'status' => 1,
					'msg'	 => 'Success upload document file...'
				];
			}
		} else {
			$Return = [
				'status' => 0,
				'msg'	 => 'No file or data to upload document..'
			];
		}

		echo json_encode($Return);
	}

	public function view_file($id)
	{
		$file 			= $this->db->get_where('directory', ['id' => $id])->row();
		$parent_name 	= $this->db->get_where('directory', ['id' => $file->parent_id])->row()->name;
		$this->template->set(
			[
				'file' => $file,
				'parent_name' => $parent_name,
			]
		);
		$this->template->render('view-file');
	}
}
