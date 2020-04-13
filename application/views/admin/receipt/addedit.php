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
.col-sm-2{
	width:120px;
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
                <li>Manage Receipt</li>
            </ul>
            <h4>Manage Receipt</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START =============================== --->
<div class="contentpanel">              
    <div class="row">
		<div class="col-md-12">
			<form name="receipt" id="receipt" 
            action="<?php echo base_url('admin/receipt/'.$action) ?>" 
            method="post">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <!---------------form-group--------------------->
                        <input type="hidden" name="ReceiptId" 
                        value="<?=isset($record['ReceiptId'])?$record['ReceiptId']:'';?>" />
                         <!---------------form-group---------------------> 
                         <div class="form-group">
                            <label class="col-sm-2 control-label">        
                               Invoice No :
                            </label>
                            <div class="col-sm-4">
                            
                             <select id="InvoiceNo" name="InvoiceNo" required="required" 
                                style="width:100%" onchange="fetch_data(this.value)">
                                	<option value="" selected="selected">Select Invoice
                                    </option>									
                                     <?php
									 
                                    foreach($Invoices as $Invoice) 
                                    {
                                         echo '<option value="'.$Invoice[0].'">';
                                         echo $Invoice[0]. '  - '.$Invoice[1];
                                         echo '</option>';
                                    } 
                                    ?>		
                                    
								</select>
                                <script>
                                $('#InvoiceNo').val('<?=isset($record['InvoiceNo'])?$record['InvoiceNo']:'';?>');
                                </script>
                           </div>
                           <label class="col-sm-2 control-label">
                                Project Name :
                            </label>
                             <div class="col-sm-4">
                           			<input type="text" value="" id="ProjectName"  
                                    readonly class="form-control"> 
                                </div>	
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">  
                            <label class="col-sm-2 control-label">
                                From :
                            </label>
                            <div class="col-sm-4">    
                                <input type="text" id="FromAddress" 
                                class="form-control" readonly/>
                           </div>
                            <label class="col-sm-2 control-label">
                                To Address :
                            </label>
                             <div class="col-sm-4">    
                                <textarea id="ToAddress" rows="3" 
                                style="resize:none" class="form-control" readonly></textarea>
                           </div>
                        </div>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                               Invoice Date :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" value="" id="InvoiceDate"  
                                readonly class="form-control"> 
                            </div>
                            <label class="col-sm-2 control-label">
                               Invoice Amount :
                            </label>
                            <div class="col-sm-4">
                                 <input type="text" value="" id="InvoiceAmount"  
                                 readonly class="form-control">
                            </div>
                        </div>
                        <hr style="border-top: 1px solid #A9A3A3;"/>
                        <!---------------form-group--------------------->
                        <div class="form-group">
                        	<label class="col-sm-2 control-label">
                                Receipt Mode:
                            </label>
                            <div class="col-sm-3">
                            	<select name="PayBy" id="PayBy" 
                                required="required" 
                                class="validate[required]"  style="width:100%">
                                	<option value="" selected="selected">
                                    Select Receipt Mode</option>									
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
                                $('#PayBy').val('<?=isset($record['PayBy'])?$record['PayBy']:'';?>');
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
                            <label class="col-sm-2 control-label">
                               Reference # :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="TransactionRef" name="TransactionRef"   
                                value="<?=isset($record['TransactionRef'])?$record['TransactionRef']:'';?>" class="form-control">
                            </div>
                        </div>

                        <!---------------form-group--------------------->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                Receipt Date :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="datepicker" name="ReceiptDate" 
                                required="required"  
                                value="<?=isset($record['ReceiptDate'])?$record['ReceiptDate']:'';?>" 
                                class="form-control">
                            </div> 
                            <label class="col-sm-2 control-label">
                                Amount :
                            </label>
                            <div class="col-sm-2">
                                <input type="text" id="Amount" name="Amount"  
                                value="<?=isset($record['Amount'])?$record['Amount']:'';?>" class="form-control NumbersOnly" placeholder="Enter Amount" required="required">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" id="Currency" name="Currency" 
                                required="required"  
                                value="<?=isset($record['Currency'])?$record['Currency']:'';?>" 
                                class="form-control" placeholder="Enter Currency">
                            </div>
                        </div>
                        <!---------------form-group---------------------> 
                         <div class="form-group">
 							<label class="col-sm-2 control-label">
                                Account Name :
                            </label>
                            <div class="col-sm-4">
                                <input type="text" id="AccName" name="AccName"   
                                value="<?=isset($record['AccName'])?$record['AccName']:'';?>" 
                                class="form-control" required="required">
                            </div>
                            <label class="col-sm-2 control-label">
                                Note :
                            </label>
                            <div class="col-sm-4">
                             <textarea class="form-control" rows="3" placeholder="Write Note Here..." name="Note"><?=isset($record['Note'])?$record['Note']:'';?></textarea> 
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
$.post('<?=base_url('admin/receipt/get_invoice_info');?>',{InvoiceNo:<?=isset($record['InvoiceNo'])?$record['InvoiceNo']:'0';?>},function(data){
		if(data.length>0)
		{
			$('select#InvoiceNo').append('<option  selected><?=isset($record['InvoiceNo'])?$record['InvoiceNo']:'0';?></option>');
			$('#ProjectName').val(data[0]['ProjectName']);
			$('#FromAddress').val(data[0]['From']);
			$('#ToAddress').val(data[0]['ToAddress']);
			$('#InvoiceDate').val(data[0]['InvoiceDate']);
			$('#InvoiceAmount').val(data[0]['Amount']+' '+data[0]['Currency']);
			$('#Currency').val(data[0]['Currency']);
		}
		$("select").select2();
},'json');

$("select").select2();
//======================================================================
<?php if(isset($invoiceno) && $invoiceno!='') 
	echo 'fetch_data('.$invoiceno.');';
?>
function fetch_data(id)
{
	$('#InvoiceNo').val(id);
	$.post('<?=base_url('admin/receipt/get_invoice_info');?>',{InvoiceNo:id},function(data){
		$('#ProjectName').val(data[0]['ProjectName']);
		$('#FromAddress').val(data[0]['From']);
		$('#ToAddress').val(data[0]['ToAddress']);
		$('#InvoiceDate').val(data[0]['InvoiceDate']);
		$('#InvoiceAmount').val(data[0]['Amount']+' '+data[0]['Currency']);
		$('#Currency').val(data[0]['Currency']);
			
	},'json');
}


//========================================================================		
$(document).ready(function(e) {
    $('#datepicker').datepicker();
});  
//===============================================================================
jQuery('.NumbersOnly').keyup(function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});
//===============================================================================
//===============================================================================
jQuery("#receipt").validate({
	highlight: function(element) {
		jQuery(element).closest('.form-control').removeClass('has-success').addClass('has-error');
	},
	success: function(element) {
		jQuery(element).closest('.form-control').removeClass('has-error');
	}        
});	
</script>                                          
            
  










        


                     