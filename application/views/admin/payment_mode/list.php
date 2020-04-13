<style>
.valid{
	border-color:#24B120 !important;
}
label.error{
	color:#900;
}
.has-error{
	border-color:#900;
}
</style>
<div class="pageheader">
	<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-money" style="padding-top:8px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li>
                <i class="fa fa-home"></i></li>
                <li>Payment Mode</li>
            </ul>
            <h4>Payment Mode</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
	<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <strong><?php echo $this->session->flashdata('success') ?></strong>
    </div>					
    <?php endif; ?>
	<div class="row">
		<div class="col-md-8">
			<form name="frmmodule" id="frmmodule" 
            action="<?php echo base_url('admin/payment_mode/PaymentMode_operation');?>" 
            method="post">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!---------------form-group--------------------->
                        <input type="hidden" name="PayModeId" 
                        value="<?=isset($payment_mode['PayModeId'])?$payment_mode['PayModeId']:'0';?>" />
                        <input type="hidden" name="operation" value="<?=$operation;?>" />
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <h5 class="text-right">Payment Mode :</h5>
                            </label>
                            <div class="col-sm-6">
								<input type="text" id="Name"  name="Name" required="required"  
                                value="<?=isset($payment_mode['Name'])?$payment_mode['Name']:'';?>"
                                class="form-control">
                           </div>
                            <div class="col-sm-3">
                                <input type="submit" name="Submit" 
                                class="btn btn-primary btn-metro mr5" 
                                value="<?=$operation=='add'?'Add':'Save'?>" >
                                <button type="reset" class="btn btn-dark btn-metro">Reset</button>
                            </div>
                        </div>                         
                    </div><!-- panel-body --> 
                </div><!-- panel -->
            </form>									
		</div>
    </div><!---end row--->
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
                </ul>
            </div>
            <div class="pull-right ml10">
                <a class="btn btn-xs btn-primary btn-metro" 
                href="<?=base_url('admin/payment_mode/add')?>" title="Add New Payment Mode">
                <i class="glyphicon glyphicon-plus"></i>&nbsp;Add New Payment Mode
                </a>
            </div> 
        </div>
    </div>
    <div class="row">	
		<div class="col-md-8">
               <div class="table-responsive">
                <form name="recordlist" id="mainform"  method="post" 
                action="<?php echo base_url('admin/payment_mode/PaymentMode_operation') ?>">
                <table class="table table-primary table-bordered">
                	<thead>
                         <tr>
                            <th class="table-header-check" style="text-align:center;">
                            	<input type="checkbox" onclick="CheckAll()" id="SellectAll" />
                            </th>
                            <th class="table-header-repeat line-left" >
                            PAyment Mode
                            </th>
                            <th class="table-header-repeat line-left">
                            Action
                            </th>
                        </tr>
					</thead>
                    <tbody>                                       
						<?php if (count($payment_modes) == 0): ?>
                           <tr><td colspan="11" align="center">No record found.</td></tr>	
                        <?php else: ?>
                            <?php foreach ($payment_modes as $record): ?>
                                    <tr>
                                        <td align="center" valign="middle">
                                            <input type="checkbox" name="Id_List[]" id="Id_List[]" 
                                            value="<?php echo $record['PayModeId']?>">
                                        </td>
                                        <td>
                                        	&nbsp;<?php echo $record['Name'];?>
                                        </td>
                                       
                                        <td>
                                     <a href="<?php echo base_url('admin/payment_mode/edit/'.$record['PayModeId']);?>"
                                        	title="Edit"><span class="fa fa-edit"></span>&nbsp;Edit</a>
                                        </td>
                                    </tr>
                            <?php endforeach;?>
                    <?php endif; ?>
                   </tbody>
                </table>
                <input type="hidden" name="action" />  
                </form>
            </div><!-- table-responsive -->								
		</div>
    </div><!---end row--->
</div><!---end contentpanel--->
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
			Name: {
				required: true,
				remote: {
						url: "<?php echo base_url('admin/payment_mode/check_type_exists/'.(isset($payment_mode['PayModeId'])?$payment_mode['PayModeId']:'0'));?>",
						type: "post",
						data: {
							email: function(){ return $("#Name").val(); }
						}
					}
			}
	},
	messages: {
			Name: {
					required: "Please Provide Payment Mode.",
					remote: "Payment Mode is already exist, please choose diffrent"
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