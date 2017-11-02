<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == 'INSERT'){
  $sql= "INSERT INTO acts( start, happy_end, title, content, createdDate)
                    VALUES ( :start, :happy_end, :title, :content, :createdDate)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":start", $_POST['start'], PDO::PARAM_STR);
  $sth ->bindParam(":happy_end", $_POST['happy_end'], PDO::PARAM_STR);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
  $sth -> execute();

  header('Location: list.php');
}

include_once("../template/header.php");
?>

<!DOCTYPE html>
<html>

<head>
<?php require_once('../template/header.php'); ?>
  <script>
  $( function() {
    $( ".Date" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "yy-mm-dd"
    });
  } );
  </script>
</head>
<body>
  <?php include_once("../template/nav.php"); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5" contenteditable="true">活動管理-新增</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item">
              <a href="list.php">主控台</a>
            </li>
            <li class="breadcrumb-item active">活動管理-新增</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="add.php"  data-toggle="validator">
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="start" class="control-label">開始日期</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control date" id="start" name="start" value="<?php echo date('Y-m-d') ?>" data-error="請選擇開始日期。" required>
                <div class="help-block with-errors col-md-12" style="color:brown;"></div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="happy_end" class="control-label">結束日期</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control date" id="happy_end" name="happy_end" value="<?php echo date('Y-m-d') ?>" data-error="請選擇結束日期。" required>
                <div class="help-block with-errors col-md-12" style="color:brown;"></div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="title" class="control-label">標題</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title" data-minlength="3" data-error="標題至少三字元" required>
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
                  <a class="btn btn-warning float-left" href="list.php" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                  <button type="submit" class="btn btn-warningbtn-warning">送出</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
