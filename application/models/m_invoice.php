<?php

class M_Invoice extends CI_Model 

{

		

	function M_Invoice() 

	{

		parent::__construct();

	}

	function GetById($id)

	{

		$this->db->from('invoice');

		$this->db->where('InvoiceId',$id);

		$query=$this->db->get();

        if ($query->num_rows() == 0)  return false; // not found

		return $query->row_array();	

	}

	function fetch_last_invoice_id()

	{

		$init_code = "101";

		$this->db->select_max('InvoiceNo');

		$query = $this->db->get('invoice');

		if ($query->num_rows() > 0) 

		{

			$dt = $query->row_array();

			$acno = $dt['InvoiceNo'];

			if(!empty($acno))

			{

				$acno++;

				$init_code = $acno;

			}

		}

		return $init_code; 

		

	}

	function CountAll()

    {	

		$data=$this->session->userdata('search_invoice_projectid');

		$usertype=$this->session->userdata('UserType');

		$userid=$this->session->userdata('UserId');

		$this->db->from('invoice');

		$this->db->like('InvoiceNo',$this->session->userdata('search_invoice'), 'both');

		if($data)

		{

			$this->db->where('ProjectId',$data);

		}

        $query = $this->db->get();

        return $query->num_rows();

    }

	

    //============  GetAll Function ===================

    

    function GetAll($limit, $offset)

    {

		$data=$this->session->userdata('search_invoice_projectid');

		$usertype=$this->session->userdata('UserType');

		$userid=$this->session->userdata('UserId');

		$this->db->from('invoice');

		$this->db->like('InvoiceNo',$this->session->userdata('search_invoice'), 'both');

		if($data)

		{

			$this->db->where('ProjectId',$data);

		}

		$this->db->order_by("InvoiceId", "DESC");

		$this->db->limit($limit, $offset);

		$query = $this->db->get();

        $module = array();

        if ($query->num_rows() > 0) 

        {

            $module = $query->result_array();

        }

		return $module;

    }

	function Insert()

	{

		$Desc=$this->input->post('Desc');

		$Unit=$this->input->post('Unit');

		$Amount=$this->input->post('Amount');

		$cnt=count($Desc);

		$details=array();

		$amt =0;

		for($i=0;$i<$cnt;$i++)

		{

			$amt+=$Amount[$i];

			$details[]=array($Desc[$i],$Unit[$i],$Amount[$i]);

		}

		$this->db->set('InvoiceNo',$this->input->post('InvoiceNo'));

		$this->db->set('ProjectId',$this->input->post('ProjectId'));

		$this->db->set('From',$this->input->post('From'));

		$this->db->set('ToAddress',$this->input->post('ToAddress'));

		$this->db->set('InvoiceDate',date('Y-m-d',strtotime($this->input->post('InvoiceDate'))));

		$this->db->set('IECode',$this->input->post('IECode'));

		$this->db->set('SalesPerson',$this->input->post('SalesPerson'));

		$this->db->set('PONumber',$this->input->post('PONumber'));

		$this->db->set('ShippedVia',$this->input->post('ShippedVia'));

		$this->db->set('Currency',$this->input->post('Currency'));

		$this->db->set('Terms',$this->input->post('Terms'));

		$this->db->set('InvoiceDetails',json_encode($details));

		$this->db->set('Amount',$amt);

		$this->db->set('DueDay',$this->input->post('DueDay'));

		$this->db->insert('invoice');

		return $this->db->insert_id();

	}

	function Update($id)

	{

		$Desc=$this->input->post('Desc');

		$Unit=$this->input->post('Unit');

		$Amount=$this->input->post('Amount');

		$cnt=count($Desc);

		$details=array();

		$amt =0;

		for($i=0;$i<$cnt;$i++)

		{

			$amt+=$Amount[$i];

			$details[]=array($Desc[$i],$Unit[$i],$Amount[$i]);

		}

		$this->db->set('InvoiceNo',$this->input->post('InvoiceNo'));

		$this->db->set('ProjectId',$this->input->post('ProjectId'));

		$this->db->set('From',$this->input->post('From'));

		$this->db->set('ToAddress',$this->input->post('ToAddress'));

		$this->db->set('InvoiceDate',date('Y-m-d',strtotime($this->input->post('InvoiceDate'))));

		$this->db->set('IECode',$this->input->post('IECode'));

		$this->db->set('SalesPerson',$this->input->post('SalesPerson'));

		$this->db->set('PONumber',$this->input->post('PONumber'));

		$this->db->set('ShippedVia',$this->input->post('ShippedVia'));

		$this->db->set('Currency',$this->input->post('Currency'));

		$this->db->set('Terms',$this->input->post('Terms'));

		$this->db->set('InvoiceDetails',json_encode($details));

		$this->db->set('Amount',$amt);

		$this->db->set('DueDay',$this->input->post('DueDay'));

		$this->db->where('InvoiceId',$this->input->post('InvoiceId'));

		return $this->db->update('invoice');

	}

	//==========================================

	function Delete($id) 

	{

		$this->db->where('InvoiceId',$id);

		$query = $this->db->delete('invoice');

		return true;

	}

	//==========================================

	function getdataby_invoice_no($id)

	{

		$this->db->select('invoice.*,project.ProjectName');

		$this->db->from('invoice');

		$this->db->join('project','invoice.ProjectId=project.ProjectId');

		$this->db->where('InvoiceNo',$id);

		$query = $this->db->get();

		return $query->result_array();

	}

	

	//==========================================

	function getReceivedAmt($projectId)

	{

		$this->db->select('Sum(receipt.Amount) As Sum_Amount');

		$this->db->from('receipt');

		$this->db->join('invoice','invoice.InvoiceNo = receipt.InvoiceNo');

		$this->db->where('ProjectId',$projectId);

		$query = $this->db->get();

		$res = $query->row_array();

		return $res['Sum_Amount']==''?0:$res['Sum_Amount'];

		

	}

	//==========================================

	function ProjectWiseSummary()

	{

		$this->db->select('Sum(Amount) As Sum_Amount,project.ProjectId,project.ProjectName');

		$this->db->from('invoice');

		$this->db->join('project','invoice.ProjectId=project.ProjectId');

		$this->db->group_by('ProjectId'); 

        $this->db->order_by('InvoiceId', 'desc'); 

		$query=$this->db->get();

		$projects = $query->result_array();

		$res = array();

		foreach($projects as $project)

		{

			$res[]=array($project['ProjectName'],

						 $project['Sum_Amount'],

						 $this->getReceivedAmt($project['ProjectId']));

		}

		return $res;

		

	}	

}

?>