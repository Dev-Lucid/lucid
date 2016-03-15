var lucid = {
    'defaultRequest': '',
    'entryUrl':'app.php',
    'stage':'development',
    'errorHtml':'<div id="lucid-error" class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span id="lucid-error-msg"></span></div>',
    'lastFormSubmit':'',
    'currentView':null,
    'handlers':{}
};

lucid.init=function(){
    $(window).bind( 'hashchange', function(e) {
        if (window.location.hash != '' && window.location.hash != lucid.currentView){
            lucid.currentView = window.location.hash;
            lucid.request(window.location.hash);
        }
    });
    lucid.request((window.location.hash == '')?lucid.defaultRequest:window.location.hash);
};

lucid.addHandler=function(action, callback){
    if(typeof(lucid.handlers[action]) != 'object'){
        lucid.handlers[action] = [];
    }
    lucid.handlers[action].push(callback);
};

lucid.callHandlers=function(action, parameters){
    if(typeof(lucid.handlers[action]) == 'object'){
        for(var i=0;i<lucid.handlers[action].length;i++){
            lucid.handlers[action][i](parameters);
        }
    }
};

lucid.request=function(url, data, callback){
    if(url === ''){
        return;
    }
    if(typeof(data) != 'object'){
        data = {};
    }
    url = String(url);
    url = url.substr(2,url.length);
    var parts = url.split('|');
    data.action = parts.shift();
    while(parts.length > 0){
        data[parts.shift()] = parts.shift();
    }

    console.log('Sending request to '+lucid.entryUrl+'?action='+data.action);
    jQuery.ajax(lucid.entryUrl,{
        'cache':false,
        'data':data,
        'dataType':'json',
        'method':'POST',
        'complete':function(jqXHR, statusCode){
            lucid.handleResponse(jqXHR, statusCode);
            if(typeof(callback) == 'function'){
                callback(jqXHR, statusCode);
            }
        }
    });
};

lucid.submit=function(form){
    $form = jQuery(form);
    var data = lucid.getFormValues(form);
    lucid.ruleset.clearErrors(form);
    var result = lucid.ruleset.process($form.attr('name'), data);

    if (result === true){
        data.__form_name = $form.attr('name');
        lucid.request($form.attr('action'), data);
    }
    return false;
};

lucid.getFormValues=function(form){
    var values = {};
    for ( var i = 0; i < form.elements.length; i++ ) {
        var e = form.elements[i];
        switch (e.type) {
            case 'text':
            case 'date':
            case 'range':
            case 'email':
            case 'textarea':
            case 'password':
            case 'hidden':
                values[e.name] = e.value;
                break;
            case 'radio':
                if (e.checked) {
                    values[e.name] = e.value;
                }
                break;
            case 'checkbox':
                values[e.name] = (e.checked);
                break;
            case 'select-one':
                if(e.options.length > 0){
                    values[e.name] = e.options[e.selectedIndex].value;
                }else{
                    values[e.name] = null;
                }
                break;

            case 'select-multiple':
                values[e.name] = [];
                if(e.options.length >0){
                    for(var j=0;j<e.options.length;j++){
                        if(e.options[j].selected === true){
                            values[e.name].push(e.options[j].value);
                        }
                    }
                }
                break;
            case 'button':
            case 'submit':
                // don't need to do anything for these types
                break;
            case 'fieldset':
                //ignore these
                break;
            default:
                console.log('lucid.getFormValues doesn\'t have a switch statement to handle inputs of type \'' + e.type+'\', but will try to use this element\'s .value property as a default. ');
                values[e.name] = e.value;
                break;
        }
    }
    return values;
};

lucid.handleResponse=function(xhr, statusCode){
    lucid.callHandlers('pre-handleResponse', {'jqxhr':xhr, 'statusCode':statusCode});
    if (statusCode == 'success'){
        var data = xhr.responseJSON;

        if (data.preJavascript !== ''){
            try{
                eval(data.preJavascript);
            }
            catch(e){
                console.log('Error executing preJavascript: ' + e.message);
                console.log(data.preJavascript);
            }
        }

        if (data.title !== null){
            jQuery('title').html(data.title);
        }

        if (data.keywords !== null){
            jQuery('meta[name=keywords]').attr('content', data.keywords);
        }

        if (data.description !== null){
            jQuery('meta[name=description]').attr('content', data.description);
        }

        for(var key in data.replace){
            jQuery(key).html(data.replace[key]);
        }
        for(var key in data.append){
            jQuery(key).append(data.append[key]);
        }
        for(var key in data.prepend){
            jQuery(key).prepend(data.prepend[key]);
        }
        if (data.postJavascript !== ''){
            try{
                eval(data.postJavascript);
            }
            catch(e){
                console.log('Error executing postJavascript: ' + e.message);
                console.log(data.postJavascript);
            }
        }
        lucid.handleErrors(data.errors);
    }else{
        lucid.handleErrors(['Invalid response from server: '+statusCode]);
        console.log(xhr);
    }
    lucid.callHandlers('post-handleResponse', {'jqxhr':xhr, 'statusCode':statusCode});
};

lucid.handleErrors=function(errorList){
    var error = jQuery('#lucid-error');
    if (error.length === 0){
        jQuery('body').append(lucid.errorHtml);
        error = jQuery('#lucid-error');
    }

    var msg = '';

    if(lucid.stage == 'production'){
        if(errorList.length > 0){
            msg += errorList[0]; // only show the first error msg on development, presumed to be the general error msg
        }
    }else{
        // on all other stages, show the full list of errors
        for(var i=0;i<errorList.length;i++){
            console.log('Error: ' + errorList[i]);
            msg += '<p>' + errorList[i] + '</p>';
        }
    }
    if(msg !== ''){
        error.find('#lucid-error-msg').html(msg);
        error.fadeIn(200);
    }
};

lucid.updateHash=function(newHash){
    lucid.currentView = newHash;
    window.location.hash = newHash;
};
