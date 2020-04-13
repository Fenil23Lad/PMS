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
.form-group{
	margin-bottom: 5px;
}
h5{ 
cursor:pointer
}
</style>
<div class="pageheader">
    <div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-rupee" style="padding:10px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('admin/home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Manage Expense</li>
            </ul>
            <h4><?=ucwords($action)?> Expense</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START =============================== --->
<div class="contentpanel">              
    <div class="row">
		<div class="col-md-12">
			<form name="frmmodule" id="frmmodule" 
            action="<?php echo base_url('admin/expense/'.$action) ?>" 
            method="post">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!---------------form-group--------------------->
                        <input type="hidden" name="ExpenseId" 
                        value="<?=isset($record['ExpenseId'])?$record['ExpenseId']:'';?>" />
                         <!---------------form-group---------------------> 
                         <div class="form-group">
                            <label class="col-sm-2 control-label">
                                Expense Category :
                            </label>
                             <div class="col-sm-3">
                            <select name="ExpenseTypeId" id="ExpenseTypeId" 
                                required="required" 
                                class="validate[required]"  style="width:100%">
                                	<option value="" selected="selected">Select Expense Category</option>									
                                    <?php 
									foreach($ExpenseTypes as $ExpenseType) 
                                    {
                                         echo '<option value="'.$ExpenseType['ExpenseTypeId'].'">';
                                         echo $ExpenseType['ExpenseType'];
                                         echo '</option>';
                                    } 
                                    ?>		
                                    
								</select>
                                <script>
                                $('#ExpenseTypeId').val('<?=isset($record['ExpenseTypeId'])?$record['ExpenseTypeId']:'';?>');
                                </script>
                                </div>	
                            	<div class="col-sm-1">
                                <a href="<?=base_url('admin/expense_type');?>" title="Manage Expense Type">
                                <h3 style="margin:5px 0px">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                </h3>
                                </a>
                             </div>
                            <label class="col-sm-1 control-label">
                                Pay Mode:
                            </label>
                            <div class="col-sm-3">
                            	<select name="ExpenseBy" id="ExpenseBy" 
                                required="required" 
                                class="validate[required]"  style="width:100%">
                                	<option value="" selected="selected">
                                    Select Payment Mode</option>									
                                     <?php 
                                    foreach($Paymodes as $Paymode) 
                                    {
                                         echo '<option>';
                                         echo $Paymode['Name'];
                                         echo '</option>';
                                    } 
                                    ?>		
                                    
								</select>
                                <script>
                                $('#ExpenseBy').val('<?=isset($record['ExpenseBy'])?$record['ExpenseBy']:'';?>');
                                </script>
                            </div>
                            <div class="col-sm-1">
                                <a href="<?=base_url('admin/payment_mode');?>" 
                                title="Manage Payment Mode">
                                <h3 style="margin:5px 0px">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                </h3>
                                </a>
                            </div>
                         </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                Payment Date :
                            </label>
                            <div class="col-sm-4">
                               <input type="text" id="datepicker" name="Date" required="required"
                               value="<?=isset($record['Date'])?$record['Date']:'';?>" 
                                class="form-control">
                            </div>
                            <label class="col-sm-1 control-label">
                                Amount :
                            </label>
                            <div class="col-sm-2">
                                <input type="text" id="Amount" name="Amount" 
                                 
                                value="<?=isset($record['Amount'])?$record['Amount']:'';?>" class="form-control NumbersOnly" required="required">
                            </div>

                        </div>
                      		                        	    																																																																								                  <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                               Reference # :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="TransactionRef" name="TransactionRef"  
                                value="<?=isset($record['TransactionRef'])?$record['TransactionRef']:'';?>" class="form-control">
                            </div>
                             <label class="col-sm-1 control-label">
                                Pay To :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="PaymentTo" name="PaymentTo" 
                                required="required"  
                                value="<?=isset($record['PaymentTo'])?$record['PaymentTo']:'';?>" 
                                class="form-control" >
                            </div>  
                        </div>
                         <!---------------form-group--------------------->
                        <div class="form-group">  
                            <label class="col-sm-2 control-label">
                                Description :
                            </label>
                            <div class="col-sm-9">    
                                <textarea id="Expense_Desc" name="Expense_Desc" 
                                 rows="3"  class="form-control" required="required" style="resize:none;" placeholder="Write Note Here..."><?=isset($record['Expense_Desc'])?$record['Expense_Desc']:'';?></textarea>
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <hr style="margin:15px;" />
                      																																																																																	 						
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
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
</div><!-- contentpanel -->
<!--==========================PAGE CONTENT START =============================== --->
<script src="<?php echo  base_url();?>assets/admin/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo  base_url();?>assets/admin/js/bootstrap-timepicker.min.js"></script>	
<script src="<?=base_url('assets/admin');?>/js/jquery.validate.min.js"></script>
<script src="<?=base_url('assets/admin');?>/js/select2.min.js"></script>
<script>
$("select").select2();
			
$(document).ready(function(e) {
    $('#datepicker').datepicker({dateFormat: "dd-M-yy"});
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
                                            
            
  










        


                     