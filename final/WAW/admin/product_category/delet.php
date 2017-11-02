<?php
require_once('../../asset/connection/database.php');
$sth = $db-> query("DELETE FROM product_category WHERE categoryID=".$_GET['cateID']);
$sth = $db-> query("DELETE FROM product_subcategory WHERE categoryID=".$_GET['cateID']);
$sth = $db-> query("DELETE FROM product WHERE categoryID=".$_GET['cateID']);
header('Location: list.php');
 ?>
