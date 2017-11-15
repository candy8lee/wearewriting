<html>
<head>
<?php require_once('template/header.php'); ?>
</head>
<body>
<?php require_once('template/nav.php'); ?>
<div class="">
    <h1 class="text-center">We Are Writing</h1>
</div>
<hr></hr>
<h3 class="text-center">會員專區 - 客服留言</h3>
<div class="container">
  <div class="row cart">
		<form action="member_question.php" method="post" data-toggle="validator">
			<div id="member_edit" class="col-sm-12 text-center">
				<img src="../upload/member/<?php echo $member['picture']; ?>" alt="">
				<input type="file" name="picture" value="">
				<input type="hidden" name="picture1" value="<?php echo $member['picture']; ?>">
			</div>
			<div class="col-sm-offset-3 col-sm-6 col-sm-offset-3 text-left">
				<div class="row">
				
				<div class="text-right">
					<button class="btn btn-warning btn-lg" type="submit" name="button">送出</button>
				</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
