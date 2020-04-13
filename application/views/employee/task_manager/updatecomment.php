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
                <li><a href="<?=base_url('admin/home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Comment / Operation</li>
            </ul>
            <h4>Edit Comment</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
	<div class="row">
		<div class="col-md-10">
			<form name="frmmodule" id="frmmodule" enctype="multipart/form-data" 
            action="<?php echo base_url('employee/task_manager/edit_comment');?>" 
            method="post">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!---------------form-group--------------------->
                        <input type="hidden" name="CommentId" 
                        value="<?=isset($record[0]['CommentId'])?$record[0]['CommentId']:'';?>" />
                        
                        <input type="hidden" name="TaskId" 
                        value="<?=isset($taskid)?$taskid:'';?>" />
                           
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Description :
                            </label>
                            <div class="col-sm-9">
                            <textarea class="form-control" required="required" name="CommentText" 
                            rows="8"><?=isset($record[0]['CommentText'])?$record[0]['CommentText']:'';?></textarea>
                           </div>
                        </div> 
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                        		File Attachment :<br />
                            </label>
                            <div class="col-sm-4">
                                <input type="file" name="CommentAttachment[]" 
                                class="form-control" multiple="multiple" />
                                <br />
                                <p class="text-warning">You can choose multiple file for bulk 
                                attechment.Maximum file size is 2MB</p>
                            </div>
                            <div class="col-sm-5">
								<?php if(isset($record[0]['CommentAttachment'])): ?>
                                    <h5 class="sm-title text-muted">Attachments</h5>
                                    <ul class="list-unstyled">
										<?php foreach(explode('|',$record[0]['CommentAttachment']) as $file):?>								<?php if(!empty($file)): ?>
                                       <li id="<?=$file;?>">
                                        	<i class="fa fa-file-text-o mr5"></i> 
                                        	<a href="<?=base_url('uploads/comment_attachments/'.$file)?>" target="_blank"><?=$file;?></a>
                                            <i class="glyphicon glyphicon-remove mr5" onClick="return updateattachment('<?=$file;?>')"></i>  
                                        </li>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                            </div>
                            <input type="hidden" name="OCommentAttachment" id="OCommentAttachment" 
                        	value="<?=isset($record[0]['CommentAttachment'])?$record[0]['CommentAttachment']:'';?>" />
                            <input type="hidden" name="RemoveAttachment" id="RemoveAttachment" 
                        	value="" />
                        </div> 
                       
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-5">
                                <input type="submit" name="update" id="btn-submit" class="btn btn-primary btn-metro mr5" 
                                value="Update"   />
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
function updateattachment(file)
{
	var r = confirm("Are you sure to remove!"+file);
	if (r == true) {
		var a=document.getElementById('OCommentAttachment').value;
		document.getElementById('RemoveAttachment')
		var att=a.split("|");
		var str='';
		for(i=0;i<att.length;i++)
		{
			if(file != att[i])
			{
				str +=att[i]+'|';		
			}		
		}
		var remove =document.getElementById('RemoveAttachment').value;
		var rmstr=remove+file+'|';
		document.getElementById(file).setAttribute('style','display:none');
		document.getElementById('RemoveAttachment').setAttribute('value',rmstr);
		document.getElementById('OCommentAttachment').setAttribute('value',str);
	} else {
		return false;
	}
	
}
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
