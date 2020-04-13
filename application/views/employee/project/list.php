<style>

.contact-group .media-content ul > li {

  min-width: 50px;

  margin-right:15px;

}

.media-content ul{

	margin-top:5px !important;

}

</style>

<div class="pageheader">

<div class="media">

        <div class="pageicon pull-left">

            <i class="fa fa-suitcase" style="padding-top:8px;"></i>

        </div>

        <div class="media-body">

            <ul class="breadcrumb">

                <li><a href="<?=base_url('employee/project');?>">

                <i class="glyphicon glyphicon-home"></i></a></li>

                <li>Project</li>

            </ul>

            <h4>Project</h4>

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

            <form action="<?=base_url('employee/project/search');?>" method="post">

                <div class="col-sm-10">

                    <input type="text" 

                    placeholder="Search from Here..."

                    name="search_project"

                    value="<?php if($this->session->userdata('search_project')) 

                    echo $this->session->userdata('search_project') ?>"

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
          <?php if($this->administration->checkEmpTabAccess("Delete  Project")):?>	
             
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

                    </ul>

                </div>
            <?php endif; ?>    
			<?php if($this->administration->checkEmpTabAccess("Add Project")):?>

                                                              

                <div class="pull-right ml10">

                    <a class="btn btn-xs btn-primary btn-metro" href="<?php echo base_url('employee/project/add');?>" 

                    title="Add New Post">

                    <i class="glyphicon glyphicon-plus"></i>&nbsp;Add New Project

                    </a>

                </div> 

           
			
            <?php endif; ?>
			</div>
            <div class="pull-right mr10">

                <?php echo $this->pagination->create_links(); ?>

            </div>

        </div>

    </div>
 <form name="recordlist" id="mainform"  method="post" 

    action="<?php echo base_url('employee/project/action');?>">

    <div class="row"> 

    	<div class="col-sm-12">

            <div class="list-group contact-group">
				<?php $RoleName=$this->common->GetRolebyid();?>
                <?php foreach($records as $key=>$record): ?>	
		<?php if($record['ProjectStatus'] == 1 || $RoleName['RoleName'] == 'Project Manager') :?>
                <div class="list-group-item record">

                    <div class="media">
 
                        <div class="media-body">
                <?php if($this->administration->checkEmpTabAccess("Delete  Project")):?>	          
							 <div class="ckbox ckbox-primary pull-left">

                                <input type="checkbox" id="A<?=$key?>" name="Id_List[]" 

                                value="<?php echo $record['ProjectId']?>"/>

                                <label for="A<?=$key?>"></label>

                            </div> 
      			 <?php endif; ?>                     
                            <h4 class="media-heading" style="margin-bottom:5px;">

                                <a href="<?=base_url('employee/home/project/'.$record['ProjectId'])?>">

									<?=$record['ProjectName'];?> 

                                    - [ <?=$this->common->GetCategoryNameById($record['ProjectCategoryId'])?> ]

                                </a>

                                  <?php if($this->administration->checkEmpTabAccess("Update Project Status")):?>

                                <?php if($record['ProjectStatus'] == 0) {?>
                                <a class="btn btn-success btn-xs btn-metro pull-right ml10"

                                href="<?php echo base_url('employee/project/Inactive/'.$this->functions->encode($record['ProjectId']).'/Active');?>"

                                title="Active Project Status" onclick="return confirm('Are you sure to Active Project ?')">

                                &nbsp;	<span class="fa fa-suitcase"></span>&nbsp;&nbsp;&nbsp;Active

                                </a>
								<?php  } else { ?>
                                 <a class="btn btn-danger btn-xs btn-metro pull-right ml10"

                                href="<?php echo base_url('employee/project/Inactive/'.$this->functions->encode($record['ProjectId']).'/DeActive');?>"

                                title="DeActive Project Status" onclick="return confirm('Are you sure to DeActive Project ?')">

                                	<span class="fa fa-suitcase"></span>&nbsp;Deactive

                                </a>
                                <?php } ?>
                                
                                <?php endif; ?>
								
								
								<?php if($this->administration->checkEmpTabAccess("Edit Project")):?>

                                <a class="btn btn-primary btn-xs btn-metro pull-right"

                                href="<?php echo base_url('employee/project/edit/'.$this->functions->encode($record['ProjectId']));?>"

                                title="Edit Thread">

                                	<span class="fa fa-edit"></span>&nbsp;Edit

                                </a>

                                <?php endif; ?>
                                
                              


                            </h4>

                            <div class="media-content">

                                <ul class="list-unstyled">

                                    <li>

                                        <strong>Clinet :</strong>

                                        <span class="text-warning">

											<?=$record['ProjectClientName']?>

                                        </span>

                                    </li>

                                    <li>

                                        <strong>Created By :</strong>

                                        <span class="text-warning">

											<?=$this->common->GetUserNameById($record['ProjectCreatedBy'])?>

                                        </span>

                                    </li>
									<li>

                                        <strong>Assigned To :</strong>

                                        <span class="text-warning">

                                        <?php 

										if($record['ProjectAssignedTo']==0)

											echo '<span class="label label-danger">Pending</span>';

										else

											echo $this->common->GetUserNameById($record['ProjectAssignedTo']);

										?>

                                        </span>

                                    </li>
                                    <li>

                                        <strong>Created Date :</strong>

                                        <span class="text-warning">

											<?=date('j F, Y',strtotime($record['ProjectCreatedOn']))?>

                                        </span>

                                    </li>
									<li>

                                        <strong>Start Date :</strong>

                                        <span class="text-warning">

											<?=isset($record['StartDate'])?date('j F, Y h:i:s',strtotime($record['StartDate'])):''?>

                                        </span>

                                    </li>
                                     <li>

                                        <strong>Finish Date :</strong>

                                        <span class="text-warning">

											<?=isset($record['FinishDate'])?date('j F, Y h:i:s',strtotime($record['FinishDate'])):''?>

                                        </span>

                                    </li>
                                    

                                </ul>

                            </div>

                            <div class="media-content">

                                <ul class="list-unstyled">

                                    <li>

                                        <strong>Status :</strong>

                                        <?php

											if($record['ProjectStage']=='Requirment Collected')

												$stage ='danger';

											elseif($record['ProjectStage']=='Delivered')

												$stage ='success';

											else

												$stage ='warning';

										?>

                                        <span class="label label-<?=$stage;?>"><?=$record['ProjectStage']?></span>

                                       

                                    </li>

                                    <li>

                                        <strong>

                                        	Priority :

                                        </strong>

                                        <?php

                                        if($record['ProjectPriority']=='High') 

                                            echo '<span class="label label-success">High</span>';

                                        elseif($record['ProjectPriority']=='Medium') 

                                            echo '<span class="label label-warning">Medium</span>';

										else

											echo '<span class="label label-danger">Low</span>';

                                        ?>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div><!-- media -->

                </div><!-- list-group -->    
			<?php endif; ?>
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
