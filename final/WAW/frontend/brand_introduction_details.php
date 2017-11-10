<html>
<head>
<?php require_once('template/header.php'); ?>
</head>

<body>
<?php require_once('template/nav.php'); ?>
<?php
  $sth = $db->query("SELECT * FROM brand WHERE brandID=".$_GET['brandID']);
  $brand = $sth->fetch(PDO::FETCH_ASSOC);
 ?>
<div class="container">
  <div class="row">
    <div id="brand_logo" class="col-sm-offset-2 col-sm-8 col-sm-offset-2 text-center">
      <img src="../upload/brand/<?php echo $brand['logo']; ?>" alt="">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">

    </div>
  </div>
</div>
<?php include_once("template/contact.php"); ?>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
