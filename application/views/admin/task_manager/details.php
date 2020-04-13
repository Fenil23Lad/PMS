<style>

.task_info p{

	margin-bottom:0px;

}

.parent{

	background-color:#DFF1FF;

	border:1px solid #7CDCFC;

}

.child{

	background-color:#FFE9E6;

	border:1px solid #FCCDC7;	

}

.comment{

	margin:5px;

	padding:5px;

	border-radius:5px;

}

.comment .text{

	 margin:5px 5px 10px 5px;

	 font-size:17px;

}
.commentbtn{
	    position: relative;
	    top: 55px;	
	}
</style>

<div class="pageheader">

<div class="media">

        <div class="pageicon pull-left">

            <i class="fa fa-list" style="padding-top:8px;"></i>

        </div>

        <div class="media-body">

            <ul class="breadcrumb">

                <li><a href="<?=base_url('admin/home');?>">

                <i class="glyphicon glyphicon-home"></i></a></li>

                <li>Task</li>

                <li>Details</li>

            </ul>

            <h4>Task Details</h4>

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

    <?php if ($this->session->flashdata('error')): ?>

    <div class="alert alert-danger">

       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

       <strong><?php echo $this->session->flashdata('error') ?></strong>

    </div>					

    <?php endif; ?>

    <div class="row">

    <div class="col-sm-12 col-md-12">

        <div class="panel panel-primary">

			<div class="panel-heading" style="padding:10px">

                <h3 class="panel-title" style="margin:0px"><?=$record['TaskName']?></h3>

            </div>

            <div class="panel-body">

                <div class="row task_info">

                    <div class="col-sm-8 col-md-8">

                       <ul class="list-group">

                            <li class="list-group-item">

                                 <div class="row">

                                    <p class="col-sm-2 col-md-2">

                                        <strong>Task # :</strong>

                                    </p>

                                    <h4 class="col-sm-2 col-md-2" style="margin:0px">

                                        <?=$record['TaskNo']?>

                                    </h4>

                                 </div>

                            </li>

                            <li class="list-group-item">

                                 <div class="row">

                                    <p class="col-sm-2 col-md-2">

                                        <strong>Project :</strong>

                                    </p>

                                    <p class="col-sm-4 col-md-4">

                                        <?=$this->common->GetProjectNameById($record['ProjectId'])?>

                                    </p>

                                    <p class="col-sm-3 col-md-3">

                                        <strong>Priority :</strong>

                                    </p>

                                    <p class="col-sm-3 col-md-3">

										<?php

											if($record['TaskPriority']=='High') 

											echo '<b class="text-success">High</b>';

											elseif($record['TaskPriority']=='Medium') 

											echo '<b class="text-warning">Medium</b>';

											else

											echo '<b class="text-danger">Low</b>';

                                        ?>

                                    </p>

                                 </div>

                            </li>

                            <li class="list-group-item">

                                 <div class="row">

                                    <p class="col-sm-2 col-md-2">

                                        <strong>Assigned To :</strong>

                                    </p>

                                    <p class="col-sm-4 col-md-4">

                                        <?=$this->common->GetUserNameById($record['UserId'])?>

                                    </p>

                                    <p class="col-sm-3 col-md-3">

                                        <strong>Estimate Time :</strong>

                                    </p>

                                    <p class="col-sm-3 col-md-3">

                                      <?=$record['TaskEstimateTime']?> Hr.

                                    </p>

                                 </div>

                            </li>

                            <li class="list-group-item">

                                 <div class="row">

                                    <p class="col-sm-2 col-md-2">

                                        <strong>Assigned By :</strong>

                                    </p>

                                    <p class="col-sm-4 col-md-4">

                                       <?=$this->common->GetUserNameById($record['TaskAssignedBy'])?>

                                    </p>

                                    <p class="col-sm-3 col-md-3">

                                        <strong>Assigned On :</strong>

                                    </p>

                                    <p class="col-sm-3 col-md-3">

                                      <?=date('j F, Y',strtotime($record['TaskAssignedOn']))?>

                                    </p>

                                 </div>

                            </li>

                            <li class="list-group-item">

                                 <div class="row">

                                    <p class="col-sm-2 col-md-2">

                                        <strong>Details :</strong>

                                    </p>

                                    <p class="col-sm-10 col-md-10">

                                      <?=$record['TaskDesc']?>

                                    </p>

                                 </div>

                            </li>

                            <li class="list-group-item">

                                 <div class="row">

                                    <p class="col-sm-2 col-md-2">

                                        <strong>Attachments :</strong>

                                    </p>

                                    <p class="col-sm-10 col-md-10">

                                        <?php foreach(explode('|',$record['TaskAttachment']) as $file):?>								<?php if(!empty($file)): ?>

                                            

                                            	<i class="fa fa-file-text-o mr5"></i> 

                                            	<a href="<?=base_url('uploads/task_attachments/'.$file)?>" target="_blank"><?=$file;?></a><br />

                                            

                                        <?php endif; ?>

                                        <?php endforeach; ?>

                                    </p>

                                 </div>

                            </li>                

                       </ul>

                    </div>
					
                    <div class="col-sm-4 col-md-4">

                        <form name="frmmodule" id="frmmodule" method="post" 

                        action="<?php echo base_url('admin/task_manager/save/'.$id);?>">

                        <input type="hidden" name="TaskId" value="<?=$record['TaskId']?>" />
		
                        <ul class="list-group">
				
				 
                            <li class="list-group-item">

                                <div class="row">

                                    <div class="col-sm-12 col-md-12">

                                    	<h4>Task Status</h4>
									
                                        <select id="TaskStatus" name="TaskStatus" 

                                        class="form-control" <?php if($record['ProjectStatus'] != 1) : ?> disabled="disabled" <?php endif; ?> />
									
                                        	<option value="Pending">Pending</option>

                                            <option value="In Progress">In Progress</option>

                                            <option value="Waiting For Approval">

                                            Waiting For Approval

                                            </option>

                                            <option value="Testing">Testing</option>

                                            <option value="Completed">Completed</option>

                                            <option value="Cancelled">Cancelled</option>

                                        </select>

                                        

                                        <script>

                                        $('#TaskStatus').val('<?=$record['TaskStatus'];?>');

                                        </script>

                                        
								<?php if($record['ProjectStatus'] == 1) : ?>
                                    	 <div id="vslider-primary" 

                                         class="slider-primary">

                                         </div>
								<?php endif; ?>
                                         <h4 class="text-primary task_percentage">

                                         <?=$record['TaskPercentage']?>%

                                         </h4>

                                         <input type="hidden" name="TaskPercentage" 

                        				 value="<?=$record['TaskPercentage']?>" />

                                    </div>

                                </div>

                            </li>

                            <li class="list-group-item">

                                <div class="row">

                                    <label class="col-sm-4 control-label">        

                                    Finish Time:  <br />

                                    <span class="text-info">(In hours)</span>

                                    </label>

                                    <div class="col-sm-8 col-md-8">

                                    	<div class="input-group">

                                            <span class="input-group-addon">

                                            <i class="fa fa-clock-o"></i>

                                            </span>

                                            <div class="bootstrap-timepicker">

                                            <input name="TaskFinishTime" type="text" 

                                            value="<?=$record['TaskFinishTime']?>" 

                                            class="form-control NumbersOnly" <?php if($record['ProjectStatus'] != 1) : ?> disabled="disabled" <?php endif; ?> />

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </li>
			<?php if($record['ProjectStatus'] == 1) : ?>
                            <li class="list-group-item">

                                <div class="row">

                                    <div class="col-sm-12 col-md-12">

                                    	<input type="submit" name="submit"

                                    	class="btn btn-success btn-sm btn-block" value="Save" />

                                    </div>

                                </div>

                            </li>                
			<?php endif; ?>		
                        </ul>

                        </form>

                    </div>
                </div>

            </div><!-- panel-body -->

        </div><!-- panel -->

    </div>

    </div>

    <div class="row">

        <div class="col-md-12">

            <div class="panel panel-primary">

                <div class="panel-heading" style="padding:10px">

                    <h3 class="panel-title" style="margin:0px">Comments</h3>

                </div>

                <div class="panel-body">

                    <div class="row"> 

                        <div class="col-sm-12">

                            <div class="list-group">

                                 <?php foreach($Comments as $Comment): ?>

                                <div class="row">

									<?php  
										if($Comment['CommentCreatedBy'] == $this->session->userdata('UserId'))
										{ ?>
											 <div class="col-sm-1"></div>

                                        	 <div class="col-sm-10 comment child">
								<?php		}
										else
										{
									?>
                                    	<div class="col-sm-10 comment parent">
									<?php } ?>
                                        <p id="<?=$Comment['CommentId']?>" 

                                        class="text"><?=$Comment['CommentText'];?></p>
                                        
                                        <?php  $i=1; foreach(explode('|',$Comment['CommentAttachment']) as $file):?>								<?php if(!empty($file)): ?>

                                            

                                            	<i class="fa fa-file-text-o mr5"></i> 

                                            	<a href="<?=base_url('uploads/comment_attachments/'.$file)?>" target="_blank">Attechment <?= $i; ?><?php //$file;?></a><br />

                                            	

                                        <?php $i++; endif; ?>

                                        <?php endforeach; ?>
                                        <span class="fa fa-user"></span>

                                        &nbsp;<?=$this->common->GetUserNameById($Comment['CommentCreatedBy'])?>                   

                                        &nbsp; &nbsp;|&nbsp;

                                        <span class="fa fa-clock-o"></span>

                                        &nbsp;

                                        <?=$this->functions->time_ago($Comment['CommentCreatedOn']);?>
								<?php if($record['ProjectStatus'] == 1) :?> 
                                        &nbsp;|&nbsp; 

                                        <a 

                                        href="<?=base_url('admin/task_manager/edit_comment/'.$id.'/'.$Comment['CommentId'])?>"

                                        title="Edit">

                                        <span class="fa fa-edit"></span>

                                        &nbsp;Edit

                                        </a>

                                        <!--&nbsp;

                                        <a onclick="modelreply(<?php //$Comment['CommentId']?>)" 

                                        data-toggle="modal" data-target=".bs-example-modal-lg" 

                                        href="#"

                                        title="Reply">

                                        <span class="fa fa-reply"></span>

                                        &nbsp;Reply

                                        </a>-->

                                        &nbsp;

                                        <a href="<?=base_url('admin/task_manager/delete_comment/'.$id.'/'.$Comment['CommentId'])?>"

                                        onclick="return confirm('Are you sure to Delete ?')" 

                                        title="Delete">

                                        <span class="fa fa-trash-o"></span>

                                        &nbsp;Delete

                                        </a>
                                       
										
                                        
									<?php endif; ?>
                                    </div>

                                </div>

                               

                                <?php endforeach; ?> 
			
            					
                            </div>

                        </div>
						<div class="row">
                        	 <div class="col-sm-12">
								<div class="list-group">
                                <form id="model_form" method="post" enctype="multipart/form-data" onsubmit="return validate()"

                            action="<?php echo base_url('admin/task_manager/save_comment/'.$id);?>">

                            <input type="hidden" name="TaskId" value="<?=$record['TaskId']?>" />
                            <input type="hidden" name="action" value="reply" />
                                	<div class="col-sm-7">

                                        <textarea  rows="4" name="CommentText" required="required" placeholder="Write your comment hrere..."

                                        class="form-control"></textarea>

                                   </div>
                                   <div class="col-sm-3">

                                       <input type="file" name="CommentAttachment[]" class="form-control" multiple="multiple" />
                                            <br />
                                            <p class="text-warning">You can choose multiple file for bulk 
                                            attechment.Maximum file size is 2MB</p>
                                   </div>
                                   <div class="col-sm-2">

                                        <input type="submit" name="submit" class="btn btn-success" value="Comment" />
                                   </div>
                                   </form>
                                </div>
                             </div>
                        </div>
                    </div> 

                </div>

            </div>

        </div>

    </div>

</div>

<!------=============================================================================--->

<script>

 function validate() {
	 
		var fatt=document.getElementById('CommentAttachment');
		var a=0;
		for(i=0;i<fatt.files.length;i++)
		{
			var fname=fatt.files[i].name;
			var extension=fname.substr(fname.lastIndexOf('.')+1).toLowerCase();
			if(extension != 'jpg' && extension != 'gif' && extension != 'png' && extension != 'pdf' ) {
				a=1;
				break;
			}
			extension='';
		}
		if(a==0)
		{	return true;	}
		else
		{	alert('Please Select Valid extension'); return false;	}
}
//===============================================================================

jQuery('.NumbersOnly').keyup(function () { 

    this.value = this.value.replace(/[^0-9]/g,'');

});

//===============================================================================

$('#vslider-primary').slider({

	range: "min",

	max: 100,

	value: <?=$record['TaskPercentage']?>,

	slide: function(event, ui){

		$('.task_percentage').html(ui.value+'%');

		$('input[name=TaskPercentage]').val(ui.value);

	}

});



</script>