<html>
<head>
<?php require_once('template/header.php'); ?>
<style media="screen">
#tabs{
	margin: 100px auto 5px -50px;
	width: 350px;
	height: 50px;
	background: linear-gradient(-45deg, transparent 20%, brown 0) bottom right, linear-gradient(-135deg, transparent 20%, brown 0) top right, linear-gradient(45deg, transparent 20%, brown 0) bottom left, linear-gradient(135deg, transparent 20%, brown 0) top left ;
	background-size: 60% 100%;
	background-repeat: no-repeat;
}
#tabs p{
	position: relative;
	color: #eee2d2;
	text-align: center;
	font-size: 40px;
	letter-spacing: 5px;
}
#tabs p::after{
	content: "NEW!";
	position: relative;
	margin-left: -128px;
	color: rgba(255,255,255,0.4);
}
#tabs_past{
	margin: 100px auto 5px 1px;
	width: 700px;
	height: 30px;
	background: linear-gradient(-45deg, transparent 15%, rgb(135, 179, 208) 0) bottom right, linear-gradient(-135deg, transparent 15%, rgb(135, 179, 208) 0) top right, linear-gradient(45deg, transparent 15%, rgb(135, 179, 208) 0) bottom left, linear-gradient(135deg, transparent 15%, rgb(135, 179, 208) 0) top left ;
	background-size: 60% 100%;
	background-repeat: no-repeat;
}
#tabs_past p{
	position: relative;
	color: #eee2d2;
	text-align: center;
	font-size: 20px;
	letter-spacing: 5px;
}
#tabs_past p::after{
	content: "PAST";
	position: relative;
	font-weight: bold;
	margin-left: -73px;
	color: rgba(255,255,255,0.4);
}
@media only screen and (max-width: 768px){
	#tabs{
		margin: 100px auto 5px -5px;
		width: 80%;
	}
	#tabs_past{
		width: 70%
	}
}
</style>
</head>

<body>
<?php require_once('template/nav.php'); ?>
<div class="container">
  <div class="row">
    <div id="tabs"><p>NEW!</p></div>
    <div id="new_acts" class="col-sm-12">
      <div></div>
    </div>
  </div>
</div>
<div class="row">
  <div id="tabs_past"><p>PAST</p></div>
  <div class="col-sm-12 past_acts">
    <div class="col-sm-3">
      <!--點圖片會跳出之前的宣傳圖-->
      <a href="#"><img src="images/textphoto1.jpg" alt=""></a>
    </div>
    <div class="col-sm-9">詳細內容詳細內容詳細內容詳細內容詳細內容詳細內容詳細內容詳細內容詳細內容詳細內容詳細內容詳細內容詳細內容詳細內容詳細內容詳細內容。</div>
  </div>
</div>

<?php include_once("template/contact.php"); ?>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
