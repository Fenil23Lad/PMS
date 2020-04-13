<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Admin Portal | VPN</title>
        <link href="<?=base_url('assets/admin');?>/css/style.default.css" rel="stylesheet">
        <link href="<?=base_url('assets/admin');?>/css/morris.css" rel="stylesheet">
        <link href="<?=base_url('assets/admin');?>/css/select2.css" rel="stylesheet" />
        <link href="<?=base_url('assets/admin');?>/css/table.css" rel="stylesheet" />
        <script src="<?=base_url('assets/admin');?>/js/jquery-1.11.1.min.js"></script>
        <script src="<?=base_url('assets/admin');?>/js/bootstrap.min.js"></script>
    </head>
    <body>
        
   <!-- ========================== Lock Screen ========================= -->	
<?php if($this->session->userdata('lock') != NULL) { ?>
	<div class="locked">
            <div class="lockedpanel">
                <div class="loginuser">
                    <img src="<?php if($this->session->userdata('Avtar')!='') 
				echo base_url('uploads/user_profile')."/".$this->session->userdata('Avtar');
				else echo base_url('assets/admin/images/photos/profile.png'); ?>" style="width:80px;" class="img-circle img-online"/>
                </div>
                <div class="logged">
                    <h4><?= ucwords($this->session->userdata('UserName'));?></h4>
                </div>
                <form id="unlock" method="post" action="<?php echo site_url('admin/security/lockscreen');?>">
              	<input type="hidden" name="userid" id="userid" value="<?=$this->session->userdata('UserId') ?>"/>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                         <input type="password" class="form-control" name="password" 
                            placeholder="Password" required id="password" />
                    </div>
                     <input type="submit" class="btn btn-success btn-block" name="submit" 
                                value="Unlock" id="login_button"  />
                </form>
                 <?php if($this->session->flashdata('error')): ?>
                 
                	<div class="alert alert-danger text-center">
                        <strong><?=$this->session->flashdata('error');?></strong>
                    </div> 
				<?php endif; ?>
            </div>
        </div>
<?php } ?>        
 <!-- ==========================End  Lock Screen ========================= -->	
   
    <header>
            <div class="headerwrapper">
                <div class="header-left">
                    <a href="<?=base_url('admin/home');?>" class="logo">
                       <b style="color:#FFF; font-size:24px;">Admin Portal</b>
                    </a>
                    <div class="pull-right">
                        <a href="#" class="menu-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div><!-- header-left -->
                
                <div class="header-right">
                    <div class="pull-right">
                        <div class="btn-group btn-group-option">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                               <i class="fa fa-cog"></i>
                              <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                              <li><a href="<?=base_url('admin/profile');?>">
                              <i class="glyphicon glyphicon-user"></i>Edit Profile</a></li>
                              <li><a href="<?=base_url('admin/security/changepwd');?>">
                              <i class="glyphicon glyphicon-lock"></i>Change Password</a></li>
                              <li class="divider"></li>
                              <li><a href="<?=base_url('admin/security/screenlock');?>">
                              <i class="fa fa-lock"></i>Lock Screen</a></li>
                              <li><a href="<?=base_url('admin/security/logout');?>">
                              <i class="glyphicon glyphicon-log-out"></i>Sign Out</a></li>
                            </ul>
                        </div><!-- btn-group -->
                        
                    </div><!-- pull-right -->
                    
                </div><!-- header-right -->
                
            </div><!-- headerwrapper -->
        </header>
