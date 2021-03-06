var lucid = {
    'defaultRequest': '',
    'stage':'development',
    'lastFormSubmit':'',
    'formDisabledSubmitButtons':{},
    'currentView':null,
    'handlers':{}
};

lucid.setDefaultRequest=function(url){
    lucid.defaultRequest = url;
    jQuery('a.navbar-brand').attr('href', url);
};

lucid.init=function(){
    $(window).bind( 'hashchange', function(e) {
        if (window.location.hash != lucid.currentView){
            var newHash = (window.location.hash == '')?lucid.defaultRequest:window.location.hash;
            lucid.currentView = newHash;
            lucid.request(newHash);
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
        url = lucid.defaultRequest;
    }
    if(typeof(data) != 'object'){
        data = {};
    }
    url = String(url);
    if (url.substring(0,2) === '#!'){
        url = '/' + url.substr(2,url.length);
    }
    var parts = url.split('|');
    actionUrl = String(parts.shift());
    while(parts.length > 0){
        data[parts.shift()] = parts.shift();
    }

    console.log('Sending request to '+actionUrl);
    jQuery.ajax(actionUrl,{
        'cache':false,
        'data':data,
        'dataType':'json',
        'method':'POST',
        'complete':function(jqXHR, statusCode){
            lucid.response.json(jqXHR, statusCode);
            if(typeof(callback) == 'function'){
                callback(jqXHR, statusCode);
            }
        }
    });
};

lucid.submit=function(form){
    console.log('preparing to submit:');
    $form = jQuery(form);
    var data = lucid.getFormValues(form);
    lucid.ruleset.clearErrors(form);
    var result = lucid.ruleset.process($form.attr('name'), data);
    
    if (result === true){
        console.log('here, getting ready to submit to '+$form.attr('action'));
        data.__form_name = $form.attr('name');
        submitButtons = $form.find('input[type=submit],button[type=submit]');

        lucid.request($form.attr('action'), data, function(){
            submitButtons.each(function(){
                $(this).attr('disabled', null);
            });
        });
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
        console.log(xhr.responseJSON);
        var status = xhr.responseJSON.status;
        var data = xhr.responseJSON.data;

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
        lucid.messages.show(status, data.messages);
    }else{
        lucid.messages.show('error', ['Invalid response from server: '+statusCode]);
        console.log(xhr);
    }
    lucid.callHandlers('post-handleResponse', {'jqxhr':xhr, 'statusCode':statusCode});
};

lucid.updateHash=function(newHash){
    lucid.currentView = newHash;
    window.location.hash = newHash;
};
