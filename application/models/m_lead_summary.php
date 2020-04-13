<?php
class M_lead_summary extends CI_Model 
{
		
	function M_lead_summary() 
	{
		parent::__construct();
	}
	
	
	function get_count($date,$person)
	{
		$this->db->from('lead');
		$this->db->where('CreatedOn',$date);
		$this->db->where('CreatedBy',$person);
		$query = $this->db->get();
        return $query->num_rows();
	}

    function LineChart($filter)
    {
		$this->db->select('DISTINCT(CreatedOn)');
		$this->db->where('month(CreatedOn)',date('n',strtotime($filter)));
		$this->db->where('year(CreatedOn)',date('Y',strtotime($filter)));
		$this->db->from('lead');
		$this->db->order_by("CreatedOn", "ASC");
		$query=$this->db->get();
		$distinct_dates = $query->result_array();
		
		$this->db->select('DISTINCT(CreatedBy),users.Name');
		$this->db->from('lead');
		$this->db->join('users','lead.CreatedBy=users.UserId','left');
		$this->db->where('month(CreatedOn)',date('n',strtotime($filter)));
		$this->db->where('year(CreatedOn)',date('Y',strtotime($filter)));
		$query=$this->db->get();
		$distinct_person = $query->result_array();

		//-----------------------------------------------------------------
		$data =array();
		foreach($distinct_dates as $date)
		{
			$this->db->where('CreatedOn',$date['CreatedOn']);
			$this->db->from('lead');
			$query=$this->db->get();
			$record = $query->result_array();
			$tmp = array();
			$tmp['x']=date('d',strtotime($date['CreatedOn'])); 
			foreach($record as $val)
			{
				foreach($distinct_person as $k=>$person)
				{
					$this->db->from('lead');
					$this->db->where('CreatedOn',$date['CreatedOn']);
					$this->db->where('CreatedBy',$person['CreatedBy']);
					$query = $this->db->get();
					$tmp['y'.$k]= $query->num_rows();
				}
			}
			$data[] = $tmp;
		}
		//-------------------------------------------------------------
		$ykeys =array();
		$labels =array();
		$lineColors =array();
		$color = array('#CC33FF','#6666FF','#0066FF','#FF6600','#CC9900','#006600','#006666');
		foreach($distinct_person as $k=>$person)
		{
			$ykeys[] ='y'.$k;
			$labels[] =$person['Name'];
			$lineColors[] =$color[$k];
		}
		return array('data'=>$data,'ykeys'=>$ykeys,'labels'=>$labels,'lineColors'=>$lineColors);
		
    }
	//==================================================================
	function LineChart_Emp($filter)
    {
		$this->db->select('DISTINCT(CreatedOn)');
		$this->db->where('month(CreatedOn)',date('n',strtotime($filter)));
		$this->db->where('year(CreatedOn)',date('Y',strtotime($filter)));
		$this->db->where('CreatedBy',$this->session->userdata('UserId'));
		$this->db->from('lead');
		$this->db->order_by("CreatedOn", "ASC");
		$query=$this->db->get();
		$distinct_dates = $query->result_array();
		
		$this->db->select('DISTINCT(CreatedBy),users.Name');
		$this->db->from('lead');
		$this->db->join('users','lead.CreatedBy=users.UserId','left');
		$this->db->where('month(CreatedOn)',date('n',strtotime($filter)));
		$this->db->where('year(CreatedOn)',date('Y',strtotime($filter)));
		$this->db->where('CreatedBy',$this->session->userdata('UserId'));
		$query=$this->db->get();
		$distinct_person = $query->result_array();

		//-----------------------------------------------------------------
		$data =array();
		foreach($distinct_dates as $date)
		{
			$this->db->where('CreatedOn',$date['CreatedOn']);
			$this->db->from('lead');
			$query=$this->db->get();
			$record = $query->result_array();
			$tmp = array();
			$tmp['x']=date('d',strtotime($date['CreatedOn'])); 
			foreach($record as $val)
			{
				foreach($distinct_person as $k=>$person)
				{
					$this->db->from('lead');
					$this->db->where('CreatedOn',$date['CreatedOn']);
					$this->db->where('CreatedBy',$person['CreatedBy']);
					$query = $this->db->get();
					$tmp['y'.$k]= $query->num_rows();
				}
			}
			$data[] = $tmp;
		}
		//-------------------------------------------------------------
		$ykeys =array();
		$labels =array();
		$lineColors =array();
		$color = array('#CC33FF','#6666FF','#0066FF','#FF6600','#CC9900','#006600','#006666');
		foreach($distinct_person as $k=>$person)
		{
			$ykeys[] ='y'.$k;
			$labels[] =$person['Name'];
			$lineColors[] =$color[$k];
		}
		return array('data'=>$data,'ykeys'=>$ykeys,'labels'=>$labels,'lineColors'=>$lineColors);
		
    }


	         
}
?>