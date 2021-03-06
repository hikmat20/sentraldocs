<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Documents_list extends Admin_Controller
{
	/*
 * @author Yunaz
 * @copyright Copyright (c) 2016, Yunaz
 * 
 * This is controller for Penerimaan
 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('documents_list/Documents_list_model', 'List');
		$this->template->page_icon('fa fa-dashboard');
		$this->MainData 	= $this->db->get_where('directory', ['parent_id' => '0'])->result();
		$this->company 		= $this->session->app_session['id_perusahaan'];
		$this->branch 		= $this->session->app_session['id_cabang'];
		$this->sts = [
			'OPN' => '<span class="label label-light-primary label-pill label-inline mr-2">New</span>',
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
		$Data 			= $this->db->get_where('directory', ['parent_id' => $id, 'flag_type' => 'FOLDER'])->result();
		$listDataFolder = $this->db->get_where('directory', ['flag_type' => 'FOLDER'])->result();
		$listDataFile 	= $this->db->get_where('directory', ['flag_type' => 'FILE', 'status' => 'PUB'])->result();
		$listDataLink 	= $this->db->get_where('directory', ['flag_type' => 'LINK'])->result();

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
		$dir_name 	= $this->db->get_where('directory', ['id' => $file->parent_id])->row()->name;
		$history	= $this->db->order_by('updated_at', 'ASC')->get_where('directory_log', ['directory_id' => $id])->result();
		$this->template->set('dir_name', $dir_name);
		$this->template->set('sts', $this->sts);
		$this->template->set('file', $file);
		$this->template->set('history', $history);
		$this->template->render('show');
	}
}
