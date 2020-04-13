<?php
class qa extends CI_Controller 
{
	function qa()
	{
		parent::__construct();
		$this->administration->check_employee_login();
		$this->load->model('M_Project','project');
		$this->load->model('M_Qa','qa');
	}
	function index($id=0)
	{
		$count = $this->qa->CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("employee/qa/index");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$role=$this->qa->roledetail();
		$data['records']=$this->qa->GetAll($per_page_record,$page,$role);
		
		$this->load->view('employee/header');
		$this->load->view('employee/QA/list',$data);
		$this->load->view('employee/footer');	
	}
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
		redirect('employee/qa');
	}
	function add($id=0)
	{
		$data['action'] = "add";
		$data['project']=$this->project->GetById($this->functions->decode($id));
		$data['tasks']=$this->qa->tasklist($this->functions->decode($id));
		if ($this->input->post('submit'))
		{
			$this->qa->Insert();
			$this->session->set_flashdata('notification', 
			'Question has been Added successfully.');
			redirect('employee/qa');
		}
		$this->load->view('employee/header');
		$this->load->view('employee/QA/addedit',$data);
		$this->load->view('employee/footer');		
	}
	
	
	
	function edit($projectid='0',$taskid='0')
	{
		$data['action'] = "edit";
		$data['record']=$this->qa->getdata($this->functions->decode($projectid),$this->functions->decode($taskid));
		$data['project']=$this->project->GetById($this->functions->decode($projectid));
		$data['tasks']=$this->qa->TaskbyId($this->functions->decode($taskid));
		if($this->input->post('submit'))
		{
			$this->qa->Insert();
			$this->session->set_flashdata('notification', 'QA Updated successfully.');
			redirect('employee/qa');
			
		}
		$this->load->view('employee/header');
		$this->load->view('employee/QA/addedit',$data);
		$this->load->view('employee/footer');		
	}
	
	
	
	function details($projectid=0,$taskid=0)
	{
		$data['action'] = "details";
		
		$data['comments']= $this->qa->getdata($this->functions->decode($projectid),$this->functions->decode($taskid));
		//$data['id'] = $data['comments'][];
		$data['projects']=$this->qa->GetProjectsDetails($this->functions->decode($projectid),$this->functions->decode($taskid));
		
		
		$this->load->view('employee/header');
		$this->load->view('employee/QA/details',$data);
		$this->load->view('employee/footer');	
	}
	
	function delete_comment($id=0,$projectid=0,$taskid=0)
	{
		$this->qa->DeleteComment($id);
		$this->session->set_flashdata('notification', 
		'Comment Deleted successfully.');
		redirect('employee/qa/details/'.$this->functions->encode($projectid)."/".$this->functions->encode($taskid));	
	}
	function save_comment()
	{
		$this->qa->update_comment();
		$this->session->set_flashdata('notification', 
		'Comment Updated successfully.');
		$projectid=$this->input->post('project_id');
		$taskid=$this->input->post('task_id');
		redirect('employee/qa/details/'.$this->functions->encode($projectid)."/".$this->functions->encode($taskid));
	}
	

}