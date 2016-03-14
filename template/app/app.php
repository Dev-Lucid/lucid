<?php

namespace DevLucid;

include(__DIR__.'/../bootstrap.php');

if (isset($argv[0]) === true) {
    lucid::process_command_line_action($argv);
    lucid::process_actions();
} else {
    lucid::process_actions();
    lucid::$response->send();
}

exit();
