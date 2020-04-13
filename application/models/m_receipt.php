<?php
class M_Receipt extends CI_Model 
{
		
	function M_Receipt() 
	{
		parent::__construct();
	}
	function CountAll()
    {	
		$this->db->from('receipt');
		if($this->session->userdata('search_from_receipt'))
		{
			$this->db->where('ReceiptDate >=',
			date('Y-m-d',strtotime($this->session->userdata('search_from_receipt'))));
		}
		if($this->session->userdata('search_to_receipt'))
		{
			$this->db->where('ReceiptDate <=',
			date('Y-m-d',strtotime($this->session->userdata('search_to_receipt'))));
		}
        $query = $this->db->get();
        return $query->num_rows();
    }
	function GetById($id=0)
	{
		$this->db->from('receipt');
		$this->db->where('ReceiptId',$id);
		$query=$this->db->get();
        if ($query->num_rows() == 0)  return false; // not found
		return $query->row_array();	
	}
	
    //============  GetAll Function ===================
    
    function GetAll($limit, $offset)
    {
		$this->db->from('receipt');
		if($this->session->userdata('search_from_receipt'))
		{
			$this->db->where('ReceiptDate >=',
			date('Y-m-d',strtotime($this->session->userdata('search_from_receipt'))));
		}
		if($this->session->userdata('search_to_receipt'))
		{
			$this->db->where('ReceiptDate <=',
			date('Y-m-d',strtotime($this->session->userdata('search_to_receipt'))));
		}
		$this->db->order_by("ReceiptId", "DESC");
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
		$this->db->set('InvoiceNo',$this->input->post('InvoiceNo'));
		$this->db->set('PayBy',$this->input->post('PayBy'));
		$this->db->set('TransactionRef',$this->input->post('TransactionRef'));
		$this->db->set('AccName',$this->input->post('AccName'));
		$this->db->set('Amount',$this->input->post('Amount'));
		$this->db->set('Currency',$this->input->post('Currency'));
		$this->db->set('Status',$this->input->post('Status'));
		$this->db->set('ReceiptDate',date('Y-m-d',strtotime($this->input->post('ReceiptDate'))));
		$this->db->set('Note',$this->input->post('Note'));
		$this->db->insert('receipt');
		return $this->db->insert_id();
	}
	function Update()
	{
		$this->db->set('InvoiceNo',$this->input->post('InvoiceNo'));
		$this->db->set('PayBy',$this->input->post('PayBy'));
		$this->db->set('TransactionRef',$this->input->post('TransactionRef'));
		$this->db->set('AccName',$this->input->post('AccName'));
		$this->db->set('Amount',$this->input->post('Amount'));
		$this->db->set('Currency',$this->input->post('Currency'));
		$this->db->set('Status',$this->input->post('Status'));
		$this->db->set('ReceiptDate',date('Y-m-d',strtotime($this->input->post('ReceiptDate'))));
		$this->db->set('Note',$this->input->post('Note'));
		$this->db->where('ReceiptId',$this->input->post('ReceiptId'));
		return $this->db->update('receipt');
	}
	function Delete($id) 
	{
		$this->db->where('ReceiptId',$id);
		$query = $this->db->delete('receipt');
		return true;
	}
	
	function getInvoice()
	{
		$this->db->from('invoice');
		$query=$this->db->get();
		$invoices =  $query->result_array();
		$res =array();
		foreach($invoices as $invoice)
		{
			$received = $this->common->GetReceivedAmount($invoice['InvoiceNo']);
			$due = $invoice['Amount']-$received;
			if($due>0)
			{ 
				$res[] = array($invoice['InvoiceNo'],'Due ['.$due.' '.$invoice['Currency'].']');
			}
		}
		return $res;		
	}

}