<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Syamsudin
 * @copyright Copyright (c) 2021, Syamsudin
 *
 * This is controller for Perusahaan
 */

class Groups extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->template->set('title', 'Groups');
        $this->template->page_icon('fa fa-table');
        $this->load->library('Menu_generator');
        date_default_timezone_set("Asia/Bangkok");
    }

    public function index()
    {
        $data = $this->db->get_where('groups', ['company_id' => $this->company])->result();
        $this->template->set('results', $data);
        $this->template->render('index');
    }

    //Create New Customer
    public function create()
    {
        $this->template->render('add');
    }

    public function save()
    {
        $data = $this->input->post();

        $this->db->trans_begin();

        if (isset($data)) {
            foreach ($data['menus'] as $menus) {
                $check = $this->db->get_where('group_menus', ['id' => $menus['id']])->num_rows();
                $menus['read'] = isset($menus['read']) ? $menus['read'] : '0';
                $menus['create'] = isset($menus['create']) ? $menus['create'] : '0';
                $menus['update'] = isset($menus['update']) ? $menus['update'] : '0';
                $menus['delete'] = isset($menus['delete']) ? $menus['delete'] : '0';

                if ($check > 0) {
                    $this->db->update('group_menus', $menus, ['id' => $menus['id']]);
                } else {
                    $this->db->insert('group_menus', $menus);
                }
            }
            foreach ($data['submenus'] as $submenus) {
                $check = $this->db->get_where('group_menus', ['id' => $submenus['id']])->num_rows();
                $submenus['read'] = isset($submenus['read']) ? $submenus['read'] : '0';
                $submenus['create'] = isset($submenus['create']) ? $submenus['create'] : '0';
                $submenus['update'] = isset($submenus['update']) ? $submenus['update'] : '0';
                $submenus['delete'] = isset($submenus['delete']) ? $submenus['delete'] : '0';

                if ($check > 0) {
                    $this->db->update('group_menus', $submenus, ['id' => $submenus['id']]);
                } else {
                    $this->db->insert('group_menus', $submenus);
                }
            }



            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $Arr_Return        = array(
                    'status'        => 0,
                    'msg'         => 'Save Process Failed. Please Try Again...'
                );
            } else {
                $this->db->trans_commit();
                $Arr_Return        = array(
                    'status'       => 1,
                    'msg'        => 'Save Process Success... '
                );
            }
        } else {
            $Arr_Return         = array(
                'status'        => 0,
                'msg'           => 'Data not valid...'
            );
        }

        echo json_encode($Arr_Return);
    }

    public function update($data)
    {
        if ($data) {
            $this->db->trans_begin();
            $id = $data['id'];
            $data['id_group']  = $data['id'];
            $data['nm_group']  = $data['name'];
            $data['company_id']  = $this->company;
            unset($data['name']);
            unset($data['id']);
            $this->db->update("groups", $data, ['id_group' => $id]);
        }
        if ($this->db->trans_status() === FALSE) {
            $error = $this->db->error()['message'];
            $this->db->trans_rollback();
            $Arr_Return        = array(
                'status'        => 0,
                'msg'          => $error
            );
        } else {
            $this->db->trans_commit();
            $Arr_Return        = array(
                'status'       => 1,
                'msg'        => 'Save Process Success... '
            );
        }
        echo json_encode($Arr_Return);
    }

    //Edit Cabang
    public function edit($id)
    {
        if ($id) {
            $data = $this->db->get_where('groups', ['id_group' => $id])->row();
            $this->template->set('data', $data);
            $this->template->render('edit');
        } else {
            redirect('groups');
        }
    }


    public function permissions($id)
    {

        $group   = $this->db->get_where('groups', ['id_group' => $id])->row();
        // $menus = $this->db->order_by('menu_id', 'ASC')->get_where('view_group_menus', ['parent_id' => '0'])->result();
        // $submenus = $this->db->order_by('parent_id', 'ASC')->get_where('view_group_menus', ['parent_id !=' => '0'])->result();
        // $ArrSubmenu = [];
        // foreach ($submenus as $key => $sub) {
        //     $ArrSubmenu[$sub->parent_id][$key] = $sub;
        // }

        $this->template->set('group', $group);
        // $this->template->set('menus', $menus);
        // $this->template->set('submenus', $ArrSubmenu);
        $this->template->render('permission');
    }


    public function datamenu()
    {
        $Data    = $this->show_menus();
        echo '<pre>';
        print_r($Data);
        echo '<pre>';
        exit;

        $Data         = $this->db->get_where('menus', ['status' => '1'])->result();
        $ArrMenu    = [];
        foreach ($Data as $mnu) {
            $ArrMenu[$mnu->parent_id][] = $mnu;
        }
    }

    function menus($ArrFolder, $parent = '0')
    {


        // $result = ("SELECT a.id, a.label, a.link, Deriv1.Count FROM `menu` a  LEFT OUTER JOIN (SELECT parent, COUNT(*) AS Count FROM `menu` GROUP BY parent) Deriv1 ON a.id = Deriv1.parent WHERE a.parent=" . $parent);
        $cek_company = '';
        $html = "<ul class='h6 text-dark'>";
        foreach ($ArrFolder[$parent] as $val) {
            if (isset($ArrFolder[$val->id])) {

                $html .= "<li class='h6 py-1 " . $cek_company . "'><a href='" . $val->link . "' data-id='" . $val->id . "' data-parent_id='" . $val->parent_id . "' class='tree-folder'>" . $val->name . "</a>";
                $html .= $this->menus($ArrFolder, $val->id);
                $html .= "</li>";
            } else {
                $html .= "<li class='h6 py-1 " . $cek_company . "'><a href='" . $val->link . "' data-id='" . $val->id . "' data-parent_id='" . $val->parent_id . "' class='tree-folder'>" . $val->name . "</a></li>";
            }
        }

        $html .= "</ul>";
        return $html;
    }
}
