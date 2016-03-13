<?php

namespace DevLucid;

lucid::$js_files = [
    lucid::$paths['base'].'/vendor/twbs/bootstrap/docs/assets/js/vendor/jquery.min.js',
    lucid::$paths['base'].'/vendor/twbs/bootstrap/docs/assets/js/vendor/tether.min.js',
    lucid::$paths['base'].'/vendor/twbs/bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js',
    lucid::$paths['base'].'/vendor/twbs/bootstrap/dist/js/bootstrap.min.js',
    lucid::$paths['base'].'/vendor/devlucid/lucid/src/js/lucid.js',
    lucid::$paths['base'].'/vendor/devlucid/lucid/src/js/lucid.ruleset.js',
    lucid::$paths['base'].'/vendor/devlucid/lucid/src/js/lucid.dataTable.js',
    lucid::$paths['base'].'/vendor/devlucid/lucid/src/js/lucid.i18n.js',
    lucid::$paths['base'].'/vendor/devlucid/factory/src/base/js/factory.js',
    lucid::$paths['base'].'/vendor/devlucid/factory/src/base/js/factory.dataTable.js',
    lucid::$paths['app'].'/media/js/app.js',
];

lucid::$js_production_build = lucid::$paths['app'].'/media/js/production.js';
