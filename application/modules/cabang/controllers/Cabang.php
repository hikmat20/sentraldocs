<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Perusahaan
 */

class Cabang extends Admin_Controller {

    //Permission
    protected $viewPermission   = "Cabang.View";
    protected $addPermission    = "Cabang.Add";
    protected $managePermission = "Cabang.Manage";
    protected $deletePermission = "Cabang.Delete";

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('Cabang/Cabang_model',
                                 'Aktifitas/aktifitas_model'
                                ));
        $this->template->title('Manage Data Cabang');
        $this->template->page_icon('fa fa-table');

        date_default_timezone_set("Asia/Bangkok");
    }

    public function index()
    {
        $this->auth->restrict($this->viewPermission);

        $data = $this->Cabang_model->get_data('perusahaan_cbg');

        $this->template->set('results', $data);
        $this->template->title('Cabang');
        $this->template->render('index');
    }

    //Create New Customer
    public function create()
    {
        $this->auth->restrict($this->addPermission);
        // $datkota    = $this->Cabang_model->pilih_kota()->result();

        // $this->template->set('datkota',$datkota);
        $this->template->title('Input Master Cabang');
        $this->template->render('create_cabang');
    }
	
	public function saveCabang(){
		$this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');
		
		$post = $this->input->post();
		$perusahaan = $this->input->post('nm_perusahaan');
		$cabang     = $this->input->post('nm_cabang');
		$alamat     = $this->input->post('alamat_cabang');
		$inisial    = $this->input->post('inisial');
		$tgl = date("Y-m-d H:i:s");
		
		$this->db->trans_begin();
		$data = [
			'id_perusahaan'		=> $perusahaan,
			'nm_cabang'		    => $cabang,
			'alamat'		    => $alamat,
			'inisial'			=> $inisial,
			'created_on'		=> date('Y-m-d H:i:s'),
			'created_by'		=> $this->auth->user_id()
			
		];
		
		$insert = $this->db->insert("perusahaan_cbg",$data);
		
		 if($this->db->trans_status() === FALSE){
			 $this->db->trans_rollback();
			 $Arr_Return		= array(
					'status'		=> 2,
					'pesan'			=> 'Save Process Failed. Please Try Again...'
			   );
			   
			    $keterangan     = "Gagal, Add data Cabang ".$cabang.", atas Nama : ".$perusahaan;
                $status         = 0;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $cabang;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
		}else{
			 $this->db->trans_commit();
			 $Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. '
		   );
		   
		        $keterangan     = "Sukses, Add data Cabang ".$cabang.", atas Nama : ".$perusahaan;
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $cabang;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
		}
		echo json_encode($Arr_Return);
		
		 simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
	}

    //Edit Cabang
  public function edit(){
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');		
		
		
		$id    = $this->input->post('id_cabang');
		
		
		$this->template->set('id',$id);
		$this->template->render('edit_cabang'); 
		
	}


    public function saveEditCabang(){
		$this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');
		
		$post = $this->input->post();
		$id         = $this->input->post('id_cabang');
		$perusahaan = $this->input->post('nm_perusahaan');
		$cabang     = $this->input->post('nm_cabang');
		$inisial    = $this->input->post('inisial');
		$alamat     = $this->input->post('alamat_cabang');
		$tgl = date("Y-m-d H:i:s");
		
		$this->db->trans_begin();
		$data = [
			'nm_cabang'		    => $cabang,
			'id_perusahaan'		=> $perusahaan,
			'alamat'		    => $alamat,
			'modified_on'		=> date('Y-m-d H:i:s'),
			'modified_by'		=> $this->auth->user_id(),
			'inisial'		    => $inisial,
			
		];
		
		$this->db->where('id_cabang', $id);
        $this->db->update('perusahaan_cbg', $data);
		
		 if($this->db->trans_status() === FALSE){
			 $this->db->trans_rollback();
			 $Arr_Return		= array(
					'status'		=> 2,
					'pesan'			=> 'Update Process Failed. Please Try Again...'
			   );
			   
			    $keterangan     = "Gagal, Update data Cabang ".$cabang.", atas Nama : ".$perusahaan;
                $status         = 0;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $cabang;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
		}else{
			 $this->db->trans_commit();
			 $Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. '
		   );
		   
		        $keterangan     = "Sukses, Update data Cabang ".$cabang.", atas Nama : ".$perusahaan;
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $cabang;
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
                $result = $this->Cabang_model->update_batch($data,'id');

                $keterangan     = "SUKSES, Edit data Cabang ".$id.", atas Nama : ".$namacabang;
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $kdcab;
                $jumlah         = 1;
                $sql            = $this->db->last_query();

            }
            else
            {
                $result = FALSE;

                $keterangan     = "GAGAL, Edit data Cabang ".$id.", atas Nama : ".$namacabang;
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
            $id = $this->Cabang_model->insert($data);

            if(is_numeric($id))
            {
                $keterangan     = "SUKSES, tambah data Cabang ".$id.", atas Nama : ".$namacabang;
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = 'NewData';
                $jumlah         = 1;
                $sql            = $this->db->last_query();

                $result         = TRUE;
            }
            else
            {
                $keterangan     = "GAGAL, tambah data Cabang ".$id.", atas Nama : ".$namacabang;
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

    function hapus_cabang()
    {
        $this->auth->restrict($this->deletePermission);
        $id = $this->uri->segment(3);

        if($id!=''){

            $result = $this->Cabang_model->delete($id);

            $keterangan     = "SUKSES, Delete data Cabang ".$id;
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $id;
            $jumlah         = 1;
            $sql            = $this->db->last_query();

        }
        else
        {
            $result = 0;
            $keterangan     = "GAGAL, Delete data Cabang ".$id;
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
	
	
	function get_perusahaan()
    {
        $users	= $this->db->query("SELECT * FROM perusahaan")->result();
		echo "<select id='nm_perusahaan' name='nm_perusahaan' class='select2'>
				<option value=''>Pilih Perusahaan</option>";
				foreach($users as $pic){
		echo "<option value='$pic->id_perusahaan'>$pic->nm_perusahaan</option>";
				}
		echo "</select>";
	}

   
}

?>
