<?php
include(__DIR__.'/../../../../bootstrap.php');
lucid::config('scss');
lucid::config('js');
ob_end_clean();

# perform compilations on first load
lucid::controller('compiler')->scss();
lucid::controller('compiler')->javascript();


use Lurker\Event\FilesystemEvent;
use Lurker\ResourceWatcher;

$watcher = new ResourceWatcher;

$scss_tracker_count = 0;
foreach(lucid::$paths['scss'] as $path)
{
    echo("Watching for scss changes in $path\n");
    $watcher->track('scss'.strval($scss_tracker_count), $path);
    $scss_tracker_count++;
}

$js_paths = [];
$js_tracker_count = 0;
foreach(lucid::$js_files as $js_file)
{
    $js_paths[dirname( $js_file)] = true;
}
foreach(array_keys($js_paths) as $path)
{
    echo("Watching for javascript changes in $path\n");
    $watcher->track('js'.strval($js_tracker_count), $path.'/');
    $js_tracker_count++;
}

$scss_event = function (FilesystemEvent $event)
{
    if($event->getResource() != lucid::$scss_production_build)
    {
        lucid::controller('compiler')->scss();
        echo $event->getResource() . ':' . $event->getTypeString()." - SCSS compilation complete\n";
    }
};

$js_event = function (FilesystemEvent $event)
{
    echo("change to ".$event->getResource()."\n");
    if($event->getResource() != lucid::$js_production_build)
    {
        lucid::controller('compiler')->javascript();
        echo $event->getResource() . ':' . $event->getTypeString()." - Javascript compilation complete\n";
    }
};

for($i=0;$i<$js_tracker_count; $i++){
    $watcher->addListener('js'.strval($i), $js_event);
}
for($i=0;$i<$scss_tracker_count; $i++){
    $watcher->addListener('scss'.strval($i), $scss_event);
}

$watcher->start();
