<?php
use Lucid\Lucid;
use Lucid\Html\html;

html::init(lucid::config(), 'bootstrap');
html::addFlavor('lucid', realpath(__DIR__.'/../vendor/devlucid/lucid/html/').'/');
html::addFlavor('app', realpath(__DIR__.'/../app/').'/');

html::$config->get('hooks')['form__create'] = function ($obj) {
    $obj->onsubmit = 'return lucid.submit(this);';
};

html::$config->get('hooks')['javascript'] = function($js) {
    lucid::response()->javascript($js);
};