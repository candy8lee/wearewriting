<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
//delete upload logo
$sth = $db->query("SELECT * FROM brand WHERE brandID=".$_GET['brandID']);
$brand = $sth->fetch(PDO::FETCH_ASSOC);
$logo = "../../upload/brand/".$brand['logo'];
unlink($logo);
//delete data
$sth = $db-> query("DELETE FROM brand WHERE brandID=".$_GET['brandID']);
header('Location: list.php');
 ?>
