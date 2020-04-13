<?php
class report extends CI_Controller 
{
	function report()
	{
		parent::__construct();
		$this->administration->check_admin_login();
	}
	//=======================================================================
	function index()
	{	
		
		$this->load->view('admin/header');
		$this->load->view('admin/report/index');
		$this->load->view('admin/footer');
	}		
}

?>