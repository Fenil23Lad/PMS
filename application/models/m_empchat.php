<?php
class M_Empchat extends CI_Model 
{
		
	function M_Empchat() 
	{
		parent::__construct();
	}
	//============  CountAll Function ===================
    
    function GetFriendList()
    {		
		$this->db->select('users.UserId,Name,Avtar,RoleName');
		$this->db->from('users');
		$this->db->join('role','users.RoleId = role.RoleId','left');
		$this->db->where('UserStatus',1);
		$this->db->where('UserId !=',$this->session->userdata('UserId'));
		$this->db->order_by("LastAccess", "desc");
		$this->db->order_by("RoleName", "asc");
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return array(); // not found
		return $query->result_array();
    }
	
  
	//========================================================
	function GetChatText($id)
	{
		$this->db->from('chat_text');
		$this->db->where('FromId',$this->session->userdata('UserId'));
		$this->db->where('ToId',$id);
		$query = $this->db->get();
		$query1 = $this->db->last_query();
		
		$this->db->from('chat_text');
		$this->db->where('FromId',$id);
		$this->db->where('ToId',$this->session->userdata('UserId'));
		$query = $this->db->get();
		$query2 = $this->db->last_query();

		$query = $this->db->query($query1." UNION ".$query2. " order by ChatTextId ASC");
		return $query->result_array();
	}
	//======================================================
	function ChatTextReadOver($id)
	{
		$this->db->set('Status', 1);
		$this->db->where('FromId',$id);
		$this->db->where('ToId',$this->session->userdata('UserId'));
		$this->db->update('chat_text');
	}
	//============  CountAll Function ===================
	function GetUser($id)
    {		
		$this->db->from('users');
		$this->db->where('users.UserId',$id);
		$query=$this->db->get();
		return $query->row_array();
    }
	//============  CountAll Function ===================
	function GetUsersStatus()
    {		
		$this->db->select('UserId,LastAccess,LoginStatus');
		$this->db->from('users');
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->result_array();
    }
	//============  Delete Chat Function ===================
	function deletechat($id)
	{
		$this->db->where('ChatTextId',$id);
		$this->db->delete('chat_text');
		
	}
	
}
?>