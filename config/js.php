<?php

lucid::$js_files = [
    lucid::$paths['base'].'/vendor/twbs/bootstrap/docs/assets/js/vendor/jquery.min.js',
    lucid::$paths['base'].'/vendor/twbs/bootstrap/docs/assets/js/vendor/tether.min.js',
    lucid::$paths['base'].'/vendor/twbs/bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js',
    lucid::$paths['base'].'/vendor/twbs/bootstrap/dist/js/bootstrap.min.js',
    lucid::$paths['base'].'/vendor/devlucid/lucid/src/js/lucid.js',
    lucid::$paths['app'].'media/js/app.js',
];

lucid::$js_production_build = lucid::$paths['app'].'media/js/production.js';
