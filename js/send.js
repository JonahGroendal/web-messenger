var send = document.getElementById('send');
var messageBox = document.querySelector("textarea[name=messageArea]");
var messageDisplay = document.getElementById("message-display");

// Trigger send when send button is pressed
send.addEventListener('click', function() {
  if (messageBox.value !== "") {
    sendIt();
  }
});
// Or trigger send when 'enter'(13) is pressed but not when 'shift+enter'(16+13) are pressed
var keymap = {16: false, 13: false};
messageBox.addEventListener('keydown', function(e) {
  if (e.keyCode in keymap) {
        keymap[e.keyCode] = true;
        if (keymap[13] && !keymap[16] && messageBox.value !== "") {
            e.preventDefault(); // Otherwise a newline will be in textbox after send
            sendIt();
        }
    }
});
messageBox.addEventListener('keyup', function(e) {
  if (e.keyCode in keymap) {
        keymap[e.keyCode] = false;
    }
});

// Send message
function sendIt() {
  // Send insertMessage.php request
  $.post("ajax/insertMessage.php", {message: messageBox.value});
  // Clear messageBox
  messageBox.value = "";
  // Reload messages
  $("#message-display").load("ajax/getAllMessages.php", function() {
    //reset message-display
    messageDisplay.scrollTop = messageDisplay.scrollHeight;
  });
}
