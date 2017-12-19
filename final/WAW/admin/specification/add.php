<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == 'INSERT'){

  $sql= "INSERT INTO specification( brandID, subID, bottle_material, volume, createdDate, author)
                    VALUES ( :brandID, :subID, :bottle_material, :volume, :createdDate, :author)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":brandID", $_POST['brandID'], PDO::PARAM_INT);
  $sth ->bindParam(":subID", $_POST['subID'], PDO::PARAM_INT);
  $sth ->bindParam(":bottle_material", $_POST['bottle_material'], PDO::PARAM_STR);
  $sth ->bindParam(":volume", $_POST['volume'], PDO::PARAM_INT);
  $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth -> execute();

  header('Location: list.php');
}

include_once("../template/header.php");
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
          <h1 class="display-5" contenteditable="true">規格表管理-新增</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item">
              <a href="list.php">主控台</a>
            </li>
            <li class="breadcrumb-item active">規格表管理-新增</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="text-right" method="post" action="add.php"  data-toggle="validator">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <label for="brandID" class="control-label">品牌：</label>
                  <select name="brandID" style="width: 200px;">
                    <option>請選擇</option>
                  <?php
                    $sth = $db->query("SELECT * FROM brand");
                    $brand = $sth->fetchALL(PDO::FETCH_ASSOC);
                    foreach($brand as $row){ ?>
                    <option value="<?php echo $row['brandID']; ?>"><?php echo $row['name']; ?></option>
                  <?php } ?>
                  </select>
                  <label for="type" class="control-label">　子分類：</label>
        					<select name="subID" style="width: 100px;">
                    <option>請選擇</option>
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
                  						<option value="<?php echo $row['subcategoryID']; ?>"><?php echo $row['subcategory']; ?></option>
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
                  <input type="text" class="form-control date" id="bottle_material" name="bottle_material" data-error="請填寫材質。" required>
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
                  <input type="number" class="form-control" id="volume" name="volume" data-minlength="1" data-error="容量有誤，請檢查。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-2">
                    <a class="btn btn-warning" href="list.php" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                  </div>
                  <div class="col-sm-10 text-right">
                    <input type="hidden" name="MM_insert" value="INSERT">
                    <input type="hidden" name="author" value="<?php echo $_SESSION['account'] ?>">
                    <input type="hidden" name="createdDate" value="<?php echo date('Y-m-d H:i:s') ?>">
                    <button type="submit" class="btn btn-warningbtn-warning">送出</button>
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
