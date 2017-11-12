<html>
<head>
<?php require_once('template/header.php'); ?>
</head>
<script>
$( function() {
    $('.quantity-button').click(function(){
      //點擊"-"minus 就減1、"+"plus就加1
      var quantity = 1;
      quantity = $('input[name="Quantity"]').val();
      if($(this).find('i').hasClass('fa-plus')){
        quantity++;
        console.log("加數量="+quantity);
      }else{
        quantity--;
        console.log("減數量="+quantity);
      }
      $('input[name="Quantity"]').val(quantity);
      });
		
} );
</script>
<body>
<?php require_once('template/nav.php'); ?>
<div class="">
    <h1 class="text-center">We Are Writing</h1>
</div>
<div class="container">
  <div class="row cart">
	<form action="my_cart.php" method="post">
		<table class="text-center">
		  <tr>
			<th width="15%">商品圖片</th>
			<th width="30%">品名</th>
			<th width="10%">單價</th>
			<th width="10%">數量</th>
			<th width="10%">小計</th>
			<th width="8%">刪除</th>
		  </tr>
		  <?php $id = $_GET['CartID'];?>
		  <tr>
			<td><img src="../upload/product/<?php echo $_SESSION['Cart'][$id]['Picture'];?>"></img></td>
			<td class="text-left" style="padding-left:15px;"><?php echo $_SESSION['Cart'][$id]['Name'];?></td>
			<td><?php echo $_SESSION['Cart'][$id]['Price'];?></td>
			<td id="quan" class="quan">
				<div class="quantity-button">
					<i class="fa fa-plus" aria-hidden="true"></i>
				</div>
				<input class="text-center" type="text" name="Quantity" value="<?php echo $_SESSION['Cart'][$id]['Quantity'];?>" pattern="^[_1-9]" required>
				<div class="quantity-button">
					<i class="fa fa-minus" aria-hidden="true"></i>
				</div>
			</td>
			<td>
			<?php
				$subtotal = $_SESSION['Cart'][$id]['Price']*$_SESSION['Cart'][$id]['Quantity'];
				echo $subtotal;
			?>
			元</td>
			<td><a href="cart_delete.php?CartID=<?php echo $id; ?>" onclick="if(!confirm('是否要移除此筆商品？')){return false;};"><i class="fa fa-times cart_delete_btn"></i></a></td>
		  </tr>
		  <tr>
				  <td colspan="7" >
						<input type="hidden" name="MM_update" value="QuantityEdit">
						<input type="hidden" name="CartID" value="<?php echo $id; ?>">
						<input class="btn btn-warning btn-lg" type="submit" style="float:right;" value="確認更新">
					</td>
				</tr>
		</table>
	</form>
  </div>
</div>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
<?php print_r($_SESSION['Cart']); ?>
</body>
</html>
