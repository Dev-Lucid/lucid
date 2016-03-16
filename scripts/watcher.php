<?php

namespace DevLucid;

include(__DIR__.'/../../../../bootstrap.php');
lucid::config('scss');
lucid::config('js');
ob_end_clean();

# perform compilations on first load
lucid::controller('compiler')->scss();
lucid::controller('compiler')->javascript();
lucid::controller('compiler')->documentation('models');
lucid::controller('compiler')->documentation('views');
lucid::controller('compiler')->documentation('controllers');
lucid::controller('compiler')->documentation('tables');


use Lurker\Event\FilesystemEvent;
use Lurker\ResourceWatcher;

$watcher = new ResourceWatcher;

$scss_tracker_count = 0;
foreach (lucid::$paths['scss'] as $path) {
    echo("Watching for scss changes in $path\n");
    $watcher->track('scss'.strval($scss_tracker_count), $path);
    $scss_tracker_count++;
}

$js_paths = [];
$js_tracker_count = 0;
foreach (lucid::$jsFiles as $js_file) {
    $js_paths[dirname( $js_file)] = true;
}
foreach (array_keys($js_paths) as $path) {
    echo("Watching for javascript changes in $path\n");
    $watcher->track('js'.strval($js_tracker_count), $path.'/');
    $js_tracker_count++;
}

$scss_event = function (FilesystemEvent $event) {
    if ($event->getResource() != lucid::$scssProductionBuild) {
        lucid::controller('compiler')->scss();
        echo $event->getResource() . ':' . $event->getTypeString()." - SCSS compilation complete\n";
    }
};

$js_event = function (FilesystemEvent $event) {
    echo("change to ".$event->getResource()."\n");
    if($event->getResource() != lucid::$jsProductionBuild) {
        lucid::controller('compiler')->javascript();
        echo $event->getResource() . ':' . $event->getTypeString()." - Javascript compilation complete\n";
    }
};

$models_event = function (FilesystemEvent $event) {
    echo("change to ".$event->getResource()."\n");
    lucid::controller('compiler')->documentation('models');
    lucid::controller('compiler')->documentation('tables');
    echo $event->getResource() . ':' . $event->getTypeString()." - Models documentation compilation complete\n";
};

$views_event = function (FilesystemEvent $event) {
    echo("change to ".$event->getResource()."\n");
    lucid::controller('compiler')->documentation('views');
    echo $event->getResource() . ':' . $event->getTypeString()." - Views documentation compilation complete\n";
};

$controllers_event = function (FilesystemEvent $event) {
    echo("change to ".$event->getResource()."\n");
    lucid::controller('compiler')->documentation('controllers');
    echo $event->getResource() . ':' . $event->getTypeString()." - Controllers documentation compilation complete\n";
};

for ($i=0;$i<$js_tracker_count; $i++) {
    $watcher->addListener('js'.strval($i), $js_event);
}
for ($i=0;$i<$scss_tracker_count; $i++) {
    $watcher->addListener('scss'.strval($i), $scss_event);
}

$watcher->track('controllers', lucid::$paths['app'].'/controllers/');
$watcher->track('views', lucid::$paths['app'].'/views/');
$watcher->track('models1', lucid::$paths['base'].'/db/models/');
$watcher->track('models2', lucid::$paths['base'].'/db/migrations/');
$watcher->addListener('models1', $models_event);
$watcher->addListener('models2', $models_event);
$watcher->addListener('views', $views_event);
$watcher->addListener('controllers', $controllers_event);

$watcher->start();
