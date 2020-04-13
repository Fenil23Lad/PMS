<style>
.contact-group .media-content ul > li {
  min-width: 50px;
  margin-right:15px;
}
.ml25{
	margin-left:25px;
}
.media-content ul{
	margin-top:5px !important;
}
</style>
<div class="pageheader">
<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-list" style="padding-top:8px;"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('employee/qa');?>">
                <i class="glyphicon glyphicon-home"></i></a></li>
                <li>QA</li>
            </ul>
            <h4>QA</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->
<!--==========================PAGE CONTENT START=======================================================--->
<div class="contentpanel">
	<?php if ($this->session->flashdata('notification')): ?>
    <div class="alert alert-success">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       <strong><?php echo $this->session->flashdata('notification') ?></strong>
    </div>					
    <?php endif; ?>
    <div class="well mt10">
            <div class="row">
            <form id="tasksheet" action="<?=base_url('employee/qa/search');?>" method="post">
                <div class="col-sm-6">
                    <input type="text" 
                    placeholder="Search from Project Name Here..."
                    name="search_project"
                    value="<?php if($this->session->userdata('search_project')) 
                    echo $this->session->userdata('search_project') ?>"
                     class="form-control">
                </div>
                <div class="col-sm-2">
                    <input type="submit" name="search" class="btn btn-primary btn-metro mr10" value="Search" />
                    <input type="submit" name="all" class="btn btn-primary btn-metro mr10" value="All" />
                </div>
            </div>
            </form>
    </div><!-- well -->
    <div class="row"> 
    	<div class="col-sm-12 mb10">
        	
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
                        <th>Project Name</th>
                        <th>Task Name</th>
                        <th>status</th>
                       
                        <th width="200px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($records as $record):?>
                        <tr>
                           
                            <td data-title="Project Name">
								&nbsp;
				<!--======== For Adding QA ======================-->
								 <?php if($this->administration->checkEmpTabAccess("Add QA")) {?>
                                 <a href="<?php echo base_url('employee/qa/add/'.$this->functions->encode($record['ProjectId']))?>"> <?=$record['ProjectName']?> 
                                 </a>
                                 <?php } else { ?>
                <!--========END For Adding QA ======================-->
								<?=$record['ProjectName']?>
                               <?php } ?>
                            </td>
                             <td data-title="Task Name">
								<?=$record['TaskName']?>
                            </td>
                             <td data-title="status">
								<?=$record['TaskStatus']?>
                             </td>
                                                        
                            <td data-title="Action">
                            <?php if($this->administration->checkEmpTabAccess("Edit QA")):?>							
                                <a class="btn-link"
                                href="<?php echo base_url('employee/qa/edit/'.$this->functions->encode($record['ProjectId'])."/".$this->functions->encode($record['TaskId']));?>" title="Edit QA">
                                	<span class="fa fa-edit"></span>&nbsp;Edit
                                </a>
                                &nbsp;|&nbsp;
                                <?php endif;?>
                                
                                <a class="btn-link"
                                href="<?php echo base_url('employee/qa/details/'.$this->functions->encode($record['ProjectId'])."/".$this->functions->encode($record['TaskId']));?>" title="QA Details">
                                <span class="fa fa-search"></span>&nbsp;Details
                                </a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
    <?php else:?>
    <h4>No QA Found</h4>
    <?php endif;?>
</div>

<script>
$('select#ProjectId').change(function(){
	$('form#tasksheet').submit();
});
</script>