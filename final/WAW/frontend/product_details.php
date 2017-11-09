<html>
<head>
<?php require_once('template/header.php'); ?>
<style media="screen">
	#contact{
		margin:-20px 0;
	}
	h3{
		text-align: right;
	}
</style>
<script>
  $( function() {
    $( "#boards_click" ).accordion({
      heightStyle: "content",
      active: false,
	  	collapsible: true
    });
  } );
</script>
</head>

<body>
<?php require_once('template/nav.php'); ?>
<div class="">
    <h1 class="text-center">We Are Writing</h1>
</div>
<div id="boards_click">
	<h3>留言板&nbsp&nbspCLICK▼&nbsp點擊顯示</h3>
	<div>買家推坑大全 / 閒聊版
	<?php include_once("template/boards.php"); ?>
	</div>
</div>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
