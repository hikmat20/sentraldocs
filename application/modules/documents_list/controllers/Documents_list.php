<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Documents_list extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('documents_list/Documents_list_model', 'List');
		$this->template->page_icon('fa fa-dashboard');
		$this->MainData 	= $this->db->get_where('directory', ['parent_id' => '0'])->result();
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
		//$this->template->set('sum_penacc', $sum_penacc);
		// $this->template->render('index');
		redirect('dashboard');
	}

	public function find($id)
	{
		$thisData 		= $this->db->get_where('directory', ['id' => $id])->row();
		$Data 			= $this->db->get_where('directory', ['parent_id' => $id, 'flag_type' => 'FOLDER', 'status !=' => 'DEL', 'company_id' => $this->company])->result();
		$listDataFolder = $this->db->get_where('directory', ['flag_type' => 'FOLDER', 'status !=' => 'DEL', 'company_id' => $this->company])->result();
		$listDataFile 	= $this->db->get_where('directory', ['flag_type' => 'FILE', 'status' => 'PUB', 'status !=' => 'DEL', 'company_id' => $this->company])->result();
		$listDataLink 	= $this->db->get_where('directory', ['flag_type' => 'LINK', 'status !=' => 'DEL', 'company_id' => $this->company])->result();

		$ArrDataFolder = [];
		foreach ($listDataFolder as $listFolder) {
			$ArrDataFolder[$listFolder->parent_id][] = $listFolder;
		}
		$ArrDataFile = [];
		foreach ($listDataFile as $listFile) {
			$ArrDataFile[$listFile->parent_id][] = $listFile;
		}
		$ArrDataLink = [];
		foreach ($listDataLink as $listLink) {
			$ArrDataLink[$listLink->parent_id][] = $listLink;
		}

		$dt 		= $this->db->get_where('directory', ['id' => $id])->row_array();
		$buildBreadcumb = $this->buildBreadcumb($dt);

		$this->template->set('MainData', $this->MainData);
		$this->template->set('company', $this->company);
		$this->template->set('Breadcumb', $buildBreadcumb);
		$this->template->set('thisData', $thisData);
		$this->template->set('Data', $Data);
		$this->template->set('ArrDataFolder', $ArrDataFolder);
		$this->template->set('ArrDataFile', $ArrDataFile);
		$this->template->set('ArrDataLink', $ArrDataLink);
		$this->template->render('index');
	}

	function buildBreadcumb($data)
	{
		// $Breadcumb = [];
		$data = $this->db->get_where('directory', ['id' => $data['parent_id']])->row();

		if ($data) {
			if ($data->parent_id != '0') {
				$Breadcumb[] =  $data;
			}
			return isset($Breadcumb) ? $Breadcumb : '';
			$this->buildBreadcumb($data);
		}
	}

	public function show($id)
	{
		$file 		= $this->db->get_where('directory', ['id' => $id])->row();
		// pre
		$dir_name 	= $this->db->get_where('directory', ['id' => $file->parent_id])->row()->name;
		$history	= $this->db->order_by('updated_at', 'ASC')->get_where('directory_log', ['directory_id' => $id])->result();
		$this->template->set('dir_name', $dir_name);
		$this->template->set('sts', $this->sts);
		$this->template->set('file', $file);
		$this->template->set('history', $history);
		$this->template->render('show');
	}

	public function procedures($id = null)
	{
		if (isset($id)) {
			$procedure 		= $this->db->get_where('view_procedures', ['id' => $id])->result();
			$forms 			= $this->db->order_by('name', 'ASC')->get_where('dir_forms', ['procedure_id' => $id, 'active' => 'Y'])->result();
			$guides 		= $this->db->order_by('name', 'ASC')->get_where('dir_guides', ['procedure_id' => $id, 'active' => 'Y'])->result();
			$records 		= $this->db->order_by('name', 'ASC')->get_where('dir_records', ['procedure_id' => $id, 'status' => 'PUB', 'flag_type' => 'FOLDER', 'company_id' => $this->company, 'parent_id' => null])->result();
			$countRecords 	= $this->db->get_where('dir_records', ['procedure_id' => $id, 'status' => 'PUB', 'flag_type' => 'FILE', 'company_id' => $this->company])->num_rows();

			$this->template->set([
				'procedure' 		=> $procedure,
				'forms' 			=> $forms,
				'guides' 			=> $guides,
				'records' 			=> $records,
				'MainData' 			=> $this->MainData,
				'countRecords' 	 	=> $countRecords
			]);
			$this->template->render('procedures/list-docs');
		} else {
			$groups 		= $this->db->get_where('group_procedure', ['status' => 'ACT'])->result();
			$procedures 	= $this->db->get_where('view_procedures', ['company_id' => $this->company, 'status' => 'PUB', 'deleted_by' => null])->result_array();

			foreach ($procedures as $pro) {
				$ArrPro[$pro['group_procedure']][] = $pro;
			}

			$this->template->set([
				'groups' 		=> $groups,
				'ArrPro' 		=> $ArrPro,
				'MainData' 		=> $this->MainData
			]);
			$this->template->render('procedures/index');
		}
	}

	public function view_procedure($id)
	{
		$docs 			= $this->db->get_where('view_procedures', ['id' => $id])->row();
		$detail 		= $this->db->get_where('procedure_details', ['procedure_id' => $id, 'status' => '1'])->result();
		$forms 		= $this->db->get_where('dir_forms', ['procedure_id' => $id, 'active' => 'Y'])->result();
		$users 				= $this->db->get_where('view_users', ['status' => 'ACT', 'id_user !=' => '1', 'company_id' => $this->company])->result();
		$jabatan 			= $this->db->get('positions')->result();
		$ArrUsr 			= $ArrJab = $ArrForms = [];

		foreach ($users as $usr) {
			$ArrUsr[$usr->id_user] = $usr;
		}

		foreach ($jabatan as $jab) {
			$ArrJab[$jab->id] = $jab;
		}
		foreach ($forms as $form) {
			$ArrForms[$form->id] = $form;
		}
		$this->template->set([
			'docs' 			=> $docs,
			'detail' 		=> $detail,
			'MainData' 		=> $this->MainData,
			'ArrUsr' 		=> $ArrUsr,
			'ArrJab' 		=> $ArrJab,
			'ArrForms' 		=> $ArrForms,
		]);

		$this->template->render('procedures/view-docs');
	}

	public function view_record($id)
	{
		$record 			= $this->db->get_where('dir_records', ['id' => $id])->row();
		$history			= $this->db->order_by('updated_at', 'ASC')->get_where('directory_log', ['directory_id' => $id])->result();
		$users = $this->db->get_where('users', ['status' => 'ACT'])->result();
		foreach ($users as $user) {
			$ArrUsr[$user->id_user] = $user;
		}
		$this->template->set([
			'record' 			=> $record,
			'history' 			=> $history,
			'sts'				=> $this->sts,
			'ArrUsr'			=> $ArrUsr
		]);

		$this->template->render('procedures/view-record');
	}
	public function view_form($id)
	{
		$form 			= $this->db->get_where('dir_forms', ['id' => $id])->row();
		$history			= $this->db->order_by('updated_at', 'ASC')->get_where('directory_log', ['directory_id' => $id])->result();
		$users = $this->db->get_where('users', ['status' => 'ACT'])->result();
		foreach ($users as $user) {
			$ArrUsr[$user->id_user] = $user;
		}
		$this->template->set([
			'form' 			=> $form,
			'history' 			=> $history,
			'sts'				=> $this->sts,
			'ArrUsr'			=> $ArrUsr
		]);

		$this->template->render('procedures/view-form');
	}

	public function view_form_2($id)
	{
		$form 			= $this->db->get_where('dir_forms', ['id' => $id])->row();
		$history			= $this->db->order_by('updated_at', 'ASC')->get_where('directory_log', ['directory_id' => $id])->result();
		$users = $this->db->get_where('users', ['status' => 'ACT'])->result();
		foreach ($users as $user) {
			$ArrUsr[$user->id_user] = $user;
		}
		$this->template->set([
			'form' 			=> $form,
			'history' 			=> $history,
			'sts'				=> $this->sts,
			'ArrUsr'			=> $ArrUsr
		]);

		redirect('directory/FORMS/' . $form->file_name);
		// $this->template->render('procedures/view-form2');
	}

	/* PROCEDURES */
	/* ========== */

	public function getRecords($methode = null,  $procedure_id = null, $id = null)
	{
		if ($methode == 'home') {
			$records = $this->db->get_where('dir_records', ['company_id' => $this->company, 'procedure_id' => $procedure_id, 'parent_id' => null, 'status' => 'PUB', 'flag_type' => 'FOLDER'])->result();
			$EOF = true;
		} elseif ($methode == 'back') {
			$parent_id = $this->db->get_where('dir_records', ['id' => $id])->row()->parent_id;
			if ($parent_id > 0) {
				$records = $this->db->get_where('dir_records', ['company_id' => $this->company, 'procedure_id' => $procedure_id, 'parent_id' => $parent_id, 'status' => 'PUB', 'flag_type' => 'FOLDER'])->result();
				$EOF = false;
				$id = $parent_id;
			} else {
				$records = $this->db->get_where('dir_records', ['company_id' => $this->company, 'procedure_id' => $procedure_id, 'parent_id' => null, 'status' => 'PUB', 'flag_type' => 'FOLDER'])->result();
				$EOF = true;
				$id = '';
			}
		} elseif ($methode == 'refresh') {
			if ($id) {
				$records = $this->db->get_where('dir_records', ['company_id' => $this->company, 'procedure_id' => $procedure_id, 'parent_id' => $id, 'status' => 'PUB'])->result();
				$EOF = false;
			} else {
				$records = $this->db->get_where('dir_records', ['company_id' => $this->company, 'procedure_id' => $procedure_id, 'parent_id' => null, 'status' => 'PUB', 'flag_type' => 'FOLDER'])->result();
				$EOF = true;
			}
		} elseif ($methode == 'find') {
			$records = $this->db->get_where('dir_records', ['company_id' => $this->company, 'procedure_id' => $procedure_id, 'parent_id' => $id, 'status' => 'PUB'])->result();
			$EOF = false;
		}

		$this->template->set([
			'id' 			=> $id,
			'EOF' 			=> $EOF,
			'procedure_id' 	=> $procedure_id,
			'records' 		=> $records,
		]);

		$this->template->render('procedures/records');
	}
}
