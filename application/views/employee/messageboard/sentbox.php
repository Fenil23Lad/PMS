<style>
.msg-list li{
	padding:0px 10px 10px 10px;
}
</style>
<div class="pageheader">
    <div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-envelope-o"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('employee/home')?>"><i class="glyphicon glyphicon-home"></i></a></li>
                <li>Message Board</li>
                <li>Sentbox</li>
            </ul>
            <h4>Message Sentbox</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->

<div class="contentpanel">
	<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
       <button type="button" class="close" data-dismiss="success" aria-hidden="true">×</button>
       <strong><?php echo $this->session->flashdata('success') ?></strong>
    </div>				
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
       <button type="button" class="close" data-dismiss="error" aria-hidden="true">×</button>
       <strong><?php echo $this->session->flashdata('error') ?></strong>
    </div>				
    <?php endif; ?>  
    <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-2">
            <a href="<?=base_url('employee/messageboard/compose')?>" 
            class="btn btn-success btn-block btn-create-msg btn-metro">
            <span class="glyphicon glyphicon-edit"></span>&nbsp;
            <strong>Compose</strong></a>
            <br />
            <ul class="nav nav-pills nav-stacked nav-msg">
                <li>
                <a href="<?=base_url('employee/messageboard')?>">
                    <i class="glyphicon glyphicon-inbox"></i>Inbox
                </a>
                </li>
                <li class="active">
                <a href="<?=base_url('employee/messageboard/sentbox')?>"><i class="glyphicon glyphicon-send"></i> Sent Message</a></li>
                <li><a href="<?=base_url('employee/messageboard/trash')?>"><i class="glyphicon glyphicon-trash"></i> Trash</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-9 col-lg-10">
            <div class="row">        
                <div class="btn-group pull-left ml10 mr10">
                    <button type="button" class="btn btn-primary dropdown-toggle btn-metro" data-toggle="dropdown">
                      Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li>
                          <a href="#" onClick="return trash_selected(document.msglist)">
                           Move to Trash
                          </a>
                      </li>
                    </ul>
                </div>
                 <div class="col-sm-7">
                        <form action="<?=base_url('employee/messageboard/search');?>" method="post">
                        <input type="text" placeholder="Search Here..."
                        name="search_msg_sentbox"
                        value="<?php if($this->session->userdata('search_msg_sentbox')) 
                        echo $this->session->userdata('search_msg_sentbox') ?>"
                         class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <input type="submit" name="search_sentbox" 
                        class="btn btn-primary btn-metro mr10" value="Search" />
                        <input type="submit" name="all_sentbox" class="btn btn-primary btn-metro mr10" value="All" />
                         </form> 
                    </div>
            </div>
            <ul class="media-list msg-list">
                <li>
                    <div class="row">
                        <div class="ckbox ckbox-primary pull-left ml10">
                            <input type="checkbox" onclick="CheckAll()"
                            id="checkbox0">
                            <label for="checkbox0"></label>
                        </div>
                        <h4 style="margin-bottom:0px;">&nbsp;Select All</h4>
                    </div>
                </li>
                <form name="msglist"  method="post" 
                action="<?php echo base_url('employee/messageboard/action') ?>">
                <?php foreach($messages as $key=>$message): ?>
                <li id="<?=$message['SentboxId']?>">
                   <div class="row">
                        <div class="ckbox ckbox-primary pull-left ml10">
                            <input type="checkbox" name="p_list[]" id="checkbox<?=$key+1;?>"
                            value="<?=$message['SentboxId']?>">
                            <label for="checkbox<?=$key+1;?>"></label>
                        </div>
                        <div class="btn-group pull-left mt10">
                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>
                            </a>
                            <ul class="dropdown-menu pull-left" role="menu">
                                <li>
                                    <a href="<?=base_url('employee/messageboard/reply/sentbox/'.$this->functions->encode($message['SentboxId']))?>">Reply</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('employee/messageboard/forward/sentbox/'.$this->functions->encode($message['SentboxId']))?>">Forward</a>
                                </li>
                                <li>
                                    <a href="<?=base_url('employee/messageboard/movetotrash/sentbox/'.$this->functions->encode($message['SentboxId']))?>">Move to Trash</a>
                                </li>
                            </ul>
                        </div>
                        <div style="cursor:pointer" 
                        onclick="readnew('<?=$this->functions->encode($message['SentboxId'])?>')">
                            <div class="col-sm-3">
                                <img class=" img-circle img-online pull-left mt10" 
                                width="30px" height="30px"
                                src="<?php if($message['Avtar']!='') 
                                echo base_url('uploads/user_profile')."/".$message['Avtar'];
                                else echo base_url('assets/admin/images/photos/profile.png'); ?>" alt=""> 
                                <h4 style="font-size:16px;margin-bottom:0px;" class="pull-left ml10">
                                	To : <?=ucwords($message['Name'])?>
                                </h4>
                            </div>
                            <div class="col-sm-6 pull-left mt10">
                                <strong class="subject">
                                	<?=ucwords($message['Subject'])?>
                                </strong>
                                <span style="padding-left:10px;">
                                	<?=$this->functions->neat_trim($message['Message'],100)?>
                                </span>
                            </div>
                            <div class="col-sm-2 mt10 pull-right">
                                	<small><?=$this->functions->date_time($message['Date']);?></small>
                            </div>
                        </div>
                   </div>
                </li>
                <?php endforeach;?>
                <input type="hidden" name="action" /> 
                <input type="hidden" name="type" value="sentbox" /> 
                </form>
            </ul>
        </div>
    </div>
</div><!-- contentpanel -->
<script>

function trash_selected(frm)
{
	if(confirm("Are you sure to Move to Trash ?"))
	{
		frm.action.value = "trash_selected";
		frm.submit();
		return true ;
	}
}

function CheckAll()
{
	var checks = document.getElementsByName('p_list[]');
	for (i = 0; i < checks.length; i++)
	{
		if(checks[i].checked == false) 
			checks[i].checked = true;
	}
  document.getElementById('checkbox0').setAttribute('onclick','UncheckAll()');	
}
function UncheckAll()
{
    var checks = document.getElementsByName('p_list[]');
    for (i = 0; i < checks.length; i++)
    {
        if(checks[i].checked == true) 
            checks[i].checked = false;
    }
    document.getElementById('checkbox0').setAttribute('onclick','CheckAll()');
}

function readnew(encoded)
{
	window.location='<?=base_url('employee/messageboard/view/sentbox')?>/'+encoded;
}

</script>
                 