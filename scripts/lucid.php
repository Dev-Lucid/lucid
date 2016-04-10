#!/usr/bin/env php
<?php
global $config;

$config['version'] = '0.1.0';
$config['action'] = 'usage';
$config['composer-url'] = 'https://raw.githubusercontent.com/Dev-Lucid/lucid/{lucid-branch}/template/composer.json';
$config['lucid-branch'] = 'master';
$config['usage-action'] = null;
$config['name'] = null;
$config['table'] = null;


$config['db-type'] = 'sqlite';

# These are only placeholders for future postgresql/mysql integration
$config['db-name'] = null;
$config['db-host'] = null;
$config['db-port'] = null;
$config['db-user'] = null;
$config['db-pass'] = null;

/* flags for generating code */
$config['no-model']      = false;
$config['no-view']       = false;
$config['no-controller'] = false;
$config['no-helper']     = false;
$config['no-ruleset']    = false;
$config['no-test']   = false;
$config['no-dictionary']   = false;
$config['no-comments']   = false;

$config['path']   = getcwd();
$config['verbose'] = false;

# server config
$config['host'] = '127.0.0.1';
$config['port'] = '9000';

$config['parameters'] = [
    'verbose'=>[
        'type'=>'flag',
        'optional'=>true,
        'actions'=> ['create', 'generate', ],
    ],
    'path'=>[
        'type'=>'value',
        'optional'=>true,
        'actions'=> ['create', ],
    ],
    'db-type'=>[
        'type'=>'value',
        'optional'=>true,
        'values'=>['sqlite', 'postgresql', 'mysql',],
        'actions'=> ['create', ],
    ],
    'db-host'=>[
        'type'=>'value',
        'optional'=>true,
        'comment'=>'--db-host is only needed if database is not sqlite.',
        'actions'=> ['create', ],
    ],
    'db-name'=>[
        'type'=>'value',
        'optional'=>true,
        'comment'=>'--db-name is only needed if database is not sqlite.',
        'actions'=> ['create', ],
    ],
    'db-port'=>[
        'type'=>'value',
        'optional'=>true,
        'comment'=>'--db-port is only needed if database is not sqlite.',
        'actions'=> ['create', ],
    ],
    'db-user'=>[
        'type'=>'value',
        'optional'=>true,
        'comment'=>'--db-user is only needed if database is not sqlite.',
        'actions'=> ['create', ],
    ],
    'db-pass'=>[
            'type'=>'value',
            'optional'=>true,
            'comment'=>'--db-pass is only needed if database is not sqlite.',
            'actions'=> ['create', ],
        ],
    'name'=>[
        'type'=>'value',
        'optional'=>false,
        'actions'=> ['create', 'generate'],
    ],
    'table'=>[
        'type'=>'value',
        'optional'=>true,
        'comment'=>'If table parameter is not set, generate will assume that the table has the same value as name parameter.',
        'actions'=> ['generate'],
    ],
    'no-model'=>[
        'type'=>'flag',
        'optional'=>true,
        'actions'=> ['generate'],
    ],
    'no-view'=>[
        'type'=>'flag',
        'optional'=>true,
        'actions'=> ['generate'],
    ],
    'no-controller'=>[
        'type'=>'flag',
        'optional'=>true,
        'actions'=> ['generate'],
    ],
    'no-ruleset'=>[
        'type'=>'flag',
        'optional'=>true,
        'actions'=> ['generate'],
    ],
    'no-helper'=>[
        'type'=>'flag',
        'optional'=>true,
        'actions'=> ['generate'],
    ],
    'no-test'=>[
        'type'=>'flag',
        'optional'=>true,
        'actions'=> ['generate'],
    ],
    'no-comments'=>[
        'type'=>'flag',
        'optional'=>true,
        'actions'=> ['generate'],
    ],
    'verbose'=>[
        'type'=>'flag',
        'optional'=>true,
        'actions'=>['generate',],
    ],
    'lucid-branch'=>[
        'type'=>'value',
        'optional'=>true,
        'actions'=>['create'],
    ],
    'host'=>[
        'type'=>'value',
        'optional'=>true,
        'actions'=>['launch'],
    ],
    'port'=>[
        'type'=>'value',
        'optional'=>true,
        'actions'=>['launch'],
    ],
];

