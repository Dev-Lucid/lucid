lucid.messages = {
    'divId':'#lucid-messages',
    'divHtml':'<div id="lucid-messages" class="alert alert-dismissible fade in" style="display: none;" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><div class="lucid-messages-body"></div></div>',
    'bodySelector':'.lucid-messages-body',
    'successClass':'alert-success',
    'errorClass':'alert-warning',
    'fadeInTime':200,
    'fadeOutTime':200,
    'successAutoClose':true,
    'errorAutoClose':false,
    'successAutoCloseTime':3500,
    'errorAutoCloseTime':6500,
    'autoCloseHandler':null
};

lucid.messages.show=function(status, messageList){

    var messageDiv = jQuery(lucid.messages.divId);
    if (messageDiv.length === 0){
        jQuery('body').append(lucid.messages.divHtml);
        messageDiv = jQuery(lucid.messages.divId);
    }

    var msg = '';
    if(lucid.stage == 'production'){
        if(messageList.length > 0){
            msg += messageList[0]; // only show the first error msg on development, presumed to be the general error msg
        }
    }else{
        // on all other stages, show the full list of errors
        for(var i=0;i<messageList.length;i++){
            console.log('Message: ' + messageList[i]);
            msg += '<p>' + messageList[i] + '</p>';
        }
    }

    if(msg !== ''){

        if (status == 'error') {
            messageDiv.addClass(lucid.messages.errorClass).removeClass(lucid.messages.successClass);
        } else {
            messageDiv.removeClass(lucid.messages.errorClass).addClass(lucid.messages.successClass);
        }

        if (lucid.messages[status+'AutoClose'] === true) {
            window.clearTimeout(lucid.messages.autoCloseHandler);
            lucid.messages.autoCloseHandler = window.setTimeout(function(){
                jQuery(lucid.messages.divId).fadeOut(lucid.messages.fadeOutTime);
            }, lucid.messages[status+'AutoCloseTime']);
        }

        messageDiv.find(lucid.messages.bodySelector).html(msg);
        messageDiv.hide().fadeIn(200);
    }
};