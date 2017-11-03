<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
$limit = 25;//question item 筆數限制
if (isset($_GET["page"])) { $page_num  = $_GET["page"]; } else { $page_num=1; };//判斷網址上有沒有頁碼、沒有就預設第一頁
$start_from = ($page_num-1) * $limit;//question item 從第幾筆開始//ex:(第二頁-1)*limit->[5]開始數五個出來//[0]開始
//判定有無sort
if(isset($_GET['status'])){
  $sql = "SELECT * FROM member_question WHERE status =".$_GET['status']." ORDER BY createdDate DESC LIMIT ".$start_from.",".$limit;// LIMIT num,num
  $sth = $db->query($sql);
  $question = $sth->fetchALL(PDO::FETCH_ASSOC);
}
else{
  $sql = "SELECT * FROM member_question ORDER BY createdDate DESC LIMIT ".$start_from.",".$limit;// LIMIT num,num
  $sth = $db->query($sql);
  $question = $sth->fetchALL(PDO::FETCH_ASSOC);
}
$totalRows = count($question);
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
          <h1 class="display-4 my-4" contenteditable="true">會員客服管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-3" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item active">會員客服管理</li>
          </ul>
		</div>
	  </div>
    <div class="row">
        <div class="col-md-12 text-right my-3">
          Sort by:&nbsp&nbsp
            <a href="list.php">全部顯示。</a>
            <a href="list.php?status=0">新提問。</a>
            <a href="list.php?status=1">已回覆。</a>
            <a href="list.php?status=99">已取消。</a>

        <!--
        <select name="">
          <option>全部顯示</option>
          <option value="0">新願望</option>
          <option value="1">處理中</option>
          <option value="2">核定中</option>
          <option value="3">完成</option>
          <option value="80">評估中</option>
          <option value="99">流標</option>
        </select>
        -->
        </div>
    </div>
	  <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr class="text-center">
                <th width=15%>時間</th>
                <th width=10%>會員</th>
                <th width=15%>問題</th>
                <th width=40%>內容</th>
                <th width=10%>狀態</th>
                <th width=10%>回覆</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($question as $row ) { ?>
              <tr class="text-center">
                <td><?php echo $row['createdDate']; ?></td>
                <?php
                  $sth = $db->query("SELECT account FROM member WHERE memberID=".$row['memberID']);
                  $member = $sth->fetch(PDO::FETCH_ASSOC);
                 ?>
                <td><?php echo $member['account']; ?></td>
                <td><?php echo $row['title']; ?></td>
				        <td><?php echo $row['content']; ?></td>
                <td>
                <?php
                  switch ($row['status']) {
                    case '0':
                      echo "新提問";
                      break;
                    case '1':
                      echo "已回覆";
                      break;
                    case '99':
                      echo "已取消";
                      break;
                  }
                 ?>
                </td>
                <td><a href="reply.php?questionID=<?php echo $row['questionID']; ?>&status=<?php echo $row['status']; ?>&page=<?php echo $page_num; ?>" class="btn btn-warning" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
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
            if(isset($_GET['status'])){
                $sth = $db->query("SELECT * FROM member_question WHERE status =".$_GET['status']." ORDER BY createdDate DESC");
                $data_count = count($sth->fetchAll(PDO::FETCH_ASSOC));
                $totalpages = ceil($data_count / $limit );//四捨五入
            }else{
                $sth = $db->query("SELECT * FROM member_question ORDER BY createdDate DESC");
                $data_count = count($sth->fetchAll(PDO::FETCH_ASSOC));
                $totalpages = ceil($data_count / $limit );//四捨五入
            }
          ?>
          <ul class="pagination float-right">
            <?php if(isset($_GET['status'])){
                        include_once("../template/page_num_status.php");
                  }else include_once("../template/page_num.php"); ?>
          </ul>
        <?php }//if totalRows > 0 ?>
        </div>
      </div>
  </div>
</body>

</html>
