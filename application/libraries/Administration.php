<?php
class Administration 
{	
	function Administration()
	{
		$this->obj =& get_instance();
	}
	//================================================================
	function check_admin_login()
	{
		if($this->obj->session->userdata('UserType')==''
		    ||$this->obj->session->userdata('UserType')!='Admin')
		{
			redirect('admin/security/login');
		}
	}
	//================================================================
	function check_employee_login()
	{
		if($this->obj->session->userdata('UserType')==''
		    ||$this->obj->session->userdata('UserType')=='Admin')
		{
			redirect('employee/security/login');
		}
	}
	//================================================================
	function checkEmpTabAccess($TabName)
	{
		if(strpos($this->obj->session->userdata('TabAccess'),$TabName) !== false)
		{
			return true;
		}
	}
	//================================================================
	function validateModule($TabName)
	{
		if(strpos($this->obj->session->userdata('TabAccess'),$TabName) === false)
		{
			redirect('employee/home');
		}
	}		
}
?>