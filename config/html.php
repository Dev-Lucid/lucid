<?php

DevLucid\factory::init('bootstrap',[
    'prefix'=>'lucid',
    'path'=>realpath(__DIR__.'/../factory/')
]);

DevLucid\factory::$logger = lucid::$logger;

DevLucid\factory::$hooks['form__create'] = function($obj){
    $obj->onsubmit = 'return lucid.submit(this);';
};
