<?php
class M_Admin extends CI_Model 
{
		
	function M_Admin() 
	{
		parent::__construct();
		$this->load->library('ImageStorage');
	}
	//============  Select By Id Function ===================
    function GetById($id)
    {
		$this->db->from('users');
		$this->db->where('UserId',$id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();
    }

	 //=====================Update Personal Info===========================================================
	
	  function UpdatePersonalInfo() 
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
  
	//=====================Update Contact Info===========================================================
	
}
?>