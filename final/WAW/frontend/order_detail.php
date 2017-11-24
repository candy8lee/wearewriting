<html>
<head>
<?php require_once('template/header.php'); ?>
<?php
$sth = $db -> query("SELECT * FROM order_details WHERE orderID=".$_GET['orderID']);
$order_details = $sth ->fetchALL(PDO::FETCH_ASSOC);
?>
</head>
<body>
<?php require_once('template/nav.php'); ?>
<div class="">
    <h1 class="text-center">We Are Writing</h1>
</div>
<hr></hr>
<h3 class="text-center">訂單紀錄<a/></h3>
<div class="container">
  <div class="row cart">
    <div class="col-sm-12">
      <table class="text-center" id="reply">
        <tr>
          <th width="20%">商品圖片</th>
          <th width="35%">品名</th>
  		    <th width="10%">單價</th>
          <th width="10%">數量</th>
          <th width="20%">小計</th>
        </tr>
      <?php foreach($order_details as $row){ ?>
        <tr>
          <td><img src="../upload/product/<?php echo $row['picture']; ?>"></td>
          <td><?php echo $row['productID']; ?></td>
          <td><?php echo $row['price']; ?></td>
          <td><?php echo $row['quantity']; ?></td>
          <td><?php echo $row['price']*$row['quantity']; ?></td>
        </tr>
      <?php } ?>
      </table>
    </div>
	</div>
</div>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
