<?php

class M_Security extends CI_Model 
{

	function M_Security() 
	{
		parent::__construct();
	}
			
	//============  Login Function ===================
    function Login()
    {
		$this->db->from('users');
		$this->db->join('role', 'role.RoleId = users.RoleId');
		$this->db->where('UserName',$this->input->post('username'));
		$this->db->where("Password",md5($this->input->post('password')));
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return 'invalid'; // invalid id or password
		$result = $query->row_array();
		if($result['UserStatus']!=1)  return 'inactive'; // inactive user
		
		//-----Set session data--------------------------
		$this->session->set_userdata(array(
			'UserId'            => $result['UserId'],
			'UserName'          => $result['Name'],
			'Avtar'             => $result['Avtar'],
			'UserType'          => $result['RoleName'],
			'TabAccess'          => $result['TabAccess'],
			'LastLogin'         => date("d-M-Y",strtotime($result['LastLogin']))
		));
		
	   //------- Update Lastlogin Time ------------------
	   	
		$this->db->set('LastLogin',date('Y-m-d H:i:s'));
		$this->db->set('LastAccess',date('Y-m-d H:i:s'));
		$this->db->set('LoginStatus',1);
		$this->db->where('UserId',$result['UserId']);
		$this->db->update('users');
	   
    }
	
	//============  LogOut Function ===================
	
	function LogOut()
    {
		$this->db->set('LoginStatus',0);
		$this->db->where('UserId',$this->session->userdata('UserId'));
		$this->db->update('users');
		$this->session->sess_destroy();
	}
	  
	
	//============  GetUserInfo Function ===================
	
	function GetUserInfo($UserId=0)
    {
		$this->db->from('users');
		$this->db->join('role', 'role.RoleId = users.RoleId');
		$this->db->where("UserId",$UserId);
		$query=$this->db->get();

        if ($query->num_rows() == 0)  return false; // Email not found
		$result = $query->row_array();
		return $result ;
	}	

	//============  ChangePwd Function ===================
	
	function ChangePwd()
	{
		$this->db->from('users');
		$this->db->where("UserId",$this->session->userdata('UserId'));
		$this->db->where('Password', md5($this->input->post('Password')));
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // Email not found
		
		$this->db->set('Password',md5($this->input->post('NewPassword')));
		$this->db->where("UserId",$this->session->userdata('UserId'));
		if($this->db->update('users'))
			return true;
		else 
			 return false;
	}
	
	function Lockscreen()
    {
		$this->db->from('users');
		$this->db->join('role', 'role.RoleId = users.RoleId');
		$this->db->where('UserId',$this->input->post('userid'));
		$this->db->where("Password",md5($this->input->post('password')));
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return 'invalid'; // invalid id or password
		$result = $query->row_array();
		if($result['UserStatus']!=1)  return 'inactive'; // inactive user
		
		//-----Set session data--------------------------
		$this->session->set_userdata(array(
			'UserId'            => $result['UserId'],
			'UserName'          => $result['Name'],
			'Avtar'             => $result['Avtar'],
			'UserType'          => $result['RoleName'],
			'TabAccess'          => $result['TabAccess'],
			'LastLogin'         => date("d-M-Y",strtotime($result['LastLogin']))
		));
		
	   //------- Update Lastlogin Time ------------------
	   
    }
	
	
	//---------------------For ForgotPassword ---------------
	
	function CheckVerification($code) {
		$this->db->select('UserId');
		$this->db->where("ActivationCode", $code);
		$query=$this->db->get();
		if($query) {
			return $query[0]['UserId'];
		} else {
			return false;
		}
	}
	
}
?>