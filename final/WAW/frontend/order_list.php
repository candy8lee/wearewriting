<html>
<head>
<?php require_once('template/header.php'); ?>
<?php
$sth = $db -> query("SELECT * FROM customer_order WHERE memberID=".$_SESSION['memberID']." ORDER BY createdDate DESC");
$order_list = $sth ->fetchALL(PDO::FETCH_ASSOC);
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
          <th width=20%>訂單日期</th>
          <th>訂單編號</th>
          <th>收件者</th>
          <th width="12%">商品數量</th>
          <th width="12%">聯繫客服</th>
          <th width="12%">訂單細節</th>
          <th width=15%>狀態</th>
        </tr>
      <?php foreach($order_list as $row){ ?>
        <tr>
          <td><?php echo $row['orderDate']; ?></td>
          <td><?php echo $row['orderNO']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td>
          <?php
            $sth = $db -> query("SELECT * FROM order_details WHERE orderID=".$row['orderID']);
            $details = $sth ->fetchALL(PDO::FETCH_ASSOC);
            $count = 0;
            for($i=0; $i < count($details); $i++)
              $count++;
            echo $count;
          ?>
          </td>
          <td><a href="member_question.php?orderNO=<?php echo $row['orderNO']; ?>"><i class="fa fa-comments-o" aria-hidden="true"></i></a></td>
          <td><a href="order_detail.php?orderID=<?php echo $row['orderID']; ?>"><i class="fa fa-book" aria-hidden="true"></i></a></td>
          <td>
          <?php
            switch ($row['status']) {
              case '0':
                echo "待付款 / 新訂單";
                break;
              case '1':
                echo "已付款 / 出貨中";
                break;
              case '2':
                echo "已出貨 / 運送中";
                break;
              case '3':
                echo "已送達 / 訂單完成";
                break;
              case '99':
                echo "訂單取消";
                break;
            }
          ?>
          </td>
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
