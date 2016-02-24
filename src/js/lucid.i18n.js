lucid.i18n = {
    'phrases':{
        'lucid:data_table:page_display':'Page :current of :max'
    }
}

function _(phrase, parameters){
    var phrase = String(lucid.i18n.phrases[phrase]);
    if(typeof(parameters) != 'object'){
        return phrase;
    }
    for(var key in parameters){
        phrase = phrase.replace(':'+key, parameters[key]);
    }
    return phrase;
}
