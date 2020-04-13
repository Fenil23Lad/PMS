<?php
class AccessControl extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
		$this->administration->check_admin_login();
    }
    
    public function index()
    {
		$this->load->model('M_role','role');
		$data['roles']=$this->role->GetRoles();
		
		if($this->input->post('btn_save'))
		{
			$this->db->set('TabAccess', implode("|",$this->input->post('TabName')));	
			$this->db->where('RoleId', $this->input->post('RoleId'));
			$this->db->update('role');
			$this->session->set_flashdata('notification','Module  Access Saved Successfully.');
		 	redirect('admin/accesscontrol');
		}
		
		$this->load->view('admin/header');
		$this->load->view('admin/accesscontrol/layout',$data);
		$this->load->view('admin/footer');
    }
	
	public function tabs($id=0)
    {
			
		$this->db->where('RoleId',$id);
		$query = $this->db->get('role');
        $data['Role']=$query->row_array();       
		$this->load->view('admin/accesscontrol/list',$data);

    }
}
