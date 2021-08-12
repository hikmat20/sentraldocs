<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Yunas Handra
 * @copyright Copyright (c) 2018, Yunas Handra
 *
 * This is model class for table "Customer"
 */

class Meeting_model extends BF_Model
{

    /**
     * @var string  User Table Name
     */
    protected $table_name = 'tbl_meeting';
    protected $key        = 'id';

    /**
     * @var string Field name to use for the created time column in the DB table
     * if $set_created is enabled.
     */
    protected $created_field = 'create_on';

    /**
     * @var string Field name to use for the modified time column in the DB
     * table if $set_modified is enabled.
     */
    protected $modified_field = 'modified_on';

    /**
     * @var bool Set the created time automatically on a new record (if true)
     */
    protected $set_created = true;

    /**
     * @var bool Set the modified time automatically on editing a record (if true)
     */
    protected $set_modified = true;
    /**
     * @var string The type of date/time field used for $created_field and $modified_field.
     * Valid values are 'int', 'datetime', 'date'.
     */
    /**
     * @var bool Enable/Disable soft deletes.
     * If false, the delete() method will perform a delete of that row.
     * If true, the value in $deleted_field will be set to 1.
     */
    protected $soft_deletes = false;

    protected $date_format = 'datetime';

    /**
     * @var bool If true, will log user id in $created_by_field, $modified_by_field,
     * and $deleted_by_field.
     */
    protected $log_user = true;

    /**
     * Function construct used to load some library, do some actions, etc.
     */
    public function __construct()
    {
        parent::__construct();
    }
	
    function generate_id($kode='') {
      $query = $this->db->query("SELECT MAX(kd_meeting) as max_id FROM tbl_meeting");
      $row = $query->row_array();
      $thn = date('y');
      $max_id = $row['max_id'];
      $max_id1 =(int) substr($max_id,4,5);
      $counter = $max_id1 +1;
      $idcust = "MT".$thn.str_pad($counter, 5, "0", STR_PAD_LEFT);
      return $idcust;
	}

    function get_data($table)
    {
       return $this->db->get($table)->result();
    }
	
	 function get_data_where($table,$where)
    {
       return $this->db->get_where($table,$where)->result();
    }

    function getById($id)
    {
       return $this->db->get_where('tbl_meeting',array('id' => $id))->row_array();
    }

   	
	function pilih_combobox($table,$field,$where)
    {
        $query="SELECT * 
                FROM
                $table
				where $field ='$where'";
        return $this->db->query($query);
    }
	
	function pilih_combobox_array ($table,$where)
    {
        $this->db->where($where);
		$query=$this->db->get($table);
        return $query;
    }	
	
	
	public function getUpdate($table,$data,$where){
		$this->db->where($where);		
		$result	= $this->db->update($table,$data);
		return $result;
	}
   
	 
  
	
}
