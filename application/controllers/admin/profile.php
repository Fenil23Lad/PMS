<?php
class Profile extends CI_Controller 
{
	function Profile()
	{
		parent::__construct();
		$this->load->library('administration');
		$this->load->model('M_Admin', 'admin');
	}		
    //===============================================================
	function index()
	{
		if($this->input->post('submit_personal'))
		{
			if($this->admin->UpdatePersonalInfo())
			$this->session->set_flashdata('success', 'Personal Information Saved Successfully.');
			redirect('admin/profile');
		}
		$data['user']=$this->admin->GetById($this->session->userdata('UserId'));
		$this->load->view('admin/header');
		$this->load->view('admin/profile/edit',$data);
		$this->load->view('admin/footer');
	}
}
?>