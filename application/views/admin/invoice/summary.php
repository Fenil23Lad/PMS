<div class="pageheader">
	<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-list" style="padding-top:8px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Invoice</li>
            </ul>
            <h4>Invoice</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==================PAGE CONTENT START=====================================--->
<div class="contentpanel">
    <div class="row">     
     <!--======================== Chart ====================================== -->
        <div class="col-md-12 panel panel-default">
            <h3>Payment Status</h3>
            <p class="mb15">Project wise Summary of the Due Payment Status.</p>
            <hr style="border-top: 1px solid #A9A3A3;">
            <?php foreach($Projects as $Project): ?>
            <span class=""><?=$Project[0]?>
            <?php echo "( ".$Project[2]." / ".$Project[1]." )"; 
                  $per=round($Project[2]/$Project[1]*100,2);
                  echo " ( ".$per." % ) ";
            ?>
            </span>
            <div class="progress progress-sm progress-metro">
                <div class="progress-bar  
				<?php 
				if($per==100) 
					echo 'progress-bar-success'; 
				if($per<100 && $per>0)
					echo 'progress-bar-warning';
				if($per==0)
				 	echo 'progress-bar-danger';
				?>" 
                role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" 
                style="width: <?=$per==0?100:$per?>%">
                </div>
            </div><!-- progress -->
            <?php endforeach;?>                        
            
        </div>
    </div>
</div>
<script src="<?php echo  base_url();?>assets/admin/js/jquery-ui-1.10.3.min.js"></script>
<script src="<?php echo  base_url();?>assets/admin/js/bootstrap-timepicker.min.js"></script>


<script>

</script>