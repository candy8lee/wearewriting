<!DOCTYPE html>
<?php
require_once("../template/login_check.php");
require_once("../../asset/connection/database.php");
$sth = $db->query("SELECT * FROM q_a_category ");
$QAcate = $sth->fetchALL(PDO::FETCH_ASSOC);
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
          <h1 class="display-5" contenteditable="true">常見問題分類管理</h1>
          <a class="btn btn-warning my-2" href="add.php"><i class="fa fa-plus-square-o" aria-hidden="true"></i> 新增一筆</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-3" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item">
              <a href="list.php">主控台</a>
            </li>
            <li class="breadcrumb-item active">常見問題分類管理</li>
          </ul>
          <table class="table">
            <thead>
              <tr>
                <th width=60% style="text-align: center">分類名稱</th>
                <th>編輯</th>
                <th>刪除</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($QAcate as $row) { ?>
              <tr>
                <td style="text-align: center"><a href="../Q_A_reply/list.php?cateID=<?php echo $row['categoryID'] ?>"><?php echo $row['category']; ?></a></td>
                <td><a href="edit.php?cateID=<?php echo $row['categoryID']; ?>" class="btn btn-warning" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td><a href="delet.php?cateID=<?php echo $row['categoryID']; ?>" class="btn btn-danger" role="button" onclick="if(!confirm('刪除分類將會將此分類下所有資料一併清除，確認刪除？')){return false;};"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
