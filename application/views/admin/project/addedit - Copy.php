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
            <i class="fa fa-suitcase" style="padding-top:8px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('admin/home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Project / Operation</li>
            </ul>
            <h4><?php echo ucfirst ($action); ?> Project</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
	<div class="row">
		<div class="col-md-8">
			<form name="frmmodule" id="frmmodule" enctype="multipart/form-data" 
            action="<?php echo base_url('admin/project/'.$action);?>" 
            method="post">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!---------------form-group--------------------->
                        <input type="hidden" name="ProjectId" 
                        value="<?=isset($record['ProjectId'])?$record['ProjectId']:'';?>" />
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Project Category  :
                            </label>
                            <div class="col-sm-6">
								<select id="ProjectCategoryId" name="ProjectCategoryId" 
                                required="required" 
                                class="form-control validate[required]">
                                <option value="" selected="selected">Select Project Category </option>
                                <?php 
								foreach($categories as $cat) 
								{
									echo '<option value="'.$cat['ProjectCategoryId'].'">'.$cat['ProjectCategoryName'].'</option>';
								} 
								?>		
								</select>
								<script>
                                $('#ProjectCategoryId').val('<?=isset($record['ProjectCategoryId'])?$record['ProjectCategoryId']:'';?>');
                                </script>									
                            </div>
                            <div class="col-sm-1">
                            	<a href="<?=base_url('admin/project_category');?>" title="Manage Project Category">
                                <h3 style="margin:5px 0px">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                </h3>
                                </a>
                            </div>
                        </div>                                             
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                               Project Name :
                            </label>
                            <div class="col-sm-6">
								<input type="text" id="ProjectName" name="ProjectName" 
                                required="required"  
                                value="<?=isset($record['ProjectName'])?$record['ProjectName']:'';?>" 
                                class="form-control">
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                               Client Name :
                            </label>
                            <div class="col-sm-6">
								<input type="text" id="ProjectClientName" 
                                name="ProjectClientName" required="required"  
                                value="<?=isset($record['ProjectClientName'])?$record['ProjectClientName']:'';?>" 
                                class="form-control">
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Priority :
                            </label>
                            <div class="col-sm-2">
								<div class="rdio rdio-success">
                                    <input type="radio" name="ProjectPriority" id="High" 
                                    value="High" <?php if(isset($record['ProjectPriority']))
								 	if($record['ProjectPriority']=='High')
									{echo 'checked="checked"';}?>>
                                    <label for="High">High</label>
                                </div>
                           </div>
                           <div class="col-sm-2">
								<div class="rdio rdio-warning">
                                    <input type="radio" name="ProjectPriority" id="Medium" 
                                    value="Medium" <?php if(isset($record['ProjectPriority']))
								 	if($record['ProjectPriority']=='Medium')
									{echo 'checked="checked"';}?>>
                                    <label for="Medium">Medium</label>
                                </div>
                           </div>
                           <div class="col-sm-2">
								<div class="rdio rdio-danger">
                                    <input type="radio" name="ProjectPriority" id="Low" 
                                    value="Low" <?php if(isset($record['ProjectPriority']))
								 	if($record['ProjectPriority']=='Low')
									{echo 'checked="checked"';}?>>
                                    <label for="Low">Low</label>
                                </div>
                           </div>
                           
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Description :
                            </label>
                            <div class="col-sm-9">
                            <textarea class="form-control" required="required" name="ProjectDesc" 
                            rows="8"><?=isset($record['ProjectDesc'])?$record['ProjectDesc']:'';?></textarea>
                           </div>
                        </div> 
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                        		File Attachment :<br />
                            </label>
                            <div class="col-sm-5">
                                <input type="file" name="ProjectAttachment[]" 
                                class="form-control" multiple="multiple" />
                                <br />
                                <p class="text-warning">You can choose multiple file for bulk 
                                attechment.Maximum file size is 2MB</p>
                            </div>
                            <div class="col-sm-4">
								<?php if(isset($record['ProjectAttachment'])): ?>
                                    <h5 class="sm-title text-muted">Attachments</h5>
                                    <ul class="list-unstyled">
										<?php foreach(explode('|',$record['ProjectAttachment']) as $file):?>								<?php if(!empty($file)): ?>
                                        <li>
                                        	<i class="fa fa-file-text-o mr5"></i> 
                                        <a href="<?=base_url('uploads/project_attachments/'.$file)?>" target="_blank"><?=$file;?></a> 
                                        </li>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                            </div>
                            <input type="hidden" name="OProjectAttachment" 
                        	value="<?=isset($record['ProjectAttachment'])?$record['ProjectAttachment']:'';?>" />
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
                                    <input name="EstimateTime" type="text"  
                                    value="<?=isset($record['EstimateTime'])?$record['EstimateTime']:'';?>" class="form-control NumbersOnly"/>
                                    </div>
                                </div>
                           </div>
                        </div> 
                        <!---------------form-group---------------------> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Estimate Start Date :
                            </label>
                            <div class="col-sm-6">
								<input type="text" id="datepicker" name="EstimateStartDate" required="required"  
                   value="<?=isset($record['EstimateStartDate'])?$record['EstimateStartDate']:'';?>" 
                                class="form-control">
                           </div>
                        </div>
                        <!---------------form-group---------------------> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Assigned To :
                            </label>
                            <div class="col-sm-6">
								<select id="ProjectAssignedTo" name="ProjectAssignedTo" 
                                required="required" 
                                class="form-control validate[required]">
                                <option value="" selected="selected">Select Employee </option>
                                <?php 
								foreach($ProjectAssignee as $emp) 
								{
									echo '<option value="'.$emp['UserId'].'">';
									echo $emp['Name']." - (".$emp['RoleName'].')';
									echo '</option>';
								} 
								?>		
								</select>
                                <script>
                                $('#ProjectAssignedTo').val('<?=isset($record['ProjectAssignedTo'])?empty($record['ProjectAssignedTo'])?'':$record['ProjectAssignedTo']:'';?>');
                                </script>	
                           </div>
                        </div> 
                        <!---------------form-group---------------------> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Project Stage :
                            </label>
                            <div class="col-sm-6">
								<select id="ProjectStage" name="ProjectStage" 
                                required="required" 
                                class="form-control validate[required]">
                                    <option value="" selected="selected">
                                    Select Project Stage</option>
                                    <option>Requirment Collected</option>
                                    <option>Under Analysis</option>
                                    <option>Under Design Phase</option>
                                    <option>Under User Interface Design</option>
                                    <option>Under Developing</option>
                                    <option>Under Testing Phase</option>
                                    <option>Deployment</option>
                                    <option>Delivered</option>
                                    <option>Under Bug Fixing</option>
                                    <option>Requrment Chnages</option>		
								</select>
                                <script>
                                $('#ProjectStage').val('<?=isset($record['ProjectStage'])?$record['ProjectStage']:'';?>');
                                </script>	
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
<script src="<?php echo  base_url();?>assets/admin/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo  base_url();?>assets/admin/js/bootstrap-timepicker.min.js"></script>	
<script src="<?=base_url('assets/admin');?>/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
    $('#datepicker').datepicker();
});

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
