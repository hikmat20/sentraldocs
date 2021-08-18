<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Admin_Controller
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

		$this->load->model('dashboard/dashboard_model');
		$this->template->set_theme('dashboard');
		$this->template->page_icon('fa fa-dashboard');
	}

	public function index()
	{
		$this->template->set('title', 'Dashboard');
		//$data = $this->dashboard_model->monitor_eoq();

		//$data = $this->dashboard_model->where('qty<=minstok')->find_all();
		$open = $this->dashboard_model->meeting_open();
		$done = $this->dashboard_model->meeting_done();
		$close = $this->dashboard_model->meeting_close();
		$late = $this->dashboard_model->meeting_late();
		// $sum_penacc = $this->dashboard_model->pengajuan_acc();
		//$this->template->set('results', $data);
		$this->template->set('open', $open);
		$this->template->set('done', $done);
		$this->template->set('close', $close);
		$this->template->set('late', $late);
		//$this->template->set('sum_penacc', $sum_penacc);
		$this->template->render('index');
	}
}
