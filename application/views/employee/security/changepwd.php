<div class="pageheader">
    <div class="media">
        <div class="pageicon pull-left">
            <i class="glyphicon glyphicon-lock" style="padding-top:5px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('employee/home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Change Password</li>
            </ul>
            <h4>Change Password</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
     <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?=$this->session->flashdata('error');?></strong>
        </div> 
    <?php endif; ?>
    <?php if($this->session->flashdata('notification')): ?>
        <div class="alert alert-success">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?=$this->session->flashdata('notification');?></strong>
        </div> 
    <?php endif; ?>
	<div class="row">
		<div class="col-md-6">
            <form id="validateForm" novalidate="novalidate" 
            action="<?php echo base_url('employee/security/changepwd');?>" method="post">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <input type='hidden' name="UserId" value="<?=$this->session->userdata('UserId')?>"/>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                           Old Password :
                            </label>
                            <div class="col-sm-7">
                            	<input type="password" name="Password" id="Password" size="50" 
                                class="form-control" />
                            </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                           New Password :
                            </label>
                            <div class="col-sm-7">
                            	<input type="password" name="NewPassword" id="NewPassword" size="50" 
                                class="form-control"/>
                            </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                           Confirm Password :
                            </label>
                            <div class="col-sm-7">
                            	<input type="password" style="color:#000000;" name="CPassword" 
                                id="CPassword" size="50" class="form-control"/>
                            </div>
                        </div>

                        <!---------------form-Buttons--------------------->
                        <div class="form-group">
                            <label class="col-sm-4 control-label"></label>
                            <div class="col-sm-7">
                                <input type="submit" name="submit" class="btn btn-primary btn-metro mr5" 
                                value="Update"  />
                                <button type="reset" class="btn btn-metro btn-dark">Reset</button>
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
// Basic Form
jQuery("#validateForm").validate({
	highlight: function(element) {
		jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
	},
	success: function(element) {
		jQuery(element).closest('.form-group').removeClass('has-error');
	},
	rules: {
			NewPassword: {
				required: true,
				minlength: 6
			},
			CPassword: {
				required: true,
				minlength: 6,
				equalTo: "#NewPassword"
			}
		},
		messages: {
			NewPassword: {
				required: "Please provide a password",
				minlength: "Your password must be at least 6 characters long"
			},
			CPassword: {
				required: "Please provide a confirm password",
				minlength: "Your password must be at least 6 characters long",
				equalTo: "Please enter the same password as above"
			}
		}
});	
	

</script>
