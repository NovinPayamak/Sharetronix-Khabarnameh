<?php
	
	$this->load_template('header.php');
	
?>
<link rel="stylesheet" type="text/css" media="screen" href="<?= $C->SITE_URL?>themes/<?=$C->THEME?>/css/css-table.css" />
<script type="text/javascript" src="<?= $C->SITE_URL?>themes/<?=$C->THEME?>/js/style-table.js"></script>
					<div id="settings">
						<div id="settings_left">
							<?php $this->load_template('admin_leftmenu.php') ?>
						</div>
						<script>
function get_char(){

var m = document.getElementById('message_sms').value;
var t = "";
m.match(/([ا-ی]{1,50})/);

if(!m.match(/([ا-ی-آ-ی]{1,50})/)){

document.getElementById('message_sms').style.textAlign = "left";
document.getElementById('message_sms').style.direction = "ltr";
 t = ('متن انگلیسی با طول <font color="red"><b>'+m.length+'</b></font> کاراکتر ' );
}else{
document.getElementById('message_sms').style.textAlign = "right";
document.getElementById('message_sms').style.direction = "rtl";
t=('متن پارسی با طول <font color="red"><b>'+m.length+'</b></font> کاراکتر ' );
}
return t;
}

function show_char(){

document.getElementById('check_sms_char').innerHTML = get_char();

}

function alert_sms(){
var m = document.getElementById('message_sms').value;

if(m.length == 0){
alert('متن خالی نمی توانید ارسال کنید');
return false;
}
var rex = /(<([^>]+)>)/ig;
var w = confirm(get_char().replace(rex , ""));
if(w){
return true;

}
return false;
}




</script>
						<div id="settings_right">
							
							
						<? if($D->error){?>
						<?= errorbox('خطا',$D->error_msg)?>
						<?}?>
							<? if($D->submit){?>
						<?= okbox('انجام شد',$D->submit_msg)?>
						<?}?>
							<div class="greygrad" style="margin-top:5px;">
								<div class="greygrad2">
									<div class="greygrad3">
						<?= msgbox('توضیحات',$D->num.' شماره فعال جهت ارسال پیام موجود می باشد ',false);?>
						<form action="<?=$C->SITE_URL?>admin/smsnews" method="post">
						
						<center>
						<textarea onkeyUp="show_char()" id="message_sms" name="sms_news" cols="80" rows="10"></textarea>
						<br><br>
						<p id="check_sms_char" >برای نمایش اطلاعات تایپ کنید</p>
						<input type="submit" onclick="return alert_sms()" name="sbm" value="ارسال"/>
						</center>
						
						</form>
<?php
	
	$this->load_template('footer.php');
	
?>