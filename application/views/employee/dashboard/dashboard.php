<style>
.pageheader
{
	height:auto;	
}
</style>
<div class="pageheader">
	<div class="row ">
        <div class="media col-sm-3 abovenotice">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url('employee/home');?>">
                    <i class="glyphicon glyphicon-home"></i></a></li>
                    <li>Dashboard</li>
                </ul>
                <h4>Dashboard</h4>
            </div>
        </div><!-- media -->
        <div class="col-sm-9 <?php  if(isset($Notice)){?> notice <?php } ?>">
            <?= isset($Notice)?$Notice[0]['description']:'' ;?>
        </div>
	</div>
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">

<!-- ======================================================================= -->              
    <!--=======================  Project Detail  ======================  -->   
<div class="row ">
    <div class="row row-stat">
		<?php if(isset($Projects)) { 
        foreach($Projects as $Project) :
        ?>
          <div class="col-md-6">
          	<div class="panel panel-default panel-alt">
            	<div class="panel-heading noborder">
                   <div class="panel-icon"><i class="fa fa-book" style="padding:12px"></i></div>
                   <div class="media-body">
                      <h3 class="mt5">
                        	 <a href="<?=base_url('employee/home/project/'.$Project[0]['ProjectId'])?>" style="color:#666;" title="Project"> 
							<?php echo ucfirst($Project[0]['ProjectName']) ?>
                            </a>
                      </h3>
                   </div><!-- media-body -->
                   <div class="clearfix"><br /></div>
                     <div class="col-md-12">
                    	<div class="col-md-6">
                            <strong>Category : </strong>
							<?php echo $Project[0]['ProjectCategoryName'] ?>
                        </div>
                        <div class="col-md-6">
                        	<strong>Total Task : </strong> 
							<?php echo $Project['total_task'] ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                    	<div class="col-md-6">
                            <strong>Completed Task : </strong> 
							<?php echo $Project['complete_task'] ?>
                        </div>
                        <div class="col-md-6">
                            <strong>Remaining Task :</strong> 
							<?php echo $Project['total_task']-$Project['complete_task'] ?>
                        </div>
                     </div>
                     <div class="col-md-12">
                     	<div class="col-md-6">
                            <strong> Created Date :</strong> 
							<?php echo date('d-m-Y',strtotime($Project[0]['ProjectCreatedOn'])) ?>
                        </div>
                      	<div class="col-md-6">
                            <strong> Start Date :</strong> 
							<?= isset($Project[0]['StartDate'])?date('d-m-Y h:i:s',strtotime($Project[0]['StartDate'])):'' ?>
                        </div>
                     </div>
                     <div class="col-md-12">
                     	<div class="col-md-6">
                            <strong> Finish Date :</strong> 
							<?= isset($Project[0]['FinishDate'])?date('d-m-Y h:i:s',strtotime($Project[0]['FinishDate'])):'' ?>
                        </div>
                      	
                     </div>
                     <div class="clearfix"></div>
                </div><!-- panel-body -->
            </div><!-- panel -->
          </div><!-- col-md-4 -->
                        
       <?php endforeach; } ?>         
    </div>
</div>   <!-- row -->
     <!--======================= End  Project Detail  ========================-->
 <!-- ========================================================================= -->
  <!-- ========================================================================= -->
    
</div><!-- contentpanel -->












        


                     







        


                     