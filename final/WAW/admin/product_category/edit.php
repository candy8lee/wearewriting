<?php
require_once("../../asset/connection/database.php");
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){
  $sql= "UPDATE product_category SET
                                 category= :category,
                                 updatedDate= :updatedDate,
                                 authoe= :author
                                 WHERE categoryID= :categoryID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":category", $_POST['category'], PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":authoe", $_POST['authoe'], PDO::PARAM_STR);
  $sth ->bindParam(":categoryID", $_POST['categoryID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php');
}
$sql = "SELECT * FROM product_category WHERE categoryID=".$_GET['cateID'];
$sth = $db->query($sql);
$product_category = $sth->fetch(PDO::FETCH_ASSOC);
 ?>
<html>

<head>
<?php require_once('../template/header.php'); ?>
</head>

<body>
  <?php include_once("../template/nav.php"); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5" contenteditable="true">商品分類管理-編輯</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
		  <ul class="breadcrumb my-5" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item">
              <a href="list.php">主控台</a>
            </li>
            <li class="breadcrumb-item active">商品分類管理-<?php echo $product_category['category']; ?></li>
          </ul>
          <form class="" method="post" action="edit.php"  data-toggle="validator">
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="Title" class="control-label">分類名稱</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="category" name="category" data-minlength="1" data-error="分類至少一字元" required value="<?php echo $product_category['category'];?>">
                  <div class="help-block with-errors col-md-12" style="color:red;"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="MM_update" value="UPDATE">
                  <input type="hidden" name="updatedDate" value="<?php echo date('y-m-d H:i:s') ?>">
                  <input type="hidden" name="categoryID" value="<?php echo $product_category['categoryID']; ?>">
                  <input type="hidden" name="author" value="admin">
				          <a class="btn btn-warning float-left" href="list.php" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                  <button type="submit" class="btn btn-warning">送出</button>
                </div>
              </div>
          </form>
        </div>
      </div>
   </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
  <script src="../../assets/js/validator.min.js"></script>
</body>

</html>
