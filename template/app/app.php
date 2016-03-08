<?php

include(__DIR__.'/../bootstrap.php');
lucid::process_actions();
lucid::$response->send();
