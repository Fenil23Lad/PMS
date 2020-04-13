<?php

class Messageboard extends CI_Controller {

	function Messageboard()
	{
		parent::__construct();
		$this->administration->check_employee_login();
		$this->load->model('M_Messageboard','messageboard');	
	}
	function inbox()
	{
		$count = $this->messageboard->Inbox_CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("employee/messageboard/inbox");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
	
		$data['messages']=$this->messageboard->Inbox_GetAll($per_page_record,$page);
		$this->load->view('employee/header');
		$this->load->view('employee/messageboard/inbox',$data);
		$this->load->view('employee/footer');
	}
	//================================================================================== 
	function index()
	{	
		$count = $this->messageboard->Inbox_CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("employee/messageboard/index");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
	
		$data['messages']=$this->messageboard->Inbox_GetAll($per_page_record,$page);
		$this->load->view('employee/header');
		$this->load->view('employee/messageboard/inbox',$data);
		$this->load->view('employee/footer');
	}
	//================================================================================== 
	function sentbox()
	{	
		$count = $this->messageboard->Sentbox_CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("employee/messageboard/sentbox");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
	
		$data['messages']=$this->messageboard->Sentbox_GetAll($per_page_record,$page);
		$this->load->view('employee/header');
		$this->load->view('employee/messageboard/sentbox',$data);
		$this->load->view('employee/footer');
	}
	//================================================================================== 
	function trash()
	{	
		$count = $this->messageboard->Trash_CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("employee/messageboard/trash");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
	
		$data['messages']=$this->messageboard->Trash_GetAll($per_page_record,$page);
		$this->load->view('employee/header');
		$this->load->view('employee/messageboard/trash',$data);
		$this->load->view('employee/footer');
	}
	//================================================================================== 
	function search($all='')
    {
		if($this->input->post('search_inbox'))
		{
			$this->session->set_userdata('search_msg_inbox',$this->input->post('search_msg_inbox'));
			 redirect('employee/messageboard/index');
		}
		if($this->input->post('all_inbox') || $all=='all')
		{
			$this->session->unset_userdata('search_msg_inbox');
			redirect('employee/messageboard/index');
		}
		//----------------------------------------------------------------------
		if($this->input->post('search_sentbox'))
		{
			$this->session->set_userdata('search_msg_sentbox',$this->input->post('search_msg_sentbox'));
			 redirect('employee/messageboard/sentbox');
		}
		if($this->input->post('all_sentbox') || $all=='all')
		{
			$this->session->unset_userdata('search_msg_sentbox');
			redirect('employee/messageboard/sentbox');
		}
		//----------------------------------------------------------------------
		if($this->input->post('search_trash'))
		{
			$this->session->set_userdata('search_msg_trash',$this->input->post('search_msg_trash'));
			 redirect('employee/messageboard/trash');
		}
		if($this->input->post('all_trash') || $all=='all')
		{
			$this->session->unset_userdata('search_msg_trash');
			redirect('employee/messageboard/trash');
		}
    }
	//================================================================================== 
	function compose()
	{	
		if ($this->input->post('submit'))
		{
			$ToList = $this->input->post('Toid');
			if (empty($ToList))
			{
				$this->session->set_flashdata('error', 
				'Please select atleast one Recipient to send this message.');
				redirect('employee/messageboard/compose/');
			}
			//-------------------------------------------------------------- 
			$res = $this->messageboard->Insert();
			if($res==true)
			{
				$this->session->set_flashdata('success','Message sent successfully.');
				redirect('employee/messageboard');
			}
			else
			{
				$this->session->set_flashdata('error',$res);
				redirect('employee/messageboard/compose/');
			}
		}
		//-------------------------------------------------------------------------
		$data['employees']=$this->messageboard->GetEmpoyee();
		$data['admins']=$this->messageboard->GetAdmin();
		$this->load->view('employee/header');
		$this->load->view('employee/messageboard/compose',$data);
		$this->load->view('employee/footer');
	}
	//================================================================================== 
	function view($type='inbox',$id='0')
	{	if($type=='inbox')
		$data['message']=$this->messageboard->Inbox_GetById($this->functions->decode($id));
		elseif($type=='sentbox')
		$data['message']=$this->messageboard->Sentbox_GetById($this->functions->decode($id));
		$data['encodeid']=$id;
		$data['type']=$type;
		$this->load->view('employee/header');
		$this->load->view('employee/messageboard/view',$data);
		$this->load->view('employee/footer');
	}
	//================================================================================== 
	function forward($type='inbox',$id='0')
	{	
		if ($this->input->post('submit'))
		{
			$ToList = $this->input->post('Toid');
			if (empty($ToList))
			{
				$this->session->set_flashdata('error', 
				'Please select atleast one Recipient to send this message.');
				redirect('employee/messageboard/forward/'.$type.'/'.$id);
			}
			//-------------------------------------------------------------- 
			$res = $this->messageboard->Insert('forward');
			if($res==true)
			{
				$this->session->set_flashdata('success','Message sent successfully.');
				redirect('employee/messageboard');
			}
			else
			{
				$this->session->set_flashdata('error',$res);
				redirect('employee/messageboard/forward/'.$type.'/'.$id);
			}
		}
		//-------------------------------------------------------------------------	

		if($type=='inbox')
		$data['message']=$this->messageboard->Inbox_GetById($this->functions->decode($id));
		elseif($type=='sentbox')
		$data['message']=$this->messageboard->Sentbox_GetById($this->functions->decode($id));
		$data['employees']=$this->messageboard->GetEmpoyee();
		$data['admins']=$this->messageboard->GetAdmin();
		$data['encodeid']=$id;
		$data['type']=$type;
		$this->load->view('employee/header');
		$this->load->view('employee/messageboard/forward',$data);
		$this->load->view('employee/footer');
	}
	//================================================================================== 
	function reply($type='inbox',$id='0')
	{	
		if ($this->input->post('submit'))
		{
			$res = $this->messageboard->Insert();
			if($res==true)
			{
				$this->session->set_flashdata('success','Message sent successfully.');
				redirect('employee/messageboard');
			}
			else
			{
				$this->session->set_flashdata('error',$res);
				redirect('employee/messageboard/reply/'.$type.'/'.$id);
			}
		}
		//-------------------------------------------------------------------------	

		if($type=='inbox')
		$data['message']=$this->messageboard->Inbox_GetById($this->functions->decode($id));
		elseif($type=='sentbox')
		$data['message']=$this->messageboard->Sentbox_GetById($this->functions->decode($id));
		$data['encodeid']=$id;
		$data['type']=$type;
		$this->load->view('employee/header');
		$this->load->view('employee/messageboard/reply',$data);
		$this->load->view('employee/footer');
	}
	//==================================================================
	function action()
	{
		if ($this->input->post('p_list')=='')
		{
			$this->session->set_flashdata('error','Please select atleast one Message.');
			redirect('employee/messageboard/'.$this->input->post('type'));
		}
		if($this->input->post('action')=='unread_selected')
		{
			$this->messageboard->UnreadSelected();
		}
		if($this->input->post('action')=='trash_selected')
		{
			$this->messageboard->TrashSelected($this->input->post('type'));
			$this->session->set_flashdata('success', 'Selected Messages has been Moved to Trash.');
		}
		if($this->input->post('action')=='delete_selected')
		{
			$this->messageboard->DeleteSelected($this->input->post('type'));
			$this->session->set_flashdata('success', 'Selected Messages has been Deleted successfully.');
			redirect('employee/messageboard/trash');
		}
		if($this->input->post('action')=='restore_selected')
		{
			$this->messageboard->RestoreSelected($this->input->post('type'));
			$this->session->set_flashdata('success', 'Selected Messages has been Restored successfully.');
			redirect('employee/messageboard/trash');
		}
		redirect('employee/messageboard/'.$this->input->post('type'));
	}
	//==================================================================
	function read_new($id='0')
	{
		$this->messageboard->ReadNew($id);
	}
	//==================================================================
	function markunread($id='0')
	{
		$this->messageboard->UnreadSingle($this->functions->decode($id));
		redirect('employee/messageboard');
	}
	//==================================================================
	function movetotrash($type='inbox',$id='0')
	{
		$this->messageboard->TrashSingle($type,$this->functions->decode($id));
		$this->session->set_flashdata('success', 'Messages has been Moved to Trash.');
		redirect('employee/messageboard/'.$type);
		
	}
	//==================================================================
	function delete($type='inbox',$id='0')
	{
		$this->messageboard->DeleteSingle($type,$this->functions->decode($id));
		$this->session->set_flashdata('success', 'Messages has been Deleted Successfully.');
		redirect('employee/messageboard/trash');
		
	}
	//==================================================================
	function restore($type='inbox',$id='0')
	{
		$this->messageboard->RestoreSingle($type,$this->functions->decode($id));
		$this->session->set_flashdata('success', 'Messages has been Restored Successfully.');
		redirect('employee/messageboard/trash');
		
	}

	
}

?>