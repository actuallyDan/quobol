$(document).ready(function () {

    // channel and user info
    var channel = $('#toggleFollowEvent').attr('data-event-id');//;localStorage.getItem("pn-subscriptions")
    var user = $('#currentUser').text();
    channel = parseInt(channel, 10);
    var myProfilePic = $('#myProfilePic').attr('src');
    //use below for auto scrolling to bottom
   // $('#messageList').scrollTop($('#messageList').prop("scrollHeight"));

//////////BEGIN PUBNUB API STUFF///////////////
   // Initialize the PubNub API connection.

   var pubnub = PUBNUB.init({
    publish_key: 'pub-c-41d3c31e-a047-4781-99d6-57347ecbbe7f',
    subscribe_key: 'sub-c-6883526e-bfed-11e5-bcee-0619f8945a4f',
    uuid: user,
  });

  // Grab references for all of our elements.
  var messageContent = $('#messageContent'),
  sendMessageButton = $('#sendMessageButton'),
  messageList = $('#messageList');

  // Handles all the messages coming in from pubnub.subscribe.
  function handleMessage(message) {

    if (message.username === user) {
      appearance = "myMessageCss";
      namePosition = "right";
    } else {
      appearance = "otherMessageCss";
      namePosition = "left";

    }
    var currentdate = new Date();
    var time = currentdate.getHours() + ":"+ currentdate.getMinutes();

    var messageEl = $("<div class='messageWrapper'><div class='message'> <span class='clickToShowTime'> <img src='" +  myProfilePic + "' class='circle " + namePosition + "' height='40px' width='40px'></img> <li class='card-panel " + appearance  + " "+ namePosition +"'>"+ message.text + "</li> <br><br> </span></div></div>");
    messageList.append(messageEl);

   // messageList.listview('refresh');

    // Scroll to bottom of page
    // $("html, body").animate({ scrollTop: $(document).height() - $(window).height() }, 'slow');
  }
  
  // Compose and send a message when the user clicks our send message button.
  sendMessageButton.click(function (event) {
    var message = messageContent.val();
    if (message !== '') {

      //save the message with AJAX
      var ajaxurl = 'event.php';
      data =  {'saveMessage': 'true', 'event_id': channel, 'msg': message };
      $.post(ajaxurl, data, function (response) {
          // Response div goes here.
      });

      //send the message            
      pubnub.publish({
        channel: channel,
        message: {
          username: user,
          text: message
        },
        error: function(e){
          alert('Error sending message. Please try again later');
        }
      });

      messageContent.val("");

      //$("#messageList").scrollTop($("#messageList")[0].scrollHeight);

    }
  });

  // Also send a message when the user hits the enter button in the text area.
  messageContent.bind('keydown', function (event) {
    if((event.keyCode || event.charCode) !== 13) return true;
    sendMessageButton.click();
    return false;
  });

  // Subscribe to messages coming in from the channel.
  pubnub.subscribe({
    channel: channel,
    message: handleMessage,
    error: function(e){console.log(e)}, 
    connect: function(){console.log("Connected")},
    disconnect: function(){console.log("Disconnected")},
    reconnect: function(){console.log("Reconnected")}, 
    // presence: function(m){console.log(m);}

  });


});