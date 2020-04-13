<?php
class M_Expense extends CI_Model 
{
		
	function M_Expense() 
	{
		parent::__construct();
	}		
   	//============  CountAll Function ===================
    function CountAll()
    {	
		$this->db->from('expense');
		if($this->session->userdata('search_ExpenseTypeId'))
		{
			$this->db->where('ExpenseTypeId',$this->session->userdata('search_ExpenseTypeId'));
		}
		if($this->session->userdata('search_from_expense'))
		{
			$this->db->where('Date >=',
			date('Y-m-d',strtotime($this->session->userdata('search_from_expense'))));
		}
		if($this->session->userdata('search_to_expense'))
		{
			$this->db->where('Date <=',
			date('Y-m-d',strtotime($this->session->userdata('search_to_expense'))));
		}
		
        $query = $this->db->get();
        return $query->num_rows();
    }
	
    //============  GetAll Function ===================
    
    function GetAll($limit, $offset)
    {
		$this->db->from('expense');
		if($this->session->userdata('search_ExpenseTypeId'))
		{
			$this->db->where('ExpenseTypeId',$this->session->userdata('search_ExpenseTypeId'));
		}
		if($this->session->userdata('search_from_expense'))
		{
			$this->db->where('Date >=',
			date('Y-m-d',strtotime($this->session->userdata('search_from_expense'))));
		}
		if($this->session->userdata('search_to_expense'))
		{
			$this->db->where('Date <=',
			date('Y-m-d',strtotime($this->session->userdata('search_to_expense'))));
		}
		$this->db->order_by("ExpenseId", "DESC");
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
        $module = array();
        if ($query->num_rows() > 0) 
        {
            $module = $query->result_array();
        }
		return $module;
    }
	
	//============  Monthly_Summary Function ===================
    
    function Monthly_Summary($typeid,$month)
    {
		$this->db->from('expense');
		$this->db->where('ExpenseTypeId',$typeid);
		$this->db->where('month(Date)',$month);
		$this->db->order_by("ExpenseId", "DESC");
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
		$this->db->set('ExpenseTypeId', $this->input->post('ExpenseTypeId'));
		
		$this->db->set('Expense_Desc', $this->input->post('Expense_Desc'));
		$this->db->set('Amount', $this->input->post('Amount'));
		$this->db->set('Date',date('Y-m-d',strtotime($this->input->post('Date'))));
		$this->db->set('ExpenseBy', $this->input->post('ExpenseBy'));
		$this->db->set('TransactionRef',$this->input->post('TransactionRef'));
		$this->db->set('PaymentTo', $this->input->post('PaymentTo'));
		$this->db->insert('expense');
		return $this->db->insert_id();
		
     }
	 //============  UPDATE Function ===================
	
	 function Update() 
	 {
	 	$this->db->set('ExpenseTypeId', $this->input->post('ExpenseTypeId'));
		
		$this->db->set('Expense_Desc', $this->input->post('Expense_Desc'));
		$this->db->set('Amount', $this->input->post('Amount'));
		$this->db->set('Date',date('Y-m-d',strtotime($this->input->post('Date'))));
		$this->db->set('ExpenseBy', $this->input->post('ExpenseBy'));
		$this->db->set('TransactionRef',$this->input->post('TransactionRef'));
		$this->db->set('PaymentTo', $this->input->post('PaymentTo'));
		$this->db->where('ExpenseId',$this->input->post('ExpenseId'));			 
		return $this->db->update('expense');
     }
	 
	function Delete($id) 
	{
		$this->db->where('ExpenseId',$id);
		$query = $this->db->delete('expense');
		return true;
	}
	function GetExpenseDetailById($id)
	{
		$this->db->from('expense');
		$this->db->where('ExpenseId',$id);
		$query=$this->db->get();
		return $query->row_array();
	} 
	//==========================================
	function CategoryWiseSummary()
	{
		$sql="select expense_type.ExpenseType,expense.ExpenseTypeId, 
				 sum(case when month(Date)=1 then Amount else 0 end) as '1',
				 sum(case when month(Date)=2 then Amount else 0 end) as '2',
				 sum(case when month(Date)=3 then Amount else 0 end) as '3',
				 sum(case when month(Date)=4 then Amount else 0 end) as '4',
				 sum(case when month(Date)=5 then Amount else 0 end) as '5',
				 sum(case when month(Date)=6 then Amount else 0 end) as '6',
				 sum(case when month(Date)=7 then Amount else 0 end) as '7',
				 sum(case when month(Date)=8 then Amount else 0 end) as '8',
				 sum(case when month(Date)=9 then Amount else 0 end) as '9',
				 sum(case when month(Date)=10 then Amount else 0 end) as '10',
				 sum(case when month(Date)=11 then Amount else 0 end) as '11',
				 sum(case when month(Date)=12 then Amount else 0 end) as '12'
			  from 
				 expense Inner Join expense_type 
				 On expense_type.ExpenseTypeId = expense.ExpenseTypeId
			  group by 
			     expense.ExpenseTypeId,expense_type.ExpenseType";
		
        $query = $this->db->query($sql); 
		$result = $query->result_array();
		return $result;
		
	}	
}
?>