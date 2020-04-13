<?php
class Security extends CI_Controller 
{         
    function Security()
	{
		parent::__construct();
		$this->load->model('m_security','auth'); 
	}		
	//======================================================
	function index()
	{
		redirect('admin/security/login');
	}
	//======================================================
	function login()
	{
		if($this->input->post('submit'))
		{
			$res = $this->auth->Login();
			if($res=='invalid') // invalid id password 
			{
				$this->session->set_flashdata('error', 'Username or Password incorrect, please try again.');
				redirect('admin/security/login');
			}
			if($res=='inactive') // inactive user
			{
				$this->session->set_flashdata('error', 'Your account is inactive. please contact to Admin');
				redirect('admin/security/login');
			}
			redirect('admin/home');
		}
		$this->load->view('admin/security/login');
	}
	//======================================================
	function logout()
	{
		$this->auth->LogOut();
		$this->load->view('admin/security/login');
	}
	//======================================================
		
	function changepwd()
	{
		if($this->input->post('submit'))
		{
			if($this->auth->ChangePwd())
			{
				$this->session->set_flashdata('notification', 'Password has been Changed successfully.');
			}
			else
			{
				$this->session->set_flashdata('error', 'Invalid Current Password');
			}
			redirect('admin/security/changepwd');
		}
		$this->load->view('admin/header');
		$this->load->view('admin/security/changepwd');
		$this->load->view('admin/footer');
	}
	
	//============ For Screen Lock ===============
	function lockscreen()
	{
		if($this->input->post('submit'))
		{
			$res = $this->auth->Lockscreen();
			if($res=='invalid') // invalid id password 
			{
				$this->session->set_flashdata('error', 'Password incorrect, please try again.');
				redirect('admin/home/index');
			}
			$this->session->set_userdata('lock','');
			redirect('admin/home/index');
		}
		
	}
	
	function screenlock()
	{
		$this->session->set_userdata('lock',$this->session->userdata('UserId'));
		redirect('admin/home');
	}
	
	
	//============ For ForgotPassword ===============
	
	function forgotPassword()
	{
		if($this->input->post('chk_email'))
		{
			$this->db->from('users');
			$this->db->where('Email',$this->input->post('email'));
			$this->db->where('UserStatus',1);
			$this->db->join('role', 'users.RoleId = role.RoleId');
			$this->db->where('role.RoleId',1);
			$query=$this->db->get();

			
			if($query->num_rows()>0)

			{

				$res = $query->row_array();

				$RandNo = $this->functions->generate_randomnumber(5);

				$acc_code = $RandNo.$res['UserId'];

				// Login table		

				$this->db->set('ActivationCode', $acc_code);

				$this->db->where('UserId',$res['UserId']);

				$this->db->update('users');

				//---------------------------------------------------------------

				

				$this->load->library('mailer');	

				$subject= "Project Management - Forgot Password Request";

				$body = $this->mailer->Tpl_InquiryReply();

				$msg ="We have received your forgot password request. if you didn't place any request for password retrive, please ignore this email. and if you realy wants to reset a new password, please &nbsp;<a href='".base_url('admin/security/verification/'.$acc_code)."'>Click here</a>";

				$body = str_replace("@USERNAME@",$res['Name'],$body);

				$body = str_replace("@EMAIL@",$res['Email'],$body);

				$body = str_replace("@MESSAGE@",$msg,$body);

				

				$this->load->library('email');

				$config['mailtype'] = 'html';

				$this->email->initialize($config);

				$this->email->from('info@vpninfotech.com', $res['Email']);

				$this->email->to($res['Email']); 

				$this->email->subject($subject);

				$this->email->message($body);

				$this->email->send();

				$this->session->set_flashdata('success',

				'Forgot password request sent successfully, You will receive the confirmation mail.');

			}

			else

			{

				$this->session->set_flashdata('error', 

				'Provided email address does not match with the system records.');	

			}
			redirect('admin/security/forgotPassword');
			//$this->load->view('employee/security/forgotpwd');			
				
		}else
		{
			$this->load->view('admin/security/forgotpwd');
		}
	}
	//======================================================
	function verification($id='0')

	{

		if($this->input->post('Submit'))

		{

			$this->auth->SetPassword();

			$this->session->set_flashdata('success','Password set successfully.');

			redirect('security/login');

		}

		if($this->auth->CheckVerification($id))

		{

			$data['ActivationCode']=$id;

			$this->load->view('site/header');

			$this->load->view('site/security/setpwd',$data);

			$this->load->view('site/footer');

		}

		else

		{

			$this->session->set_flashdata('error','Activation link is either invalid or expired.');

			redirect('admin/security/login');

		}

	}
}
?>