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
        <li><a href="<?=base_url('admin/invoice');?>"> <i class="glyphicon glyphicon-home"></i></a></li>
        <li>Invoice</li>
      </ul>
      <h4>Invoice</h4>
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
    <form id="invoicesheet" action="<?=base_url('admin/invoice/search');?>" method="post">
      <div class="col-sm-4">
        <select id="ProjectId" name="ProjectId" style="width:100%">
          <option value="" selected="selected">All Projects</option>
          <?php                     foreach($projects as $project)                     {                         echo '<option value="'.$project['ProjectId'].'">';						 echo $project['ProjectName'];						 echo '</option>';                    }                     ?>
        </select>
        <script>                    $('#ProjectId').val('<?php if($this->session->userdata('search_invoice_projectid'))                     echo $this->session->userdata('search_invoice_projectid'); else echo ''; ?>');                    </script> </div>
      <div class="col-sm-6">
        <input type="text"                     placeholder="Search Keyword : Invoice No."                    name="search_invoice"                    value="<?php if($this->session->userdata('search_invoice'))                     echo $this->session->userdata('search_invoice') ?>"                     class="form-control">
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
                title="Add New Invoice"             
                href="<?=base_url('admin/invoice/add')?>">
                <span class="fa fa-plus"></span>&nbsp;Add New Invoice 
                </a>
            </div> 
            <div class="pull-left ml10"> 
                <a class="btn btn-xs btn-primary btn-metro" 
                href="<?php echo base_url('admin/invoice/summary');?>" 
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
              <th>Invoice No.</th>
              <th>Project</th>
              <th>Invoice Date</th>
              <th>Sales Person</th>
              <th>PO Number</th>
              <th>Amount</th>
              <th>Received</th>
              <th>Due</th>
              <th width="200px">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($records as $record):?>
            <tr>
              <td data-title="Invoice #">&nbsp;<?=$record['InvoiceNo']?></td>
              <td data-title="Project Name"><?=$this->common->GetProjectNameById($record['ProjectId'])?></td>
              <td data-title="Date"><?=date('d-m-Y',strtotime($record['InvoiceDate']))?></td>
              <td data-title="Sales Person"><?=$record['SalesPerson']?></td>
              <td data-title="PO Number"><?=$record['PONumber']?></td>
              <td align="right" data-title="Amount">
			   <?=number_format($record['Amount'], 2, '.', ',').' '.$record['Currency']?>
              </td>
              <td align="right" data-title="Received">
			   <?php 
			   $received = $this->common->GetReceivedAmount($record['InvoiceNo']);
			   $due = $record['Amount']-$received;
			   echo number_format($received, 2, '.', ',');
			   ?>
              </td>
              <td align="right" data-title="Due">
              <a href="<?=base_url('admin/receipt/add/'.$record['InvoiceNo'])?>">
              <?php if($due>0)
			  	echo '<b class="text-danger">'.number_format($due, 2, '.', ',').'</b>'; 
			  ?>
              </a>
              </td>
              <td data-title="Action">
                <a class="btn-link"   href="<?php echo base_url('admin/invoice/edit/'.$this->functions->encode($record['InvoiceId']));?>" title="Edit Invoice"> <span class="fa fa-edit"></span>&nbsp;Edit </a> &nbsp;|&nbsp;
               
                <a class="btn-link"  onclick="return confirm('Are you sure to Delete ?')"                                href="<?php echo base_url('admin/invoice/delete/'.$this->functions->encode($record['InvoiceId']));?>" title="Delete Invoice"> <span class="fa fa-trash-o"></span>&nbsp;Delete </a> &nbsp;|&nbsp;
              
                <a class="btn-link"                                href="<?php echo base_url('admin/invoice/details/'.$this->functions->encode($record['InvoiceId']));?>" title="Invoice Details"> <span class="fa fa-search"></span>&nbsp;Details </a></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php else:?>
  <h4>No Invoice Found</h4>
  <?php endif;?>
</div>
<script src="<?=base_url('assets/admin');?>/js/select2.min.js"></script>
<script>
$("#ProjectId").select2();

$('select#ProjectId').change(function(){$('form#invoicesheet').submit();});
</script>