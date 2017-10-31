<?php
require_once('../../asset/connection/database.php');
$sth = $db-> query("DELETE FROM brand WHERE brandID=".$_GET['brandID']);
header('Location: list.php');
 ?>
