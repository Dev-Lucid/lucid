<?php

lucid::$paths['scss'] = [
    lucid::$paths['base'].'/vendor/twbs/bootstrap/scss/',
    lucid::$paths['base'].'/vendor/fortawesome/font-awesome/scss/',
    lucid::$paths['app'].'media/scss/',
];

lucid::$scss_files = [
    'bootstrap','font-awesome','app',
];

lucid::$scss_production_build = lucid::$paths['app'].'media/scss/production.css';
