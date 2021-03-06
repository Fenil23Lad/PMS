<div class="pageheader">
    <div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-home"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('employee/home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Project Detail</li>
            </ul>
            <h4>Project Detail</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->

<!--======================Project Detail ============================= -->
<div class="contentpanel">

<!-- ====================== Project Summary ==================== --> 	
    <div class="row">
    	<div class="col-md-12">
        	<h3><?php echo $Project_details[0]['ProjectName'] ?></h3>
        	<p class="mb15">Summary of the 
			<?php echo $Project_details[0]['ProjectName'] ?>.</p>
        </div>
    </div>
    <div class="row panel panel-default">
        <div class="col-md-12" style="margin-top:10px;">
            <div class="col-md-4">
               <strong>Category :</strong> 
               <?php echo $Project_details[0]['ProjectCategoryName']; ?>
            </div>
            <div class="col-md-4">
               <strong>Total Task :</strong>
               <?php echo $Project_details[0]['total_task']; ?>
            </div>
            <div class="col-md-4">
               <strong>Completed Task :</strong> 
               <?php echo $Project_details[0]['complete_task']; ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-4">
               <strong>Remaining Task :</strong> 
               <?php 
               echo $Project_details[0]['total_task']-$Project_details[0]['complete_task'];  ?>
            </div>
            <div class="col-md-4">
               <strong>Created Date :</strong>
               <?php echo date('d-m-Y', strtotime($Project_details[0]['ProjectCreatedOn'])); ?>
            </div>
            <div class="col-md-4">
               <strong>Start Date :</strong>
               <?= isset($Project_details[0]['StartDate'])?date('d-m-Y h:i:s',strtotime($Project_details[0]['StartDate'])):'' ?>
            </div>
           
        </div>
        <div class="col-md-12">
			 <div class="col-md-4">
			  	<strong>Finish Date :</strong>
				<?= isset($Project_details[0]['FinishDate'])?date('d-m-Y h:i:s',strtotime($Project_details[0]['FinishDate'])):'' ?>   
			</div>
             <div class="col-md-4">
				 <strong>Project Priority :</strong> 
                <?php echo $Project_details[0]['ProjectPriority']; ?> 
			</div>
            <div class="col-md-4">
			   <strong>Project Stage :</strong> 
               <?php echo $Project_details[0]['ProjectStage']; ?> 
			</div>
            
              
		</div>
		<div class="col-md-12" style="margin-bottom:5px;">
			
            <div class="col-md-4">
			   <strong>Project Status :</strong> 
               <?php if($Project_details[0]['ProjectStatus'] == 1) 
			   { 
					echo "<span class='btn btn-success btn-xs btn-metro'>Active</span>";
			   }
			   else
			   {
				   echo "<span class='btn btn-danger btn-xs btn-metro'>Deactive</span>";
			   }?>
                
			</div>
              
		</div>
     </div> 
<!-- ============================= End Project Summary ==================== --> 

 <!-- ============================= Project Note ==================== --> 
  <?php if($Project_details[0]['Note'] != NULL) : ?>
        <div class="row panel panel-default">
           
            <div class="col-md-12" style="margin-top:10px; margin-bottom:5px;">
               <strong>Project Note :</strong> 
            </div>
             <div class="col-md-12" style="margin-bottom:10px;">   
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <?php echo $Project_details[0]['Note']; ?> 
            </div>   
            
        </div>
    <?php endif; ?>
 <!-- ============================= END Project Note ==================== -->
 
<!-- ============================= END Project Description ==================== -->   
  <div class="row panel panel-default">    
        <div class="col-md-12" style="margin-top:10px; margin-bottom:5px;">
            <strong>Project Description :</strong>
        </div>
        <div class="col-md-12" style="margin-bottom:10px;">  
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
           <?php echo $Project_details[0]['ProjectDesc']; ?> 
        </div>   
    </div> 
 <!-- ============================= END Project Description ==================== --> 
