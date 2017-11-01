<?php
require_once('../../asset/connection/database.php');
//delete upload picture
$sth = $db->query("SELECT * FROM member WHERE memberID=".$_GET['memberID']);
$member = $sth->fetch(PDO::FETCH_ASSOC);
$picture = "../../upload/member/".$member['picture'];
unlink($picture);
//delete data
$sth = $db-> query("DELETE FROM member WHERE memberID=".$_GET['memberID']);
header('Location: list.php?page='.$_GET['page']);
 ?>
