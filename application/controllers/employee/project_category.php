<?php
class project_category extends CI_Controller 
{
	function project_category()
	{
		parent::__construct();
		$this->administration->check_employee_login();
		$this->load->model('M_project_category','project_category');
	}		

	function index()
	{
		$data['categories']=$this->project_category->GetAll();
		$data['operation']='add';
		$this->load->view('employee/header');
		$this->load->view('employee/project/category/list',$data);
		$this->load->view('employee/footer');
	}
	
	function edit($id='')
	{
		$data['categories']=$this->project_category->GetAll();
		$data['category']=$this->project_category->GetById($id);
		$data['operation']='edit';
		$this->load->view('employee/header');
		$this->load->view('employee/project/category/list',$data);
		$this->load->view('employee/footer');
	}
	
	//============Add Forum Page===================
	
	function add()
	{
		$data['categories']=$this->project_category->GetAll();
		$data['operation']='add';
		$this->load->view('employee/header');
		$this->load->view('employee/project/category/list',$data);
		$this->load->view('employee/footer');
	}


	//===============================================
	
	function category_operation()
	{
		if($this->input->post('operation')=='edit')
		{
			$this->project_category->Update();
			$this->session->set_flashdata('success', 
			'Designation has been updated successfully.');
		}
		if($this->input->post('operation')=='add')
		{
			$this->project_category->Insert();
			$this->session->set_flashdata('success', 
			'Designation has been added successfully.');
		}
		if($this->input->post('action')=='action_active')
		{
			$this->project_category->ChangeStatusSelected(1);
			$this->session->set_flashdata('success', 
			'Selected Designation has been Published successfully.');
		}
		if($this->input->post('action')=='action_deactive')
		{
			$this->project_category->ChangeStatusSelected(0);
			$this->session->set_flashdata('success', 
			'Selected Designation has been Unpublished successfully.');
		}
		if($this->input->post('action')=='action_delete')
		{
			$this->project_category->DeleteSelected();
			$this->session->set_flashdata('success', 
			'Selected Designation has been Deleted successfully.');
		}
		redirect('employee/project_category');
	}
		
	//=================================================================
	function check_category_exists($id=0) 
	{
		if (array_key_exists('ProjectCategoryName', $_POST))
		 {
			if ($this->project_category->CheckExist($this->input->post('ProjectCategoryName'),$id)>0) 
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