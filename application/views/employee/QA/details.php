<style>
.task_info p{
	margin-bottom:0px;
}
.parent{
	background-color:#DFF1FF;
	border:1px solid #7CDCFC;
}
.child{
	background-color:#FFE9E6;
	border:1px solid #FCCDC7;	
}
.comment{
	margin:5px;
	padding:5px;
	border-radius:5px;
}
.comment .text{
	 margin:5px 5px 10px 5px;
	 font-size:17px;
}
</style>
<div class="pageheader">
<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-list" style="padding-top:8px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('employee/qa');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Project</li>
                <li>Details</li>
            </ul>
            <h4>Project Details</h4>
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
   <div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-primary">
			<div class="panel-heading" style="padding:10px">
                <h3 class="panel-title" style="margin:0px">
				<?=$projects['ProjectName']?>
                </h3>
            </div>
            <div class="panel-body">
                <div class="row task_info">
                    <div class="col-sm-8 col-md-8">
                       <ul class="list-group">
                             
                            <li class="list-group-item">
                                 <div class="row">
                                    <p class="col-sm-2 col-md-2">
                                        <strong>Task # :</strong>
                                    </p>
                                    <h4 class="col-sm-2 col-md-2" style="margin:0px">
                                        <?=$projects['TaskNo']?>
                                    </h4>
                                 </div>
                            </li>
                            <li class="list-group-item">
                                 <div class="row">
                                    <p class="col-sm-2 col-md-2">
                                        <strong>Project :</strong>
                                    </p>
                                    <p class="col-sm-4 col-md-4">
                                        <?=$projects['ProjectName']?>
                                    </p>
                                    <p class="col-sm-3 col-md-3">
                                        <strong>Priority :</strong>
                                    </p>
                                    <p class="col-sm-3 col-md-3">
										<?php
											if($projects['TaskPriority']=='High') 
											echo '<b class="text-success">High</b>';
											elseif($projects['TaskPriority']=='Medium') 
											echo '<b class="text-warning">Medium</b>';
											else
											echo '<b class="text-danger">Low</b>';
                                        ?>
                                    </p>
                                 </div>
                            </li>
                            <li class="list-group-item">
                                 <div class="row">
                                    <p class="col-sm-2 col-md-2">
                                        <strong>Assigned To :</strong>
                                    </p>
                                    <p class="col-sm-4 col-md-4">
                                        <?=$this->common->GetUserNameById($projects['UserId'])?>
                                    </p>
                                    <p class="col-sm-3 col-md-3">
                                        <strong>Estimate Time :</strong>
                                    </p>
                                    <p class="col-sm-3 col-md-3">
                                      <?=$projects['TaskEstimateTime']?> Hr.
                                    </p>
                                 </div>
                            </li>
                            <li class="list-group-item">
                                 <div class="row">
                                    <p class="col-sm-2 col-md-2">
                                        <strong>Assigned By :</strong>
                                    </p>
                                    <p class="col-sm-4 col-md-4">
                                       <?=$this->common->GetUserNameById($projects['TaskAssignedBy'])?>
                                    </p>
                                    <p class="col-sm-3 col-md-3">
                                        <strong>Assigned On :</strong>
                                    </p>
                                    <p class="col-sm-3 col-md-3">
                                      <?=date('j F, Y',strtotime($projects['TaskAssignedOn']))?>
                                    </p>
                                 </div>
                            </li>
                            <li class="list-group-item">
                                 <div class="row">
                                    <p class="col-sm-2 col-md-2">
                                        <strong>Project Start Date :</strong>
                                    </p>
                                    <p class="col-sm-4 col-md-4">
                                      <?=date('Y/m/d',strtotime($projects['StartDate']))?>
                                    </p>
                                     <p class="col-sm-3 col-md-3">
                                        <strong>Project End Date :</strong>
                                    </p>
                                    <p class="col-sm-3 col-md-3">
                                      <?=date('Y/m/d',strtotime($projects['FinishDate']))?>
                                    </p>
                                 </div>
                            </li>
                            <li class="list-group-item">
                                 <div class="row">
                                    <p class="col-sm-2 col-md-2">
                                        <strong>Project Description :</strong>
                                    </p>
                                    <p class="col-sm-10 col-md-10">
                                      <?=$projects['ProjectDesc']?>
                                    </p>
                                 </div>
                            </li>
                            
                            <li class="list-group-item">
                                 <div class="row">
                                    <p class="col-sm-2 col-md-2">
                                        <strong>Task Details :</strong>
                                    </p>
                                    <p class="col-sm-10 col-md-10">
                                      <?=$projects['TaskDesc']?>
                                    </p>
                                 </div>
                            </li>
                             <li class="list-group-item">
                                 <div class="row">
                                    <p class="col-sm-2 col-md-2">
                                        <strong>Task Status :</strong>
                                    </p>
                                    <p class="col-sm-4 col-md-4">
                                      <?=$projects['TaskStatus']?>
                                    </p>
                                 </div>
                            </li>
                                   
                       </ul>
                    </div>
                    
                </div>
            </div><!-- panel-body -->
       </div><!-- panel -->
   </div>
