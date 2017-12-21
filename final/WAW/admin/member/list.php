<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
$limit = 25;//member item 筆數限制
if (isset($_GET["page"])) { $page_num  = $_GET["page"]; } else { $page_num=1; };//判斷網址上有沒有頁碼、沒有就預設第一頁
$start_from = ($page_num-1) * $limit;//member item 從第幾筆開始//ex:(第二頁-1)*limit->[5]開始數五個出來//[0]開始
$sql = "SELECT * FROM member ORDER BY createdDate DESC LIMIT ".$start_from.",".$limit;// LIMIT num,num
$sth = $db->query($sql);
$member = $sth->fetchALL(PDO::FETCH_ASSOC);
$totalRows = count($member);
 ?>
<html>
<head>
<?php require_once('../template/header.php'); ?>
<title>會員管理-清單列表</title>
</head>

<body>
<?php require_once('../template/nav.php'); ?>
    <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4 my-4" contenteditable="true">會員管理</h1>
          <a class="btn btn-warning my-2" href="add.php"><i class="fa fa-plus-square-o" aria-hidden="true"></i> 新增會員</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item active">會員管理</li>
          </ul>
		</div>
	  </div>
	  <div class="row">
        <div class="col-md-12">
          <table class="table text-center">
            <thead>
              <tr>
                <th>帳號</th>
                <th>電子信箱</th>
				        <th>會員名稱</th>
                <th width=10%>編輯</th>
                <th width=10%>刪除</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($member as $row ) { ?>
              <tr>
                <td style="text-align:center;"><?php echo $row['account']; ?></td>
                <td style="text-align:center;"><?php echo $row['email']; ?></td>
        				<td><?php echo $row['name']; ?></td>
                <td><a href="edit.php?memberID=<?php echo $row['memberID']; ?>&page=<?php echo $page_num; ?>" class="btn btn-warning" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td><a href="delet.php?memberID=<?php echo $row['memberID']; ?>&page=<?php echo $page_num; ?>" class="btn btn-warning" role="button" onclick="if(!confirm('是否刪除此會員資料？')){return false;};"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php
            if($totalRows > 0){
              $sth = $db->query("SELECT * FROM member ORDER BY createdDate DESC");
              $data_count = count($sth->fetchAll(PDO::FETCH_ASSOC));
              $totalpages = ceil($data_count / $limit );//四捨五入
          ?>
          <ul class="pagination float-right">
            <?php include_once("../template/page_num.php"); ?>
          </ul>
        <?php }//if totalRows > 0 ?>
        </div>
      </div>
  </div>
</body>

</html>
