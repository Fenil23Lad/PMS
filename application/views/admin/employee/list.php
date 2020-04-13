<style>
.contact-group .media-content ul > li {
  min-width: 50px;
  margin-right:15px;
}
</style>
<div class="pageheader">
<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-user" style="padding-top:8px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('admin/employee');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Employee</li>
            </ul>
            <h4>Employee</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
	<?php if ($this->session->flashdata('notification')): ?>
    <div class="alert alert-success">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <strong><?php echo $this->session->flashdata('notification') ?></strong>
    </div>					
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <strong><?php echo $this->session->flashdata('error') ?></strong>
    </div>					
    <?php endif; ?>
    <div class="well mt10">
            <div class="row">
            <form action="<?=base_url('admin/employee/search');?>" method="post">
                <div class="col-sm-10">
                    <input type="text" 
                    placeholder="Keywords : Name, Designation"
                    name="search_employee"
                    value="<?php if($this->session->userdata('search_employee')) 
                    echo $this->session->userdata('search_employee') ?>"
                     class="form-control">
                </div>
                <div class="col-sm-2">
                    <input type="submit" name="search" class="btn btn-primary btn-metro mr10" value="Search" />
                    <input type="submit" name="all" class="btn btn-primary btn-metro mr10" value="All" />
                </div>
            </div>
            </form>
    </div><!-- well -->
    <div class="row"> 
    	<div class="col-sm-12" style="margin-left:15px;">
            <div class="pull-left sellect_all">                   
                <div class="pull-left mr10 mt5">
                    <div class="ckbox ckbox-primary">
                        <input type="checkbox" id="SellectAll" onclick="CheckAll()"/>
                        <label for="SellectAll"><strong>Select All</strong></label>
                    </div>
                </div>                                  
                <div class="btn-group">
                    <button type="button" class="btn btn-xs btn-primary btn-metro">Action</button>
                    <button type="button" class="btn btn-xs btn-primary dropdown-toggle btn-metro" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="#" class="action-delete" 
                            onClick="return action_delete(document.recordlist)" >
                            Delete
                            </a>
                        </li>
                        <li>
                            <a href="#" class="action-delete" 
                            onClick="return action_active(document.recordlist)" >
                            Active
                            </a>
                        </li>
                        <li>
                            <a href="#" class="action-delete" o
                            onClick="return action_deactive(document.recordlist)">
                            Deactive
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="pull-right ml10">
                    <a class="btn btn-xs btn-primary btn-metro" href="<?php echo base_url('admin/employee/add');?>" 
                    title="Add New Post">
                    <i class="glyphicon glyphicon-plus"></i>&nbsp;Add New Employee
                    </a>
                </div> 
            </div>
            <div class="pull-right mr10">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
    <form name="recordlist" id="mainform"  method="post" 
    action="<?php echo base_url('admin/employee/action');?>">
    <div class="row"> 
    	<div class="col-sm-12">
            <div class="list-group contact-group">
                <?php foreach($records as $key=>$record): ?>
                <div class="list-group-item record">
                    <div class="media">
                        <div class="media-body">
                            <div class="ckbox ckbox-primary pull-left">
                                <input type="checkbox" id="A<?=$key?>" name="Id_List[]" 
                                value="<?php echo $record['UserId']?>"/>
                                <label for="A<?=$key?>"></label>
                            </div> 
                            <img class="pull-left mr10 mt5 img-circle" style="height:80px;"
								src="<?php if(isset($record['Avtar'])&& $record['Avtar']!='')
								echo base_url('uploads/user_profile')."/".$record['Avtar'];
								else echo base_url('assets/admin/images/photos/profile.png');?>" />
                            <h4 class="media-heading" style="margin-bottom:5px;">
                                <a href="#">
									<?=$record['Name'];?>
                                </a>
                                <a class="btn btn-primary btn-xs btn-metro pull-right"
                                href="<?php echo base_url('admin/employee/edit/'.$this->functions->encode($record['UserId']));?>"
                                title="Edit Thread">
                                	<span class="fa fa-edit"></span>&nbsp;Edit
                                </a>
                            </h4>
                            <strong>Designation :</strong>
                            <span>
                              &nbsp;<?=$record['RoleName']?>  
                            </span>
                            <div class="media-content">
                                <ul class="list-unstyled">
                                    <li>
                                        <strong>Status :</strong>
                                        <?php
                                        if($record['UserStatus']==1) 
                                            echo '<span class="badge badge-success">Active</span>';
                                        else 
                                            echo '<span class="badge badge-danger">Inactive</span>';
                                        ?>
                                    </li>
                                    <li>
                                        <strong>
                                        	Gender :
                                        </strong>
                                        <span>
                                           &nbsp;<span style="color:#999;"
                                           class="fa fa-<?=strtolower($record['Gender']);?>" title="<?=ucfirst($record['Gender']);?>">
                                           </span>
                                        </span>
                                    </li>
                                    <li>
                                        <strong>
                                        	<span class="fa fa-envelope-o" title="Email"></span>
                                        </strong>
                                        <span>
                                           <?=$record['Email']?>  
                                        </span>
                                    </li>
                                    <li>
                                        <strong>
                                        	<span class="fa fa-mobile" title="Contact No."></span>
                                        </strong>
                                        <span>
                                           <?=$record['Phone']?>  
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- media -->
                </div><!-- list-group -->    
                <?php endforeach; ?> 
            </div>
        </div>
    </div> 
    <input type="hidden" name="action" />
    </form>
