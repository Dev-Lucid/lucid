<?php

namespace DevLucid;

include(__DIR__.'/../bootstrap.php');

if (isset($argv[0]) === true) {
    lucid::$queue->parseCommandLineAction($argv);
    lucid::$queue->process();
} else {
    lucid::$queue->parseRequestAction();
    lucid::$queue->process();
    lucid::$response->send();
}

exit();
