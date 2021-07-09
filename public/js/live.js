var $messagesWrapper = $('#messages');

var $lastChat = 0;


// Append message to the wrapper,
// which holds the conversation.
var appendMessage = function (data) {
    var message = document.createElement('div');
    message.innerHTML = data.text;
    message.dataset.created_at = data.created_at;
    var msg = '<div class="direct-chat-msg">\
                    m<div class="direct-chat-info clearfix">\
                                            <span class="direct-chat-name pull-left">'+ data.user+'</span>\
                                            <span class="direct-chat-timestamp pull-right">'+ data.created_at + '</span>\
                                        </div>\
                                        <div class="direct-chat-text">'+data.text+'</div>\
                                    </div>';
    $messagesWrapper.append(msg);
};
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// Load messages from the server.
// After request is completed, queue
// another call
var updateMessages = function () {
    var lastMessage = $messagesWrapper.find('> div:last-child')[0];
    $.ajax({
        type: "POST",
        url: '/live-sazky',
        data: {
            from: $lastChat
        },
        success: function (messages) {
            $.each(messages, function () {
    $lastChat = this.created_at;
                appendMessage(this);
            });
        },
        error: function () {
            console.log('Ooops, something happened!');
        },
        complete: function () {
            window.setTimeout(updateMessages, 3000);
        },
        dataType: 'json'
    });
};

// Send message to server.
// Server returns this message and message
// is appended to the conversation.
var sendMessage = function (input) {
    if (input.value.trim() === '') {
        return;
    }

    input.disabled = true;
    $.ajax({
        type: "POST",
        url: '/live-sazky/chat',
        data: {message: input.value},
        success: function (message) {
            appendMessage(message);
        },
        error: function () {
            alert('Ooops, something happened!');
        },
        complete: function () {
            input.value = '';
            input.disabled = false;
        },
        dataType: 'json'
    });
};

// Send message to the servet on enter
$('#input').on('keypress', function (e) {
    // Enter is pressed
    if (e.charCode === 13) {
        e.preventDefault();
        sendMessage(this);
    }
});

// Start loop which get messages from server.
updateMessages();
