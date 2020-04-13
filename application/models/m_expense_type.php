<?php
class M_Expense_Type extends CI_Model 
{
		
	function M_Expense_Type() 
	{
		parent::__construct();
	}
	
	//============  GetRoles Function ===================
    function getExpenseType()
    {
		$this->db->from('expense_type');
		$query=$this->db->get();
		return $query->result_array();
    } 
	 
    function GetAll()
    {
		$this->db->from('expense_type');
		$query = $this->db->get();
        return $query->result_array();
    }
	
	//============  Select By Id Function ===================
    function GetById($Id)
    {
		$this->db->from('expense_type');
		$this->db->where('ExpenseTypeId',$Id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();
    }
    //============  GetAll Function ===================
  
	//============  INSERT Function ===================
	
	 function Insert() 
	 {	
		$this->db->set('ExpenseType', $this->input->post('ExpenseType'));
		return $this->db->insert('expense_type');
     }
	 
	 //================================================================================
	
	  function Update() 
	  {
		$this->db->set('ExpenseType', $this->input->post('ExpenseType'));
		$this->db->where('ExpenseTypeId', $this->input->post('ExpenseTypeId'));	 
		return $this->db->update('expense_type');
	} 
	
	
		
	//============  CheckExist Function ===================
    function CheckExist($ExpenseType,$ExpenseTypeId=0)
    {
		$this->db->from('expense_type');
		$this->db->where('ExpenseType',$ExpenseType);
		$this->db->where('ExpenseTypeId !='.$ExpenseTypeId);
		$query=$this->db->get();
        return $query->num_rows();
    }
	
	
 	//============  DELETE SELECTED Function ===================
	
	function DeleteSelected() 
	{	
		$this->db->where_in('ExpenseTypeId', $this->input->post('Id_List'));
		$query = $this->db->delete('expense_type');
		return true;
	}            
}
?>