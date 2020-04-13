<?php

class Empchat extends CI_Controller {

	function Empchat()
	{
		parent::__construct();
		$this->administration->check_employee_login();
		$this->load->model('M_Empchat', 'chat');
		//$this->administration->validateModule("Employee Chat");	
	}		
	//=============================================================
	function index()
	{	
		$data['users']=$this->chat->GetFriendList();		
		$this->load->view('employee/header');
		$this->load->view('employee/emp_chat/layout',$data);
		$this->load->view('employee/footer');
	}
	//=============================================================
	function user($id='0')
	{	
		$data['users']=$this->chat->GetFriendList();
		$data['userid']=$this->functions->decode($id);	
		$this->load->view('employee/header');
		$this->load->view('employee/emp_chat/layout',$data);
		$this->load->view('employee/footer');
	}
	//=============================================================
	function ChatWindow($id='0')
	{	
		$this->chat->ChatTextReadOver($id);
		$data['user']=$this->chat->GetUser($id);
		$data['chatline']=$this->chat->GetChatText($id);		
		$this->load->view('employee/emp_chat/chat_window',$data);
	}
	function chatdelete($id=0)
	{
		$this->chat->deletechat($id);
	}

	
}

?>