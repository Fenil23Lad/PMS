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
            <i class="fa fa-calendar-o" style="padding-top:8px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Manage Lead / Operation</li>
            </ul>
            <h4><?php echo ucfirst ($action); ?> Lead</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
	<div class="row">
		<div class="col-md-12">
			<form name="frmmodule" id="frmmodule" 
            action="<?php echo base_url('admin/lead/'.$action);?>" 
            method="post">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!---------------form-group--------------------->
                        <input type="hidden" name="Id" 
                        value="<?=isset($record['Id'])?$record['Id']:'';?>" />
                         <!---------------form-group---------------------> 
                         <div class="form-group">
                            <label class="col-sm-1 control-label">        
                                Industry :
                            </label>
                            <div class="col-sm-3">
								<select id="Industry" name="Industry" 
                                required="required" 
                                class="form-control validate[required]">
                                	<option value="" selected="selected">Select Industry</option>
                                    <?php 
										foreach($Industry as $Industri) 
										{
											echo '<option value="'.$Industri['IndustryId'].'">'.$Industri['Name'].'</option>';
										} 
									?>		
								</select>
                                <script>
									$('#Industry').val('<?=isset($Indust['IndustryId'])?$Indust['IndustryId']:'';?>');
								</script>
                           </div>
                           <div class="col-sm-1">
                            	<a href="<?=base_url('admin/industry');?>" title="Manage Industry">
                                <h3 style="margin:5px 0px">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                </h3>
                                </a>
                            </div>
                           <label class="col-sm-1 control-label">
                                Company :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="Company" name="Company" 
                                required="required"  
                                value="<?=isset($record['Company'])?$record['Company']:'';?>" 
                                class="form-control">
                            </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">  
                            <label class="col-sm-1 control-label">
                                Title :
                            </label>
                            <div class="col-sm-4">    
                                <input type="text" id="Title" name="Title"
                                placeholder="Proprietor, Director, Manager, Etc." 
                                required="required"  
                                value="<?=isset($record['Title'])?$record['Title']:'';?>" 
                                class="form-control">
                           </div>
                            <label class="col-sm-1 control-label">
                                Name :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="ContactName" name="ContactName" 
                                required="required"  
                                value="<?=isset($record['ContactName'])?$record['ContactName']:'';?>" 
                                class="form-control">
                            </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-1 control-label">
                                Email Id :
                            </label>
                            <div class="col-sm-4">
                                <input type="email" id="Email" name="Email" 
                                required="required"  
                                value="<?=isset($record['Email'])?$record['Email']:'';?>" 
                                class="form-control">
                            </div>
                            <label class="col-sm-1 control-label">
                                Website :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="Website" name="Website" 
                                placeholder="www.example.com"  
                                value="<?=isset($record['Website'])?$record['Website']:'';?>" 
                                class="form-control">
                            </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-1 control-label">
                                Mobile :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="Mobile" name="Mobile" 
                                required="required"  
                                value="<?=isset($record['Mobile'])?$record['Mobile']:'';?>" 
                                class="form-control NumbersOnly">
                            </div>
                             <label class="col-sm-1 control-label">
                                Skype Id :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="SkypId" name="SkypId"   
                                value="<?=isset($record['SkypId'])?$record['SkypId']:'';?>" 
                                class="form-control">
                            </div>
                            
                        </div>

                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-1 control-label">
                                Address :
                            </label>
                            <div class="col-sm-4">
                                <textarea id="Address" name="Address" class="form-control" rows="3"
                                required="required"><?=isset($record['Address'])?$record['Address']:'';?></textarea> 
                            </div>
                            <label class="col-sm-1 control-label">
                                Phone :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="LandLine" name="LandLine"   
                                value="<?=isset($record['LandLine'])?$record['LandLine']:'';?>" 
                                class="form-control NumbersOnly">
                            </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-1 control-label">
                                City :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="City" name="City" 
                                required="required"  
                                value="<?=isset($record['City'])?$record['City']:'';?>" 
                                class="form-control">
                            </div>
                            <label class="col-sm-1 control-label">
                                Area :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="Area" name="Area"  
                                value="<?=isset($record['Area'])?$record['Area']:'';?>" 
                                class="form-control">
                            </div>
                        </div>
                        <!---------------form-group---------------------> 
                         <div class="form-group">
                            <label class="col-sm-1 control-label">        
                                Source :
                            </label>
                            <div class="col-sm-4">
								<select id="LeadSource" name="LeadSource" 
                                required="required" 
                                class="form-control validate[required]">
                                	<option value="" selected="selected">
                                    Select Lead Source
                                    </option>
                                    <option>Visit</option>
                                    <option>Website</option>
                                    <option>Telephone</option>
								</select>
                                <script>
                                $('#LeadSource').val('<?=isset($record['LeadSource'])?$record['LeadSource']:'';?>');
                                </script>	
                           </div>
                            <label class="col-sm-1 control-label">
                                Zipcode :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="Zipcode" name="Zipcode"  
                                value="<?=isset($record['Zipcode'])?$record['Zipcode']:'';?>" 
                                class="form-control">
                            </div>
                         </div>
                         <div class="form-group">
                         	
                            <label class="col-sm-1 control-label">        
                                Status :
                            </label>
                            <div class="col-sm-4">
								<select id="LeadStage" name="LeadStage" 
                                required="required" 
                                class="form-control validate[required]">
                                	<option value="" selected="selected">
                                    Select Lead Status</option>
                                    <option>Open</option>
                                    <option>Proccessing</option>
                                    <option>Qualified</option>
								</select>
                                <script>
                                $('#LeadStage').val('<?=isset($record['LeadStage'])?$record['LeadStage']:'';?>');
                                </script>	
                           </div>
                         </div>
						 <?php if($action=='edit'): ?> 
                         
                         <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-1 control-label">
                                Last Visit :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" name="LastVisitOn"  
                                value="<?=isset($record['LastVisitOn'])?date('d M Y',strtotime($record['LastVisitOn'])):'';?>" 
                                class="form-control date">
                            </div>
                            <label class="col-sm-1 control-label">
                                Next Visit :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" name="NextVisitOn"  
                                value="<?=isset($record['NextVisitOn'])? date('d M Y',strtotime($record['NextVisitOn'])):'';?>" 
                                class="form-control date">
                            </div>
                        </div>
                        <?php endif; ?> 
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-1 control-label"></label>
                            <div class="col-sm-4">
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
	
    
    
<!-- ===================================== MODEL ====================================== -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width:350px;">
      <div class="modal-content">
          <div class="modal-header">
              <button aria-hidden="true" data-dismiss="modal" 
              class="close" type="button">&times;</button>
              <h4 class="modal-title">Add Specialties</h4>
          </div>
          <div class="modal-body">
            	<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <form id="model_form" method="post" 
                            action="<?php echo base_url('candidate/add_specialtie');?>">
                            <div class="panel-body">
                                <input type="text" class="form-control" placeholder="Specialtie" 
                                name="name" required="required"  />
                                
                                <input type="submit" name="submit" id="btn_submit" 
                                class="btn btn-primary btn-metro mt10" value="Save" />                             </div>
                            </form>
                        </div>						
                    </div>
                </div>
          </div>
      </div>
    </div>
</div>    
        
<script src="<?=base_url();?>assets/admin/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?=base_url();?>assets/admin/js/bootstrap-timepicker.min.js"></script>    
<script src="<?=base_url('assets/admin');?>/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	
    $(".date").datepicker({
		dateFormat: "dd M yy",
	});
});
//========================================================
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
