<html>
<head>
<?php require_once('template/header.php'); ?>
</head>
<?php
if(isset($_POST['MM_update']) && $_POST['MM_update'] == "QuantityEdit"){
	$id= $_POST['CartID'];
	if($_POST['Quantity'] <= 0) $_POST['Quantity'] = 1;
	$_SESSION['Cart'][$id]['Quantity'] = $_POST['Quantity'];
}
?>
<body>
<?php require_once('template/nav.php'); ?>
<div class="">
    <h1 class="text-center">We Are Writing</h1>
</div>
<div class="container">
<a href="cart_clear_ALL.php" class="btn btn-warning" style="float:right;" onclick="if(!confirm('是否清空購物車？')){return false;};">清空購物車</a>
  <div class="row cart">
    <table class="text-center">
      <tr>
        <th width="15%">商品圖片</th>
        <th width="30%">品名</th>
		<th width="10%">單價</th>
        <th width="10%">數量</th>
        <th width="10%">小計</th>
        <th width="8%">更新</th>
        <th width="8%">刪除</th>
      </tr>
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
		?>
		元</td>
        <td><a href="cart_edit.php?cartID=<?php echo $i; ?>"><i class="fa fa-upload cart_edit_btn"></i></a></td>
        <td><a href="order_confirm.php"><i class="fa fa-times cart_delete_btn"></i></a></td>
      </tr>
	<?php } ?>
      <tr>
			  <td colspan="7" >
					<a href="order_confirm.php" class="btn btn-warning btn-lg">我要結帳</a>
				</td>
			</tr>
    </table>
  </div>
</div>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
