<?php
session_start();
require_once("../asset/connection/database.php");
$sql= "INSERT INTO customer_order( memberID, orderNO, orderDate, totalPrice, shipping, name, phone, email, address, createdDate)
								 VALUES ( :memberID, :orderNO, :orderDate, :totalPrice, :shipping, :name, :phone, :email, :address, :createdDate)";
$sth = $db ->prepare($sql);
$sth ->bindParam(":memberID", $_POST['memberID'], PDO::PARAM_INT);
$sth ->bindParam(":orderNO", $_POST['orderNO'], PDO::PARAM_INT);
$sth ->bindParam(":orderDate", $_POST['orderDate'], PDO::PARAM_STR);
$sth ->bindParam(":totalPrice", $_POST['totalPrice'], PDO::PARAM_INT);
$sth ->bindParam(":shipping", $_POST['shipping'], PDO::PARAM_INT);
$sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
$sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
$sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
$sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
$sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
$sth -> execute();

$sth = $db->query("SELECT * FROM customer_order WHERE memberID =".$_POST['memberID']." ORDER BY createdDate DESC");
$last_order = $sth->fetch(PDO::FETCH_ASSOC);

for($i = 0; $i < count($_SESSION['Cart']); $i++){
	$sql= "INSERT INTO order_details( orderID, cateID, picture, price, productID, quantity, createdDate)
									 VALUES ( :orderID, :cateID, :picture, :price, :productID, :quantity, :createdDate)";
	$sth = $db ->prepare($sql);
	$sth ->bindParam(":orderID", $last_order['orderID'], PDO::PARAM_INT);
	$sth ->bindParam(":picture", $_SESSION['Cart'][$i]['Picture'], PDO::PARAM_STR);
	$sth ->bindParam(":cateID", $_SESSION['Cart'][$i]['CateID'], PDO::PARAM_INT);
	$sth ->bindParam(":price", $_SESSION['Cart'][$i]['Price'], PDO::PARAM_STR);
	$sth ->bindParam(":productID", $_SESSION['Cart'][$i]['ProductID'], PDO::PARAM_STR);
	$sth ->bindParam(":quantity", $_SESSION['Cart'][$i]['Quantity'], PDO::PARAM_STR);
	$sth ->bindParam(":createdDate", $last_order['createdDate'], PDO::PARAM_STR);
	$sth -> execute();
}


//unset($_SESSION['Cart']);
header('Location: order_success.php');
 ?>
