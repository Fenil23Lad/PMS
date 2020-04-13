<?php

class Messageboard extends CI_Controller {

	function Messageboard()
	{
		parent::__construct();
		$this->administration->check_admin_login();
		$this->load->model('M_Messageboard','messageboard');	
	}
	function inbox()
	{
		$count = $this->messageboard->Inbox_CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("admin/messageboard/inbox");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
	
		$data['messages']=$this->messageboard->Inbox_GetAll($per_page_record,$page);
		$this->load->view('admin/header');
		$this->load->view('admin/messageboard/inbox',$data);
		$this->load->view('admin/footer');
	}
	//================================================================================== 
	function index()
	{	
		$count = $this->messageboard->Inbox_CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("admin/messageboard/index");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
	
		$data['messages']=$this->messageboard->Inbox_GetAll($per_page_record,$page);
		$this->load->view('admin/header');
		$this->load->view('admin/messageboard/inbox',$data);
		$this->load->view('admin/footer');
	}
	//================================================================================== 
	function sentbox()
	{	
		$count = $this->messageboard->Sentbox_CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("admin/messageboard/sentbox");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
	
		$data['messages']=$this->messageboard->Sentbox_GetAll($per_page_record,$page);
		$this->load->view('admin/header');
		$this->load->view('admin/messageboard/sentbox',$data);
		$this->load->view('admin/footer');
	}
	//================================================================================== 
	function trash()
	{	
		$count = $this->messageboard->Trash_CountAll();
		$per_page_record = 10;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("admin/messageboard/trash");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
	
		$data['messages']=$this->messageboard->Trash_GetAll($per_page_record,$page);
		$this->load->view('admin/header');
		$this->load->view('admin/messageboard/trash',$data);
		$this->load->view('admin/footer');
	}
	//================================================================================== 
	function search($all='')
    {
		if($this->input->post('search_inbox'))
		{
			$this->session->set_userdata('search_msg_inbox',$this->input->post('search_msg_inbox'));
			 redirect('admin/messageboard/index');
		}
		if($this->input->post('all_inbox') || $all=='all')
		{
			$this->session->unset_userdata('search_msg_inbox');
			redirect('admin/messageboard/index');
		}
		//----------------------------------------------------------------------
		if($this->input->post('search_sentbox'))
		{
			$this->session->set_userdata('search_msg_sentbox',$this->input->post('search_msg_sentbox'));
			 redirect('admin/messageboard/sentbox');
		}
		if($this->input->post('all_sentbox') || $all=='all')
		{
			$this->session->unset_userdata('search_msg_sentbox');
			redirect('admin/messageboard/sentbox');
		}
		//----------------------------------------------------------------------
		if($this->input->post('search_trash'))
		{
			$this->session->set_userdata('search_msg_trash',$this->input->post('search_msg_trash'));
			 redirect('admin/messageboard/trash');
		}
		if($this->input->post('all_trash') || $all=='all')
		{
			$this->session->unset_userdata('search_msg_trash');
			redirect('admin/messageboard/trash');
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
				redirect('admin/messageboard/compose/');
			}
			//-------------------------------------------------------------- 
			$res = $this->messageboard->Insert();
			if($res==true)
			{
				$this->session->set_flashdata('success','Message sent successfully.');
				redirect('admin/messageboard');
			}
			else
			{
				$this->session->set_flashdata('error',$res);
				redirect('admin/messageboard/compose/');
			}
		}
		//-------------------------------------------------------------------------
		$data['employees']=$this->messageboard->GetEmpoyee();
		$data['admins']=$this->messageboard->GetAdmin();
		$this->load->view('admin/header');
		$this->load->view('admin/messageboard/compose',$data);
		$this->load->view('admin/footer');
	}
	//================================================================================== 
	function view($type='inbox',$id='0')
	{	if($type=='inbox')
		$data['message']=$this->messageboard->Inbox_GetById($this->functions->decode($id));
		elseif($type=='sentbox')
		$data['message']=$this->messageboard->Sentbox_GetById($this->functions->decode($id));
		$data['encodeid']=$id;
		$data['type']=$type;
		$this->load->view('admin/header');
		$this->load->view('admin/messageboard/view',$data);
		$this->load->view('admin/footer');
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
				redirect('admin/messageboard/forward/'.$type.'/'.$id);
			}
			//-------------------------------------------------------------- 
			$res = $this->messageboard->Insert('forward');
			if($res==true)
			{
				$this->session->set_flashdata('success','Message sent successfully.');
				redirect('admin/messageboard');
			}
			else
			{
				$this->session->set_flashdata('error',$res);
				redirect('admin/messageboard/forward/'.$type.'/'.$id);
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
		$this->load->view('admin/header');
		$this->load->view('admin/messageboard/forward',$data);
		$this->load->view('admin/footer');
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
				redirect('admin/messageboard');
			}
			else
			{
				$this->session->set_flashdata('error',$res);
				redirect('admin/messageboard/reply/'.$type.'/'.$id);
			}
		}
		//-------------------------------------------------------------------------	

		if($type=='inbox')
		$data['message']=$this->messageboard->Inbox_GetById($this->functions->decode($id));
		elseif($type=='sentbox')
		$data['message']=$this->messageboard->Sentbox_GetById($this->functions->decode($id));
		$data['encodeid']=$id;
		$data['type']=$type;
		$this->load->view('admin/header');
		$this->load->view('admin/messageboard/reply',$data);
		$this->load->view('admin/footer');
	}
	//==================================================================
	function action()
	{
		if ($this->input->post('p_list')=='')
		{
			$this->session->set_flashdata('error','Please select atleast one Message.');
			redirect('admin/messageboard/'.$this->input->post('type'));
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
			redirect('admin/messageboard/trash');
		}
		if($this->input->post('action')=='restore_selected')
		{
			$this->messageboard->RestoreSelected($this->input->post('type'));
			$this->session->set_flashdata('success', 'Selected Messages has been Restored successfully.');
			redirect('admin/messageboard/trash');
		}
		redirect('admin/messageboard/'.$this->input->post('type'));
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
		redirect('admin/messageboard');
	}
	//==================================================================
	function movetotrash($type='inbox',$id='0')
	{
		$this->messageboard->TrashSingle($type,$this->functions->decode($id));
		$this->session->set_flashdata('success', 'Messages has been Moved to Trash.');
		redirect('admin/messageboard/'.$type);
		
	}
	//==================================================================
	function delete($type='inbox',$id='0')
	{
		$this->messageboard->DeleteSingle($type,$this->functions->decode($id));
		$this->session->set_flashdata('success', 'Messages has been Deleted Successfully.');
		redirect('admin/messageboard/trash');
		
	}
	//==================================================================
	function restore($type='inbox',$id='0')
	{
		$this->messageboard->RestoreSingle($type,$this->functions->decode($id));
		$this->session->set_flashdata('success', 'Messages has been Restored Successfully.');
		redirect('admin/messageboard/trash');
		
	}

	
}

?>