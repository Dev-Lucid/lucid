<?php

# there only needs to be one path for models since they are regenerated via a script anyway
lucid::$paths['models'] = lucid::$paths['base'].'/db/models/';
Model::$auto_prefix_models = 'lucid_model_';
ORM::configure('logging', true);
ORM::configure('logger', function($log_string, $query_time) {
    \lucid::log($log_string . ' in ' . $query_time);
});

# setup an autoloader for our model path
spl_autoload_register(function($model_name){
    if (strpos($model_name,Model::$auto_prefix_models) === 0){
        $model_name = substr(
            $model_name,
            strlen(Model::$auto_prefix_models),
            strlen($model_name)
        );
        include(lucid::$paths['models'].'/'.$model_name.'.php');
    }
});

# Setup a handler that is called by lucid::model();
lucid::$orm_function = function($model_name)
{
    return Model::factory($model_name);
};
