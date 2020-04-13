<?php

class project extends CI_Controller 

{

	function project()

	{

		parent::__construct();

		$this->administration->check_admin_login();

		$this->load->model('M_Project','project');

		$this->load->model('M_project_category','project_category');

		$this->load->model('M_Employee','employee');

	}

	//=======================================================================

	function index()

	{	

		$count = $this->project->CountAll();

		$per_page_record = 10;

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$url= base_url("admin/project/index");

		$config =$this->functions->paginationConfig($url,$count,$per_page_record);

		$config['uri_segment'] = 4;

		$this->pagination->initialize($config);

		

		$data['records']=$this->project->GetAll($per_page_record,$page);

		$this->load->view('admin/header');

		$this->load->view('admin/project/list', $data);

		$this->load->view('admin/footer');

	}

	//=======================================================================

	function search($all='')

	{

		if($this->input->post('search'))

		{

			$this->session->set_userdata('search_project',

			$this->input->post('search_project'));

		}

		if($this->input->post('all') || $all=='all')

		{

			$this->session->unset_userdata('search_project');

		}

		redirect('admin/project');

	}

	//=======================================================================

	function add()

	{	

		$data['action'] = "add";

		$data['categories']=$this->project_category->GetCategories();

		$data['ProjectAssignee']=$this->employee->GetProjectAssignee();

		if ($this->input->post('submit'))

		{

			$this->project->Insert();

			$this->session->set_flashdata('notification', 

			'Project has been Added successfully.');

			redirect('admin/project');

		}

		$this->load->view('admin/header');

		$this->load->view('admin/project/addedit', $data);

		$this->load->view('admin/footer');

	}

	//=======================================================================

	function edit($id='0')

	{	

		$data['action'] = "edit";

		$data['record']=$this->project->GetById($this->functions->decode($id));

		$data['categories']=$this->project_category->GetCategories();

		$data['ProjectAssignee']=$this->employee->GetProjectAssignee();

		if ($this->input->post('submit'))

		{

			$this->project->Update();

			$this->session->set_flashdata('notification', 

			'Project has been Updated successfully.');

			redirect('admin/project');

		}

		$this->load->view('admin/header');

		$this->load->view('admin/project/addedit',$data);

		$this->load->view('admin/footer');

	}	

	//=======================================================================

	function action()

	{

		if($this->input->post('action')=='action_delete')

		{

			$this->project->DeleteSelected();

			$this->session->set_flashdata('notification', 

			'Selected project has been Deleted successfully.');

		}

		redirect('admin/project');

	}	
	
	function Inactive($id=0,$status=0)
	{
		$this->project->InactiveProjectStatus($this->functions->decode($id),$status);
		$this->session->set_flashdata('notification','Project Status Updated successfully.');
		$this->index();
		
	}
	

}



?>