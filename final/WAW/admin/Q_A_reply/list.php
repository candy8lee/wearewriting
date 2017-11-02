<!DOCTYPE html>
<?php
require_once("../template/login_check.php");
require_once("../../asset/connection/database.php");
$sth = $db->query("SELECT * FROM q_a_reply WHERE categoryID=".$_GET['cateID']);
$QAreply = $sth->fetchALL(PDO::FETCH_ASSOC);
//for category name
$sth = $db->query("SELECT * FROM q_a_category WHERE categoryID=".$_GET['cateID']);
$QAcate = $sth->fetch(PDO::FETCH_ASSOC);
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
          <h1 class="display-5" contenteditable="true">常見問題管理-<?php echo $QAcate['category']; ?></h1>
          <a class="btn btn-warning my-2" href="add.php?cateID=<?php echo $_GET['cateID']; ?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> 新增一筆</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-3" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item"><a href="../Q_A_category/list.php">主控台</a></li>
            <li class="breadcrumb-item active">常見問題管理-<?php echo $QAcate['category']; ?></li>
          </ul>
          <table class="table">
            <thead>
              <tr>
                <th width=20% style="text-align: center">標題</th>
				<th width=40% style="text-align: center">內文</th>
                <th>編輯</th>
                <th>刪除</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($QAreply as $row) { ?>
              <tr>
                <td style="text-align: center"><?php echo $row['title']; ?></td>
				<td><?php echo $row['reply']; ?></td>
                <td><a href="edit.php?cateID=<?php echo $row['categoryID']; ?>&replyID=<?php echo $row['replyID']; ?>" class="btn btn-warning" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td><a href="delet.php?cateID=<?php echo $row['categoryID']; ?>&replyID=<?php echo $row['replyID']; ?>" class="btn btn-warning" role="button" onclick="if(!confirm('是否刪除此筆資料？')){return false;};"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
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
