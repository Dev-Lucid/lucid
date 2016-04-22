<?php
use Lucid\lucid;

# This enables the composer autoloader
include('vendor/autoload.php');

# Prepare the dependency injection container


# load various configs
include('config/stage.php');
include('config/logger.php');
include('config/db.php');
include('config/html.php');

# set the defaults for the container
lucid::setMissingComponents();

