<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == 'INSERT'){


  $sql= "INSERT INTO q_a_category( category, createdDate, author)
                    VALUES ( :category, :createdDate, :author)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":category", $_POST['category'], PDO::PARAM_STR);
  $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth -> execute();

  header('Location: list.php');
}

?>

<!DOCTYPE html>
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
          <h1 class="display-5" contenteditable="true">常見問題分類管理-新增</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <ul class="breadcrumb my-3" style="margin-bottom:0px;margin-top:0px">
          <li class="breadcrumb-item">
            <a href="list.php">主控台</a>
          </li>
          <li class="breadcrumb-item active">常見問題分類管理-新增</li>
        </ul>
        <div class="col-md-12">
          <form class="" method="post" action="add.php"  data-toggle="validator">
            <div class="form-group text-right">
              <div class="row">
                <div class="col-sm-2">
                  <label for="Title" class="control-label">分類名稱</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="category" name="category" data-minlength="1" data-error="分類名稱至少一字元" required>
                  <div class="help-block with-errors col-md-12" style="color:red;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <a class="btn btn-warning float-left" href="list.php" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="MM_insert" value="INSERT">
                  <input type="hidden" name="author" value="<?php echo $_SESSION['account'] ?>">
                  <input type="hidden" name="createdDate" value="<?php echo date('y-m-d H:i:s') ?>">
                  <button type="submit" class="btn btn-warning">送出</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
