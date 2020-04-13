<?php
class lead extends CI_Controller 
{
	function lead()
	{
		parent::__construct();
		$this->administration->check_employee_login();
		$this->load->model('M_lead','lead');
	}
	//=======================================================================
	function summary()
	{	
		$this->load->model('M_lead_summary','lead_summary');
		if($this->input->post('filter_month')=='')
		{
			$data['filter_month']=date('F Y');
		}
		else
		{
			$data['filter_month'] =$this->input->post('filter_month');
		}
		$data['LineChart']=$this->lead_summary->LineChart_Emp($data['filter_month']);
		$this->load->view('employee/header');
		$this->load->view('employee/lead/summary',$data);
		$this->load->view('employee/footer');
	}
	//=======================================================================
	function index()
	{	
		$count = $this->lead->CountAllEmp();
		$per_page_record = 15;
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("employee/lead/index");
		$config =$this->functions->paginationConfig($url,$count,$per_page_record);
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		
		$data['records']=$this->lead->GetAllEmp($per_page_record,$page);
		$this->load->view('employee/header');
		$this->load->view('employee/lead/list', $data);
		$this->load->view('employee/footer');
	}
	//=======================================================================
	function search()
	{
		if($this->input->post('search'))
		{
			$this->session->set_userdata('search_lead',
			trim($this->input->post('search_lead')));
		}
		if($this->input->post('all'))
		{
			$this->session->unset_userdata('search_lead');
		}
		redirect('employee/lead');
	}
	//=======================================================================
	function add()
	{	
		$data['action'] = "add";
		
		if ($this->input->post('submit'))
		{
			$this->lead->Insert();
			$this->session->set_flashdata('notification', 
			'lead has been Added successfully.');
			redirect('employee/lead');
		}
		$this->load->view('employee/header');
		$this->load->view('employee/lead/addedit',$data);
		$this->load->view('employee/footer');
	}

	//=======================================================================
	function edit($id='0')
	{	
		$data['action'] = "edit";
		$data['record']=$this->lead->GetById($this->functions->decode($id));
		if ($this->input->post('submit'))
		{
			$this->lead->Update();
			$this->session->set_flashdata('notification', 
			'Lead has been Updated successfully.');
			redirect('employee/lead');
		}
		
		$this->load->view('employee/header');
		$this->load->view('employee/lead/addedit',$data);
		$this->load->view('employee/footer');
	}	
	//=======================================================================
	function action()
	{
		if($this->input->post('action')=='action_delete')
		{
			$this->lead->DeleteSelected();
			$this->session->set_flashdata('notification', 
			'Selected lead has been Deleted successfully.');
		}
		redirect('employee/lead');
	}
	//=======================================================================
	function get_notes($id=0)
	{
		$res = $this->db->where('leadId',$id)
				->order_by('Id','DESC')
				->get('note')
				->result_array();
		$tbody='';
		foreach($res as $key=>$val)
		{
			$tbody.='<tr>';
			$tbody.=  '<td>';
			$tbody.=     $key+1;
			$tbody.=  '</td>';
			$tbody.=  '<td>';
			$tbody.=     ucwords($val['CreatedBy']);
			$tbody.=  '</td>';
			$tbody.=  '<td>';
			$tbody.=     date('d M Y',strtotime($val['CreatedOn']));
			$tbody.=  '</td>';
			$tbody.=  '<td>';
			$tbody.=     ucwords($val['Note']);
			$tbody.=  '</td>';
			$tbody.='</tr>';				
		}
		echo $tbody;
	}
	//===================================================================
	function save_note()
	{
		$dt = new DateTime('now');
		$this->db->set('leadId', $this->input->post('leadId'));
		$this->db->set('CreatedBy',$this->session->userdata('UserName'));
		$this->db->set('CreatedOn',$dt->format('Y-m-d H:i:s'));
		$this->db->set('Note',$this->input->post('Note'));
		echo $this->db->insert('note');
	}

				
}

?>