array_shift($argv);
if(count($argv) > 0) {
    $action = array_shift($argv);
    if ($action == '--help') {
        $action = 'usage';
    }

    $action = str_replace('-', '_', $action);

    if (method_exists('LucidActions', $action)) {
        $config['action'] = $action;
    }

    while(count($argv) > 0) {
        $parameter = array_shift($argv);
        if ($action == 'usage') {
            $config['usage-action'] = $parameter;
            break;
        }
        $parameter = substr($parameter, 2, strlen($parameter));
        if (isset($config['parameters'][$parameter]) === false) {
            echo("Unknown option: $parameter\n\n");
            $config['usage-action'] = $action;
            $config['action'] = 'usage';
            break;
        }

        if ($config['parameters'][$parameter]['type'] == 'flag') {
            $config[$parameter] = (!$config[$parameter]);
        } else {
            if (count($argv) == 0) {
                exit("Parameter $parameter requires a value.\n");
            }
            $value = array_shift($argv);

            if (isset($config['parameters'][$parameter]['values']) === true && in_array($value, $config['parameters'][$parameter]['values']) === false) {
                exit("Parameter $parameter may only have one of the following values: ".implode(', ', $config['parameters'][$parameter]['values'])."\n");
            }

            $config[$parameter] = $value;
        }
    }
}

LucidActions::{$config['action']}();

function buildParametersForUsage($action)
{
    global $config;
    $optionals = '';
    $mandatories = '';
    $options = '';
    $comments = '';
    foreach ($config['parameters'] as $name=>$settings) {
        if (in_array($action, $settings['actions']) === true) {
            if ($settings['optional'] === true) {
                $optionals .=' [--'.$name;
                if ($settings['type'] === 'value') {
                    $optionals .= ' ';
                    if (isset($settings['default']) === true) {
                        $optionals .= $settings['default'];
                    } else {
                        if ($config[$name] != '') {
                            $optionals .= $config[$name];
                        } else {
                            $optionals .= '$newvalue';
                        }
                    }
                }
                $optionals .=']';
            } else {
                $mandatories .=' --'.$name;
                if ($settings['type'] === 'value') {
                    $mandatories .= ' ';
                    if (isset($settings['default']) === true) {
                        $mandatories .= $settings['default'];
                    } else {
                        if ($config[$name] != '') {
                            $mandatories .= $config[$name];
                        } else {
                            $mandatories .= '$newvalue';
                        }
                    }
                }
            }

            if (isset($settings['comment']) === true && $settings['comment'] != '') {
                $comments .= $settings['comment']."\n";
            }
        }
    }

    if ($comments != '') {
        $comments = "\n\nNotes:\n--------------------------------------\n".$comments;
    }
    return $mandatories.$optionals.$comments;;
}

function checkParameters($action)
{
    global $config;
    foreach ($config['parameters'] as $name=>$settings) {
        if (
            in_array($action, $settings['actions']) === true &&
            $settings['optional'] === false &&
            (is_null($config[$name]) === true || $config['name'] == '')
        ) {
            echo("Error: parameter --$name requires a value.\n\n");
            $method = $action.'__usage';
            LucidActions::$method();
            exit();
        }
    }
}

function checkValidProject()
{
    $path = getcwd();
    if (file_exists($path.'/vendor/devlucid/lucid/') === false) {
        exit("The current directory does not seem to contain a valid lucid project.\n");
    }
}


