<?php
date_default_timezone_set('UTC');
session_start();

include(__DIR__.'/vendor/autoload.php');

$configs = [];
if (defined('__LOAD_STAGE__') === false or __LOAD_STAGE__ === true) {
    $configs[] = 'stage';
}
if (defined('__LOAD_LOGGER__') === false or __LOAD_LOGGER__ === true) {
    $configs[] = 'monolog';
}
if (defined('__LOAD_DB__') === false or __LOAD_DB__ === true) {
    $configs[] = 'db';
}
if (defined('__LOAD_I18N__') === false or __LOAD_I18N__ === true) {
    $configs[] = 'i18n';
}
if (defined('__LOAD_HTML__') === false or __LOAD_HTML__ === true) {
    $configs[] = 'html';
}
DevLucid\lucid::init($configs);
