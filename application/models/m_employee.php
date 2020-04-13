<?php
class M_Employee extends CI_Model 
{
		
	function M_Employee() 
	{
		parent::__construct();
		$this->load->library('ImageStorage');
	}
	
	//============  GetProjectAssignee Function ===================
    function GetProjectAssignee()
    {
		$this->db->select('users.Name,users.UserId,RoleName');
		$this->db->from('users');
		$this->db->join('role', 'role.RoleId = users.RoleId');
		//$this->db->where_in('RoleName',array('Team Leader','Project Manager'));		$this->db->where('role.RoleId <>',1);
		$this->db->where('UserStatus',1);
		$query=$this->db->get();
		return $query->result_array();
    } 
	
	//============  GetDevelopers Function ===================
    function GetDevelopers()
    {
		$this->db->select('users.Name,users.UserId');
		$this->db->from('users');
		$this->db->join('role', 'role.RoleId = users.RoleId','left');
		$this->db->where('role.RoleId <>',1);
		$this->db->where('users.UserStatus',1);
		$query=$this->db->get();
		return $query->result_array();
    } 
	
	//============  GetProjectManagers Function ===================
    function GetProjectManagers()
    {
		$this->db->select('users.Name,users.UserId');
		$this->db->from('users');
		$this->db->join('role', 'role.RoleId = users.RoleId','left');
		$this->db->where('RoleName','Project Manager');
		$this->db->where('UserStatus',1);
		$query=$this->db->get();
		return $query->result_array();
    }         
	
	//============  Select By Id Function ===================
    function GetById($id)
    {
		$this->db->from('users');
		$this->db->join('role', 'role.RoleId = users.RoleId','left');
		$this->db->where('UserId',$id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();
    }
   	//============  CountAll Function ===================
    
    function CountAll()
    {		
		$this->db->from('users');
		$this->db->join('role', 'role.RoleId = users.RoleId','left');
		$filterData = $this->session->userdata('search_employee');
		$where = "(RoleName <> 'Admin') and 
				   (RoleName like '%$filterData%' 
					OR  Name like '%$filterData%'
					)";
		$this->db->where($where);
		
        $query = $this->db->get();
        return $query->num_rows();
    }
	
    //============  GetAll Function ===================
    
    function GetAll($limit, $offset)
    {
		$this->db->from('users');
		$this->db->join('role', 'role.RoleId = users.RoleId','left');
		$filterData = $this->session->userdata('search_employee');
		$where = "(RoleName <> 'Admin') and 
				   (RoleName like '%$filterData%' 
					OR  Name like '%$filterData%'
					)";
		$this->db->where($where);
		$this->db->order_by("UserId", "ASC");
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
	 	$path='uploads/user_profile/';
        $name="BkImg";
		$this->db->set('RoleId', $this->input->post('RoleId'));
		$this->db->set('UserName', $this->input->post('UserName'));
		$this->db->set('Password', md5($this->input->post('Password')));
		$this->db->set('Name', $this->input->post('Name'));
		$this->db->set('Gender', $this->input->post('Gender'));
		$this->db->set('Address', $this->input->post('Address'));
		$this->db->set('Email', $this->input->post('Email'));
		$this->db->set('Phone', $this->input->post('Phone'));
		$this->db->set('UserStatus', $this->input->post('UserStatus'));
		$this->db->set('Avtar', $this->imagestorage->InsertImage($path,$name));
		$this->db->set('UserCreatedOn', date('Y-m-d H:i:s'));
		$this->db->insert('users');
		return $this->db->insert_id();
		
     }
	 
	 //============  UPDATE Function ===================
	
	 function Update() 
	 {
		$path='uploads/user_profile/';
        $name="BkImg";
		$oldimg =  $this->input->post('Himage');
		$this->db->set('RoleId', $this->input->post('RoleId'));
		$this->db->set('UserName', $this->input->post('UserName'));
		if(strlen($this->input->post('Password'))<30) // change password if new
		{
			$this->db->set('Password', md5($this->input->post('Password')));
		}
		$this->db->set('Name', $this->input->post('Name'));
		$this->db->set('Gender', $this->input->post('Gender'));
		$this->db->set('Address', $this->input->post('Address'));
		$this->db->set('Email', $this->input->post('Email'));
		$this->db->set('Phone', $this->input->post('Phone'));
		$this->db->set('UserStatus', $this->input->post('UserStatus'));
		$this->db->set('Avtar', $this->imagestorage->UpdateImage($path,$oldimg,$name));
		$this->db->where('UserId', $this->input->post('UserId'));			 
		return $this->db->update('users');
     }
	 
	 //============  UpdateProfile Function ===================
	 function UpdateProfile() 
	 {
		$path='uploads/user_profile/';
        $name="BkImg";
		$oldimg =  $this->input->post('Himage');
		$this->db->set('Name', $this->input->post('Name'));
		$this->db->set('Gender',$this->input->post('Gender'));
		$this->db->set('Address', $this->input->post('Address'));
		$this->db->set('Email', $this->input->post('Email'));
		$this->db->set('Phone', $this->input->post('Phone'));
		$this->db->set('Avtar',$this->imagestorage->UpdateImage($path,$oldimg,$name));
		$this->db->where('UserId',$this->session->userdata('UserId'));
		return $this->db->update('users');
     }
	 
	 
	 
	 
	//============  STATUS CHANGE SELECTED Function ===================
	
	function ChangeStatusSelected($status) 
	{
		$this->db->set('UserStatus', $status);
		$this->db->where_in('UserId', $this->input->post('Id_List'));
		if ($query = $this->db->update('users'))
			return true;
		else
			return false;
	}
	
	//============  DELETE SELECTED Function ===================
	
	function DeleteSelected() 
	{

		$this->db->where_in('UserId', $this->input->post('Id_List'));
		$query = $this->db->delete('users');
		return true;
	}           
}
?>