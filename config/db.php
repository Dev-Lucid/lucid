<?php
namespace DevLucid;

# there only needs to be one path for models since they are regenerated via a script anyway
lucid::$paths['models'] = lucid::$paths['base'].'/db/models/';
\Model::$auto_prefix_models = 'Model';
\ORM::configure('caching', true);
\ORM::configure('caching_auto_clear', true);
\ORM::configure('logging', true);
\ORM::configure('logger', function ($logString, $queryTime) {
    lucid::log($logString . ' in ' . $queryTime);
});

# setup an autoloader for our model path
spl_autoload_register( function ($modelName) {

    if (strpos($modelName, \Model::$auto_prefix_models) === 0) {

        $modelName = substr(
            $modelName,
            strlen(\Model::$auto_prefix_models),
            strlen($modelName)
        );
        include(lucid::$paths['models'].'/'.$modelName.'.php');
    }
});

# Setup a handler that is called by lucid::model();
lucid::$ormFunction = function ($modelName) {
    return \Model::factory($modelName);
};
