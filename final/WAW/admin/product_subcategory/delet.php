<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
$sth = $db->query("SELECT * FROM product_subcategory WHERE subcategoryID=".$_GET['subID']);
$product_subcategory = $sth->fetch(PDO::FETCH_ASSOC);
$picture = "../../upload/product_subcategory/".$product_subcategory['picture'];
unlink($picture);//delete subcategory pic
$sth = $db-> query("DELETE FROM product_subcategory WHERE subcategoryID=".$_GET['subID']);


$sth = $db->query("SELECT * FROM product WHERE subcategoryID=".$_GET['subID']);
$product = $sth->fetch(PDO::FETCH_ASSOC);
$picture = "../../upload/product/".$product['picture'];
unlink($picture);//delete proiduct pic
for($i =2; $i<5; $i++){
    if(isset($picture['picture'.$i]))
      unlink("../../upload/product/".$product['picture'.$i]);
}
$sth = $db-> query("DELETE FROM product WHERE subcategoryID=".$_GET['subID']);
header('Location: list.php');
 ?>
