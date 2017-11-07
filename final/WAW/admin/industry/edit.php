<?php
require_once("../template/login_check.php");
require_once("../../asset/connection/database.php");
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){
  $sql= "UPDATE  industry SET
                        title= :title,
                        content= :content,
						            class= :class,
                        updatedDate= :updatedDate,
						            author= :author
                        WHERE industryID= :industryID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":class", $_POST['class'], PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth ->bindParam(":industryID", $_POST['industryID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php');
}

$sth = $db->query("SELECT * FROM industry WHERE industryID=".$_GET['industryID']);
$industry = $sth->fetch(PDO::FETCH_ASSOC);
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
          <h1 class="display-5" contenteditable="true">相關產業介紹管理-<?php echo $industry['title']; ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5">
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item">相關產業介紹管理-編輯</li>
			      <li class="breadcrumb-item active"><?php echo $industry['class']; ?>-<?php echo $industry['title']; ?></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="edit.php"  data-toggle="validator">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12 text-right">
                  <label for="class" class="control-label">產業別：</label>
                  <select name="class" style="width:200px;">
                  <?php switch ($industry['class']) {
                          case '印刷業':?>
                            <option value="印刷業" selected>印刷業</option>
                            <option value="造紙">造紙</option>
                            <option value="周邊商品">周邊商品</option>
                  <?php   break;
                          case '造紙':?>
                            <option value="印刷業">印刷業</option>
                            <option value="造紙" selected>造紙</option>
                            <option value="周邊商品">周邊商品</option>
                  <?php   break;
                          case '周邊商品':?>
                            <option value="印刷業">印刷業</option>
                            <option value="造紙">造紙</option>
                            <option value="周邊商品 selected">周邊商品</option>
                  <?php   break;} ?>
                  </select>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="title" class="control-label">標題</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title" value="<?php echo $industry['title']; ?>"  data-error="請填寫標題。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="content" class="control-label">內容</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="content" name="content" data-error="請輸入內文" required><?php echo $industry['content']; ?></textarea>
                  <div class="help-block with-errors col-md-12" style="color:blue;"></div>
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
                  <input type="hidden" name="industryID" value="<?php echo
                  $industry['industryID']; ?>">
                  <input type="hidden" name="updatedDate" value="<?php echo date('y-m-d H:i:s') ?>">
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
