<?php
require_once('../../asset/connection/database.php');
$sth = $db-> query("DELETE FROM q_a_reply WHERE replyID=".$_GET['replyID']);
header('Location: list.php?cateID='.$_GET['cateID']);
 ?>
