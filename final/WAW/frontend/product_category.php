<html>
<head>
<?php require_once('template/header.php'); ?>
<style media="screen">
	#contact{
		margin:0;
	}
	h3{
		text-align: right;
	}
</style>
<script>
  $( function() {
    $( "#boards_click" ).accordion({
      heightStyle: "content",
      active: false,
	  	collapsible: true
    });
  } );
	$( function() {
		$( ".product_menu" ).accordion({
			heightStyle: "content",
			collapsible: true
		});
	} );
	$( function() {
    $( ".product_menu-1" ).accordion({
      heightStyle: "content",
	  	collapsible: true
    });
  } );
</script>
</head>

<body>
<?php require_once('template/nav.php'); ?>
<div class="">
    <h1 class="text-center">We Are Writing</h1>
</div>
<div class="row">
	<?php include_once("template/product_menu.php"); ?>
	<div class="col-sm-10 product_list">
		<?php
			$sth = $db->query("SELECT * FROM product WHERE categoryID=".$_GET['cateID']." ORDER BY createdDate DESC");
			$product = $sth->fetchALL(PDO::FETCH_ASSOC);
			foreach($product as $row){
		 ?>
		<div class="col-lg-2 col-md-3 col-xs-12">
				<table>
					<tr>
						<td><a href="product.php?productID=<?php echo $row['productID']; ?>&cateID=<?php echo $_GET['cateID']; ?>"><img src="../upload/product/<?php echo $row['picture']; ?>" alt="" width="100%"></a></td>
					</tr>
					<tr>
						<td><a href="product.php?productID=<?php echo $row['productID']; ?>&cateID=<?php echo $_GET['cateID']; ?>"><?php echo $row['name']; ?></a></td>
					</tr>
					<tr>
						<td>NT <?php echo $row['price']; ?> 元</td>
					</tr>
				</table>
		</div>
	<?php } ?>
	<?php if(!isset($product[0]['name'])){ ?>
		<div class="col-sm-10">
			<div class="text-center" style="font-size:20px; margin-top:100px;">
				正積極與廠商溝通為大家提供更好的商品品質，敬請期待。<br>
				返回<a href="product_no_category.php">全部商品</a>頁面。
			</div>
		</div>
	<?php } ?>
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
