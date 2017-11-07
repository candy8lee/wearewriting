<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');

$sql = "SELECT * FROM order_details WHERE orderID =".$_GET['orderID'];
$sth = $db->query($sql);
$order_details = $sth->fetchALL(PDO::FETCH_ASSOC);
$totalRows = count($order_details);

$sth = $db->query("SELECT * FROM customer_order WHERE orderID =".$_GET['orderID']);
$order = $sth->fetch(PDO::FETCH_ASSOC);
 ?>
<html>
<head>
<?php require_once('../template/header.php'); ?>
</head>

<body>
<?php require_once('../template/nav.php'); ?>
    <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php
          switch ($_GET['status']) {
            case 0:
              $status = "待付款 / 新訂單";
              break;
            case 1:
              $status = "已付款 / 出貨中";
              break;
            case 2:
              $status = "已出貨 / 運送中";
              break;
            case 3:
              $status = "已送達 / 訂單完成";
              break;
            case 99:
              $status = "訂單取消";
              break;
          } ?>
          <h1 class="display-5 my-4" contenteditable="true">訂單管理-<?php echo $status; ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-3" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item"><a href="../order/list.php?status=<?php echo $_GET['status']; ?>&page=<?php echo $_GET['page']; ?>">主控台</a></li>
            <li class="breadcrumb-item ">訂單管理-<?php echo $status; ?></li>
            <li class="breadcrumb-item active">訂單編號-<?php echo $order['orderNO']; ?></li>
          </ul>
		</div>
	  </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <tr>
              <th>商品名稱</th>
              <th>單價</th>
              <th>數量</th>
              <th>小計</th>
              <th>備註</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($order_details as $row) { ?>
            <tr>
              <?php
                $sth = $db->query("SELECT * FROM product WHERE productID =".$row['productID']);
                $product = $sth->fetch(PDO::FETCH_ASSOC);
               ?>
              <td><?php echo $product['name']; ?></td>
              <td><?php echo $row['price']; ?></td>
              <td><?php echo $row['quantity']; ?></td>
              <td><?php echo $row['quantity']*$row['price']; ?></td>
              <td><?php echo $row['postscript']; ?></td>
            </tr>
          <?php }?>
          </tbody>
        </table>
        <div class="col-sm-10 col-sm-offset-2 text-right">
          <a class="btn btn-warning float-left" href="../order/list.php?status=<?php echo $_GET['status']; ?>&page=<?php echo $_GET['page']; ?>">返回上一頁</a>
        </div>
      </div>
      </div>
    </div>
  </div>
</body>

</html>
