<?php
class Auto_load extends CI_Controller 
{
	
	function Auto_load()
	{
		parent::__construct();
	}		
    //===============================================================
	
	function SideBarCount()
    {		
		$this->db->from('msg_inbox');
		$this->db->where('ToId',$this->session->userdata('UserId'));
		$this->db->where('InboxStatus',0);
        $query = $this->db->get();
       	$res =  $query->num_rows();
		if($res>0)
			$data['InboxCount']= "<span class='pull-right badge'>".$res."</span>";
		else
			$data['InboxCount']= "";
			
		//-------------------------------------------------------------
			
		$this->db->from('chat_text');
		$this->db->where('ToId', $this->session->userdata('UserId'));
		$this->db->where('Status',0);
        $query = $this->db->get();
       	$res =  $query->num_rows();
		if($res>0)
		{
			$data['EmpChatCount']= "<span class='pull-right badge'>".$res."</span>";
			$data['ChatCount']= $res;
		}
		else
			$data['EmpChatCount']= "";
			
		//------------------------------------------------------------	
		
		echo json_encode($data);
    }	
	 //===============================================================
	
	function UpdateLastActivity()
	{
		$this->db->set('LastAccess',date('Y-m-d H:i:s'));
		$this->db->set('TypingStatus',0);
		$this->db->where("UserId",$this->session->userdata('UserId'));
		$this->db->update('users');	
	}
	
   //====================EMP CHAT===========================================
	
	function GetUsersStatus()
	{
		$data =array();
		$this->load->model('M_Empchat', 'chat');
		$res = $this->chat->GetUsersStatus();
		foreach($res as $user)
		{
			if(strtotime($user['LastAccess'])>(time()-30) && $user['LoginStatus']==1) // 10 second online
				$data[]=array($user['UserId'],'#090','');
			 elseif(strtotime($user['LastAccess'])>(time()-1200) && $user['LoginStatus']==1) //20 min idle
				$data[]=array($user['UserId'],'#F93',$this->functions->time_ago($user['LastAccess']));
			 else // offline
				$data[]=array($user['UserId'],'#CCC',$this->functions->time_ago($user['LastAccess']));
		}
		$result['User']=$data;
		//----------------------------------------------------
		$this->db->select('FromId, COUNT(FromId) as Total');
		$this->db->where('ToId', $this->session->userdata('UserId'));
		$this->db->where('Status',0);
		$this->db->group_by('FromId'); 
		$query=$this->db->get('chat_text');
		$result['MsgCount']=$query->result_array();
		//-----------------------------------------------------------	
		echo json_encode($result);
	}
	
	//----------------EMP------------------------------------------------
	
    function SendEmpChatText()
	{	
		$this->db->set('FromId', $this->session->userdata('UserId'));
		$this->db->set('ToId', $this->input->post('toid'));
		$this->db->set('ChatText', $this->input->post('chat_text'));
		$this->db->set('TS',date('Y-m-d H:i:s'));
		$this->db->insert('chat_text');
		echo $this->db->insert_id();
	}
	
	//----------------------------------------------------------------
	
    function FetchEmpChatText()
	{	
		$this->db->set('Status', 1);
		$this->db->where('ToId', $this->session->userdata('UserId'));
		$this->db->where('FromId', $this->input->post('from_id'));
		$this->db->where('ChatTextId >', $this->input->post('last_id'));
		$this->db->update('chat_text');
        //-----------------------------------------------------------------
		$this->db->where('ToId', $this->session->userdata('UserId'));
		$this->db->where('FromId', $this->input->post('from_id'));
		$this->db->where('ChatTextId >', $this->input->post('last_id'));
		$this->db->order_by("ChatTextId", "ASC");
		$query=$this->db->get('chat_text');
        echo json_encode($query->result_array());
	}
	
	//----------------------------------------------------------------
	
    function SendEmpChatTypingStatus($status)
	{	
		$this->db->set('TypingStatus',$status);
		$this->db->where('UserId', $this->session->userdata('UserId'));
		$this->db->update('users');
	}
	
	//----------------------------------------------------------------
	
    function FetchEmpChatTypingStatus($id)
	{	
		$this->db->where('UserId',$id);
		$this->db->where('TypingStatus', 1);
		$query = $this->db->get('users');
       	echo $query->num_rows();
	}
	
	//===================================CUST======================================
	
    function SendCustChatText()
	{	
		$this->db->set('FromId', $this->session->userdata('UserId'));
		$this->db->set('ToId', $this->input->post('toid'));
		$this->db->set('ChatText', $this->input->post('chat_text'));
		$this->db->insert('customer_chat_text');
	}
	
	//----------------------------------------------------------------
	
    function FetchCustChatText()
	{	

		$this->db->where('ToId', $this->session->userdata('UserId'));
		$this->db->where('FromId', $this->input->post('from_id'));
		$this->db->where('ChatTextId >', $this->input->post('last_id'));
		$this->db->order_by("ChatTextId", "ASC");
		$query=$this->db->get('customer_chat_text');
        echo json_encode($query->result_array());
	}
}
?>