<!--=============================== Project Note Detail ============================= -->  
  <!--   <?php if($Project_details[0]['Note'] != NULL) { ?>
         <div class="row">
            <div class="col-md-12">
                <h4><?php echo $Project_details[0]['ProjectName']; ?> Details</h4>
                <hr/>   
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 panel panel-default">
                <?php echo $Project_details[0]['Note']; ?>
            </div>
        </div>
    <?php } ?>
-->
<!--======================END Note Project Detail ============================= -->

<!--===================== Project Attachment ============================= -->
 	<?php if($Project_details[0]['ProjectAttachment'] != NULL) { ?>
        <div class="row panel panel-default">
            <div class="col-md-12">
                
                    <h5 class="sm-title text-muted">Attachments</h5>
                    <ul class="list-unstyled">
                        <?php foreach(explode('|',$Project_details[0]['ProjectAttachment']) as $file):?>					
							<?php if(!empty($file)): ?>
                        		<li>
                            		<i class="fa fa-file-text-o mr5"></i> 
                        				<a href="<?=base_url('uploads/project_attachments/'.$file)?>" target="_blank"><?=$file;?>		</a> 
                        		</li>
                        	<?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
               
            </div>
        </div>
    <?php } ?>
<!--===================== Project Attachment ============================= -->
<!--===================== Project Task ============================= -->
	<div class="row">
    	<div class="col-md-7">
        	<h4>Task List</h4>
        </div>
        <div class="col-md-2">
        	<?php if($Project_details[0]['ProjectStatus'] != 0) :?>
			
			<?php if($this->administration->checkEmpTabAccess("Add Task") && $this->session->userdata('UserType') == 'Project Manager'){?>
            
            <a class="btn btn-primary btn-metro mr10" title="Add New Task" 
            href="<?=base_url('employee/task/add/'.$Project_details[0]['ProjectId'])?>">
            <span class="fa fa-plus"></span>&nbsp;
            Add New Task
            </a>
            
            <?php } elseif($this->administration->checkEmpTabAccess("Add Task") && $this->session->userdata('UserType') == 'Team Leader' && $Project_details[0]['ProjectAssignedTo'] == $this->session->userdata('UserId')) { ?>
            
            <a class="btn btn-primary btn-metro mr10" title="Add New Task" 
            href="<?=base_url('employee/task/add/'.$Project_details[0]['ProjectId'])?>">
            <span class="fa fa-plus"></span>&nbsp;
            Add New Task
            </a>
            
			<?php } ?>
           <?php endif;?>
           
           
           
        </div>
        <div class="col-md-3">
        	<?php if($this->administration->checkEmpTabAccess("Add Task") && $this->session->userdata('UserType') == 'Project Manager') {?>
            <a class="btn btn-primary btn-metro mr10" title="Generate Excel Sheet" 
            href="<?=base_url('employee/home/generateexcelfile/'.$Project_details[0]['ProjectId'])?>">
            <span class="fa  fa-file-excel-o"></span>&nbsp;
            Generate Excel Sheet
            </a>
           <?php } elseif($this->administration->checkEmpTabAccess("Add Task") && $Project_details[0]['ProjectAssignedTo'] == $this->session->userdata('UserId')) {?>
            <a class="btn btn-primary btn-metro mr10" title="Generate Excel Sheet" 
            href="<?=base_url('employee/home/generateexcelfile/'.$Project_details[0]['ProjectId'])?>">
            <span class="fa  fa-file-excel-o"></span>&nbsp;
            Generate Excel Sheet
            </a>
           <?php } ?>
        </div>
        
 <!-- ====================== Table For Pending Task =================== -->
    <?php if($Project_details[0]['run_task_details'] != NULL) : ?>
        <div class="col-md-12 panel panel-default">
        	<h5>Pending Task</h5>
            <div class="table-responsive" id="no-more-tables">
            	<table class="table table-primary table-bordered table-striped table-condensed cf">
                    <thead class="cf">
                        <tr>
                        <th>Task #</th>
                        <th>Task</th>
                        <th>Project</th>
                        <th>Priority</th>
                        <th>Assigned By</th>
                        <th>Assigned To</th>
                        <th>Assigned On</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($Project_details[0]['run_task_details'] as $record):?>
                        <tr>
                            <td data-title="Task #">
								&nbsp;<?=$record['TaskNo']?>
                            </td>
                            <td data-title="Task Name">
								<?=$record['TaskName']?>
                            </td>
                            <td data-title="Project Name">
								<?=$this->common->GetProjectNameById($record['ProjectId'])?>
                            </td>
                            <td data-title="Priority">
								<?php
								if($record['TaskPriority']=='High') 
									echo '<b class="text-success">High</b>';
								elseif($record['TaskPriority']=='Medium') 
									echo '<b class="text-warning">Medium</b>';
								else
									echo '<b class="text-danger">Low</b>';
								?>
                            </td>
                            <td data-title="Assigned By">
								<?=$this->common->GetUserNameById($record['TaskAssignedBy'])?>
                            </td>
                            <td data-title="Assigned To">
								<?=$this->common->GetUserNameById($record['UserId'])?>
                            </td>
                            <td data-title="Task Assigned On">
								<?=date('d-m-Y',strtotime($record['TaskAssignedOn']))?>
                            </td>                           
                            <td data-title="Action">
                              
							  <?php if($Project_details[0]['ProjectStatus'] == 1) :?>
							<?php if($this->administration->checkEmpTabAccess("Edit Task") && $this->session->userdata('UserType') == 'Project Manager') {?>							
							 
                                <a class="btn-link"
                                href="<?php echo base_url('employee/task/edit/'.$this->functions->encode($record['TaskId']));?>" title="Edit Task">
                                	<span class="fa fa-edit"></span>&nbsp;Edit
                                </a>
                                &nbsp;|&nbsp;
                                <?php }elseif($this->administration->checkEmpTabAccess("Edit Task") && $Project_details[0]['ProjectAssignedTo'] == $this->session->userdata('UserId')){?>
                                <a class="btn-link"
                                href="<?php echo base_url('employee/task/edit/'.$this->functions->encode($record['TaskId']));?>" title="Edit Task">
                                	<span class="fa fa-edit"></span>&nbsp;Edit
                                </a>
								<?php }?>
                                
                                <?php endif;?>
                               
                                 <?php if($Project_details[0]['ProjectStatus'] == 1) :?>
                                
                                <?php if($this->administration->checkEmpTabAccess("Delete Task") && $this->session->userdata('UserType') == 'Project Manager') {?>						
                              
                                <a class="btn-link"
                                onclick="return confirm('Are you sure to Delete ?')"
                                href="<?php echo base_url('employee/task/delete/'.$this->functions->encode($record['TaskId']));?>" title="Delete Task">
                                	<span class="fa fa-trash-o"></span>&nbsp;Delete
                                </a>
                                &nbsp;|&nbsp;
                                <?php } elseif($this->administration->checkEmpTabAccess("Delete Task") && $Project_details[0]['ProjectAssignedTo'] == $this->session->userdata('UserId')) {?>
                                 <a class="btn-link"
                                onclick="return confirm('Are you sure to Delete ?')"
                                href="<?php echo base_url('employee/task/delete/'.$this->functions->encode($record['TaskId']));?>" title="Delete Task">
                                	<span class="fa fa-trash-o"></span>&nbsp;Delete
                                </a>
								
								<?php } ?>
                               <?php endif;?>
                                <a class="btn-link"
                                href="<?php echo base_url('employee/task_manager/details/'.$this->functions->encode($record['TaskId']));?>" title="Task Details">
                                <span class="fa fa-search"></span>&nbsp;Details
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>       
        </div>
       <?php endif; ?> 
