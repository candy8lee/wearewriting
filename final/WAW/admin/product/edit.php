<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){


  //上傳picture，為了分辨四張圖用日期的重新命名，再加一亂數$random，要確定亂數不重複
  $random = array();
  while ( count($random) < count($_FILES['picture']['name'])){
    $random[] = rand( 11, 99);
    $random = array_unique($random); //刪除陣列中重複的數字
  }
for($i =0; $i < count($_FILES['picture']['name']); $i++){
  if(isset($_FILES['picture']['name'][$i]) && $_FILES['picture']['name'][$i] != null){
    if (!file_exists('../../upload/product')) mkdir('../../upload/product', 0755, true);
    $fileTYPE = strrchr($_FILES['picture']['name'][$i],".");//查找字串，遇到"."停止->分割副檔名
    $filename[$i] = $_POST['categoryID']."_".date('YmdHis')."_".$random[$i].$fileTYPE;
    move_uploaded_file($_FILES['picture']['tmp_name'][$i] , "../../upload/product/".$filename[$i]);   // 搬移上傳檔案
  }else {
    $filename[$i] = $_POST['picture1'][$i];
  }
}
  $sql= "UPDATE product SET
                            categoryID= :categoryID,
                            subcategoryID= :subcategoryID,
                            brandID= :brandID,
                            name= :name,
                            picture= :picture0,
                            picture2= :picture1,
                            picture3= :picture2,
                            picture4= :picture3,
                            price= :price,
                            decription= :decription,
                            updatedDate= :updatedDate,
                            store= :store,
                            author= :author
                            WHERE productID= :productID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":categoryID", $_POST['categoryID'], PDO::PARAM_INT);
  $sth ->bindParam(":subcategoryID", $_POST['subcategoryID'], PDO::PARAM_INT);
  $sth ->bindParam(":brandID", $_POST['brandID'], PDO::PARAM_INT);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":picture0", $filename[0], PDO::PARAM_STR);
  $sth ->bindParam(":picture1", $filename[1], PDO::PARAM_STR);
  $sth ->bindParam(":picture2", $filename[2], PDO::PARAM_STR);
  $sth ->bindParam(":picture3", $filename[3], PDO::PARAM_STR);
  $sth ->bindParam(":price", $_POST['price'], PDO::PARAM_INT);
  $sth ->bindParam(":decription", $_POST['decription'], PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":store", $_POST['store'], PDO::PARAM_INT);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth ->bindParam(":productID", $_POST['productID'], PDO::PARAM_STR);
  $sth -> execute();
  if($_POST['subcategoryID'] != 'null') header('Location: list.php?cateID='.$_POST['cateID'].'&subID='.$_POST['subcategoryID']);
  else header('Location: list.php?cateID='.$_POST['cateID']);
}

//product
$sth = $db->query("SELECT * FROM product WHERE productID=".$_GET['productID']);
$product = $sth->fetch(PDO::FETCH_ASSOC);

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
<script>
$( function() {
  $( "#accordion" ).accordion({
    collapsible: true,
    active:false
  });
} );
</script>
</head>

