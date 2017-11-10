<html>
<head>
<?php require_once('template/header.php'); ?>
<style media="screen">
	#contact{
		margin:-30px 0 -15px 0;
	}
	h3{
		text-align: right;
	}
	@media only screen and (max-width: 1025px){
		.product_menu{
			display: none;
		}
	}
</style>
<script>
  $( function() {
    $( "#boards_click" ).accordion({
      heightStyle: "content",
      active: false,
	  	collapsible: true
    });
    $('.quantity-button').click(function(){
      //點擊"-"minus 就減1、"+"plus就加1
      var quantity = 1;
      quantity = $('input[name="quantity"]').val();
      if($(this).find('i').hasClass('fa-plus')){
        quantity++;
        console.log("加數量="+quantity);
      }else{
        quantity--;
        console.log("減數量="+quantity);
      }
      $('input[name="quantity"]').val(quantity);
      });
		$( ".product_menu" ).accordion({
			heightStyle: "content",
			collapsible: true
		});
		$( ".product_menu-1" ).accordion({
		  heightStyle: "content",
			collapsible: true
		 });
		$('#dec_btn').click(function(){
				$("#decription").delay(800).fadeIn(2000, function(){
					$('#decription').css("height", "auto");
				});
				$('#dec_btn').fadeOut(800, function(){
					$('#dec_btn').css("display", "none");
				});
		});
	} );
</script>
</head>

<body>
<?php require_once('template/nav.php'); ?>
<?php include_once("template/product_menu.php"); ?>
<div class="container">
	<div class="row">
		<div id="product_logo" class="col-sm-12 text-center">
			<?php
				$sth = $db->query("SELECT * FROM product WHERE productID=".$_GET['productID']);
				$product = $sth->fetch(PDO::FETCH_ASSOC);
				$sth = $db->query("SELECT * FROM brand WHERE brandID=".$product['brandID']);
				$brand = $sth->fetch(PDO::FETCH_ASSOC);
			 ?>
			<img src="../upload/brand/<?php echo $brand['logo']; ?>" alt="" width="20%">
		</div>
		<div class="col-sm-12">
			<div class="col-sm-8">
				<div>
					<a href="../upload/product/<?php echo $product['picture']; ?>"><img class="big_pic" src="../upload/product/<?php echo $product['picture']; ?>" alt=""></a>
				</div>
				<hr></hr>
				<div class="text-center">
				<?php
					for( $i =2; $i <=4; $i++){
						if(isset($product['picture'.$i]) && $product['picture'.$i] != ""){?>
							<a href="../upload/product/<?php echo $product['picture'.$i]; ?>"><img class="little_pic" src="../upload/product/<?php echo $product['picture'.$i]; ?>" alt=""></a>
				<?php }} ?>
				</div>
			</div>
			<div id="product_details" class="col-sm-4">
			  <form method="post" action="#" data-toggle="validator">
					<table class="float-left">
						<tr>
							<td width=40% >品名：</td>
							<td><?php  echo $product['name'];?></td>
						</tr>
						<tr>
							<td>售價：</td>
							<td><?php  echo $product['price'];?></td>
						</tr>
						<tr>
							<td>庫存：</td>
							<td><?php  echo $product['store'];?></td>
						</tr>
						<tr>
							<td>數量：</td>
							<td id="quan">
								<div class="quantity-button">
									<i class="fa fa-plus" aria-hidden="true"></i>
								</div>
								<input class="text-center" type="text" name="quantity" value="1" pattern="^[_1-9]" data-error="請輸入有效數字。" required>
								<div class="help-block with-errors"></div>
								<div class="quantity-button">
									<i class="fa fa-minus" aria-hidden="true"></i>
								</div>
							</td>
						</tr>
						<tr id="cart_btn">
							<td colspan="2" class="text-right"><input type="submit" class="btn btn-warning btn-lg" value="加入購物車"></td>
						</tr>
					</table>
				</from>
				<p class="text-right"><?php  echo $product['sold'];?> 位會員已購買</p>
			</div>
		</div>
	</div>
</div>
<hr></hr>
<div class="text-center">
	<p id="dec_btn" class="btn btn-warning">詳細描述， 點擊觀看 CLICK ▼</p>
</div>
<div id="decription">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				規格表
			</div>
			<div id="content" class="col-sm-offset-2 col-sm-8 col-sm-offset-2">COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊COL8集中中間顯示詳細資訊
			</div>
		</div>
	</div>
</div>
<div id="boards_click">
	<h3>留言板&nbsp&nbspCLICK▼&nbsp點擊顯示</h3>
	<div>買家推坑大全 / 閒聊版
	<?php include_once("template/boards.php"); ?>
	</div>
</div>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
