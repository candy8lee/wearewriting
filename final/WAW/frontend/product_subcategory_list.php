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
			$sth = $db->query("SELECT * FROM product_subcategory");
			$subcategory = $sth->fetchALL(PDO::FETCH_ASSOC);
			foreach($subcategory as $row){
		 ?>
		<div class="col-lg-4 col-md-4 col-xs-12">
				<table>
					<tr>
						<td><a href="product_subcategory.php?cateID=<?php echo $row['categoryID']; ?>&subID=<?php echo $row2['subcategoryID']; ?>"><img src="../upload/product_subcategory/<?php echo $row['picture']; ?>" alt="" width="100%"></a></td>
					</tr>
					<tr>
						<td><a href="product_subcategory.php?cateID=<?php echo $row['categoryID']; ?>&subID=<?php echo $row2['subcategoryID']; ?>"><?php echo $row['subcategory']; ?></a></td>
					</tr>
				</table>
		</div>
	<?php } ?>
	</div>
</div>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
