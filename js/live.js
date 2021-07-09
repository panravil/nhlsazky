  $(document).ready(function() {

 	 $("#live-tikety").load("/modules/live-sazky-tikety.php");

   var refreshId = setInterval(function() {

      $("#live-tikety").load('/modules/live-sazky-tikety.php?randval='+ Math.random());

   }, 2000);

   $.ajaxSetup({ cache: false });

});

 

 $(document).ready(function() {

 	 $("#chat-status").load("/modules/chat-status.php");

   var refreshId = setInterval(function() {

      $("#chat-status").load('/modules/chat-status.php?randval='+ Math.random());

   }, 10000);

   $.ajaxSetup({ cache: false });

});



 $(document).ready(function() {

 	 $("#chat-div").load("/modules/chat-zpravy.php");

   var refreshId = setInterval(function() {

      $("#chat-div").load('/modules/chat-zpravy.php?randval='+ Math.random());

   }, 4000);

   $.ajaxSetup({ cache: false });

});





function Smile(what)

{

  document.forms.add.text.focus();

  document.forms.add.text.value=document.forms.add.text.value+what;

}



 $(document).ready(function() {

 	 $("#stream-div").load("/modules/stream-zpravy.php");

   var refreshId = setInterval(function() {

      $("#stream-div").load('/modules/stream-zpravy.php?randval='+ Math.random());

   }, 4000);

   $.ajaxSetup({ cache: false });

});



$(document).ready(function() {

$('#form-stream').on('submit', function(e){

e.preventDefault();

  var proceed = true;

  if(proceed)

  {

  post_data = {

  'zprava'		: $('input[name=zprava]').val(),

  };

  //Ajax post data to server

  $.post('/modules/vlozit-zpravu-stream.php', post_data, function(response){

  if(response.type == 'error'){ //load json data from server and output message

  output = '<div class="hlaska_err">'+response.text+'</div>';

  } else {

  output = '<div class="hlaska_ok">'+response.text+'</div>';

  $("#form-stream  input[name=zprava]").val('');    //reset values in all input fields

  }

  $("#form-stream #contact_results").html(output).show().delay(3000).fadeOut(); //skrytí za 3 sec

  }, 'json');

  }

  });

});















$(document).ready(function() {

$('#form-tiket').on('submit', function(e){

e.preventDefault();

  var proceed = true;

  if(proceed)

  {

  post_data = {

  'zapas'		: $('input[name=zapas]').val(),

  'tip'		: $('input[name=tip]').val(),

  'kurz'		: $('input[name=kurz]').val(),

  'vklad'		: $('input[name=vklad]').val(),

  };
  console.log(post_data);

  //Ajax post data to server

  $.post('/modules/vlozit-tiket.php', post_data, function(response){

  if(response.type == 'error'){ //load json data from server and output message

  output = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span> '+response.text+'</div>';

  } else {

  output = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span> '+response.text+'</div>';

  $("#form-tiket  input").val('');    //reset values in all input fields



  }

  $("#form-tiket #contact_results2").html(output).show().delay(3000).fadeOut(); //skrytí za 3 sec

  }, 'json');

  }

  });

});



$(document).ready(function() {

$('#form-chat').on('submit', function(e){

e.preventDefault();

  var proceed = true;

  if(proceed)

  {

  post_data = {

  'zprava'		: $('input[name=zprava]').val(),

  };

  //Ajax post data to server

  $.post('/modules/vlozit-zpravu.php', post_data, function(response){

  if(response.type == 'error'){ //load json data from server and output message

  output = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span> '+response.text+'</div>';

  } else {

  output = '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span> '+response.text+'</div>';

  $("#form-chat  input[name=zprava]").val('');    //reset values in all input fields

  }

  $("#form-chat #contact_results").html(output).show().delay(3000).fadeOut(); //skrytí za 3 sec

  }, 'json');

  }

  });

});











      var soundfile = "http://nhlsazeni.cz/notifikace.mp3";

			var sendReq = getXmlHttpRequestObject();

			var receiveReq = getXmlHttpRequestObject();

			var lastMessage = 0;

			var mTimer;



function playSound() {

if (document.getElementById('isSound').checked===true) {

document.getElementById("dummy").innerHTML = "<audio autoplay='autoplay' src=\"" + soundfile + "\"/>";

}

}

      

			//Function for initializating the page.

			function startChat() {

				//Set the focus to the Message Box.



				//Start Recieving Messages.

				getChatText();

			}

			//Gets the browser specific XmlHttpRequest Object

			function getXmlHttpRequestObject() {

				if (window.XMLHttpRequest) {

					return new XMLHttpRequest();

				} else if(window.ActiveXObject) {

					return new ActiveXObject("Microsoft.XMLHTTP");

				} else {

					document.getElementById('p_status').innerHTML = 'Status: Cound not create XmlHttpRequest Object.  Consider upgrading your browser.';

				}

			}

			

			//Gets the current messages from the server

			function getChatText() {

				if (receiveReq.readyState == 4 || receiveReq.readyState == 0) {

					receiveReq.open("GET", '/getChat.php?chat=1&last=' + lastMessage, true);

					receiveReq.onreadystatechange = handleReceiveChat;

					receiveReq.send(null);

				}

			}



			//Function for handling the return of chat text

			function handleReceiveChat() {

				if (receiveReq.readyState == 4) {

					var chat_div = document.getElementById('div_chat');

					var xmldoc = receiveReq.responseXML;

					var message_nodes = xmldoc.getElementsByTagName("message");

					var n_messages = message_nodes.length

					for (i = 0; i < n_messages; i++) {





						lastMessage = (message_nodes[i].getAttribute('id'));

					           playSound();

          }

					mTimer = setTimeout('getChatText();',2000); //Refresh our chat in 2 seconds

          

				}

			}



			//This function handles the response after the page has been refreshed.

			function handleResetChat() {

				document.getElementById('div_chat').innerHTML = '';

				getChatText();

			}