<?php

# this is a good spot to use lucid::$stage to change your connection settings.
# The initial db config is setup to use a sqlite database, but this is almost
# certainly unsuitable for a production environment where you should be using
# an ACID compliant database. Try out Postgresql or Mysql!

lucid::$db_stages = [
    'development'=>[
        'adapter'=>'sqlite',
        'name'=>lucid::$paths['base'].'/db/development.sqlite',
    ],
    'qa'=>[
        'adapter'=>'sqlite',
        'name'=>lucid::$paths['base'].'/db/development.sqlite',
    ],
    'production'=>[
        'adapter'=>'sqlite',
        'name'=>lucid::$paths['base'].'/db/development.sqlite',
    ],
];


switch(lucid::$stage)
{
    case 'development':
        ORM::configure('sqlite:'.lucid::$db_stages['development']['name']);
        break;
    case 'qa':
        ORM::configure('sqlite:'.lucid::$db_stages['qa']['name']);
        break;
    case 'production':
        ORM::configure('sqlite:'.lucid::$db_stages['production']['name']);
        break;
}

