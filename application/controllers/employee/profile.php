<?php
class Profile extends CI_Controller 
{
	function Profile()
	{
		parent::__construct();
		$this->administration->check_employee_login();
		$this->load->model('M_Employee', 'employee');
	}		
    //===============================================================
	function index()
	{
		if($this->input->post('submit_personal'))
		{
			if($this->employee->UpdateProfile())
			$this->session->set_flashdata('success', 'Personal Information Saved Successfully.');
			redirect('employee/profile');
		}
		$data['user']=$this->employee->GetById($this->session->userdata('UserId'));
		$this->load->view('employee/header');
		$this->load->view('employee/profile/edit',$data);
		$this->load->view('employee/footer');
	}
}
?>