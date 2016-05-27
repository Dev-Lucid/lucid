<?php
use Lucid\Lucid;

define('BIN_PATH', dirname($_SERVER['PWD'].'/'.$_SERVER['SCRIPT_NAME']));
define('ROOT_PATH', BIN_PATH.'/..');
$lucidScriptPath = __DIR__;


$src = ROOT_PATH.'/vendor/fortawesome/font-awesome/fonts/';
$dst = ROOT_PATH.'/public/fonts/';
$files = glob($src.'/*.*');

echo("Copying fonts...\n");

foreach ($files as $file) {
    $file_to_go = str_replace($src, $dst, $file);
    if (is_dir($file) === false) {
        echo(str_replace(ROOT_PATH, '', $file).' -> '.str_replace(ROOT_PATH, '', $file_to_go)."\n");
        copy($file, $file_to_go);
    }
}

exit("Font copy complete\n");
