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

foreach(lucid::$paths['scss'] as $path)
{
    $watcher->track('scss', $path);
}

foreach(lucid::$js_files as $js_file)
{
    $watcher->track('js', $js_file);
}

$watcher->addListener('scss', function (FilesystemEvent $event)
{
    if($event->getResource() != lucid::$scss_production_build)
    {
        lucid::controller('compiler')->scss();
        echo $event->getResource() . ':' . $event->getTypeString()." - SCSS compilation complete\n";
    }
});

$watcher->addListener('js', function (FilesystemEvent $event)
{
    if($event->getResource() != lucid::$js_production_build)
    {
        lucid::controller('compiler')->javascript();
        echo $event->getResource() . ':' . $event->getTypeString()." - Javascript compilation complete\n";
    }
});

$watcher->start();
