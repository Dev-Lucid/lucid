var lucid = {
    'entryUrl':'app.php',
    'stage':'development',
    'errorHtml':'<div id="lucid-error" class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span id="lucid-error-msg"></span></div>',
};

lucid.init=function(){
    console.log('lucid.js init called');
    $(window).bind( 'hashchange', function(e) {
        lucid.request(window.location.hash);
    });
};

lucid.request=function(url, data){
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

    jQuery.ajax(lucid.entryUrl,{
        'cache':false,
        'data':data,
        'dataType':'json',
        'method':'POST',
        'complete':lucid.handleResponse
    });
};

lucid.submit=function(form){
    $form = jQuery(form);
    lucid.request($form.attr('action'), lucid.getFormValues(form));
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
                values[e.name] = e.options[e.selectedIndex].value;
                break;

            case 'select-multiple':
                values[e.name] = [];
                for(var j=0;j<e.options.length;j++){
                    if(e.options[j].selected === true){
                        values[e.name].push(e.options[j].value);
                    }
                }
                break;

            case 'button':
            case 'submit':
                // don't need to do anything for these types
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
        console.log('got response back, status='+statusCode);
        console.log(xhr);
    }
};

lucid.handleErrors=function(errorList){
    console.log('handling errors:');
    console.log(errorList);
    var error = jQuery('#lucid-error');
    if (error.length === 0){
        jQuery('body').append(lucid.errorHtml);
        error = jQuery('#lucid-error');
    }

    var msg = '';
    if(lucid.stage == 'production'){
        msg += errorList[0]; // only show the first error msg on development, presumed to be the general error msg
    }else{
        // on all other stages, show the full list of errors
        for(var i=0;i<errorList.length;i++){
            msg += '<p>' + errorList[i] + '</p>';
        }
    }
    error.find('#lucid-error-msg').html(msg);
    error.fadeIn(200);
};
