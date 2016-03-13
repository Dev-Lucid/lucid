<?php



\DevLucid\html::init('bootstrap',[
    'prefix'=>'lucid',
    'path'=>realpath(__DIR__.'/../html/')
]);

\DevLucid\html::$logger = \DevLucid\lucid::$logger;

\DevLucid\html::$hooks['form__create'] = function ($obj) {
    $obj->onsubmit = 'return lucid.submit(this);';
};
