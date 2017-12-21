<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
$limit = 5;//wish item 筆數限制
if (isset($_GET["page"])) { $page_num  = $_GET["page"]; } else { $page_num=1; };//判斷網址上有沒有頁碼、沒有就預設第一頁
$start_from = ($page_num-1) * $limit;//wish item 從第幾筆開始//ex:(第二頁-1)*limit->[5]開始數五個出來//[0]開始
//判定有無sort
if(isset($_GET['status'])){
  $sql = "SELECT * FROM makeawish WHERE status =".$_GET['status']." ORDER BY createdDate DESC LIMIT ".$start_from.",".$limit;// LIMIT num,num
  $sth = $db->query($sql);
  $wish = $sth->fetchALL(PDO::FETCH_ASSOC);
}
else{
  $sql = "SELECT * FROM makeawish ORDER BY createdDate DESC LIMIT ".$start_from.",".$limit;// LIMIT num,num
  $sth = $db->query($sql);
  $wish = $sth->fetchALL(PDO::FETCH_ASSOC);
}
$totalRows = count($wish);
 ?>
<html>
<head>
<?php require_once('../template/header.php'); ?>
<title>許願池-清單列表</title>
</head>

<body>
<?php require_once('../template/nav.php'); ?>
    <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4 my-4" contenteditable="true">許願池管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-3" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item active">許願池管理</li>
          </ul>
		    </div>
	  </div>
    <div class="row">
        <div class="col-md-12 text-right my-3">
          Sort by:&nbsp&nbsp
            <a href="list.php">全部顯示。</a>
            <a href="list.php?status=0">新願望。</a>
            <a href="list.php?status=1">處理中。</a>
            <a href="list.php?status=2">核定中。</a>
            <a href="list.php?status=3">完成。</a>
            <a href="list.php?status=80">評估中。</a>
            <a href="list.php?status=99">流標。</a>
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
                <th width=15%>願望</th>
                <th width=40%>內容</th>
                <th width=10%>會員</th>
                <th>編輯</th>
                <th>刪除</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($wish as $row ) { ?>
              <tr>
                <td class="text-center"><?php echo $row['createdDate']; ?></td>
                <td class="text-center"><?php echo $row['title']; ?></td>
				        <td><?php echo $row['content']; ?></td>
                <td class="text-center"><a href="#"><?php echo $row['author']; ?></a></td>
                <td class="text-center"><a href="edit.php?wishID=<?php echo $row['wishID']; ?>" class="btn btn-warning" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td class="text-center"><a href="delet.php?wishID=<?php echo $row['wishID']; ?>" class="btn btn-warning" role="button" onclick="if(!confirm('真的要刪除此願望？')){return false;};"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
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
                $sth = $db->query("SELECT * FROM makeawish WHERE status =".$_GET['status']." ORDER BY createdDate DESC");
                $data_count = count($sth->fetchAll(PDO::FETCH_ASSOC));
                $totalpages = ceil($data_count / $limit );//四捨五入
            }else{
                $sth = $db->query("SELECT * FROM makeawish ORDER BY createdDate DESC");
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
