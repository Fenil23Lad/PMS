<?php
class M_Task extends CI_Model 
{
		
	function M_Task() 
	{
		parent::__construct();
	}		
	//============  Select By Id Function ===================
    function GetById($id)
    {
		$this->db->from('task');
		$this->db->join('project','project.ProjectId=task.ProjectId');
		$this->db->where('TaskId',$id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();
    }
   	//============  CountAll Function ===================
    
    function CountAll()
    {	
		$data=$this->session->userdata('search_task_projectid');
		$usertype=$this->session->userdata('UserType');
		$userid=$this->session->userdata('UserId');
		$this->db->from('task');
		$this->db->join('project','project.ProjectId=task.ProjectId');
		$this->db->where('project.ProjectStatus','1');
		//-----------------------------------------------------------------------------
		$this->db->like('TaskName',$this->session->userdata('search_task'), 'both');
		if(!empty($data))
		{
			$this->db->where('project.ProjectId',$data);
		}
		if($usertype =='Developer')
		{
			$this->db->where('UserId',$userid);
		}
		//-----------------------------------------------------------------------------
        $query = $this->db->get();
        return $query->num_rows();
    }
	
    //============  GetAll Function ===================
    
    function GetAll($limit, $offset)
    {
		$data=$this->session->userdata('search_task_projectid');
		$usertype=$this->session->userdata('UserType');
		$userid=$this->session->userdata('UserId');
		$this->db->from('task');
		$this->db->join('project','project.ProjectId=task.ProjectId');
		$this->db->where('project.ProjectStatus','1');
		//$this->db->where('UserId',$userid);
		//-----------------------------------------------------------------------------
		$this->db->like('TaskName',$this->session->userdata('search_task'), 'both');
		if(!empty($data))
		{
			$this->db->where('project.ProjectId',$data);
		}
		if($usertype =='Admin')
		{
				
		}
		else if($usertype =='Team Leader')
		{
			$condition="(TaskAssignedBy =".$userid." OR UserId=".$userid." OR project.ProjectAssignedTo =".$userid.")";
			$this->db->where($condition);
			//$this->db->where('TaskAssignedBy',$userid);
			//$this->db->or_where('UserId',$userid);
			
		}
		else
		{
			$condition="(UserId=".$userid." OR project.ProjectAssignedTo =".$userid.")";
			$this->db->where($condition);
			//$this->db->where('TaskAssignedBy',$userid);
			//$this->db->or_where('UserId',$userid);
			
		}
		//-----------------------------------------------------------------------------
		$this->db->order_by("TaskId", "DESC");
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		//echo "===>".$this->db->last_query();
     //  echo $this->session->userdata('UserType')."===>".$this->db->last_query();
		
	    $module = array();
        if ($query->num_rows() > 0) 
        {
            $module = $query->result_array();
        }
		return $module;
    }
	 
	//============  INSERT Function ===================
	
	 function Insert() 
	 {			
	 	$pathToUpload='uploads/task_attachments/';
		$data = array();
		$data_attechment = array();
				
		if($_FILES['TaskAttachment']['name'][0]!='')
		{
			if (!file_exists(FCPATH.$pathToUpload))
            {
                if(!mkdir(FCPATH.$pathToUpload,0777,TRUE)) 
				return 'File Destination Could not be Created.';
            }
			foreach ($_FILES['TaskAttachment']['size'] as $file) 
			{
				if($file > 2097152)    
				return 'File too large. File must be less than 2 megabytes.'; 
			}
			foreach ($_FILES['TaskAttachment']['tmp_name'] as $key=>$file) 
			{
				$FileName = time().'_'.$_FILES['TaskAttachment']['name'][$key];
				if(move_uploaded_file(realpath($file),$pathToUpload.$FileName))
				$data_attechment[] = $FileName; 
			}
		}
		$attachment = implode("|",$data_attechment);
		//-----------------------------------------------------------
		
		$init_code = "AA0001";
		$this->db->select_max('TaskNo');
		$query = $this->db->get('task');
		if ($query->num_rows() > 0) 
		{
			$dt = $query->row_array();
			$TaskNo = $dt['TaskNo'];
			if(!empty($TaskNo))
			{
				$TaskNo++;
				$init_code = $TaskNo;
			}
		}
		//------------------------------------------------------------ 
		$this->db->set('TaskNo', $init_code); // letest new Task number
		$this->db->set('ProjectId', $this->input->post('ProjectId'));
		$this->db->set('UserId', $this->input->post('UserId'));
		$this->db->set('TaskPriority', $this->input->post('TaskPriority'));
		$this->db->set('TaskName', $this->input->post('TaskName'));
		$this->db->set('TaskDesc', $this->input->post('TaskDesc'));
		$this->db->set('TaskAttachment', $attachment);
		$this->db->set('TaskEstimateTime', $this->input->post('TaskEstimateTime'));
		$this->db->set('TaskAssignedOn',date('Y-m-d H:i:s'));
		$this->db->set('TaskAssignedBy',$this->session->userdata('UserId'));
		$this->db->set('TaskStatus','Pending');
		$this->db->insert('task');
		return $this->db->insert_id();
		
     }
	 
	 //============  UPDATE Function ===================
	
	 function Update() 
	 {
	 	$pathToUpload='uploads/task_attachments/';
		$data = array();
		$data_attechment = array();
				
		if($_FILES['TaskAttachment']['name'][0]!='')
		{
			if (!file_exists(FCPATH.$pathToUpload))
            {
                if(!mkdir(FCPATH.$pathToUpload,0777,TRUE)) 
				return 'File Destination Could not be Created.';
            }
			foreach ($_FILES['TaskAttachment']['size'] as $file) 
			{
				if($file > 2097152)    
				return 'File too large. File must be less than 2 megabytes.'; 
			}
			foreach ($_FILES['TaskAttachment']['tmp_name'] as $key=>$file) 
			{
				$FileName = time().'_'.$_FILES['TaskAttachment']['name'][$key];
				if(move_uploaded_file(realpath($file),$pathToUpload.$FileName))
				$data_attechment[] = $FileName; 
			}
		}
		$attachment = implode("|",$data_attechment);
		$attachment .='|'.$this->input->post('OTaskAttachment');
		$attachment = str_replace('||','|',$attachment);
		$this->db->set('ProjectId', $this->input->post('ProjectId'));
		$this->db->set('UserId', $this->input->post('UserId'));
		$this->db->set('TaskPriority', $this->input->post('TaskPriority'));
		$this->db->set('TaskName', $this->input->post('TaskName'));
		$this->db->set('TaskDesc', $this->input->post('TaskDesc'));
		$this->db->set('TaskAttachment', $attachment);
		$this->db->set('TaskEstimateTime', $this->input->post('TaskEstimateTime'));
		$this->db->where('TaskId', $this->input->post('TaskId'));			 
		return $this->db->update('task');
     }
	 
	 //============  Submit Function ===================
	
	 function Submit() 
	 {
		$this->db->set('TaskFinishTime', $this->input->post('TaskFinishTime'));
		$this->db->set('TaskStatus', $this->input->post('TaskStatus'));
		$this->db->set('TaskPercentage', $this->input->post('TaskPercentage'));
		$this->db->where('TaskId', $this->input->post('TaskId'));			 
		return $this->db->update('task');
     }
	 
	 //============  InsertComment Function ===================
	
	 function InsertComment() 
	 {		
	 	$pathToUpload='uploads/comment_attachments/';
		$data = array();
		$data_attechment = array();
				
		if($_FILES['CommentAttachment']['name'][0]!='')
		{
			if (!file_exists(FCPATH.$pathToUpload))
            {
                if(!mkdir(FCPATH.$pathToUpload,0777,TRUE)) 
				return 'File Destination Could not be Created.';
            }
			foreach ($_FILES['CommentAttachment']['size'] as $file) 
			{
				if($file > 2097152)    
				return 'File too large. File must be less than 2 megabytes.'; 
			}
			foreach ($_FILES['CommentAttachment']['tmp_name'] as $key=>$file) 
			{
				$FileName = time().'_'.$_FILES['CommentAttachment']['name'][$key];
				if(move_uploaded_file(realpath($file),$pathToUpload.$FileName))
				$data_attechment[] = $FileName; 
			}
		}
		$attachment = implode("|",$data_attechment);
		//-------------------------------------------------------------------------
	 	
		$this->db->set('ParentId', $this->input->post('ParentId'));
		$this->db->set('TaskId', $this->input->post('TaskId'));
		$this->db->set('CommentText', $this->input->post('CommentText'));
		$this->db->set('CommentCreatedOn',date('Y-m-d H:i:s'));
		$this->db->set('CommentCreatedBy',$this->session->userdata('UserId'));
		$this->db->set('CommentAttachment',$attachment);
		$this->db->insert('comment');
     }
	 	 
	//=====================================================
	
    function GetComments($TaskId=0,$PerentId=0)
    {
		$this->db->from('comment');
		$this->db->where("ParentId",$PerentId);
		$this->db->where("TaskId",$TaskId);
		$query = $this->db->get();
		if ($query->num_rows() == 0)  return array(); // not found
		return  $query->result_array();
    } 
	
	//=====================================================
	
    function EditComment()
    {
		$pathToUpload='uploads/comment_attachments/';
		$data = array();
		$data_attechment = array();		
		if($_FILES['CommentAttachment']['name'][0]!='')
		{
			if (!file_exists(FCPATH.$pathToUpload))
            {
                if(!mkdir(FCPATH.$pathToUpload,0777,TRUE)) 
				return 'File Destination Could not be Created.';
            }
			foreach ($_FILES['CommentAttachment']['size'] as $file) 
			{
				if($file > 2097152)    
				return 'File too large. File must be less than 2 megabytes.'; 
			}
			foreach ($_FILES['CommentAttachment']['tmp_name'] as $key=>$file) 
			{
				$FileName = time().'_'.$_FILES['CommentAttachment']['name'][$key];
				if(move_uploaded_file(realpath($file),$pathToUpload.$FileName))
				$data_attechment[] = $FileName; 
			}
		}
		$attachment = implode("|",$data_attechment);
		$attachment .='|'.$this->input->post('OCommentAttachment');
		$attachment = str_replace('||','|',$attachment);
		$attachment = str_replace('||','|',$attachment);
		$RemoveAtt=$this->input->post('RemoveAttachment');
		$RemoveAttchment=explode('|',$RemoveAtt);
		for($i=0;$i<count($RemoveAttchment);$i++)
		{
			if(!empty($RemoveAttchment[$i]))
			{
				if(file_exists('uploads/comment_attachments/'.$RemoveAttchment[$i]))
				{
					unlink('uploads/comment_attachments/'.$RemoveAttchment[$i]);	
				}	
			}	
		}
		
		
		$this->db->set('CommentText', $this->input->post('CommentText'));
		$this->db->set('CommentAttachment', $attachment);
		$this->db->where('CommentId', $this->input->post('CommentId'));			 
		$this->db->update('comment');
    } 
	
	//=====================================================
	
    function DeleteComment($cid)
    {
		$this->db->from('comment');
		$this->db->where("CommentId",$cid);
		$query = $this->db->get();
		if ($query->num_rows() == 0)  return array(); // not found
		$Attch= $query->result_array();	
		$Attchments=explode('|',$Attch[0]['CommentAttachment']);
		
		for($i=0;$i<count($Attchments);$i++)
		{
			if(file_exists('uploads/comment_attachments/'.$Attchments[$i]))
			{
				unlink('uploads/comment_attachments/'.$Attchments[$i]);	
			}
		}
		$this->db->where('ParentId', $cid);			 
		$this->db->delete('comment');
		$this->db->where('CommentId', $cid);			 
		$this->db->delete('comment');
    } 
	
	//============  DELETE SELECTED Function ===================
	
	function Delete($id) 
	{
		$this->db->where('TaskId',$id);
		$query = $this->db->delete('task');
		return true;
	}
	function getrole($uid)
	{
		$this->db->select('role.RoleName');
		$this->db->from('role');
		$this->db->join('users','users.RoleId=role.RoleId');
		$this->db->where('users.UserId',$uid);
		$query = $this->db->get();
		return  $query->row_array();	
	}  
	//==================By Me===================================
	
    function GetAllComments($TaskId=0)
    {
		$this->db->from('comment');
		$this->db->where("TaskId",$TaskId);
		$query = $this->db->get();
		if ($query->num_rows() == 0)  return array(); // not found
		return  $query->result_array();
    }   
	
	function GetCommentdta($id)
	{
		$this->db->from('comment');
		$this->db->where("CommentId",$id);
		$query = $this->db->get();
		if ($query->num_rows() == 0)  return array(); // not found
		return  $query->result_array();	
	}      
}
?>