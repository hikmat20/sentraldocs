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
		$Data 	= $this->db->get_where('view_standards', ['id' => $id])->row();
		$this->template->set([
			'Data' 		=> $Data
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

	public function delete_file()
	{
		$id = $this->input->post('id');

		if (($id)) {
			$this->db->trans_begin();
			$data = $this->db->get_where('standards', ['id' => $id])->row();
			$this->db->update('standards', ['document' => null], ['id' => $id]);
			if (file_exists('./standards/' . $data->document)) {
				unlink('./standards/' . $data->document);
			}
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

	// public function export_excel()
	// {
	// 	$data			= $this->db->get_where('view_standards', ['status' => 'PUB'])->result();
	// 	$drafts			= $this->db->get_where('view_standards', ['status' => 'DFT'])->result();
	// 	$scopes 		= $this->db->get_where('tool_scopes')->result();
	// 	$ArrScopes = [];
	// 	foreach ($scopes as $sc) {
	// 		$ArrScopes[$sc->id] = $sc->name;
	// 	}

	// 	$this->template->set([
	// 		'data' 			=> $data,
	// 		'drafts' 		=> $drafts,
	// 		'ArrScopes' 	=> $ArrScopes,
	// 	]);
	// }

	public function export_excel()
	{
		// Panggil class PHPExcel nya
		require(APPPATH . 'libraries/PHPExcel.php');
		require(APPPATH . 'libraries/PHPExcel/Writer/Excel2007.php');

		$excel    = new PHPExcel();
		$htmlText = new PHPExcel_Helper_HTML;

		// Settingan awal fil excel
		$excel->getProperties()->setCreator('Sentral Sistem')
			->setLastModifiedBy('Sentral Sistem')
			->setTitle("Standards")
			->setSubject("Project Controller")
			->setDescription("Data Standard Reference")
			->setKeywords("Standard Reference");

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			// 'borders' => array(
			//   'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			//   'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			//   'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			//   'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			// )
		);

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP, // Set text jadi di tengah secara vertical (middle)
				'wrap' => true
			),
			// 'borders' => array(
			//   'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			//   'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			//   'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			//   'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			// )
		);

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

		$excel->setActiveSheetIndex(0)->setCellValue('A1', 'STANDARDS REFERENCE'); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:D1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(24); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); // Set text center untuk kolom A1

		// // Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO")->getStyle('A3')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "SCOPES")->getStyle('B3')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "STANDARDS NAME")->getStyle('C3')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "YEAR")->getStyle('D3')->applyFromArray($style_col);

		// menampilkan semua data
		$no = 0;
		$numRow = 4; // Set baris pertama
		foreach ($data as $key => $dt) {
			$no++;
			$numRow++;
			$excel->setActiveSheetIndex(0)->setCellValue("A$numRow", $no)->getStyle("A$numRow")->applyFromArray($style_row);
			$excel->setActiveSheetIndex(0)->setCellValue("B$numRow", $ArrScopes[$dt->scope_id])->getStyle("A$numRow")->applyFromArray($style_row);
			$excel->setActiveSheetIndex(0)->setCellValue("C$numRow",  $dt->name)->getStyle("A$numRow")->applyFromArray($style_row);
			$excel->setActiveSheetIndex(0)->setCellValue("D$numRow", $dt->year)->getStyle("A$numRow")->applyFromArray($style_row);
		}

		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(45); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Sheet1");
		$excel->setActiveSheetIndex(0);

		// // Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Standards Reference".xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		ob_end_clean();
		$writer->save('php://output');
	}
}
