<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
$limit = 5;//wish item 筆數限制
if (isset($_GET["page"])) { $page_num  = $_GET["page"]; } else { $page_num=1; };//判斷網址上有沒有頁碼、沒有就預設第一頁
$start_from = ($page_num-1) * $limit;//wish item 從第幾筆開始//ex:(第二頁-1)*limit->[5]開始數五個出來//[0]開始
//判定有無subcategory
if(isset($_GET['subID']) && $_GET['subID'] != 0){
  $sql = "SELECT * FROM product WHERE subcategoryID =".$_GET['subID']." ORDER BY createdDate DESC LIMIT ".$start_from.",".$limit;// LIMIT num,num
  $sth = $db->query($sql);
  $product = $sth->fetchALL(PDO::FETCH_ASSOC);
}
else if(!(isset($_GET['subID'])) || $_GET['subID'] == 0){
  $sql = "SELECT * FROM product WHERE categoryID=".$_GET['cateID']." ORDER BY createdDate DESC LIMIT ".$start_from.",".$limit;// LIMIT num,num
  $sth = $db->query($sql);
  $product = $sth->fetchALL(PDO::FETCH_ASSOC);
}
$totalRows = count($product);


$sth = $db->query("SELECT * FROM product_subcategory WHERE categoryID=".$_GET['cateID']);
$subcategory = $sth->fetchALL(PDO::FETCH_ASSOC);

$sth = $db->query("SELECT category FROM product_category WHERE categoryID=".$_GET['cateID']);
$category = $sth->fetch(PDO::FETCH_ASSOC);

 ?>
<html>
<head>
<?php require_once('../template/header.php'); ?>
<title>商品管理-清單列表</title>
</head>

<body>
<?php require_once('../template/nav.php'); ?>
    <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-4 my-4" contenteditable="true">商品管理</h1>
          <a class="btn btn-warning my-2" href="add.php?cateID=<?php echo $_GET['cateID'] ?><?php if(isset($_GET['subID'])) echo "&subID=".$_GET['subID']; ?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> 新增商品</a>
          <?php if(isset($_GET['subID'])) {?>
          <a class="btn btn-warning my-2 float-right ml-3" href="../product_category/list.php">返回商品目錄</a>
            <a class="btn btn-warning my-2 float-right" href="list.php?cateID=<?php echo $_GET['cateID'] ?>">返回上一層目錄</a>
          <?php } else {?>
            <a class="btn btn-warning my-2 float-right" href="../product_category/list.php">返回商品目錄</a>
          <?php } ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-3" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item"><a href="../product_category/list.php">主控台</a></li>
            <li class="breadcrumb-item active">商品管理</li>
            <?php if(isset($_GET['subID'])){ ?>
			  <li class="breadcrumb-item"><a href="list.php?cateID=<?php echo $_GET['cateID']; ?>"><?php echo $category['category']; ?></a></li>
              <li class="breadcrumb-item active">
              <?php
                $sth = $db->query("SELECT subcategory FROM product_subcategory WHERE subcategoryID=".$_GET['subID']);
                $subcate = $sth->fetch(PDO::FETCH_ASSOC);
                echo $subcate['subcategory'];
              ?>
              </li>
            <?php }else{ ?>
			  <li class="breadcrumb-item active"><?php echo $category['category']; ?></li>
			<?php } ?>
          </ul>
		    </div>
	  </div>
    <div class="row">
      <div class="col-md-12 text-right my-3">
        Sort by:
        <?php foreach($subcategory as $row){ ?>
          <a href="list.php?cateID=<?php echo $_GET['cateID']; ?>&subID=<?php echo $row['subcategoryID']; ?>"><?php echo $row['subcategory']; ?>。</a>
        <?php } ?>
          <a href="../product_subcategory/add.php?cateID=<?php echo $_GET['cateID']; ?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i>子分類新增</a>
      </div>
    </div>
	  <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr class="text-center">
                <th width=30%>商品圖片</th>
                <th width=50%>商品</th>
                <th>編輯</th>
                <th>刪除</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($product as $row ) { ?>
              <tr class="text-center">
                <td><img src='../../upload/product/<?php echo $row['picture']; ?>' width="100%"></img></td>
                <td><?php echo $row['name']; ?></td>
                <td><a href="edit.php?productID=<?php echo $row['productID']; ?>&page=<?php echo $page_num; ?>&cateID=<?php echo $row['categoryID']; ?>" class="btn btn-warning" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                <td><a href="delet.php?productID=<?php echo $row['productID']; ?>&cateID=<?php echo $_GET['cateID'] ?><?php if(isset($_GET['subID'])) echo "&subID=".$_GET['subID']; ?>" class="btn btn-warning" role="button" onclick="if(!confirm('是否要刪除此筆商品資料？')){return false;};"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
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
            if(isset($_GET['subID'])){
                $sth = $db->query("SELECT * FROM product WHERE subcategoryID =".$_GET['subID']." ORDER BY createdDate DESC");
                $data_count = count($sth->fetchAll(PDO::FETCH_ASSOC));
                $totalpages = ceil($data_count / $limit );//四捨五入
            }else{
                $sth = $db->query("SELECT * FROM product WHERE categoryID=".$_GET['cateID']." ORDER BY createdDate DESC");
                $data_count = count($sth->fetchAll(PDO::FETCH_ASSOC));
                $totalpages = ceil($data_count / $limit );//四捨五入
            }
          ?>
          <ul class="pagination float-right">
            <?php if(isset($_GET['subID']) && $_GET['subID'] != 0){
                        include_once("../template/page_num_subID.php");
                  }else include_once("../template/page_num_cate.php"); ?>
          </ul>
        <?php }//if totalRows > 0 ?>
        </div>
      </div>
  </div>
</body>

</html>
