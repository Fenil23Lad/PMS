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
            <i class="fa fa-book"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('admin/home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Manage Invoice</li>
            </ul>
            <h4><?=ucwords($action)?> Invoice</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START =============================== --->
<div class="contentpanel">              
    Manage Invoice
    <div class="row">
		<div class="col-md-12">
			<form name="frmmodule" id="frmmodule" 
            action="<?php echo base_url('admin/invoice/'.$action) ?>" 
            method="post">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!---------------form-group--------------------->
                        <input type="hidden" name="InvoiceId" 
                        value="<?=isset($record['InvoiceId'])?$record['InvoiceId']:'';?>" />
                         <!---------------form-group---------------------> 
                         <div class="form-group">
                            <label class="col-sm-2 control-label">        
                               Invoice No :
                            </label>
                            <div class="col-sm-4">
								 <input type="text" id="InvoiceNo" name="InvoiceNo" 
                                  value="<?=isset($record['InvoiceNo'])?$record['InvoiceNo']:$InvoiceId?>" 
                                class="form-control" readonly="readonly">
                           </div>
                           <label class="col-sm-2 control-label">
                                Project Name :
                            </label>
                             <div class="col-sm-4">
                            <select id="ProjectId" name="ProjectId" 
                                required="required" style="width:100%"
                                class="validate[required]">
                                	<option value="" selected="selected">Select Project</option>									
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
                                </div>	
                           
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">  
                            <label class="col-sm-2 control-label">
                                From :
                            </label>
                            <div class="col-sm-4">    
                                <input type="text" name="From" class="form-control" 
                                required="required" 
                                value="<?=isset($record['From'])?$record['From']:'VPN SOLUTION';?>"  />
                           </div>
                            <label class="col-sm-2 control-label">
                                To :
                            </label>
                             <div class="col-sm-4">    
                                <textarea id="ToAddress" name="ToAddress" 
                                rows="3" class="form-control editor" required="required"><?=isset($record['ToAddress'])?$record['ToAddress']:'';?></textarea>
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                Date :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="datepicker" name="InvoiceDate" required="required"  placeholder="Select Invoice Date"   
                   value="<?=isset($record['InvoiceDate'])?$record['InvoiceDate']:'';?>" 
                                class="form-control">
                            </div>
                            <label class="col-sm-2 control-label">
                                IE Code :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="IECode" name="IECode" 
                                placeholder="Enter IE Code"  
                                value="<?=isset($record['IECode'])?$record['IECode']:'';?>" class="form-control" required="required">
                            </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                               Sales Person :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="SalesPerson" name="SalesPerson" 
                                required="required"  
                                value="<?=isset($record['SalesPerson'])?$record['SalesPerson']:'';?>" 
                                class="form-control" placeholder="Enter Sales Person Name">
                            </div>
                            <label class="col-sm-2 control-label">
                                PO Number :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="PONumber" name="PONumber"   
                                value="<?=isset($record['PONumber'])?$record['PONumber']:'';?>" class="form-control" placeholder="Enter PO Number" required="required">
                            </div>
                        </div>

                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                Shipped Via :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="ShippedVia" name="ShippedVia"  
                                value="<?=isset($record['ShippedVia'])?$record['ShippedVia']:'Internet';?>" class="form-control" placeholder="Enter Shipped Via" required="required">
                            </div>
                            <label class="col-sm-2 control-label">
                                Due Day :
                            </label>
                            <div class="col-sm-2">    
                                <input name="DueDay" type="text" class="form-control NumbersOnly" 
                                value="<?=isset($record['DueDay'])?$record['DueDay']:'0';?>" 
                                required="required"  />
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                Currency :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" name="Currency" 
                                required="required"  
                                value="<?=isset($record['Currency'])?$record['Currency']:'USD';?>" 
                                class="form-control">
                            </div>  
                             <label class="col-sm-2 control-label">
                                Terms :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="Terms" name="Terms" 
                                required="required"  
                                value="<?=isset($record['Terms'])?$record['Terms']:'Monthly';?>" 
                                class="form-control">
                            </div>  
                        </div>
                        <hr style="border-top: 1px solid #A9A3A3;"/>
                       <!---------------form-group--------------------->
                       <?php if(isset($record['InvoiceDetails'])): 
					   $InvoiceDetails = $record['InvoiceDetails'];  ?>
                       <div class="invoice_details">
                       <?php foreach($InvoiceDetails as $key=>$Invoice): ?>
                            <div class="form-group">
                                <div class="col-sm-2">
                                	<?php if($key==0):?>
                                	<h4 class="text-info">Invoice Details : </h4>
                                    <?php endif;?>
                                </div>
                                <div id="details">
                                    <div class="col-sm-4">
                                        <input name="Desc[]" class="form-control" 
                                        value="<?=$Invoice[0]?>" required="required" />					
                                    </div>
                                    <div class="col-sm-1">    
                                        <input type="text" name="Unit[]"  
                                        value="<?=$Invoice[1]?>" class="form-control" />
                                    </div>
                                    <div class="col-sm-2">   
                                        <input type="text" name="Amount[]" required="required" 
                                        value="<?=$Invoice[2]?>" class="form-control NumbersOnly"/>
                                    </div>
                                    <?php if($key!=0):?>
                                    <div class="col-sm-2 remove_detail">
                                    	<h5 class="text-info">
                                        	<span class="fa fa-minus-square"></span>&nbsp; Remove
                                        </h5>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                       <?php endforeach; ?>
                       </div>
                       <?php else: ?>
                        <div class="invoice_details"> 
                            <div class="form-group">
                                <div class="col-sm-2">
                                	<h4 class="text-info">Invoice Details : </h4>
                                </div>
                                <div id="details">
                                    <div class="col-sm-4">
                                        <input name="Desc[]" class="form-control" 
                                        placeholder="Service Description" required="required" />					
                                    </div>
                                    <div class="col-sm-1">    
                                        <input type="text" name="Unit[]"  
                                        value="" class="form-control" 
                                        placeholder="Unit">
                                    </div>
                                    <div class="col-sm-2">   
                                        <input type="text" name="Amount[]" required="required" 
                                        class="form-control NumbersOnly" placeholder="Amount"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                         <!---------------form-group---------------------> 
                         <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-2">  
                            	<h5 class="text-info" onclick="add_new_row()">
                                	<span class="fa fa-plus-square"></span>
                                    &nbsp; Add New
                                </h5>
                            </div>
                        </div>               																																																																																							
                        <!---------------form-group--------------------->
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
$("#ProjectId").select2();
//===============================================================================						
$(document).ready(function(e) {
    $('#datepicker').datepicker();
});
//==============================================================================
function add_new_row()
{
	content ='<div class="form-group"><div class="col-sm-2"></div>';
	content +=$('#details').html();
	content +='<div class="col-sm-2 remove_detail"><h5 class="text-info">';
	content +='<span class="fa fa-minus-square"></span>&nbsp; Remove</h5></div>';
	content +='</div>';
	$('.invoice_details').append(content);
	//---------------------------------------------------------------
	jQuery('.NumbersOnly').keyup(function () { 
    	this.value = this.value.replace(/[^0-9]/g,'');
	});
	//---------------------------------------------------------------
	$('.remove_detail').click(function(){
		$(this).parent().remove();
	});
}
//---------------------------------------------------------------
$('.remove_detail').click(function(){
	$(this).parent().remove();
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
                                            
            
  










        


                     