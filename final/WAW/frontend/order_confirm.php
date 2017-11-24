<html>
<head>
<?php require_once('template/header.php'); ?>
</head>
<body>
<?php require_once('template/nav.php'); ?>
<div class="">
    <h1 class="text-center">We Are Writing</h1>
</div>
<div class="container">
  <div class="row cart">
    <table class="text-center">
      <tr>
        <th width="15%">商品圖片</th>
        <th width="30%">品名</th>
		<th width="10%">單價</th>
        <th width="10%">數量</th>
        <th width="10%">小計</th>
      </tr>
	  <?php $total=0?>
	  <?php for($i =0; $i < count($_SESSION['Cart']); $i++){?>
      <tr>
        <td><img src="../upload/product/<?php echo $_SESSION['Cart'][$i]['Picture'];?>"></img></td>
        <td class="text-left" style="padding-left:15px;"><?php echo $_SESSION['Cart'][$i]['Name'];?></td>
        <td><?php echo $_SESSION['Cart'][$i]['Price'];?></td>
        <td><?php echo $_SESSION['Cart'][$i]['Quantity'];?></td>
        <td>
		<?php
			$subtotal = $_SESSION['Cart'][$i]['Price']*$_SESSION['Cart'][$i]['Quantity'];
			echo $subtotal;
			$total += $subtotal;
		?>
		元</td>
      </tr>
	<?php } ?>
	  <tr>
		<td rowspan="2" colspan="4"></td>
	  <?php
		if($total>1500) $shipping=0; else $shipping=120;
	  ?>
		<td>+運費<?php echo $shipping; ?>元</td>
	  </tr>
	  <tr>
		<td>總金額： <?php echo $total+$shipping; ?> 元</td>
	  </tr>
      <tr>
		<td colspan="5"><a href="my_cart.php" class="btn btn-warning btn-lg" style="float:left;">返回編輯</a></td>
	  </tr>
    </table>
	<?php
		$sth = $db->query("SELECT * FROM member WHERE account='".$_SESSION['account']."'");
		$member = $sth->fetch(PDO::FETCH_ASSOC);
	?>
	<hr></hr>
	<h3>訂購資訊</h3><!-- 訂購資訊 訂購資訊 訂購資訊 訂購資訊 訂購資訊 訂購資訊 訂購資訊 訂購資訊 -->
	<hr></rh>
	<form role="form" action="order_success_insert.php" method="post" data-toggle="validator">
		<div class=" row">
			<div class="col-sm-2">
				<label for="OrderName" class="control-label">訂購人</label>
		    </div>
		    <div class="col-sm-10">
				<label for="OrderName"><?php  echo $member['account']; ?></label>
			</div>
		</div>
		<div class=" row">
			<div class="col-sm-2">
				<label for="name" class="control-label">收件者*</label>
			</div>
		    <div class="col-sm-10">
		        <input type="text" class="form-control" id="name" name="name" value="<?php  echo $member['name']; ?>" data-error="請輸入收件者。" required>
				<div class="help-block with-errors"></div>
		    </div>
		</div>
		<div class=" row">
		    <div class="col-sm-2">
		        <label for="phone" class="control-label">聯絡電話*</label>
		    </div>
		    <div class="col-sm-10">
				<input type="text" class="form-control" id="phone" name="phone" value="<?php  echo $member['phone']; ?>" required>
				<input type="hidden" name="orderNO" value="<?php  echo "WAW".date('YmdHis'); ?>">
				<input type="hidden" name="orderDate" value="<?php  echo date('Y-m-d H:i:s'); ?>">
				<input type="hidden" name="memberID" value="<?php  echo $member['memberID']; ?>">
				<input type="hidden" name="totalPrice" value="<?php  echo $total+$shipping ?>">
				<input type="hidden" name="shipping" value="<?php  echo $shipping; ?>">
				<input type="hidden" name="createdDate" value="<?php  echo date('Y-m-d H:i:s'); ?>">
		    </div>
		</div>
		<div class=" row">
		    <div class="col-sm-2">
				<label for="email" class="control-label">E-mail*</label>
		    </div>
		    <div class="col-sm-10">
		        <input type="email" class="form-control" id="email" name="email" value="<?php  echo $member['email']; ?>" data-error="請輸入電子信箱。" required>
				<div class="help-block with-errors"></div>
		    </div>
		</div>
		<div class=" row">
		    <div class="col-sm-2">
		        <label for="address" class="control-label">寄送地址*</label>
		    </div>
		    <div class="col-sm-10">
		        <input type="text" class="form-control" id="address" name="address" value="<?php  echo $member['address']; ?>" data-error="請輸入地址。" required>
				<div class="help-block with-errors"></div>
		    </div>
		</div>
		<div class=" row">
		    <div class="col-sm-10 col-sm-offset-2 text-right">
		        <input type="hidden" class="form-control" name="MM_insert" value="INSERT">
				<input class="btn btn-warning btn-lg" type="submit" style="float:right;" value="確定結帳">
		    </div>
		</div>
	</form>
  </div>
</div>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
