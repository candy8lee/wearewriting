<?php
require_once("../../asset/connection/database.php");
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){
  $sql= "UPDATE q_a_reply SET
                                 title= :title,
								 categoryID= :categoryID,
								 reply= :reply,
								 updatedDate= :updatedDate,
								 author= :author
                                 WHERE replyID= :replyID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":categoryID", $_POST['categoryID'], PDO::PARAM_INT);
  $sth ->bindParam(":reply", $_POST['reply'], PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth ->bindParam(":replyID", $_POST['replyID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php?cateID='.$_POST['categoryID']);
}

$sth = $db->query("SELECT * FROM q_a_reply WHERE replyID=".$_GET['replyID']);
$QAreply = $sth->fetch(PDO::FETCH_ASSOC);

//for category name
$sth = $db->query("SELECT * FROM q_a_category WHERE categoryID=".$_GET['cateID']);
$QAcate = $sth->fetch(PDO::FETCH_ASSOC);

//for choose category
$sth = $db->query("SELECT * FROM q_a_category");
$QAcate_select = $sth->fetchALL(PDO::FETCH_ASSOC);
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
          <h1 class="display-5" contenteditable="true"><?php echo $QAcate['category']; ?>-編輯</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <ul class="breadcrumb my-3">
          <li class="breadcrumb-item"><a href="list.php?cateID=<?php echo $_GET['cateID']; ?>">主控台</a></li>
          <li class="breadcrumb-item">常見問題管理-<?php echo $QAcate['category']; ?></li>
		  <li class="breadcrumb-item active">編輯-<?php echo $QAreply['title']; ?></li>
        </ul>
        <div class="col-md-12">
          <form class="" method="post" action="edit.php"  data-toggle="validator">
		  <div class="form-group my-5">
                <div class="col-sm-12">
                  <label for="categoryID" class="control-label">常見問題分類：</label>
					<select name="categoryID" style="width: 300px;">
					<?php foreach($QAcate_select as $row){
							//判斷在哪個分類底下，selected要顯示哪個option
							if($QAcate['categoryID'] == $row['categoryID']){?>
						<option value="<?php echo $row['categoryID']; ?>" selected="selected"><?php echo $row['category']; ?></option>
					<?php }else{ ?>
						<option value="<?php echo $row['categoryID']; ?>"><?php echo $row['category']; ?></option>
					<?php }} ?>
					</select>
                </div>
            </div>
            <div class="form-group my-5">
                <div class="col-sm-2">
                  <label for="Title" class="control-label">標題</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title" value="<?php echo $QAreply['title']; ?>" data-minlength="1" data-error="標題至少一字元。" required>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
            </div>
			<div class="form-group my-5">
                <div class="col-sm-2">
                  <label for="reply" class="control-label">內文</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="reply" name="reply" data-error="請填寫內容。" required><?php echo $QAreply['reply']; ?></textarea>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="MM_update" value="UPDATE">
                  <input type="hidden" name="updatedDate" value="<?php echo date('y-m-d H:i:s') ?>">
				  <input type="hidden" name="author" value="admin">
				  <input type="hidden" name="replyID" value="<?php echo $_GET['replyID']; ?>">
                  <a class="btn btn-warning float-left" href="list.php?cateID=<?php echo $_GET['cateID']; ?>" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
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