<?php
use Lucid\Lucid;

define('BIN_PATH', dirname($_SERVER['PWD'].'/'.$_SERVER['SCRIPT_NAME']));
define('ROOT_PATH', BIN_PATH.'/..');
$lucidScriptPath = __DIR__;
$templatePath = realpath($lucidScriptPath.'/../template/');


include(ROOT_PATH.'/vendor/autoload.php');
$direction = 'toapp';

if (($argv[1] ?? null) == '--from-app') {
    $direction = 'fromapp';
}
/*
$arguments = new \cli\Arguments(compact('strict'));
$arguments->addFlag(array('help', 'h'), 'Show this help screen');

$arguments->addOption(array('direction', 'd'), array(
    'default' => 'toapp',
	'description' => '[toapp, fromapp], whether or not to copy the template files  to or from the application. Defaults to toapp'));


$arguments->parse();

$arguments['direction'] = ($arguments['direction'] ?? ($arguments->getOption('direction'))['default']);
if ($arguments['direction'] != 'toapp' && $arguments['direction'] != 'fromapp') {
    exit("Parameter --direction/-d may only be toapp or fromapp\n");
}


if ($arguments['help']) {
	echo $arguments->getHelpScreen();
	exit("\n\n");
}
*/

echo ("Processing, direction == ".$direction."\n");
if ($direction == 'fromapp') {
    $from = realpath(ROOT_PATH).'/';
    $to   = $templatePath.'/';
} else {
    $to   = realpath(ROOT_PATH).'/';
    $from = $templatePath.'/';
}
echo ("Copying from $from to $to\n");

$directories = [];
$files = [];
$initialFiles = explode("\n", file_get_contents($templatePath.'/file_list.txt'));
foreach ($initialFiles as $initialFile) {
    $initialFile = trim($initialFile);
    if ($initialFile != '') {
        if (substr($initialFile, -1) == '/') {
            $directories[] = $initialFile;
        } else {
            $possibleDir = dirname($initialFile);
            if ($possibleDir != '.') {
                $directories[] = $possibleDir;
            }
            $files[] = $initialFile;
        }
    }
}

$directories = array_unique($directories);
$files = array_unique($files);

echo("Creating directories....\n");
foreach ($directories as $directory) {
    $dirToCreate = $to.$directory;
    if (substr($dirToCreate, -1) == '/') {
        $dirToCreate = substr($dirToCreate, 0, strlen($dirToCreate) - 1);
    }
    echo("\t$dirToCreate\n");

    if (file_exists($dirToCreate) === false) {

        mkdir($dirToCreate, 0755, true);
    }

}

echo("\n\nneed to copy these files: \n");
foreach ($files as $file) {
    echo("\t$from$file\n");
    copy($from.$file, $to.$file);
}

exit("\nComplete.\n\nYou should also configure your staging in config/stage.php, and your database connection in config/db.php. Once that is complete, you should init your local database using php bin/init_db.php. If you do not make any changes to your configs, running php bin/init_db.php will create a sqlite database in database/.\n");
#print_r($files);

