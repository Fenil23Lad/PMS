<?php
class receipt extends CI_Controller 
{
	function receipt()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->model('M_Receipt','receipt');
		$this->load->model('M_Invoice','invoice');
		
		
	}
	//=======================================================================
	function index()
	{	
		$count = $this->receipt->CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("admin/receipt/index");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['records']=$this->receipt->GetAll($per_page_record,$page);
		$userid=$this->session->userdata('UserId');
		$this->load->view('admin/header');
		$this->load->view('admin/receipt/list',$data);
		$this->load->view('admin/footer');
	}
	function search($all='')
	{
		if($this->input->post('search'))
		{
			$this->session->set_userdata('search_to_receipt',
			$this->input->post('search_to_receipt'));
			$this->session->set_userdata('search_from_receipt',
			$this->input->post('search_from_receipt'));
		}
		if($this->input->post('all') || $all=='all')
		{
			$this->session->unset_userdata('search_to_receipt');
			$this->session->unset_userdata('search_from_receipt');
		}
		redirect('admin/receipt');
	}
	function add($invoiceno='')
	{
		$data['invoiceno'] = $invoiceno;
		$data['action'] = "add";
		$data['Invoices']=$this->receipt->getInvoice();
		$data['Paymodes']=$this->db->get('payment_mode')->result_array();
		if ($this->input->post('submit'))
		{
			if($result = $this->receipt->Insert())
			{
				$this->session->set_flashdata('notification', 'Receipt has been Generated successfully.');
				redirect('admin/receipt');
			}
		}
		$this->load->view('admin/header');
		$this->load->view('admin/receipt/addedit',$data);
		$this->load->view('admin/footer');
	}
	//=======================================================================
	function edit($id='0')
	{	
		$data['action'] = "edit";
		$data['record']=$this->receipt->GetById($this->functions->decode($id));
		$data['Invoices']=$this->receipt->getInvoice();
		$data['Paymodes']=$this->db->get('payment_mode')->result_array();
		if($this->input->post('InvoiceNo'))
		{
			$data['InvoiceNo']=$this->input->post('InvoiceNo');
			$data['InvoiceDetails']=$this->invoice->getdataby_invoice_no($this->input->post('InvoiceNo'));
		}
		
		if ($this->input->post('submit'))
		{
			if($result = $this->receipt->Update())
			{
				
				$this->session->set_flashdata('notification', 'Receipt has been updated successfully.');
				redirect('admin/receipt');
			}
		}
		$this->load->view('admin/header');
		$this->load->view('admin/receipt/addedit',$data);
		$this->load->view('admin/footer');
	}	
	//=======================================================================
	function delete($id='0')
	{
		$this->receipt->Delete($this->functions->decode($id));
		$this->session->set_flashdata('notification', 'Receipt has been Deleted successfully.');
		redirect('admin/receipt');
	}
	//=======================================================================
	function get_invoice_info()
	{
		$res =$this->invoice->getdataby_invoice_no($this->input->post('InvoiceNo'));
		echo json_encode($res);
	}		
}

?>