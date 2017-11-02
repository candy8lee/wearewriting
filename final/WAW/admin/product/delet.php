<?php
require_once('../../asset/connection/database.php');
//delete proiduct pic
$sth = $db->query("SELECT * FROM product WHERE productID=".$_GET['productID']);
$product = $sth->fetch(PDO::FETCH_ASSOC);
$picture = "../../upload/product/".$product['picture'];
unlink($picture);
//if have mulit pictures
for($i =2; $i<5; $i++){
    if(isset($picture['picture'.$i]))
      unlink("../../upload/product/".$product['picture'.$i]);
}
$sth = $db-> query("DELETE FROM product WHERE productID=".$_GET['productID']);

if(isste($_GET['subID'])) header('Location: list.php?cateID='.$_GET['cateID'].'&subID='.$_GET['subID']);
else header('Location: list.php?cateID='.$_GET['cateID']);
 ?>
