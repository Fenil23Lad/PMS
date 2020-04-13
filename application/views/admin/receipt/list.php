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
        <li><a href="<?=base_url('admin/receipt');?>"> <i class="glyphicon glyphicon-home"></i></a></li>
        <li>Receipt</li>
      </ul>
      <h4>Receipt</h4>
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
    <form id="invoicesheet" action="<?=base_url('admin/receipt/search');?>" method="post">
          <div class="col-sm-1">
            <h5 class="text-right">From :</h5>
          </div>
          <div class="col-sm-2">
            <input type="text" name="search_from_receipt"
            value="<?php if($this->session->userdata('search_from_receipt'))  
            echo $this->session->userdata('search_from_receipt') ?>"       
            class="form-control datepicker">
          </div>
          <div class="col-sm-1" style="width:45px;">
            <h5 class="text-right">To :</h5>
          </div>
          <div class="col-sm-2">
            <input type="text" name="search_to_receipt" 
            value="<?php if($this->session->userdata('search_to_receipt'))  
            echo $this->session->userdata('search_to_receipt') ?>"       
            class="form-control datepicker">
          </div>
          <div class="col-sm-2">
            <input type="submit" name="search" class="btn btn-primary btn-metro mr10" 
            value="Search" />
            <input type="submit" name="all" class="btn btn-primary btn-metro mr10" value="All" />
          </div>
      </div>
    </form>
  </div>
  <!-- well -->
  <div class="row">
    <div class="col-sm-12 mb10"> <a class="btn btn-primary btn-metro mr10" title="Add New Receipt"             href="<?=base_url('admin/receipt/add')?>"> <span class="fa fa-plus"></span>&nbsp;            Add New Receipt </a>
      <div class="pull-right mr10"> <?php echo $this->pagination->create_links(); ?> </div>
    </div>
  </div>
  <?php if(count($records)>0): ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="table-responsive" id="no-more-tables">
        <table class="table table-primary table-bordered table-striped table-condensed cf">
          <thead class="cf">
            <tr>
              <th>Date</th>
              <th>Invoice No.</th>
              <th>Receipt Mode</th>
              <th>Transaction Ref</th>
              <th>Account Name</th>
              <th>Description</th>
              <th>Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($records as $record):?>
            <tr>
              <td data-title="Date"><?=date('d-m-Y',strtotime($record['ReceiptDate']))?></td>
              <td data-title="Invoice #">&nbsp;<?=$record['InvoiceNo']?></td>
              <td data-title="Receipt Mode"><?=$record['PayBy']?></td>
              <td data-title="Transaction Ref."><?=$record['TransactionRef']?></td>
              <td data-title="Acc Name"><?=$record['AccName']?></td>
              
              <td data-title="Description">
			  	<?=$this->functions->neat_trim($record['Note'],50)?>
              </td>
              <td data-title="Amount" align="right">
			   	<?=number_format($record['Amount'], 2, '.', ',')."&nbsp;".$record['Currency']?>
               </td>
              
              <td data-title="Action">
                <a class="btn-link"   href="<?php echo base_url('admin/receipt/edit/'.$this->functions->encode($record['ReceiptId']));?>" title="Edit Receipt"> <span class="fa fa-edit"></span>&nbsp;Edit </a> &nbsp;|&nbsp;
               
              
               
                <a class="btn-link"  onclick="return confirm('Are you sure to Delete ?')"                                href="<?php echo base_url('admin/receipt/delete/'.$this->functions->encode($record['ReceiptId']));?>" title="Delete Receipt"> <span class="fa fa-trash-o"></span>&nbsp;Delete </a> 
              
               <!-- &nbsp;|&nbsp; <a class="btn-link"                                href="<?php echo base_url('admin/receipt/details/'.$this->functions->encode($record['ReceiptId']));?>" title="Receipt Details"> <span class="fa fa-search"></span>&nbsp;Details </a>-->
                
                </td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php else:?>
  <h4>No Receipt Found</h4>
  <?php endif;?>
</div>

<script src="<?php echo  base_url();?>assets/admin/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo  base_url();?>assets/admin/js/bootstrap-timepicker.min.js"></script>	
<script>
 $('.datepicker').datepicker({dateFormat: "dd-M-yy",});
</script>                                        
            
  










        


                     