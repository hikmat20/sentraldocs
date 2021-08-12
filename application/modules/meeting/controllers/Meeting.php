<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Yunaz
 * @copyright Copyright (c) 2018, Yunaz
 *
 * This is controller for Customer
 */

class Meeting extends Admin_Controller {

    //Permission
    protected $viewPermission   = "Meeting.View";
    protected $addPermission    = "Meeting.Add";
    protected $managePermission = "Meeting.Manage";
    protected $deletePermission = "Meeting.Delete";
	protected $approvalPermission = "Meeting.Approval";

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('Mpdf','upload','Image_lib'));
        $this->load->model(array('Meeting/Meeting_model',
                                 'Aktifitas/aktifitas_model'
                                ));
								
        $this->template->title('Manage Data Customer');
        $this->template->page_icon('fa fa-table');

        date_default_timezone_set("Asia/Bangkok");
    }

    public function index()
    {
        $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        // $where       = array(			
						// 'id_dokter'=>$session['id_dokter'],
					// );
		$where      ='';
					   
        $data = $this->Meeting_model->get_data('tbl_meeting');
        $this->template->set('results', $data);
        $this->template->title('Index Of Meeting');
        $this->template->render('index');
		
    }
	
	public function add(){
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-list');
		        
        $this->template->title('Create Meeting ');
        $this->template->render('create_meeting');
		
	}
	
	public function addsubject(){
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->render('create_subject');
		
	}
	
	public function saveSubject(){
		$this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');
		
		$post = $this->input->post();
		$birthdate = $this->input->post('nm_subject');
		$tgl = date("Y-m-d H:i:s");
		
		$this->db->trans_begin();
		$data = [
			'subject'		    => $post['nm_subject'],
			'created_on'			=> date('Y-m-d H:i:s'),
			'created_by'		=> $this->auth->user_id()
			
		];
		
		$insert = $this->db->insert("ms_subject",$data);
		
		 if($this->db->trans_status() === FALSE){
			 $this->db->trans_rollback();
			 $Arr_Return		= array(
					'status'		=> 2,
					'pesan'			=> 'Save Process Failed. Please Try Again...'
			   );
		}else{
			 $this->db->trans_commit();
			 $Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. '
		   );
		}
		echo json_encode($Arr_Return);
		
	}
	
	
	function getsubject()
    {
        $subject	= $this->db->query("SELECT * FROM ms_subject")->result();
		echo "<select id='subject' name='subject' class='form-control input-sm select2'>
				<option value=''>Pilih Subject</option>";
				foreach($subject as $sj){
		echo "<option value='$sj->subject'>$sj->subject</option>";
				}
		echo "</select>";
	}
	
	
	
	public function addsubsubject(){
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->render('create_subsubject'); 
		
	}
	
	
	public function saveSubsubject(){
		$this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');
		
		$post = $this->input->post();
		$birthdate = $this->input->post('nm_subsubject');
		$tgl = date("Y-m-d H:i:s");
		
		$this->db->trans_begin();
		$data = [
			'sub_subject'	    => $post['nm_subsubject'],
			'created_on'	    => date('Y-m-d H:i:s'),
			'created_by'		=> $this->auth->user_id()
			
		];
		
		$insert = $this->db->insert("ms_subsubject",$data);
		
		 if($this->db->trans_status() === FALSE){
			 $this->db->trans_rollback();
			 $Arr_Return		= array(
					'status'		=> 2,
					'pesan'			=> 'Save Process Failed. Please Try Again...'
			   );
		}else{
			 $this->db->trans_commit();
			 $Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. '
		   );
		}
		echo json_encode($Arr_Return);
		
	}
	
	
	function getsubsubject()
    {
        $subsubject	= $this->db->query("SELECT * FROM ms_subsubject")->result();
		echo "<select id='subsubject' name='subsubject' class='form-control input-sm select2'>
				<option value=''>Pilih Sub Subject</option>";
				foreach($subsubject as $sbj){
		echo "<option value='$sbj->sub_subject'>$sbj->sub_subject</option>";
				}
		echo "</select>";
	}
	
	
	public function saveMeeting(){
		$this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');
		
		$post = $this->input->post();
		// print_r($post);
		// exit;
		$kode = $this->Meeting_model->generate_id();
		
		
		$this->db->trans_begin();
		$data = [
		    'kd_meeting'	    => $kode,
			'tgl_meeting'	    => date('Y-m-d H:i:s'),
			'subject'	        => $post['subject'],
			'sub_subject'	    => $post['subsubject'],
			'description'	    => $post['deskripsi'],
			'created_on'	    => date('Y-m-d H:i:s'),
			'created_by'		=> $this->auth->user_id()
			
		];
		
		$insert = $this->db->insert("tbl_meeting",$data);
		
		 if($this->db->trans_status() === FALSE){
			 $this->db->trans_rollback();
			 $Arr_Return		= array(
					'status'		=> 2,
					'pesan'			=> 'Save Process Failed. Please Try Again...'
			   );
		}else{
			 $this->db->trans_commit();
			 $Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. ',
				'kode'			=> $kode
		   );
		}
		echo json_encode($Arr_Return);
		
	}
	
	
	public function detail(){
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		
		$kd_meeting = $this->uri->segment('3');
		
		$this->template->page_icon('fa fa-list');
		$header = $this->db->query("SELECT * FROM tbl_meeting WHERE kd_meeting ='$kd_meeting'")->row();        
		$data = [
			'header' => $header
		];
        $this->template->set('results', $data);
        $this->template->title('Create Detail Meeting');
        $this->template->render('create_detail');
		
	}
	
	
	function get_pic()
    {
        $users	= $this->db->query("SELECT * FROM users WHERE nm_lengkap != 'Administrator'")->result();
		echo "<select id='pic' name='pic' class='form-control input-sm select2'>
				<option value=''>Pilih Pic</option>";
				foreach($users as $pic){
		echo "<option value='$pic->id_user'>$pic->nm_lengkap</option>";
				}
		echo "</select>";
	}
	
	
	public function saveDetailmeeting(){
		$this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');
		
		$post = $this->input->post();
		
		$postpic = $this->input->post('pic');
		$pic = $this->db->query("SELECT  nm_lengkap FROM users WHERE id_user='$postpic'")->row();
		$date_duedate=date_create($this->input->post('due_date'));
	   
		$tgl = date_format($date_duedate ,"Y-m-d");
		
		//print_r($tgl);
		//exit;
		
		
		$this->db->trans_begin();
		$data = [
		    'kd_meeting'	    => $post['kd_meeting'],
			'tgl_detail'	    => date('Y-m-d'),
			'problem'	        => $post['problem'],
			'action_plan'	    => $post['action_plan'],
			'pic'	            => $post['pic'],
			'nama_pic'	        => $pic->nm_lengkap,
			'due_date'          => $tgl,
			'created_on'	    => date('Y-m-d H:i:s'),
			'created_by'		=> $this->auth->user_id()
			
		];
		
		$insert = $this->db->insert("tbl_meeting_detail",$data);
		
		 if($this->db->trans_status() === FALSE){
			 $this->db->trans_rollback();
			 $Arr_Return		= array(
					'status'		=> 2,
					'pesan'			=> 'Save Process Failed. Please Try Again...'
			   );
		}else{
			 $this->db->trans_commit();
			 $Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. ',
				'kode'			=> $post['kd_meeting']
		   );
		}
		echo json_encode($Arr_Return);
		
	}
	
	
	public function load_detail()
    {
        $kd_meeting	= $_POST['cari'];
        $session = $this->session->userdata('app_session');
        $divisi  = $session['id_div']; 
        $where   =array('kd_meeting'=> $kd_meeting );
        $numb = 1;
        $data = $this->Meeting_model->get_data_where('tbl_meeting_detail',$where);   
		
		// print_r ($data);
		// exit;
        if($data != 0){
		
		echo "<table id='example1' class='table table-bordered table-striped'>
		<tr>
			<td align='center'><b>No </td>
			<td align='center'><b>Tgl </td>
			<td align='left' width='20%' ><b>Problem</td>
			<td align='left' width='20%'><b>Action Plan</td>
			<td align='left' width='20%' ><b>PIC</td>
			<td align='left'  width='10%' ><b>Due Date</td>
			<td align='center'><b>Aksi</td>
		</tr>";	
	    $n=0;
		foreach ($data as $d) {     
		$n++;
		$date_detail=date_create($d->tgl_detail);
		$tgl = date_format($date_detail,'d-m-Y');
		
		$date_duedate=date_create($d->due_date);
	    $due_date = date_format($date_duedate,'d-m-Y');
    	echo "<tr class='view$n'>
				<td align='center'>$n</td>
				<td align='center'>$tgl</td>
				<td align='left'>$d->problem
				</td>
				<td align='left'>$d->action_plan</td>
				<td align='left'>$d->nama_pic</td>
				<td align='left'>$due_date</td>";
				
			if(date('Y-m-d') == date('Y-m-d'))
            {	
     	      echo "<td align='center'><button type='button' onclick='edit($n)' class='btn btn-sm btn-primary'><i class='fa fa-pencil'></i></button>	
				</td>";
		    }
			
		  echo "</tr>";
		  
		 
		
		  echo "
		        <tr hidden class='edit$n'>
				<td align='center'>$n</td>
				<td align='center'>$tgl
				<input type='hidden' class='form-control tanggal' id='no' name='no' placeholder='No' value='$n'>
				<input type='hidden' class='form-control tanggal' id='id$n' name='id$n' placeholder='Due Date' value='$d->id_detail'>
				<input type='hidden' class='form-control tanggal' id='kode$n' name='kode$n' placeholder='No' value='$d->kd_meeting'>
				</td>
				<td align='left'>
				<textarea name='problem$n' class='form-control input-sm' id='problem$n' cols=35  rows=1  placeholder='Problem'>$d->problem</textarea>
				</td>
				<td align='left'><textarea name='action_plan$n' class='form-control input-sm' id='action_plan$n' height=100  width=400  placeholder='Action Plan' cols=35  rows=1>$d->action_plan</textarea>
				</td>
				
				<td align='left'>				 
		        <select id='pic$n' name='pic$n' class='form-control input-sm select2'>";				
				$users	= $this->db->query("SELECT * FROM users WHERE nm_lengkap != 'Administrator'")->result();
		        foreach($users as $pic){
				$dbpic = $d->pic;
				$picselect = $pic->id_user;
				if ($dbpic==$picselect){
					echo "<option value=$pic->id_user selected>$pic->nm_lengkap</option>";}
				else{
					echo "<option value=$pic->id_user>$pic->nm_lengkap</option>";}
				}
		   
			echo"
		        </select>
				</td>
				<td align='left'>
				<input type='text' class='form-control tanggal2' id='due_date$n' name='due_date$n' placeholder='Due Date' value='$due_date'>
				</td>";
				
			if(date('Y-m-d') == date('Y-m-d'))
            {	
     	      echo "<td align='center'><button type='button' onclick='update($n)' class='btn btn-sm btn-success'><i class='fa fa-check'></i></button>	
				</td>";
		    }
			
		   echo "</tr>
		  
		   ";
		   
		}
		
		echo "</table>";
		
        }
        else
        {
        echo"Belum Ada Transaksi";
        }
		
	}
	
	
	
		
		
	public function updateDetailmeeting(){
		$this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');
		$no = $this->uri->segment('3');
		// $post ='problem'.$no;
		$post = $this->input->post();
		$postpic = $this->input->post('pic'.$no);
		
		
		$pic = $this->db->query("SELECT  nm_lengkap FROM users WHERE id_user='$postpic'")->row();
		$date_duedate=date_create($this->input->post('due_date'.$no));
	   
		$tgl = date_format($date_duedate ,"Y-m-d");
		
		
		
		
		$this->db->trans_begin();
		$data_update = array(
							'kd_meeting'	    => $post['kode'.$no],
							'problem'	        => $post['problem'.$no],
							'action_plan'	    => $post['action_plan'.$no],
							'pic'	            => $post['pic'.$no],
							'nama_pic'	        => $pic->nm_lengkap,
							'due_date'          => $tgl,
							'modified_on'	    => date('Y-m-d H:i:s'),
							'modified_by'		=> $this->auth->user_id()
							);
							
		$where      = array(			
						'id_detail'=>$this->input->post('id'.$no),						
					   );

		$this->Meeting_model->getUpdate('tbl_meeting_detail',$data_update,$where);
		
		 if($this->db->trans_status() === FALSE){
			 $this->db->trans_rollback();
			 $Arr_Return		= array(
					'status'		=> 2,
					'pesan'			=> 'Save Process Failed. Please Try Again...'
			   );
		}else{
			 $this->db->trans_commit();
			 $Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. ',
				'kode'			=> $post['kode'.$no]
		   );
		}
		echo json_encode($Arr_Return);
		
	}
	
	
	
	 public function listmom() {
        $this->auth->restrict($this->viewPermission);
        $this->template->page_icon('fa fa-list');
        $status_payment = 'all';
        $this->template->set('status_payment', $status_payment);
        $this->template->title('Indeks Of MoM');
        $this->template->render('list_mom.php');
    }
	
	public function listmom_open() {
        $this->auth->restrict($this->viewPermission);
        $this->template->page_icon('fa fa-list');
        $status_payment = '0';
        $this->template->set('status_payment', $status_payment);
        $this->template->title('Indeks Of MoM');
        $this->template->render('list_mom.php');
    }
	
	public function listmom_done() {
        $this->auth->restrict($this->viewPermission);
        $this->template->page_icon('fa fa-list');
        $status_payment = '1';
        $this->template->set('status_payment', $status_payment);
        $this->template->title('Indeks Of MoM');
        $this->template->render('list_mom.php');
    }
	
	public function listmom_close() {
        $this->auth->restrict($this->viewPermission);
        $this->template->page_icon('fa fa-list');
        $status_payment = '2';
        $this->template->set('status_payment', $status_payment);
        $this->template->title('Indeks Of MoM');
        $this->template->render('list_mom.php');
    }
	
	public function listmom_late() {
        $this->auth->restrict($this->viewPermission);
        $this->template->page_icon('fa fa-list');
        $status_payment = 'late';
        $this->template->set('status_payment', $status_payment);
        $this->template->title('Indeks Of MoM');
        $this->template->render('list_mom.php');
    }
	
	public function getDataJSON() {
		
		$ENABLE_ADD     = has_permission('Meeting.Add');
		$ENABLE_MANAGE  = has_permission('Meeting.Manage');
		$ENABLE_VIEW    = has_permission('Meeting.View');
		$ENABLE_DELETE  = has_permission('Meeting.Delete');
		$ENABLE_APPROVE  = has_permission('Meeting.Approval');
	
        $requestData = $_REQUEST;
		// print_r($requestData);
		// exit;
		$statusdata = array();
		$statusdata['status'] = $requestData['status'];
		$statusdata['status_payment'] = $requestData['status_payment'];
        $fetch = $this->queryDataJSON($statusdata, $requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
        $totalData = $fetch['totalData'];
        $totalFiltered = $fetch['totalFiltered'];
        $query = $fetch['query'];
        $data = array();
        $urut1 = 1;
        $urut2 = 0;
        foreach ($query->result_array() as $row) {
            $total_data = $totalData;
            $start_dari = $requestData['start'];
            $asc_desc = $requestData['order'][0]['dir'];
            if ($asc_desc == 'asc') {
                $nomor = $urut1 + $start_dari;
            }
            if ($asc_desc == 'desc') {
                $nomor = ($total_data - $start_dari) - $urut2;
            }
			
			//due_date
			//done_date
			if($row['done_date'] !=NULL){			
			$tgl2 = new DateTime($row['done_date']);			
			}
			elseif($row['done_date'] ==NULL || $row['done_date']=='0000-00-00'){
			$tgl2 = new DateTime(date('Y-m-d'));		
			}
			
			
			$tgl1 = new DateTime($row['due_date']);
			$d = $tgl2->diff($tgl1)->days;
			
			if($row['done_date'] <= $row['due_date']){
			$selesai = $d*-1;			
			}
			else{
			$selesai = $d;	
			}
	
			
             $done =$row['done_date'];
			
			 if ($selesai>0) {
                $tipe = '<span class="badge bg-teal">Terlambat</span>';
            } elseif ($selesai<=0 && $done!=0000-00-00) {
                $tipe = '<span class="badge bg-teal">On Time</span>';
			} elseif ($selesai<=0 && $done ==0000-00-00) {
                $tipe = '<span class="badge bg-teal">Belum Dikerjakan</span>';
		    }	
		
                        
            $nestedData = array();
            $detail = "";
            $nestedData[] = "<div align='center'>" . $nomor . "</div>";
            $nestedData[] = "<div align='left'>" . $row['tgl_detail']. "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['subject']). "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['sub_subject']) . "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['problem']) . "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['action_plan']) . "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['nama_pic']) . "</div>";
            $nestedData[] = "<div align='left'>" . $row['due_date'] . "</div>";
			$nestedData[] = "<div align='left'>" . $row['done_date'] . "</div>";
            $nestedData[] = "<div align='center'>" . $tipe. "</div>";
            
				if($row['status']==0){
					if ($ENABLE_MANAGE){
					$nestedData[] = "
					  <a class='selesai btn btn-xs btn-success' href='javascript:void(0)' title='Selesai' data-id='" . $row['id_detail'] . "' data-kd_meeting='" . $row['kd_meeting'] . "'>UPDATE SELESAI</a>
					  ";
					}
				}
			    elseif($row['status']==1){
					if ($ENABLE_APPROVE){
							$nestedData[] = "<a class='done btn btn-xs btn-success' href='javascript:void(0)' title='Close' data-id='" . $row['id_detail'] . "' data-kd_meeting='" . $row['kd_meeting'] . "'>APPROVE</a>
							  ";					

				   }
				   else{
							$nestedData[]="<a class='btn btn-xs btn-warning'>PROSES APPROVAL</a>";
					}
				   
				} elseif($row['status']==2){
					$nestedData[]="<a class='btn btn-xs btn-success'>CLOSE</a>";
				}
            
			
			
				
            
            $data[] = $nestedData;
            $urut1++;
            $urut2++;
        }
        $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data);
        echo json_encode($json_data);
    }
	
	  public function queryDataJSON($type, $like_value = NULL, $column_order = '', $column_dir = NULL, $limit_start = NULL, $limit_length = NULL) {
		  
		  $session = $this->session->userdata('app_session');
          $user  = $session['nm_lengkap']; 
		  
		  if($user !='Administrator'){
		  $and   = 'AND';
		  $where = 'a.nama_pic ='.$user.$and;
		  }
		  else{
		  $where ='';
		  }
//        
       if($user !='Administrator'){
            $sql = "SELECT a.*, b.subject, b.sub_subject, b.description FROM tbl_meeting_detail a
			INNER JOIN tbl_meeting b ON b.kd_meeting=a.kd_meeting
			WHERE
			a.nama_pic ='$user' AND
		    (
			a.tgl_detail LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			a.problem LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			a.action_plan LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			b.subject LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			b.sub_subject LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			
			)";
       }
	   else{
		$sql = "SELECT a.*, b.subject, b.sub_subject, b.description FROM tbl_meeting_detail a
			INNER JOIN tbl_meeting b ON b.kd_meeting=a.kd_meeting
			WHERE
		    (
			a.tgl_detail LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			a.problem LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			a.action_plan LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			b.subject LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			b.sub_subject LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			
			)";	
	   }
	   
        // if ($type['status'] == 'NP') {
            // $sql = "SELECT a.*, a.id as id_term, b.name_customer, b.id_mso, b.nama_karyawan, b.nomor, b.no_po, b.grand_total_quotation grand_total FROM quotation_payment_term a
			// LEFT JOIN view_quotation_non_proses b ON b.id_quotation=a.id_quotation
			// WHERE a.flag_payment = 'Y'  AND a.type='NP' AND a.status_payment='".$type['status_payment']."'  and
			// (
			// a.id_quotation LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			// OR
			// a.requirement LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			// OR
			// b.name_customer LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			// OR
			// b.nama_karyawan LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			// OR
			// b.nomor LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			// OR
			// b.no_po LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			// )
			// ";
        // }
//			AND ((a.inv_status='0' AND a.payment_type <>'TR-02') OR (b.persentase_progress<>'100' AND a.payment_type ='TR-02'))
        $data['totalData'] = $this->db->query($sql)->num_rows();
        $data['totalFiltered'] = $this->db->query($sql)->num_rows();
        $columns_order_by = array(0 => 'id', 1 => 'tgl_detail', 2 => 'kd_meeting', 3 => 'subject', 4 => 'sub_subject');
        if($column_order!='') $sql.= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . " ";
        $sql.= " LIMIT " . $limit_start . " ," . $limit_length . " ";
        $data['query'] = $this->db->query($sql);
        return $data;
    }
	
	
	public function selesai() {
		
        $id = $this->input->post('id');
        $kode = $this->input->post('kode');	
 
            $due = $this->db->query("SELECT a.* FROM tbl_meeting_detail a WHERE id_detail=$id")->row();     
			$tgl2 = new DateTime(date('Y-m-d'));		
			$tgl1 = new DateTime($due->due_date);
			$d = $tgl2->diff($tgl1)->days;
			
			if(date('Y-m-d') <= $due->due_date){
			$selesai = $d*-1;			
			}
			else{
			$selesai = $d;	
			}
	
			
            if ($selesai>0) {
                $tipe = 'Terlambat';
            } elseif ($selesai<=0) {
                $tipe = 'On Time';
			} 
		    	
		
		$this->db->trans_begin();
		$data_update = array(
							'done_date'         => date('Y-m-d'),
							'status'            => 1,
							'keterangan'        => $tipe,
							'modified_on'	    => date('Y-m-d H:i:s'),
							'modified_by'		=> $this->auth->user_id()
							);
							
		$where      = array(			
						'id_detail'=>$this->input->post('id'),						
					   );

		$this->Meeting_model->getUpdate('tbl_meeting_detail',$data_update,$where);
		
		 if($this->db->trans_status() === FALSE){
			 $this->db->trans_rollback();
			 $Arr_Return		= array(
					'status'		=> 2,
					'pesan'			=> 'Save Process Failed. Please Try Again...'
			   );
		}else{
			 $this->db->trans_commit();
			 $Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. ',
				'kode'			=> $kode
		   );
		}
		echo json_encode($Arr_Return);
		
	}
	
	public function approval(){
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		
		$id    = $this->input->post('id');
		
		$this->template->set('id',$id);
		$this->template->render('create_approval'); 
		
	}
	
	public function saveApproval() {
		
        
        $status = $this->input->post('status');	
		$id = $this->input->post('id');	
		
		// print_r($id);
		// exit;
        
		$this->db->trans_begin();
		
		if ($status=='selesai'){
		$data_update = array(
							'progress_date'     => date('Y-m-d'),
							'status'            => 2,
							'approval_on'	    => date('Y-m-d H:i:s'),
							'approval_by'		=> $this->auth->user_id()
							);
		$where      = array(			
						'id_detail'=>$this->input->post('id'),						
					   );
		$this->Meeting_model->getUpdate('tbl_meeting_detail',$data_update,$where);
		}
		elseif ($status=='belumselesai'){
		$data_update = array(
							'done_date'         => '',
							'keterangan'        => '',
							'status'            => 0,
							'approval_on'	    => date('Y-m-d H:i:s'),
							'approval_by'		=> $this->auth->user_id()
							);	
		$where      = array(			
						'id_detail'=>$this->input->post('id'),						
					   );
					   
		$this->Meeting_model->getUpdate('tbl_meeting_detail',$data_update,$where);
		}
							
	

		
		
		 if($this->db->trans_status() === FALSE){
			 $this->db->trans_rollback();
			 $Arr_Return		= array(
					'status'		=> 2,
					'pesan'			=> 'Save Process Failed. Please Try Again...'
			   );
		}else{
			 $this->db->trans_commit();
			 $Arr_Return		= array(
				'status'		=> 1,
				'pesan'			=> 'Save Process Success. ',
				'kode'			=> $kode
		   );
		}
		echo json_encode($Arr_Return);
		
	}
	
	public function getDataJSONfilter() {
		
		$ENABLE_ADD     = has_permission('Meeting.Add');
		$ENABLE_MANAGE  = has_permission('Meeting.Manage');
		$ENABLE_VIEW    = has_permission('Meeting.View');
		$ENABLE_DELETE  = has_permission('Meeting.Delete');
		$ENABLE_APPROVE  = has_permission('Meeting.Approval');
	
        $requestData = $_REQUEST;
		// print_r($requestData);
		// exit;
		$statusdata = array();
		$statusdata['status'] = $requestData['status'];
		$statusdata['status_payment'] = $requestData['status_payment'];
		$statusdata['tampil'] = $requestData['filter'];
        $fetch = $this->queryDataJSONfilter($statusdata, $requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
        $totalData = $fetch['totalData'];
        $totalFiltered = $fetch['totalFiltered'];
        $query = $fetch['query'];
        $data = array();
        $urut1 = 1;
        $urut2 = 0;
        foreach ($query->result_array() as $row) {
            $total_data = $totalData;
            $start_dari = $requestData['start'];
            $asc_desc = $requestData['order'][0]['dir'];
            if ($asc_desc == 'asc') {
                $nomor = $urut1 + $start_dari;
            }
            if ($asc_desc == 'desc') {
                $nomor = ($total_data - $start_dari) - $urut2;
            }
			
			//due_date
			//done_date
			if($row['done_date'] !=NULL){			
			$tgl2 = new DateTime($row['done_date']);			
			}
			elseif($row['done_date'] ==NULL || $row['done_date']=='0000-00-00'){
			$tgl2 = new DateTime(date('Y-m-d'));		
			}
			
			
			$tgl1 = new DateTime($row['due_date']);
			$d = $tgl2->diff($tgl1)->days;
			
			if($row['done_date'] <= $row['due_date']){
			$selesai = $d*-1;			
			}
			else{
			$selesai = $d;	
			}
			
			$done =$row['done_date'];
			
			 if ($selesai>0) {
                $tipe = '<span class="badge bg-teal">Terlambat</span>';
            } elseif ($selesai<=0 && $done!=0000-00-00) {
                $tipe = '<span class="badge bg-teal">On Time</span>';
			} elseif ($selesai<=0 && $done ==0000-00-00) {
                $tipe = '<span class="badge bg-teal">Belum Dikerjakan</span>';
		    }	
	
			
            // if ($selesai>0) {
                // $tipe = '<span class="badge bg-teal">Terlambat</span>';
            // } elseif ($selesai<=0 && $done !=(NULL)) {
                // $tipe = '<span class="badge bg-teal">On Time</span>';
			// } elseif ($selesai<=0 && $done !='0000-00-00') {
                // $tipe = '<span class="badge bg-teal">On Time</span>';
			// } elseif ($selesai<=0 && $done ==(NULL) ) {
                // $tipe = '<span class="badge bg-teal">Belum Dikerjakan</span>';	
			// } elseif ($selesai<=0 && $done =='0000-00-00') {
                // $tipe = '<span class="badge bg-teal">Belum Dikerjakan</span>';
		    // }	
		
                        
            $nestedData = array();
            $detail = "";
            $nestedData[] = "<div align='center'>" . $nomor . "</div>";
            $nestedData[] = "<div align='left'>" . $row['tgl_detail']. "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['subject']). "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['sub_subject']) . "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['problem']) . "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['action_plan']) . "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['nama_pic']) . "</div>";
            $nestedData[] = "<div align='left'>" . $row['due_date'] . "</div>";
			$nestedData[] = "<div align='left'>" . $row['done_date'] . "</div>";
            $nestedData[] = "<div align='center'>" . $tipe. "</div>";
            
				if($row['status']==0){
					if ($ENABLE_MANAGE){
					$nestedData[] = "
					  <a class='selesai btn btn-xs btn-success' href='javascript:void(0)' title='Selesai' data-id='" . $row['id_detail'] . "' data-kd_meeting='" . $row['kd_meeting'] . "'>UPDATE SELESAI</a>
					  ";
					}
				}
			    elseif($row['status']==1){
					if ($ENABLE_APPROVE){
							$nestedData[] = "<a class='done btn btn-xs btn-success' href='javascript:void(0)' title='Close' data-id='" . $row['id_detail'] . "' data-kd_meeting='" . $row['kd_meeting'] . "'>APPROVE</a>
							  ";					

				   }
				   else{
							$nestedData[]="<a class='btn btn-xs btn-warning'>PROSES APPROVAL</a>";
					}
				   
				} elseif($row['status']==2){
					$nestedData[]="<a class='btn btn-xs btn-success'>CLOSE</a>";
				}
            
			
			
				
            
            $data[] = $nestedData;
            $urut1++;
            $urut2++;
        }
        $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data);
        echo json_encode($json_data);
    }
	
	  public function queryDataJSONfilter($type, $like_value = NULL, $column_order = '', $column_dir = NULL, $limit_start = NULL, $limit_length = NULL) {
		  
		  $session = $this->session->userdata('app_session');
          $user  = $session['nm_lengkap']; 
		  
		  if($user !='Administrator'){
		  $and   = 'AND';
		  $where = 'a.nama_pic ='.$user.$and;
		  }
		  else{
		  $where ='';
		  }
        
       if($user !='Administrator'){
            $sql = "SELECT a.*, b.subject, b.sub_subject, b.description FROM tbl_meeting_detail a
			INNER JOIN tbl_meeting b ON b.kd_meeting=a.kd_meeting
			WHERE
			a.nama_pic ='$user' AND a.status='".$type['tampil']."' AND 
		    (
			a.tgl_detail LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			a.problem LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			a.action_plan LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			b.subject LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			b.sub_subject LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			
			)";
       }
	   else{
		$sql = "SELECT a.*, b.subject, b.sub_subject, b.description FROM tbl_meeting_detail a
			INNER JOIN tbl_meeting b ON b.kd_meeting=a.kd_meeting
			WHERE
			 a.status='".$type['tampil']."' AND 
		    (
			a.tgl_detail LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			a.problem LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			a.action_plan LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			b.subject LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			b.sub_subject LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			
			)";	
	   }
	   
        $data['totalData'] = $this->db->query($sql)->num_rows();
        $data['totalFiltered'] = $this->db->query($sql)->num_rows();
        $columns_order_by = array(0 => 'id', 1 => 'tgl_detail', 2 => 'kd_meeting', 3 => 'subject', 4 => 'sub_subject');
        if($column_order!='') $sql.= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . " ";
        $sql.= " LIMIT " . $limit_start . " ," . $limit_length . " ";
        $data['query'] = $this->db->query($sql);
        return $data;
    }
	
	
	public function getDataJSONlate() {
		
		$ENABLE_ADD     = has_permission('Meeting.Add');
		$ENABLE_MANAGE  = has_permission('Meeting.Manage');
		$ENABLE_VIEW    = has_permission('Meeting.View');
		$ENABLE_DELETE  = has_permission('Meeting.Delete');
		$ENABLE_APPROVE  = has_permission('Meeting.Approval');
	
        $requestData = $_REQUEST;
		// print_r($requestData);
		// exit;
		$statusdata = array();
		$statusdata['status'] = $requestData['status'];
		$statusdata['status_payment'] = $requestData['status_payment'];
		$statusdata['tampil'] = $requestData['filter'];
        $fetch = $this->queryDataJSONlate($statusdata, $requestData['search']['value'], $requestData['order'][0]['column'], $requestData['order'][0]['dir'], $requestData['start'], $requestData['length']);
        $totalData = $fetch['totalData'];
        $totalFiltered = $fetch['totalFiltered'];
        $query = $fetch['query'];
        $data = array();
        $urut1 = 1;
        $urut2 = 0;
        foreach ($query->result_array() as $row) {
            $total_data = $totalData;
            $start_dari = $requestData['start'];
            $asc_desc = $requestData['order'][0]['dir'];
            if ($asc_desc == 'asc') {
                $nomor = $urut1 + $start_dari;
            }
            if ($asc_desc == 'desc') {
                $nomor = ($total_data - $start_dari) - $urut2;
            }
			
			//due_date
			//done_date
			if($row['done_date'] !=NULL){			
			$tgl2 = new DateTime($row['done_date']);			
			}
			elseif($row['done_date'] ==NULL || $row['done_date']=='0000-00-00'){
			$tgl2 = new DateTime(date('Y-m-d'));		
			}
			
			
			$tgl1 = new DateTime($row['due_date']);
			$d = $tgl2->diff($tgl1)->days;
			
			if($row['done_date'] <= $row['due_date']){
			$selesai = $d*-1;			
			}
			else{
			$selesai = $d;	
			}
			
			$done =$row['done_date'];
			
			 if ($selesai>0) {
                $tipe = '<span class="badge bg-teal">Terlambat</span>';
            } elseif ($selesai<=0 && $done!=0000-00-00) {
                $tipe = '<span class="badge bg-teal">On Time</span>';
			} elseif ($selesai<=0 && $done ==0000-00-00) {
                $tipe = '<span class="badge bg-teal">Belum Dikerjakan</span>';
		    }	
	
			
            // if ($selesai>0) {
                // $tipe = '<span class="badge bg-teal">Terlambat</span>';
            // } elseif ($selesai<=0 && $done !=(NULL)) {
                // $tipe = '<span class="badge bg-teal">On Time</span>';
			// } elseif ($selesai<=0 && $done !='0000-00-00') {
                // $tipe = '<span class="badge bg-teal">On Time</span>';
			// } elseif ($selesai<=0 && $done ==(NULL) ) {
                // $tipe = '<span class="badge bg-teal">Belum Dikerjakan</span>';	
			// } elseif ($selesai<=0 && $done =='0000-00-00') {
                // $tipe = '<span class="badge bg-teal">Belum Dikerjakan</span>';
		    // }	
		
                        
            $nestedData = array();
            $detail = "";
            $nestedData[] = "<div align='center'>" . $nomor . "</div>";
            $nestedData[] = "<div align='left'>" . $row['tgl_detail']. "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['subject']). "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['sub_subject']) . "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['problem']) . "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['action_plan']) . "</div>";
            $nestedData[] = "<div align='left'>" . strtoupper($row['nama_pic']) . "</div>";
            $nestedData[] = "<div align='left'>" . $row['due_date'] . "</div>";
			$nestedData[] = "<div align='left'>" . $row['done_date'] . "</div>";
            $nestedData[] = "<div align='center'>" . $tipe. "</div>";
            
				if($row['status']==0){
					if ($ENABLE_MANAGE){
					$nestedData[] = "
					  <a class='selesai btn btn-xs btn-success' href='javascript:void(0)' title='Selesai' data-id='" . $row['id_detail'] . "' data-kd_meeting='" . $row['kd_meeting'] . "'>UPDATE SELESAI</a>
					  ";
					}
				}
			    elseif($row['status']==1){
					if ($ENABLE_APPROVE){
							$nestedData[] = "<a class='done btn btn-xs btn-success' href='javascript:void(0)' title='Close' data-id='" . $row['id_detail'] . "' data-kd_meeting='" . $row['kd_meeting'] . "'>APPROVE</a>
							  ";					

				   }
				   else{
							$nestedData[]="<a class='btn btn-xs btn-warning'>PROSES APPROVAL</a>";
					}
				   
				} elseif($row['status']==2){
					$nestedData[]="<a class='btn btn-xs btn-success'>CLOSE</a>";
				}
            
			
			
				
            
            $data[] = $nestedData;
            $urut1++;
            $urut2++;
        }
        $json_data = array("draw" => intval($requestData['draw']), "recordsTotal" => intval($totalData), "recordsFiltered" => intval($totalFiltered), "data" => $data);
        echo json_encode($json_data);
    }
	
	  public function queryDataJSONlate($type, $like_value = NULL, $column_order = '', $column_dir = NULL, $limit_start = NULL, $limit_length = NULL) {
		  
		  $session = $this->session->userdata('app_session');
          $user  = $session['nm_lengkap']; 
		  
		  if($user !='Administrator'){
		  $and   = 'AND';
		  $where = 'a.nama_pic ='.$user.$and;
		  }
		  else{
		  $where ='';
		  }
        
       if($user !='Administrator'){
            $sql = "SELECT a.*, b.subject, b.sub_subject, b.description FROM tbl_meeting_detail a
			INNER JOIN tbl_meeting b ON b.kd_meeting=a.kd_meeting
			WHERE
			a.nama_pic ='$user' AND (a.due_date < a.done_date OR (a.status=0 AND a.due_date <  NOW()))  AND  
		    (
			a.tgl_detail LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			a.problem LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			a.action_plan LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			b.subject LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			b.sub_subject LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			
			)";
       }
	   else{
		$sql = "SELECT a.*, b.subject, b.sub_subject, b.description FROM tbl_meeting_detail a
			INNER JOIN tbl_meeting b ON b.kd_meeting=a.kd_meeting
			WHERE
			(a.due_date < a.done_date OR (a.status=0 AND a.due_date <  NOW()))  AND 
		    (
			a.tgl_detail LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			a.problem LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			a.action_plan LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			b.subject LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			OR
			b.sub_subject LIKE '%" . $this->db->escape_like_str($like_value) . "%'
			
			)";	
	   }
	   
        $data['totalData'] = $this->db->query($sql)->num_rows();
        $data['totalFiltered'] = $this->db->query($sql)->num_rows();
        $columns_order_by = array(0 => 'id', 1 => 'tgl_detail', 2 => 'kd_meeting', 3 => 'subject', 4 => 'sub_subject');
        if($column_order!='') $sql.= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . " ";
        $sql.= " LIMIT " . $limit_start . " ," . $limit_length . " ";
        $data['query'] = $this->db->query($sql);
        return $data;
    }
	

}
?>
