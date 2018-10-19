<?php  

session_start();
include_once("config.php");
include("./simple-php-captcha/simple-php-captcha.php");

if ($_SESSION['captcha']['code'] !== $_POST['captcha']) {
	$_SESSION['captcha'] = simple_php_captcha();
	die('Wrong captcha');
}
if( isset( $_POST['url'] ) ){
	 $_SESSION['captcha'] = simple_php_captcha();
	// Run bot
	$url = escapeshellarg( $_POST['url'] );
	exec("/usr/local/bin/phantomjs bot.js $url");
	// Waiting 5s ....
	echo 'Your secret will delete after 3s ......';
	sleep(10);
//	$begin_time = date('s');
//	while ((date('s') - $begin_time) < 8){
		
//	}
	system("/opt/lampp/bin/mysql -u $USERDB -p$PASSDB $DB -e 'DELETE FROM flag WHERE id > 0'" );
	header('Location: /web3/');
	header('Fact: we delete content after 5s');
	// có thể set user/pass trong biến môi trường và dùng biến môi trường thay vì dùng pass (user: web, pass: web)
}


?>
