<?php
class payment_mode extends CI_Controller 
{
	function payment_mode()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->model('M_payment_mode','payment_mode');
	}
			
	function index()
	{
		$data['payment_modes']=$this->payment_mode->GetAll();
		$data['operation']='add';
		$this->load->view('admin/header');
		$this->load->view('admin/payment_mode/list',$data);
		$this->load->view('admin/footer');
	}
	
	function edit($id='')
	{
		$data['payment_modes']=$this->payment_mode->GetAll();
		$data['payment_mode']=$this->payment_mode->GetById($id);
		$data['operation']='edit';
		$this->load->view('admin/header');
		$this->load->view('admin/payment_mode/list',$data);
		$this->load->view('admin/footer');
	}
	
	//============Add Forum Page===================
	function add()
	{
		$data['payment_modes']=$this->payment_mode->GetAll();
		$data['operation']='add';
		$this->load->view('admin/header');
		$this->load->view('admin/payment_mode/list',$data);
		$this->load->view('admin/footer');
	}


	//===============================================
	
	function PaymentMode_operation()
	{
		if($this->input->post('operation')=='edit')
		{
			$this->payment_mode->Update();
			$this->session->set_flashdata('success', 
			'payment mode has been updated successfully.');
		}
		if($this->input->post('operation')=='add')
		{
			$this->payment_mode->Insert();
			$this->session->set_flashdata('success', 
			'payment mode has been added successfully.');
		}
		if($this->input->post('action')=='action_delete')
		{
			$this->payment_mode->DeleteSelected();
			$this->session->set_flashdata('success', 
			'Selected payment mode has been Deleted successfully.');
		}
		redirect('admin/payment_mode');
	}
		
	//=================================================================
	function check_type_exists($id=0) 
	{
		if (array_key_exists('Name', $_POST))
		 {
			if ($this->payment_mode->CheckExist($this->input->post('Name'),$id)>0) 
			{
				echo json_encode(FALSE);
			} 
			else 
			{
				echo json_encode(TRUE);
			}
		}
	}

}
?>