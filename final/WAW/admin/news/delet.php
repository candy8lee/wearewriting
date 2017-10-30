<?php
require_once('../../asset/connection/database.php');
$sth = $db-> query("DELETE FROM news WHERE newsID=".$_GET['newsID']);
header('Location: list.php');
 ?>
