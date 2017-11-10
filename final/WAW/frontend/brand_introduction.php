<html>
<head>
<?php require_once('template/header.php'); ?>
</head>

<body>
<?php require_once('template/nav.php'); ?>
<?php
  $sth = $db->query("SELECT * FROM brand ORDER BY name");
  $brand = $sth->fetchALL(PDO::FETCH_ASSOC);
 ?>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <?php
  			foreach($brand as $row){
  		 ?>
  		<div class="col-lg-3 col-md-4 col-xs-12 brand_list">
  				<table>
  					<tr>
  						<td><a href="brand_introduction_details.php?brandID=<?php echo $row['brandID']; ?>"><img src="../upload/brand/<?php echo $row['logo']; ?>" alt="" width="100%"></a></td>
  					</tr>
  					<tr>
  						<td><a href="brand_introduction_details.php?brandID=<?php echo $row['brandID']; ?>"><?php echo $row['name']; ?></a></td>
  					</tr>
            <tr>
  						<td style="font-size:80%;"><?php echo $row['nation']; ?></td>
  					</tr>
  				</table>
  		</div>
  	<?php } ?>
  	<?php if(!isset($brand[0]['name'])){ ?>
  		<div class="col-sm-10">
  			<div class="text-center" style="font-size:20px; margin-top:100px;">
  				工事中，敬請期待。<br>
  				返回<a href="index.php">首頁</a>。<br><br><br>
  			</div>
  		</div>
  	<?php } ?>
    </div>

  </div>
</div>
<?php include_once("template/contact.php"); ?>
<?php include_once("template/footer.php"); ?>
<?php include_once("template/copyright.php"); ?>
</body>
</html>
