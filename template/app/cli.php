<?php
use Lucid\Lucid;
include(__DIR__.'/../bootstrap.php');

# This respone class's output is a bit prettier for the command line
lucid::setComponent('response', new \Lucid\Component\Response\CommandLine());

# Since cookies cannot be written when called on the command line, replace the cookie store
# with a generic store.
lucid::setComponent('cookie',   new \Lucid\Component\Store\Store());

lucid::queue()->parseCommandLineAction($argv);
lucid::queue()->process();
lucid::response()->write();