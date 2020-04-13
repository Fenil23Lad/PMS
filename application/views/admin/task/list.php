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
        <li><a href="<?=base_url('admin/task');?>"> <i class="glyphicon glyphicon-home"></i></a></li>
        <li>Task</li>
      </ul>
      <h4>Task</h4>
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
    <form id="tasksheet" action="<?=base_url('admin/task/search');?>" method="post">
      <div class="col-sm-4">
        <select id="ProjectId" name="ProjectId" class="form-control">
          <option value="" selected="selected">All Projects</option>
          <?php                     foreach($projects as $project)                     {                         echo '<option value="'.$project['ProjectId'].'">';						 echo $project['ProjectName'];						 echo '</option>';                    }                     ?>
        </select>
        <script>                    $('#ProjectId').val('<?php if($this->session->userdata('search_task_projectid'))                     echo $this->session->userdata('search_task_projectid'); else echo ''; ?>');                    </script> </div>
      <div class="col-sm-6">
        <input type="text"                     placeholder="Search from Task Here..."                    name="search_task"                    value="<?php if($this->session->userdata('search_task'))                     echo $this->session->userdata('search_task') ?>"                     class="form-control">
      </div>
      <div class="col-sm-2">
        <input type="submit" name="search" class="btn btn-primary btn-metro mr10" value="Search" />
        <input type="submit" name="all" class="btn btn-primary btn-metro mr10" value="All" />
      </div>
      </div>
    </form>
  </div>
  <!-- well -->
  <div class="row">
    <div class="col-sm-12 mb10"> <a class="btn btn-primary btn-metro mr10" title="Add New Task"             href="<?=base_url('admin/task/add')?>"> <span class="fa fa-plus"></span>&nbsp;            Add New Task </a>
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
              <th width="70px">#</th>
              <th>Task</th>
              <th>Project</th>
              <th>Priority</th>
              <th>Task Status</th>
              <th>Assigned To</th>
              <th>AssignedBy</th>
              <th>AssignedOn</th>
              <th width="200px">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($records as $record):?>
            <tr>
              <td data-title="Task #">&nbsp;
                <?=$record['TaskNo']?></td>
              <td data-title="Task Name"><?=$record['TaskName']?></td>
              <td data-title="Project Name"><?=$this->common->GetProjectNameById($record['ProjectId'])?></td>
              <td data-title="Priority"><?php								if($record['TaskPriority']=='High') 									echo '<b class="text-success">High</b>';								elseif($record['TaskPriority']=='Medium') 									echo '<b class="text-warning">Medium</b>';								else									echo '<b class="text-danger">Low</b>';								?></td>
              <td data-title="Status"><?=$record['TaskStatus']?></td>
              <td data-title="UserName"><?=$this->common->GetUserNameById($record['UserId'])?></td>
              <td data-title="Task Assigned By"><?=$this->common->GetUserNameById($record['TaskAssignedBy'])?></td>
              <td data-title="Task Assigned On"><?=date('d-m-Y',strtotime($record['TaskAssignedOn']))?></td>
              <td data-title="Action">
                <a class="btn-link"   href="<?php echo base_url('admin/task/edit/'.$this->functions->encode($record['TaskId']));?>" title="Edit Task"> <span class="fa fa-edit"></span>&nbsp;Edit </a> &nbsp;|&nbsp;
               
              
               
                <a class="btn-link"  onclick="return confirm('Are you sure to Delete ?')"                                href="<?php echo base_url('admin/task/delete/'.$this->functions->encode($record['TaskId']));?>" title="Delete Task"> <span class="fa fa-trash-o"></span>&nbsp;Delete </a> &nbsp;|&nbsp;
              
                <a class="btn-link"                                href="<?php echo base_url('admin/task_manager/details/'.$this->functions->encode($record['TaskId']));?>" title="Task Details"> <span class="fa fa-search"></span>&nbsp;Details </a></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php else:?>
  <h4>No Task Found</h4>
  <?php endif;?>
</div>
<script>$('select#ProjectId').change(function(){	$('form#tasksheet').submit();});</script>