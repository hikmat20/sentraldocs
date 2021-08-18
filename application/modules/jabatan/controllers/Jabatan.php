<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Jabatan
 */

class Jabatan extends Admin_Controller
{

    //Permission
    protected $viewPermission   = "Jabatan.View";
    protected $addPermission    = "Jabatan.Add";
    protected $managePermission = "Jabatan.Manage";
    protected $deletePermission = "Jabatan.Delete";
    protected $approvalPermission = "Jabatan.Approval";

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('download');
        $this->load->library(array('upload', 'Image_lib'));
        $this->load->model(array(
            'Jabatan/Jabatan_model',
            'Aktifitas/aktifitas_model'
        ));

        $this->template->title('Manage Data Folder');
        $this->template->page_icon('fa fa-folder');

        date_default_timezone_set("Asia/Bangkok");
    }

    public function index()
    {
        $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
        $this->template->page_icon('fa fa-user');
        $get_Data        = $this->Jabatan_model->getData('tbl_jabatan');
        $this->template->set('row', $get_Data);
        $this->template->set('title', 'Index Of Jabatan');
        $this->template->render('index');
    }

    public function add()
    {
        $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');


        if ($this->input->post()) {

            $Arr_Kembali            = array();
            $data_session            = $this->session->userdata;
            // $data['created_by']		= $data_session['User']['username']; 
            // $data['created']		= date('Y-m-d H:i:s');
            $data['nm_jabatan']    = $this->input->post('nm_jabatan');

            if ($this->Jabatan_model->simpan('tbl_jabatan', $data)) {
                $Arr_Kembali        = array(
                    'status'        => 1,
                    'pesan'            => 'Add Jabatan Success. Thank you & have a nice day.......'
                );

                $keterangan = 'Berhasil Simpan Folder';
                $status = 1;
                $nm_hak_akses = $this->addPermission;
                $kode_universal = $this->input->post('nama_master');
                $jumlah = 1;
                $sql = $this->db->last_query();
                simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
            } else {
                $Arr_Kembali        = array(
                    'status'        => 2,
                    'pesan'            => 'Add Jabatan failed. Please try again later......'
                );
            }
            echo json_encode($Arr_Kembali);
        } else {



            $this->template->page_icon('fa fa-user');
            $this->template->title('Create Jabatan ');
            $this->template->render('add_jabatan');
        }
    }
}
