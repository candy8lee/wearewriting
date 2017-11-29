<?php
require_once("../template/login_check.php");
require_once("../../asset/connection/database.php");
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){

  $sql= "UPDATE  specification SET
                                    brandID= :brandID,
                                    type= :type,
                                    bottle_material= :bottle_material,
                                    volume= :volume,
                                    updatedDate= :updatedDate,
                                    author= :author
                                    WHERE specID= :specID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":brandID", $_POST['brandID'], PDO::PARAM_STR);
  $sth ->bindParam(":type", $_POST['type'], PDO::PARAM_STR);
  $sth ->bindParam(":bottle_material", $_POST['bottle_material'], PDO::PARAM_STR);
  $sth ->bindParam(":volume", $_POST['volume'], PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth ->bindParam(":specID", $_POST['specID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php');
}
$sth = $db->query("SELECT * FROM specification WHERE specID=".$_GET['specID']);
$spec = $sth->fetch(PDO::FETCH_ASSOC);
$sth = $db->query("SELECT * FROM brand WHERE brandID=".$spec['brandID']);
$brand = $sth->fetch(PDO::FETCH_ASSOC);
 ?>

<html>

<head>
  <?php include_once("../template/header.php"); ?>
</head>
<body>
<?php require_once('../template/nav.php'); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5" contenteditable="true">規格表管理-<?php echo $brand['name']; ?>-<?php echo $spec['type']; ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item">
              <a href="list.php">主控台</a>
            </li>
            <li class="breadcrumb-item">規格表管理</li>
            <li class="breadcrumb-item active"><?php echo $brand['name']; ?>-<?php echo $spec['type']; ?></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="edit.php"  data-toggle="validator"  enctype="multipart/form-data">
            <div class="form-group text-right">
              <div class="row">
                <div class="col-sm-12">
                  <label for="brandID" class="control-label">品牌：</label>
                  <select name="brandID" style="width: 200px;">
                  <?php
                    $sth = $db->query("SELECT * FROM brand");
                    $brand = $sth->fetchALL(PDO::FETCH_ASSOC);
                    foreach($brand as $row){ ?>
                    <option value="<?php echo $row['brandID']; ?>" <?php if ($spec['brandID'] == $row['brandID']) echo "selected"; ?>><?php echo $row['name']; ?></option>
                  <?php } ?>
                  </select>
                  <label for="type" class="control-label">　子分類：</label>
        					<select name="type" style="width: 100px;">
                    <option>無</option>
                  <?php //用product_category把subcategory排列，且判斷此分類下是否有子分類，若無則不用顯示optgroup
                      $sth = $db->query("SELECT * FROM product_category");
                      $product_category = $sth->fetchALL(PDO::FETCH_ASSOC);
                        foreach ( $product_category  as $key=> $group) {
                          $sth = $db->query("SELECT * FROM product_subcategory WHERE categoryID=".$group['categoryID']);
                          $opt = $sth->fetchALL(PDO::FETCH_ASSOC);
                          if(isset($opt[0])){
                          ?>
                              <optgroup label="<?php echo $group['category']; ?>">
                  					<?php foreach($opt as $row){ ?>
                  						<option value="<?php echo $row['subcategory']; ?>" <?php if($row['subcategory'] == $spec['type']) echo "selected" ?>><?php echo $row['subcategory']; ?></option>
                  					<?php } ?>
                    <?php } ?>
                  <?php } ?>
        					</select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="bottle_material" class="control-label">瓶罐材質</label>
                </div>
                <div class="col-sm-5">
                  <input type="text" class="form-control date" id="bottle_material" name="bottle_material" data-error="請填寫材質。" value="<?php echo $spec['bottle_material']; ?>" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="volume" class="control-label">容量毫升</label>
                </div>
                <div class="col-sm-5">
                  <input type="number" class="form-control" id="volume" name="volume" data-minlength="1" data-error="容量有誤，請檢查。" value="<?php echo $spec['volume']; ?>" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-2">
                    <a class="btn btn-warning float-left" href="list.php" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                  </div>
                  <div class="col-sm-10 col-sm-offset-2 text-right">
                    <input type="hidden" name="MM_update" value="UPDATE">
                    <input type="hidden" name="author" value="<?php echo $_SESSION['account'] ?>">
                    <input type="hidden" name="specID" value="<?php echo $spec['specID']; ?>">
                    <input type="hidden" name="updatedDate" value="<?php echo date('Y-m-d H:i:s') ?>">
                    <button type="submit" class="btn btn-warning">送出更新</button>
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
