<?php
require_once("../template/login_check.php");
require_once("../../asset/connection/database.php");
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){
  //上傳picture
  if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != null){
    if (!file_exists('../../upload/product_subcategory')) mkdir('../../upload/product_subcategory', 0755, true);
    $fileTYPE = strrchr($_FILES['picture']['name'],".");//查找字串，遇到"."停止->分割副檔名
    $filename = $_POST['subcategoryID']."_".date('YmdHis').$fileTYPE;
    move_uploaded_file($_FILES['picture']['tmp_name'] , "../../upload/product_subcategory/".$filename);   // 搬移上傳檔案
    $picture1 = "../../upload/product_subcategory/".$_POST['picture1'];
    unlink($picture1);//刪除之前上傳的picture
  }else{
    $filename = $_POST['picture1'];
  }

  $sql= "UPDATE product_subcategory SET
                                    categoryID= :categoryID,
                                    subcategory= :subcategory,
                                    picture= :picture,
                                    updatedDate= :updatedDate,
                                    author= :author
                                    WHERE subcategoryID= :subcategoryID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":categoryID", $_POST['categoryID'], PDO::PARAM_INT);
  $sth ->bindParam(":subcategoryID", $_POST['subcategoryID'], PDO::PARAM_INT);
  $sth ->bindParam(":subcategory", $_POST['subcategory'], PDO::PARAM_STR);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth -> execute();

  header('Location: list.php');
}
$sql = "SELECT * FROM product_subcategory WHERE subcategoryID=".$_GET['subID'];
$sth = $db->query($sql);
$product_subcategory = $sth->fetch(PDO::FETCH_ASSOC);

$sth = $db->query("SELECT * FROM product_category");
$product_category = $sth->fetchALL(PDO::FETCH_ASSOC);
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
          <h1 class="display-5" contenteditable="true">子分類管理-編輯</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
		  <ul class="breadcrumb my-5" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item">
              <a href="list.php">主控台</a>
            </li>
            <li class="breadcrumb-item active">子分類管理-<?php echo $product_subcategory['subcategory']; ?></li>
          </ul>
            <form class="" method="post" action="edit.php"  data-toggle="validator" enctype="multipart/form-data">
              <div class="form-group my-5">
                  <div class="col-sm-12">
                    <label for="categoryID" class="control-label">分類名稱：</label>
                    <select name="categoryID" style="width:200px;">
                    <?php foreach ($product_category as $row) {?>
                      <option value="<?php echo $row['categoryID']; ?>" <?php if($product_subcategory['categoryID'] == $row['categoryID']) echo "selected"; ?>><?php echo $row['category']; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <img src="../../upload/product_subcategory/<?php echo $product_subcategory['picture']; ?>" width="200px;" class="float-right"></img>
                    <div class="col-sm-2">
                      <label for="picture" class="control-label">子分類圖片：</label>
                    </div>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="picture" name="picture">
                      <input type="hidden" name="picture1" value="<?php echo $product_subcategory['picture']; ?>">
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-2">
                    <label for="subcategory" class="control-label">子分類名稱</label>
                  </div>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="subcategory" name="subcategory" value="<?php echo $product_subcategory['subcategory']; ?>" data-minlength="1" data-error="分類名稱至少一字元" required>
                    <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-10 col-sm-offset-2 text-right">
                    <input type="hidden" name="MM_update" value="UPDATE">
                    <input type="hidden" name="subcategoryID" value="<?php echo $product_subcategory['subcategoryID']; ?>">
                    <input type="hidden" name="author" value="<?php echo $_SESSION['account'] ?>">
                    <input type="hidden" name="updatedDate" value="<?php echo date('y-m-d H:i:s') ?>">
                    <a class="btn btn-warning float-left" href="list.php" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                    <button type="submit" class="btn btn-warning">送出</button>
                  </div>
              </div>
          </form>
        </div>
      </div>
   </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
  <script src="../../assets/js/validator.min.js"></script>
</body>

</html>
