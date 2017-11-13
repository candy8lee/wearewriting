<html>
<head>
<?php require_once('template/header.php'); ?>
</head>
<script>
$( function() {
	$( "#brithday" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd",
		defaultDate: "-20y",
		maxDate: "-10y",
		minDate: new Date(1901, 1 - 1, 1)
	});
} );
</script>
<body>
<?php require_once('template/nav.php'); ?>
<div class="">
    <h1 class="text-center">We Are Writing</h1>
</div>
<hr></hr>
<h3 class="text-center">會員專區 - 編輯</h3>
<div class="container">
  <div class="row cart">
		<?php
			$sth = $db->query("SELECT * FROM member WHERE account='".$_SESSION['account']."'");
			$member = $sth->fetch(PDO::FETCH_ASSOC);
		?>
		<form action="member_edit.php" method="post" data-toggle="validator">
			<div id="member_edit" class="col-sm-12 text-center">
				<img src="../upload/member/<?php echo $member['picture']; ?>" alt="">
				<input type="file" name="picture" value="">
				<input type="hidden" name="picture1" value="<?php echo $member['picture']; ?>">
			</div>
			<div class="col-sm-offset-3 col-sm-6 col-sm-offset-3 text-left">
				<div class="row">
					<div class="col-sm-10">
						<span>帳號：</span>
						<label><?php echo $member['account']; ?></lable>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10">
						<span>名字：</span>
						<input type="text" id="name" name="name" value="<?php echo $member['name']; ?>" required>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10">
						<span>生日：</span>
						<input type="text" id="brithday" name="brithday" value="<?php echo $member['brithday']; ?>" required>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10">
						<span>地址：</span>
						<input type="text" id="address" name="address" value="<?php echo $member['address']; ?>" required>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10">
						<span>電子信箱：</span>
						<input type="email" id="email" name="email" value="<?php echo $member['email']; ?>" required>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10">
						<span>聯絡電話：</span>
						<input type="number" id="phone" name="phone" value="<?php echo $member['phone']; ?>" required>
					</div>
				</div>
				<div class="text-right">
					<div class="row">
						<div class="col-sm-12">
							<span>新密碼：</span><input type="password" id="password" name="password" value="<?php echo $member['password']; ?>" required>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<span>確認密碼：</span><input type="password" id="password" name="password" value="<?php echo $member['password']; ?>" required>
						</div>
					</div>
				</div>
				<div class="text-right">
					<button class="btn btn-warning btn-lg" type="submit" name="button">送出</button>
				</div>
			</div>
	  </div>
	</div>
</form>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
