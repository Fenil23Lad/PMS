<?php
class Task extends CI_Controller 
{
	function Task()
	{
		parent::__construct();
		$this->administration->check_employee_login();
		$this->load->model('M_Task','task');
		$this->load->model('M_Employee','employee');
		$this->load->model('M_Project','project');
	}
	//=======================================================================
	function index($id=0)
	{	
		$count = $this->task->CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("employee/task/index");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['records']=$this->task->GetAll($per_page_record,$page);
		$userid=$this->session->userdata('UserId');
		$data['rolename']=$this->task->getrole($userid);
		$data['projects']=$this->project->GetProjects();
		$this->load->view('employee/header');
		$this->load->view('employee/task/list', $data);
		$this->load->view('employee/footer');
	}
	//=======================================================================
	function search($all='')
	{
		$this->session->set_userdata('search_task_projectid',
		$this->input->post('ProjectId'));
		
		if($this->input->post('search'))
		{
			$this->session->set_userdata('search_task',
			$this->input->post('search_task'));
		}
		if($this->input->post('all') || $all=='all')
		{
			$this->session->unset_userdata('search_task');
		}
		redirect('employee/task');
	}
	//=======================================================================
	function add($id=0)
	{	
		$data['action'] = "add";
		$data['developers']=$this->employee->GetDevelopers();
		$data['ProjectId']=$id;
		$data['projects']=$this->project->GetProjects();
		if ($this->input->post('submit'))
		{
			if($result = $this->task->Insert())
			{
				$this->session->set_flashdata('notification', 'Task has been added successfully.');
				redirect('employee/task');
			}
		}
		$this->load->view('employee/header');
		$this->load->view('employee/task/addedit', $data);
		$this->load->view('employee/footer');
	}
	//=======================================================================
	function edit($id='0')
	{	
		$data['action'] = "edit";
		$data['developers']=$this->employee->GetDevelopers();
		$data['record']=$this->task->GetById($this->functions->decode($id));
		$data['projects']=$this->project->GetProjects();
		if ($this->input->post('submit'))
		{
			if($result = $this->task->Update())
			{
				
				$this->session->set_flashdata('notification', 'Task has been updated successfully.');
				redirect('employee/task');
			}
		}
		$this->load->view('employee/header');
		$this->load->view('employee/task/addedit',$data);
		$this->load->view('employee/footer');
	}	
	//=======================================================================
	function delete($id='0')
	{
		$this->task->Delete($this->functions->decode($id));
		$this->session->set_flashdata('notification', 'Task has been Deleted successfully.');
		redirect('employee/task');
	}			
}

?>