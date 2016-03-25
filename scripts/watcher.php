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
    $cmd = 'cd '.BIN_PATH.'; php -f ./compile.scss.php';
    lucid::logger()->info('Recompiling scss: '.$cmd);
    shell_exec($cmd);
};
for ($i=0; $i < count($scssConfig['importPaths']); $i++) {
    $watcher->track('scss'.strval($i), $scssConfig['importPaths'][$i]);
    $watcher->addListener('scss'.strval($i), $scssEvent);
}

$jsEvent = function (FilesystemEvent $event) {
    $cmd = 'cd '.BIN_PATH.'; php -f ./compile.javascript.php';
    lucid::logger()->info('Recompiling javascript: '.$cmd);
    shell_exec($cmd);
};
$jsPaths = array_keys($jsConfig['include']);
for ($i=0; $i < count($jsPaths); $i++) {
    $watcher->track('js'.strval($i), $jsPaths[$i]);
    $watcher->addListener('js'.strval($i), $jsEvent);
}
$watcher->start();
