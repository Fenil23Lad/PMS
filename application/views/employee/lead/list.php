<style>
.Note_Table{
	overflow: scroll !important;
	height: 350px !important;
	overflow-x: auto !important;
}
</style>
<div class="pageheader">
<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-calendar-o" style="padding-top:8px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Manage Lead</li>
            </ul>
            <h4>Manage Lead</h4>
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
            <form action="<?=base_url('employee/lead/search');?>" method="post">
                <div class="col-sm-10">
                    <input type="text" 
                    placeholder="Search Here..."
                    name="search_lead"
                    value="<?php if($this->session->userdata('search_lead')) 
                    echo $this->session->userdata('search_lead') ?>"
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
    	<div class="col-sm-12">
            <div class="pull-left sellect_all">                                 
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
                    href="<?php echo base_url('employee/lead/summary');?>" 
                    title="Create New Lead">
                    <i class="fa fa-dashboard"></i>&nbsp;Summary
                    </a>
                </div> 
                <div class="pull-right ml10">
                    <a class="btn btn-xs btn-primary btn-metro" 
                    href="<?php echo base_url('employee/lead/add');?>" 
                    title="Create New Lead">
                    <i class="glyphicon glyphicon-plus"></i>&nbsp;Create New Lead
                    </a>
                </div>   
            </div>
            <div class="pull-right mr10">
            <?php echo $this->pagination->create_links(); ?>
        </div>
        </div>
    </div>
   <div class="row">
        <div class="col-md-12">
            <div class="table-responsive" id="no-more-tables">
            <form name="recordlist" id="mainform"  method="post" 
                action="<?php echo base_url('employee/lead/action') ?>">
            	<table class="table table-primary table-bordered table-striped table-condensed cf">
                    <thead class="cf">
                         <tr>
                            <th  width="50px">
                            	<input type="checkbox" id="SellectAll"  onclick="CheckAll()" />
                            </th>
                            <th>
                            	Industry
                            </th>
                            <th>
                            	Company
                            </th>
                            <th>
                            	Contact Person
                            </th>
                            <th>
                            	Last Visit
                            </th>
                            <th>
                            	Next Visit
                            </th>
                            <th>
                            	Source
                            </th>
                            <th>
                            	Status
                            </th>
                            <th>
                            	Action
                            </th>
                        </tr>
					</thead>
                    <tbody>                                       
						<?php if (count($records) == 0): ?>
                            		<tr><td colspan="11" align="center">No record found.</td></tr>	
                        <?php else: ?>
                            <?php foreach ($records as $key=>$record): ?>
                                    <tr>
                                        <td data-title="Select" align="center" valign="middle">
                                            <input type="checkbox" name="Id_List[]" id="Id_List[]" 
                                            value="<?php echo $record['Id']?>">
                                        </td>
										<td data-title="Industry">
                                        	<?php echo $record['Industry'];?>
                                        </td>
										<td data-title="Company">
                                        	<?php echo $record['Company'];?>
                                        </td>
                                        <td data-title="Contact Person">
                                        	<?php echo $record['ContactName'];?>
                                        </td>
                                        <td data-title="Last Visit">
                                        	<?php 
											if(!empty($record['LastVisitOn']))
											echo date('d M Y',strtotime($record['LastVisitOn']));
											?>
                                        </td>
                                        <td data-title="Next Visit">
                                        	<?php 
											if(!empty($record['NextVisitOn']))
											echo date('d M Y',strtotime($record['NextVisitOn']));
											?>
                                        </td>
                                       <td data-title="Source">
                                        	<?php echo $record['LeadSource'];?>
                                        </td>
                                        <td data-title="Status">
                                        	<?php echo $record['LeadStage'];?>
                                        </td>
                                        <td data-title="Action" >
											<a class="btn-link"
                                                href="<?php echo base_url('employee/lead/edit/'.$this->functions->encode($record['Id']));?>" title="Edit User">
                                                    <span class="fa fa-edit"></span>&nbsp;Edit
                                            </a>
                                            &nbsp;|&nbsp;
                                            <a class="btn-link"
                                            onclick="model_open(<?=$record['Id']?>,'<?=$record['ContactName']?>','<?=$record['Title'].' at '.$record['Company']?>')"  
                                            data-toggle="modal" data-target=".bs-example-modal-lg" 
                                            href="#">Note</a>
                                        </td>
                                    </tr>
                            <?php endforeach;?>
                    	<?php endif; ?>
                   </tbody>
                </table>
                 <input type="hidden" name="action" />
                        <!--  end product-table................................... --> 
                    </form>
            </div><!-- table-responsive -->
        </div>
    </div>
</div>
<!-- ===================================== MODEL ====================================== -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-body">
            <div class="row">
            	<div class="col-md-7">
                	<h4>
                    <span class="text-primary contact_name"></span>
                     - (<small class="org_name"></small>)
                    </h4>
                    
            	</div>
                <div class="col-md-5">
                    <div class="input-group mb15" style="position:absolute">
                        <span class="input-group-addon">
                        <i class="fa fa-search"></i>
                        </span>
                    	<input type="text" id="NoteFilter" 
                        placeholder="Seach From Here..." class="form-control">
                    </div>
                	<button aria-hidden="true" data-dismiss="modal" 
              		class="close ml10" type="button">&times;</button>
                </div>
            </div>
            <div class="alert alert-success" style="display:none">
                Note Added Successfully.
            </div>
            <div class="alert alert-danger" style="display:none">
                Please Enter Note.
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive Note_Table">
                        <table class="table table-info .table-bordered .table-striped">
                            <thead>
                                 <tr>
                                    <th width="30px" style="text-align:center;">
                                        #
                                    </th>
                                    <th width="100px">
                                        Create By
                                    </th>
                                    <th width="150px">
                                        Date
                                    </th>
                                    <th>
                                        Note
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="note_list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mt10">
                <div class="col-md-10">
                    <input type="hidden" name="leadId" value=""/>
					<textarea class="form-control" name="Note"
                    placeholder="Enter Note Here..." rows="3"></textarea>
                </div>
                <div class="col-md-2">
					 <input type="button"  onclick="save_note()" 
                     class="btn btn-primary btn-metro mr10" value="Save"/> 
                </div>
            </div
          ></div>
      </div>
    </div>
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
//==============================================================================
function save_note()
{
	if($('textarea[name=Note]').val().length==0)
	{
		$('.alert-danger').fadeIn();
		$('textarea[name=Note]').focus();
		return false;
	}
	$('.alert-danger').fadeOut();
	$.post('<?=base_url('employee/lead/save_note')?>',
	{'leadId':$('input[name=leadId]').val(),'Note':$('textarea[name=Note]').val()},
	function(data){
		if(data==1)
		{
			$('.alert-success').fadeIn().fadeOut(10000);
			$('textarea[name=Note]').val('');
			$.get('<?=base_url('employee/lead/get_notes')?>/'+$('input[name=leadId]').val(),
			function(data){
				$('tbody#note_list').html(data);
			});
		}
	});
}
//==============================================================================
function model_open(id,name,org)
{
	$('.contact_name').html(name);
	$('.org_name').html(org);
	$('input[name=leadId]').val(id);
	$.get('<?=base_url('employee/lead/get_notes')?>/'+id,function(data){
		$('tbody#note_list').html(data);
	});
}
//==============================================================================
$('#NoteFilter').keyup(function (e) {

	var rex = new RegExp($(this).val(), 'i');
	$('#note_list tr').hide();
	$('#note_list tr').filter(function () {
		return rex.test($(this).text());
	}).show();

});

</script>