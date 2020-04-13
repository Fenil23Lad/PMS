<style>
.valid {
	border-color: #24B120 !important;
}
label.error {
	color: #900;
}
.has-error {
	border-color: #900;
}
</style>
<div class="pageheader">
  <div class="media">
    <div class="pageicon pull-left"> <i class="fa fa-list" style="padding-top:8px;"></i> </div>
    <div class="media-body">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i></li>
        <li>Project Category</li>
      </ul>
      <h4>Project Category</h4>
    </div>
  </div>
  <!-- media --> 
</div>
<!-- pageheader --> 
<!--==========================PAGE CONTENT START=======================================================--->

<div class="contentpanel">
  <?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong><?php echo $this->session->flashdata('success') ?></strong> </div>
  <?php endif; ?>
    <?php if($this->administration->checkEmpTabAccess("Add Project Category")):?>
  <div class="row">
    <div class="col-md-8">
      <form name="frmmodule" id="frmmodule" 
            action="<?php echo base_url('employee/project_category/category_operation');?>" 
            method="post">
        <div class="panel panel-default">
          <div class="panel-body"> 
            <!---------------form-group--------------------->
            <input type="hidden" name="ProjectCategoryId" 
                        value="<?=isset($category['ProjectCategoryId'])?$category['ProjectCategoryId']:'0';?>" />
            <input type="hidden" name="operation" value="<?=$operation;?>" />
            <!---------------form-group--------------------->
            <div class="form-group">
              <label class="col-sm-3 control-label"> Project Category : </label>
              <div class="col-sm-9">
                <input type="text" id="ProjectCategoryName"  name="ProjectCategoryName" required="required"  
                                value="<?=isset($category['ProjectCategoryName'])?$category['ProjectCategoryName']:'';?>" 
                                class="form-control">
              </div>
            </div>
            <!---------------form-Buttons--------------------->
            <div class="form-group">
              <label class="col-sm-3 control-label"> Publish : </label>
              <div class="col-sm-5">
                <div class="ckbox ckbox-success">
                  <input type="checkbox" value='1' name="ProjectCategoryStatus" 
                                    <?php if(isset($category['ProjectCategoryStatus']))
								 	if($category['ProjectCategoryStatus']==1){echo 'checked="checked"';}?>
                                    id="ProjectCategoryStatus"/>
                  <label for="ProjectCategoryStatus">Active</label>
                </div>
              </div>
            </div>
            <!---------------form-group--------------------->
            <div class="form-group">
              <label class="col-sm-3 control-label"></label>
              <div class="col-sm-5">
                <input type="submit" name="Submit" class="btn btn-primary btn-metro mr5" 
                                value="<?=$operation=='add'?'Add':'Save'?>" >
                <button type="reset" class="btn btn-dark btn-metro">Reset</button>
              </div>
            </div>
          </div>
          <!-- panel-body --> 
        </div>
        <!-- panel -->
      </form>
    </div>
   
  </div>
   <?php endif; ?>
  <!---end row--->
  <div class="row">
    <div class="pull-left ml10">
      <?php if($this->administration->checkEmpTabAccess("Delete Project Category")):?>
      <div class="btn-group">
        <button type="button" class="btn btn-xs btn-primary btn-metro">Action</button>
        <button type="button" class="btn btn-xs btn-primary dropdown-toggle btn-metro" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
        <ul class="dropdown-menu pull-right" role="menu">
          <li> <a href="#" class="action-delete" 
                        onClick="return action_delete(document.recordlist)" > Delete </a> </li>
          <li> <a href="#" class="action-delete" 
                        onClick="return action_active(document.recordlist)" > Active </a> </li>
          <li> <a href="#" class="action-delete" o
                        onClick="return action_deactive(document.recordlist)"> Deactive </a> </li>
        </ul>
      </div>
      <?php endif; ?>
       <?php if($this->administration->checkEmpTabAccess("Add Project Category")):?>
      <div class="pull-right ml10"> <a class="btn btn-xs btn-primary btn-metro" 
                href="<?=base_url('employee/project_category/add')?>" title="Add New Category"> <i class="glyphicon glyphicon-plus"></i>&nbsp;Add New Category </a> 
      <?php endif; ?>
      </div>
    </div>

  </div>
 <?php if($this->administration->checkEmpTabAccess("Project Categories")):?>
  <div class="row">
    <div class="col-md-8">
      <div class="table-responsive">
        <form name="recordlist" id="mainform"  method="post" 
                action="<?php echo base_url('employee/project_category/category_operation') ?>">
          <table class="table table-primary table-bordered">
            <thead>
              <tr>
                <th class="table-header-check" style="text-align:center;"> 
                   <input type="checkbox" id="SellectAll" onclick="CheckAll()"/>
                </th>
                <th class="table-header-repeat line-left" > Category </th>
                <th class="table-header-repeat line-left"> Status </th>
                 <?php if($this->administration->checkEmpTabAccess("Edit Project Category")):?>
                <th class="table-header-repeat line-left"> Action </th>
                <?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php if (count($categories) == 0): ?>
              <tr>
                <td colspan="11" align="center">No record found.</td>
              </tr>
              <?php else: ?>
              <?php foreach ($categories as $record): ?>
              <tr>
                <td align="center" valign="middle"><input type="checkbox" name="Id_List[]" id="Id_List[]" 
                                            value="<?php echo $record['ProjectCategoryId']?>"></td>
                <td>&nbsp;<?php echo $record['ProjectCategoryName'];?></td>
                <td><?php
											 if($record['ProjectCategoryStatus']==1) 
											 	echo '&nbsp;<b class="text-success">Active</b>';
											 else 
											 	echo '&nbsp;<b class="text-danger">Inactive</b>';
											?></td>
                  <?php if($this->administration->checkEmpTabAccess("Edit Project Category")):?>
                <td><a href="<?php echo base_url('employee/project_category/edit/'.$record['ProjectCategoryId']);?>"
                                        	title="Edit"><span class="fa fa-edit"></span>&nbsp;Edit</a></td>
                  <?php endif; ?>                          
              </tr>
              <?php endforeach;?>
              <?php endif; ?>
            </tbody>
          </table>
          <input type="hidden" name="action" />
        </form>
      </div>
      <!-- table-responsive --> 
    </div>
  </div>
  <?php endif; ?>
  <!---end row---> 
</div>

<!---end contentpanel---> 
<script src="<?=base_url('assets/admin');?>/js/jquery.validate.min.js"></script> 
<script>
//======================================================================================
$('#frmmodule').validate({
	highlight: function(element) {
		jQuery(element).closest('.form-control').removeClass('has-success').addClass('has-error');
	},
	success: function(element) {
		jQuery(element).closest('.form-control').removeClass('has-error');
	},
	rules: {
			ProjectCategoryName: {
				required: true,
				remote: {
						url: "<?php echo base_url('employee/project_category/check_category_exists/'.(isset($category['ProjectCategoryId'])?$category['ProjectCategoryId']:'0'));?>",
						type: "post",
						data: {
							email: function(){ return $("#ProjectCategoryName").val(); }
						}
					}
			}
	},
	messages: {
			ProjectCategoryName: {
					required: "Please Provide Category.",
					remote: "Category is already exist, please choose diffrent"
			}
	}
});
//===================================================================================
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