<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
$limit = 25;//wish item 筆數限制
if (isset($_GET["page"])) { $page_num  = $_GET["page"]; } else { $page_num=1; };//判斷網址上有沒有頁碼、沒有就預設第一頁
$start_from = ($page_num-1) * $limit;//wish item 從第幾筆開始//ex:(第二頁-1)*limit->[5]開始數五個出來//[0]開始
//判定有無sort
$sql = "SELECT * FROM boards ORDER BY createdDate DESC LIMIT ".$start_from.",".$limit;// LIMIT num,num
$sth = $db->query($sql);
$boards = $sth->fetchALL(PDO::FETCH_ASSOC);
$totalRows = count($boards);
 ?>
<html>
<head>
<?php require_once('../template/header.php'); ?>
</head>

<body>
<?php require_once('../template/nav.php'); ?>
    <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4 my-4" contenteditable="true">留言板管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-3" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item active">留言板管理</li>
          </ul>
		</div>
	  </div>
	  <div class="row">
        <div class="col-md-12">
          <table class="table text-center">
            <thead>
              <tr>
                <th width=15%>時間</th>
                <th width=20%>標題</th>
                <th width=40%>內容</th>
                <th width=15%>會員</th>
                <th width=10%>刪除</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($boards as $row ) { ?>
              <tr>
                <td><?php echo $row['createdDate']; ?></td>
                <td><?php echo $row['title']; ?></td>
				        <td><?php echo $row['content']; ?></td>
                <?php
                  $sth = $db->query("SELECT account FROM member WHERE memberID=".$row['memberID']);
                  $member = $sth->fetch(PDO::FETCH_ASSOC);
                 ?>
                <td ><?php echo $member['account']; ?></td>
                <td><a href="delet.php?boardsID=<?php echo $row['boardsID']; ?>" class="btn btn-warning" role="button" onclick="if(!confirm('是否確定要刪除此串留言與回覆？')){return false;};"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
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
                $sth = $db->query("SELECT * FROM boards ORDER BY createdDate DESC");
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
