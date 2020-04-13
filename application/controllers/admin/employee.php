<?php
class Employee extends CI_Controller 
{
	function Employee()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->model('M_Employee','employee');
		$this->load->model('M_role','role');
	}
	//=======================================================================
	function index()
	{	

		$count = $this->employee->CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("admin/employee/index");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['records']=$this->employee->GetAll($per_page_record,$page);
		$this->load->view('admin/header');
		$this->load->view('admin/employee/list', $data);
		$this->load->view('admin/footer');
	}
	//=======================================================================
	function search($all='')
	{
		if($this->input->post('search'))
		{
			$this->session->set_userdata('search_employee',
			$this->input->post('search_employee'));
		}
		if($this->input->post('all') || $all=='all')
		{
			$this->session->unset_userdata('search_employee');
		}
		redirect('admin/employee');
	}
	//=======================================================================
	function add()
	{	
		$data['action'] = "add";
		$data['roles']=$this->role->GetRoles();
		if ($this->input->post('submit'))
		{
			$this->employee->Insert();
			$this->session->set_flashdata('notification', 
			'Employee has been Added successfully.');
			redirect('admin/employee');
		}
		$this->load->view('admin/header');
		$this->load->view('admin/employee/addedit', $data);
		$this->load->view('admin/footer');
	}
	//=======================================================================
	function edit($id='0')
	{	
		$data['action'] = "edit";
		$data['record']=$this->employee->GetById($this->functions->decode($id));
		$data['roles']=$this->role->GetRoles();
		if ($this->input->post('submit'))
		{
			$this->employee->Update();
			$this->session->set_flashdata('notification', 
			'Employee has been Updated successfully.');
			redirect('admin/employee');
		}
		$this->load->view('admin/header');
		$this->load->view('admin/employee/addedit',$data);
		$this->load->view('admin/footer');
	}	
	//=======================================================================
	function action()
	{
		if($this->input->post('action')=='action_active')
		{
			$this->employee->ChangeStatusSelected(1);
			$this->session->set_flashdata('notification', 
			'Selected employee has been Actived successfully.');
		}
		if($this->input->post('action')=='action_deactive')
		{
			$this->employee->ChangeStatusSelected(0);
			$this->session->set_flashdata('notification', 
			'Selected employee has been Deactived successfully.');
		}
		if($this->input->post('action')=='action_delete')
		{
			$this->employee->DeleteSelected();
			$this->session->set_flashdata('notification', 
			'Selected employee has been Deleted successfully.');
		}
		redirect('admin/employee');
	}	
	
	//=================================================================
	private function uname_exists($uname,$UserId)
	{
		$this->db->where('UserName', $uname);
		$this->db->where("UserId !=",$UserId);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	//=================================================================
	function register_user_exists($UserId) 
	{
		if (array_key_exists('UserName', $_POST)) 
		{
			if ($this->uname_exists($this->input->post('UserName'),$UserId) == TRUE) {
				echo json_encode(FALSE);
			} else {
				echo json_encode(TRUE);
			}
		}
	}		
}

?>