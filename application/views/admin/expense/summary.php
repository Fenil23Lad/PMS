<div class="pageheader">
	<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-list" style="padding-top:8px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Expense Summary</li>
            </ul>
            <h4>Expense Summary</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==================PAGE CONTENT START=====================================--->
<div class="contentpanel">
    <div class="row">     
     <!--======================== Chart ====================================== -->
        <div class="col-md-12 panel panel-default">
            <h3>Monthly Expense Analysis</h3>
            <p class="mb15">Catrgory wise Summary of the monthly expanses.</p>
            <hr style="border-top: 1px solid #A9A3A3;">
             <div class="table-responsive" id="no-more-tables">
                <table class="table table-primary table-bordered table-striped table-condensed cf">
                  <thead class="cf">
                    <tr>
                      <th>Category</th>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>Jun</th>
                      <th>Jul</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($Expenses as $record):?>
                    <tr>
                      <td data-title="Category"><?=$record['ExpenseType']?></td>
                        <td data-title="Jan" align="right">
  					    <a href="<?=base_url('admin/expense/monthly_summary/'.$record['ExpenseTypeId'].'/1')?>">
                        <?=$record[1]>0?number_format($record[1], 0, '.', ',').' Rs.':''?>
                        </a>
                        </td>
                        <td data-title="Feb" align="right">
                        <a href="<?=base_url('admin/expense/monthly_summary/'.$record['ExpenseTypeId'].'/2')?>">
                        <?=$record[2]>0?number_format($record[2], 0, '.', ',').' Rs.':''?>
                        </a>
                        </td>
                        <td data-title="Mar" align="right">
                        <a href="<?=base_url('admin/expense/monthly_summary/'.$record['ExpenseTypeId'].'/3')?>">
						<?=$record[3]>0?number_format($record[3], 0, '.', ',').' Rs.':''?>
                        </a>
                        </td>
                        <td data-title="Apr" align="right">
                        <a href="<?=base_url('admin/expense/monthly_summary/'.$record['ExpenseTypeId'].'/4')?>">
						<?=$record[4]>0?number_format($record[4], 0, '.', ',').' Rs.':''?>
                        </a>
                        </td>
                        <td data-title="May" align="right">
                        <a href="<?=base_url('admin/expense/monthly_summary/'.$record['ExpenseTypeId'].'/5')?>">
						<?=$record[5]>0?number_format($record[5], 0, '.', ',').' Rs.':''?>
                        </a>
                        </td>
                        <td data-title="Jun" align="right">
                        <a href="<?=base_url('admin/expense/monthly_summary/'.$record['ExpenseTypeId'].'/6')?>">
                        <?=$record[6]>0?number_format($record[6], 0, '.', ',').' Rs.':''?>
                        </a>
                        </td>
                        <td data-title="Jul" align="right">
                        <a href="<?=base_url('admin/expense/monthly_summary/'.$record['ExpenseTypeId'].'/7')?>">
                        <?=$record[7]>0?number_format($record[7], 0, '.', ',').' Rs.':''?>
                        </a>
                        </td>
                        <td data-title="Aug" align="right">
                        <a href="<?=base_url('admin/expense/monthly_summary/'.$record['ExpenseTypeId'].'/8')?>">
                        <?=$record[8]>0?number_format($record[8], 0, '.', ',').' Rs.':''?>
                        </a>
                        </td>
                        <td data-title="Sep" align="right">
                        <a href="<?=base_url('admin/expense/monthly_summary/'.$record['ExpenseTypeId'].'/9')?>">
                        <?=$record[9]>0?number_format($record[9], 0, '.', ',').' Rs.':''?>
                        </a>
                        </td>
                        <td data-title="Oct" align="right">
                        <a href="<?=base_url('admin/expense/monthly_summary/'.$record['ExpenseTypeId'].'/10')?>">
                        <?=$record[10]>0?number_format($record[10], 0, '.', ',').' Rs.':''?>
                        </a>
                        </td>
                        <td data-title="Nov" align="right">
                        <a href="<?=base_url('admin/expense/monthly_summary/'.$record['ExpenseTypeId'].'/11')?>">
                        <?=$record[11]>0?number_format($record[11], 0, '.', ',').' Rs.':''?>
                        </a>
                        </td>
                        <td data-title="Dec" align="right">
                        <a href="<?=base_url('admin/expense/monthly_summary/'.$record['ExpenseTypeId'].'/12')?>">
                        <?=$record[12]>0?number_format($record[12], 0, '.', ',').' Rs.':''?>
                        </a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>                      
            
        </div>
    </div>
</div>
<script src="<?php echo  base_url();?>assets/admin/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo  base_url();?>assets/admin/js/bootstrap-timepicker.min.js"></script>


<script>

</script>