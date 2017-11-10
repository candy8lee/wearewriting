	<div class="product_menu col-sm-2">
		<h3>全部商品(
			<?php
				$sth = $db->query("SELECT productID FROM product");
				$product= $sth->fetchALL(PDO::FETCH_ASSOC);
				$items = count($product);
				echo $items;
			?>
			)</h3>
		<div>
		<?php
			$sth = $db->query("SELECT * FROM product_category");
			$product_category = $sth->fetchALL(PDO::FETCH_ASSOC);
		 	foreach($product_category as $row){ ?>
			<div class="product_menu-1">
				<h3><?php echo $row['category']; ?>(
					<?php
						$sth = $db->query("SELECT * FROM product WHERE categoryID=".$row['categoryID']);
						$product= $sth->fetchALL(PDO::FETCH_ASSOC);
						echo count($product);
					?>
					)</h3>
				<div>
					<ul>
						<?php
							$sth = $db->query("SELECT * FROM product_subcategory WHERE categoryID=".$row['categoryID']);
							$product_subcategory = $sth->fetchALL(PDO::FETCH_ASSOC);
							foreach($product_subcategory as $row2)
							if(isset($row2['subcategoryID'])){
						?>
						<a href="product_subcategory.php?cateID=<?php echo $row['categoryID']; ?>&subID=<?php echo $row2['subcategoryID']; ?>"><li><?php echo $row2['subcategory']; ?>(
							<?php
								$sth = $db->query("SELECT * FROM product WHERE subcategoryID=".$row2['subcategoryID']);
								$product= $sth->fetchALL(PDO::FETCH_ASSOC);
								echo count($product);
							?>
							)</li></a>
						<?php } ?>
						<a href="product_category.php?cateID=<?php echo $row['categoryID']; ?>"><li>此分類全部商品</li></a>
					</ul>
				</div>
			</div>
		<?php } ?>
		<a href="product_subcategory_list.php">子分類總攬(
			<?php
				$sth = $db->query("SELECT * FROM product_subcategory");
				$subcate = $sth->fetchALL(PDO::FETCH_ASSOC);
				echo count($subcate);
			 ?>
			)</a><br>
		<a href="product_no_category.php">返回全部商品(<?php echo $items; ?>)</a>
		</div>
	</div>
