<?php

return [
    [ 'title'=>'Home', 'file'=>'index', 'children'=>[
        [ 'title'=>'Overview', 'file'=>'lucid/overview',],
        [ 'title'=>'Maintenance', 'file'=>'lucid/maintenance',],
        [ 'title'=>'Deployments', 'file'=>'lucid/deployments',],
        [ 'title'=>'Workflow', 'file'=>'lucid/workflow',],
    ]],
    [ 'title'=>'My App', 'file'=>'app', 'children'=>[
        [ 'title'=>'Models', 'file'=>'models',],
        [ 'title'=>'Views', 'file'=>'views',],
        [ 'title'=>'Controllers', 'file'=>'controllers',],
    ]],
];