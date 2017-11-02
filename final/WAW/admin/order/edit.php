<?php
require_once("../template/login_check.php");
require_once("../../asset/connection/database.php");
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){
  $sql= "UPDATE  order SET
						            status= :status,
                        address= :address,
                        updatedDate= :updatedDate,
						            author= :author
                        WHERE orderID= :orderID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":status", $_POST['status'], PDO::PARAM_INT);
  $sth ->bindParam(":address", $_POST['address'], PDO::PARAM_SUB);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth ->bindParam(":orderID", $_POST['orderID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php?status='.$_POST['status']);
}

$sth = $db->query("SELECT * FROM order WHERE orderID=".$_GET['orderID']);
$order = $sth->fetch(PDO::FETCH_ASSOC);
 ?>

<html>

<head>
  <?php include_once("../template/header.php"); ?>
</head>
<body>
<?php require_once('../template/nav.php'); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5" contenteditable="true">訂單管理-<?php echo $order['title']; ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5">
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item">訂單管理-編輯</li>
			      <li class="breadcrumb-item active">
              <?php switch ($order['status']) {
                case 0:
                  echo "待付款 / 新訂單";
                  break;
                case 1:
                  echo "已付款 / 出貨中";
                  break;
                case 2:
                  echo "已出貨 / 運送中";
                  break;
                case 3:
                  echo "已送達 / 訂單完成";
                  break;
                case 99:
                  echo "訂單取消";
                  break;
              } ?>
              -<?php echo $order['orderNO']; ?>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="edit.php"  data-toggle="validator">
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="createdDate" class="control-label">訂單日期：</label>
                </div>
                <div class="col-sm-10">
                  <label for="createdDate" class="control-label"><?php echo $order['orderNO']; ?></label>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="orderNO" class="control-label">訂單編號：</label>
                </div>
                <div class="col-sm-10">
                  <label for="orderNO" class="control-label"><?php echo $order['orderNO']; ?></label>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                  <label for="status" class="control-label">處理進度：</label>
                  <select name="status" style="width:200px;">
                    <option value="0" <?php if ($order['status'] == 0) echo "selected" ?>>待付款 / 新訂單</option>
                    <option value="1" <?php if ($order['status'] == 1) echo "selected" ?>>已付款 / 出貨中</option>
                    <option value="2" <?php if ($order['status'] == 2) echo "selected" ?>>已出貨 / 運送中</option>
                    <option value="3" <?php if ($order['status'] == 3) echo "selected" ?>>已送達 / 訂單完成</option>
                    <option value="99" <?php if ($order['status'] == 99) echo "selected" ?>>訂單取消</option>
                  </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="memberID" class="control-label">訂購人(帳號)：</label>
                </div>
                <div class="col-sm-10">
                  <?php
                    $sth = $db->query("SELECT * FROM member WHERE membetID=".$order['memberID']);
                    $member = $sth->fetch(PDO::FETCH_ASSOC);
                   ?>
                  <label for="memberID" class="control-label"><?php echo $member['account']; ?></label>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="address" class="control-label">寄送地址：</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" name="address" value="<?php echo $order['address']; ?>">
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-2 text-right">
                <input type="hidden" name="MM_update" value="UPDATE">
                <input type="hidden" name="orderID" value="<?php echo $order['orderID']; ?>">
                <input type="hidden" name="updatedDate" value="<?php echo date('y-m-d H:i:s') ?>">
				         <input type="hidden" name="author" value="admin">
                <a class="btn btn-warning float-left" href="list.php?status=<?php echo $_GET['status']; ?>" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                <button type="submit" class="btn btn-warning">送出</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
