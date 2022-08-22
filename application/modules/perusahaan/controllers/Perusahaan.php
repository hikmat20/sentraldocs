<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Perusahaan
 */

class Perusahaan extends Admin_Controller {

    //Permission
    protected $viewPermission   = "Perusahaan.View";
    protected $addPermission    = "Perusahaan.Add";
    protected $managePermission = "Perusahaan.Manage";
    protected $deletePermission = "Perusahaan.Delete";

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('Perusahaan/Perusahaan_model',
                                 'Aktifitas/aktifitas_model'
                                ));
        $this->template->title('Manage Data Perusahaan');
        $this->template->page_icon('fa fa-table');

        date_default_timezone_set("Asia/Bangkok");
    }

    public function index()
    {
        $this->auth->restrict($this->viewPermission);

        $data = $this->Perusahaan_model->get_data('perusahaan');

        $this->template->set('results', $data);
        $this->template->title('Perusahaan');
        $this->template->render('index');
    }

    //Create New Customer
    public function create()
    {
        $this->auth->restrict($this->addPermission);
        // $datkota    = $this->Perusahaan_model->pilih_kota()->result();

        // $this->template->set('datkota',$datkota);
        $this->template->title('Input Master Perusahaan');
        $this->template->render('create_perusahaan');
    }
	
	public function savePerusahaan(){
		$this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');
		
		$post = $this->input->post();
		$perusahaan = $this->input->post('nm_perusahaan');
		$inisial    = $this->input->post('inisial_perusahaan');
		$alamat     = $this->input->post('alamat_perusahaan');
		$tgl = date("Y-m-d H:i:s");
		
		$this->db->trans_begin();
		$data = [
			'inisial'		    => $inisial,
			'nm_perusahaan'		=> $perusahaan,
			'alamat'		    => $alamat,
			'created_on'		=> date('Y-m-d H:i:s'),
			'created_by'		=> $this->auth->user_id()
			
		];
		
		$insert = $this->db->insert("perusahaan",$data);
		
		 if($this->db->trans_status() === FALSE){
			 $this->db->trans_rollback();
			 $Arr_Return		= array(
					'status'		=> 2,
					'pesan'			=> 'Save Process Failed. Please Try Again...'
			   );
			   
			    $keterangan     = "Gagal, Add data Perusahaan ".$inisial.", atas Nama : ".$perusahaan;
                $status         = 0;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $inisial;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
		}else{
			 $this->db->trans_commit();
			 $Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. '
		   );
		   
		        $keterangan     = "Sukses, Add data Perusahaan ".$inisial.", atas Nama : ".$perusahaan;
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $inisial;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
		}
		echo json_encode($Arr_Return);
		
		 simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
	}

    //Edit Perusahaan
  public function edit(){
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');		
		
		
		$id    = $this->input->post('id_perusahaan');
		
		
		$this->template->set('id',$id);
		$this->template->render('edit_perusahaan'); 
		
	}


    public function saveEditPerusahaan(){
		$this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');
		
		$post = $this->input->post();
		$id         = $this->input->post('id_perusahaan');
		$perusahaan = $this->input->post('nm_perusahaan');
		$inisial    = $this->input->post('inisial_perusahaan');
		$alamat     = $this->input->post('alamat_perusahaan');
		$tgl = date("Y-m-d H:i:s");
		
		$this->db->trans_begin();
		$data = [
			'inisial'		    => $inisial,
			'nm_perusahaan'		=> $perusahaan,
			'alamat'		    => $alamat,
			'modified_on'		=> date('Y-m-d H:i:s'),
			'modified_by'		=> $this->auth->user_id()
			
		];
		
		$this->db->where('id_perusahaan', $id);
        $this->db->update('perusahaan', $data);
		
		 if($this->db->trans_status() === FALSE){
			 $this->db->trans_rollback();
			 $Arr_Return		= array(
					'status'		=> 2,
					'pesan'			=> 'Update Process Failed. Please Try Again...'
			   );
			   
			    $keterangan     = "Gagal, Update data Perusahaan ".$inisial.", atas Nama : ".$perusahaan;
                $status         = 0;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $inisial;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
		}else{
			 $this->db->trans_commit();
			 $Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. '
		   );
		   
		        $keterangan     = "Sukses, Update data Perusahaan ".$inisial.", atas Nama : ".$perusahaan;
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $inisial;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
		}
		echo json_encode($Arr_Return);
		
		 simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
	}
	
    //Save customer ajax
    public function save_data_cabang(){

        $type           = $this->input->post("type");
        $id             = $this->input->post("id");
        $kdcab          = $this->input->post("kdcab");
        $namacabang     = $this->input->post("namacabang");
        $alamat         = $this->input->post('alamat');
        $kepalacabang   = $this->input->post('kepalacabang');
        $kabagjualan    = $this->input->post('kabagjualan');
        $admcabang      = $this->input->post('admcabang');
        $gudang         = $this->input->post('gudang');
        $kota           = $this->input->post('kota');
        $no_so          = $this->input->post('no_so');
        $no_suratjalan  = $this->input->post('no_suratjalan');
        $no_picking_list= $this->input->post('no_picking_list');
        $no_invoice     = $this->input->post('no_invoice');
        $no_pr          = $this->input->post('no_pr');
        $no_po          = $this->input->post('no_po');
        $no_receive     = $this->input->post('no_receive');
        $th_picking_list= $this->input->post('th_picking_list');
        $biaya_logistik_lokal          = $this->input->post('biaya_logistik_lokal');
        $sts_aktif      = $this->input->post('sts_aktif');

        if($type=="edit")
        {
            $this->auth->restrict($this->managePermission);

            if($id!="")
            {
                $data = array(
                            array(
                                'id'=>$id,
                                'kdcab'=>$kdcab,
                                'namacabang'=>$namacabang,
                                'alamat'=>$alamat,
                                'kepalacabang'=>$kepalacabang,
                                'kabagjualan'=>$kabagjualan,
                                'admcabang'=>$admcabang,
                                'gudang'=>$gudang,
                                'kota'=>$kota,
                                'no_so'=>$no_so,
                                'no_suratjalan'=>$no_suratjalan,
                                'no_invoice'=>$no_invoice,
                                'no_picking_list'=>$no_picking_list,
                                'no_pr'=>$no_pr,
                                'no_po'=>$no_po,
                                'no_receive'=>$no_receive,
                                'th_picking_list'=>$th_picking_list,
                                'biaya_logistik_lokal'=>$biaya_logistik_lokal,
                                'sts_aktif'=>$sts_aktif,
                            )
                        );

                //Update data
                $result = $this->Perusahaan_model->update_batch($data,'id');

                $keterangan     = "SUKSES, Edit data Perusahaan ".$id.", atas Nama : ".$namacabang;
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $kdcab;
                $jumlah         = 1;
                $sql            = $this->db->last_query();

            }
            else
            {
                $result = FALSE;

                $keterangan     = "GAGAL, Edit data Perusahaan ".$id.", atas Nama : ".$namacabang;
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $kdcab;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
            }

            simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);

        }
        else //Add New
        {
            $this->auth->restrict($this->addPermission);

            $data = array(
                        'id'=>$id,
                        'kdcab'=>$kdcab,
                        'namacabang'=>$namacabang,
                        'alamat'=>$alamat,
                        'kepalacabang'=>$kepalacabang,
                        'kabagjualan'=>$kabagjualan,
                        'admcabang'=>$admcabang,
                        'gudang'=>$gudang,
                        'kota'=>$kota,
                        'no_so'=>$no_so,
                        'no_suratjalan'=>$no_suratjalan,
                        'no_invoice'=>$no_invoice,
                        'no_picking_list'=>$no_picking_list,
                        'no_pr'=>$no_pr,
                        'no_po'=>$no_po,
                        'no_receive'=>$no_receive,
                        'th_picking_list'=>$th_picking_list,
                        'biaya_logistik_lokal'=>$biaya_logistik_lokal,
                        'sts_aktif'=>$sts_aktif,
                        );

            //Add Data
            $id = $this->Perusahaan_model->insert($data);

            if(is_numeric($id))
            {
                $keterangan     = "SUKSES, tambah data Perusahaan ".$id.", atas Nama : ".$namacabang;
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = 'NewData';
                $jumlah         = 1;
                $sql            = $this->db->last_query();

                $result         = TRUE;
            }
            else
            {
                $keterangan     = "GAGAL, tambah data Perusahaan ".$id.", atas Nama : ".$namacabang;
                $status         = 0;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = 'NewData';
                $jumlah         = 1;
                $sql            = $this->db->last_query();
                $result = FALSE;
            }
            //Save Log
            simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);

        }

        $param = array(
                'save' => $result
                );

        echo json_encode($param);
    }

    function hapus_perusahaan()
    {
        $this->auth->restrict($this->deletePermission);
        $id = $this->uri->segment(3);

        if($id!=''){

            $result = $this->Perusahaan_model->delete($id);

            $keterangan     = "SUKSES, Delete data Perusahaan ".$id;
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $id;
            $jumlah         = 1;
            $sql            = $this->db->last_query();

        }
        else
        {
            $result = 0;
            $keterangan     = "GAGAL, Delete data Perusahaan ".$id;
            $status         = 0;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $id;
            $jumlah         = 1;
            $sql            = $this->db->last_query();

        }

        //Save Log
            simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);

        $param = array(
                'delete' => $result,
                'idx'=>$id
                );

        echo json_encode($param);
    }

   
}

?>
