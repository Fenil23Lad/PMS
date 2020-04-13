<?php
class Product extends CI_Controller 
{
	function Product()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->model('M_Product','product');
	}
	//=======================================================================
	function index()
	{	

		$count = $this->product->CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("admin/product/index");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['records']=$this->product->GetAll($per_page_record,$page);
		$this->load->view('admin/header');
		$this->load->view('admin/product/list', $data);
		$this->load->view('admin/footer');
	}
	//=======================================================================
	function search()
	{
		if($this->input->post('search'))
		{
			$this->session->set_userdata('search_product',
			$this->input->post('search_product'));
		}
		if($this->input->post('all'))
		{
			$this->session->unset_userdata('search_product');
		}
		redirect('admin/product');
	}
	//=======================================================================
	function add()
	{	
		$data['action'] = "add";
		if ($this->input->post('submit'))
		{
			if($result = $this->product->Insert())
			{
				$this->session->set_flashdata('notification', 'Product has been added successfully.');
				redirect('admin/product');
			}
		}
		$this->load->view('admin/header');
		$this->load->view('admin/product/addedit', $data);
		$this->load->view('admin/footer');
	}
	//=======================================================================
	function edit($id='0')
	{	
		$data['action'] = "edit";
		$data['record']=$this->product->GetById($this->functions->decode($id));
		if ($this->input->post('submit'))
		{
			if($result = $this->product->Update())
			{
				$this->session->set_flashdata('notification', 'Product has been updated successfully.');
				redirect('admin/product');
			}
		}
		$this->load->view('admin/header');
		$this->load->view('admin/product/addedit',$data);
		$this->load->view('admin/footer');
	}	
	//=======================================================================
	function action()
	{
		if($this->input->post('action')=='action_active')
		{
			$this->service->ChangeStatusSelected(1);
			$this->session->set_flashdata('notification', 'Selected Product has been Published successfully.');
		}
		if($this->input->post('action')=='action_deactive')
		{
			$this->service->ChangeStatusSelected(0);
			$this->session->set_flashdata('notification', 'Selected Product has been Unpublished successfully.');
		}
		if($this->input->post('action')=='action_delete')
		{
			$this->service->DeleteSelected();
			$this->session->set_flashdata('notification', 'Selected Product has been Deleted successfully.');
		}
		redirect('admin/product');
	}			
}

?>