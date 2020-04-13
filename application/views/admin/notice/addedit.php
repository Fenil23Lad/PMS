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
            <i class="fa fa-user" style="padding-top:8px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('admin/home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Notice / Operation</li>
            </ul>
            <h4><?php echo ucfirst ($action); ?> Notice</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
	<div class="row">
		<div class="col-md-10">
			<form name="frmmodule" id="frmmodule" enctype="multipart/form-data" 
            action="<?php echo base_url('admin/notice/'.$action);?>" 
            method="post">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!---------------form-group--------------------->
                        <input type="hidden" name="id" 
                        value="<?=isset($record['id'])?$record['id']:'';?>" />
                        
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Description :
                            </label>
                            <div class="col-sm-9">
                            <textarea class="form-control" required="required" name="description" 
                            rows="4"><?=isset($record['description'])?$record['description']:'';?></textarea>
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
	
<script type="text/javascript">

//===============================================================================
jQuery("#frmmodule").validate({
	highlight: function(element) {
		jQuery(element).closest('.form-control').removeClass('has-success').addClass('has-error');
	},
	success: function(element) {
		jQuery(element).closest('.form-control').removeClass('has-error');
	},
    rules: {
				description: {
						required: true,
				}
            },
        messages: {
				description: {
					required: "Please Enter Description"
				}
		}
            
    });	
</script>
