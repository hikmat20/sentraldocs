<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Process_checksheets extends Admin_Controller
{
	/*
 * @author Hikmat A.R
 * @copyright Copyright (c) 2023, Hikmat A.R
 */

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->template->set('title', 'MASTER CHECKSHEET');
	}
	private function getNumber()
	{
		$last_number 	= $this->db->select('MAX(RIGHT(number,3)) as number')->from('checksheet_results')->get()->row();
		$counter 		= 1;
		if ($last_number->number) {
			$counter = $last_number->number + 1;
		}
		$new_number = "CK" . date('y') . "-" . sprintf("%03d", $counter);
		return $new_number;
	}

	public function index()
	{
		if ((isset($_GET['c']) && $_GET['c'])) {
			$sheet = $this->db->get_where('view_checksheet_detail_data', ['id' => $_GET['c']])->row();
			$items = $this->db->get_where('checksheet_data_items', ['checksheet_data_number' => $sheet->number])->result();
			$periode 	= [
				'1' => 'Once Time',
				'2' => 'Weekly~Daily',
				'3' => 'Monthly~Daily',
				'4' => 'Weekly~Monthly',
				'5' => 'Yearly~Monthly',
			];
			$width = $count = $name_col = '';
			if ($sheet->periode == 1) {
				$width 		= '100%';
				$col_width 	= '20%';
				$count 		= 1;
				$name_col 	= 'Day';
			} elseif ($sheet->periode == 2) {
				$width 		= '150%';
				$col_width 	= '20%';
				$count 		= 7;
				$name_col 	= 'Day';
			} elseif ($sheet->periode == 3) {
				$width 		= '500%';
				$count 		= 31;
				$name_col 	= 'Day';
			} elseif ($sheet->periode == 4) {
				$width 		= '120%';
				$count 		= 5;
				$name_col 	= 'Week';
			} elseif ($sheet->periode == 5) {
				$width 		= '220%';
				$count 		= 12;
				$name_col 	= 'Month';
			}

			$this->template->set(
				[
					'data' 		=> $sheet,
					'items' 	=> $items,
					'periode' 	=> $periode,
					'width' 	=> $width,
					'count' 	=> $count,
					'name_col' 	=> $name_col,
				]
			);
			$this->template->render('sheet');
			return false;
		}

		$details_data = $this->db->get_where('view_checksheet_detail_data', ['status' => '1'])->result();
		$this->template->set([
			'details_data'  	=> $details_data,
		]);

		$this->template->render('index');
	}

	public function load_sheet()
	{
		$checksheets 	= $this->db->get_where('checksheets', ['company_id' => $this->company, 'status' => '1'])->result();


		$this->template->set(['checksheets' => $checksheets]);
		$this->template->render('create');
	}

	public function load_details($checksheet_id)
	{
		$details 	= $this->db->get_where('checksheet_details', ['checksheet_id' => $checksheet_id, 'company_id' => $this->company, 'status' => '1'])->result();
		echo "<option value=''></option>";
		foreach ($details as $csDtl) {
			echo "<option value='$csDtl->id'>$csDtl->name</option>";
		}
	}

	public function load_detail_data($checksheet_detail_id = null)
	{
		$data 		= $this->db->get_where('checksheet_detail_data', ['checksheet_detail_id' => $checksheet_detail_id, 'company_id' => $this->company, 'status' => '1'])->result();
		$periode 	= [
			'1' => 'Once Time',
			'2' => 'Weekly~Daily',
			'3' => 'Monthly~Daily',
			'4' => 'Weekly~Monthly',
			'5' => 'Yearly~Monthly',
		];
		$html 	= '';
		$n		= 0;
		foreach ($data as $dt) {
			$n++;
			$per = $periode[$dt->periode];
			$html .= "<tr>
						<td class='p-2'>$n</td>
						<td class='p-2'>$dt->name</td>
						<td class='p-2'>$per</td>
						<td class='p-2'>
							<a href='" . base_url($this->uri->segment(1) . "/?c=" . $dt->id) . "' data-id='$dt->id' class='btn btn-info btn-icon btn-sm process' title='Process' data-toggle='tooltip'><i class='fas fa-arrow-right'></i></a>
						</td>
					  </tr>";
		}
		echo $html;
	}

	public function save_checksheet()
	{
		$data	 = $this->input->post();
		$resutls = $data['results'];

		unset($data['results']);
		$data['date_checking'] = date('Y-m-d H:i:s');
		$this->db->trans_begin();

		if (isset($data['id']) && $data['id']) {
			$data['updated_at'] = date('Y-m-d H:i:s');
			$data['checked_by'] = $data['checking_by'];
			unset($data['checking_by']);
			$this->db->update('checksheet_results', $data, ['id' => $data['id']]);
		} else {
			$data['number'] = $this->getNumber();
			$data['company_id'] = $this->company;
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['checked_by'] = $data['checking_by'];
			unset($data['checking_by']);
			$this->db->insert('checksheet_results', $data);
		}

		if ($resutls) {
			foreach ($resutls as $result) {
				if (isset($result['id']) && $result['id']) {
					$this->db->update('checksheet_result_items', $result, ['id' => $result['id']]);
				} else {
					$result['checksheet_result_number'] = $data['number'];
					$this->db->insert('checksheet_result_items', $result);
				}
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Save checksheet failed. Error!'
			);
		} else if ($this->db->affected_rows() > 0) {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Save checksheet successfull'
			);
		} else {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> "Can't Save thisn checksheet. Data not valid"
			);
		}
		echo json_encode($Return);
	}

	public function delete_dir()
	{
		$id 		 = $this->input->post('id');
		$check_child = $this->db->get_where('checksheet_details', ['checksheet_id' => $id])->num_rows();

		$this->db->trans_begin();

		if ($check_child > 0) {
			$data_detail = $this->db->get_where('checksheet_details', ['checksheet_id' => $id,], ['checksheet_id' => $id])->result();

			$this->db->update('checksheet_details', ['status' => '0'], ['checksheet_id' => $id]);
			foreach ($data_detail as $dtl) {
				$detail_data = $this->db->get_where('checksheet_detail_data', ['checksheet_detail_id' => $dtl->id])->result();

				if (count($detail_data) > 0) {
					$this->db->update('checksheet_detail_data', ['status' => '0'], ['checksheet_detail_id' => $dtl->id]);
				}
			}
		}

		$this->db->update('checksheets', ['status' => '0'], ['id' => $id]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Delete directory failed. Error!'
			);
		} else if ($this->db->affected_rows() > 0) {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Delete directory successfull'
			);
		} else {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> "Can't Deleted this directory. Data not valid"
			);
		}
		echo json_encode($Return);
	}


	/* SUB DIRECTORY */

	public function edit_sub_dir($id)
	{
		if ($id) {
			$data = $this->db->get_where('checksheet_details', ['id' => $id])->row();
			echo json_encode(['data' => $data]);
		}
	}

	public function save_sub_dir()
	{
		$post 			= $this->input->post();

		if (!isset($post['id'])) {
			$name 			= $post['name'];
			$checksheet_id 		= $post['checksheet_id'];
			$is_exist 		= $this->db->get_where('checksheet_details', ['name' => $name])->num_rows();

			if ($is_exist > 0) {
				$return = [
					'status' => 0,
					'msg' => 'Directory Name is already exist',
				];
				echo json_encode($return);
				return false;
			}

			$this->db->trans_begin();
			$data = [
				'name' 			=> ucfirst($name),
				'company_id' 	=> $this->company,
				'checksheet_id' 		=> $checksheet_id,
				'created_by' 	=> $this->auth->user_id(),
				'created_at' 	=> date('Y-m-d H:i:s'),
			];

			$this->db->insert('checksheet_details', $data);
		} else {
			$name	= $post['name'];
			$data 	= [
				'name' => strtoupper($name),
				'modified_by' => $this->auth->user_id(),
				'modified_at' => date('Y-m-d H:i:s'),
			];
			$this->db->update('checksheet_details', $data, ['id' => $post['id']]);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Directory failed created. Query Error'
			);
		} else if ($this->db->affected_rows() > 0) {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Directory successfull created'
			);
		} else {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Directory failed created. Data not be inserted'
			);
		}
		echo json_encode($Return);
	}


	public function delete_sub_dir()
	{
		$id 		 = $this->input->post('id');
		$check_child = $this->db->get_where('checksheet_detail_data', ['checksheet_detail_id' => $id])->result();

		$this->db->trans_begin();

		if (count($check_child) > 0) {
			$data_sheet = $this->db->get_where('checksheet_detail_data', ['checksheet_detail_id' => $id])->result();
			foreach ($data_sheet as $sheet) {
				$check_items = $this->db->get_where('checksheet_data_items', ['checksheet_data_number' => $sheet->number])->result();
				if (count($check_items) > 0) {
					$this->db->update('checksheet_data_items', ['status' => '0'], ['checksheet_data_number' => $sheet->number]);
				}
			}
		}

		$this->db->update('checksheet_details', ['status' => '0'], ['id' => $id]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> 'Delete directory failed. Error!'
			);
		} else if ($this->db->affected_rows() > 0) {
			$this->db->trans_commit();
			$Return		= array(
				'status'		=> 1,
				'msg'			=> 'Delete directory successfull'
			);
		} else {
			$this->db->trans_rollback();
			$Return		= array(
				'status'		=> 0,
				'msg'			=> "Can't Deleted this directory. Data not valid"
			);
		}
		echo json_encode($Return);
	}



	/* ADD ITEMS */

	public function upload_file()
	{
		$checksheet_detail_id = $this->input->get('dtl');
		$this->template->set([
			'checksheet_detail_id' 	=> $checksheet_detail_id,
		]);
		$this->template->render('form');
	}

	public function upload_document()
	{
		$data 						= $this->input->post();

		$items = $data['items'];
		unset($data['items']);
		if ($data) {
			try {
				$id							= isset($data['id']) ? $data['id'] : '';
				$data['company_id']			= $this->company;

				if (!isset($data['number'])) {
					$data['number'] = $this->getNumber();
				}

				$this->db->trans_begin();
				$check = $this->db->get_where('checksheet_detail_data', ['id' => $id])->num_rows();

				if (intval($check) == '0') {
					$data['created_by']		= $this->auth->user_id();
					$data['created_at']		= date('Y-m-d H:i:s');
					$this->db->insert('checksheet_detail_data', $data);
					$detail_id = $this->db->order_by('id', 'DESC')->get('checksheet_detail_data')->row()->id;
				} else {
					$data['modified_by']	= $this->auth->user_id();
					$data['modified_at']	= date('Y-m-d H:i:s');
					$this->db->update('checksheet_detail_data', $data, ['id' => $id]);
					$detail_id = $data['id'];
				}

				if ($items) {
					foreach ($items as $item) {
						if (isset($item['id'])) {
							$item['modified_by'] = $this->auth->user_id();
							$item['modified_at'] = date('Y-m-d H:i:s');
							$this->db->update('checksheet_data_items', $item, ['id' => $item['id']]);
						} else {
							$item['created_by'] = $this->auth->user_id();
							$item['created_at'] = date('Y-m-d H:i:s');
							$item['checksheet_data_number'] = $data['number'];
							$this->db->insert('checksheet_data_items', $item);
						}
					}
				}

				if ($this->db->trans_status() === FALSE) {
					$this->db->trans_rollback();
					$Return = [
						'status' => 0,
						'msg'	 => 'Failed save item check. Please try again later.!'
					];
				} else {
					$this->db->trans_commit();
					$Return = [
						'status' => 1,
						'msg'	 => 'Success save item check...'
					];
				}
				echo json_encode($Return);
			} catch (Exception $e) {
				$this->db->trans_rollback();
				$Return = [
					'status' => 0,
					'msg'	 => $e->getMessage()
				];

				echo json_encode($Return);
				return false;
			}
		} else {
			$Return = [
				'status' => 0,
				'msg'	 => 'Data not valid!'
			];
			echo json_encode($Return);
		}
	}

	public function edit_file($id)
	{

		$data = [];
		if ($id) {
			$data 					= $this->db->get_where('checksheet_detail_data', ['id' => $id])->row();
			$data_item 	 			= $this->db->get_where('checksheet_data_items', ['checksheet_data_number' => $data->number, 'status' => '1'])->result();

			$this->template->set([
				'data' 				=> $data,
				'data_item' 		=> $data_item,
			]);
			$this->template->render('edit');
		} else {
			echo "Data not found";
		}
	}

	public function load_file($id)
	{
		$data = [];
		if ($id) {
			$data = $this->db->get_where('view_checksheet_detail_data', ['id' => $id])->row();

			$return = [
				'status' => 1,
				'data' => $data
			];
		} else {
			$return = [
				'status' => 0,
				'data' => $data
			];
		}

		echo json_encode($return);
	}

	public function view_file($id)
	{
		$data 					= $this->db->get_where('checksheet_detail_data', ['id' => $id])->row();
		$data_item 	 			= $this->db->get_where('checksheet_data_items', ['checksheet_data_number' => $data->number, 'status' => '1'])->result();
		$periode 			= [
			'1' => 'Once Time',
			'2' => 'Weekly~Daily',
			'3' => 'Monthly~Daily',
			'4' => 'Weekly~Monthly',
			'5' => 'Yearly~Monthly',
		];
		$this->template->set([
			'data' 				=> $data,
			'data_item' 		=> $data_item,
			'periode' 			=> $periode,
		]);

		$this->template->render('view-file');
	}

	public function delete_sheet()
	{
		$id 		 = $this->input->post('id');
		if ($id) {
			$data 		 = $this->db->get('checksheet_detail_data')->row();
			$check_child = $this->db->get_where('checksheet_data_items', ['checksheet_data_number' => $data->number])->result();

			$this->db->trans_begin();
			if (count($check_child) > 0) {
				$this->db->update('checksheet_data_items', ['status' => '0'], ['checksheet_data_number' => $data->number]);
			}
			$this->db->update('checksheet_detail_data', ['status' => '0'], ['id' => $id]);

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$Return		= array(
					'status'		=> 0,
					'msg'			=> 'Delete sheet failed. Error!'
				);
			} else if ($this->db->affected_rows() > 0) {
				$this->db->trans_commit();
				$Return		= array(
					'status'		=> 1,
					'msg'			=> 'Delete sheet successfull'
				);
			} else {
				$this->db->trans_rollback();
				$Return		= array(
					'status'		=> 0,
					'msg'			=> "Can't Deleted this sheet. Data not valid"
				);
			}
			echo json_encode($Return);
		} else {
			$Return		= array(
				'status'		=> 0,
				'msg'			=> "Data not valid"
			);
			echo json_encode($Return);
		}
	}

	public function delete_item()
	{
		$id 		 = $this->input->post('id');
		if ($id) {
			$this->db->trans_begin();
			$this->db->update('checksheet_data_items', ['status' => '0'], ['id' => $id]);
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$Return		= array(
					'status'		=> 0,
					'msg'			=> 'Delete item failed. Error!'
				);
			} else if ($this->db->affected_rows() > 0) {
				$this->db->trans_commit();
				$Return		= array(
					'status'		=> 1,
					'msg'			=> 'Delete item successfull'
				);
			} else {
				$this->db->trans_rollback();
				$Return		= array(
					'status'		=> 0,
					'msg'			=> "Can't Deleted this item. Data not valid"
				);
			}
			echo json_encode($Return);
		} else {
			$Return		= array(
				'status'		=> 0,
				'msg'			=> "Data not valid"
			);
			echo json_encode($Return);
		}
	}

	/* ===================== */
	public function print_document()
	{
		$this->load->library(array('Mpdf'));
		$folder = $_GET['p'];
		$file = $_GET['f'];

		$mpdf = new mPDF('', '', '', '', '', '', '', '', '', '');
		$mpdf->SetImportUse();
		$pagecount = $mpdf->SetSourceFile('directory/' . $folder . '/' . $file);
		$tplId = $mpdf->ImportPage($pagecount);
		$mpdf->UseTemplate($tplId);
		$mpdf->addPage();
		$mpdf->WriteHTML('Hello World');
		$newfile = 'directory/' . $folder . '/' . $file;
		$mpdf->Output($newfile, 'F');
		$mpdf->Output();
	}
}
