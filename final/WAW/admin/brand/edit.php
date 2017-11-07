<?php
require_once("../template/login_check.php");
require_once("../../asset/connection/database.php");
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){
  //上傳LOGO
  if(isset($_FILES['logo']['name']) && $_FILES['logo']['name'] != null){
    if (!file_exists('../../upload/brand')) mkdir('../../upload/brand', 0755, true);
    $fileTYPE = strrchr($_FILES['logo']['name'],".");//查找字串，遇到"."停止->分割副檔名
    $filename = $_POST['name'].date('YmdHis').$fileTYPE;
    move_uploaded_file($_FILES['logo']['tmp_name'] , "../../upload/brand/".$filename);   // 搬移上傳檔案
    $logo1 = "../../upload/brand/".$_POST['logo1'];
    unlink($logo1);//刪除之前上傳的LOGO
  }else{
    $filename = $_POST['logo1'];
  }

  $sql= "UPDATE  brand SET
                        logo= :logo,
                        name= :name,
                        content= :content,
						            nation= :nation,
                        updatedDate= :updatedDate,
						            author= :author
                        WHERE brandID= :brandID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":logo", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":nation", $_POST['nation'], PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth ->bindParam(":brandID", $_POST['brandID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php');
}

$sth = $db->query("SELECT * FROM brand WHERE brandID=".$_GET['brandID']);
$brand = $sth->fetch(PDO::FETCH_ASSOC);

$sth = $db->query("SELECT * FROM nation ORDER BY name DESC");
$nation = $sth->fetchALL(PDO::FETCH_ASSOC);
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
          <h1 class="display-5" contenteditable="true">品牌介紹管理-<?php echo $brand['name']; ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5">
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item">品牌介紹管理</li>
			<li class="breadcrumb-item active">編輯-<?php echo $brand['name']; ?></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="edit.php" enctype="multipart/form-data">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <img src="../../upload/brand/<?php echo $brand['logo']; ?>"></img>
                </div>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="logo" name="logo">
				          <input type="hidden" name="logo1" value="<?php echo $brand['logo']; ?>"><!--預防沒選logo送出空資料-->
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="name" class="control-label">品牌</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" value="<?php echo $brand['name']; ?>" data-error="請填寫品牌。（若非必要請盡量以英文為主。）" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="content" class="control-label">介紹</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="content" name="content" data-error="請輸入內文" required><?php echo $brand['content']; ?></textarea>
                  <div class="help-block with-errors col-md-12" style="color:blue;"></div>
                </div>
              </div>
            </div>
			      <div class="form-group my-5">
              <div class="row">
                <div class="col-sm-12 text-right">
                  <label for="categoryID" class="control-label">國籍：</label>
        					<select name="nation" style="width: 300px;">
        					<?php foreach($nation as $row){
        							if($brand['nation'] == $row['name']){?>
        						<option value="<?php echo $row['name']; ?>" selected="selected">&nbsp&nbsp<?php echo $row['name']; ?>,&nbsp&nbsp<?php echo $row['name_cht']; ?></option>
        					<?php 	}else{ ?>
        						<option value="<?php echo $row['name']; ?>">&nbsp&nbsp<?php echo $row['name']; ?>,&nbsp&nbsp<?php echo $row['name_cht']; ?></option>
        					<?php }} ?>
        					</select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <a class="btn btn-warning float-left" href="list.php" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                </div>
                <div class="col-sm-10 text-right">
                  <input type="hidden" name="MM_update" value="UPDATE">
                  <input type="hidden" name="brandID" value="<?php echo $brand['brandID']; ?>">
                  <input type="hidden" name="createdDate" value="<?php echo date('y-m-d H:i:s') ?>">
				          <input type="hidden" name="author" value="<?php echo $_SESSION['account'] ?>">
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
