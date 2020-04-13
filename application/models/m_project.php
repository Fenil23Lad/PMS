<?php

class M_Project extends CI_Model 

{

		

	function M_Project() 

	{

		parent::__construct();

	}

	//============  GetProjects Function ===================

    function GetProjects()

    {

		if($this->session->userdata('UserType')=='Developer')

		{	

			$this->db->select('ProjectId');

			$this->db->from('task');

			$this->db->where('UserId',$this->session->userdata('UserId'));

			$query=$this->db->get();

			$res = $query->result_array();

			$plist=array(0);

			foreach($res as $r)

			{

			$plist[]=$r['ProjectId'];

			}

		}

		$this->db->from('project');

		//-----------------------------------------------------------------------------

		if($this->session->userdata('UserType')=='Project Manager' || $this->session->userdata('UserType')=='Admin')

		{
			$this->db->where('ProjectStatus',1);
			$this->db->like('ProjectName',$this->session->userdata('search_project'), 'both');

		}

		if($this->session->userdata('UserType')=='Team Leader')

		{

			$this->db->where('ProjectStatus',1);
			$this->db->like('ProjectName',$this->session->userdata('search_project'), 'both');

			$this->db->where('ProjectAssignedTo',$this->session->userdata('UserId'));

		}

		if($this->session->userdata('UserType')=='Developer')

		{

			$this->db->where('ProjectStatus',1);
			$this->db->where_in('ProjectId',$plist);

			$this->db->like('ProjectName',$this->session->userdata('search_project'), 'both');

		}

		

		//-----------------------------------------------------------------------------

		$query=$this->db->get();

		return $query->result_array();

    }

		

	//============  Select By Id Function ===================

    function GetById($id)

    {

		$this->db->from('project');

		$this->db->join('project_category', 

		'project.ProjectCategoryId = project_category.ProjectCategoryId','left');

		$this->db->where('ProjectId',$id);

		$query=$this->db->get();

        if ($query->num_rows() == 0)  return false; // not found

		return $query->row_array();

    }

   	//============  CountAll Function ===================

    

    function CountAll()

    {	

		if($this->session->userdata('UserType')=='Developer')

		{	

			$this->db->select('ProjectId');

			$this->db->from('task');

			$this->db->where('UserId',$this->session->userdata('UserId'));

			$query=$this->db->get();

			$res = $query->result_array();

			$plist=array(0);

			foreach($res as $r)

			{

			$plist[]=$r['ProjectId'];

			}

		}

		$this->db->from('project');

		//-----------------------------------------------------------------------------

		if($this->session->userdata('UserType')=='Project Manager')

		{

			$this->db->like('ProjectName',$this->session->userdata('search_project'), 'both');

		}

		if($this->session->userdata('UserType')=='Team Leader')

		{

			$this->db->like('ProjectName',$this->session->userdata('search_project'), 'both');

			$this->db->where('ProjectAssignedTo',$this->session->userdata('UserId'));

		}

		if($this->session->userdata('UserType')=='Developer')

		{

			$this->db->where_in('ProjectId',$plist);

			$this->db->like('ProjectName',$this->session->userdata('search_project'), 'both');

		}

		//-----------------------------------------------------------------------------

        $query = $this->db->get();

        return $query->num_rows();

    }

	

    //============  GetAll Function ===================

    

    function GetAll($limit, $offset)

