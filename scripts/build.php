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
	'description' => 'Which table(s) to build for, comma separated. This parameter is required.'));
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


$tables = trim($arguments['table'] ?? '');
if ($tables == '') {
    echo("You must pass the name of at least one table to build for.\n\n");
    echo($arguments->getHelpScreen());
    exit();
}
$tables = explode(',', $tables);

global $meta;
$meta = new \Lucid\Library\Metabase\Metabase(\ORM::get_db());
$dbTables = $meta->getTables();

foreach($tables as $table) {
	if (in_array($table, $dbTables) === false) {
	    echo("Table $table does not exist in your database.\n");
	    exit();
	}
}

function buildFromTemplate($templateName, $keys, $outputName) {
	$source = file_get_contents(__DIR__.'/templates/'.$templateName.'.php');
	foreach ($keys as $key=>$value) {
		$source = str_replace('{{'.$key.'}}', $value, $source);
	}
	echo("\tWriting file: $outputName\n");
	file_put_contents($outputName, $source);
}

function findTableForKey($table, $key)
{
	global $meta;
    $tables = $meta->getTables(false);

    for ($i=0; $i<count($tables); $i++) {
        $tableCols = $meta->getColumns($tables[$i]);
        if ($tableCols[0]['name'] == $key) {
            $return = [
                $tables[$i],
                $tableCols[0]['name'],
            ];

            for ($j = 1; $j<count($tableCols); $j++) {
                if ($tableCols[$j]['type'] == 'string'){
                    $return[] = $tableCols[$j]['name'];
                    return $return;
                }

            }
            lucid::log('Could not find a label column in table '.$tables[$i].'. Build script looks for the first column that is of a string type (varchar, char, text, etc).');
            return [false, false, false];
        }
    }

    lucid::log('Could not find a table to use as a source for '.$key.' select.');
    return [false, false, false];
}

$buildOpts = ['model', 'view', 'controller', 'ruleset', 'dictionary'];
foreach ($buildOpts as $buildOpt) {
	include($lucidScriptPath.'/build__'.$buildOpt.'.php');
}

foreach($tables as $table)  {
	echo("Table: $table\n");
	$columns = $meta->getColumns($table);

	$keys = [
	    'table'=>$table,
	    'uc(table)'=>ucwords($table),
	    'id_type'=>$columns[0]['type'],
	    'id'=>$columns[0]['name'],
		'first_string_col'=>null,
	];

	foreach($columns as $column) {
		if ($column['type'] == 'string' && is_null($keys['first_string_col']) === true) {
			$keys['first_string_col'] = $column['name'];
		}
	}

	foreach ($buildOpts as $buildOpt) {
	    if (file_exists($arguments['appdir'].'/'.$buildOpt) === false) {
	        if ($arguments[$buildOpt] === true) {
	            exit("\nBuild cannot continue. Because $buildOpt is part of your build operation, directory ".$arguments['appdir'].'/'.$buildOpt." must exist.\n");
	        } else {
	            echo("\nWarning: Directory for $buildOpt does not exist, but it is not part of your build operation anyway. Build can continue, but the appdir specified does not appear to be complete.\n");
	        }
	    }
	}

	try {

	    foreach ($buildOpts as $buildOpt) {

	        # even if we're not building something, we always call the *BuildKeys function as it may build
	        # keys used by other parts.
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
}
exit("-----------------------------\nComplete.\n");
