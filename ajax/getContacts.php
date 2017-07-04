<?php
require_once '../DBConnection.class.php';
require_once '../FormatData.class.php';
$peerName = $_GET['peerName'];
$db = new DBConnection();
$formatData = new FormatData();
$contacts = $db->getContacts($peerName);

$retStr = '';
foreach ($contacts as $contact) {
  $retStr .= $formatData->contactHTML($contact);
}
echo ($retStr);
?>
