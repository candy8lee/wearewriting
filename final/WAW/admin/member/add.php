<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == 'INSERT'){
  $sql= "INSERT INTO member( account, password, email, createdDate)
                VALUES ( :account, :password, :email, :createdDate)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":account", $_POST['account'], PDO::PARAM_STR);
  $sth ->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
  $sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
  $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
  $sth -> execute();

  header('Location: list.php');
}
?>

<!DOCTYPE html>
<html>

<head>
<?php include_once("../template/header.php"); ?>
</head>
<body>
  <?php include_once("../template/nav.php"); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5" contenteditable="true">會員管理-新增</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5">
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item active">會員管理-新增</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="add.php"  data-toggle="validator" enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="account" class="control-label">帳號</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="account" name="account"  data-error="請填寫帳號。" required>
                <div class="help-block with-errors col-md-12" style="color:brown;"></div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="password" class="control-label">密碼</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="password" name="password" data-error="請設定密碼。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-2">
                    <label for="email" class="control-label">電子信箱</label>
                  </div>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" data-error="請輸入郵件地址。" required>
                    <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="MM_insert" value="INSERT">
                  <input type="hidden" name="createdDate" value="<?php echo date('y-m-d H:i:s') ?>">
                  <a class="btn btn-warning float-left" href="list.php" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
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
