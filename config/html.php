<?php

DevLucid\factory::init('bootstrap');

DevLucid\factory::add_path('lucid',__DIR__.'/../factory/');
class_alias('\DevLucid\factory_lucid', 'html');

# ensure that any forms created by the library use the lucid.submit function
DevLucid\factory::$create_handlers['form'] = function($obj){
    $obj->attribute('onsubmit','return lucid.submit(this);');
};

DevLucid\factory::$create_handlers['input'] = function($obj){
    $obj->add_class('form-control');
};
