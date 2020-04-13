<?php

class Common extends CI_Model 

{
    function Common() 
	{

		parent::__construct();
	}

	//========================================================

    function GetUserNameById($id)

    {

		$this->db->select('Name');

		$this->db->from('users');

		$this->db->where('UserId',$id);

		$query=$this->db->get();

		$res = $query->row_array();

		return $res['Name'];

    }

	//========================================================  

	function GetCategoryNameById($id)

    {

		$this->db->select('ProjectCategoryName');

		$this->db->from('project_category');

		$this->db->where('ProjectCategoryId',$id);

		$query=$this->db->get();

		$res = $query->row_array();

		return $res['ProjectCategoryName'];

    }  

	//========================================================  

	function GetProjectNameById($id)

    {

		$this->db->select('ProjectName');

		$this->db->from('project');

		$this->db->where('ProjectId',$id);

		$query=$this->db->get();

		$res = $query->row_array();

		return $res['ProjectName'];

    } 
	function GetExpenseTypeById($id)
	{
		$this->db->from('expense_type');
		$this->db->where('ExpenseTypeId',$id);
		$query=$this->db->get();
		$res = $query->row_array();
		return $res['ExpenseType'];	
	} 
	
	function GetRolebyid()
	{
		$this->db->select('role.RoleName');
		$this->db->from('role');
		$this->db->join('users','users.RoleId=role.RoleId');
		$this->db->where('UserId',$this->session->userdata('UserId'));
		$query=$this->db->get();
		$res = $query->row_array();
		return $res;
		
	}
	//==========================================================
	function GetReceivedAmount($invoiceNo=0)
	{
		$this->db->select('sum(Amount) as Amount');
		$this->db->from('receipt');
		$this->db->where('InvoiceNo',$invoiceNo);
		$query=$this->db->get();
		$res = $query->row_array();
		return $res['Amount'];
	}
	//==========================================================
	function GetInvoiceAmount($ProjectId=0)
	{
		$this->db->select('sum(Amount) as Amount');
		$this->db->from(' invoice');
		$this->db->where('ProjectId',$ProjectId);
		$query=$this->db->get();
		$res = $query->row_array();
		return $res['Amount'];
	}
   
   //============================================================
   function config($key='')
   {
	   $res = $this->db->where('key',$key)->get('config')->row_array();
	   return isset($res['val'])?$res['val']:'';
   }

}

?>