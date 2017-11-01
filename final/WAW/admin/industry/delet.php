<?php
require_once('../../asset/connection/database.php');
//delete data
$sth = $db-> query("DELETE FROM industry WHERE industryID=".$_GET['industryID']);
header('Location: list.php');
 ?>
