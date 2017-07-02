var search = document.getElementById("search");
search.addEventListener("keyup", function() {
  var alphaCharsOnly = new RegExp('^[a-zA-Z]*$'); // \\b[dog]+\b(?![,])          // doesnt work, fix this
  if (alphaCharsOnly.test(this.value)) {
    $("#contacts-display").load("ajax/getContacts.php?peerName="+this.value);
  }
});
$("#contacts-button").on("click", function() {
  // Load all contacts
  str = "";
  $("#contacts-display").load("ajax/getContacts.php?peerName="+str);
});

// The moment I converted to jQuery
$(document).on("click", '.contact', function() {
  // Change conversation
  document.cookie = "peerId="+this.value;
  // Clear messageBox
  messageBox.value = "";
  // Reload messages
  $("#message-display").load("ajax/getAllMessages.php");
  // Set new peerId in cookeis for display in header of main
  $.post("ajax/getPeerName.php", function(data) {
    document.cookie = "peerName="+data;
  });
  // hide contactsModal
  $("#myModal").modal("hide");
});
