<?php
use Lucid\Lucid;
use Leafo\ScssPhp\Compiler;

define('BIN_PATH', dirname($_SERVER['PWD'].'/'.$_SERVER['SCRIPT_FILENAME']));
define('ROOT_PATH', realpath(BIN_PATH.'/../'));
include(ROOT_PATH.'/bootstrap.php');

lucid::logger()->debug('Starting scss compile....');
$config = include(ROOT_PATH.'/config/scss.php');
$source = '';
foreach ($config['scssFiles'] as $file) {
    $source .= file_get_contents(ROOT_PATH.'/'. $file);
}

$scss = new Compiler();
$scss->setImportPaths($config['importPaths']);

# build a compressed version first
$scss->setFormatter('Leafo\\ScssPhp\\Formatter\\Crunched');
$result = $scss->compile($source);
file_put_contents(ROOT_PATH.'/'.$config['outputPath'].'/production.css', $result);

# now build a debug version
$scss->setFormatter('Leafo\\ScssPhp\\Formatter\\Expanded');
$scss->setLineNumberStyle(Compiler::LINE_COMMENTS);
$result = $scss->compile($source);
file_put_contents(ROOT_PATH.'/'.$config['outputPath'].'/debug.css', $result);


exit();