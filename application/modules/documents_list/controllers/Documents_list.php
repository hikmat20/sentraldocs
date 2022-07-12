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
	}

	public function index()
	{
		//$this->template->set('sum_penacc', $sum_penacc);
		$this->template->render('index');
	}

	public function find($id)
	{
		$thisData 		= $this->db->get_where('directory', ['id' => $id])->row();
		$Data 			= $this->db->get_where('directory', ['parent_id' => $id])->result();
		$listDataFolder = $this->db->get_where('directory', ['flag_file' => 'N'])->result();
		$listDataFile 	= $this->db->get_where('directory', ['flag_file' => 'Y'])->result();

		$ArrDataFolder = [];
		foreach ($listDataFolder as $listFolder) {
			$ArrDataFolder[$listFolder->parent_id][] = $listFolder;
		}
		$ArrDataFile = [];
		foreach ($listDataFile as $listFile) {
			$ArrDataFile[$listFile->parent_id][] = $listFile;
		}


		$dt 		= $this->db->get_where('directory', ['id' => $id])->row_array();
		$buildBreadcumb = $this->buildBreadcumb($dt);

		$this->template->set('MainData', $this->MainData);
		$this->template->set('Breadcumb', $buildBreadcumb);
		$this->template->set('thisData', $thisData);
		$this->template->set('Data', $Data);
		$this->template->set('ArrDataFolder', $ArrDataFolder);
		$this->template->set('ArrDataFile', $ArrDataFile);
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
}
