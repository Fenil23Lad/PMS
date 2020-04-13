<?php
class Mailer 
{
	function Mailer()
	{
		$this->obj =& get_instance();
	}
	//=============================================================
	function sendSms($to='',$text='')
	{
	   $user = "mv.vpn";
	   $password = "bWHIGeFCWYOfDD";
	   $api_id = "3523148";
	   $baseurl ="http://api.clickatell.com";
	   
	   // auth call
	   $url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";
	   
	   // do auth call
	   $ret = file($url);
	   
	   // explode our response. return string is on first line of the data returned
	   $sess = explode(":",$ret[0]);
	   if ($sess[0] == "OK") 
	   {
	   
		$sess_id = trim($sess[1]); // remove any whitespace
		$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";
	   
		// do sendmsg call
		$ret = file($url);
		$send = explode(":",$ret[0]);
	   
		if ($send[0] == "ID") 
		{
		 return "successnmessage ID: ".$send[1]." | ".$to." | ".$text;
		} 
		else 
		{
		 return "send message failed";
		}
	   } 
	   else 
	   {
		return "Authentication failure: ". $ret[0];
	   }
	}
	//=============================================================
	function SendHTMLMail($to,$subject,$mailcontent)
	{
		$from1 = "admin@activech.com";
		$limite = "_parties_".md5 (uniqid (rand()));
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: $from1\r\n";
		return @mail($to,$subject,$mailcontent,$headers);
	}
	
	//=============================================================
	//@CONTENT@
	function Tpl_NewsLetter()
	{
		$filename = base_url('assets/email_templates/NewsLetter.html');
		$tpl = file_get_contents($filename, true);
		$tpl = str_replace("@TPLURL@",base_url('assets/email_templates/email_files'),$tpl);;
		$tpl = str_replace("@BASEURL@",base_url(),$tpl);
		
		return $tpl; 
	}
	
	//=============================================================
	//@USERNAME@
	//@EMAIL@
	//@USERID@
	//@PASSWORD@
	//@LOGINLINK@
	function Tpl_AccountConfirmed($type)
	{
		$filename = base_url('assets/email_templates/AccountConfirmed_'.$type.'.html');
		$tpl = file_get_contents($filename, true);
		$tpl = str_replace("@TPLURL@",base_url('assets/email_templates/email_files'),$tpl);;
		$tpl = str_replace("@BASEURL@",base_url(),$tpl);
		return $tpl; 
	}
	
	//=============================================================
	//@USERNAME@
	//@EMAIL@
	//@VERIFICATIONCODE@
	function Tpl_AccountVerificationCode()
	{
		$filename = base_url('assets/email_templates/AccountVerificationCode.html');
		$tpl = file_get_contents($filename, true);
		$tpl = str_replace("@TPLURL@",base_url('assets/email_templates/email_files'),$tpl);;
		$tpl = str_replace("@BASEURL@",base_url(),$tpl);
		return $tpl; 
	}
	
	//=============================================================
    //@ACTIVATIONLINK@
	//@USERNAME@
	//@EMAIL@
	function Tpl_AccountActivation()
	{
		$filename = base_url('assets/email_templates/AccountActivation.html');
		$tpl = file_get_contents($filename, true);
		$tpl = str_replace("@TPLURL@",base_url('assets/email_templates/email_files'),$tpl);;
		$tpl = str_replace("@BASEURL@",base_url(),$tpl);
		return $tpl; 
	}
	
	//=============================================================
    //@RESETLINK@
	//@USERNAME@
	//@EMAIL@
	function Tpl_PasswordReset()
	{
		$filename = base_url('assets/email_templates/PasswordReset.html');
		$tpl = file_get_contents($filename, true);
		$tpl = str_replace("@TPLURL@",base_url('assets/email_templates/email_files'),$tpl);;
		$tpl = str_replace("@BASEURL@",base_url(),$tpl);
		return $tpl; 
	}
	
	//=============================================================
	//@USERNAME@
	//@UNAME@
	//@EMAIL@
	function Tpl_RetriveUsername()
	{
		$filename = base_url('assets/email_templates/RetriveUsername.html');
		$tpl = file_get_contents($filename, true);
		$tpl = str_replace("@TPLURL@",base_url('assets/email_templates/email_files'),$tpl);;
		$tpl = str_replace("@BASEURL@",base_url(),$tpl);
		return $tpl; 
	}
	
	//=============================================================
	//@USERNAME@
	//@MESSAGE@
	//@EMAIL@
	function Tpl_InquiryReply()
	{
		$filename = base_url('assets/email_templates/InquiryReply.html');
		$tpl = file_get_contents($filename, true);
		$tpl = str_replace("@TPLURL@",base_url('assets/email_templates/email_files'),$tpl);;
		$tpl = str_replace("@BASEURL@",base_url(),$tpl);
		return $tpl; 
	}
	
	//=============================================================
	//@USERNAME@
	//@EMAIL@
	//@LOGINLINK@
	function Tpl_CustomerEmailNotification()
	{
		$filename = base_url('assets/email_templates/CustomerEmailNotification.html');
		$tpl = file_get_contents($filename, true);
		$tpl = str_replace("@TPLURL@",base_url('assets/email_templates/email_files'),$tpl);;
		$tpl = str_replace("@BASEURL@",base_url(),$tpl);
		return $tpl; 
	}
	

}
?>