<?php
require_once("../template/login_check.php");
require_once("../../asset/connection/database.php");
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){
  //上傳picture
  if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != null){
    if (!file_exists('../../upload/member')) mkdir('../../upload/member', 0755, true);
    $fileTYPE = strrchr($_FILES['picture']['name'],".");//查找字串，遇到"."停止->分割副檔名
    $filename = $_POST['name'].date('YmdHis').$fileTYPE;
    move_uploaded_file($_FILES['picture']['tmp_name'] , "../../upload/member/".$filename);   // 搬移上傳檔案
    $picture1 = "../../upload/member/".$_POST['picture1'];
    unlink($picture1);//刪除之前上傳的picture
  }else{
    $filename = $_POST['picture1'];
  }

  $sql= "UPDATE  member SET
                        picture= :picture,
                        password= :password,
                        name= :name,
                        phone= :phone,
                        brithday= :brithday,
                        email= :email,
                        address= :address,
                        updatedDate= :updatedDate
                        WHERE memberID= :memberID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
  $sth ->bindParam(":brithday", $_POST['brithday'], PDO::PARAM_STR);
  $sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
  $sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
  $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":memberID", $_POST['memberID'], PDO::PARAM_INT);
  $sth -> execute();

  header('Location: list.php');
}

$sth = $db->query("SELECT * FROM member WHERE memberID=".$_GET['memberID']);
$member = $sth->fetch(PDO::FETCH_ASSOC);
 ?>

<html>

<head>
  <?php include_once("../template/header.php"); ?>
  <script>
  $( function() {
    $( "#brithday" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "Y-mm-dd",
      defaultDate: "-20y",
      maxDate: "-10y",
      minDate: new Date(1901, 1 - 1, 1)
    });
  } );
  </script>
</head>
<body>
<?php require_once('../template/nav.php'); ?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="display-5" contenteditable="true">會員管理-<?php echo $member['name']; ?></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb my-5">
            <li class="breadcrumb-item"><a href="list.php">主控台</a></li>
            <li class="breadcrumb-item">會員管理</li>
      			<li class="breadcrumb-item active">編輯-<?php echo $member['account']; ?></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" method="post" action="edit.php" enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-sm-2">
                  <img src="../../upload/member/<?php echo $member['picture']; ?>" width="200px"></img>
                </div>
                <div class="col-sm-10">
                  <input type="file" class="form-control" id="picture" name="picture">
				          <input type="hidden" name="picture1" value="<?php echo $member['picture']; ?>"><!--預防沒選picture送出空資料-->
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                  <label for="account" class="control-label">帳號：</label>
                  <label for="account" class="control-label"><?php echo $member['account']; ?></label>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="password" class="control-label"></label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="password" name="password" value="<?php echo $member['password']; ?>" data-error="請設定密碼。" required>
                <div class="help-block with-errors col-md-12" style="color:brown;"></div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="name" class="control-label">名字</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" value="<?php echo $member['name']; ?>" data-error="請填寫名字。" required>
                <div class="help-block with-errors col-md-12" style="color:brown;"></div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="phone" class="control-label">電話</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $member['phone']; ?>" data-error="請輸入電話。" required>
                <div class="help-block with-errors col-md-12" style="color:brown;"></div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="brithday" class="control-label">生日</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="brithday" name="brithday" value="<?php echo $member['brithday']; ?>" data-error="請選擇出生日期。" required>
                <div class="help-block with-errors col-md-12" style="color:brown;"></div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="email" class="control-label">電子郵件</label>
                </div>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" value="<?php echo $member['email']; ?>" data-error="請填寫郵件地址。" required>
                <div class="help-block with-errors col-md-12" style="color:brown;"></div>
              </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                  <label for="address" class="control-label">地址</label>
                </div>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="address" name="address" value="<?php echo $member['address']; ?>" data-error="請輸入地址。" required>
                <div class="help-block with-errors col-md-12" style="color:brown;"></div>
              </div>
            </div>
              <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2 text-right">
                  <input type="hidden" name="MM_update" value="UPDATE">
                  <input type="hidden" name="memberID" value="<?php echo $member['memberID']; ?>">
                  <input type="hidden" name="createdDate" value="<?php echo date('y-m-d H:i:s') ?>">
                  <a class="btn btn-warning float-left" href="list.php?page=<?php echo $_GET['page']; ?>" onclick="if(!confirm('尚未儲存，確定要返回上一頁？')){return false;};">取消並回上一頁</a>
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