function findTableForKey($table, $key, $config)
{
	$tables = $config['meta']->getTables(false);

    for ($i=0; $i<count($tables); $i++) {
        $tableCols = $config['meta']->getColumns($tables[$i]);
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
            echo('Could not find a label column in table '.$tables[$i].'. Build script looks for the first column that is of a string type (varchar, char, text, etc).');
            return [false, false, false];
        }
    }

    echo('Could not find a table to use as a source for '.$key.' select.');
    return [false, false, false];
}

function buildFromTemplate($templateName, $keys, $outputName) {
    global $config;
	$source = file_get_contents($config['path'].'/vendor/devlucid/lucid/scripts/templates/'.$templateName.'.php');
	foreach ($keys as $key=>$value) {
		$source = str_replace('{{'.$key.'}}', $value, $source);
	}
	#echo("\tWriting file: $outputName\n");
	file_put_contents($outputName, $source);
}

function disableBuffering()
{
    while (@ ob_end_flush());
}

class LucidActions
{
    public static function usage()
    {
        global $config;
        if ($config['usage-action'] == '') {
            $methods = '['.implode(' || ', array_filter(get_class_methods('LucidActions'), function($func){
                return (strpos($func, '__usage') === false);
            })).']';
            exit("Usage: lucid $methods\n");

        } else {
            $method = $config['usage-action'].'__usage';
            if (method_exists('LucidActions', $method) === true) {

                LucidActions::$method();
                exit();
            } else {
                $config['usage-action'] = '';
                static::usage();
            }
        }
    }

    public static function generate__usage()
    {
        echo("lucid generate ".buildParametersForUsage('generate')."\n");
    }

    public static function generate()
    {
        global $config;
        checkValidProject();
        checkParameters('generate');

        include($config['path'].'/bootstrap.php');
        #disableBuffering();
        \Lucid\lucid::setComponent('response', new \Lucid\Component\Response\CommandLine());

        $config['meta'] = new \Lucid\Library\Metabase\Metabase(\ORM::get_db());

        if (is_null($config['table']) === true) {
            $config['table'] = $config['name'];
        }
        $config['columns'] = $config['meta']->getColumns($config['table']);

        include($config['path'].'/vendor/devlucid/lucid/scripts/build__model.php');
        include($config['path'].'/vendor/devlucid/lucid/scripts/build__view.php');
        include($config['path'].'/vendor/devlucid/lucid/scripts/build__controller.php');
        include($config['path'].'/vendor/devlucid/lucid/scripts/build__helper.php');
        include($config['path'].'/vendor/devlucid/lucid/scripts/build__ruleset.php');
        include($config['path'].'/vendor/devlucid/lucid/scripts/build__test.php');
        include($config['path'].'/vendor/devlucid/lucid/scripts/build__dictionary.php');

        $keys = [
            'name'=>$config['name'],
            'table'=>$config['table'],
            'id_type'=>$config['columns'][0]['type'],
    	    'id'=>$config['columns'][0]['name'],
    		'first_string_col'=>null,
            'title'=>$config['name'],
        ];

        foreach($config['columns'] as $column) {
    		if ($column['type'] == 'string' && is_null($keys['first_string_col']) === true) {
    			$keys['first_string_col'] = $column['name'];
    		}
    	}


        $keys = modelBuildKeys($keys, $config);
        $keys = viewBuildKeys($keys, $config);
        $keys = controllerBuildKeys($keys, $config);
        $keys = helperBuildKeys($keys, $config);
        $keys = rulesetBuildKeys($keys, $config);
        $keys = testBuildKeys($keys, $config);
        $keys = dictionaryBuildKeys($keys, $config);

        if ($config['no-model'] === false) {
            modelBuildFiles($keys, $config);
        }
        if ($config['no-view'] === false) {
            viewBuildFiles($keys, $config);
        }
        if ($config['no-controller'] === false) {
            controllerBuildFiles($keys, $config);
        }
        if ($config['no-helper'] === false) {
            helperBuildFiles($keys, $config);
        }
        if ($config['no-ruleset'] === false) {
            rulesetBuildFiles($keys, $config);
        }
        if ($config['no-test'] === false) {
            testBuildFiles($keys, $config);
        }
        if ($config['no-dictionary'] === false) {
            dictionaryBuildFiles($keys, $config);
        }

    }

