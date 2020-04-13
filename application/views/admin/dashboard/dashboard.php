<div class="pageheader">
	<div class="row ">
        <div class="media col-sm-3 abovenotice">
            <div class="pageicon pull-left">
                <i class="fa fa-home"></i>
            </div>
            <div class="media-body">
                <ul class="breadcrumb">
                    <li><a href="<?=base_url('admin/home');?>">
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
<!--==========================PAGE CONTENT START =============================== --->
<div class="contentpanel">              
   
    
<!--=======================  Project Task  ======================  -->   
<div class="row ">
    <div class="row row-stat">
                            <div class="col-md-4">
                                <div class="panel panel-success-alt panel-alt">
                                    <div class="panel-heading noborder">
                                        <div class="panel-btns" style="display: none;">
                                             <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="" data-original-title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                            <a href="#" class="panel-close tooltips" data-toggle="tooltip" title="" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-book" style="padding:12px"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin">Running Project</h5>
                                            <h1 class="mt5">
											<?php echo count($run_project) ?>
                                            </h1>
                                        </div><!-- media-body -->
                                        <hr>
                                        </div>
                                        <div class="panel-body">
                                        <a href="<?=base_url('admin/home/project/running')?>" class="btn btn-success btn-sm mr5">Running Project Detail</a>
                                    </div>                                        
                                    
                                   <!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                             
                            <div class="col-md-4">
                                <div class="panel panel-primary panel-alt">
                                    <div class="panel-heading noborder">
                                        <div class="panel-btns" style="display: none;">
                                         <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="" data-original-title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                            <a href="#" class="panel-close tooltips" data-toggle="tooltip" title="" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                         <div class="panel-icon"><i class="fa fa-briefcase" style="padding:12px"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin">Completed	</h5>
                                            <h1 class="mt5">
											<?php echo count($completed_project) ?>
                                            </h1>
                                        </div><!-- media-body -->
                                        <hr>
                                                                               
                                    </div><!-- panel-body -->
                                    <div class="panel-body">
                                        <a href="<?=base_url('admin/home/project/completed')?>" class="btn btn-primary btn-sm mr5">Completed Project Detail</a>
                                    </div>    
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                            
                            <div class="col-md-4">
                                <div class="panel panel-dark panel-alt">
                                    <div class="panel-heading noborder">
                                        <div class="panel-btns" style="display: none;">
                                         <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="" data-original-title="Minimize Panel"><i class="fa fa-minus"></i></a>
                                            <a href="#" class="panel-close tooltips" data-toggle="tooltip" data-placement="left" title="" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-pencil"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin">Pending</h5>
                                            <h1 class="mt5">
											<?php echo count($pending_project) ?>
                                            </h1>
                                        </div><!-- media-body -->
                                        <hr>                                       
                                    </div><!-- panel-body -->
                                    <div class="panel-body">
                                        <a href="<?=base_url('admin/home/project/pending')?>" class="btn btn-dark btn-sm mr5">Pending Project Detail</a>
                                    </div>    
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
 </div>
</div>   <!-- row -->
     <!--======================= End  Project Task  ========================-->
<div class="row">     
     <!--======================== Chart ====================================== -->
	<div class="col-md-5 panel panel-default">
    	<h3>Project Status</h3>
        <p class="mb15">Summary of the status of Project.</p>
        <span class="sublabel">Running Projects 
		<?php echo "( ".count($run_project)." / ".$No_of_project." )"; 
			  $run_per=round(count($run_project)/$No_of_project*100,2);
			  echo " ( ".$run_per." % ) ";
		?>
        </span>
        <div class="progress progress-xs progress-metro">
            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $run_per ?>%">
            </div>
        </div><!-- progress -->
                                
        <span class="sublabel">Completed Projects
        <?php echo "( ".count($completed_project)." / ".$No_of_project." )"; 
			  $comp_per=round(count($completed_project)/$No_of_project*100,2);
			  echo " ( ".$comp_per." % ) ";
		?>
        </span>
        <div class="progress progress-xs progress-metro">
            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $comp_per ?>%">
            </div>
        </div><!-- progress -->
                                
        <span class="sublabel">Pending Projects
        <?php echo "( ".count($pending_project)." / ".$No_of_project." )"; 
			  $pending_per=round(count($pending_project)/$No_of_project*100,2);
			  echo " ( ".$pending_per." % ) ";
		?>
        </span>
        <div class="progress progress-xs progress-metro">
            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $pending_per ?>%">
            </div>
		</div><!-- progress -->
	</div>

<!--============================= Chart ====================================== --> <!--======================Task Status ============================= --> 
	<div class="col-md-7">
   
    	<h3 style="margin-top:0px;">Task Status</h3>
        <p class="mb15">Summary of the Project Task Status.</p>
        <div class="table-responsive" id="no-more-tables">
            <table class="table table-primary table-bordered table-striped table-condensed cf">
                <thead class="cf">
                  <tr>
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>Assigned Task</th>
                    <th>Completed Task</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php if(isset($tasks))
				  {
					foreach($tasks as $task) :
						echo "<tr>";
						echo "<td data-title='Name'>".ucfirst($task['Name'])."</td>";
						echo "<td data-title='Designation'>".ucfirst($task['RoleName'])."</td>";
						echo "<td align='center' data-title='Assigned Task'>".$task['total_task']."</td>";
                    	echo "<td align='center' data-title='Completed Task'>".$task['total_complete_task']."</td>
						      </tr>";
					endforeach;  
				  }?>
                    
                    
                  </tr>
               </tbody>
            </table>
        </div><!-- table-responsive -->
     </div>       
<!--======================Task Status ============================= -->    
</div>


     
</div><!-- contentpanel -->
<!--==========================PAGE CONTENT START =============================== --->


                                            
            
  










        


                     