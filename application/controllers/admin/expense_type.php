<?php
class expense_type extends CI_Controller 
{
	function expense_type()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->model('M_Expense_Type','expense_type');
	}
			
	function index()
	{
		$data['expense_types']=$this->expense_type->GetAll();
		$data['operation']='add';
		$this->load->view('admin/header');
		$this->load->view('admin/expense/expense_type/list',$data);
		$this->load->view('admin/footer');
	}
	
	function edit($id='')
	{
		$data['expense_types']=$this->expense_type->GetAll();
		$data['expense_type']=$this->expense_type->GetById($id);
		$data['operation']='edit';
		$this->load->view('admin/header');
		$this->load->view('admin/expense/expense_type/list',$data);
		$this->load->view('admin/footer');
	}
	
	//============Add Forum Page===================
	function add()
	{
		$data['expense_types']=$this->expense_type->GetAll();
		$data['operation']='add';
		$this->load->view('admin/header');
		$this->load->view('admin/expense/expense_type/list',$data);
		$this->load->view('admin/footer');
	}


	//===============================================
	
	function ExpenseType_operation()
	{
		if($this->input->post('operation')=='edit')
		{
			$this->expense_type->Update();
			$this->session->set_flashdata('success', 
			'Expence Type has been updated successfully.');
		}
		if($this->input->post('operation')=='add')
		{
			$this->expense_type->Insert();
			$this->session->set_flashdata('success', 
			'Expense Type has been added successfully.');
		}
		if($this->input->post('action')=='action_delete')
		{
			$this->expense_type->DeleteSelected();
			$this->session->set_flashdata('success', 
			'Selected Expense Type has been Deleted successfully.');
		}
		redirect('admin/expense_type');
	}
		
	//=================================================================
	function check_type_exists($id=0) 
	{
		if (array_key_exists('ExpenseType', $_POST))
		 {
			if ($this->expense_type->CheckExist($this->input->post('ExpenseType'),$id)>0) 
			{
				echo json_encode(FALSE);
			} 
			else 
			{
				echo json_encode(TRUE);
			}
		}
	}

}
?>