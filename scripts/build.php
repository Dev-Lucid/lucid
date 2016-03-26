<?php
use Lucid\Lucid;

define('BIN_PATH', dirname($_SERVER['PWD'].'/'.$_SERVER['SCRIPT_NAME']));
define('ROOT_PATH', BIN_PATH.'/..');
$lucidScriptPath = __DIR__;

include(ROOT_PATH.'/bootstrap.php');

$arguments = new \cli\Arguments(compact('strict'));
#$arguments->addFlag(array('verbose', 'v'), 'Turn on verbose output');
#$arguments->addFlag('version', 'Display the version');
#$arguments->addFlag(array('quiet', 'q'), 'Disable all output');
$arguments->addFlag(array('help', 'h'), 'Show this help screen');

$arguments->addOption(array('table', 't'), array(
	'description' => 'Which table to build for. This parameter is required.'));
$arguments->addOption(array('model', 'm'), array(
	'default'     => 'true',
	'description' => 'As part of build, create model file. true or false.'));
$arguments->addOption(array('view', 'v'), array(
	'default'     => 'true',
	'description' => 'As part of build, create view file. true or false.'));
$arguments->addOption(array('controller', 'c'), array(
	'default'     => 'true',
	'description' => 'As part of build, create controller file. true or false.'));
$arguments->addOption(array('ruleset', 'r'), array(
	'default'     => 'true',
	'description' => 'As part of build, create ruleset file. true or false.'));
$arguments->addOption(array('dictionary', 'd'), array(
	'default'     => 'true',
	'description' => 'As part of build, create dictionary entries. true or false.'));
$arguments->addOption(array('appdir', 'a'), array(
	'default'     => realpath(lucid::$path.'/app'),
	'description' => 'Application directory'));

$arguments->parse();

if ($arguments['help']) {
	echo $arguments->getHelpScreen();
	exit("\n\n");
}

$arguments['model']      = (($arguments['model'] ?? ($arguments->getOption('model'))['default'])           == 'true');
$arguments['view']       = (($arguments['view'] ?? ($arguments->getOption('view'))['default'])             == 'true');
$arguments['controller'] = (($arguments['controller'] ?? ($arguments->getOption('controller'))['default']) == 'true');
$arguments['ruleset']    = (($arguments['ruleset'] ?? ($arguments->getOption('ruleset'))['default'])       == 'true');
$arguments['dictionary'] = (($arguments['dictionary'] ?? ($arguments->getOption('dictionary'))['default']) == 'true');
$arguments['appdir']     = ($arguments['appdir'] ?? ($arguments->getOption('appdir'))['default']);


$table = trim($arguments['table'] ?? '');
if ($table == '') {
    echo("You must pass the name of a table to build for.\n\n");
    echo($arguments->getHelpScreen());
    exit();
}

$meta = new \Lucid\Library\Metabase\Metabase(\ORM::get_db());
$tables = $meta->getTables();

if (in_array($table, $tables) === false) {
    echo("Table $table does not exist in your database.\n");
    exit();
}

$columns = $meta->getColumns($table);
$keys = [
    'table'=>$table,
    'uc(table)'=>ucwords($table),
    'id_type'=>$columns[0]['type'],
    'id'=>$columns[0]['name'],
];
$buildOpts = ['model', 'view', 'controller', 'ruleset', 'dictionary'];
foreach ($buildOpts as $buildOpt) {
    if (file_exists($arguments['appdir'].'/'.$buildOpt) === false) {
        if ($arguments[$buildOpt] === true) {
            exit("Build cannot continue. Because $buildOpt is part of your build operation, directory ".$arguments['appdir'].'/'.$buildOpt." must exist.\n");
        } else {
            echo("Warning: Directory for $buildOpt does not exist, but it is not part of your build operation anyway. Build can continue, but the appdir specified does not appear to be complete.\n");
        }
    }
}

function buildFromTemplate($templateName, $keys, $outputName) {
    $source = file_get_contents(__DIR__.'/templates/'.$templateName.'.php');
    foreach ($keys as $key=>$value) {
        $source = str_replace('{{'.$key.'}}', $value, $source);
    }
    file_put_contents($outputName, $source);
}

try {
    foreach ($buildOpts as $buildOpt) {

        # even if we're not building something, we always call the *BuildKeys function as it may build
        # keys used by other parts.
        include($lucidScriptPath.'/build__'.$buildOpt.'.php');
        $keys = ($buildOpt.'BuildKeys')($table, $columns, $keys, $arguments);
    }

    foreach ($buildOpts as $buildOpt) {
        if ($arguments[$buildOpt] === true) {
            ($buildOpt.'BuildFiles')($table, $columns, $keys, $arguments);
        }
    }
} catch(Exception $e) {
    $file = str_replace($lucidScriptPath, '', $e->getFile()).'#'.$e->getLine();
    exit("Exception: $file ".$e->getMessage());
}
exit("-----------------------------\nComplete.\n");
