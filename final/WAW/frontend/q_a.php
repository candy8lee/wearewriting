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
.cate_title_tabs_p{
  position: relative;
  color: white;
  text-align: center;
  font-size: 20px;
  letter-spacing: 5px;
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
<?php
  $sth = $db -> query("SELECT * FROM q_a_category");
  $category = $sth->fetchALL(PDO::FETCH_ASSOC);
?>
  <ul class="breadcrumb">
  <?php foreach ($category as $row) {?>
    <li class="breadcrumb-item"><a href="q_a.php#<?php echo $row['categoryID']; ?>"><?php echo $row['category']; ?></a></li>
  <?php } ?>
  </ul>
</div>
<div class="container">
<?php foreach ($category as $row) {?>
  <div class="row">
    <div id="<?php echo $row['categoryID']; ?>" class="cate_title_tabs"><p class="cate_title_tabs_p"><?php echo $row['category']; ?></p></div>
    <?php
      $sth = $db -> query("SELECT * FROM q_a_reply WHERE categoryID=".$row['categoryID']);
      $reply = $sth->fetchALL(PDO::FETCH_ASSOC);
      foreach ($reply as $row2) { ?>
    <div class="col-sm-10 col-sm-offset-2">
      <div class="q_a_title">
        <?php echo $row2['title']; ?>
      </div>
      <div class="q_a_content">
        <?php echo $row2['reply']; ?>
      </div>
    </div>
  <?php } ?>
  </div>
<?php } ?>
</div>
<?php include_once("template/contact.php"); ?>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
