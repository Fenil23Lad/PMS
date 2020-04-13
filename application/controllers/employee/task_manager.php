<?php

class task_manager extends CI_Controller 

{

	function task_manager()

	{

		parent::__construct();

		$this->administration->check_employee_login();

		$this->load->model('M_Task','task');

	}

	//=======================================================================

	function details($id=0)

	{	

		$TaskId = $this->functions->decode($id);

		$data['record']=$this->task->GetById($TaskId);

		$data['id']=$id;

		//$data['Comments'] = $this->task->GetComments($TaskId,0);
		
		$data['Comments'] = $this->task->GetAllComments($TaskId);


		//echo "===>".count($data['Comments']);
		$this->load->view('employee/header');

		$this->load->view('employee/task_manager/details', $data);

		$this->load->view('employee/footer');

	}

	//=======================================================================

	function save_comment($id=0)

	{	

		if ($this->input->post('submit'))
		{
			if($this->input->post('action')=='reply')

			{

				$this->task->InsertComment();

				$this->session->set_flashdata('notification', 

			    'Comment Inserted successfully.');

			}

			redirect('employee/task_manager/details/'.$id);

		}

	}

	function edit_comment($id=0,$cid=0)
	{
		
		$data['record']=$this->task->GetCommentdta($cid);
		$data['taskid']=$id;
		if($this->input->post('update'))
		{

				$this->task->EditComment();

				$this->session->set_flashdata('notification', 

			    'Comment Updated successfully.');
				
				redirect('employee/task_manager/details/'.$this->input->post('TaskId'));
		}
		else
		{
			$this->load->view('employee/header');

			$this->load->view('employee/task_manager/updatecomment', $data);
	
			$this->load->view('employee/footer');	
		}
	}

	//=======================================================================

	function delete_comment($id=0,$cid=0)

	{	

		

		$this->task->DeleteComment($cid);

		$this->session->set_flashdata('notification', 

		'Comment Deleted successfully.');

		redirect('employee/task_manager/details/'.$id);

	}

	//=======================================================================

	function save($id=0)

	{	

		if ($this->input->post('submit'))

		{

			$this->task->Submit();

			//$this->task->InsertComment();

			$this->session->set_flashdata('notification', 

			'Task has been Updated successfully.');

			redirect('employee/task_manager/details/'.$id);

		}

	}

		

		

}



?>