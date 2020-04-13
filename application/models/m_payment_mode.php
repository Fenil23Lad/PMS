<?php
class M_payment_mode extends CI_Model 
{
		
	function M_payment_mode() 
	{
		parent::__construct();
	}
	

    function GetAll()
    {
		$this->db->from('payment_mode');
		$query = $this->db->get();
        return $query->result_array();
    }
	
	//============  Select By Id Function ===================
    function GetById($Id)
    {
		$this->db->from('payment_mode');
		$this->db->where('PayModeId',$Id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();
    }
    //============  GetAll Function ===================
  
	//============  INSERT Function ===================
	
	 function Insert() 
	 {	
		$this->db->set('Name', $this->input->post('Name'));
		return $this->db->insert('payment_mode');
     }
	 
	 //================================================================================
	
	  function Update() 
	  {
		$this->db->set('Name', $this->input->post('Name'));
		$this->db->where('PayModeId',$this->input->post('PayModeId')); 
		return $this->db->update('payment_mode');
	} 
	
	//============  CheckExist Function ===================
    function CheckExist($Name,$PayModeId=0)
    {
		$this->db->from('payment_mode');
		$this->db->where('Name',$Name);
		$this->db->where('PayModeId !='.$PayModeId);
		$query=$this->db->get();
        return $query->num_rows();
    }
	
	
 	//============  DELETE SELECTED Function ===================
	
	function DeleteSelected() 
	{	
		$this->db->where_in('PayModeId', $this->input->post('Id_List'));
		$query = $this->db->delete('payment_mode');
		return true;
	}            
}
?>