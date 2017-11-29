<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
$sth = $db-> query("DELETE FROM specification WHERE specID=".$_GET['specID']);
header('Location: list.php');
 ?>
