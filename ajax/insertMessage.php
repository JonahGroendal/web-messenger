<?php
require_once '../config.php';
require_once '../DBConnection.class.php';


$db = new DBConnection();
$db->insertMessage($_COOKIE['peerId'], $_POST['message']);
$db->close();
?>
