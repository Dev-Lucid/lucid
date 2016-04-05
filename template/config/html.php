<?php
use Lucid\Lucid;
use Lucid\Html\html;

html::init(lucid::logger(), 'bootstrap', [
    'lucid'=>realpath(__DIR__.'/../vendor/devlucid/lucid/html/').'/',
    'app'=>realpath(__DIR__.'/../app/').'/',
]);

html::$hooks['form__create'] = function ($obj) {
    $obj->onsubmit = 'return lucid.submit(this);';
};

html::$hooks['javascript'] = function($js) {
    lucid::response()->javascript($js);
};