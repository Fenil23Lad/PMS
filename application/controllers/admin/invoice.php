<?php
class invoice extends CI_Controller 
{
	function invoice()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->model('M_Invoice','invoice');
		$this->load->model('M_Project','project');
	}
	//=======================================================================
	function index()
	{		
		$count = $this->invoice->CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("admin/invoice/index");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['records']=$this->invoice->GetAll($per_page_record,$page);
		$userid=$this->session->userdata('UserId');
		$data['projects']=$this->project->GetProjects();
		$this->load->view('admin/header');
		$this->load->view('admin/invoice/list',$data);
		$this->load->view('admin/footer');
	}
	
	//=====================================================================
	function search($all='')
	{
		$this->session->set_userdata('search_invoice_projectid',
		$this->input->post('ProjectId'));
		
		if($this->input->post('search'))
		{
			$this->session->set_userdata('search_invoice',
			$this->input->post('search_invoice'));
		}
		if($this->input->post('all') || $all=='all')
		{
			$this->session->unset_userdata('search_invoice');
		}
		redirect('admin/invoice');
	}
	//=======================================================================
	function add($id=0)
	{	
		$data['action'] = "add";
		$data['ProjectId']=$id;
		$data['InvoiceId']=$this->invoice->fetch_last_invoice_id();
		$data['projects']=$this->project->GetProjects();
		if ($this->input->post('submit'))
		{
			if($result = $this->invoice->Insert())
			{
				$this->session->set_flashdata('notification', 'Invoice has been Generated successfully.');
				redirect('admin/invoice');
			}
		}
		$this->load->view('admin/header');
		$this->load->view('admin/invoice/addedit', $data);
		$this->load->view('admin/footer');
	}
	function edit($id='0')
	{	
		$data['action'] = "edit";
		$data['record']=$this->invoice->GetById($this->functions->decode($id));
		$data['projects']=$this->project->GetProjects();
		$data['record']['InvoiceDetails']=json_decode($data['record']['InvoiceDetails']);
		
		if ($this->input->post('submit'))
		{
			if($result = $this->invoice->Update())
			{
				
				$this->session->set_flashdata('notification', 'Invoice has been updated successfully.');
				redirect('admin/invoice');
			}
		}
		$this->load->view('admin/header');
		$this->load->view('admin/invoice/addedit',$data);
		$this->load->view('admin/footer');
	}	
	//=======================================================================
	function delete($id='0')
	{
		$this->invoice->Delete($this->functions->decode($id));
		$this->session->set_flashdata('notification', 'Invoice has been Deleted successfully.');
		redirect('admin/invoice');
	}
	function details($id=0)
	{
		$this->load->library('InvoicePdf');
		$this->db->from('invoice');
		$this->db->where('InvoiceId',$this->functions->decode($id));
		$query=$this->db->get();
		$data = $query->row_array();
		$this->invoicepdf->generatePdf($data);
	}	
	//=======================================================================
	function summary()
	{	
		$data['Projects']=$this->invoice->ProjectWiseSummary();
		$this->load->view('admin/header');
		$this->load->view('admin/invoice/summary',$data);
		$this->load->view('admin/footer');
	}
}

?>