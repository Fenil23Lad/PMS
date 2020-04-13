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
                <li>Employee / Operation</li>
            </ul>
            <h4><?php echo ucfirst ($action); ?> Employee</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
	<div class="row">
		<div class="col-md-8">
			<form name="frmmodule" id="frmmodule" enctype="multipart/form-data" 
            action="<?php echo base_url('admin/employee/'.$action);?>" 
            method="post">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!---------------form-group--------------------->
                        <input type="hidden" name="UserId" 
                        value="<?=isset($record['UserId'])?$record['UserId']:'';?>" />
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Designation  :
                            </label>
                            <div class="col-sm-6">
								<select id="RoleId" name="RoleId" required="required" 
                                class="form-control validate[required]">
                                <option value="" selected="selected">Select Designation </option>
                                <?php 
								foreach($roles as $role) 
								{
									echo '<option value="'.$role['RoleId'].'">'.$role['RoleName'].'</option>';
								} 
								?>		
								</select>									
                            </div>
                            <div class="col-sm-1">
                            	<a href="<?=base_url('admin/role');?>" title="Manage Designation">
                                <h3 style="margin:5px 0px">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                </h3>
                                </a>
                            </div>
                        </div>                                             
						<script>
							$('#RoleId').val('<?=isset($record['RoleId'])?$record['RoleId']:'';?>');
						</script>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Name :
                            </label>
                            <div class="col-sm-6">
								<input type="text" id="Name" name="Name" required="required"  
                                value="<?=isset($record['Name'])?$record['Name']:'';?>" 
                                class="form-control">
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                Gender :
                            </label>
                            <div class="col-sm-2">
								<div class="rdio rdio-primary">
                                    <input type="radio" name="Gender" id="male" 
                                    value="male" <?php if(isset($record['Gender']))
								 	if($record['Gender']=='male'){echo 'checked="checked"';}?>>
                                    <label for="male">Male</label>
                                </div>
                           </div>
                           <div class="col-sm-2">
                                <div class="rdio rdio-primary">
                                    <input type="radio" name="Gender" id="female" 
                                    value="female" <?php if(isset($record['Gender']))
								 	if($record['Gender']=='female'){echo 'checked="checked"';}?>>
                                    <label for="female">Female</label>
                                </div>
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Address :
                            </label>
                            <div class="col-sm-6">
                            <textarea class="form-control" required="required" name="Address" 
                            rows="4"><?=isset($record['Address'])?$record['Address']:'';?></textarea>
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Email :
                            </label>
                            <div class="col-sm-6">
								<input type="email" id="Email" name="Email"  
                                value="<?=isset($record['Email'])?$record['Email']:'';?>" 
                                class="form-control">
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Phone :
                            </label>
                            <div class="col-sm-6">
								<input type="text" id="Phone" name="Phone"  
                                value="<?=isset($record['Phone'])?$record['Phone']:'';?>" 
                                class="form-control NumbersOnly">
                           </div>
                        </div>  
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Profile Pix :
                            </label>
                            <div class="col-sm-1">
                                <img width="40px" height="40px" id="showimg" 
								src="<?php if(isset($record['Avtar'])&& $record['Avtar']!='')
								echo base_url('uploads/user_profile')."/".$record['Avtar'];
								else echo base_url('assets/admin/images/photos/profile.png');?>" />
                                <input id="Himage" name="Himage" type="hidden" 
                                value="<?php if(isset($record['Avtar'])){echo $record['Avtar'];}?>"> 
                            </div>
                            <div class="col-sm-5">                         
                               <input name="BkImg" type="file" class="form-control"
                               onchange="readURL(this);" name="BkImg" id="BkImg" />                   
                            </div>
                        </div> 
                        <!---------------form-group---------------------> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                User name :
                            </label>
                            <div class="col-sm-6">
								<input type="text" id="UserName" name="UserName"  
                                value="<?=isset($record['UserName'])?$record['UserName']:'';?>" 
                                class="form-control">
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Password :
                            </label>
                            <div class="col-sm-6">
								<input type="password" id="Password" name="Password"
                                value="<?=isset($record['Password'])?$record['Password']:'';?>"  size="50" 
                                class="form-control"/>
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Confirm Password :
                            </label>
                            <div class="col-sm-6">
								<input type="password" id="CPassword" name="CPassword"
                                value="<?=isset($record['Password'])?$record['Password']:'';?>"  size="50"  
                                value="" class="form-control"/>
                           </div>
                        </div>                    
                        <!---------------form-Buttons--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Status :
                            </label>
                            <div class="col-sm-6">
                                <div class="ckbox ckbox-success">
                                	<input type="checkbox" value='1' name="UserStatus" 
                                    <?php if(isset($record['UserStatus']))
								 	if($record['UserStatus']==1){echo 'checked="checked"';}?>
                                    id="UserStatus"/>
                                	<label for="UserStatus">Active</label>
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
function readURL(input) {
	if (input.files && input.files[0]) {
	var reader = new FileReader();

	reader.onload = function (e) {
	$('#showimg')
		.attr('src', e.target.result)
		.width(40)
		.height(40);
	};
	reader.readAsDataURL(input.files[0]);
	}
}
//===============================================================================
jQuery("#frmmodule").validate({
	highlight: function(element) {
		jQuery(element).closest('.form-control').removeClass('has-success').addClass('has-error');
	},
	success: function(element) {
		jQuery(element).closest('.form-control').removeClass('has-error');
	},
    rules: {
				UserName: {
						required: true,
						remote: {
						url: "<?php 
							if(isset($record['UserId']))
								echo base_url('admin/employee/register_user_exists/'.$record['UserId']);
							else
								echo base_url('admin/employee/register_user_exists/0');?>",
							type: "post",
							data: {
								email: function(){ return $("#UserName").val(); }
							}
						}
				},
                Password:{
                        required: true,
                        minlength: 5
                },
                CPassword:{
                        required: true,
                        equalTo:'#Password'
                }
				
            },
        messages: {
				UserName: {
					required: "Please Enter Username",
					remote: "Username Already Exist."
				},
                Password:{
                        required: "Please Provide password",
                        minlength: "Please provide atleast 5 characters"
                },
                CPassword:{
                        required: "Please Provide password",
                        equalTo: "Please Provide same password",
                }
		}
            
    });	
</script>
