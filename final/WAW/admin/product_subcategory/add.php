<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == 'INSERT'){
  //上傳picture
  if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != null){
    if (!file_exists('../../upload/product_subcategory')) mkdir('../../upload/product_subcategory', 0755, true);
    $fileTYPE = strrchr($_FILES['picture']['name'],".");//查找字串，遇到"."停止->分割副檔名
    $filename = $_POST['subcategoryID']."_".date('YmdHis').$fileTYPE;
    move_uploaded_file($_FILES['picture']['tmp_name'] , "../../upload/product_subcategory/".$filename);   // 搬移上傳檔案
  }

  $sql= "INSERT INTO product_subcategory( categoryID, subcategory, picture, createdDate, author)
                VALUES (  :categoryID, :subcategory, :picture, :createdDate, :author)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":categoryID", $_POST['categoryID'], PDO::PARAM_INT);
  $sth ->bindParam(":subcategory", $_POST['subcategory'], PDO::PARAM_STR);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth -> execute();

  header('Location: list.php');
}
$sth = $db->query("SELECT * FROM product_category");
$product_category = $sth->fetchALL(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
<?php require_once('../template/header.php'); ?>
<title>商品子分類管理-新增</title>
</head>

<body>
  <?php include_once("../template/nav.php"); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5" contenteditable="true">商品子分類管理-新增</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <ul class="breadcrumb my-3" style="margin-bottom:0px;margin-top:0px">
          <li class="breadcrumb-item">
            <a href="list.php">主控台</a>
          </li>
          <li class="breadcrumb-item active">商品子分類管理-新增</li>
        </ul>
        <div class="col-md-12">
          <form class="" method="post" action="add.php"  data-toggle="validator" enctype="multipart/form-data">
            <div class="form-group my-5 text-right">
              <div class="row">
                <div class="col-sm-12">
                  <label for="categoryID" class="control-label">分類名稱：</label>
                  <select name="categoryID" style="width:200px;">
                  <?php foreach ($product_category as $row) {?>
                    <option value="<?php echo $row['categoryID']; ?>"><?php echo $row['category']; ?></option>
                  <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                  <div class="col-sm-2">
                    <label for="picture" class="control-label">子分類圖片：</label>
                  </div>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="picture" name="picture">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-2">
                    <label for="subcategory" class="control-label">子分類名稱</label>
                  </div>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="subcategory" name="subcategory" data-minlength="1" data-error="分類名稱至少一字元" required>
                    <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-2">
                    <?php if(isset($_GET['cateID'])){ ?>
                      <a class="btn btn-warning float-left" href="../product/list.php?cateID=<?php echo $_GET['cateID']; ?>" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                    <?php }else{ ?>
                      <a class="btn btn-warning float-left" href="list.php" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                    <?php } ?>
                  </div>
                  <div class="col-sm-10 text-right">
                    <input type="hidden" name="MM_insert" value="INSERT">
                    <input type="hidden" name="author" value="<?php echo $_SESSION['account'] ?>">
                    <input type="hidden" name="createdDate" value="<?php echo date('Y-m-d H:i:s') ?>">
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
