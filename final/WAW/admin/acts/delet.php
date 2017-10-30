<?php
require_once('../../asset/connection/database.php');
$sth = $db-> query("DELETE FROM acts WHERE actID=".$_GET['actID']);
header('Location: list.php');
 ?>
