<?php

# this is a good spot to use lucid::$stage to change your connection settings.
# The initial db config is setup to use a sqlite database, but this is almost
# certainly unsuitable for a production environment where you should be using
# an ACID compliant database. Try out Postgresql or Mysql!

ORM::configure('sqlite:'.__DIR__.'/../db/development.sqlite');
