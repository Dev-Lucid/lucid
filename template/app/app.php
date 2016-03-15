<?php

namespace DevLucid;

include(__DIR__.'/../bootstrap.php');

if (isset($argv[0]) === true) {
    lucid::processCommandLineAction($argv);
    lucid::processActions();
} else {
    lucid::processActions();
    lucid::$response->send();
}

exit();
