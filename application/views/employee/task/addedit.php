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
            <i class="fa fa-list" style="padding-top:8px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('employee/home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Task / Operation</li>
            </ul>
            <h4><?php echo ucfirst ($action); ?> Task</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
	<div class="row">
		<div class="col-md-8">
			<form name="frmmodule" id="frmmodule" enctype="multipart/form-data" 
            action="<?php echo base_url('employee/task/'.$action);?>" 
            method="post">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!---------------form-group--------------------->
                        <input type="hidden" name="TaskId" 
                        value="<?=isset($record['TaskId'])?$record['TaskId']:'';?>" />
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Project :
                            </label>
                            <div class="col-sm-6">
                                <select id="ProjectId" name="ProjectId" required="required" 
                                class="form-control validate[required]">
                                    <option value="" selected="selected">Select Projects</option>
                                    <?php 
                                    foreach($projects as $project) 
                                    {
                                         echo '<option value="'.$project['ProjectId'].'">';
                                         echo $project['ProjectName'];
                                         echo '</option>';
                                    } 
                                    ?>		
                                    </select>
                                    <script>
                                    $('#ProjectId').val('<?=isset($record['ProjectId'])?$record['ProjectId']:'';?>');
                                    </script>
          <!-- =================== For Disable Drop down ====================== -->
                                    <?php
									if(isset($ProjectId) && $ProjectId !=0)
									: ?>
									 <script>
                                    $('#ProjectId').val('<?=isset($ProjectId)?$ProjectId:'';?>');
									$('#ProjectId').prop('disabled', true);
                                    </script>
                                    <input type="hidden" name="ProjectId" value="<?=$ProjectId;?>">		
									<?php
                                    endif;
									?>
         <!-- =================== For Disable Drop down ====================== -->                           								
                            </div>
                        </div> 
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Developer :
                            </label>
                            <div class="col-sm-6">
								<select id="UserId" name="UserId" required="required" 
                                class="form-control validate[required]">
                                <option value="" selected="selected">Select Developer</option>
                                <?php 
								foreach($developers as $dev) 
								{
									echo '<option value="'.$dev['UserId'].'">'.$dev['Name'].'</option>';
								} 
								?>		
								</select>
								<script>
                                $('#UserId').val('<?=isset($record['UserId'])?$record['UserId']:'';?>');
                                </script>									
                            </div>
                        </div>                                             
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Priority :
                            </label>
                            <div class="col-sm-2">
								<div class="rdio rdio-success">
                                    <input type="radio" name="TaskPriority" id="High" 
                                    value="High" <?php if(isset($record['TaskPriority']))
								 	if($record['TaskPriority']=='High')
									{echo 'checked="checked"';}?>>
                                    <label for="High">High</label>
                                </div>
                           </div>
                           <div class="col-sm-2">
								<div class="rdio rdio-warning">
                                    <input type="radio" name="TaskPriority" id="Medium" 
                                    value="Medium" <?php if(isset($record['TaskPriority']))
								 	if($record['TaskPriority']=='Medium')
									{echo 'checked="checked"';}?>>
                                    <label for="Medium">Medium</label>
                                </div>
                           </div>
                           <div class="col-sm-2">
								<div class="rdio rdio-danger">
                                    <input type="radio" name="TaskPriority" id="Low" 
                                    value="Low" <?php if(isset($record['TaskPriority']))
								 	if($record['TaskPriority']=='Low')
									{echo 'checked="checked"';}?>>
                                    <label for="Low">Low</label>
                                </div>
                           </div>
                           
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                               Task Name :
                            </label>
                            <div class="col-sm-6">
								<input type="text" id="TaskName" name="TaskName" 
                                required="required"  
                                value="<?=isset($record['TaskName'])?$record['TaskName']:'';?>" 
                                class="form-control">
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Description :
                            </label>
                            <div class="col-sm-9">
                            <textarea class="form-control" required="required" name="TaskDesc" 
                            rows="8"><?=isset($record['TaskDesc'])?$record['TaskDesc']:'';?></textarea>
                           </div>
                        </div> 
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                        		File Attachment :<br />
                            </label>
                            <div class="col-sm-5">
                                <input type="file" name="TaskAttachment[]" 
                                class="form-control" multiple="multiple" />
                                <br />
                                <p class="text-warning">You can choose multiple file for bulk 
                                attechment.Maximum file size is 2MB</p>
                            </div>
                            <div class="col-sm-4">
								<?php if(isset($record['TaskAttachment'])): ?>
                                    <h5 class="sm-title text-muted">Attachments</h5>
                                    <ul class="list-unstyled">
										<?php foreach(explode('|',$record['TaskAttachment']) as $file):?>								<?php if(!empty($file)): ?>
                                        <li>
                                        	<i class="fa fa-file-text-o mr5"></i> 
                                        <a href="<?=base_url('uploads/task_attachments/'.$file)?>" target="_blank"><?=$file;?></a> 
                                        </li>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                            </div>
                            <input type="hidden" name="OTaskAttachment" 
                        	value="<?=isset($record['TaskAttachment'])?$record['TaskAttachment']:'';?>" />
                        </div> 
                        <!---------------form-group---------------------> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Estimate Time:  <br />
                                <span class="text-info">(In hours)</span>
                            </label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                    </span>
                                    <div class="bootstrap-timepicker">
                                    <input name="TaskEstimateTime" type="text" 
                                    required="required"  
                                    value="<?=isset($record['TaskEstimateTime'])?$record['TaskEstimateTime']:'';?>" class="form-control NumbersOnly"/>
                                    </div>
                                </div>
                           </div>
                        </div> 
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-5">
                                <input type="submit" name="submit" id="btn-submit" class="btn btn-primary btn-metro mr5" 
                                value="Save"   />
                                <button type="reset" class="btn btn-dark btn-metro">Reset</button>
                            </div>
                        </div>                         
                    </div><!-- panel-body --> 
                </div><!-- panel -->
            </form>									
		</div>
    </div><!---end row--->
</div><!---end contentpanel--->
<script src="<?=base_url('assets/admin');?>/js/jquery.validate.min.js"></script>
<script type="text/javascript">

//===============================================================================
jQuery('.NumbersOnly').keyup(function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});
//===============================================================================
jQuery("#frmmodule").validate({
	highlight: function(element) {
		jQuery(element).closest('.form-control').removeClass('has-success').addClass('has-error');
	},
	success: function(element) {
		jQuery(element).closest('.form-control').removeClass('has-error');
	}        
});	
</script>
