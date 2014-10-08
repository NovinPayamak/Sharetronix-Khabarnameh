<?php
	
	if( !$this->network->id ) {
		$this->redirect('home');
	}
	if( !$this->user->is_logged ) {
		$this->redirect('signin');
	}
	$db2->query('SELECT 1 FROM users WHERE id="'.$this->user->id.'" AND is_network_admin=1 LIMIT 1');
	if( 0 == $db2->num_rows() ) {
		$this->redirect('dashboard');
	}
	ini_set('max_execution_time', 900);
	$this->load_langfile('inside/global.php');
	$this->load_langfile('inside/admin.php');
	
	$D->page_title	= "خبرنامه پیامکی-".$C->SITE_TITLE;
	$D->error = false;
	$D->error_msg = "";
	$D->submit = false;
	$D->submit_msg = "";
	
	
	
$q = $db2->query('SELECT mobile_sms FROM users WHERE active="1" AND mobile_actived="1" ORDER BY id DESC');	
	
$D->num = $db2->num_rows($q);	



if(isset($_POST['sbm']) ){
if(!$message = trim($_POST['sms_news'])){
$D->error = true;
$D->error_msg="متن خالیست<br>";
}

if(!$D->num){
$D->error = true;
$D->error_msg="گیرنده موجود نیست";
}
if(!$D->error){
while($o =  $db2->fetch_object($q)){

$user_mobile = valid_mobile_num(decode_mobile_num($o->mobile_sms)) ? decode_mobile_num($o->mobile_sms) : false;

if($user_mobile){
SEND_SMS($user_mobile,$message);
	sleep(0.8);
}

}

$D->submit=true;
$D->submit_msg="ارسال شد.";
}







}	
	
$this->load_template('admin_smsnews.php');



?>