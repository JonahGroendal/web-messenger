<?php
class FormatData {
  public function messageHTML($messageBody, $type) {
    $retStr = '';
    if ($type == 'sent') {
      $retStr .= '<div class="message message-sent">'."\n";
    }
    else if ($type == 'received') {
      $retStr .= '<div class="message message-received">'."\n";
    }
    else {
      return 'Error: Invalid message type'."\n";
    }
    $retStr .= '<p>'.nl2br($messageBody).'</p>'."\n";
    $retStr .= '</div>'."\n";

    return $retStr;
  }
  public function contactHTML($contact) {
    $retStr  = '<button type="button" value="'.$contact['id'].'" class="contact btn btn-default">'."\n";
    $retStr .= '  <div class="name">'."\n";
    $retStr .= '    '.$contact['first_name'].' '.$contact['last_name']."\n";
    $retStr .= '  </div>'."\n";
    $retStr .= '</button>'."\n";
    return $retStr;
  }
}
?>
