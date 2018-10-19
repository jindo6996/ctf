<?php  

session_start();
include_once("config.php");
include("./simple-php-captcha/simple-php-captcha.php");

$_SESSION['captcha'] = simple_php_captcha();

header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; sandbox allow-scripts allow-same-origin allow-forms; img-src 'self'; style-src 'self' 'unsafe-inline' ");

$con = mysqli_connect($HOST, $USERDB, $PASSDB, $DB);
if (! $con){
	die( 'Connect failed: ' . mysqli_connect_error() );
}
$comment = "";
if( isset( $_GET['feature'] ) && isset( $_GET['comment'] ) ){
	$comment = $_GET['comment'];
	$feature = $_GET['feature'];

	if (strlen($feature) == 0) $feature = 'comments';

	$sql = "INSERT INTO $feature(content) VALUES ('$comment');";
	if (! mysqli_query( $con, $sql ) ) echo mysqli_error($con);

}

mysqli_query( $con, "DELETE FROM comments WHERE id > 1" );
$con -> close();

if( isset($_GET['source']) ){
	highlight_file('index.php');
}


/*
CREATE DATABASE IF NOT EXISTS web3;
use web3;

CREATE TABLE comments(
	id int(10) auto_increment primary key,
	content text not null
);

CREATE TABLE flag(
	id int(10) auto_increment primary key,
	content varchar(100) not null
);
*/

?>

<!DOCTYPE html>
<html>
<head>
	<title>NEWS</title>
	<style type="text/css">
		.bg {
			margin: 0 20% 0 20%;
			align: center;
		}
	</style>
</head>
<body>
	<h1></h1>
	<img src="background.jpg" class='bg'>
	<p class='bg'>Nếu áp dụng công nghệ giáo dục để thay đổi cái gì đó thì có được không? - I'm bot. I'll crawl your answer.</p>
	<?php echo $comment."\n"; ?>
	<form action="admin.php" method="post" class='bg'>
		<img src="<?php echo $_SESSION['captcha']['image_src']; ?>"><br>
		<input type="text" name="captcha" placeholder="Captcha"><br>
		<input type="text" name="url" placeholder="http://">
		<input type="submit">
	</form>
	<!-- /?source -->
</body>
</html>
