<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == 'INSERT'){
  $sql= "INSERT INTO industry( title, content, class, createdDate, author)
                VALUES ( :title, :content, :class, :createdDate, :author)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":class", $_POST['class'], PDO::PARAM_STR);
  $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
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
          <h1 class="display-5" contenteditable="true">相關產業介紹管理-新增</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5">
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item active">相關產業介紹管理-新增</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="add.php"  data-toggle="validator">
            <div class="form-group">
                <div class="col-sm-12">
                  <label for="class" class="control-label">產業別：</label>
                  <select name="class" style="width:200px;">
                    <option value="印刷業">印刷業</option>
                    <option value="造紙">造紙</option>
                    <option value="周邊商品">周邊商品</option>
                  </select>
                <div class="help-block with-errors col-md-12" style="color:brown;"></div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="title" class="control-label">標題</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title"  data-error="請填寫標題。" required>
                <div class="help-block with-errors col-md-12" style="color:brown;"></div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="content" class="control-label">內容</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="content" name="content" data-error="請輸入內文" required></textarea>
                  <div class="help-block with-errors col-md-12" style="color:blue;"></div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="MM_insert" value="INSERT">
                  <input type="hidden" name="createdDate" value="<?php echo date('y-m-d H:i:s') ?>">
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
</body>
</html>
