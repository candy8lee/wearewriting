<?php
require_once("../template/login_check.php");
require_once("../../asset/connection/database.php");
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){

  if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != null){
    if (!file_exists('../../upload/acts')) mkdir('../../upload/acts', 0755, true);
    $fileTYPE = strrchr($_FILES['picture']['name'],".");//查找字串，遇到"."停止->分割副檔名
    $filename = $_POST['start']."_".$_POST['happy_end'].$fileTYPE;
    move_uploaded_file($_FILES['picture']['tmp_name'] , "../../upload/acts/".$filename);   // 搬移上傳檔案
    $picture1 = "../../upload/acts/".$_POST['picture1'];
    unlink($picture1);//刪除之前上傳的picture
  }else{
    $filename = $_POST['picture1'];
  }
  $sql= "UPDATE  acts SET
                        start= :start,
                        happy_end= :happy_end,
                        title= :title,
                        picture= :picture,
                        content= :content,
                        updatedDate= :updatedDate,
                        author= :author
                        WHERE actID= :actID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":start", $_POST['start'], PDO::PARAM_STR);
  $sth ->bindParam(":happy_end", $_POST['happy_end'], PDO::PARAM_STR);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth ->bindParam(":actID", $_POST['actID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php');
}
$sql = "SELECT * FROM acts WHERE actID=".$_GET['actID'];
$sth = $db->query($sql);
$acts = $sth->fetch(PDO::FETCH_ASSOC);
 ?>

<html>

<head>
  <?php include_once("../template/header.php"); ?>
  <script type="text/javascript">
    $(function() {
      $(".Date").datepicker({
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
          <h1 class="display-5" contenteditable="true">活動管理-<?php echo $acts['title']; ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item">
              <a href="list.php">主控台</a>
            </li>
            <li class="breadcrumb-item active">活動管理-<?php echo $acts['title']; ?></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="edit.php"  data-toggle="validator"  enctype="multipart/form-data">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="start" class="control-label">開始日期</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control date" id="start" name="start" value="<?php echo $acts['start'] ?>" data-error="請選擇開始日期。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="happy_end" class="control-label">結束日期</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control date" id="happy_end" name="happy_end" value="<?php echo $acts['happy_end'] ?>" data-error="請選擇結束日期。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="title" class="control-label">標題</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title" value="<?php echo $acts['title']; ?>" data-minlength="3" data-error="標題至少三字元" required>
                  <div class="help-block with-errors col-md-12" style="color:red;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-8">
                  <label for="title" class="control-label">宣傳圖 - *寬高比請5:2 ex: 500px*200px - 1000px*400px</label>
                  <img src="../../upload/acts/<?php echo $acts['picture']; ?>" width="100%"></img>
                </div>
                <div class="col-sm-4">
                  <input type="file" class="form-control" id="picture" name="picture">
				          <input type="hidden" name="picture1" value="<?php echo $acts['picture']; ?>"><!--預防沒選picture送出空資料-->
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="content" class="control-label">內容</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="content" name="content"><?php echo $acts['content']; ?></textarea>
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
                    <input type="hidden" name="actID" value="<?php echo $acts['actID']; ?>">
                    <input type="hidden" name="updatedDate" value="<?php echo date('Y-m-d H:i:s') ?>">
                    <button type="submit" class="btn btn-warning">送出更新</button>
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
