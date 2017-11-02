<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == 'INSERT'){
  //上傳picture
for($i =0; $i <4; $i++){
  if(isset($_FILES['picture']['name'][$i]) && $_FILES['picture']['name'][$i] != null){
    if (!file_exists('../../upload/product')) mkdir('../../upload/product', 0755, true);
    $fileTYPE = strrchr($_FILES['picture']['name'][$i],".");//查找字串，遇到"."停止->分割副檔名
    $filename[$i] = $_POST['categoryID']."_".date('YmdHis').$fileTYPE;
    move_uploaded_file($_FILES['picture']['tmp_name'][$i] , "../../upload/product/".$filename[$i]);   // 搬移上傳檔案
  }
}

  $sql= "INSERT INTO product( categoryID, subcategoryID, brandID, name, picture, picture2, picture3, picture4, price, nib, decription, createdDate, store, author)
                VALUES ( :categoryID, :subcategoryID, :brandID, :name, :picture[0], :picture[1], :picture[2], :picture[3], :price, :nib, :decription, :createdDate, :store, :author)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":categoryID", $_POST['categoryID'], PDO::PARAM_STR);
  $sth ->bindParam(":subcategoryID", $_POST['subcategoryID'], PDO::PARAM_STR);
  $sth ->bindParam(":brandID", $_POST['brandID'], PDO::PARAM_STR);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":picture[0]", $filename[0], PDO::PARAM_STR);
  $sth ->bindParam(":picture[1]", $filename[1], PDO::PARAM_STR);
  $sth ->bindParam(":picture[2]", $filename[2], PDO::PARAM_STR);
  $sth ->bindParam(":picture[3]", $filename[3], PDO::PARAM_STR);
  $sth ->bindParam(":price", $_POST['price'], PDO::PARAM_STR);
  $sth ->bindParam(":nib", $_POST['nib'], PDO::PARAM_STR);
  $sth ->bindParam(":decription", $_POST['decription'], PDO::PARAM_STR);
  $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
  $sth ->bindParam(":store", $_POST['store'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth -> execute();

  echo $filename[0];

  header('Location: list.php?cateID='.$_POST['cateID']);
}

//brandID
$sth = $db->query("SELECT * FROM brand");
$brand = $sth->fetchALL(PDO::FETCH_ASSOC);

//product_category
$sth = $db->query("SELECT * FROM product_category");
$product_category = $sth->fetchALL(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
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
          <h1 class="display-5" contenteditable="true">商品管理-新增</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <ul class="breadcrumb my-3" style="margin-bottom:0px;margin-top:0px">
          <li class="breadcrumb-item">
            <a href="list.php">主控台</a>
          </li>
          <li class="breadcrumb-item active">商品管理-新增</li>
        </ul>
        <div class="col-md-12">
          <form class="" method="post" action="add.php"  data-toggle="validator" enctype="multipart/form-data">
            <div class="form-group my-5">
                <div class="col-sm-12">
                  <label for="brandID" class="control-label">品牌：</label>
        					<select name="brandID" style="width: 200px;">
        					<?php foreach($brand as $row){ ?>
        						<option value="<?php echo $row['brnadID']; ?>"><?php echo $row['name']; ?></option>
        					<?php } ?>
        					</select>
                  <label for="categoryID" class="control-label">&nbsp>&nbsp商品分類：</label>
        					<select name="categoryID" style="width: 100px;">
        					<?php foreach($product_category as $row){ ?>
        						<option value="<?php echo $row['categoryID']; ?>"><?php echo $row['category']; ?></option>
        					<?php } ?>
        					</select>
                  <label for="subcategoryID" class="control-label">&nbsp>&nbsp子分類：</label>
        					<select name="subcategoryID" style="width: 100px;">
                    <option value="null">無</option>
                  <?php //用product_category把subcategory排列，且判斷此分類下是否有子分類，若無則不用顯示optgroup
                        foreach ( $product_category  as $key=> $group) {
                          $sth = $db->query("SELECT * FROM product_subcategory WHERE categoryID=".$group['categoryID']);
                          $opt = $sth->fetchALL(PDO::FETCH_ASSOC);
                          if(isset($opt[0])){
                          ?>
                              <optgroup label="<?php echo $group['category']; ?>">
                  					<?php foreach($opt as $row){ ?>
                  						<option value="<?php echo $row['subcategoryID']; ?>"><?php echo $row['subcategory']; ?></option>
                  					<?php } ?>
                    <?php } ?>
                  <?php } ?>
        					</select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="picture" class="control-label">商品圖片：</label>
                </div>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="picture" name="picture[]">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="picture" class="control-label">商品圖片：</label>
                </div>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="picture" name="picture[]">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="picture" class="control-label">商品圖片：</label>
                </div>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="picture" name="picture[]">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="picture" class="control-label">商品圖片：</label>
                </div>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="picture" name="picture[]">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="name" class="control-label">商品名稱</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" data-minlength="1" data-error="商品名稱至少一字元。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="price" class="control-label">價格</label>
                </div>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="price" name="price" data-error="請填寫價格。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="nib" class="control-label">筆尖 / 鉛筆顏色濃度</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nib" name="nib">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label class="control-label">保存期限</label>
                </div>
                <div class="col-sm-10">
                  <label class="control-label">墨水無開封可永久保存，書寫用具使用得當無損毀也可永久保存。</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="decription" class="control-label">描述</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="decription" name="decription" data-error="請描述商品細節。" required></textarea>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="store" class="control-label">進貨數量</label>
                </div>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="store" name="store" data-minlength="1" data-error="若尚無進貨請填寫0。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
            </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="MM_insert" value="INSERT">
                  <input type="hidden" name="author" value="<?php echo $_SESSION['account'] ?>">
                  <input type="hidden" name="cateID" value="<?php echo $_GET['cateID']; ?>">
                  <input type="hidden" name="subID" value="<?php echo $_GET['subID']; ?>">
                  <input type="hidden" name="createdDate" value="<?php echo date('y-m-d H:i:s') ?>">
                  <a class="btn btn-warning float-left" href="list.php" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                  <button type="submit" class="btn btn-warning">送出</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