</div>  
    
    
      
<!-- ================== Comment ============================== -->
  <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading" style="padding:10px">
                    <h3 class="panel-title" style="margin:0px">Comments</h3>
                </div>
                <div class="panel-body">
                    <div class="row"> 
                        <div class="col-sm-12">
                            <div class="list-group">
                            <?php if($comments) :?>	
                                <?php foreach($comments as $Comment): ?>
                                <div class="row">
                                    <div class="col-sm-10 comment parent">
                                        <p id="<?=$Comment['qa_id']?>" 
                                        class="text"><?=$Comment['Comment'];?></p>
                                        <span class="fa fa-user"></span>
                                        &nbsp;<?=$this->common->GetUserNameById($Comment['UserId'])?>                   
                                        &nbsp; &nbsp;|&nbsp;
                                        <span class="fa fa-clock-o"></span>
                                        &nbsp;
                                        <?=$this->functions->time_ago($Comment['CommentCreatedOn']);?>
                                       
                                        <?php if($this->administration->checkEmpTabAccess("Edit QA")) :?>
                                        &nbsp;|&nbsp; 
                                        <a onclick="modeledit(<?=$Comment['qa_id']?>,<?=$Comment['ProjectId']?>,<?=$Comment['TaskId']?>)" 
                                        data-toggle="modal" data-target=".bs-example-modal-lg" 
                                        href="#"
                                        title="Edit">
                                        <span class="fa fa-edit"></span>
                                        &nbsp;Edit
                                        </a>
                                        <?php endif ?>
                                        &nbsp;
                                        
                                       <!-- <a onclick="modelreply(<?=$Comment['qa_id']?>)" 
                                        data-toggle="modal" data-target=".bs-example-modal-lg" 
                                        href="#"
                                        title="Reply">
                                        <span class="fa fa-reply"></span>
                                        &nbsp;Reply
                                        </a>-->
                                        
                                         <?php if($this->administration->checkEmpTabAccess("Delete QA")) :?>
                                         <a href="<?=base_url('employee/qa/delete_comment/'.$Comment['qa_id']."/".$Comment['ProjectId']."/".$Comment['TaskId'])?>"
                                        onclick="return confirm('Are you sure to Delete ?')" 
                                        title="Delete">
                                        <span class="fa fa-trash-o"></span>
                                        &nbsp;Delete
                                        </a>
                                        <?php endif ?>
                                        &nbsp;
                         			</div>
                                </div>
                                
                   
  								<?php endforeach; ?>
                               <?php endif;?> 
                            </div>
                        </div>
                    </div> 
                </div>
           </div>
        </div>
  </div>
                  
                            
 <!-- ================== END Comment ============================== -->   
</div>


<!-- ===================================== MODEL ====================================== -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:650px;">
      <div class="modal-content">
          <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" class="close" 
              type="button">&times;</button>
              <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            	<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <form id="model_form" method="post" 
                            action="<?php echo base_url('employee/qa/save_comment');?>">
                            <input type="hidden" name="qa_id"/>
                            <input type="hidden" name="project_id"/>
                            <input type="hidden" name="task_id"/>
                        
                            <div class="panel-body">
                                <!---------------form-group--------------------->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">
                                      Comment :
                                    </label>
                                    <div class="col-sm-9">
                                        <textarea  rows="4" name="CommentText" required="required"
                                        class="form-control"></textarea>
                                   </div>
                                </div>
                                <!---------------form-group--------------------->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"></label>
                                    <div class="col-sm-5">
                                        <input type="submit" name="submit" id="btn_submit" 
                                        class="btn btn-primary btn-metro mr5" 
                                        value="Save"   />
                                        <button type="reset" class="btn btn-dark btn-metro">Reset</button>
                                    </div>
                                </div>                        
                            </div><!-- panel-body --> 
                            </form>
                        </div><!-- panel -->								
                    </div>
                </div><!---end row--->
          </div>
      </div>
    </div>
</div>
<!-- ================================== END  MODEL =================================== -->
<script>
//=====================================================================
function modeledit(id,projectid,taskid)
{
	$('h4.modal-title').html('Update Comment Information');
	$('input[name=qa_id]').val(id);
	$('input[name=project_id]').val(projectid);
	$('input[name=task_id]').val(taskid);
	$('textarea[name=CommentText]').html($('.comment p#'+id).html());
}
//=====================================================================
function modelreply(id)
{
	$('h4.modal-title').html('Reply to Comment');
	$('input[name=CommentId]').val(id);
	$('input[name=action]').val('reply');
	$('input[name=ParentId]').val(id);
	$('textarea[name=CommentText]').html('');
}
//===============================================================================
</script>