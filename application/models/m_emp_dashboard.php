<?php
class M_Emp_Dashboard extends CI_Model 
{
	
	function M_Emp_Dashboard() 
	{
		parent::__construct();
	}
	
	//=====================================================================================
	function Project_detail()
	{
		//======= For Find a Role Of the USer 
		$this->db->select('users.RoleId,role.RoleName');
		$this->db->from('users');
		$this->db->join('role','users.RoleId=role.RoleId');
		$this->db->where('users.USerId',$this->session->userdata('UserId'));
		$query = $this->db->get();
    	$Role_Name=$query->result_array();
		
		//======= For Unique Project Id
		/*if($Role_Name[0]['RoleName'] == 'Project Manager')
		{
			$query=$this->db->query("select ProjectId from project where ProjectStage != 'Delivered' and ProjectStatus = 1 order by ProjectId Desc ");
			$Tasks=$query->result_array();
		}
		else*/if($Role_Name[0]['RoleName'] == 'Team Leader' || $Role_Name[0]['RoleName'] == 'Project Manager')
		{
			$query=$this->db->query("select ProjectId from project where ProjectStatus=1 and (ProjectId In(select distinct(ProjectId) ProjectId from task where TaskPercentage != 100 and (TaskAssignedBy=".$this->session->userdata('UserId')." or UserId=".$this->session->userdata('UserId')."))) or ProjectAssignedTo=".$this->session->userdata('UserId')." order by ProjectId Desc");
			$Tasks=$query->result_array();
		}
		else
		{
			$query=$this->db->query("select ProjectId from project where ProjectStatus=1 and ProjectId In(select distinct(ProjectId) ProjectId from task where UserId=".$this->session->userdata('UserId')." and TaskPercentage != 100) order by ProjectId Desc ");
			$Tasks=$query->result_array();
		}
		//echo "".$this->db->last_query();
		$project_details=array();

		foreach($Tasks as $key=>$Task)
		{
			//======= For Project & Category Details
			$query=$this->db->query("select p.*,c.* from project p join project_category c on p.ProjectCategoryId=c.ProjectCategoryId where p.ProjectId=".$Task['ProjectId']);
			$project_details[$key]=$query->result_array();
			
			
			
			if($Role_Name[0]['RoleName'] == 'Project Manager')
			{
				//===== For Count Total Task
				
				$query=$this->db->query("select count(TaskId) Total_Task from task where ProjectId=".$Task['ProjectId']);
				$Total_task=$query->result_array();
				$project_details[$key]['total_task']=$Total_task[0]['Total_Task'];
				
				//====== For Count Complete Task	
				$query=$this->db->query("select count(TaskId) Complete_Task from task where ProjectId=".$Task['ProjectId']." and TaskPercentage=100");
				$Total_comp_task=$query->result_array();
				$project_details[$key]['complete_task']=$Total_comp_task[0]['Complete_Task'];
			}
			elseif($Role_Name[0]['RoleName'] == 'Team Leader')
			{
				$query=$this->db->query("select count(TaskId) Total_Task from task where ProjectId=".$Task['ProjectId']." and (TaskAssignedBy=".$this->session->userdata('UserId')." or UserId=".$this->session->userdata('UserId').")");
				$Total_task=$query->result_array();
				$project_details[$key]['total_task']=$Total_task[0]['Total_Task'];
				
				//====== For Count Complete Task	
				$query=$this->db->query("select count(TaskId) Complete_Task from task where ProjectId=".$Task['ProjectId']." and TaskPercentage=100 and (TaskAssignedBy=".$this->session->userdata('UserId')." or UserId=".$this->session->userdata('UserId').")");
				$Total_comp_task=$query->result_array();
				$project_details[$key]['complete_task']=$Total_comp_task[0]['Complete_Task'];	
			}
			else
			{
			//===== For Count Total Task
				$query=$this->db->query("select count(TaskId) Total_Task from task where ProjectId=".$Task['ProjectId']." and UserId=".$this->session->userdata('UserId'));
				$Total_task=$query->result_array();
				$project_details[$key]['total_task']=$Total_task[0]['Total_Task'];
				
				//====== For Count Complete Task	
				$query=$this->db->query("select count(TaskId) Complete_Task from task where ProjectId=".$Task['ProjectId']." and UserId=".$this->session->userdata('UserId')." and TaskPercentage=100");
				$Total_comp_task=$query->result_array();
				$project_details[$key]['complete_task']=$Total_comp_task[0]['Complete_Task'];
			
			}
		}
		return $project_details;
	}
	
	
	function Project_detail_desc($id)
	{
		$this->db->select('users.RoleId,role.RoleName');
		$this->db->from('users');
		$this->db->join('role','users.RoleId=role.RoleId');
		$this->db->where('users.USerId',$this->session->userdata('UserId'));
		$query = $this->db->get();
    	$Role_Name=$query->result_array();
		
		$query=$this->db->query("select p.*,c.* from project p join project_category c on p.ProjectCategoryId=c.ProjectCategoryId where p.ProjectId=".$id); 
		$project_desc=$query->result_array();
	
		
		foreach($project_desc as $key=>$project)
		{
			// For Count Total Task
			
			if($Role_Name[0]['RoleName'] == 'Project Manager' || $Role_Name[0]['RoleName'] == 'Team Leader')
			{
				$query=$this->db->query("select count(TaskId) Total_Task from task where ProjectId=".$id);
			$Total_task=$query->result_array();
			$project_desc[$key]['total_task']=$Total_task[0]['Total_Task'];
			
			// For Running Task	Details
			
			$query=$this->db->query("select * from task where ProjectId=".$id." and TaskPercentage!=100");
			$run_task=$query->result_array();
			$project_desc[$key]['run_task_details']=$run_task;
			
			// For Completed Task Details & count Complete task 
			
			$query=$this->db->query("select * from task where ProjectId=".$id." and TaskPercentage=100");
			$complete_task=$query->result_array();
			$project_desc[$key]['complete_task_details']=$complete_task;
			$project_desc[$key]['complete_task']=count($complete_task);
			}
			elseif($Role_Name[0]['RoleName'] == 'Team Leader')
			{
				$query=$this->db->query("select count(TaskId) Total_Task from task where ProjectId=".$id." and (UserId=".$this->session->userdata('UserId')." or TaskAssignedBy=".$this->session->userdata('UserId').")");
			$Total_task=$query->result_array();
			$project_desc[$key]['total_task']=$Total_task[0]['Total_Task'];
			
			// For Running Task	Details
			
			$query=$this->db->query("select * from task where ProjectId=".$id." and TaskPercentage!=100 and (UserId=".$this->session->userdata('UserId')." or TaskAssignedBy=".$this->session->userdata('UserId').")");
			$run_task=$query->result_array();
			$project_desc[$key]['run_task_details']=$run_task;
			
			// For Completed Task Details & count Complete task 
			
			$query=$this->db->query("select * from task where ProjectId=".$id." and TaskPercentage=100 and (UserId=".$this->session->userdata('UserId')." or TaskAssignedBy=".$this->session->userdata('UserId').")");
			$complete_task=$query->result_array();
			$project_desc[$key]['complete_task_details']=$complete_task;
			$project_desc[$key]['complete_task']=count($complete_task);
			}
			else
			{
			$query=$this->db->query("select count(TaskId) Total_Task from task where ProjectId=".$id." and UserId=".$this->session->userdata('UserId'));
			$Total_task=$query->result_array();
			$project_desc[$key]['total_task']=$Total_task[0]['Total_Task'];
			
			// For Running Task	Details
			
			$query=$this->db->query("select * from task where ProjectId=".$id." and UserId=".$this->session->userdata('UserId')." and TaskPercentage!=100");
			$run_task=$query->result_array();
			$project_desc[$key]['run_task_details']=$run_task;
			
			// For Completed Task Details & count Complete task 
			
			$query=$this->db->query("select * from task where ProjectId=".$id." and UserId=".$this->session->userdata('UserId')." and TaskPercentage=100");
			$complete_task=$query->result_array();
			$project_desc[$key]['complete_task_details']=$complete_task;
			$project_desc[$key]['complete_task']=count($complete_task);
			}
			
		}
		return $project_desc;
			
	}
	
}