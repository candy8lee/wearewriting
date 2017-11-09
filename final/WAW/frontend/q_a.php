<html>
<head>
<?php require_once('template/header.php'); ?>
<style media="screen">
.cate_title_tabs{
  margin: 100px 10% 5px auto;
  padding-top: 5px;
  width: 350px;
  height: 40px;
  background: linear-gradient(-45deg, transparent 15%, rgb(135, 179, 208) 0) bottom right, linear-gradient(-135deg, transparent 15%, rgb(135, 179, 208) 0) top right, linear-gradient(45deg, transparent 15%, rgb(135, 179, 208) 0) bottom left, linear-gradient(135deg, transparent 15%, rgb(135, 179, 208) 0) top left ;
  background-size: 60% 100%;
  background-repeat: no-repeat;
}
.cate_title_tabs p{
  position: relative;
  color: #eee2d2;
  text-align: center;
  font-size: 20px;
  letter-spacing: 5px;
}
.cate_title_tabs p::after{
  content: "購物流程";
  position: relative;
  margin-left: -101px;
  color: rgba(255,255,255,1);
}
@media only screen and (max-width: 768px){
  .cate_title_tabs{
    margin: 100px -15px 5px auto;
    width: 90%;
  }
}
</style>
</head>
<body>
<?php require_once('template/nav.php'); ?>
<div class="bookmark">快速尋找分類
  <ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="q_a.php#<?php?>">購物流程</a></li>
    <li class="breadcrumb-item"><a href="q_a.php#<?php?>">購物流程</a></li>
    <li class="breadcrumb-item"><a href="q_a.php#<?php?>">購物流程</a></li>
    <li class="breadcrumb-item"><a href="q_a.php#<?php?>">購物流程</a></li>
  </ul>
</div>
<div class="container">
  <div class="row">
    <!--PHP資料匯入時改變CSS的content
    https://www.w3schools.com/jquery/tryit.asp?filename=tryjquery_css_setcolor
  -->
    <div class="col-sm-10 col-sm-offset-2">
      <div id="<?php?>" class="cate_title_tabs"><p>購物流程</p></div>
      <div class="q_a_title">
        title
      </div>
      <div class="q_a_content">
        內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容內容
      </div>
    </div>
  </div>
</div>
<?php include_once("template/contact.php"); ?>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
