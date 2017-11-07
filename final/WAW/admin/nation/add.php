<?php
require_once("../template/login_check.php");
require_once("../../asset/connection/database.php");
if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == 'INSERT'){
  $sql= "INSERT INTO nation( name, name_cht, area, createdDate, author)
                VALUES ( :name, :name_cht, :area, :createdDate, :author)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":name_cht", $_POST['name_cht'], PDO::PARAM_STR);
  $sth ->bindParam(":area", $_POST['area'], PDO::PARAM_STR);
  $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth -> execute();

  header('Location: ../brand/list.php');
}
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
          <h1 class="display-5" contenteditable="true">新增業務範圍</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5">
            <li class="breadcrumb-item"><a href="../brand/list.php">主控台</a></li>
            <li class="breadcrumb-item active">新增業務範圍</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="add.php"  data-toggle="validator">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="name" class="control-label">國家(英文)</label><br>
				          <a href="https://zh.wikipedia.org/wiki/%E4%B8%96%E7%95%8C%E6%94%BF%E5%8D%80%E7%B4%A2%E5%BC%95">參考資料</a>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" data-error="請填寫國家。" pattern="^[_A-z\s]{1,}$" data-minlength="4" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
			      <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="name" class="control-label">國家(中文)</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name_cht" name="name_cht" data-error="請填寫國家。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
			      <div class="form-group">
              <div class="row">
                <div class="col-sm-12 text-right">
                  <label for="area" class="control-label">洲別</label>
                  <select name="area" style="width: 200px;" required>
        						<option value="亞洲">&nbsp&nbsp亞洲</option>
        						<option value="歐洲">&nbsp&nbsp歐洲</option>
        						<option value="美洲">&nbsp&nbsp美洲</option>
        						<option value="大洋洲">&nbsp&nbsp大洋洲</option>
        				  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <a class="btn btn-warning float-left" href="../brand/list.php" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                </div>
                <div class="col-sm-10 text-right">
                  <input type="hidden" name="MM_insert" value="INSERT">
                  <input type="hidden" name="createdDate" value="<?php echo date('y-m-d H:i:s') ?>">
				          <input type="hidden" name="author" value="<?php echo $_SESSION['account'] ?>">
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
