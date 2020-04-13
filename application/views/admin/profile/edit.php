<div class="pageheader">
	<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-user"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('admin/home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>My Profile</li>
            </ul>
            <h4>My Profile</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
	<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
       <button type="button" class="close" data-dismiss="success" aria-hidden="true">×</button>
       <strong><?php echo $this->session->flashdata('success') ?></strong>
    </div>				
    <?php endif; ?>                   
    <div class="row">
        <div class="col-sm-6 col-md-6">                
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title">
                         Personal Information
                    </h4>
                </div>
                <div class="panel-body">
                    <form name="frmmodule" id="frmmodule" enctype="multipart/form-data"
                    action="<?php echo base_url('admin/profile/index');?>" method="post">
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Name :
                            </label>
                            <div class="col-sm-8">
                                <input type="text" id="Name" name="Name"  
                                value="<?=$user['Name'];?>" 
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
                                <input type="radio" name="Gender" value="male" 
                                <?php if($user['Gender']=="male") echo "checked"; ?> 
                                onclick="Calculate_Balance()"  id="m">
                                <label for="m">Male</label>
                                </div>                                         
                            </div>
                            <div class="col-sm-3">
                                <div class="rdio rdio-primary">
                                <input type="radio" name="Gender" value="female" 
                                <?php if($user['Gender']=="female") echo "checked"; ?> 
                                onclick="Calculate_Balance()"  id="f">
                                <label for="f">Female</label>
                                </div>                                         
                            </div>
                        </div>
                        <!---------------form-group--------------------->
                          <div class="form-group">
                            <label class="col-sm-3 control-label">
                            	Email :
                            </label>
                            <div class="col-sm-8">
                                <input type="email" id="Email" name="Email" required="required"  
                                value="<?=$user['Email'];?>" 
                                class="form-control">
                            </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Phone Number :
                            </label>
                            <div class="col-sm-8">
                                <input type="text" id="Phone" name="Phone"  
                                value="<?=$user['Phone'];?>" 
                                class="form-control">
                            </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Address :
                            </label>
                            <div class="col-sm-8">
                                <textarea id="Address" class="form-control" name="Address" 
                                rows="2"><?=$user['Address'];?></textarea>
                            </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">        
                                Profile Picture :
                            </label>
                            <div class="col-sm-2">
                                <img width="40px" height="40px" id="showimg" src="<?php if($user['Avtar']!='') 
								echo base_url('uploads/user_profile')."/".$user['Avtar'];
								else echo base_url('assets/admin/images/photos/profile.png'); ?>" />
                                <input id="Himage" name="Himage" type="hidden" 
                                value="<?php echo $user['Avtar'];?>"> 
                            </div>
                            <div class="col-sm-6">                         
                               <input name="BkImg" type="file" class="form-control"
                               onchange="readURL(this);" name="BkImg" id="BkImg" />                   
                            </div>
                        </div>
                        <hr style="margin: 18px 0px 15px 0px;border-color: rgb(172, 171, 179);
                        border-style: dotted;"/> 
                       
                      
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-8">
                                <input type="submit" name="submit_personal" id="btn-submit" 
                                class="btn btn-primary btn-metro mr5" 
                                value="Save"   />
                                <button type="reset" class="btn btn-dark btn-metro">Reset</button>
                            </div>
                        </div>                         
                    </form>	 
                </div>
            </div>
        </div><!--col6 -->
            
    </div><!-- row -->  
</div>
<script src="<?=base_url('assets/admin');?>/js/country.js"></script>
<script type="text/javascript">				  
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
</script>
