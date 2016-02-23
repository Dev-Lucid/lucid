<?php

DevLucid\factory::init('bootstrap');

# ensure that any forms created by the library use the lucid.submit function
DevLucid\factory::$create_handlers['form'] = function($obj){
    $obj->attribute('onsubmit','return lucid.submit(this);');
};

DevLucid\factory::$create_handlers['input'] = function($obj){
    $obj->add_class('form-control');
};
