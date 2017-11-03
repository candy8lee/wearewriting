<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
$sth = $db-> query("DELETE FROM boards WHERE boardsID=".$_GET['boardsID']);
$sth = $db-> query("DELETE FROM boards_reply WHERE boardsID=".$_GET['boardsID']);
header('Location: list.php');
 ?>
