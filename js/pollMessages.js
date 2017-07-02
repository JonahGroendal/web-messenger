// Poll messages every second
// Save scroll position and reset it correctly
var scrollTopTemp;
window.setInterval(function(){
  $("#message-display").height($("#message-display").height());
  $("#message-display").load("ajax/getAllMessages.php");
  $("#header h2").html(readCookie("peerName"));
}, 1500);

// The scroll bullshit is there because (I think) when the ajax request loads,
// the scrollable area looses its conent for a split second and becomes not
// scrollable.
/*
var scrollTopTemp;
window.setInterval(function(){
  var scrollTopTemp = $("#message-display").scrollTop();
  $("#message-display").load("ajax/getAllMessages.php", function() {
    $("#message-display").scrollTop(scrollTopTemp);
  });
}, 1000);
$("#message-display").scroll(function() {
  if ($("#message-display").html().length) {
    scrollTopTemp = $("#message-display").scrollTop();
  }
});

*/
//  $("#message-display").css("min-height", function() {
//    return $(this).height();
//  });
