<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == 'INSERT'){
  $sql= "INSERT INTO member_reply( questionID, content, createdDate, author)
                VALUES (  :questionID, :content, :createdDate, :author)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":questionID", $_POST['questionID'], PDO::PARAM_INT);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
  $sth ->bindParam(":author", $_POST['author'], PDO::PARAM_STR);
  $sth -> execute();

  $sth = $db->query("SELECT * FROM member_reply WHERE questionID=".$_POST['questionID']);
  $reply = $sth->fetch(PDO::FETCH_ASSOC);

  $sql= "UPDATE  member_question
                SET
						            status= :status,
                        replyID= :replyID
                        WHERE questionID= :questionID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":status", $_POST['status'], PDO::PARAM_INT);
  $sth ->bindParam(":replyID", $reply['replyID'], PDO::PARAM_INT);
  $sth ->bindParam(":questionID", $_POST['questionID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php?status=0&page='.$_POST['page']);//返回未回覆的頁面
}

$sth = $db->query("SELECT * FROM member_question WHERE questionID=".$_GET['questionID']);
$question = $sth->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
<?php include_once("../template/header.php"); ?>
<title>會員客服管理-回覆-<?php echo $question['title']; ?></title>
</head>
<body>
  <?php include_once("../template/nav.php"); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5" contenteditable="true">會員客服管理-回覆</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5" style="margin-bottom:0px;margin-top:0px">
            <li class="breadcrumb-item">
              <a href="list.php">主控台</a>
            </li>
            <li class="breadcrumb-item">會員客服管理-回覆</li>
            <li class="breadcrumb-item active">問題-<?php echo $question['title']; ?></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="reply.php"  data-toggle="validator">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <label for="content" class="control-label">內容</label>
                </div>
                <div class="col-sm-10">
                  <textarea class="form-control" id="content" name="content" data-error="請輸入內文" required></textarea>
                  <div class="help-block with-errors col-md-12" style="color:brown;"></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-2">
                  <a class="btn btn-warning float-left" href="list.php?status=0&page=<?php echo $_GET['page']; ?>" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
                </div>
                <div class="col-sm-10 text-right">
                  <input type="hidden" name="MM_insert" value="INSERT">
                  <!--submit自動默認狀態為已回覆-->
                  <input type="hidden" name="status" value="1">
                  <input type="hidden" name="questionID" value="<?php echo $question['questionID']; ?>">
                  <input type="hidden" name="author" value="<?php echo $_SESSION['account'] ?>">
                  <input type="hidden" name="createdDate" value="<?php echo date('Y-m-d H:i:s') ?>">
                  <input type="hidden" name="page" value="<?php echo $_GET['page']; ?>">
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
