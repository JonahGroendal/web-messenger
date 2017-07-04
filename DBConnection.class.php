<?php
require_once 'config.php';

class DBConnection {
  private $isRead = false;  /* unused functionality of message_recipient table */

  private $userId = null;   /* current logged in user */
  private $dbh = null;      /* PDO object */
  private $messagesQuery  = 'SELECT M.message_body, M.create_date FROM message M, message_recipient R WHERE M.id = R.message_id AND M.creator_id= ? and R.recipient_id= ? ORDER BY create_date DESC';

  function __construct() {
    session_start();
    // Always runs from the perspective of the logged in user
    $this->userId = $_SESSION['userId'];

    $host = DBHOST;
    $dbname = DBNAME;
    $user = DBUSER;
    $pass = DBPASS;
    $connString = "mysql:host=$host;dbname=$dbname";
    try {
      $this->dbh = new PDO($connString, $user, $pass);
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
      error_log("Error: ".$e);
      die ($e->getMessage());
    }
  }
  public function close() {
    $this->pdo = null;
  }
  public function getSentMessagesCursor($peerId) {
    if ($this->isFriend($peerId)) {
      $stmt = $this->dbh->prepare($this->messagesQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
      $stmt->execute(array($this->userId, $peerId));
      return $stmt;
    }
    else {
      error_log("Error: User $this->userId not friends with $peerId");
      return null;
    }
  }
  public function getReceivedMessagesCursor($senderID) {
    $stmt = $this->dbh->prepare($this->messagesQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->execute(array($senderID, $this->userId));
    return $stmt;
  }
  public function getContacts($peerName) {
    $contacts = array();
    $contactsCursor = $this->getContactsCursor($peerName);
    while ($contact = $contactsCursor->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){
      // check for new messages from contact
      if ($this->sentNewMessage($contact['id']))
        $contact['new_message_exists'] = true;
      else
        $contact['new_message_exists'] = false;

      array_push($contacts, $contact);
    }
    return $contacts;
  }
  public function getContactsCursor($peerName) {
    $sql = 'SELECT id, username, first_name, last_name, is_active FROM users WHERE first_name LIKE ? OR last_name LIKE ? ORDER BY first_name, last_name';
    $stmt = $this->dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->execute(array($peerName.'%', $peerName.'%'));
    return $stmt;
  }
  public function insertMessage($peerId, $message) {
    // Validate friendship
    if ( ! $this->isFriend($peerId)) {
      error_log("Error: User $this->userId not friends with $peerId");
      return;
    }

    $messageId = null;
    $prevMessageId = 'SELECT id FROM message WHERE id >= ALL(SELECT id FROM message)';
    $insMessage = 'INSERT INTO message (creator_id, message_body) VALUES(?, ?)';
    $insMessage_recipient = 'INSERT INTO message_recipient (recipient_id, message_id, is_read) VALUES(?, ?, ?)';

    try {
      $this->dbh->beginTransaction();
      // Insert message
      $stmt = $this->dbh->prepare($insMessage);
      $stmt->execute(array($this->userId, $message));
      // Get messageId
      $stmt = $this->dbh->query($prevMessageId);
      $row = $stmt->fetch();
      $messageId = $row[0];
      // Insert message_recipient
      $stmt = $this->dbh->prepare($insMessage_recipient);
      $stmt->execute(array($peerId, $messageId, $this->isRead));
      $this->dbh->commit();
    }
    catch (PDOException $e){
      $this->dbh->rollback();
      error_log("Error: ".$e);
    }
  }
  public function getPeerName($peerId) {
    if ($this->isFriend($peerId)) {
      $sql = 'SELECT first_name, last_name FROM users WHERE id= ?';
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute(array($peerId));
      $row = $stmt->fetch();
      return $row[0].' '.$row[1];
    }
    else {
      return null;
    }
  }
  public function markMessagesAsRead($peerId) {
    $sql = 'UPDATE message M INNER JOIN message_recipient MR ON M.id = MR.message_id SET MR.is_read = 1 WHERE MR.recipient_id = ? AND M.creator_id = ?';
    try {
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute(array($this->userId, $peerId));
    }
    catch (PDOException $e){
      error_log("Error: ".$e);
    }
  }
  private function isFriend($peerId) {
    return true;      //for now                                                               // Change this
    $sql = 'SELECT COUNT(*) FROM friendships WHERE (id1 = ? AND id2 = ?) OR (id1 = ? AND id2 = ?)';
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute(array($this->userId, $peerId, $peerId, $this->userId));
    $row = $stmt->fetch();
    if ($row[0] > 0) return true;
    else return false;
  }
  private function sentNewMessage($peerId) {
    $sql = 'SELECT COUNT(*) FROM message M INNER JOIN message_recipient MR ON M.id = MR.message_id WHERE M.creator_id = ? AND MR.recipient_id = ? and MR.is_read = 0';
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute(array($peerId, $this->userId));
    $row = $stmt->fetch();
    if ($row[0] > 0) return true;
    else return false;
  }
}

?>
