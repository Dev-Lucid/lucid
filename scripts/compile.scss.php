<?php
use Lucid\Lucid;
use Leafo\ScssPhp\Compiler;
define('BIN_PATH', dirname($_SERVER['PWD'].'/'.$_SERVER['SCRIPT_NAME']));
define('ROOT_PATH', BIN_PATH.'/..');
include(ROOT_PATH.'/bootstrap.php');

$config = include(ROOT_PATH.'/config/scss.php');
$source = '';
foreach ($config['scssFiles'] as $file) {
    $source .= file_get_contents(lucid::$path.'/'. $file);
}

$importPaths = [];
foreach($config['importPaths'] as $path){
    $importPaths[] = lucid::$path.'/'.$path;
}
$scss = new Compiler();
$scss->setImportPaths($importPaths);

# build a compressed version first
$scss->setFormatter('Leafo\\ScssPhp\\Formatter\\Crunched');
$result = $scss->compile($source);
file_put_contents(lucid::$path.'/'.$config['outputPath'].'/production.css', $result);

# now build a debug version
$scss->setFormatter('Leafo\\ScssPhp\\Formatter\\Expanded');
$scss->setLineNumberStyle(Compiler::LINE_COMMENTS);
$result = $scss->compile($source);
file_put_contents(lucid::$path.'/'.$config['outputPath'].'/debug.css', $result);


exit();