<body>
  <?php include_once("../template/nav.php"); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5" contenteditable="true">商品管理-編輯</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <ul class="breadcrumb my-3" style="margin-bottom:0px;margin-top:0px">
          <li class="breadcrumb-item"><a href="list.php?cateID=<?php echo $_GET['cateID'] ?><?php if(isset($_GET['subID'])) echo "&subID=".$_GET['subID']; ?>">主控台</a></li>
          <li class="breadcrumb-item">商品管理-編輯</li>
          <li class="breadcrumb-item active"><?php echo $product['name']; ?></li>
        </ul>
        <div class="col-md-12">
          <form class="" method="post" action="edit.php"  data-toggle="validator" enctype="multipart/form-data">
            <div class="form-group my-5">
              <div class="row">
                <div class="col-sm-12">
                  <label for="brandID" class="control-label">品牌：</label>
        					<select name="brandID" style="width: 200px;">
        					<?php foreach($brand as $row){ ?>
        						<option value="<?php echo $row['brandID']; ?>" <?php if ($product['brandID'] == $row['brandID']) echo "selected"; ?>><?php echo $row['name']; ?></option>
        					<?php } ?>
        					</select>
                  <label for="categoryID" class="control-label">&nbsp>&nbsp商品分類：</label>
        					<select name="categoryID" style="width: 100px;">
        					<?php foreach($product_category as $row){ ?>
        						<option value="<?php echo $row['categoryID']; ?>" <?php if($row['categoryID'] == $product['categoryID']) echo "selected" ?>><?php echo $row['category']; ?></option>
        					<?php } ?>
        					</select>
                  <label for="subcategoryID" class="control-label">&nbsp>&nbsp子分類：</label>
        					<select name="subcategoryID" style="width: 100px;">
                    <option>無</option>
                  <?php //用product_category把subcategory排列，且判斷此分類下是否有子分類，若無則不用顯示optgroup
                        foreach ( $product_category as $key=> $group) {
                          $sth = $db->query("SELECT * FROM product_subcategory WHERE categoryID=".$group['categoryID']);
                          $opt = $sth->fetchALL(PDO::FETCH_ASSOC);
                          if(isset($opt[0])){
                          ?>
                              <optgroup label="<?php echo $group['category']; ?>">
                  					<?php foreach($opt as $row){ ?>
                  						<option value="<?php echo $row['subcategoryID']; ?>" <?php if($row['subcategoryID'] == $product['subcategoryID']) echo "selected" ?>><?php echo $row['subcategory']; ?></option>
                  					<?php } ?>
                    <?php } ?>
                  <?php } ?>
        					</select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12 my-3 text-center">
                  <img src="../../upload/product/<?php echo $product['picture'] ?>" width="300px">
                  <?php for($i =2; $i <4; $i++){
                          if(isset($product['picture'.$i])){?>
                            <img src="../../upload/product/<?php echo $product['picture'.$i] ?>" width="150px" class="align-bottom mx-3">
                          <?php } ?>
                  <?php } ?>
                </div>
                <div class="col-sm-12 text-right">
                  <p>*圖片說明：商品圖片一會是產品列表的主要圖片；二 - 四是輔助圖片，可選擇上傳</p>
                  <p>*上傳順序會與圖片排列相關。</p>
                </div>
                <div class="col-sm-2 my-3 text-right">
                  <label for="picture" class="control-label">商品圖片一</label>
                </div>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="picture" name="picture[]">
                </div>
                <div id="accordion" class="col-sm-12 text-right my-5">
                  <h3>上傳更多商品圖片</h3>
                  <div class="row">
                  <?php $arr=["二", "三", "四"];
                    for($i =0; $i <3; $i++){?>
                    <div class="col-sm-2 my-3 text-right">
                      <label for="picture" class="control-label">商品圖片<?php echo $arr[$i]; ?></label>
                    </div>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="picture" name="picture[]">
                    </div>
					        <?php } ?>
                  </div>
                </div>
                <div>
                  <input type="hidden" name="picture1[]" value="<?php echo $product['picture'] ?>">
                  <input type="hidden" name="picture1[]" value="<?php echo $product['picture2'] ?>">
                  <input type="hidden" name="picture1[]" value="<?php echo $product['picture3'] ?>">
                  <input type="hidden" name="picture1[]" value="<?php echo $product['picture4'] ?>">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2 text-right text-right">
                  <label for="name" class="control-label">商品名稱</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" data-minlength="1" data-error="商品名稱至少一字元。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2 text-right text-right">
                  <label for="price" class="control-label">價格</label>
                </div>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" data-error="請填寫價格。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2  text-right">
                  <label class="control-label">保存期限</label>
                </div>
                <div class="col-sm-10">
                  <label class="control-label">*墨水無開封可永久保存，書寫用具使用得當無損毀也可永久保存。</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2  text-right">
                  <label for="decription" class="control-label">描述</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="decription" name="decription" data-error="請描述商品細節。" required><?php echo $product['decription']; ?></textarea>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2 text-right">
                  <label for="store" class="control-label">進貨數量</label>
                </div>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="store" name="store" value="<?php echo $product['store']; ?>" data-minlength="1" data-error="若尚無庫存請填寫0。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2 text-right text-right">
                  <a class="btn btn-warning float-left" href="list.php?cateID=<?php echo $_GET['cateID']; ?><?php if(isset($_GET['subID'])) echo "&subID=".$_GET['subID']; ?>" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="MM_update" value="UPDATE">
                  <input type="hidden" name="productID" value="<?php echo $_GET['productID']; ?>">
                  <input type="hidden" name="author" value="<?php echo $_SESSION['account'] ?>">
                  <input type="hidden" name="cateID" value="<?php echo $_GET['cateID']; ?>">
                  <input type="hidden" name="updatedDate" value="<?php echo date('y-m-d H:i:s') ?>">
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
