<style>
.img-circle{
	height:30px; 
	width:30px;
}
img.user{
	height:40px; 
	width:40px; 
	border:2px solid; 
	padding:2px;
}
.typing{
	color:#930;
	margin:0px;
	padding:5px;
	display:none;
}
.chat-content{
  overflow: scroll;
  height: 320px;
  overflow-x: auto;
}
.frommsg h4{
	color:#00008C;	
}
.tomsg h4{
	color:#000000;	
}
.tomsg{
	margin-left: 40px;
}
</style>
<div class="panel panel-primary" style="margin:0px;">
    <div class="panel-heading" style="padding:5px;">
        <div class="panel-btns" style="display:block;" >
        <a href="#" class="panel-close tooltips" data-toggle="tooltip" title="" data-original-title="Close Panel"><i class="fa fa-times"></i></a>
        </div>
        <h3 class="panel-title">
            <img class="user" id="user<?=$user['UserId']?>"
            src="<?php if($user['Avtar']!='') 
            echo base_url('uploads/user_profile')."/".$user['Avtar'];
            else echo base_url('assets/admin/images/photos/profile.png'); ?>">
        	&nbsp;Chat with <?=ucwords($user['Name'])?></h3>
    </div>
    <div class="panel-body chat-body">
        <div class="panel-body chat-content" style="padding:5px;">
        	<?php foreach($chatline as $chat): ?>
            	<?php if($chat['FromId']==$user['UserId']):?>
                  <div class="media frommsg" id="<?=$chat['ChatTextId']?>">
                        <div class="pull-left">
                            <img class="img-circle img-online" height="40px" 
                            src="<?php if($user['Avtar']!='') 
                            echo base_url('uploads/user_profile')."/".$user['Avtar'];
                            else echo base_url('assets/admin/images/photos/profile.png'); ?>">
                        </div>
                        <div class="pull-right mr20">
                           <?=$this->functions->time_ago($chat['TS'])?>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><?=ucwords($user['Name'])?></h4>
                            <small><?=$chat['ChatText']?></small>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="media tomsg chat-<?= $chat['ChatTextId'];?>">
                        <div class="pull-left">
                            <img class="img-circle img-online" height="40px" 
                            src="<?php if($this->session->userdata('Avtar')!='') 
                            echo base_url('uploads/user_profile')."/".$this->session->userdata('Avtar');
                            else echo base_url('assets/admin/images/photos/profile.png'); ?>">
                        </div>
                        
                         <div class="pull-right mr10">
                           <a onclick="delete_chat(<?= $chat['ChatTextId'];?>)"><span class="glyphicon glyphicon-trash"></span></a>
                        </div>
                        
                        <div class="pull-right mr20">
                           <?=$this->functions->time_ago($chat['TS'])?>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><?=ucwords($this->session->userdata('UserName'))?></h4>
                            <small><?=$chat['ChatText']?></small>
                        </div>
                    </div>
               <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <h5 class="typing"><?=ucwords($user['Name'])?> is typing....</h5>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-10 col-md-10">
                	<textarea class="form-control" rows="2" placeholder="Type Here..." id="chatText"></textarea>
                </div>
                <div class="col-sm-2 col-md-2">
                	<button type="submit"
                    onclick="SendEmpChatText()"
                    class="btn btn-primary btn-metro mt10">Send</button>
                </div>
            </div>
        </div> 
    </div><!-- panel-body -->
</div><!-- panel -->
<script>
//------------------------------------------------------------

jQuery('.panel .panel-close').click(function() {
  jQuery(this).closest('.panel').fadeOut(200);
  return false;
});

//------------------------------------------------------------

$('#chatText').on('keyup', function(e) {
    if (e.which == 13)
	{ 
        SendEmpChatText();
		SendEmpChatTypingStatus(0);
	}
	else
	{
		SendEmpChatTypingStatus(1);
	}
});

//-------------------------------------------------------------

function SendEmpChatText()
{
	var textBox =  $.trim($('textarea').val());
    if (textBox != "") 
	{
		var new_line ='<div class="media tomsg"><div class="pull-left"><img class="img-circle img-online" src="<?php if($this->session->userdata('Avtar')!='') 
		echo base_url('uploads/user_profile')."/".$this->session->userdata('Avtar');
		else echo base_url('assets/admin/images/photos/profile.png'); ?>"></div><div class="media-body"><h4 class="media-heading"><?=ucwords($this->session->userdata('UserName'))?></h4><small>'+$('#chatText').val()+'</small></div></div>';
		
		$.post( "<?=base_url('auto_load/sendempchattext');?>",
			{chat_text:$('#chatText').val(),toid:<?=$user['UserId']?>}
		);
		$('.chat-content').append(new_line).animate({scrollTop: $('.chat-content')[0].scrollHeight},0);
	}
	
	$('#chatText').val('');
	$('#chatText').focus();	
		
}

//-------------------------------------------------------------

function SendEmpChatTypingStatus(status)
{
	$.post( "<?=base_url('auto_load/sendempchattypingstatus');?>/"+status);
}

//-------------------------------------------------------------

function SetTypingStatus()
{
	  $.post( "<?=base_url('auto_load/FetchEmpChatTypingStatus/'.$user['UserId']);?>",
	  function( data ) {
		  
		  //$('h5.typing').html(data);
		if(data>0)
			$('h5.typing').fadeIn();
		else
			$('h5.typing').fadeOut();	
	  });
}

//-------------------------------------------------------------

var LastID = $('.chat-content div.frommsg').last().attr('id');
LastID = LastID==''?0:parseInt(LastID);
function FetchChatData()
{
	  $.post( "<?=base_url('auto_load/FetchEmpChatText');?>", 
	  {from_id:<?=$user['UserId']?>,last_id:LastID},
	  function( data ) {
		$.each( data, function( key, val ) {
				var new_line ='<div class="media frommsg" id="'+val["ChatTextId"]+'"><div class="pull-left"><img class="img-circle img-online" src="<?php if($user['Avtar']!='') 
                            echo base_url('uploads/user_profile')."/".$user['Avtar'];
                            else echo base_url('assets/admin/images/photos/profile.png'); ?>"></div><div class="media-body"><h4 class="media-heading"><?=ucwords($user['Name'])?></h4><small>'+val["ChatText"]+'</small></div></div>';
							
		 $('.chat-content').append(new_line).animate({scrollTop: $('.chat-content')[0].scrollHeight},0);				
		 LastID = val["ChatTextId"];
							
  		});
	  },'json');
	  
}

//-------------------------------------------------------------
function delete_chat(val)
{
	 $.get("<?=base_url('employee/empchat/chatdelete');?>/"+val,function(){
		  $('.chat-'+val).remove();
		 });
	
}

//-------------------------------------------------------------

setInterval(function(){	
  FetchChatData();
  SetTypingStatus();
},3000);
</script>