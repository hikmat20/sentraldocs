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
        $count      = 1;
        $sql        = "SELECT MAX(RIGHT(id,4)) as maxId FROM compliances";
        $result     = $this->db->query($sql)->row();
        if ($result->maxId > 0) {
            $count = $result->maxId + 1;
        }
        return "COMP" . str_pad($count, 4, "0", STR_PAD_LEFT);
    }

    public function index()
    {
        $reference = $this->db->get_where('view_references', ['company_id' => $this->company])->row();
        if ($reference) {
            $data = $this->db->get_where('view_compliances', ['reference_id' => $reference->id, 'company_id' => $reference->company_id])->result();
        }

        $this->template->set([
            'reference' => $reference,
            'data' => $data
        ]);
        $this->template->render('list');
    }

    public function lists($id = null)
    {
        $data = [];
        if ($id) {
            $reference = $this->db->get_where('view_references', ['id' => $id])->row();
            $data = $this->db->get_where('view_compliances', ['reference_id' => $id, 'company_id' => $reference->company_id])->result();
        }

        $this->template->set([
            'reference' => $reference,
            'data' => $data
        ]);
        $this->template->render('list');
    }

    public function details($id = null)
    {
        if ($id) {
            $compliance         = $this->db->get_where('view_compliances', ['id' => $id])->row();
            $data               = $this->db->get_where('view_regulation_paragraphs', ['regulation_id' => $compliance->regulation_id])->result();
            $users              = $this->db->get_where('view_users', ['company_id' => $this->company, 'status' => 'ACT'])->result();

            /* data phoaragraph */
            $complianceDtl = $this->db->get_where('compliance_details', ['regulation_id' => $compliance->regulation_id])->result();

            $ArrCompl = [];
            foreach ($complianceDtl as $dtl) {
                $ArrCompl[$dtl->prgh_id] = $dtl;
            }

            $ArrPasal   = [];
            foreach ($data as $dt) {
                $ArrPasal[$dt->pasal_id][] = $dt;
            }

            $compOpports = $this->db->get_where('compliance_opports', ['regulation_id' => $compliance->regulation_id])->result();
            $ArrOpports = [];

            foreach ($compOpports as $opp) {
                $ArrOpports[$opp->prgh_id][] = $opp;
            }

            $this->template->set([
                'data'          => $data,
                'ArrPasal'      => $ArrPasal,
                'users'         => $users,
                'compliance'    => $compliance,
                'ArrCompl'      => $ArrCompl,
                'ArrOpports'    => $ArrOpports,
            ]);

            $this->template->render('list-desc');
        }
    }

    public function add($comp_id = null)
    {
        $regulations    = $this->db->get_where('view_ref_regulations', ['status' => 'OPN', 'company_id' => $comp_id])->result();
        $compDtl        = $this->db->get_where('view_compliances', ['company_id' => $this->company])->result();

        $ArrCompl = [];
        foreach ($compDtl as $dtl) {
            $ArrCompl[] = $dtl->regulation_id;
        }

        $this->template->set([
            'regulations' => $regulations,
            'ArrCompl' => $ArrCompl,
        ]);
        $this->template->render('add');
    }

    public function save_complience()
    {
        $data = $this->input->post();
        $data['date']       = date('Y-m-d');
        $data['company_id'] = $this->company;
        if ($data) {
            $this->db->trans_begin();
            if (isset($data['id']) && $data['id']) {
                $data['modified_at']    = date('Y-m-d H:i:s');
                $data['modified_by']    = $this->auth->user_id();
                $this->db->update('compliances', $data, ['id' => $data['id']]);
            } else {
                $data['id']             = $this->_getId();
                $data['created_at']     = date('Y-m-d H:i:s');
                $data['created_by']     = $this->auth->user_id();
                $this->db->insert('compliances', $data);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return        = array(
                    'status'        => 0,
                    'msg'            => 'Compliance Failed save. Please Try Again!'
                );
            } else {
                $this->db->trans_commit();
                $return        = array(
                    'status'        => 1,
                    'msg'            => 'Compliance successfull saved. Thanks you.'
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

    //Create New Customer
    public function detail($id = null)
    {
        if ($id) {
            $data = $this->db->get_where('view_references', ['id' => $id])->row();
            $regulations = $this->db->get_where('view_ref_regulations')->result();
            $users = $this->db->get_where('view_users', ['company_id' => $this->company, 'status' => 'ACT'])->result();

            $this->template->set([
                'data'          => $data,
                'regulations'   => $regulations,
                'users'         => $users,
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
            $users      = $this->db->get_where('view_users', ['company_id' => $this->company, 'status' => 'ACT'])->result();

            $ArrPasal   = [];
            foreach ($data as $dt) {
                $ArrPasal[$dt->pasal_id][] = $dt;
            }

            $this->template->set([

                'data'          => $data,
                'pasal'         => $pasal,
                'ArrPasal'      => $ArrPasal,
                'users'         => $users,
            ]);
            $this->template->render('list-desc');
        }
    }

    public function save()
    {
        $data       = $this->input->post();

        if (isset($data['detail'])) {
            foreach ($data['detail'] as $key => $dtl) {
                $detailComp[$key] = [
                    'complience_id'     => $data['compliance_id'],
                    'reference_id'      => $data['reference_id'],
                    'company_id'        => $this->company,
                    'regulation_id'     => $data['regulation_id'],
                    'prgh_id'           => $dtl['prgh_id'],
                    'pasal_id'          => $dtl['pasal_id'],
                    'description'       => $dtl['description'],
                    'compliance_desc'   => $dtl['complience_desc'],
                    'status'            => ($dtl['status']) ?: null,
                ];
            }
        }

        if (isset($data['opport'])) {
            foreach ($data['opport'] as $key => $dtlOpp) {
                foreach ($dtlOpp as $k => $dtl) {
                    $detailOpport[] = [
                        'id'                => isset($dtl['id']) ? $dtl['id'] : '',
                        'compliance_id'     => $data['compliance_id'],
                        'reference_id'      => $data['reference_id'],
                        'prgh_id'           => $dtl['prgh_id'],
                        'company_id'        => $this->company,
                        'regulation_id'     => $data['regulation_id'],
                        'category'          => $dtl['category'],
                        'description'       => $dtl['description'],
                        'action_plan'       => $dtl['action_plan'],
                        'pic'               => $dtl['pic'],
                        'due_date'          => $dtl['due_date'],
                    ];
                }
            }
        }

        if ($data) {
            $this->db->trans_begin();
            if (isset($detailComp) && $detailComp) {
                $this->db->insert_batch('compliance_details', $detailComp);
            }
            if (isset($detailOpport) && $detailOpport) {
                foreach ($detailOpport as $k => $op) {
                    if ($op['id']) {
                        $op['modified_at']        = date('Y-m-d H:i:s');
                        $op['modified_by']        = $this->auth->user_id();
                        $this->db->update('compliance_opports', $op, ['id' => $op['id']]);
                    } else {
                        $op['created_at']        = date('Y-m-d H:i:s');
                        $op['created_by']        = $this->auth->user_id();
                        $this->db->insert('compliance_opports', $op);
                    }
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return        = array(
                    'status'        => 0,
                    'msg'            => 'Data Detail Compliance Failed save. Please Try Again!'
                );
            } else {
                $this->db->trans_commit();
                $return        = array(
                    'status'        => 1,
                    'msg'            => 'Data Detail Compliance successfull saved. Thanks you.'
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
