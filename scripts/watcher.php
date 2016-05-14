<?php
use Lucid\Lucid;
use Lurker\Event\FilesystemEvent;
use Lurker\ResourceWatcher;
define('BIN_PATH', dirname($_SERVER['PWD'].'/'.$_SERVER['SCRIPT_FILENAME']));
define('ROOT_PATH', realpath(BIN_PATH.'/../'));
include(ROOT_PATH.'/bootstrap.php');
ob_end_clean();

$scssConfig = include(ROOT_PATH.'/config/scss.php');
$jsConfig = include(ROOT_PATH.'/config/javascript.php');

$watcher = new ResourceWatcher;

$scssEvent = function (FilesystemEvent $event) {
    $cmd = ' php bin/lucid.php compile-sass';
    lucid::$app->logger()->info('Recompiling scss: '.$cmd);
    shell_exec($cmd);
};
for ($i=0; $i < count($scssConfig['importPaths']); $i++) {
    $watcher->track('scss'.strval($i), $scssConfig['importPaths'][$i]);
    $watcher->addListener('scss'.strval($i), $scssEvent);
}

$jsEvent = function (FilesystemEvent $event) {
    $cmd = 'php bin/lucid.php compile-javascript';
    lucid::$app->logger()->info('Recompiling javascript: '.$cmd);
    shell_exec($cmd);
};
$jsPaths = array_keys($jsConfig['include']);
for ($i=0; $i < count($jsPaths); $i++) {
    $watcher->track('js'.strval($i), $jsPaths[$i]);
    $watcher->addListener('js'.strval($i), $jsEvent);
}

$docsEvent = function (FilesystemEvent $event) {

    $fileInfo = pathinfo($event->getResource());
    if ($fileInfo['extension'] != 'pdf') {
        $cmd = 'php bin/lucid.php build-docs';
        lucid::$app->logger()->info('Building docs: '.$cmd);
        shell_exec($cmd);
    }
};
$watcher->track('docs1', ROOT_PATH.'/docs/');
$watcher->addListener('docs1', $docsEvent);
$watcher->track('docs2', ROOT_PATH.'/vendor/dev-lucid/lucid/docs/');
$watcher->addListener('docs2', $docsEvent);

$watcher->start();
