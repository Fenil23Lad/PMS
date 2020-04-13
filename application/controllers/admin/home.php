<?php
class Home extends CI_Controller 
{
	
	function Home()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->library('Excel');
		$this->load->model('M_Dashboard','Dashboard');
		$this->load->model('M_Employee','employee');
		$this->load->model('M_Project','project');
		$this->load->model('M_Task','task');
		$this->load->model('M_notice','notice');
	}		
    //===============================================================
	function index()
	{
		
		$this->load->model('M_Dashboard','Dashboard');
		$data['run_project']=$this->Dashboard->project_detail('running');
		$data['pending_project']=$this->Dashboard->project_detail('pending');
		$data['completed_project']=$this->Dashboard->project_detail('completed');
		$data['No_of_project']=$this->Dashboard->Get_No_Projects();
		$data['Notice']=$this->notice->Get();//    NOTICE
		//$data['projects']=$this->Dashboard->Get_ALL_Projects();
		$data['tasks']=$this->Dashboard->Get_USerData();
		$this->load->view('admin/header');
		$this->load->view('admin/dashboard/dashboard',$data);
		$this->load->view('admin/footer');
	}
	function project($name='')
	{
		$data['projects']=$this->Dashboard->project_detail($name);
		$this->load->view('admin/header');
		$this->load->view('admin/dashboard/project',$data);
		$this->load->view('admin/footer');	
	}
	function projectDetail($id)
	{
		$data['Project_details']=$this->Dashboard->project_desc($id);
		
		$this->db->from('invoice');
		$this->db->where('ProjectId',$id);
		$query = $this->db->get();
		$data['Project_payments']=$query->result_array();
		$this->load->view('admin/header');
		$this->load->view('admin/dashboard/projectdetails',$data);
		$this->load->view('admin/footer');	
			
	}
	function add($id=0,$from='')
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
				$this->session->set_flashdata('notification', 'Task has been added successfully.');
				$data['Project_details']=$this->Dashboard->project_desc($this->input->post('ProjectId'));
	
				$this->db->from('invoice');
				$this->db->where('ProjectId',$this->input->post('ProjectId'));
				$query = $this->db->get();
				$data['Project_payments']=$query->result_array();
				$this->load->view('admin/header');
				$this->load->view('admin/dashboard/projectdetails',$data);
				$this->load->view('admin/footer');
			}
		}
		else
		{
			$this->load->view('admin/header');
			$this->load->view('admin/task/addedit', $data);
			$this->load->view('admin/footer');
		}
	}
	function edit($id='0',$from='')
	{	
		$data['action'] = "edit";
		$data['developers']=$this->employee->GetDevelopers();
		$data['record']=$this->task->GetById($this->functions->decode($id));
		$data['projects']=$this->project->GetProjects();
		$data['from']=isset($from)?$from:'';
		if ($this->input->post('submit'))
		{
			if($result = $this->task->Update())
			{
				
				$this->session->set_flashdata('notification', 'Task has been updated successfully.');
				$data['Project_details']=$this->Dashboard->project_desc($this->input->post('ProjectId'));
	
				$this->db->from('invoice');
				$this->db->where('ProjectId',$this->input->post('ProjectId'));
				$query = $this->db->get();
				$data['Project_payments']=$query->result_array();
				$this->load->view('admin/header');
				$this->load->view('admin/dashboard/projectdetails',$data);
				$this->load->view('admin/footer');
			}
		}
		else
		{
			$this->load->view('admin/header');
			$this->load->view('admin/task/addedit',$data);
			$this->load->view('admin/footer');
		}
	}
	function delete($id='0',$pid=0)
	{
		$this->task->Delete($this->functions->decode($id));
		$this->session->set_flashdata('notification', 'Task has been Deleted successfully.');
		$data['Project_details']=$this->Dashboard->project_desc($this->functions->decode($pid));

		$this->db->from('invoice');
		$this->db->where('ProjectId',$this->functions->decode($pid));
		$query = $this->db->get();
		$data['Project_payments']=$query->result_array();
		$this->load->view('admin/header');
		$this->load->view('admin/dashboard/projectdetails',$data);
		$this->load->view('admin/footer');
	}
	function generateexcelfile($id=0)
	{
				
		$data['Project_details']=$this->Dashboard->project_desc($id);
		$data['Project_details'][0]['Proj_Created_Name']=$this->common->GetUserNameById($data['Project_details'][0]['ProjectCreatedBy']);
		
		$this->excel->createExcelFile($data);
			
		//$data['No_of_project']=$this->emp_dashboard->Get_No_Projects();
		$this->load->view('admin/header');
		$this->load->view('admin/dashboard/projectdetails',$data);
		$this->load->view('admin/footer');
	}	
	
}
?>