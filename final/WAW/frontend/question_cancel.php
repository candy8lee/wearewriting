<?php
require_once('../asset/connection/database.php');
$sth = $db-> query("UPDATE member_question SET status=99 WHERE questionID=".$_GET['questionID']);
header('Location: member_question.php');
?>
