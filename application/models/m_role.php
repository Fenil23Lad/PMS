<?php
class M_role extends CI_Model 
{
		
	function M_role() 
	{
		parent::__construct();
	}
	
	//============  GetRoles Function ===================
    function GetRoles()
    {
		$this->db->from('role');
		$this->db->where('RoleId <> 1');
		$this->db->where('RoleStatus',1);
		$query=$this->db->get();
		return $query->result_array();
    }
	
	//============  Select By Id Function ===================
    function GetById($Id)
    {
		$this->db->from('role');
		$this->db->where('RoleId',$Id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();
    }
    //============  GetAll Function ===================
    
    function GetAll()
    {
		$this->db->from('role');
		$query = $this->db->get();
        return $query->result_array();
    }
		 
	//============  INSERT Function ===================
	
	 function Insert() 
	 {	
		$this->db->set('RoleName', $this->input->post('RoleName'));
		$this->db->set('RoleStatus', $this->input->post('RoleStatus'));
		return $this->db->insert('role');
     }
	 
	 //================================================================================
	
	  function Update() 
	  {
		$this->db->set('RoleName', $this->input->post('RoleName'));
		$this->db->set('RoleStatus', $this->input->post('RoleStatus'));
		$this->db->where('RoleId', $this->input->post('RoleId'));	 
		return $this->db->update('role');
	} 
	
	
		
	//============  CheckExist Function ===================
    function CheckExist($RoleName,$RoleId=0)
    {
		$this->db->from('role');
		$this->db->where('RoleName',$RoleName);
		$this->db->where('RoleId !='.$RoleId);
		$query=$this->db->get();
        return $query->num_rows();
    }
 
	//============  STATUS CHANGE SELECTED Function ===================
	
	function ChangeStatusSelected($status) 
	{
		$this->db->set('RoleStatus', $status);
		$this->db->where_in('RoleId', $this->input->post('Id_List'));
		return $this->db->update('role');
	}
	
	//============  DELETE SELECTED Function ===================
	
	function DeleteSelected() 
	{	
		$this->db->where_in('RoleId', $this->input->post('Id_List'));
		$query = $this->db->delete('role');
		return true;
	}            
}
?>