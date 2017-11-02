<?php
require_once('../../asset/connection/database.php');

//delete category pic
$sth = $db->query("SELECT * FROM product_category WHERE categoryID=".$_GET['cateID']);
$product_category = $sth->fetch(PDO::FETCH_ASSOC);
$picture = "../../upload/product_category/".$product_category['picture'];
unlink($picture);
$sth = $db-> query("DELETE FROM product_category WHERE categoryID=".$_GET['cateID']);


//delete subcategory pic
$sth = $db->query("SELECT * FROM product_subcategory WHERE subcategoryID=".$_GET['subID']);
$product_subcategory = $sth->fetch(PDO::FETCH_ASSOC);
$picture = "../../upload/product_subcategory/".$product_subcategory['picture'];
unlink($picture);
$sth = $db-> query("DELETE FROM product_subcategory WHERE categoryID=".$_GET['cateID']);

//delete proiduct pic
$sth = $db->query("SELECT * FROM product WHERE subcategoryID=".$_GET['subID']);
$product = $sth->fetch(PDO::FETCH_ASSOC);
$picture = "../../upload/product/".$product['picture'];
unlink($picture);
//if have mulit pictures
for($i =2; $i<5; $i++){
    if(isset($picture['picture'.$i]))
      unlink("../../upload/product/".$product['picture'.$i]);
}
$sth = $db-> query("DELETE FROM product WHERE categoryID=".$_GET['cateID']);

header('Location: list.php');
 ?>
