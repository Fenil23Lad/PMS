<div class="pageheader">
    <div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-home"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('admin/home');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>Projects</li>
            </ul>
            <h4>Projects</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->

<!--======================Project Detail ============================= -->
<div class="contentpanel">
<div class="row">


<?php if(count($projects) > 0)
{ ?>  
    	<div class="col-md-12 panel panel-default">
        <h3>Project List</h3>
        <p class="mb15">Summary of the Project List.</p>
        <div class="table-responsive" id="no-more-tables">
            <table class="table table-primary table-bordered table-striped table-condensed cf">
                <thead class="cf">
                  <tr>
                    <th>Project Name</th>
                    <th>Project Category</th>
                    <th>Total Task</th>
                    <th>Completed Task</th>
                    <th>Total Hrs.</th>
                    <th>Completed Hrs.</th>
                   <th>Created Date</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php 
					foreach($projects as $project) : ?>
					<tr align='center'>
                        	<td data-title='Project Name'>
                            	<a href="<?=base_url('admin/home/projectDetail/'.$project['ProjectId'])?>">				
								<?php echo $project['ProjectName']; ?>
                                </a>
                            </td>
                            <td data-title='Category Name'>
								<?php echo $project['ProjectCategoryName']; ?>
                            </td>
                            <td data-title='Total Task'>
						  		<?php echo $project['total_task']; ?>
                            </td>
							<td data-title='Complete Task'>
                            	<?php echo $project['total_compelete_task']; ?>
                            </td>
                            <td data-title='Total Hrs.'>
                         	<?php if($project['total_time_hr']) 
								{ 
									echo $project['total_time_hr'];
							    } 
								else 
								{ 
									echo "-"; 
								}
							?>
                            </td>
                            
                            <td data-title='Completed Hrs.'>
                         	<?php if($project['compelete_time_hr']) 
								{ 
									echo $project['compelete_time_hr'];
							    } 
								else 
								{ 
									echo "-"; 
								}
							?>
                            </td>
							<td data-title='Created Date'>
							<?php echo date('d-m-Y', strtotime($project['ProjectCreatedOn'])); ?>
                            </td>
                            
					</tr>
				<?php endforeach;?>
               </tbody>
            </table>
        </div><!-- table-responsive -->
        <br/>
        </div> 
 <?php 
 } else { 
 echo 
 "<div class='col-md-12 alert alert-warning'><h4 align='center'> No Data Found </h4></div>";
  }?>     
      
</div>
</div>
<!--======================Project Detail ============================= -->