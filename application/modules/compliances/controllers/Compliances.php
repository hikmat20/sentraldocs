<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Perusahaan
 */

class Compliances extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->template->set([
            'title' => 'Compliances',
            'icon' => 'fa fa-user-tie'
        ]);

        date_default_timezone_set("Asia/Bangkok");
    }

    private function _getId()
    {
        $count  = 1;
        $sql    = "SELECT MAX(RIGHT(id,4)) as maxId FROM scopes";
        $result = $this->db->query($sql)->row();
        if ($result->maxId > 0) {
            $count = $result->maxId + 1;
        }
        return "SCP" . str_pad($count, 4, "0", STR_PAD_LEFT);
    }

    public function index()
    {
        $data = $this->db->get_where('view_references')->result();
        $this->template->set('data', $data);
        $this->template->render('index');
    }

    //Create New Customer
    public function detail($id = null)
    {
        if ($id) {
            $data = $this->db->get_where('view_references', ['id' => $id])->row();
            $regulations = $this->db->get_where('view_ref_regulations')->result();

            $this->template->set([
                'data'          => $data,
                'regulations'   => $regulations,
            ]);
            $this->template->render('detail');
        } else {
        }
    }

    public function loadDesc($id = null)
    {
        if ($id) {
            $pasal      = $this->db->get_where('regulation_pasal', ['regulation_id' => $id])->row();
            $data       = $this->db->get_where('view_regulation_paragraphs', ['regulation_id' => $id])->result();

            $ArrPasal   = [];
            foreach ($data as $dt) {
                $ArrPasal[$dt->pasal_id][] = $dt;
            }

            $this->template->set([
                'data'          => $data,
                'pasal'         => $pasal,
                'ArrPasal'      => $ArrPasal,
            ]);
            $this->template->render('list-desc');
        }
    }

    public function save()
    {
        $data       = $this->input->post();
        $this->db->trans_begin();
        if ($data) {
            if (isset($data['id']) && $data['id']) {
                $data['modified_at'] = date('Y-m-d H:i:s');
                $data['modified_by'] = $this->auth->user_id();
                $this->db->update('scopes', $data, ['id' => $data['id']]);
            } else {
                $data['id']         = $this->_getId();
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $this->auth->user_id();
                $this->db->insert('scopes', $data);
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return        = array(
                    'status'        => 0,
                    'msg'            => 'Data Scopes Failed save. Please Try Again!'
                );
            } else {
                $this->db->trans_commit();
                $return        = array(
                    'status'        => 1,
                    'msg'            => 'Data Scopes successfull saved. Thanks you.'
                );
            }
        } else {
            $this->db->trans_commit();
            $return        = array(
                'status'        => 0,
                'msg'            => 'Data not valid. Please Try Again!'
            );
        }
        echo json_encode($return);
    }

    //Edit Perusahaan
    public function edit($id = null)
    {
        $data = $this->db->get_where('scopes', ['id' => $id])->row();
        $this->template->set('data', $data);
        $this->template->render('edit');
    }

    public function view($id = null)
    {
        $data = $this->db->get_where('scopes', ['id' => $id])->row();
        $this->template->set('data', $data);
        $this->template->render('view');
    }

    function delete()
    {
        $id = $this->input->post('id');
        $this->db->trans_begin();

        if ($id != '') {
            $this->db->delete('scopes', ['id' => $id]);
        } else {
            $this->db->trans_rollback();
            $Return = [
                'msg'       => "Data not valid",
                'status'    => 0
            ];
            echo json_encode($Return);
            return false;
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $Return = [
                'msg'       => "Successfull save data scopes.",
                'status'    => 0
            ];
        } else {
            $this->db->trans_commit();
            $Return = [
                'msg'       => "Failed save data scopes, please try again.",
                'status'    => 1
            ];
        }

        echo json_encode($Return);
    }
}
