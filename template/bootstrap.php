<?php
# This enables the composer autoloader
include(__DIR__.'/vendor/autoload.php');

# load various configs
include('config/stage.php');
include('config/logger.php');
include('config/db.php');
include('config/html.php');

# set the defaults for the container
Lucid\lucid::setMissingComponents();