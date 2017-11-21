<html>
<head>
<?php require_once('template/header.php'); ?>
<?php
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){
  $sql= "UPDATE member_question SET
						            title= :title,
                        content= :content
                        WHERE questionID= :questionID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":questionID", $_POST['questionID'], PDO::PARAM_INT);
  $sth -> execute();
  header('Location: member_question.php');
}

$sth = $db -> query("SELECT * FROM member WHERE account='".$_SESSION['account']."'");
$member = $sth ->fetch(PDO::FETCH_ASSOC);

$sth = $db -> query("SELECT * FROM member_question WHERE memberID=".$member['memberID']." ORDER BY createdDate DESC");
$questions = $sth ->fetchALL(PDO::FETCH_ASSOC);

$sth = $db -> query("SELECT * FROM member_question WHERE questionID=".$_GET['questionID']);
$question = $sth ->fetch(PDO::FETCH_ASSOC);
?>
</head>
<body>
<?php require_once('template/nav.php'); ?>
<div class="">
    <h1 class="text-center">We Are Writing</h1>
</div>
<hr></hr>
<h3 class="text-center">客服提問 - 編輯 / <a href="#reply">歷史紀錄<a/></h3>
<div class="container">
  <div class="row cart">
		<form action="member_question_edit.php" method="post" data-toggle="validator">
			<div class="col-sm-offset-1 col-sm-10 col-sm-offset-1 cart">
				<div class="row">
          <div class="col-sm-2">
            <label for="title">標題*：</label>
          </div>
          <div class="col-sm-8 text-left">
            <input type="text" name="title" value="<?php echo $question['title']; ?>" required>
          </div>
				</div>
        <div class="row">
          <div class="col-sm-2">
            <label for="content">內容*：</label>
          </div>
          <div class="col-sm-8">
            <textarea type="text" name="content" required><?php echo $question['content']; ?></textarea>
          </div>
				</div>
        <div class="row">
          <div class="col-sm-offset-2 col-sm-10 text-right">
            <input type="hidden" name="MM_update" value="UPDATE">
            <input type="hidden" name="questionID" value="<?php echo $_GET['questionID']; ?>">
            <button class="btn btn-warning btn-lg" type="submit" name="button">更新</button>
          </div>
        </div>
			</div>
		</form>
    <div class="row">
      <div class="col-sm-12">
        <table class="text-center" id="reply">
          <h3>歷史紀錄</h3>
          <tr>
            <th width=20%>日期</th>
            <th width=22%>標題</th>
            <th width=42%>回覆/狀態</th>
            <th width="8%">編輯</th>
            <th width="8%">取消</th>
          </tr>
        <?php foreach ($questions as $row) {?>
          <tr>
            <td><?php echo $row['createdDate']; ?></td>
            <td><?php echo $row['title']; ?></td>
          <?php if(isset($row['replyID']) || $row['replyID'] != null){
            $sth = $db -> query("SELECT * FROM member_reply WHERE replyID=".$row['replyID']);
            $reply = $sth ->fetch(PDO::FETCH_ASSOC);
          ?>
            <td><?php echo $reply['content']; ?>...read more</td>
            <td></td>
            <td></td>
          <?php }else{
            switch ($row['status']) {
              case '0':
                echo "<td>處理中</td>";?>
                      <td><a href="member_question_edit.php?questionID=<?php echo $row['questionID']; ?>" class="btn btn-warning" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                      <td><a href="question_cancel.php?questionID=<?php echo $row['questionID']; ?>" class="btn btn-danger" role="button" onclick="if(!confirm('是否取消此次提問？')){return false;};"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
          <?php
                break;
              case '99':
                echo "<td>已取消</td><td></td><td></td>";
                break;
            }
          } ?>
          </tr>
        <?php } ?>
        </table>
      </div>
    </div>
	</div>
</div>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
