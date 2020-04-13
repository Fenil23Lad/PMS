<?php
class M_industry extends CI_Model 
{
		
	function M_industry() 
	{
		parent::__construct();
	}
	
	//============  GetRoles Function ===================
    function GetIndustrys()
    {
		$this->db->from('industry');
		$this->db->where('Status',1);
		$query=$this->db->get();
		return $query->result_array();
    }
	
	//============  Select By Id Function ===================
    function GetById($Id)
    {
		$this->db->from('industry');
		$this->db->where('IndustryId',$Id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();
    }
    //============  GetAll Function ===================
    
    function GetAll()
    {
		$this->db->from('industry');
		$query = $this->db->get();
        return $query->result_array();
    }
		 
	//============  INSERT Function ===================
	
	 function Insert() 
	 {	
	 	$this->db->set('Name', $this->input->post('Name'));
		$this->db->set('Status', $this->input->post('Status'));
		//return;
		 $this->db->insert('industry');
		
     }
	 
	 //================================================================================
	
	  function Update() 
	  {
		$this->db->set('Name', $this->input->post('Name'));
		$this->db->set('Status', $this->input->post('Status'));
		$this->db->where('IndustryId', $this->input->post('IndustryId'));	 
		return $this->db->update('industry');
	} 
	
	
		
	//============  CheckExist Function ===================
    function CheckExist($Name,$IndustryId=0)
    {
		$this->db->from('industry');
		$this->db->where('Name',$Name);
		$this->db->where('IndustryId !='.$IndustryId);
		$query=$this->db->get();
        return $query->num_rows();
    }
 
	//============  STATUS CHANGE SELECTED Function ===================
	
	function ChangeStatusSelected($status) 
	{
		$this->db->set('Status', $status);
		$this->db->where_in('IndustryId', $this->input->post('Id_List'));
		return $this->db->update('industry');
	}
	
	//============  DELETE SELECTED Function ===================
	
	function DeleteSelected() 
	{	
		$this->db->where_in('IndustryId', $this->input->post('Id_List'));
		$query = $this->db->delete('industry');
		return true;
	}            
}
?>