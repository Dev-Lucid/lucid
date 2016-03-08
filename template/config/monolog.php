<?php

lucid::$logger = new Monolog\Logger('lucid');

$handler = new Monolog\Handler\StreamHandler(__DIR__.'/../debug.log');

$format  = '[%datetime%] ';
$format .= '['.str_pad(session_id(),32,' ',STR_PAD_RIGHT).'] ';


$ip = (isset($_SERVER['REMOTE_ADDR']))?$_SERVER['REMOTE_ADDR']:'127.0.0.1';
$format .= '['.str_pad($ip,15,' ',STR_PAD_RIGHT).'] ';
$format .= "%level_name%: %message%\n";

$handler->setFormatter(new Monolog\Formatter\LineFormatter($format));
lucid::$logger->pushHandler($handler);

lucid::log()->info('------------------------------------------------');
