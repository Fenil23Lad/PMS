<?php
class industry extends CI_Controller 
{
	function industry()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->model('M_industry','industry');
	}		

	function index()
	{
		$data['indistry']=$this->industry->GetAll();
		$data['operation']='add';
		$this->load->view('admin/header');
		$this->load->view('admin/lead/industry/list',$data);
		$this->load->view('admin/footer');
	}
	
	function edit($id='')
	{
		$data['indistry']=$this->industry->GetAll();
		$data['indist']=$this->industry->GetById($id);
		$data['operation']='edit';
		$this->load->view('admin/header');
		$this->load->view('admin/lead/industry/list',$data);
		$this->load->view('admin/footer');
	}
	
	//============Add Forum Page===================
	
	function add()
	{
		$data['indistry']=$this->industry->GetAll();
		$data['operation']='add';
		$this->load->view('admin/header');
		$this->load->view('admin/lead/industry/list',$data);
		$this->load->view('admin/footer');
	}


	//===============================================
	
	function role_operation()
	{
		if($this->input->post('operation')=='edit')
		{
			$this->industry->Update();
			$this->session->set_flashdata('success', 
			'Designation has been updated successfully.');
		}
		if($this->input->post('operation')=='add')
		{
			$this->industry->Insert();
			$this->session->set_flashdata('success', 
			'Industry has been added successfully.');
		}
		if($this->input->post('action')=='action_active')
		{
			$this->industry->ChangeStatusSelected(1);
			$this->session->set_flashdata('success', 
			'Selected Designation has been Published successfully.');
		}
		if($this->input->post('action')=='action_deactive')
		{
			$this->industry->ChangeStatusSelected(0);
			$this->session->set_flashdata('success', 
			'Selected Designation has been Unpublished successfully.');
		}
		if($this->input->post('action')=='action_delete')
		{
			$this->industry->DeleteSelected();
			$this->session->set_flashdata('success', 
			'Selected Designation has been Deleted successfully.');
		}
		redirect('admin/industry');
	}
		
	//=================================================================
	function check_role_exists($id=0) 
	{
		if (array_key_exists('Name', $_POST))
		 {
			if ($this->industry->CheckExist($this->input->post('Name'),$id)>0) 
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