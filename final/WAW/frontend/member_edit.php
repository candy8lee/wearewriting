<html>
<head>
<?php require_once('template/header.php'); ?>
<?php
if(isset($_POST['MM_update']) && $_POST['MM_update'] == 'UPDATE'){
  //上傳picture
  if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != null){
    if (!file_exists('../upload/member')) mkdir('../upload/member', 0755, true);
    $fileTYPE = strrchr($_FILES['picture']['name'],".");//查找字串，遇到"."停止->分割副檔名
    $filename = $_POST['memberID']."_".date('YmdHis').$fileTYPE;
    move_uploaded_file($_FILES['picture']['tmp_name'] , "../upload/member/".$filename);   // 搬移上傳檔案
  }else{
    $filename = $_POST['picture1'];
  }

  $sql= "UPDATE member SET
                          picture= :picture,
                          name= :name,
                          brithday= :brithday,
													address= :address,
													email= :email,
													phone= :phone,
													password= :password,
                          updatedDate= :updatedDate
                          WHERE memberID= :memberID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":brithday", $_POST['brithday'], PDO::PARAM_STR);
	$sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
	$sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
  $sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_INT);
	$sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":memberID", $_POST['memberID'], PDO::PARAM_INT);
	$sth ->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
  $sth -> execute();

  header('Location: member_edit.php');
}
?>
</head>
<script>
$( function() {
	$( "#brithday" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd",
		defaultDate: "-20y",
		maxDate: "-10y",
		minDate: new Date(1901, 1 - 1, 1)
	});
} );
$(function(){
	//暫存原本密碼，以備點擊取消變更密碼
	var PassWord = $('#password').val();
	$('#PW_btn').click(function(){
		$('#PW_change').css('display', 'block');
		$('#PW_cancel').css('display', 'block');
		$('#PW_btn').css('display', 'none');
	});
		$('#PW_cancel').click(function(){
			$('#PW_change').css('display', 'none');
			$('#PW_cancel').css('display', 'none');
			$('#PW_btn').css('display', 'block');
			//取消變更密碼，把原來密碼的資料匯入
			$('#password').val(PassWord);
			$('#ConfirmPas').val(PassWord);
	});
});
</script>
<body>
<?php require_once('template/nav.php'); ?>
<div class="">
    <h1 class="text-center">We Are Writing</h1>
</div>
<hr></hr>
<h3 class="text-center">會員專區 - 編輯</h3>
<div class="container">
  <div class="row cart">
		<?php
			$sth = $db->query("SELECT * FROM member WHERE account='".$_SESSION['account']."'");
			$member = $sth->fetch(PDO::FETCH_ASSOC);
		?>
		<form action="member_edit.php" method="post" data-toggle="validator">
			<div id="member_edit" class="col-sm-12 text-center">
				<img src="../upload/member/<?php echo $member['picture']; ?>" alt="">
				<input type="file" name="picture" value="">
				<input type="hidden" name="picture1" value="<?php echo $member['picture']; ?>">
			</div>
			<div class="col-sm-offset-3 col-sm-6 col-sm-offset-3 text-left">
				<div class="row">
					<div class="col-sm-10">
						<span>帳號：</span>
						<label><?php echo $member['account']; ?></lable>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10 form-group">
						<span>名字：</span>
						<input type="text" id="name" name="name" value="<?php echo $member['name']; ?>" data-error="請輸入訂購人姓名" placeholder="為預設收件者姓名" required>
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-10">
						<span>生日：</span>
						<input type="text" id="brithday" name="brithday" value="<?php echo $member['brithday']; ?>" data-error="請點擊選擇生日。" placeholder="專屬生日月份獨享小禮品" required>
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 form-group">
						<span>地址：</span>
						<input type="text" id="address" name="address" value="<?php echo $member['address']; ?>" data-error="請輸入地址。" placeholder="為訂單預設收件地址" required style="width:80%;">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-11 form-group">
						<span>電子信箱：</span>
						<input type="email" id="email" name="email" value="<?php echo $member['email']; ?>" data-error="請輸入有效電子信箱。" required style="width:80%;">
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10 form-group">
						<span>聯絡電話：</span>
						<input type="number" id="phone" name="phone" value="<?php echo $member['phone']; ?>"  pattern="^[0-9]*$" data-error="請輸入電話號碼。(純數字即可)" placeholder="市話/手機皆可" required>
						<div class="help-block with-errors"></div>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-sm-10">
						<p id="PW_btn" class="btn btn-danger">修改密碼</p>
					</div>
				</div>
				<div id="PW_change">
					<div class="row form-group">
						<div class="col-sm-10">
							<span>新密碼：</span><input type="password" id="password" name="password" value="<?php echo $member['password']; ?>" pattern="^(?=^.{8,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$" data-minlength="8" required data-error="密碼長度必須至少有八碼，並且包含至少一個小寫字母與一個大寫字母和一個數字。" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-sm-10">
							<span>確認密碼：</span><input type="password" id="ConfirmPas" name="ConfirmPas" data-match="#password" value="<?php echo $member['password']; ?>" data-match-error="密碼不符，請重新輸入。" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-sm-10">
						<p id="PW_cancel" class="btn btn-danger">取消</p>
					</div>
				</div>
				<div class="text-right">
					<input type="hidden" name="MM_update" value="UPDATE">
					<input type="hidden" name="updatedDate" value="<?php echo date("Y-m-d H:i:s"); ?>">
					<input type="hidden" name="mamberID" value="<?php echo $member['memberID']; ?>">
					<button class="btn btn-warning btn-lg" type="submit" name="button">送出</button>
				</div>
			</div>
	  </div>
	</div>
</form>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