<!-- ================= End Pending Task ========================= -->  

<!-- ====================== Table For Complete Task =================== -->
        <?php if($Project_details[0]['complete_task_details'] != NULL) : ?>
        <div class="col-md-12 panel panel-default">
        	<h5>Complete Task</h5>
            <div class="table-responsive" id="no-more-tables">
            	<table class="table table-primary table-bordered table-striped table-condensed cf">
                    <thead class="cf">
                        <tr>
                        <th>Task #</th>
                        <th>Task</th>
                        <th>Project</th>
                        <th>Priority</th>
                        <th>Assigned By</th>
                        <th>Assigned To</th>
                        <th>Assigned On</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($Project_details[0]['complete_task_details'] as $record):?>
                        <tr>
                            <td data-title="Task #">
								&nbsp;<?=$record['TaskNo']?>
                            </td>
                            <td data-title="Task Name">
								<?=$record['TaskName']?>
                            </td>
                            <td data-title="Project Name">
								<?=$this->common->GetProjectNameById($record['ProjectId'])?>
                            </td>
                            <td data-title="Priority">
								<?php
								if($record['TaskPriority']=='High') 
									echo '<b class="text-success">High</b>';
								elseif($record['TaskPriority']=='Medium') 
									echo '<b class="text-warning">Medium</b>';
								else
									echo '<b class="text-danger">Low</b>';
								?>
                            </td>
                            <td data-title="Assigned By">
								<?=$this->common->GetUserNameById($record['TaskAssignedBy'])?>
                            </td>
                            <td data-title="Assigned To">
								<?=$this->common->GetUserNameById($record['UserId'])?>
                            </td>
                            <td data-title="Task Assigned On">
								<?=date('d-m-Y',strtotime($record['TaskAssignedOn']))?>
                            </td>                          
                            <td data-title="Action">
                            <?php if($Project_details[0]['ProjectStatus'] == 1) :?>
							<?php if($this->administration->checkEmpTabAccess("Edit Task") && $this->session->userdata('UserType') == 'Project Manager') {?>							
							 
                                <a class="btn-link"
                                href="<?php echo base_url('employee/task/edit/'.$this->functions->encode($record['TaskId']));?>" title="Edit Task">
                                	<span class="fa fa-edit"></span>&nbsp;Edit
                                </a>
                                &nbsp;|&nbsp;
                                <?php }elseif($this->administration->checkEmpTabAccess("Edit Task") && $Project_details[0]['ProjectAssignedTo'] == $this->session->userdata('UserId')){?>
                                <a class="btn-link"
                                href="<?php echo base_url('employee/task/edit/'.$this->functions->encode($record['TaskId']));?>" title="Edit Task">
                                	<span class="fa fa-edit"></span>&nbsp;Edit
                                </a>
								<?php }?>
                                
                                <?php endif;?>
                                <?php if($Project_details[0]['ProjectStatus'] == 1) :?>
                                
                                <?php if($this->administration->checkEmpTabAccess("Delete Task") && $this->session->userdata('UserType') == 'Project Manager') {?>						
                              
                                <a class="btn-link"
                                onclick="return confirm('Are you sure to Delete ?')"
                                href="<?php echo base_url('employee/task/delete/'.$this->functions->encode($record['TaskId']));?>" title="Delete Task">
                                	<span class="fa fa-trash-o"></span>&nbsp;Delete
                                </a>
                                &nbsp;|&nbsp;
                                <?php } elseif($this->administration->checkEmpTabAccess("Delete Task") && $Project_details[0]['ProjectAssignedTo'] == $this->session->userdata('UserId')) {?>
                                 <a class="btn-link"
                                onclick="return confirm('Are you sure to Delete ?')"
                                href="<?php echo base_url('employee/task/delete/'.$this->functions->encode($record['TaskId']));?>" title="Delete Task">
                                	<span class="fa fa-trash-o"></span>&nbsp;Delete
                                </a>
								
								<?php } ?>
                               <?php endif;?>
                                <a class="btn-link"
                                href="<?php echo base_url('employee/task_manager/details/'.$this->functions->encode($record['TaskId']));?>" title="Task Details">
                                <span class="fa fa-search"></span>&nbsp;Details
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>       
        </div>
        <?php endif; ?>
<!-- ================= End Complete Task ========================= -->         
    </div>

<!--===================== End Project Task ============================= -->

</div>