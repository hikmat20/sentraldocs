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
		$this->template->page_icon('fa fa-file-alt');
		$this->MainData 	= $this->db->get_where('directory', ['parent_id' => '0'])->result();
		$this->company 		= $this->session->app_session['id_perusahaan'];
		$this->branch 		= $this->session->app_session['id_cabang'];
	}

	public function index()
	{
		//$this->template->set('sum_penacc', $sum_penacc);
		$this->template->render('index');
	}

	public function create()
	{

		$this->template->render('create');
	}

	public function edit($id)
	{

		$this->template->render('create');
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
