<?php
require_once("../template/login_check.php");
require_once("../../asset/connection/database.php");
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){
  $sql= "UPDATE  news SET
                        publishedDate= :publishedDate,
                        title= :title,
                        content= :content,
                        updatedDate= :updatedDate,
                        author= :author
                        WHERE newsID= :newsID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":publishedDate", $_POST['publishedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth ->bindParam(":newsID", $_POST['newsID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php');
}
$sql = "SELECT * FROM news WHERE newsID=".$_GET['newsID'];
$sth = $db->query($sql);
$news = $sth->fetch(PDO::FETCH_ASSOC);
 ?>

<html>

<head>
  <?php include_once("../template/header.php"); ?>
  <title>最新消息管理-<?php echo $news['title']; ?></title>
  <script type="text/javascript">
    $(function() {
      $("#publishedDate").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        minDate: new Date(2010, 1 - 1, 1),
        maxDate: "+6m"
      });
    });
  </script>
</head>
<body>
<?php require_once('../template/nav.php'); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5" contenteditable="true">最新消息管理-<?php echo $news['title']; ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item">最新消息管理-編輯</li>
            <li class="breadcrumb-item active"><?php echo $news['title']; ?></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="edit.php">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="publishedDate" class="control-label">發布日期</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="publishedDate" name="publishedDate" value="<?php echo $news['publishedDate'] ?>" required>
                  <div class="help-block with-errors col-md-12" style="color:red;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="title" class="control-label">標題</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title" value="<?php echo $news['title']; ?>" data-minlength="3" data-error="標題至少三字元" required>
                  <div class="help-block with-errors col-md-12" style="color:red;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="content" class="control-label">內容</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="content" name="content"><?php echo $news['content']; ?></textarea>
                  <div class="help-block with-errors col-md-12" style="color:blue;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <a class="btn btn-outline-warning float-left" href="list.php" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="MM_update" value="UPDATE">
                  <input type="hidden" name="author" value="<?php echo $_SESSION['account'] ?>">
                  <input type="hidden" name="newsID" value="<?php echo $news['newsID']; ?>">
                  <input type="hidden" name="updatedDate" value="<?php echo date('Y-m-d H:i:s') ?>">
                  <button type="submit" class="btn btn-warning">送出更新ㄌ</button>
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
