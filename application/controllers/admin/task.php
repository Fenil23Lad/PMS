<?php
class Task extends CI_Controller 
{
	function Task()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->model('M_Task','task');
		$this->load->model('M_Employee','employee');
		$this->load->model('M_Project','project');
		$this->load->model('M_Dashboard','Dashboard');
	}
	//=======================================================================
	function index($id=0)
	{	
		$count = $this->task->CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("admin/task/index");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['records']=$this->task->GetAll($per_page_record,$page);
		$userid=$this->session->userdata('UserId');
		$data['rolename']=$this->task->getrole($userid);
		$data['projects']=$this->project->GetProjects();
		$this->load->view('admin/header');
		$this->load->view('admin/task/list', $data);
		$this->load->view('admin/footer');
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
		redirect('admin/task');
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
				redirect('admin/task');
			}
		}
		$this->load->view('admin/header');
		$this->load->view('admin/task/addedit', $data);
		$this->load->view('admin/footer');
	}
	//=======================================================================
	/*=======================By Me==========================================
	function addtask($id=0,$from='')
	{	
		$data['action'] = "add";
		$data['developers']=$this->employee->GetDevelopers();
		$data['ProjectId']=$id;
		$data['projects']=$this->project->GetProjects();
		$data['from']=isset($from)?$from:'';
		if ($this->input->post('submit'))
		{
			
			if($result = $this->task->Insert())
			{
				$data['Project_details']=$this->Dashboard->project_desc($this->input->post('ProjectId'));
	
				$this->db->from('invoice');
				$this->db->where('ProjectId',$this->input->post('ProjectId'));
				$query = $this->db->get();
				$data['Project_payments']=$query->result_array();
				if($this->input->post('from') != 'Project')
				{
					$this->session->set_flashdata('notification', 'Task has been added successfully.');
					redirect('admin/task');
				}
				else
				{
					$this->session->set_flashdata('notification', 'Task has been added successfully.');
					
					$this->load->view('admin/header');
					$this->load->view('admin/dashboard/projectdetails',$data);
					$this->load->view('admin/footer');
				}
			}
			else
			{
				if($this->input->post('from') != 'Project')
				{
					$this->session->set_flashdata('error', 'Error to add task.');
					redirect('admin/task');
				}
				else
				{
					$this->session->set_flashdata('error', 'Error to add task.');
					
					$this->load->view('admin/header');
					$this->load->view('admin/dashboard/projectdetails',$data);
					$this->load->view('admin/footer');
				}
			}
		}
		else
		{
			$this->load->view('admin/header');
			$this->load->view('admin/task/addedit', $data);
			$this->load->view('admin/footer');
		}
	}
	//=======================================================================*/
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
				redirect('admin/task');
			}
		}
		$this->load->view('admin/header');
		$this->load->view('admin/task/addedit',$data);
		$this->load->view('admin/footer');
	}	
	//=======================================================================
	function delete($id='0')
	{
		$this->task->Delete($this->functions->decode($id));
		$this->session->set_flashdata('notification', 'Task has been Deleted successfully.');
		redirect('admin/task');
	}			
}

?>