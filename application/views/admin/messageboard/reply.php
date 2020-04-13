<style>
.chosen{
	width:100% !important;
}
li.search-field{
	min-height:38px !important;
}
ul.chosen-choices{
	border-radius: 3px !important;
	border: 1px solid #ccc !important;
	box-shadow: none !important;
	font-size: 13px !important;
}
.panel-body{
	padding:10px 2px 0px 0px;
}
</style>
<div class="pageheader">
    <div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-envelope-o"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
                <li>Message Board</li>
            </ul>
            <h4>Message Board</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->

<div class="contentpanel">
	<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
       <button type="button" class="close" data-dismiss="error" aria-hidden="true">×</button>
       <strong><?php echo $this->session->flashdata('error') ?></strong>
    </div>				
    <?php endif; ?> 
    <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-2">
             <ul class="nav nav-pills nav-stacked nav-msg">
                <li <?php if($type=='inbox') echo 'class="active"';?> >
                    <a href="<?=base_url('admin/messageboard')?>">
                        <i class="glyphicon glyphicon-inbox"></i> Inbox
                    </a>
                </li>
                <li <?php if($type=='sentbox') echo 'class="active"';?> >
                    <a href="<?=base_url('admin/messageboard/sentbox')?>">
                    <i class="glyphicon glyphicon-send"></i> Sent Message</a>
                </li>
               	<li <?php if($type=='trash') echo 'class="active"';?> >
                    <a href="<?=base_url('admin/messageboard/trash')?>">
                    <i class="glyphicon glyphicon-trash"></i> Trash</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-9 col-lg-10">
            <form name="frmmodule" id="frmmodule" enctype="multipart/form-data"
            action="<?php echo base_url('admin/messageboard/reply/'.$type.'/'.$encodeid);?>" method="post">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Compose Message</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-1 control-label"><strong>To</strong></label>
                        <div class="col-sm-11">
                            <select id="to_list" data-placeholder="Choose One" 
                            class="chosen" name="Toid[]" multiple="true">
                                <?php 
									echo '<option value="'.$message['UserId'].'" selected="selected">';
									echo $message['Name'];
									echo '</option>'; 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label"><strong>Subject</strong></label>
                        <div class="col-sm-11">
                        <input type="text" class="form-control" name="Subject" 
                        value="Re: <?=$message['Subject'];?>"
                        required="required">
                        </div>
                    </div>

                    <textarea id="messagebody" class="form-control" rows="15" name="Message"
                    placeholder="Enter Your Message here..." 
                    required="required"></textarea>
                    
                    <div class="form-group mt10">
                        <label class="col-sm-2 control-label">
                        	<strong>File Attachment</strong>
                        </label>
                        <div class="col-sm-5">
                        	<input type="file" name="Attachment[]" class="form-control" multiple="multiple" />
                            <br />
                            <p class="text-info">You can choose multiple file for bulk attechment.<br /> Maximum file size is 2MB</p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <input type="submit" name="submit" id="btn-submit" 
                    class="btn btn-primary btn-metro"value="Send"/>
                </div>
            </div>
            </form>
        </div>
    </div>
</div><!-- contentpanel -->
<script>
$(document).ready(function(e) {
	$(".chosen").select2();
});
</script>