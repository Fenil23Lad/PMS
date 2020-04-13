<?php
class M_Notice extends CI_Model 
{
		
	function M_Notice() 
	{
		parent::__construct();
		$this->load->library('ImageStorage');
	}
	
	
	//============  Select By Id Function ===================
    function GetById($id)
    {
		$this->db->from('notice');
		$this->db->where('id',$id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();
    }
   	//============  CountAll Function ===================
    
    function CountAll()
    {		
		$this->db->from('notice');
	
		
        $query = $this->db->get();
        return $query->num_rows();
    }
	
    //============  GetAll Function ===================
    
    function GetAll($limit, $offset)
    {
		$this->db->from('notice');
		$this->db->like('description',$this->session->userdata('search_notice'));
		$query = $this->db->get();
		$module = array();
        if ($query->num_rows() > 0) 
        {
            $module = $query->result_array();
        }
        return $module;
    }
	 
	//============  Get Function ===================
    
    function Get()
    {
		$this->db->from('notice');
		$this->db->where('status',1);
		$this->db->order_by('created_date','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$module = array();
        if ($query->num_rows() > 0) 
        {
            $module = $query->result_array();
        }
        return $module;
    }
	//============  INSERT Function ===================
	
	 function Insert() 
	 {			
	 	$this->db->set('description', $this->input->post('description'));
		$this->db->set('created_date', date('Y-m-d h:s:i'));
		$this->db->set('status',1);
		return $this->db->insert('notice');
		
     }
	 
	 //============  UPDATE Function ===================
	
	 function Update() 
	 {
		$this->db->set('description', $this->input->post('description'));
		$this->db->set('modified_date', date('Y-m-d h:s:i'));
		$this->db->where('id', $this->input->post('id'));			 
		return $this->db->update('notice');
     }
	 
	
	 
	 
	 
	//============  STATUS CHANGE SELECTED Function ===================
	
	function ChangeStatusSelected($status) 
	{
		$this->db->set('status', $status);
		$this->db->where_in('id', $this->input->post('Id_List'));
		if ($query = $this->db->update('notice'))
			return true;
		else
			return false;
	}
	
	//============  DELETE SELECTED Function ===================
	
	function DeleteSelected() 
	{

		$this->db->where_in('id', $this->input->post('Id_List'));
		$query = $this->db->delete('notice');
		return true;
	} 
	
	function Delete($id) 
	{
		$this->db->where('id',$id);
		$query = $this->db->delete('notice');
		return true;
	}          
}
?>