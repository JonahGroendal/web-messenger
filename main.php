<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Web Chat</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <div id="header">
    <h2><!-- peerName displays here via AJAX --></h2>
  </div>
  <div id="message-display">
    <!-- Messages display here via AJAX -->

  </div>
  <div id="footer">
    <button type="button" id="contacts-button" data-toggle="modal" data-target="#myModal">Open Contacts</button>
    <?php require_once 'contactsModal.php'; ?>
    <textarea name="messageArea" autofocus></textarea>
    <button id="send" type="button" class="btn btn-default"/>Send</button>
  </div>
  <!-- scripts -->
  <script type="text/javascript" src="js/cookieFuncs.js"></script>
  <script type="text/javascript" src="js/send.js"></script>
  <script type="text/javascript" src="js/contacts.js"></script>
  <script type="text/javascript" src="js/pollMessages.js"></script>
</body>
</html>
