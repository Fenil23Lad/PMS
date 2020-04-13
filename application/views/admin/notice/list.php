<style>
.contact-group .media-content ul > li {
	min-width: 50px;
	margin-right: 15px;
}
.ml25 {
	margin-left: 25px;
}
.media-content ul {
	margin-top: 5px !important;
}
</style>
<div class="pageheader">
  <div class="media">
    <div class="pageicon pull-left"> <i class="fa fa-list" style="padding-top:8px;"></i> </div>
    <div class="media-body">
      <ul class="breadcrumb">
        <li><a href="<?=base_url('admin/notice');?>"> <i class="glyphicon glyphicon-home"></i></a></li>
        <li>Notice</li>
      </ul>
      <h4>Notice</h4>
    </div>
  </div>
  <!-- media --></div>
<!-- pageheader --><!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
  <?php if ($this->session->flashdata('notification')): ?>
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong><?php echo $this->session->flashdata('notification') ?></strong> </div>
  <?php endif; ?>
  <?php if ($this->session->flashdata('error')): ?>
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong><?php echo $this->session->flashdata('error') ?></strong> </div>
  <?php endif; ?>
  <div class="well mt10">
            <div class="row">
            <form action="<?=base_url('admin/notice/search');?>" method="post">
                <div class="col-sm-10">
                    <input type="text" 
                    placeholder="Keywords : Description"
                    name="search_notice"
                    value="<?php if($this->session->userdata('search_notice')) 
                    echo $this->session->userdata('search_notice') ?>"
                     class="form-control">
                </div>
                <div class="col-sm-2">
                    <input type="submit" name="search" class="btn btn-primary btn-metro mr10" value="Search" />
                    <input type="submit" name="all" class="btn btn-primary btn-metro mr10" value="All" />
                </div>
            </div>
            </form>
    </div><!-- well -->
  <!-- well -->
  <div class="row">
    	<div class="pull-left ml10">
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
                <a class="btn btn-xs btn-primary btn-metro" 
                href="<?=base_url('admin/notice/add')?>" title="Add New Notice">
                <i class="glyphicon glyphicon-plus"></i>&nbsp;Add New Notice
                </a>
            </div> 
            
        </div>
        <div class="pull-right mr10">
                <?php echo $this->pagination->create_links(); ?>
            </div>
    </div>
  
  <?php if(count($record)>0): ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="table-responsive" id="no-more-tables">
       <form name="recordlist" id="mainform"  method="post" 
                action="<?php echo base_url('admin/notice/action') ?>">
        <table class="table table-primary table-bordered table-striped table-condensed cf">
          <thead class="cf">
            <tr>
              <th class="table-header-check" style="text-align:center;">
                <input type="checkbox" onclick="CheckUncheckAll()" />
            </th>
              <th>Description</th>
              <th>Status</th>
              <th width="200px">Action</th>
            </tr>
          </thead>
          <tbody>                                       
				
                    <?php foreach ($record as $records): ?>
                            <tr>
                                <td align="center" valign="middle">
                                    <input type="checkbox" name="Id_List[]" id="Id_List[]" 
                                    value="<?php echo $records['id']?>">
                                </td>
                                <td>
                                    &nbsp;<?php echo $records['description'];?>
                                </td>
                                <td>
                                    <?php
                                     if($records['status']==1) 
                                        echo '&nbsp;<b class="text-success">Active</b>';
                                     else 
                                        echo '&nbsp;<b class="text-danger">Inactive</b>';
                                    ?>
                                </td>
                                <td>
                             <a href="<?php echo base_url('admin/notice/edit/'.$this->functions->encode($records['id']));?>"
                                    title="Edit"><span class="fa fa-edit"></span>&nbsp;Edit</a>
                                    &nbsp;&nbsp;<a onclick="return confirm('Are you sure to Delete ?')" href="<?php echo base_url('admin/notice/delete/'.$this->functions->encode($records['id']));?>"
                                    title="Edit"><span class="fa fa-trash-o"></span>&nbsp;Delete</a>
                                </td>
                            </tr>
                    <?php endforeach;?>
           </tbody>
            <input type="hidden" name="action" />  
                </form>
        </table>
      </div>
    </div>
  </div>
  <?php else:?>
  <h4>No Notice Found</h4>
  <?php endif;?>
</div>
<script>
function CheckUncheckAll()
{
	var checks = document.getElementsByName('Id_List[]');
	for (i = 0; i < checks.length; i++)
	{
		if(checks[i].checked == true) 
			checks[i].checked = false;
		else
			checks[i].checked = true;
	}
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