<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
$sth = $db-> query("DELETE FROM q_a_category WHERE categoryID=".$_GET['cateID']);
$sth = $db-> query("DELETE FROM q_a_reply WHERE categoryID=".$_GET['cateID']);
header('Location: list.php');
 ?>
