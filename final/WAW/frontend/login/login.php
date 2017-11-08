<?php
session_start();
require_once('../../asset/connection/database.php');
if(isset($_POST['MM_login']) && $_POST['MM_login'] == 'LOGIN'){
	$sth = $db -> query("SELECT * FROM member WHERE account='".$_POST['account']."' AND password='".$_POST['password']."'");
	$user = $sth -> fetch(PDO::FETCH_ASSOC) ;
	if(isset($user) && $user != null){
			$_SESSION['account'] = $user['account'];
			header('Location: news/list.php');
	}else{
			$msg = '帳號或密碼有誤，請重新輸入。';
			header('Location: login.php?msg='.$msg);
	}
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Animated Login Screen - Bootsnipp.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="login.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
<form name="login-form" class="login-form" action="login.php" method="post">
	<div id="login-box">
    <div id="glass"></div>
		<div class="logo">
			<img src="login.jpg" class="img img-responsive img-circle center-block"/>
			<h1 class="logo-caption"><span class="tweak">L</span>ogin</h1>
		</div><!-- /.logo -->
		<?php if(isset($_GET['msg'])&& $_GET['msg'] != null){ ?>
		<div class="text-center">
			<strong><?php echo $_GET['msg']; ?></strong>
		</div>
		<?php } ?>
		<div class="controls">
			<input type="text" name="account" placeholder="account" class="form-control" />
			<input type="password" name="password" placeholder="password" class="form-control" />
			<button type="submit" name="submit" value="Login" class="btn btn-default btn-block btn-custom">Login</button>
      <input type="hidden" name="MM_login" value="LOGIN">
		</div><!-- /.controls -->
	</div><!-- /#login-box -->
</div><!-- /.container -->
</form><!-- /.form -->
<div id="particles-js"></div>
</body>
</html>
