<?php
class role extends CI_Controller 
{
	function role()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->model('M_role','role');
	}		

	function index()
	{
		$data['roles']=$this->role->GetAll();
		$data['operation']='add';
		$this->load->view('admin/header');
		$this->load->view('admin/employee/role/list',$data);
		$this->load->view('admin/footer');
	}
	
	function edit($id='')
	{
		$data['roles']=$this->role->GetAll();
		$data['role']=$this->role->GetById($id);
		$data['operation']='edit';
		$this->load->view('admin/header');
		$this->load->view('admin/employee/role/list',$data);
		$this->load->view('admin/footer');
	}
	
	//============Add Forum Page===================
	
	function add()
	{
		$data['roles']=$this->role->GetAll();
		$data['operation']='add';
		$this->load->view('admin/header');
		$this->load->view('admin/employee/role/list',$data);
		$this->load->view('admin/footer');
	}


	//===============================================
	
	function role_operation()
	{
		if($this->input->post('operation')=='edit')
		{
			$this->role->Update();
			$this->session->set_flashdata('success', 
			'Designation has been updated successfully.');
		}
		if($this->input->post('operation')=='add')
		{
			$this->role->Insert();
			$this->session->set_flashdata('success', 
			'Designation has been added successfully.');
		}
		if($this->input->post('action')=='action_active')
		{
			$this->role->ChangeStatusSelected(1);
			$this->session->set_flashdata('success', 
			'Selected Designation has been Published successfully.');
		}
		if($this->input->post('action')=='action_deactive')
		{
			$this->role->ChangeStatusSelected(0);
			$this->session->set_flashdata('success', 
			'Selected Designation has been Unpublished successfully.');
		}
		if($this->input->post('action')=='action_delete')
		{
			$this->role->DeleteSelected();
			$this->session->set_flashdata('success', 
			'Selected Designation has been Deleted successfully.');
		}
		redirect('admin/role');
	}
		
	//=================================================================
	function check_role_exists($id=0) 
	{
		if (array_key_exists('RoleName', $_POST))
		 {
			if ($this->role->CheckExist($this->input->post('RoleName'),$id)>0) 
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