<?php
require_once '../DBConnection.class.php';

$db = new DBConnection();
$peerName = $db->getPeerName($_COOKIE['peerId']);

echo ($peerName);
?>
