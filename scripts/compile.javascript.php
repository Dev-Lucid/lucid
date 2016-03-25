<?php
define('BIN_PATH', dirname($_SERVER['PWD'].'/'.$_SERVER['SCRIPT_FILENAME']));
define('ROOT_PATH', realpath(BIN_PATH.'/../'));
include(ROOT_PATH.'/bootstrap.php');

$config = include(ROOT_PATH.'/config/javascript.php');
$files = [];
foreach ($config['include'] as $path=>$pathFiles) {
    foreach ($pathFiles as $pathFile) {
        $files[] = ROOT_PATH.'/'.$path.'/'.$pathFile;
    }
}

$source = '';
foreach ($files as $file) {
    $source .= file_get_contents($file);
}
file_put_contents(ROOT_PATH.'/'.$config['outputPath'].'/debug.js', $source);


$source = \JShrink\Minifier::minify($source);
file_put_contents(ROOT_PATH.'/'.$config['outputPath'].'/production.js', $source);

exit();