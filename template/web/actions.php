<?php
use Lucid\Lucid;
include(__DIR__.'/../bootstrap.php');
lucid::$app->queue()->parseRequestAction(lucid::$app->request());
lucid::$app->queue()->process();
lucid::$app->response()->write();