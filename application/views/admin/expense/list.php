<style>
.contact-group .media-content ul > li {
	min-width: 50px;
	margin-right: 15px;
}
.ml25 {
	margin-left: 25px;
}
.media-content ul {
	margin-top: 5px !important;
}
</style>
<div class="pageheader">
  <div class="media">
    <div class="pageicon pull-left"> <i class="fa fa-list" style="padding-top:8px;"></i> </div>
    <div class="media-body">
      <ul class="breadcrumb">
        <li><a href="<?=base_url('admin/expense');?>"> <i class="glyphicon glyphicon-home"></i></a></li>
        <li>Expense</li>
      </ul>
      <h4>Expense</h4>
    </div>
  </div>
  <!-- media --></div>
<!-- pageheader --><!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
  <?php if ($this->session->flashdata('notification')): ?>
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong><?php echo $this->session->flashdata('notification') ?></strong> </div>
  <?php endif; ?>
  <?php if ($this->session->flashdata('error')): ?>
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong><?php echo $this->session->flashdata('error') ?></strong> </div>
  <?php endif; ?>
  <div class="well mt10">
    <div class="row">
    
    <form id="expensesheet" action="<?=base_url('admin/expense/search');?>" method="post">
      <div class="col-sm-3">
        <select id="ExpenseTypeId" name="ExpenseTypeId" style="width:100%">
          <option value="" selected="selected">All Expense Types</option>
          <?php                     foreach($ExpenseTypes as $ExpenseType)                     {                         echo '<option value="'.$ExpenseType['ExpenseTypeId'].'">';						 echo $ExpenseType['ExpenseType'];						 echo '</option>';                    }                     ?>
        </select>
        <script>                    
		$('#ExpenseTypeId').val('<?php if($this->session->userdata('search_ExpenseTypeId'))                     echo $this->session->userdata('search_ExpenseTypeId'); else echo ''; ?>');                    
       </script> 
      </div>
      <div class="col-sm-1">
      	<h5 class="text-right">From :</h5>
      </div>
      <div class="col-sm-2">
        <input type="text" name="search_from_expense"
        value="<?php if($this->session->userdata('search_from_expense'))  
		echo $this->session->userdata('search_from_expense') ?>"       
        class="form-control datepicker">
      </div>
      <div class="col-sm-1" style="width:45px;">
      	<h5 class="text-right">To :</h5>
      </div>
      <div class="col-sm-2">
        <input type="text" name="search_to_expense" 
        value="<?php if($this->session->userdata('search_to_expense'))  
		echo $this->session->userdata('search_to_expense') ?>"       
        class="form-control datepicker">
      </div>
      <div class="col-sm-2">
        <input type="submit" name="search" class="btn btn-primary btn-metro mr10" value="Search" />
        <input type="submit" name="all" class="btn btn-primary btn-metro mr10" value="All" />
      </div>
      </div>
    </form>
  </div>
  <!-- well -->
  <div class="row mb10">
        <div class="col-sm-12">
            <div class="pull-left">
                <a class="btn btn-xs btn-primary btn-metro" 
                title="Add New expense"             
                href="<?=base_url('admin/expense/add')?>">
                <span class="fa fa-plus"></span>&nbsp;Add New Expense 
                </a>
            </div> 
            <div class="pull-left ml10"> 
                <a class="btn btn-xs btn-primary btn-metro" 
                href="<?php echo base_url('admin/expense/summary');?>" 
                title="Summary">
                <i class="fa fa-dashboard"></i>&nbsp;Summary
                </a>
            </div>
            <div class="pull-right mr10"> 
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
  </div>
  <?php if(count($records)>0): ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="table-responsive" id="no-more-tables">
        <table class="table table-primary table-bordered table-striped table-condensed cf">
          <thead class="cf">
            <tr>
              <th>Expense Type</th>
              <th>Date</th>
              <th>Reference #</th>
              <th>Payment Mode</th>
              <th>Pay To</th>
              <th>Description</th>
              <th>Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($records as $record):?>
            <tr>
              <td data-title="Expense Type">
              	&nbsp;<?=$this->common->GetExpenseTypeById($record['ExpenseTypeId'])?>
              </td>
              <td data-title="Date"><?=date('d-m-Y',strtotime($record['Date']))?></td>
			  <td data-title="Reference #"><?=$record['TransactionRef']?></td>
              <td data-title="Expense By"><?=$record['ExpenseBy']?></td>
              <td data-title="Pay To"><?=$record['PaymentTo']?></td>
              <td data-title="Description">
			  	<?=$this->functions->neat_trim($record['Expense_Desc'],50)?>
              </td>
               <td data-title="Amount" align="right">
			   	<?=number_format($record['Amount'], 2, '.', ',')?>
               </td>
              <td data-title="Action">
                &nbsp;<a class="btn-link"   href="<?php echo base_url('admin/expense/edit/'.$this->functions->encode($record['ExpenseId']));?>" title="Edit Expense"> <span class="fa fa-edit"></span>&nbsp;Edit </a> &nbsp;|&nbsp;
                <a class="btn-link"  onclick="return confirm('Are you sure to Delete ?')"                                href="<?php echo base_url('admin/expense/delete/'.$this->functions->encode($record['ExpenseId']));?>" title="Delete Expense"> <span class="fa fa-trash-o"></span>&nbsp;Delete </a> 
              
               <!-- &nbsp;|&nbsp; <a class="btn-link"                                href="<?php echo base_url('admin/expense/details/'.$this->functions->encode($record['ExpenseId']));?>" title="Receipt Details"> <span class="fa fa-search"></span>&nbsp;Details </a>-->
                
                </td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php else:?>
  <h4>No Expense Found</h4>
  <?php endif;?>
</div>
<script src="<?php echo  base_url();?>assets/admin/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo  base_url();?>assets/admin/js/bootstrap-timepicker.min.js"></script>	
<script src="<?=base_url('assets/admin');?>/js/select2.min.js"></script>
<script>
$("#ExpenseTypeId").select2();
 $('.datepicker').datepicker({dateFormat: "dd-M-yy"});
$('select#ExpenseTypeId').change(function(){	$('form#expensesheet').submit();});
</script>


                                            
            
  










        


                     