<div class="pageheader">
    <div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-envelope-o"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('admin/home')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                <li>Messageboard</li>
                <li>Message</li>
                <li>View</li>
            </ul>
            <h4>View Message</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->

<div class="contentpanel">
    <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-2">
            <a href="<?=base_url('admin/messageboard/compose')?>" 
            class="btn btn-success btn-block btn-create-msg btn-metro">
            <span class="glyphicon glyphicon-edit"></span>&nbsp;
            <strong>Compose</strong></a>
            <br />
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
           <div class="msg-header">
            <div class="pull-left">
                
                <button class="btn btn-white tooltips" type="button"
                onclick="window.location.href='<?=base_url('admin/messageboard/delete/'.$type.'/'.$encodeid)?>'"
                data-toggle="tooltip" title="Delete">
                <i class="fa fa-times"></i>
                </button>
                             
                <button class="btn btn-white tooltips" type="button"
            	onclick="window.location.href='<?=base_url('admin/messageboard/movetotrash/'.$type.'/'.$encodeid)?>'"  
                data-toggle="tooltip" title="Move to Trash">
                <i class="fa fa-trash-o"></i>
                </button>                        
                <button class="btn btn-white tooltips" type="button"
                 onclick="window.location.href='<?=base_url('admin/messageboard/reply/'.$type.'/'.$encodeid)?>'"  
                data-toggle="tooltip" title="Reply">
                <i class="fa fa-reply mr5"></i>
                </button>       
                                         
                <button class="btn btn-white tooltips" type="button" 
                data-toggle="tooltip" 
                onclick="window.location.href='<?=base_url('admin/messageboard/forward/'.$type.'/'.$encodeid)?>'" 
                title="Forward">
                <i class="fa fa-mail-forward mr5"></i>
                </button>                             
                </div><!-- pull-right -->
           </div><!-- msg-header -->
            					
            <div class="panel-group panel-group-msg">
            <h3 style="margin-bottom:10px;"><?=ucwords($message['Subject'])?></h3>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <span class="time text-muted pull-right">
                            <?php if($message['Attachment']!=''): ?>
                            <i class="fa fa-paperclip mr5"></i> 
                            <?php endif; ?>
                            <?=$this->functions->date_time($message['Date']);?>
                            </span>
                            <a>
                                <img class="img img-offline img-circle mr5" 
                                width="30px" height="30px"
                                src="<?php if($message['Avtar']!='') 
                                echo base_url('uploads/user_profile')."/".$message['Avtar'];
                                else 
                                echo base_url('assets/admin/images/photos/profile.png'); ?>" 
                                alt="">
                                <?=$type=='inbox'?'From: ':'To: ';?>
                                <?=ucwords($message['Name'])?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div style="min-height:200px;">
                                <?=$message['Message']?>
                            </div>
                            <?php if($message['Attachment']!=''): ?>
                            <h5 class="sm-title text-muted mt20">Attachments</h5>
                            <ul class="list-unstyled">
                                <?php foreach(explode('|',$message['Attachment']) as $file):?>
                                <li>
                                    <i class="fa fa-file-text-o mr5"></i> 
<a class="form_btn" href="#"  onclick="window.open('<?=base_url('uploads/message_attachments/'.$file)?>', 'newwindow', 'width=+, height=+'); return false;"><?=$file;?></a> 
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div><!-- panel-group -->               
        </div>
    </div>
</div><!-- contentpanel -->
