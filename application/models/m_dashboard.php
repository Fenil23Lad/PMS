<?php
class M_Dashboard extends CI_Model 
{
	
	function M_Dashboard() 
	{
		parent::__construct();
	}
	
	function Get_No_Projects()
    {
		$this->db->from('project');
		$query=$this->db->get();
		return $query->num_rows();
    }
	
	function project_detail($name)
	{
		if($name == 'running')
		{
			$this->db->from('project');
			$this->db->where('ProjectStage <>','Delivered');
			$this->db->where('ProjectStage <>','Requirment Collected');
			$query=$this->db->get();
		}
		elseif($name == 'pending')
		{
			$this->db->from('project');
			$this->db->where('ProjectStage','Requirment Collected');
			$query=$this->db->get();
		}
		elseif($name == 'completed')
		{
			$this->db->from('project');
			$this->db->where('ProjectStage','Delivered');
			$query=$this->db->get();
		}
		$projects=$query->result_array();
		$temp_project=array();
		
		foreach($projects as $key=>$project)
		{
			$temp_project[]=$project;
			
			//============= For Project Category 
			
			$this->db->from('project_category');
			$this->db->where('ProjectCategoryId',$project['ProjectCategoryId']);
			$query=$this->db->get();
			$project_cat=$query->result_array();
			$temp_project[$key]['ProjectCategoryName']=$project_cat[0]['ProjectCategoryName'];
			
			//============= For Project Total Task & For Calculate the Total Hrs.
			
			$query=$this->db->query("select count(TaskId) Total_Task,sum(TaskEstimateTime) Total_Time from task where ProjectId=".$project['ProjectId']);
			$total_task=$query->result_array();
			$temp_project[$key]['total_task']=$total_task[0]['Total_Task'];
			$temp_project[$key]['total_time_hr']=$total_task[0]['Total_Time'];
			
			//===== For Project Completed Task & For Calculate the Total Complete Works Hrs.
			
			$query=$this->db->query("select count(TaskId) Comp_Task,sum(TaskFinishTime) Compelete_Time from task where ProjectId=".$project['ProjectId']. " and TaskPercentage=100");
			$total_comp_task=$query->result_array();
			$temp_project[$key]['total_compelete_task']=$total_comp_task[0]['Comp_Task'];
			$temp_project[$key]['compelete_time_hr']=$total_comp_task[0]['Compelete_Time'];
		
		
		}
		return $temp_project;
	}
	
	function Get_USerData()
	{
		$query="select users.*,role.RoleName from role join users On role.RoleId=users.RoleId where users.UserName != 'Admin' order by users.UserId ";
		$query=$this->db->query($query);
		$tasks=$query->result_array();
		$temp=array();
		foreach($tasks as $key=>$task)
		{
			
			$temp[]=$task;
			// ====== For Total Task assign To user ================== //
			$task_total="select count(UserId) as task_total from task where UserId=".$task['UserId'];
			$a_task=$this->db->query($task_total);
			$b_task=$a_task->result_array();
			$temp[$key]['total_task']=$b_task[0]['task_total'];
			
			// ====== For Total Completed Task by user ================== //
			$task_c_total="select count(UserId) as complete_task from task where UserId=".$task['UserId']." and TaskPercentage=100";
			$a_comp_task=$this->db->query($task_c_total);
			$b_comp_task=$a_comp_task->result_array();
			$temp[$key]['total_complete_task']=$b_comp_task[0]['complete_task'];
			
		}
		return $temp;
	}
	
	function project_desc($id)
	{
		
		$query=$this->db->query("select p.*,c.* from project p join project_category c on p.ProjectCategoryId=c.ProjectCategoryId where p.ProjectId=".$id); 
		$project_desc=$query->result_array();
	
		
		foreach($project_desc as $key=>$project)
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
			return $project_desc;
	}
				
}