<?php
require_once("../template/login_check.php");
require_once("../../asset/connection/database.php");
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){
  $sql= "UPDATE  makeawish SET
						            status= :status,
                        updatedDate= :updatedDate,
						            author= :author
                        WHERE wishID= :wishID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":status", $_POST['status'], PDO::PARAM_INT);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth ->bindParam(":wishID", $_POST['wishID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php?status='.$_POST['status']);
}

$sth = $db->query("SELECT * FROM makeawish WHERE wishID=".$_GET['wishID']);
$wish = $sth->fetch(PDO::FETCH_ASSOC);
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
          <h1 class="display-5" contenteditable="true">許願池管理-<?php echo $wish['title']; ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5">
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item">許願池管理-編輯</li>
			      <li class="breadcrumb-item active">
              <?php switch ($wish['status']) {
                case 0:
                  echo "新願望";
                  break;
                case 1:
                  echo "處理中";
                  break;
                case 2:
                  echo "核定中";
                  break;
                case 3:
                  echo "完成";
                  break;
                case 80:
                  echo "評估中";
                  break;
                case 99:
                  echo "流標";
                  break;
              } ?>
              -<?php echo $wish['title']; ?>
            </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="edit.php"  data-toggle="validator">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12 text-right">
                  <label for="status" class="control-label">狀態：</label>
                  <select name="status" style="width:200px;">
                    <option value="0" <?php if ($wish['status'] == 0) echo "selected" ?>>新願望</option>
                    <option value="1" <?php if ($wish['status'] == 1) echo "selected" ?>>處理中</option>
                    <option value="2" <?php if ($wish['status'] == 2) echo "selected" ?>>核定中</option>
                    <option value="3" <?php if ($wish['status'] == 3) echo "selected" ?>>完成</option>
                    <option value="80" <?php if ($wish['status'] == 80) echo "selected" ?>>評估中</option>
                    <option value="99" <?php if ($wish['status'] == 99) echo "selected" ?>>流標</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2 text-right">
                  <label for="title" class="control-label">願望：</label>
                </div>
                <div class="col-sm-10">
                  <label for="title" class="control-label"><?php echo $wish['title']; ?></label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2 text-right">
                  <label for="content" class="control-label">內容：</label>
                </div>
                <div class="col-sm-10">
                  <label for="content" class="control-label"><?php echo $wish['content']; ?></label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <a class="btn btn-warning float-left" href="list.php?status=<?php echo $_GET['status']; ?>" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                </div>
                <div class="col-sm-10 text-right">
                  <input type="hidden" name="MM_update" value="UPDATE">
                  <input type="hidden" name="wishID" value="<?php echo $wish['wishID']; ?>">
                  <input type="hidden" name="updatedDate" value="<?php echo date('Y-m-d H:i:s') ?>">
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
