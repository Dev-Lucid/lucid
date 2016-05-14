<?php

# this is a good spot to use lucid::$stage to change your connection settings.
# The initial db config is setup to use a sqlite database, but this is almost
# certainly unsuitable for a production environment where you should be using
# an ACID compliant database. Try out Postgresql or Mysql!

use Lucid\Lucid;
\Model::$auto_prefix_models = 'App\\model\\';
\ORM::configure('caching', true);
\ORM::configure('caching_auto_clear', true);
\ORM::configure('logging', true);
\ORM::configure('logger', function ($logString, $queryTime) {
    lucid::$app->logger()->info($logString . ' in ' . $queryTime);
});

switch (lucid::$app->config()->string('stage')) {
    case 'development':
    case 'qa':
    case 'production':
        \ORM::configure('sqlite:'.__DIR__.'/../database/development.sqlite');
        break;
}