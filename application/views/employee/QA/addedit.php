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
                <li>QA /Operation</li>
            </ul>
            <!--<h4><?php echo ucfirst ($action); ?> Task</h4>-->
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
		<div class="col-md-8">
			<form name="frmmodule" id="frmmodule" enctype="multipart/form-data" 
            action="<?php echo base_url('employee/qa/'.$action);?>" 
            method="post">
               
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!---------------form-group--------------------->
                      <!--  <input type="hidden" name="QAId" 
                        value="<?=isset($record['qa_id'])?$record['qa_id']:'';?>" />-->
                       
                       <input type="hidden" name="ProjectId" 
                        value="<?=$project['ProjectId']?>" /> 
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Project :
                            </label>
                            <div class="col-sm-6">
                            
                                <input type="text" id="Project" name="Project" value="<?php echo $project['ProjectName']?>" class="form-control" disabled="disabled">
                                  
         
                                    								
                            </div>
                        </div> 
                       
                  <!---------------form-group--------------------->         
                          
                         <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Task :
                            </label>
                            <div class="col-sm-6">
                                <select id="TaskId" name="TaskId" required="required" 
                                class="form-control validate[required]" >
                                    <option value="" selected="selected">Select Task</option>
                                    <?php 
                                    foreach($tasks as $task) 
                                    {
                                         echo '<option value="'.$task['TaskId'].'">';
                                         echo $task['TaskName'];
                                         echo '</option>';
                                    } 
                                    ?>		
                                    </select>
                                    <script>
                                    $('#TaskId').val('<?=isset($task['TaskId'])?$task	['TaskId']:'';?>');
                                    </script>
         
                                    								
                            </div>
                        </div>
                        
                    <!---------------form-group--------------------->  
                         <div class="form-group">
                            <label class="col-sm-3 control-label">        
                               Task Status :
                            </label>
                            <div class="col-sm-6">
                                <select id="status" name="status" required="required" 
                                class="form-control validate[required]" >
                                    <option value="" selected="selected">Select Task Status</option>
                                  	<option value="Tested">Tested</option>
                                    <option value="Bug">Bug</option>
                                    </select>
                                  <script>
                                    $('#status').val('<?=isset($task['TaskStatus'])?$task	['TaskStatus']:'';?>');
                                    </script>
         
                                    								
                            </div>
                        </div>                                         
                        <!---------------form-group--------------------->
                        
                         <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Comment :
                            </label>
                            <div class="col-sm-9">
                            <textarea class="form-control" required="required" name="Comment" 
                            rows="8"><?=isset($record['Comment'])?$record['Comment']:'';?></textarea>
                           </div>
                        </div> 
                        <!---------------form-group--------------------->
                       <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-5">
                            <?php if($action != "details") { ?>
                                <input type="submit" name="submit" id="btn-submit" class="btn btn-primary btn-metro mr5" 
                                value="Save"   />
                                <button type="reset" class="btn btn-dark btn-metro">Reset</button>						
                             <?php } else { ?>
							<a href="<?= base_url('employee/qa')?>"><button type="button" class="btn btn-dark btn-metro">Back</button></a>											 							<?php } ?>    
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
