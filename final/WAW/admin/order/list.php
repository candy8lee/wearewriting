<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
$limit = 5;//order item 筆數限制
if (isset($_GET["page"])) { $page_num  = $_GET["page"]; } else { $page_num=1; };//判斷網址上有沒有頁碼、沒有就預設第一頁
$start_from = ($page_num-1) * $limit;//order item 從第幾筆開始//ex:(第二頁-1)*limit->[5]開始數五個出來//[0]開始
$sql = "SELECT * FROM customer_order WHERE status =".$_GET['status']." ORDER BY createdDate DESC LIMIT ".$start_from.",".$limit;// LIMIT num,num
$sth = $db->query($sql);
$order = $sth->fetchALL(PDO::FETCH_ASSOC);
$totalRows = count($order);
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
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item active">訂單管理-<?php echo $status; ?></li>
          </ul>
		</div>
	  </div>
	  <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr class="text-center">
                <th>訂單日期</th>
                <th>訂單編號</th>
                <th>聯絡電話</th>
                <th width=35% >寄送地址</th>
                <th width=10% >編輯</th>
                <th width=10% >訂單明細</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($order as $row ) { ?>
              <tr class="text-center">
                <td><?php echo $row['createdDate']; ?></td>
                <td><?php echo $row['orderNO']; ?></td>
                <td><?php echo $row['phone']; ?></td>
				        <td><?php echo $row['address']; ?></td>
                <td><a href="edit.php?orderID=<?php echo $row['orderID']; ?>" class="btn btn-warning" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td><a href="../order_details/list.php?orderID=<?php echo $row['orderID']; ?>&status=<?php echo $_GET['status']; ?>&page=<?php echo $page_num; ?>" class="btn btn-danger" role="button"><i class="fa fa-book" aria-hidden="true"></i></a></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php
          if($totalRows > 0){
                $sth = $db->query("SELECT * FROM customer_order WHERE status =".$_GET['status']." ORDER BY createdDate DESC");
                $data_count = count($sth->fetchAll(PDO::FETCH_ASSOC));
                $totalpages = ceil($data_count / $limit );//四捨五入
          ?>
          <ul class="pagination float-right">
            <?php include_once("../template/page_num.php"); ?>
          </ul>
        <?php }//if totalRows > 0 ?>
        </div>
      </div>
  </div>
</body>

</html>
