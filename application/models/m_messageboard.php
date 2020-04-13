<?php
class M_Messageboard extends CI_Model 
{
		
	function M_Messageboard() 
	{
		parent::__construct();
	}
	
	//============  CountAll Function ===================
    
    function Inbox_CountAll()
    {		
		$this->db->from('msg_inbox');
		$this->db->join('users', 'users.UserId = msg_inbox.FromId','left');
		$filterData = $this->session->userdata('search_msg_inbox');
		$where = "(InboxStatus <> 2) and (ToId=".$this->session->userdata('UserId').") 
		            and ( Name like '%$filterData%'
					OR  Subject like '%$filterData%'
					OR  Message like '%$filterData%'
				 )";
		$this->db->where($where);

        $query = $this->db->get();
        return $query->num_rows();
    }
	
    //============  GetAll Function ===================
    
    function Inbox_GetAll($limit, $offset)
    {
		$this->db->select('InboxId,FromId,Subject,Message,Attachment,Date,InboxStatus,Name,Avtar');
		$this->db->from('msg_inbox');
		$this->db->join('users', 'users.UserId = msg_inbox.FromId','left');
		$filterData = $this->session->userdata('search_msg_inbox');
		$where = "(InboxStatus <> 2) and (ToId=".$this->session->userdata('UserId').") 
		            and ( Name like '%$filterData%'
					OR  Subject like '%$filterData%'
					OR  Message like '%$filterData%'
				 )";
		$this->db->where($where);
		$this->db->order_by("InboxId", "desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
        $module = array();
        if ($query->num_rows() > 0) 
        {
            $module = $query->result_array();
        }
        return $module;
    }
	
	
	//============  CountAll Function ===================
    
    function Trash_CountAll()
    {		
		$this->db->from('msg_inbox');
		$this->db->join('users', 'users.UserId = msg_inbox.FromId','left');
		$filterData = $this->session->userdata('search_msg_trash');
		$where = "(InboxStatus = 2) and (ToId=".$this->session->userdata('UserId').") 
		            and ( Name like '%$filterData%'
					OR  Subject like '%$filterData%'
					OR  Message like '%$filterData%'
				 )";
		$this->db->where($where);
        $query = $this->db->get();
        $a = $query->num_rows();
		
		$this->db->from('msg_sentbox');
		$this->db->join('users', 'users.UserId = msg_sentbox.ToId','left');
		$filterData = $this->session->userdata('search_msg_trash');
		$where = "(SentboxStatus = 2) and (FromId=".$this->session->userdata('UserId').") 
		            and ( Name like '%$filterData%'
					OR  Subject like '%$filterData%'
					OR  Message like '%$filterData%'
					)";
		$this->db->where($where);
		$this->db->where($where);
        $query = $this->db->get();
        $b = $query->num_rows();
		
		return $a+$b;
    }
	
    //============  GetAll Function ===================
    
    function Trash_GetAll($limit, $offset)
    {
		$this->db->select('InboxId,FromId,ToId,Subject,Message,Attachment,Date,InboxStatus,Type,Name,Avtar');
		$this->db->from('msg_inbox');
		$this->db->join('users', 'users.UserId = msg_inbox.FromId','left');
		$filterData = $this->session->userdata('search_msg_trash');
		$where = "(InboxStatus = 2) and (ToId=".$this->session->userdata('UserId').") 
		            and ( Name like '%$filterData%'
					OR  Subject like '%$filterData%'
					OR  Message like '%$filterData%'
				 )";
				 
		$this->db->where($where);
		$query = $this->db->get();
		$query1 = $this->db->last_query();
		
		$this->db->select('SentboxId as InboxId,FromId,ToId,Subject,Message,Attachment,Date,SentboxStatus as InboxStatus,Type,Name,Avtar');
		$this->db->from('msg_sentbox');
		$this->db->join('users', 'users.UserId = msg_sentbox.ToId','left');
		$filterData = $this->session->userdata('search_msg_trash');
		$where = "(SentboxStatus = 2) and (FromId=".$this->session->userdata('UserId').") 
		            and ( Name like '%$filterData%'
					OR  Subject like '%$filterData%'
					OR  Message like '%$filterData%'
					)";
		$this->db->where($where);		
		$query = $this->db->get();
		$query2 =  $this->db->last_query();
		$query = $this->db->query($query1." UNION ".$query2. " order by Date desc LIMIT $limit OFFSET $offset");
		return $query->result_array();
		
    }
	
	
	//============  CountAll Function ===================
    
    function Sentbox_CountAll()
    {		
		$this->db->from('msg_sentbox');
		$this->db->join('users', 'users.UserId = msg_sentbox.ToId','left');
		$filterData = $this->session->userdata('search_msg_sentbox');
		$where = "(SentboxStatus <> 2) and (FromId=".$this->session->userdata('UserId').") 
		            and ( Name like '%$filterData%'
					OR  Subject like '%$filterData%'
					OR  Message like '%$filterData%'
					)";
		$this->db->where($where);
		
        $query = $this->db->get();
        return $query->num_rows();
    }
	
    //============  GetAll Function ===================
    
    function Sentbox_GetAll($limit, $offset)
    {
		$this->db->select('SentboxId,ToId,Subject,Message,Attachment,Date,SentboxStatus,Name,Avtar');
		$this->db->from('msg_sentbox');
		$this->db->join('users', 'users.UserId = msg_sentbox.ToId','left');
		$filterData = $this->session->userdata('search_msg_sentbox');
		$where = "(SentboxStatus <> 2) and (FromId=".$this->session->userdata('UserId').") 
		            and ( Name like '%$filterData%'
					OR  Subject like '%$filterData%'
					OR  Message like '%$filterData%'
					)";
		$this->db->where($where);
		$this->db->order_by("SentboxId", "desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
        $module = array();
        if ($query->num_rows() > 0) 
        {
            $module = $query->result_array();
        }
        return $module;
    }
	
	//============  Inbox_GetById Function ===================
    
    function Inbox_GetById($id)
    {
		$this->db->from('msg_inbox');
		$this->db->join('users', 'users.UserId = msg_inbox.FromId','left');
		$this->db->where('InboxId',$id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();
    }
	
	//============  Sentbox_GetById Function ===================
    
    function Sentbox_GetById($id)
    {
		$this->db->from('msg_sentbox');
		$this->db->join('users', 'users.UserId = msg_sentbox.ToId','left');
		$this->db->where('SentboxId',$id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();
    }
	
	//==============================Get Employee Info==================================================
	function GetEmpoyee()
	{
		$this->db->select('users.UserId, Name, Email, RoleName');
		$this->db->from('users');
		$this->db->join('role', 'role.RoleId = users.RoleId','left');
		$this->db->where("role.RoleName != 'Admin'");
		$query=$this->db->get();
        if ($query->num_rows() == 0)   return array(); // not found
		return $query->result_array();
	}
	
	//==============================Get Admin Info==================================================
	function GetAdmin()
	{
		$this->db->select('users.UserId, Name, Email, RoleName');
		$this->db->from('users');
		$this->db->join('role', 'role.RoleId = users.RoleId','left');
		$this->db->where("role.RoleName = 'Admin'");
		$query=$this->db->get();
        if ($query->num_rows() == 0)   return array(); // not found
		return $query->result_array();
	}
	
	//============  Insert Function ===================
    
    function Insert($type='')
    {		
		$pathToUpload='uploads/message_attachments/';
		$data = array();
		$data_attechment = array();
				
		if($_FILES['Attachment']['name'][0]!='')
		{
			if (!file_exists(FCPATH.$pathToUpload))
            {
                if(!mkdir(FCPATH.$pathToUpload,0777,TRUE)) 
				return 'File Destination Could not be Created.';
            }
			foreach ($_FILES['Attachment']['size'] as $file) 
			{
				if($file > 2097152)    
				return 'File too large. File must be less than 2 megabytes.'; 
			}
			foreach ($_FILES['Attachment']['tmp_name'] as $key=>$file) 
			{
				$FileName = time().'_'.$_FILES['Attachment']['name'][$key];
				if(move_uploaded_file(realpath($file),$pathToUpload.$FileName))
				$data_attechment[] = $FileName; 
			}
		}
		
		$attachment = implode("|",$data_attechment);
		if($type=='forward')$attachment .='|'.$this->input->post('OAttachment');

		foreach($this->input->post('Toid') as $to)
		{
			$data[] = array(
							'FromId'         =>     $this->session->userdata('UserId'),
							'ToId'           =>     $to,
							'Subject'        =>     $this->input->post('Subject'),
							'Message'        =>     $this->input->post('Message'),
							'Attachment'     =>     $attachment
			);
		}
		
		
		
		
		$this->db->trans_start(TRUE);
        $this->db->insert_batch('msg_inbox',$data);
		$this->db->insert_batch('msg_sentbox',$data);
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE)
		return "Data Could not Inserted.";
		return true;
       }  
 
	//============================================================
	function ReadNew($id)
	{
		$this->db->set('InboxStatus',1);
		$this->db->where('InboxId',$id);
		$query = $this->db->update('msg_inbox');
	}
	//=============================================================
	function UnreadSingle($id) 
	{
		$this->db->set('InboxStatus',0);
		$this->db->where('InboxId', $id);
		$query = $this->db->update('msg_inbox');
	}
	//=============================================================
	function UnreadSelected() 
	{
		$this->db->set('InboxStatus',0);
		$this->db->where_in('InboxId', $this->input->post('p_list'));
		$query = $this->db->update('msg_inbox');
	}
	//=============================================================
	function TrashSelected($type='inbox') 
	{
		if($type=='inbox')
		{
			$this->db->set('InboxStatus',2);
			$this->db->where_in('InboxId', $this->input->post('p_list'));
			$query = $this->db->update('msg_inbox');
		}
		if($type=='sentbox')
		{
			$this->db->set('SentboxStatus',2);
			$this->db->where_in('SentboxId', $this->input->post('p_list'));
			$query = $this->db->update('msg_sentbox');
		}
	}
	//=============================================================
	function TrashSingle($type='inbox',$id) 
	{
		if($type=='inbox')
		{
			$this->db->set('InboxStatus',2);
			$this->db->where('InboxId', $id);
			$query = $this->db->update('msg_inbox');
		}
		if($type=='sentbox')
		{
			$this->db->set('SentboxStatus',2);
			$this->db->where('SentboxId', $id);
			$query = $this->db->update('msg_sentbox');
		}
	}
	//=============================================================
	function RestoreSelected($type='inbox') 
	{ 
		foreach($this->input->post('p_list') as $list)
		{
			$item = explode("|",$list);
			if($item[1]==0)
			{
				$this->db->set('InboxStatus',1);
				$this->db->where_in('InboxId',$item[0]);
				$query = $this->db->update('msg_inbox');
			}
			else
			{
				$this->db->set('SentboxStatus',1);
				$this->db->where_in('SentboxId',$item[0]);
				$query = $this->db->update('msg_sentbox');
			}
		}
	}
	//=============================================================
	function RestoreSingle($type='inbox',$id) 
	{
		if($type=='inbox')
		{
			$this->db->set('InboxStatus',1);
			$this->db->where('InboxId', $id);
			$query = $this->db->update('msg_inbox');
		}
		if($type=='sentbox')
		{
			$this->db->set('SentboxStatus',1);
			$this->db->where('SentboxId', $id);
			$query = $this->db->update('msg_sentbox');
		}
	}
	//=============================================================
	function DeleteSelected($type='inbox') 
	{
		foreach($this->input->post('p_list') as $list)
		{
			$item = explode("|",$list);
			if($item[1]==0)
			{
				$this->db->where_in('InboxId',$item[0]);
				$query = $this->db->delete('msg_inbox');
			}
			else
			{
				$this->db->where_in('SentboxId',$item[0]);
				$query = $this->db->delete('msg_sentbox');
			}
		}
	}	
	//=============================================================
	function DeleteSingle($type='inbox',$id) 
	{
		if($type=='inbox')
		{
			$this->db->where_in('InboxId',$id);
			$query = $this->db->delete('msg_inbox');
		}
		if($type=='sentbox')
		{
			$this->db->where_in('SentboxId',$id);
			$query = $this->db->delete('msg_sentbox');
		}
	}
}
?>