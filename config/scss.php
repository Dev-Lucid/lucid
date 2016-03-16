<?php

namespace DevLucid;

lucid::$paths['scss'] = [
    lucid::$paths['base'].'/vendor/twbs/bootstrap/scss/',
    lucid::$paths['base'].'/vendor/fortawesome/font-awesome/scss/',
    lucid::$paths['lucid'].'/src/scss/',
    lucid::$paths['base'].'/vendor/devlucid/html/src/bootstrap/scss/',
    lucid::$paths['base'].'/vendor/devlucid/datetimepicker/',
    lucid::$paths['app'].'/media/scss/',
];

lucid::$scssFiles = [
    'bootstrap','font-awesome','factory_bootstrap','lucid','jquery.datetimepicker','app',
];

lucid::$scssProductionBuild = lucid::$paths['app'].'/media/scss/production.css';

# This is needed to fix the path for font-awesome.
lucid::$scssStartSource = '$fa-font-path: "/media/fonts";'."\n";
