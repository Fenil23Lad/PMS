<?php
class M_Qa extends CI_Model 
{
		
	function M_Qa() 
	{
		parent::__construct();
	}
	function getdata($projectid,$TaskId)
    {
		$this->db->from('qa');
		$this->db->where('ProjectId',$projectid);
		$this->db->where('TaskId',$TaskId);
		$this->db->order_by('qa_id','Desc');
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->result_array();
    }
	function CountAll()
    {	
		$this->db->from('qa');
        $query = $this->db->get();
        return $query->num_rows();
    }
	function GetAll($limit, $offset,$Role)
    {
		
		if($Role['RoleName'] == "Project Manager" || $Role['RoleName'] == "Tester" && $Role['RoleStatus'] == 1)
		{
			
			$this->db->from('task');
			$this->db->join('project','project.ProjectId=task.ProjectId');
			$taskstatus="(TaskStatus='Testing' OR TaskStatus='Tested' OR TaskStatus='Bug')";
			$this->db->where($taskstatus);
			$this->db->where('project.ProjectStatus',1);
			$this->db->like('project.ProjectName',$this->session->userdata('search_project'));
			$this->db->order_by("task.TaskId", "DESC");
			$this->db->limit($limit, $offset);
		} 
		elseif($Role['RoleName'] == "Team Leader" && $Role['RoleStatus'] == 1)
		{
			$this->db->from('task');
			$this->db->join('project','project.ProjectId=task.ProjectId');
			$assign ="(project.ProjectAssignedTo=".$this->session->userdata('UserId')." OR task.UserId=".$this->session->userdata('UserId').")";
			$this->db->where($assign);
			$taskstatus="(TaskStatus='Testing' OR TaskStatus='Tested' OR TaskStatus='Bug')";
			$this->db->where($taskstatus);
			$this->db->where('project.ProjectStatus',1);
			$this->db->like('project.ProjectName',$this->session->userdata('search_project'));
			$this->db->order_by("task.TaskId", "DESC");
			$this->db->limit($limit, $offset);
				
		}
		elseif($Role['RoleName'] == "Developer" && $Role['RoleStatus'] == 1)
		{
			$this->db->from('task');
			$this->db->join('project','project.ProjectId=task.ProjectId');
			$this->db->where('task.UserId',$this->session->userdata('UserId'));
			$taskstatus="(TaskStatus='Testing' OR TaskStatus='Tested' OR TaskStatus='Bug')";
			$this->db->where($taskstatus);
			$this->db->where('project.ProjectStatus',1);
			$this->db->like('project.ProjectName',$this->session->userdata('search_project'));
			$this->db->order_by("task.TaskId", "DESC");
			$this->db->limit($limit, $offset);
		}
				
		$query = $this->db->get();
		//echo $this->db->last_query();
		//die();
        $module = array();
        if ($query->num_rows() > 0) 
        {
            $module = $query->result_array();
        }
        return $module;
    }
	
	function Insert()
	{
		
		$this->db->set('ProjectId', $this->input->post('ProjectId'));
		$this->db->set('UserId', $this->session->userdata('UserId'));
		$this->db->set('TaskId', $this->input->post('TaskId'));
		$this->db->set('Comment', $this->input->post('Comment'));
		$this->db->set('CommentCreatedOn',date('Y-m-d H:i:s'));
		$this->db->insert('qa');
		
		$this->db->set('TaskStatus', $this->input->post('status'));
		$this->db->where('ProjectId', $this->input->post('ProjectId'));
		$this->db->where('TaskId', $this->input->post('TaskId'));
		$this->db->Update('task');
		
		return $this->db->insert_id();	
	}
	function GetProjects()
	{
		$query=$this->db->query("select * from project where ProjectId in(select distinct(ProjectId) from task where TaskStatus='Testing')");
		return $query->result_array();
		
	}
	function tasklist($id)
	{
		$this->db->from('task');
		$this->db->where('ProjectId',$id);
		$this->db->where('TaskStatus','Testing');
		$query=$this->db->get();
		return $query->result_array();	
	} 
	
	function GetProjectsDetails($projectid,$taskid)
	{
		$this->db->from('project');
		$this->db->join('task','project.ProjectId=task.ProjectId');
		$this->db->where('task.ProjectId',$projectid);
		$this->db->where('task.TaskId',$taskid);
		$query=$this->db->get();
		return $query->row_array();	
	}	
	
	function TaskbyId($taskid=0)
	{
		$this->db->from('task');
		$this->db->where('TaskId',$taskid);
		$query=$this->db->get();
		return $query->result_array();		
	}
	
	function DeleteComment($id)
	{
		$this->db->where('qa_id', $id);			 
		$this->db->delete('qa');
	}
	function update_comment()
	{
		$this->db->set('Comment',$this->input->post('CommentText'));
		$this->db->where('qa_id',$this->input->post('qa_id'));
		$this->db->update('qa');
	}
	function roledetail()
	{
		$this->db->from('users');
		$this->db->join('role','users.RoleId=role.RoleId');
		$this->db->where('users.UserId',$this->session->userdata('UserId'));
		$query=$this->db->get();	
		return $query->row_array();	
	}
	
	         
}