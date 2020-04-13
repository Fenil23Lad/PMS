<?php
class notice extends CI_Controller 
{
	function notice()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->model('M_Notice','notice');
		$this->load->model('M_role','role');
	}
	//=======================================================================
	function index()
	{	
		$count = $this->notice->CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("admin/notice/index");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['record']=$this->notice->GetAll($per_page_record,$page);
		$this->load->view('admin/header');
		$this->load->view('admin/notice/list', $data);
		$this->load->view('admin/footer');
	}
	//=======================================================================
	function search($all='')
	{
		if($this->input->post('search'))
		{
			$this->session->set_userdata('search_notice',$this->input->post('search_notice'));
		}
		if($this->input->post('all') || $all=='all')
		{
			$this->session->unset_userdata('search_notice');
		}
		redirect('admin/notice');
	}
	//=======================================================================
	function add()
	{	
		$data['action'] = "add";
		if ($this->input->post('submit'))
		{
			$this->notice->Insert();
			$this->session->set_flashdata('notification','Notce has been Added successfully.');
			redirect('admin/notice');
		}
		$this->load->view('admin/header');
		$this->load->view('admin/notice/addedit', $data);
		$this->load->view('admin/footer');
	}
	//=======================================================================
	function edit($id='0')
	{	
		$data['action'] = "edit";
		$data['record']=$this->notice->GetById($this->functions->decode($id));
		if ($this->input->post('submit'))
		{
			$this->notice->Update();
			$this->session->set_flashdata('notification', 'Notice has been Updated successfully.');
			redirect('admin/notice');
		}
		$this->load->view('admin/header');
		$this->load->view('admin/notice/addedit',$data);
		$this->load->view('admin/footer');
	}	
	//=======================================================================
	function delete($id='0')
	{
		$this->notice->Delete($this->functions->decode($id));
		$this->session->set_flashdata('notification', 'Notice has been Deleted successfully.');
		redirect('admin/notice');
	}
	//=======================================================================
	function action()
	{
		if($this->input->post('action')=='action_active')
		{
			$this->notice->ChangeStatusSelected(1);
			$this->session->set_flashdata('notification', 
			'Selected notice has been Actived successfully.');
		}
		if($this->input->post('action')=='action_deactive')
		{
			$this->notice->ChangeStatusSelected(0);
			$this->session->set_flashdata('notification', 
			'Selected notice has been Deactived successfully.');
		}
		if($this->input->post('action')=='action_delete')
		{
			$this->notice->DeleteSelected();
			$this->session->set_flashdata('notification', 
			'Selected notice has been Deleted successfully.');
		}
		redirect('admin/notice');
	}	
			
}

?>