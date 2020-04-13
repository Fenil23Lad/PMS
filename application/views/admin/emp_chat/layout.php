<style>
div.user-status{
  width: 10px;
  height: 10px;
  border-radius: 50px;
  float: right;
  margin-top: 5px;
  margin-left: 10px;
}
.onlineuser-body{
  overflow: scroll;
  height: 450px;
  overflow-x: auto;
  padding:10px;
}
.onlineuser-body .media{
	margin-top:5px;
}
img.user{
	height:35px !important; 
	width:35px !important; 
	border:2px solid; 
	padding:2px;
}
.panel-heading{
	padding:10px;
}
.panel-heading button,.panel-heading input{
	background: transparent !important;
	color:#FFF !important;
}
.msgcount span{
	background-color:#FF2D32 !important;
}
</style>
<div class="pageheader">
    <div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-comments-o"></i>
        </div>
        <div class="media-body">
            <ul class="breadcrumb">
                <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
                <li>Employee Chat</li>
            </ul>
            <h4>Employee Chat</h4>
        </div>
    </div><!-- media -->
</div><!-- pageheader -->

<div class="contentpanel">
    <div class="row">
    	<div class="col-sm-4 col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="input-group">
                        <span class="input-group-btn">
                        	<button type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                        <input type="search" id="UserFilter" class="form-control">
                    </div>
                </div>
                <div class="panel-body onlineuser-body">
                <?php foreach($users as $user):?>
                    <div class="media" style="">
                        <div class="pull-left">
                            <a href="<?=base_url('uploads/user_profile/'.$user['Avtar'])?>" target="_blank">		 
                            <img class="img-circle user" id="user_<?=$user['UserId']?>"
                            src="<?php if($user['Avtar']!='') 
                                echo base_url('uploads/user_profile')."/".$user['Avtar'];
                                else echo base_url('assets/admin/images/photos/profile.png'); ?>">
                                </a>
                        </div>
                        <div class="msgcount" id="usermsg<?=$user['UserId']?>"></div>
                        <div class="pull-right" id="user<?=$user['UserId']?>">
                        	<span></span>
                        	<div class="user-status"></div>  
                        </div>
                        
                        <div class="media-body" onclick="LoadChatWindow(<?=$user['UserId']?>)"
                        style="cursor:pointer;">
                            <h4 class="media-heading"><?=ucwords($user['Name'])?></h4>
                            <small><?=ucwords($user['RoleName'])?></small>
                        </div>
                    </div>
                 <?php endforeach;?>  
                </div><!-- panel-body -->
            </div><!-- panel -->
        </div>
        <div class="col-sm-8 col-md-8 chat-window"> 
        </div>
    </div>
</div><!-- contentpanel --> 

<script>
<?php 
if(isset($userid)) 
echo "LoadChatWindow(".$userid.")";
?>


$('#UserFilter').keyup(function (e) {

	var rex = new RegExp($(this).val(), 'i');
	$('.onlineuser-body .media').hide();
	$('.onlineuser-body .media').filter(function () {
		return rex.test($(this).text());
	}).show();

});

function LoadChatWindow(userid)
{
	$('.chat-window').load("<?=base_url('admin/empchat/chatwindow');?>"+"/"+userid,function() {
  		$('img#user'+userid).css('border-color',$('img#user_'+userid).css('border-color'));
	});	
}
function SetUserStatus()
{
  $.getJSON('<?=base_url('auto_load/getusersstatus');?>', function( data ) {
  		$.each( data['User'], function( key, val ) {
			$('div#user'+val[0]+' span').html(val[2]);
			$('div#user'+val[0]+' div').css('background-color',val[1]);
			$('img#user_'+val[0]).css('border-color',val[1]);
  		});
		$('div.msgcount span').fadeOut();
		$.each( data['MsgCount'], function( key, val ) {
			$('div#usermsg'+val.FromId).html('<span class="badge  pull-right ml5">'+val.Total+'</span>');
  		});
  });
}
SetUserStatus()
setInterval(function(){
	SetUserStatus()
},5000);
</script>     