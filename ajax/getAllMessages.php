<?php
require_once '../DBConnection.class.php';
require_once '../FormatData.class.php';

$peerId = $_COOKIE['peerId'];                                                       // remember to check if peerId is a friend of userId

$db = new DBConnection();
$formatData = new FormatData();

/* create and initialize message objects */
$rMessages = $db->getReceivedMessagesCursor($peerId);
$sMessages = $db->getSentMessagesCursor($peerId);
$sMessage = $sMessages->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$rMessage = $rMessages->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

/* print HTML of all messages */
$retStr = "";
while ($sMessage || $rMessage) {
  if (!$sMessage) {
    $retStr .= $formatData->messageHTML($rMessage['message_body'], 'received');
    $rMessage = $rMessages->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
  }
  else if (!$rMessage){
    $retStr .= $formatData->messageHTML($sMessage['message_body'], 'sent');
    $sMessage = $sMessages->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
  }
  else if ($sMessage['create_date'] > $rMessage['create_date']) {
    $retStr .= $formatData->messageHTML($sMessage['message_body'], 'sent');
    $sMessage = $sMessages->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
  }
  else {
    $retStr .= $formatData->messageHTML($rMessage['message_body'], 'received');
    $rMessage = $rMessages->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
  }
}
echo $retStr;

/* mark messages as read if requested */
if (isset($_GET['markRead']) && $_GET['markRead'] == 'true')
  $db->markMessagesAsRead($peerId);

$db->close();
?>