<!-- ===================================SECTION================================================= -->        
<section>
<div class="mainwrapper">
    <div class="leftpanel">
        <div class="media profile-left">
            <a class="pull-left profile-thumb" href="<?=base_url('admin');?>">
                 <img class="img-circle"
                src="<?php if($this->session->userdata('Avtar')!='') 
				echo base_url('uploads/user_profile')."/".$this->session->userdata('Avtar');
				else echo base_url('assets/admin/images/photos/profile.png'); ?>" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?= ucwords($this->session->userdata('UserName'));?></h4>
                <small class="text-muted">Last Login : 
                <?=$this->functions->time_ago($this->session->userdata('LastLogin'));?><br>
                <a href="<?=base_url('admin/security/logout');?>">
                  Sign Out</a>&nbsp;&nbsp;|&nbsp;
                  <a href="<?=base_url('admin/profile');?>">
                  Settings</a>
                </small>
            </div>
        </div><!-- media -->
        <h5 class="leftpanel-title">Navigation</h5>
        <ul class="nav nav-pills nav-stacked">
             <li class="<?php if($this->uri->segment(2) == 'home' 
			 || $this->uri->segment(2) == '') echo 'active';?>">
            	<a href="<?=base_url('admin/home');?>">
                <i class="fa fa-home"></i><span>Dashboard</span></a>
            </li>
            <li class="<?php if($this->uri->segment(2) == 'employee' 
			|| $this->uri->segment(2) == 'role') echo 'active';?>">
                <a href="<?=base_url('admin/employee/search/all');?>">
                    <i class="fa fa-user"></i><span>Employee</span>
                </a>
            </li>
            <li class="<?php if($this->uri->segment(2) == 'project'
			|| $this->uri->segment(2) == 'project_category') echo 'active';?>">
                <a href="<?=base_url('admin/project/search/all');?>">
                    <i class="fa  fa-suitcase"></i><span>Project</span>
                </a>
            </li>
            <li class="<?php if($this->uri->segment(2) == 'task' 
			 || $this->uri->segment(2) == 'task_manager') echo 'active';?>">
                <a href="<?=base_url('admin/task/search/all');?>">
                    <i class="fa fa-list"></i><span>Task Sheet</span>
                </a>
            </li>
            <li class="<?php if($this->uri->segment(2) == 'messageboard') echo 'active';?>">
                 <a href="<?=base_url('admin/messageboard/search/all');?>">
                 	<div class="email-new-count"></div>
                    <i class="fa fa-envelope-o"></i><span>Message Board</span>
                </a>
            </li>
            <li class="<?php if($this->uri->segment(2) == 'empchat') echo 'active';?>">
                <a href="<?=base_url('admin/empchat');?>">
                	<div class="empchat-new-count"></div>
                    <i class="fa fa-comments-o"></i><span>Employee Chat</span>
                </a>
            </li>
            <li class="<?php if($this->uri->segment(2) == 'lead' || $this->uri->segment(2) == 'industry') echo 'active';?>">
                <a href="<?=base_url('admin/lead/search/all');?>">
                	<div class="empchat-new-count"></div>
                    <i class="fa fa-calendar-o"></i><span>Manage Lead</span>
                </a>
            </li>
            <li class="parent <?php if($this->uri->segment(2) == 'invoice' 
				|| $this->uri->segment(2) == 'receipt' 
				||$this->uri->segment(2) == 'payment' 
				|| $this->uri->segment(2) == 'report') echo 'active';?>">
            	<a href="#"><i class="fa fa-book"></i> <span>Account</span></a>
                <ul class="children">
                	<li class="<?php if($this->uri->segment(2) == 'invoice') echo 'active';?>">
                    <a href="<?=base_url('admin/invoice/search/all');?>">Invoice Entry</a></li>
                    <li class="<?php if($this->uri->segment(2) == 'receipt') echo 'active';?>">
                    <a href="<?=base_url('admin/receipt/search/all');?>">Receipt Entry</a></li>
                    <li class="<?php if($this->uri->segment(2) == 'expense') echo 'active';?>">
                    <a href="<?=base_url('admin/expense/search/all');?>">Expense Entry</a></li>
                   <!-- <li class="<?php if($this->uri->segment(2) == 'report') echo 'active';?>">
                    <a href="<?=base_url('admin/report');?>">Reports</a></li>-->
                </ul>
            </li>
            <li class="<?php if($this->uri->segment(2) == 'accesscontrol') echo 'active';?>">
                <a href="<?=base_url('admin/accesscontrol');?>">
                    <i class="fa fa-sitemap"></i><span>Access Control</span>
                </a>
            </li>
            <li class="<?php if($this->uri->segment(2) == 'notice') echo 'active';?>">
                <a href="<?=base_url('admin/notice');?>">
                    <i class="fa fa-bullhorn"></i><span>Notice Board</span>
                </a>
            </li>
        </ul>
        
    </div><!-- leftpanel -->
    <div class="mainpanel">
<script>
var PageTitleNotification = { Vars: { OriginalTitle: document.title, Interval: null }, On: function (e, t) { var n = this; n.Vars.Interval = setInterval(function () { document.title = n.Vars.OriginalTitle == document.title ? e : n.Vars.OriginalTitle }, t ? t : 1e3) }, Off: function () { clearInterval(this.Vars.Interval); document.title = this.Vars.OriginalTitle } }

function load_sidebar_count()
{
	$.post( "<?=base_url('auto_load/SideBarCount');?>", 
		function( data ) {
			$(".empchat-new-count").html(data.EmpChatCount);
			if(data.ChatCount>0)
			{
				PageTitleNotification.On("New Chat Message!", 2000);
			}
			else
			{
				PageTitleNotification.Off();
			}
			$(".email-new-count").html(data.InboxCount);
	},'json');
}

load_sidebar_count();

setInterval(function(){
	load_sidebar_count();
	$.get('<?=base_url('auto_load/updatelastactivity');?>');
},5000);

</script>