    public static function create__usage()
    {
        echo("lucid create ".buildParametersForUsage('create')."\n");
        exit();
    }

    public static function create()
    {
        global $config;
        checkParameters('create');
        $url = $config['composer-url'];
        $url = str_replace('{lucid-branch}', $config['lucid-branch'], $url);
        $path = realpath($config['path']).'/'.$config['name'];
        if (file_exists($path) === false) {
            mkdir($path);
        }
        $composer = file_get_contents($url);
        file_put_contents($path.'/composer.json', $composer);
        shell_exec('cd '.$path.';composer install;php bin/create.php; php bin/init_db.php;');
        chdir($path);
    }

    public static function server__usage()
    {
        echo("lucid server ".buildParametersForUsage('launch')."\n");

    }

    public static function server()
    {
        global $config;
        checkValidProject();
        checkParameters('server');

        echo("Copying fonts...\n");
        shell_exec("php bin/copy_fonts.php");
        echo("Compiling javascript...\n");
        shell_exec("php bin/compile.javascript.php");
        echo("Compiling sass...\n");
        shell_exec("php bin/compile.scss.php");
        echo("Assets ready, starting server: http://".$config['host'].":".$config['port']."\n----------------------------------------------------------\n");

        $cmd_server  = "touch debug.log & php -S ".$config['host'].":".$config['port']." -t web > /dev/null 2>&1";
        $cmd_watcher = "php ./bin/watcher.php";
        $cmd_logs    = "./bin/tail-log.sh";

        disableBuffering();

        $config['proc-server']  = popen($cmd_server, 'w');
        $config['proc-watcher'] = popen($cmd_watcher, 'w');
        $config['proc-logs']    = popen($cmd_logs, 'w');

        $shutdownFunc = function() {
            global $config;

            pclose($config['proc-server']);
            pclose($config['proc-watcher']);
            pclose($config['proc-logs']);

            proc_terminate($config['proc-server']);
            proc_terminate($config['proc-watcher']);
            proc_terminate($config['proc-logs']);

            exit();
        };

        register_shutdown_function($shutdownFunc);

        while (!feof($config['proc-logs'])) {
            echo fread($config['proc-logs'], 4096);
            @ flush();
        }
    }

    public static function test__usage()
    {
        echo("lucid test ".buildParametersForUsage('test')."\n");
    }

    public static function test()
    {
        echo("Running tests...\n");
        echo(shell_exec('phpunit --bootstrap ./bootstrap.php tests/'));

    }

    public static function version__usage()
    {
        echo("lucid version ".buildParametersForUsage('version')."\n");
    }

    public static function version()
    {
        global $config;
        checkParameters('version');
        exit("Lucid version ".$config['version']."\n");
    }

    public static function install__usage()
    {
        echo("lucid install ".buildParametersForUsage('install')."\n");
    }

    public static function install()
    {
        global $config;
        checkParameters('install');
        switch(strtolower(php_uname('s'))) {
            case 'darwin':
                if( file_exists('/usr/local/bin') === false) {
                    mkdir('/usr/local/bin', true);
                }
                if( file_exists('/usr/local/bin/lucid') === true) {
                    unlink('/usr/local/bin/lucid');
                }
                copy(__FILE__, '/usr/local/bin/lucid');
                chmod( '/usr/local/bin/lucid', 0777);
                exit("Install complete. You may have to close and reopen your terminal before using lucid.\n");
                break;
            default:
                exit("Sorry, I don't know how to install on operating system ".php_uname('s')."\n");
                break;
        }
    }
}

exit("Complete.\n");