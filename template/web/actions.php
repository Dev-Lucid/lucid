<?php
use Lucid\Lucid;
include(__DIR__.'/../bootstrap.php');
lucid::queue()->parseRequestAction();
lucid::queue()->process();
lucid::response()->write();