    {
$plist=array(0);
		if($this->session->userdata('UserType')=='Developer' || $this->session->userdata('UserType')=='Team Leader')

		{	

			$this->db->select('ProjectId');

			$this->db->from('task');

			$this->db->where('UserId',$this->session->userdata('UserId'));

			$query=$this->db->get();

			$res = $query->result_array();

			

			foreach($res as $r)

			{

			$plist[]=$r['ProjectId'];

			}

		}
		
		$this->db->from('project');

		//-----------------------------------------------------------------------------
		
		if($this->session->userdata('UserType')=='Admin')

		{

			$this->db->like('ProjectName',$this->session->userdata('search_project'), 'both');

		}

		if($this->session->userdata('UserType')=='Project Manager' || $this->session->userdata('UserType')=='Team Leader')

		{

			$this->db->like('ProjectName',$this->session->userdata('search_project'), 'both');
			$this->db->where_in('ProjectId',$plist);
			$this->db->or_where('ProjectAssignedTo',$this->session->userdata('UserId'));

		}

		if($this->session->userdata('UserType')=='Developer')

		{

			$this->db->where_in('ProjectId',$plist);

			$this->db->like('ProjectName',$this->session->userdata('search_project'), 'both');

		}

		//-----------------------------------------------------------------------------

		$this->db->order_by("ProjectId", "DESC");

		$this->db->limit($limit, $offset);

		$query = $this->db->get();

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
		
		
	 	$pathToUpload='uploads/project_attachments/';

		$data = array();

		$data_attechment = array();

				

		if($_FILES['ProjectAttachment']['name'][0]!='')

		{

			if (!file_exists(FCPATH.$pathToUpload))

            {

                if(!mkdir(FCPATH.$pathToUpload,0777,TRUE)) 

				return 'File Destination Could not be Created.';

            }

			foreach ($_FILES['ProjectAttachment']['size'] as $file) 

			{

				if($file > 2097152)    

				return 'File too large. File must be less than 2 megabytes.'; 

			}

			foreach ($_FILES['ProjectAttachment']['tmp_name'] as $key=>$file) 

			{

				$FileName = time().'_'.$_FILES['ProjectAttachment']['name'][$key];

				if(move_uploaded_file(realpath($file),$pathToUpload.$FileName))

				$data_attechment[] = $FileName; 

			}

		}

		$attachment = implode("|",$data_attechment);

		

		$this->db->set('ProjectCategoryId', $this->input->post('ProjectCategoryId'));

		$this->db->set('ProjectName', $this->input->post('ProjectName'));

		$this->db->set('ProjectClientName', $this->input->post('ProjectClientName'));

		$this->db->set('ProjectPriority', $this->input->post('ProjectPriority'));

		$this->db->set('ProjectDesc', $this->input->post('ProjectDesc'));

		$this->db->set('ProjectAttachment', $attachment);

		

		$this->db->set('EstimateTime', $this->input->post('EstimateTime'));

		//$this->db->set('EstimateStartDate', date('Y-m-d',strtotime($this->input->post('EstimateStartDate'))));
		if(!empty($_POST['StartDate']))
		{
			$this->db->set('StartDate', date('Y-m-d h:s:i',strtotime($this->input->post('StartDate'))));
		}
		else
		{
			$this->db->set('StartDate',NULL);
		}
		if(!empty($_POST['FinishDate']))
		{
			$this->db->set('FinishDate', date('Y-m-d h:s:i',strtotime($this->input->post('FinishDate'))));
		}
		else
		{
			$this->db->set('FinishDate',NULL);
		}
		$this->db->set('ProjectAssignedTo', $this->input->post('ProjectAssignedTo'));

		$this->db->set('ProjectStage', $this->input->post('ProjectStage'));

		$this->db->set('ProjectCreatedOn',date('Y-m-d H:i:s'));

		$this->db->set('ProjectCreatedBy',$this->session->userdata('UserId'));
		$this->db->set('ProjectStatus',1);
		$this->db->insert('project');
		return $this->db->insert_id();

		

     }

	 

	 //============  UPDATE Function ===================

	

	 function Update() 

	 {

		$pathToUpload='uploads/project_attachments/';

		$data = array();

		$data_attechment = array();

				

		if($_FILES['ProjectAttachment']['name'][0]!='')

		{

			if (!file_exists(FCPATH.$pathToUpload))

            {

                if(!mkdir(FCPATH.$pathToUpload,0777,TRUE)) 

				return 'File Destination Could not be Created.';

            }

			foreach ($_FILES['ProjectAttachment']['size'] as $file) 

			{

				if($file > 2097152)    

				return 'File too large. File must be less than 2 megabytes.'; 

			}

			foreach ($_FILES['ProjectAttachment']['tmp_name'] as $key=>$file) 

			{

				$FileName = time().'_'.$_FILES['ProjectAttachment']['name'][$key];

				if(move_uploaded_file(realpath($file),$pathToUpload.$FileName))

				$data_attechment[] = $FileName; 

			}

		}

		$attachment = implode("|",$data_attechment);

		$attachment .='|'.$this->input->post('OProjectAttachment');

		$attachment = str_replace('||','|',$attachment);

		

		$this->db->set('ProjectCategoryId', $this->input->post('ProjectCategoryId'));

		$this->db->set('ProjectName', $this->input->post('ProjectName'));

		$this->db->set('ProjectClientName', $this->input->post('ProjectClientName'));

		$this->db->set('ProjectPriority', $this->input->post('ProjectPriority'));

		$this->db->set('ProjectDesc', $this->input->post('ProjectDesc'));

		$this->db->set('ProjectAttachment', $attachment);

		

		$this->db->set('EstimateTime', $this->input->post('EstimateTime'));

		if(!empty($_POST['StartDate']))
		{
			$this->db->set('StartDate', $this->input->post('StartDate'));
		}
		else
		{
			$this->db->set('StartDate',NULL);
		}
		if(!empty($_POST['FinishDate']))
		{
			$this->db->set('FinishDate', $this->input->post('FinishDate'));
		}
		else
		{
			$this->db->set('FinishDate',NULL);
		}

		$this->db->set('ProjectAssignedTo', $this->input->post('ProjectAssignedTo'));

		$this->db->set('ProjectStage', $this->input->post('ProjectStage'));

		$this->db->where('ProjectId', $this->input->post('ProjectId'));			 
		
		return $this->db->update('project');
		

     }

	 

	//============  DELETE SELECTED Function ===================

	function DeleteSelected() 

	{

		$this->db->where_in('ProjectId', $this->input->post('Id_List'));

		$query = $this->db->delete('project');

		return true;

	}
	
	//============  DELETE SELECTED Function ===================
	
	function InactiveProjectStatus($id,$status)
	{
		if($status == 'Active')
		{
			$this->db->set('ProjectStatus',1);
			$this->db->where('ProjectId',$id);
			$this->db->update('project');
		}
		else
		{
			$this->db->set('ProjectStatus',0);
			$this->db->where('ProjectId',$id);
			$this->db->update('project');
		}
		
	}
	

	     

}

?>