<?php
require_once("../template/login_check.php");
require_once('../../asset/connection/database.php');
$sth = $db-> query("DELETE FROM boards_reply WHERE boards_replyID =".$_GET['boards_replyID']);
header('Location: list.php?page='.$_GET['page']);
 ?>
