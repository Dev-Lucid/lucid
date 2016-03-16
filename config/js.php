<?php

namespace DevLucid;

lucid::$jsFiles = [
    lucid::$paths['base'].'/vendor/twbs/bootstrap/docs/assets/js/vendor/jquery.min.js',
    lucid::$paths['base'].'/vendor/twbs/bootstrap/docs/assets/js/vendor/tether.min.js',
    lucid::$paths['base'].'/vendor/twbs/bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js',
    lucid::$paths['base'].'/vendor/twbs/bootstrap/dist/js/bootstrap.min.js',
    lucid::$paths['base'].'/vendor/devlucid/lucid/src/js/lucid.js',
    lucid::$paths['base'].'/vendor/devlucid/lucid/src/js/lucid.ruleset.js',
    lucid::$paths['base'].'/vendor/devlucid/lucid/src/js/lucid.dataTable.js',
    lucid::$paths['base'].'/vendor/devlucid/lucid/src/js/lucid.i18n.js',
    lucid::$paths['base'].'/vendor/devlucid/html/src/base/js/html.js',
    lucid::$paths['base'].'/vendor/devlucid/html/src/base/js/html.dataTable.js',
    lucid::$paths['base'].'/vendor/kartik-v/php-date-formatter/js/php-date-formatter.js',
    lucid::$paths['base'].'/vendor/devlucid/datetimepicker/jquery.datetimepicker.js',
    lucid::$paths['app'].'/media/js/app.js',
];

lucid::$jsProductionBuild = lucid::$paths['app'].'/media/js/production.js';
