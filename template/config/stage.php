<?php
# Put your stage detection logic here. There are many good options available using $_SERVER or $_ENV
# You could consider using $_SERVER['SERVER_ADDR'] or $_SERVER['PORT'].
# The provided example uses the SERVER_SOFTWARE variable, which implies that the app is running using
# the inbuilt PHP Development server, which is only suitable for development.
#
# There's no limit on how many stages you can define, nor any real limit on how you detect your stage.
# Notably if you change stage names, you should search all of the code of anyplace that is hardcoded to
# use the old names. Likely places are app/index.php (for determining whether or not to compile the js/css),
# and config/db.php (for determining which db to connect to).

Lucid\Lucid::$app->config()->set('stage', 'production');

if (isset($_SERVER['APP_STAGE']) === true) {
    Lucid\Lucid::$app->config()->set('stage', $_SERVER['APP_STAGE']);
}
if (getenv('APP_STAGE') != '') {
    Lucid\Lucid::$app->config()->set('stage', getenv('APP_STAGE'));
}

