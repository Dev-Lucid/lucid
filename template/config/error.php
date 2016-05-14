<?php
use Lucid\Lucid;

Lucid::$app['config']['factory/sendE3rrors'] = function($errorList) {
    Lucid::$app->logger()->warning('successfully called sendErrors hook!');
};

use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\Handler;

$run     = new Whoops\Run;
$handler = new PrettyPageHandler;

// Add some custom tables with relevant info about your application,
// that could prove useful in the error page:
$handler->addDataTable('Killer App Details', array(
  "Important Data" => 'some data',
  "Thingamajig-id" => 'some id'
));

// Set the title of the error page:
$handler->setPageTitle("Whoops! There was a problem.");

$run->popHandler();

// Add a special handler to deal with AJAX requests with an
// equally-informative JSON response. Since this handler is
// first in the stack, it will be executed before the error
// page handler, and will have a chance to decide if anything
// needs to be done.
$run->pushHandler(function($exception, $inspector, $run) {
    Lucid::$app->response()->message($exception->getMessage());
    Lucid::$app->response()->write('error');
    #var_dump($exception->getMessage());
    return Handler::DONE;
});

#$run->pushHandler(new JsonResponseHandler);


// Register the handler with PHP, and you're set!
$run->register();
