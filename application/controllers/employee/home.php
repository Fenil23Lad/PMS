<?php
class Home extends CI_Controller 
{
	
	function Home()
	{
		parent::__construct();
		$this->administration->check_employee_login();
		$this->load->library('Excel');
		$this->load->model('M_Emp_Dashboard','emp_dashboard');
		$this->load->model('M_notice','notice');

	}		
    //===============================================================
	function index()
	{
		$data['Projects']=$this->emp_dashboard->Project_detail();
		$data['Notice']=$this->notice->Get();//    NOTICE
		$this->load->view('employee/header');
		$this->load->view('employee/dashboard/dashboard',$data);
		$this->load->view('employee/footer');
	}
	function project($id=0)
	{
		$data['Project_details']=$this->emp_dashboard->Project_detail_desc($id);
		//$data['No_of_project']=$this->emp_dashboard->Get_No_Projects();
		$this->load->view('employee/header');
		$this->load->view('employee/dashboard/project',$data);
		$this->load->view('employee/footer');
	}
	
	function generateexcelfile($id=0)
	{
				
		$data['Project_details']=$this->emp_dashboard->Project_detail_desc($id);
		$data['Project_details'][0]['Proj_Created_Name']=$this->common->GetUserNameById($data['Project_details'][0]['ProjectCreatedBy']);
		
		$this->excel->createExcelFile($data);
			
		//$data['No_of_project']=$this->emp_dashboard->Get_No_Projects();
		$this->load->view('employee/header');
		$this->load->view('employee/dashboard/project',$data);
		$this->load->view('employee/footer');
	}	
}
?>