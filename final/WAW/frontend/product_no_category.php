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
      active: false,
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
	<div class="product_menu col-sm-2">
		<h3>全部商品</h3>
		<div>
		<?php
			$sth = $db->query("SELECT * FROM product_category");
			$product_category = $sth->fetchALL(PDO::FETCH_ASSOC);
		 	foreach($product_category as $row){ ?>
			<div class="product_menu-1">
				<h3><?php echo $row['category']; ?></h3>
				<div>
					<ul>
						<a href="product_category.php?cateID=<?php echo $row['categoryID']; ?>"><li>全部商品</li></a>
						<?php
							$sth = $db->query("SELECT * FROM product_subcategory WHERE categoryID=".$row['categoryID']);
							$product_subcategory = $sth->fetchALL(PDO::FETCH_ASSOC);
							foreach($product_subcategory as $row2)
							if(isset($row2['subcategoryID'])){
						?>
						<a href="product_category.php?cateID=<?php echo $row['categoryID']; ?>&subID=<?php echo $row2['subcategoryID']; ?>"><li><?php echo $row2['subcategory']; ?></li></a>
						<?php } ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
	<div class="col-sm-10 product_list">
		<?php
			$sth = $db->query("SELECT * FROM product");
			$product = $sth->fetchALL(PDO::FETCH_ASSOC);
			foreach($product as $row){
		 ?>
		<div class="col-lg-2 col-md-3 col-xs-12">
				<table>
					<tr>
						<td><img src="../upload/product/<?php echo $row['picture']; ?>" alt="" width="100%"></td>
					</tr>
					<tr>
						<td><?php echo $row['name']; ?></td>
					</tr>
					<tr>
						<td>NT <?php echo $row['price']; ?> 元</td>
					</tr>
				</table>
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
