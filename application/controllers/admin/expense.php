<?php
class expense extends CI_Controller 
{
	function expense()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->model('M_Expense','expense');
		$this->load->model('M_Expense_Type','expense_type');
	}
	//=======================================================================
	function index()
	{	
		$count = $this->expense->CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("admin/expense/index");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		$data['records']=$this->expense->GetAll($per_page_record,$page);
		$data['ExpenseTypes']=$this->expense_type->getExpenseType();
		$this->load->view('admin/header');
		$this->load->view('admin/expense/list',$data);
		$this->load->view('admin/footer');
	}
	function search($all='')
	{
		$this->session->set_userdata('search_ExpenseTypeId',
		$this->input->post('ExpenseTypeId'));
		
		if($this->input->post('search'))
		{
			$this->session->set_userdata('search_to_expense',
			$this->input->post('search_to_expense'));
			$this->session->set_userdata('search_from_expense',
			$this->input->post('search_from_expense'));
		}
		if($this->input->post('all') || $all=='all')
		{
			$this->session->unset_userdata('search_to_expense');
			$this->session->unset_userdata('search_from_expense');
		}
		redirect('admin/expense');
	}
	
	function add()
	{	
		$data['action'] = "add";
		$data['ExpenseTypes']=$this->expense_type->getExpenseType();
		$data['Paymodes']=$this->db->get('payment_mode')->result_array();
		if ($this->input->post('submit'))
		{
			if($result = $this->expense->Insert())
			{
				$this->session->set_flashdata('notification', 'Expense has been Inserted successfully.');
				redirect('admin/expense');
			}
		}
		$this->load->view('admin/header');
		$this->load->view('admin/expense/addedit', $data);
		$this->load->view('admin/footer');
	}
	
	function edit($id)
	{	
		$data['action'] = "edit";
		$data['record']=$this->expense->GetExpenseDetailById($this->functions->decode($id));
		$data['ExpenseTypes']=$this->expense_type->getExpenseType();
		$data['Paymodes']=$this->db->get('payment_mode')->result_array();
		if ($this->input->post('submit'))
		{
			if($result = $this->expense->Update())
			{
				$this->session->set_flashdata('notification', 'Expense has been Updated successfully.');
				redirect('admin/expense');
			}
		}
		$this->load->view('admin/header');
		$this->load->view('admin/expense/addedit', $data);
		$this->load->view('admin/footer');
	}
	function delete($id)
	{
		$this->expense->Delete($this->functions->decode($id));
		$this->session->set_flashdata('notification', 'Expense has been Deleted successfully.');
		redirect('admin/expense');
	}
	//=======================================================================
	function summary()
	{	
		$data['Expenses']=$this->expense->CategoryWiseSummary();
		$this->load->view('admin/header');
		$this->load->view('admin/expense/summary',$data);
		$this->load->view('admin/footer');
	}
	//=======================================================================
	function monthly_summary($typeid=0,$month=0)
	{	

		$data['records']=$this->expense->Monthly_Summary($typeid,$month);
		$data['ExpenseTypes']=$this->expense_type->getExpenseType();
		$this->load->view('admin/header');
		$this->load->view('admin/expense/list',$data);
		$this->load->view('admin/footer');
	}				
}

?>