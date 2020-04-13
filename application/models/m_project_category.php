<?php
class M_project_category extends CI_Model 
{
		
	function M_project_category() 
	{
		parent::__construct();
	}
	//============  Select By Id Function ===================
    function GetById($Id)
    {
		$this->db->from('project_category');
		$this->db->where('ProjectCategoryId',$Id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();
    }
    //============  GetAll Function ===================
    
    function GetAll()
    {
		$this->db->from('project_category');
		$query = $this->db->get();
        return $query->result_array();
    }
	
	//============  GetCategories Function ===================
    function GetCategories()
    {
		$this->db->from('project_category');
		$this->db->where('ProjectCategoryStatus',1);
		$query=$this->db->get();
		return $query->result_array();
    }
		 
	//============  INSERT Function ===================
	
	 function Insert() 
	 {	
		$this->db->set('ProjectCategoryName', $this->input->post('ProjectCategoryName'));
		$this->db->set('ProjectCategoryStatus', $this->input->post('ProjectCategoryStatus'));
		return $this->db->insert('project_category');
     }
	 
	 //================================================================================
	
	  function Update() 
	  {
		$this->db->set('ProjectCategoryName', $this->input->post('ProjectCategoryName'));
		$this->db->set('ProjectCategoryStatus', $this->input->post('ProjectCategoryStatus'));
		$this->db->where('ProjectCategoryId', $this->input->post('ProjectCategoryId'));	 
		return $this->db->update('project_category');
	} 
	
	
		
	//============  CheckExist Function ===================
    function CheckExist($ProjectCategoryName,$ProjectCategoryId=0)
    {
		$this->db->from('project_category');
		$this->db->where('ProjectCategoryName',$ProjectCategoryName);
		$this->db->where('ProjectCategoryId !='.$ProjectCategoryId);
		$query=$this->db->get();
        return $query->num_rows();
    }
 
	//============  STATUS CHANGE SELECTED Function ===================
	
	function ChangeStatusSelected($status) 
	{
		$this->db->set('ProjectCategoryStatus', $status);
		$this->db->where_in('ProjectCategoryId', $this->input->post('Id_List'));
		return $this->db->update('project_category');
	}
	
	//============  DELETE SELECTED Function ===================
	
	function DeleteSelected() 
	{	
		$this->db->where_in('ProjectCategoryId', $this->input->post('Id_List'));
		$query = $this->db->delete('project_category');
		return true;
	}            
}
?>