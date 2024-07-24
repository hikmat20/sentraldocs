<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Hikmat
 * @copyright Copyright (c) 2024, Hikmat
 *
 */

class Audit_checklist extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->template->set([
            'title' => 'Audit Checklist',
            'icon' => 'fa fa-check-double'
        ]);

        date_default_timezone_set("Asia/Bangkok");
    }

    private function _getId()
    {
        $count    = 1;
        $result   = $this->db->select('MAX(RIGHT(id,3)) as id')->from('audit_checklist')->where(['SUBSTR(id,3,4)' => date('ym')])->get()->row();

        if ($result->id > 0) {
            $count = $result->id + 1;
        }
        return "CK" . date('ym-') . sprintf("%03d", $count);
    }

    private function _getDtlId($id)
    {
        $count    = 1;
        $result   = $this->db->select('MAX(RIGHT(id,3)) as id')->from('audit_checklist_details')->where(['checklist_id' => $id])->get()->row();

        if ($result->id > 0) {
            $count = $result->id + 1;
        }
        return $count;
    }

    private function _getAuditId()
    {
        $count    = 1;
        $result   = $this->db->select('MAX(RIGHT(id,3)) as id')->from('audit_checklist_audit')->where(['SUBSTR(id,3,4)' => date('ym')])->get()->row();

        if ($result->id > 0) {
            $count = $result->id + 1;
        }
        return "AT" . date('ym-') . sprintf("%03d", $count);
    }

    private function _getAuditDtlId($id)
    {
        $count    = 1;
        $result   = $this->db->select('MAX(RIGHT(id,3)) as id')->from('audit_checklist_audit_details')->where(['audit_id' => $id])->get()->row();

        if ($result->id > 0) {
            $count = $result->id + 1;
        }
        return $count;
    }

    public function index()
    {
        $data = $this->db->get_where('view_audit_checklist', ['status' => '1'])->result();
        $this->template->set('data', $data);
        $this->template->render('index');
    }

    public function add()
    {
        $data        = $this->db->get_where('procedures', ['company_id' => $this->company, 'status !=' => 'DEL', 'deleted_at' => null])->result();
        $this->template->set('title', 'Add New Checklist');
        $this->template->set('data', $data);
        $this->template->render('add');
    }

    public function select_procedure($id = '')
    {
        $this->db->select('*')->from('view_cross_reference_details');
        $this->db->where("find_in_set($id, procedure_id)");
        $this->db->where("company_id", $this->company);
        $Data = $this->db->get()->result();

        $ArrData = [];
        foreach ($Data as $dt) {
            $ArrData['id'][$dt->requirement_id] = $dt->requirement_id;
            $ArrData['standards'][$dt->requirement_id][] = $dt;
        }
        $ArrStd = [];
        foreach ($Data as $dtstd) {
            $ArrStd[$dtstd->requirement_id] = $dtstd;
        }

        $procedure         = $this->db->get_where('procedures', ['company_id' => $this->company, 'status !=' => 'DEL'])->result();

        $this->template->set([
            'Data'             => $Data,
            'ArrData'         => $ArrData,
            'ArrStd'         => $ArrStd,
            'procedure'     => $procedure,
        ]);

        $this->template->render('load_proses');
    }

    public function view_pasal($id = '')
    {
        $Data         = $this->db->get_where('requirement_details', ['id' => $id])->row();
        echo json_encode($Data);
    }

    public function edit($id)
    {
        $data        = $this->db->get_where('audit_checklist', ['id' => $id, 'status' => '1'])->row();
        $procedures  = $this->db->get_where('procedures', ['company_id' => $this->company, 'status !=' => 'DEL', 'deleted_at' => null])->result();

        $this->db->select('*')->from('view_cross_reference_details');
        $this->db->where("find_in_set($data->procedure_id, procedure_id)");
        $this->db->where("company_id", $this->company);
        $Cross = $this->db->get()->result();

        $ArrData = [];
        foreach ($Cross as $dt) {
            $ArrData['id'][$dt->requirement_id] = $dt->requirement_id;
            $ArrData['standards'][$dt->requirement_id][] = $dt;
        }
        $ArrStd = [];
        foreach ($Cross as $dtstd) {
            $ArrStd[$dtstd->requirement_id] = $dtstd;
        }

        /* Checklist */
        $checklist = $this->db->get_where('audit_checklist_details', ['checklist_id' => $id, 'status' => '1'])->result();

        $this->template->set([
            'data'       => $data,
            'Cross'      => $Cross,
            'ArrData'    => $ArrData,
            'ArrStd'     => $ArrStd,
            'procedures'  => $procedures,
            'checklist'  => $checklist,
        ]);

        $this->template->render('edit');
    }

    public function save()
    {
        $data       = $this->input->post();
        $checklist  = $data['checklist'];
        unset($data['checklist']);
        $this->db->trans_begin();
        if ($data) {
            if (isset($data['id']) && $data['id']) {
                $data['modified_at'] = date('Y-m-d H:i:s');
                $data['modified_by'] = $this->auth->user_id();
                $this->db->update('audit_checklist', $data, ['id' => $data['id']]);
            } else {
                $data['id']         = $this->_getId();
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $this->auth->user_id();
                $this->db->insert('audit_checklist', $data);
            }

            if ($checklist) {
                $dtlID = $this->_getDtlId($data['id']);
                foreach ($checklist as $ck) {
                    $dtlID++;
                    if (isset($ck['id']) && $ck['id']) {
                        $ck['modified_at'] = date('Y-m-d H:i:s');
                        $ck['modified_by'] = $this->auth->user_id();
                        $this->db->update('audit_checklist_details', $ck, ['id' => $ck['id']]);
                    } else {
                        $ck['id']         = $data['id'] . sprintf("%03d", $dtlID);
                        $ck['checklist_id'] = $data['id'];
                        $ck['created_at'] = date('Y-m-d H:i:s');
                        $ck['created_by'] = $this->auth->user_id();
                        $this->db->insert('audit_checklist_details', $ck);
                    }
                }
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return        = array(
                    'status'        => 0,
                    'msg'            => 'Data has Failed save. Please Try Again!'
                );
            } else {
                $this->db->trans_commit();
                $return        = array(
                    'status'        => 1,
                    'msg'            => 'Data has successfull saved. Thanks you.'
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

    function delete_checklist()
    {
        $id = $this->input->post('id');
        if ($id) {
            $this->db->trans_begin();
            $this->db->update('audit_checklist_details', ['status' => '0'], ['id' => $id]);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $Return = [
                    'msg'       => "Successfull delete data.",
                    'status'    => 0
                ];
            } else {
                $this->db->trans_commit();
                $Return = [
                    'msg'       => "Failed deleting data, please try again.",
                    'status'    => 1
                ];
            }
        } else {
            $this->db->trans_rollback();
            $Return = [
                'msg'       => "Data not valid",
                'status'    => 0
            ];
        }

        echo json_encode($Return);
    }

    function audit($id)
    {
        if ($id) {
            $cklst        = $this->db->get_where('view_audit_checklist', ['id' => $id, 'status' => '1'])->row();
            $users      = $this->db->get_where('view_users', ['company_id' => $this->company, 'status' => 'ACT'])->result();

            $procedures  = $this->db->get_where('procedures', ['company_id' => $this->company, 'status !=' => 'DEL', 'deleted_at' => null])->result();

            $query = $this->db->select('*')->from('view_cross_reference_details')
                ->where("find_in_set($cklst->procedure_id, procedure_id)")
                ->where("company_id", $this->company);
            $Cross = $query->get()->result();

            $ArrData = [];
            foreach ($Cross as $dt) {
                $ArrData['id'][$dt->requirement_id] = $dt->requirement_id;
                $ArrData['standards'][$dt->requirement_id][] = $dt;
            }
            $ArrStd = [];
            foreach ($Cross as $dtstd) {
                $ArrStd[$dtstd->requirement_id] = $dtstd;
            }

            /* Checklist */
            $checklist = $this->db->get_where('audit_checklist_details', ['checklist_id' => $id, 'status' => '1'])->result();

            /* Data Audit */

            // $audit = $this->db->get_where('audit_checklist_audit', ['checklist_id' => $id])->row();
            // if ($audit) {
            //     $details = $this->db->get_where('audit_checklist_audit_details', ['audit_id' => $audit->id])->result();
            //     $ArrDtl = [];
            //     if ($details) foreach ($details as $d) {
            //         $ArrDtl[$d->checklist_detail_id] = $d;
            //     }
            // }

            /* Satndard */
            $query = $this->db->select('*')->from('view_cross_reference_details')
                ->where("find_in_set($cklst->procedure_id, procedure_id)")
                ->where(["company_id" => $this->company]);
            $std = $query->get()->result();
            $ArrDtlStd = [];
            foreach ($std as $s) {
                $ArrDtlStd[$s->requirement_id][] = $s;
            }

            $this->template->set([
                'cklst'       => $cklst,
                'users'       => $users,
                'Cross'      => $Cross,
                'ArrData'    => $ArrData,
                'ArrStd'     => $ArrStd,
                'checklist'  => $checklist,
                'procedures'  => $procedures,
                // 'audit'     => $audit,
                // 'ArrDtl'  => $ArrDtl,
                // 'ArrDtlStd'  => $ArrDtlStd,
            ]);

            $this->template->render('audit');
        } else {
            show_404();
        }
    }

    function results()
    {
        $this->template->set('title', 'Audit Results');
        $results = $this->db->get_where('view_audit_checklist_audit', ['status' => '1'])->result();
        $details = $this->db->get_where('audit_checklist_audit_details', ['status' => '1'])->result();

        $ArrDtl = [];
        if ($details) foreach ($details as $k => $v) {
            $ArrDtl[$v->audit_id][] = $v;
        }

        $data = [
            "results" => $results,
            'ArrDtl' => $ArrDtl,
        ];

        $this->template->render('results', $data);
    }

    function edit_audit($id)
    {
        if ($id) {
            $audit    = $this->db->get_where('view_audit_checklist_audit', ['id' => $id, 'status' => '1'])->row();
            $cklst    = $this->db->get_where('view_audit_checklist', ['id' => $audit->checklist_id, 'status' => '1'])->row();
            $users    = $this->db->get_where('view_users', ['company_id' => $this->company, 'status' => 'ACT'])->result();

            $procedures  = $this->db->get_where('procedures', ['company_id' => $this->company, 'status !=' => 'DEL', 'deleted_at' => null])->result();
            $query = $this->db->select('*')->from('view_cross_reference_details')
                ->where("find_in_set($cklst->procedure_id, procedure_id)")
                ->where("company_id", $this->company);
            $Cross = $query->get()->result();

            $ArrData = [];
            foreach ($Cross as $dt) {
                $ArrData['id'][$dt->requirement_id] = $dt->requirement_id;
                $ArrData['standards'][$dt->requirement_id][] = $dt;
            }
            $ArrStd = [];
            foreach ($Cross as $dtstd) {
                $ArrStd[$dtstd->requirement_id] = $dtstd;
            }

            /* Checklist */
            $checklist = $this->db->get_where('audit_checklist_details', ['checklist_id' => $audit->checklist_id, 'status' => '1'])->result();

            /* Data Audit */
            // $audit = $this->db->get_where('audit_checklist_audit', ['checklist_id' => $id])->row();
            $details = $this->db->get_where('audit_checklist_audit_details', ['audit_id' => $audit->id])->result();
            $ArrDtl = [];

            if ($details) foreach ($details as $d) {
                $ArrDtl[$d->checklist_detail_id] = $d;
            }

            /* Satndard */
            $query = $this->db->select('*')->from('view_cross_reference_details')
                ->where("find_in_set($cklst->procedure_id, procedure_id)")
                ->where(["company_id" => $this->company]);
            $std = $query->get()->result();
            $ArrDtlStd = [];
            foreach ($std as $s) {
                $ArrDtlStd[$s->requirement_id][] = $s;
            }

            $this->template->set([
                'cklst'       => $cklst,
                'users'       => $users,
                'audit'     => $audit,
                'Cross'      => $Cross,
                'ArrData'    => $ArrData,
                'ArrStd'     => $ArrStd,
                'procedures'  => $procedures,
                'checklist'  => $checklist,
                'ArrDtl'  => $ArrDtl,
                'ArrDtlStd'  => $ArrDtlStd,
            ]);

            $this->template->render('audit');
        } else {
            show_404();
        }
    }

    function listPasal($procedure, $standard)
    {

        $this->db->select('*')->from('view_cross_reference_details');
        $this->db->where("find_in_set($procedure, procedure_id)");
        $this->db->where(["requirement_id" => $standard, "company_id" => $this->company]);
        $data = $this->db->get()->result();

        $html = '<option></option>';
        if ($data) {
            foreach ($data as $v) {
                $html .= "<option value='$v->id'>$v->chapter</option>";
            }
        }
        echo $html;
    }

    function saveAudit()
    {
        $data       = $this->input->post();
        $detail     = $data['detail'];
        unset($data['detail']);


        $data['auditor'] = json_encode($data['auditor']);
        $data['auditee'] = json_encode($data['auditee']);

        $this->db->trans_begin();
        if ($data) {
            if (isset($data['id']) && $data['id']) {
                $data['modified_at'] = date('Y-m-d H:i:s');
                $data['modified_by'] = $this->auth->user_id();
                $this->db->update('audit_checklist_audit', $data, ['id' => $data['id']]);
            } else {
                $data['id']         = $this->_getAuditId();
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['created_by'] = $this->auth->user_id();
                $this->db->insert('audit_checklist_audit', $data);
            }

            if ($detail) {
                $dtlID = $this->_getAuditDtlId($data['id']);
                foreach ($detail as $ck) {
                    $dtlID++;
                    if (isset($ck['id']) && $ck['id']) {
                        $ck['modified_at'] = date('Y-m-d H:i:s');
                        $ck['modified_by'] = $this->auth->user_id();
                        $this->db->update('audit_checklist_audit_details', $ck, ['id' => $ck['id']]);
                    } else {
                        $ck['id']         = $data['id'] . sprintf("%03d", $dtlID);
                        $ck['audit_id'] = $data['id'];
                        $ck['created_at'] = date('Y-m-d H:i:s');
                        $ck['created_by'] = $this->auth->user_id();
                        $this->db->insert('audit_checklist_audit_details', $ck);
                    }
                }
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return        = array(
                    'status'        => 0,
                    'msg'            => 'Data has Failed save. Please Try Again!'
                );
            } else {
                $this->db->trans_commit();
                $return        = array(
                    'status'        => 1,
                    'msg'            => 'Data has successfull saved. Thanks you.'
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

    function delete_audit()
    {
        $id = $this->input->post('id');
        if ($id) {
            $this->db->trans_begin();
            $this->db->update('audit_checklist_audit', ['status' => '0'], ['id' => $id]);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $Return = [
                    'msg'       => "Successfull delete data.",
                    'status'    => 0
                ];
            } else {
                $this->db->trans_commit();
                $Return = [
                    'msg'       => "Failed deleting data, please try again.",
                    'status'    => 1
                ];
            }
        } else {
            $this->db->trans_rollback();
            $Return = [
                'msg'       => "Data not valid",
                'status'    => 0
            ];
        }

        echo json_encode($Return);
    }

    function view_audit($id)
    {
        if ($id) {
            $audit    = $this->db->get_where('view_audit_checklist_audit', ['id' => $id, 'status' => '1'])->row();
            $cklst    = $this->db->get_where('view_audit_checklist', ['id' => $audit->checklist_id, 'status' => '1'])->row();
            $users    = $this->db->get_where('view_users', ['company_id' => $this->company, 'status' => 'ACT'])->result();

            // $procedures  = $this->db->get_where('procedures', ['company_id' => $this->company, 'status !=' => 'DEL', 'deleted_at' => null])->result();
            // $query = $this->db->select('*')->from('view_cross_reference_details')
            //     ->where("find_in_set($cklst->procedure_id, procedure_id)")
            //     ->where("company_id", $this->company);
            // $Cross = $query->get()->result();

            // $ArrData = [];
            // foreach ($Cross as $dt) {
            //     $ArrData['id'][$dt->requirement_id] = $dt->requirement_id;
            //     $ArrData['standards'][$dt->requirement_id][] = $dt;
            // }
            // $ArrStd = [];
            // foreach ($Cross as $dtstd) {
            //     $ArrStd[$dtstd->requirement_id] = $dtstd;
            // }

            /* Checklist */
            $checklist = $this->db->get_where('audit_checklist_details', ['checklist_id' => $audit->checklist_id, 'status' => '1'])->result();

            /* Data Audit */
            // $audit = $this->db->get_where('audit_checklist_audit', ['checklist_id' => $id])->row();
            $details = $this->db->get_where('audit_checklist_audit_details', ['audit_id' => $audit->id])->result();
            $ArrDtl = [];

            if ($details) foreach ($details as $d) {
                $ArrDtl[$d->checklist_detail_id] = $d;
            }

            /* Satndard */
            $standard = $this->db->get_where('requirements', ['company_id' => $this->company, 'status' => '1'])->result();
            $ArrStd = array_column(json_decode(json_encode($standard)), 'name', 'id');

            $procedures = $this->db->get_where('procedures', ['company_id' => $this->company, 'status !=' => 'DEL', 'deleted_at' => null])->result();
            $query = $this->db->select('*')->from('view_cross_reference_details')
                ->where("company_id", $this->company);
            $Cross = $query->get()->result();
            $ArrPro = array_column(json_decode(json_encode($Cross)), 'chapter', 'id');

            $category = [
                '0' => '<label class="label label-inline">OK</label>',
                '1' => '<label class="label label-inline label-warning">Minor</label>',
                '2' => '<label class="label label-inline labbel-danger">Major</label>',
                '3' => '<label class="label label-inline label-info">OFI</label>',
            ];

            $this->template->set([
                'cklst'         => $cklst,
                'users'         => $users,
                'audit'         => $audit,
                'ArrPro'        => $ArrPro,
                'ArrStd'        => $ArrStd,
                'ArrDtl'        => $ArrDtl,
                'checklist'     => $checklist,
                'category'      => $category,
            ]);

            $this->template->render('view');
        } else {
            show_404();
        }
    }
}