</div>
<script>
//==========================================================================
function CheckAll()
{
    var checks = document.getElementsByName('Id_List[]');
	for (i = 0; i < checks.length; i++)
	{
		if(checks[i].checked == false) 
			checks[i].checked = true;
	}
    document.getElementById('SellectAll').setAttribute('onclick','UncheckAll()');
}
//==========================================================================
function UncheckAll()
{
    var checks = document.getElementsByName('Id_List[]');
    for (i = 0; i < checks.length; i++)
    {
        if(checks[i].checked == true) 
            checks[i].checked = false;
    }
    document.getElementById('SellectAll').setAttribute('onclick','CheckAll()');
}
//====================================================================
function action_active(frm)
{
	with(frm)
	{
		var flag = false;
		str = '';
		field = document.getElementsByName('Id_List[]');
		for (i = 0; i < field.length; i++)
		{
			if(field[i].checked == true)
			{ 
				flag = true;
				break;
			}
			else
				field[i].checked = false;
		}
		if(flag == false)
		{
			alert("Please select atleast one record");
			return false;
		}
	}
	frm.action.value = "action_active";
	frm.submit();
	return true ;
}
//================================================================
function action_deactive(frm)
{
	with(frm)
	{
		var flag = false;
		str = '';
		field = document.getElementsByName('Id_List[]');
		for (i = 0; i < field.length; i++)
		{
			if(field[i].checked == true)
			{ 
				flag = true;
				break;
			}
			else
				field[i].checked = false;
		}
		if(flag == false)
		{
			alert("Please select atleast one record");
			return false;
		}
	}
	frm.action.value = "action_deactive";
	frm.submit();
	return true ;
}
//===================================================================
function action_delete(frm)
{
	with(frm)
	{
		var flag = false;
		str = '';
		field = document.getElementsByName('Id_List[]');
		for (i = 0; i < field.length; i++)
		{
			if(field[i].checked == true)
			{ 
				flag = true;
				break;
			}
			else
				field[i].checked = false;
		}
		if(flag == false)
		{
			alert("Please select atleast one record");
			return false;
		}
	}
	if(confirm("Are you sure to delete selected records ?"))
	{
		frm.action.value = "action_delete";
		frm.submit();
		return true ;
	}
	
}
</script>