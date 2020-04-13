<?php
class M_lead extends CI_Model 
{
		
	function M_lead() 
	{
		parent::__construct();
	}
	
	//============  Select By Id Function ===================
    function GetById($id)
    {
		$this->db->from('lead');
		$this->db->where('Id',$id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();
    }

	//============  CountAll Function ===================
    
    function CountAll()
    {		
		$this->db->select('lead.*,users.Name');
		$this->db->from('lead');
		$this->db->join('users','lead.CreatedBy=users.UserId','left');
		$filterData = $this->session->userdata('search_lead');
		$where =  "( users.Name like '%$filterData%' 
					OR  lead.Industry like '%$filterData%'
					OR  lead.Company like '%$filterData%'
					OR  lead.ContactName like '%$filterData%'
					OR lead.LeadSource like '%$filterData%'
					OR lead.LeadStage like '%$filterData%'
					)";
		$this->db->where($where);
		
        $query = $this->db->get();
        return $query->num_rows();
    }
	
    //============  GetAll Function ===================
    
    function GetAll($limit, $offset)
    {
		$this->db->select('lead.*,users.Name');
		$this->db->from('lead');
		$this->db->join('users','lead.CreatedBy=users.UserId','left');
		$filterData = $this->session->userdata('search_lead');
		$where =  "( users.Name like '%$filterData%' 
					OR  lead.Industry like '%$filterData%'
					OR  lead.Company like '%$filterData%'
					OR  lead.ContactName like '%$filterData%'
					OR lead.LeadSource like '%$filterData%'
					OR lead.LeadStage like '%$filterData%'
					)";
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by("lead.Id", "DESC");
		$query = $this->db->get();
        $module = array();
        if ($query->num_rows() > 0) 
        {
            $module = $query->result_array();
        }
        return $module;
    } 
	
	
	//============  CountAll Function ===================
    
    function CountAllEmp()
    {		
		$this->db->from('lead');
		$filterData = $this->session->userdata('search_lead');
		$where =  "(CreatedBy=".$this->session->userdata('UserId').")and( 
		            lead.Industry like '%$filterData%'
					OR  lead.Company like '%$filterData%'
					OR  lead.ContactName like '%$filterData%'
					OR lead.LeadSource like '%$filterData%'
					OR lead.LeadStage like '%$filterData%'
					)";
		$this->db->where($where);
        $query = $this->db->get();
        return $query->num_rows();
    }
	
    //============  GetAll Function ===================
    
    function GetAllEmp($limit, $offset)
    {
		$this->db->from('lead');
		$filterData = $this->session->userdata('search_lead');
		$where =  "(CreatedBy=".$this->session->userdata('UserId').")and( 
		            lead.Industry like '%$filterData%'
					OR  lead.Company like '%$filterData%'
					OR  lead.ContactName like '%$filterData%'
					OR lead.LeadSource like '%$filterData%'
					OR lead.LeadStage like '%$filterData%'
					)";
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by("lead.Id", "DESC");
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
		
		$this->db->set('Industry', $this->input->post('Industry'));
		$this->db->set('Company', $this->input->post('Company'));
		$this->db->set('Title', $this->input->post('Title'));
		$this->db->set('ContactName', $this->input->post('ContactName'));
		$this->db->set('Email', $this->input->post('Email'));
		$this->db->set('Website', $this->input->post('Website'));
		$this->db->set('Mobile', $this->input->post('Mobile'));
		$this->db->set('LandLine', $this->input->post('LandLine'));
		$this->db->set('Address', $this->input->post('Address'));
		$this->db->set('Area', $this->input->post('Area'));
		$this->db->set('City', $this->input->post('City'));
		$this->db->set('Zipcode', $this->input->post('Zipcode'));
		$this->db->set('LeadSource', $this->input->post('LeadSource'));
		$this->db->set('LeadStage', $this->input->post('LeadStage'));
		$this->db->set('CreatedBy', $this->session->userdata('UserId'));
		$this->db->set('CreatedOn',date('Y-m-d'));

		$this->db->insert('lead');
		
     }
	 
	 //============  UPDATE Function ===================
	
	 function Update() 
	 { 
		$this->db->set('Industry', $this->input->post('Industry'));
		$this->db->set('Company', $this->input->post('Company'));
		$this->db->set('Title', $this->input->post('Title'));
		$this->db->set('ContactName', $this->input->post('ContactName'));
		$this->db->set('Email', $this->input->post('Email'));
		$this->db->set('Website', $this->input->post('Website'));
		$this->db->set('SkypId', $this->input->post('SkypId'));
		$this->db->set('Mobile', $this->input->post('Mobile'));
		$this->db->set('LandLine', $this->input->post('LandLine'));
		$this->db->set('Address', $this->input->post('Address'));
		$this->db->set('Area', $this->input->post('Area'));
		$this->db->set('City', $this->input->post('City'));
		$this->db->set('Zipcode', $this->input->post('Zipcode'));
		$this->db->set('LeadSource', $this->input->post('LeadSource'));
		$this->db->set('LeadStage', $this->input->post('LeadStage'));
		$this->db->set('LastVisitOn',$this->input->post('LastVisitOn')==''?null:date('Y-m-d', strtotime($this->input->post('LastVisitOn'))));
		$this->db->set('NextVisitOn',$this->input->post('NextVisitOn')==''?null:date('Y-m-d', strtotime($this->input->post('NextVisitOn'))));	
		$this->db->where('Id', $this->input->post('Id'));			 
		$this->db->update('lead');
	
     }


	//============  DELETE SELECTED Function ===================
	
	function DeleteSelected() 
	{
		$this->db->where_in('Id', $this->input->post('Id_List'));
		$query = $this->db->delete('lead');
		$this->db->where_in('leadId', $this->input->post('Id_List'));
		$query = $this->db->delete('note');
		return true;
	}           
}
?>