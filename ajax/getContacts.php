<?php
require_once '../DBConnection.class.php';
require_once '../FormatData.class.php';
$peerName = $_GET['peerName'];
$db = new DBConnection();
$formatData = new FormatData();
$contacts = $db->getContactsCursor($peerName);

$retStr = '';
while ($contact = $contacts->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){
  $retStr .= $formatData->contactHTML($contact);
}
echo ($retStr);
?>
