#!/usr/bin/env php
<?php
namespace Lucid\Task;

class Container
{
    static $tasks = [];
    static $config = [
        'version'=>'0.1.0',
        'path'=>'',
        'isValidProject'=>false,
    ];

    public static function addTask($newTaskObject)
    {
        $trigger = (get_class($newTaskObject))::$trigger;
        if (in_array('Lucid\Task\TaskInterface', class_implements($newTaskObject)) === false) {
            throw new Exception("$trigger does not implement Lucid\Task\TaskInterface, so it cannot be used by the task container.");
        }
        if (isset(static::$tasks[$trigger]) === false) {
            static::$tasks[$trigger] = [];
        }
        array_unshift(static::$tasks[$trigger], $newTaskObject);
    }

    public static function run($task, $arguments)
    {
        if (isset(static::$tasks[$task]) === false) {
            exit("$task is not a valid task.\n");
        }

        $foundTask = false;
        foreach (static::$tasks[$task] as $taskObject) {
            $taskObject->parseArguments($arguments);
            if ($taskObject->isAvailable() === true) {
                $taskObject->run();
                $foundTask = true;
                break;
            }
        }
        if ($foundTask === false) {
            exit("Unable to find a valid handler for task.\n");
        }
    }

    public static function findTasks()
    {
        $cwd = getcwd();
        if (file_exists($cwd.'/vendor/devlucid/lucid/tasks') === true) {
            $files = glob($cwd.'/vendor/devlucid/lucid/tasks/*.php');
            foreach ($files as $file) {
                include($file);
            }
        }
        if (file_exists($cwd.'/app/tasks') === true) {
            $files = glob($cwd.'/app/tasks/*.php');
            foreach ($files as $file) {
                include($file);
            }
        }
    }
}

Container::$config['path'] = getcwd();
Container::$config['isValidProject'] = (file_exists(getcwd().'/vendor/devlucid/lucid') && file_exists(getcwd().'/app'));

interface TaskInterface
{
    public function parseArguments(array $arguments);
    public function isAvailable(): bool;
    public function showUsage();
    public function run();
}

abstract class Task
{
    public $parameters = [];
    public $config = [];

    public function showUsage()
    {
        $parameters = '';
        $comments = '';
        foreach ($this->parameters as $parameter) {
            switch ($parameter->type) {
                case 'unlabeled':
                    $parameters .= ' $'.$parameter->name;
                    break;
                case 'labeled':
                    $parameters .= ' [--'.$parameter->name.' '.((is_null($parameter->default) === true)?'$newValue':$parameter->default).']';
                    break;
                case 'flag':
                    $parameters .= ' [--'.$parameter->name.']';
                    break;
            }
            if ($parameter->comment != '') {
                $comments .= $parameter->comment."\n";
            }
        }
        echo("Usage: lucid ".static::$trigger."$parameters\n");
        if ($comments != '') {
            echo("\nNote:\n----------------------------------------------\n$comments\n");
        }
    }

    public function isAvailable(): bool
    {
        return true;
    }

    public function parseArguments(array $arguments)
    {
        $parsedArguments = array_fill(0, count($arguments), false);

        for ($i=0; $i<count($this->parameters); $i++) {
            switch ($this->parameters[$i]->type) {
                case 'unlabeled':
                    if (isset($arguments[$i]) === true) {
                        $parsedArguments[$i] = true;
                        $this->config[$this->parameters[$i]->name] = $arguments[$i];
                    } else {
                        if ($this->parameters[$i]->optional === false) {
                            echo("Parameter ".$this->parameters[$i]->name." is required.\n");
                            \Lucid\Task\Container::run('usage', [static::$trigger]);
                            exit();
                        }
                        $this->config[$this->parameters[$i]->name] = $this->parameters[$i]->default;
                    }
                    break;
                case 'labeled':
                    for ($j=0; $j< (count($arguments) - 1); $j++) {
                        if ($arguments[$j] == '--'.$this->parameters[$i]->name) {
                            $parsedArguments[$j] = true;
                            $parsedArguments[$j + 1] = true;
                            $this->config[$this->parameters[$i]->name] = $arguments[$j + 1];
                            $i++;
                        }
                    }
                    if (isset($config[$this->parameters[$i]->name]) === false) {
                        $this->config[$this->parameters[$i]->name] = $this->parameters[$i]->default;
                    }
                    break;
                case 'flag':
                    $this->config[$this->parameters[$i]->name] = $this->parameters[$i]->default;
                    for ($j=0; $j< (count($arguments) - 1); $j++) {
                        if ($arguments[$j] == '--'.$this->parameters[$i]->name) {
                            $parsedArguments[$j] = true;
                            $this->config[$this->parameters[$i]->name] = (!$this->config[$this->parameters[$i]->name]);
                        }
                    }
                    break;
            }

        }

        for ($i=0; $i<count($parsedArguments); $i++) {
            if ($parsedArguments[$i] === false) {
                echo("Error: Unknown option ".$arguments[$i]."\n\n");
                \Lucid\Task\Container::run('usage', [static::$trigger]);
                exit();
            }
        }
    }
}

class Parameter
{
    public function __construct(string $name = '', string $type, bool $optional = true, $default = null, string $comment = '', string $exampleValue = null )
    {
        $this->name = $name;
        $this->type = $type; # 'unlabeled', 'labeled', 'flag'
        $this->optional = $optional;
        $this->default = $default;
        $this->comment = $comment;

        if (is_null($exampleValue) === true) {
            $exampleValue = $default;
        }
        $this->exampleValue = $exampleValue;
    }
}

class Usage extends Task implements TaskInterface
{
    public static $trigger = 'usage';

    public function __construct()
    {
        $this->parameters[] = new \Lucid\Task\Parameter('task', 'unlabeled', true, null);
    }

    public function run()
    {
        if (is_null($this->config['task']) === true) {
            echo("Usage: lucid [".implode(' | ', array_keys(Container::$tasks))."]\n");
            return;
        } else {
            if (isset(Container::$tasks[$this->config['task']]) === false) {
                exit($this->config['task']." is not a valid task.\n");
            }
            Container::$tasks[$this->config['task']][0]->showUsage();
        }
    }
}
Container::addTask(new \Lucid\Task\Usage());

class Version extends Task implements TaskInterface
{
    public static $trigger = 'version';

    public function run()
    {
        echo("Version ".Container::$config['version']."\n");
    }
}
Container::addTask(new \Lucid\Task\Version());

class Install extends Task implements TaskInterface
{
    public static $trigger = 'install';

    public function run()
    {
        switch(strtolower(php_uname('s'))) {
            case 'linux':
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
Container::addTask(new \Lucid\Task\Install());

class Self_Update extends Task implements TaskInterface
{
    public static $trigger = 'self-update';

    public function __construct()
    {
        $this->parameters[] = new \Lucid\Task\Parameter('branch', 'labeled', true, 'master');
    }

    public function run()
    {

        $cmd = "curl https://raw.githubusercontent.com/Dev-Lucid/lucid/".$this->config['branch']."/scripts/lucid.php > ".__FILE__;
        $result = shell_exec($cmd);
        echo("Update complete.\n");
    }
}
Container::addTask(new \Lucid\Task\Self_Update());

class Create extends Task implements TaskInterface
{
    public static $trigger = 'create';
    public function __construct()
    {
        $this->parameters[] = new \Lucid\Task\Parameter('name', 'unlabeled', false, null, 'The name of the project to create.');
        $this->parameters[] = new \Lucid\Task\Parameter('path', 'labeled', true, getcwd(), 'The path where the project will be created.');
        $this->parameters[] = new \Lucid\Task\Parameter('branch', 'labeled', true, 'master', 'Which lucid branch to use');
    }

    public function run()
    {
        $instructions = "\n\nYour project has been created. The path to your new project is: ".$this->config['path'].'/'.$this->config['name']."\n";

        $this->config['composer-url'] = 'https://raw.githubusercontent.com/Dev-Lucid/lucid/{{branch}}/template/composer.json';
        if (Container::$config['isValidProject'] === true) {
            #exit("Cannot create lucid project in this folder, one already exists.\n");
        }

        $composerUrl = 'https://getcomposer.org/composer.phar';
        $composerTest = shell_exec('composer');
        $composerCmd = '';

        # need to download a temporary version of composer for the install, and then tell the user
        # how to install a real version
        if (strpos($composerTest, 'Available commands:') === false) {
            $composerCmd = 'curl '.$composerUrl.' > composer.phar; php composer.phar install; rm composer.phar;';
            $instructions .= "\nBecause you did not have a version of composer installed, a copy has been temporarily downloaded to ".$this->config['path']."/composer.phar. This copy was automatically deleted after installation, but you will likely want to install composer permanently using the directions here: https://getcomposer.org/download/\n";
        } else {
            $composerCmd = 'composer install;';
        }

        $url = $this->config['composer-url'];
        $url = str_replace('{{branch}}', $this->config['branch'], $url);
        $path = realpath($this->config['path']).'/'.$this->config['name'];
        if (file_exists($path) === false) {
            mkdir($path);
        }

        $composer = file_get_contents($url);
        file_put_contents($path.'/composer.json', $composer);
        shell_exec('cd '.$path.'; '.$composerCmd.' php bin/create.php; php bin/init_db.php;');
        exit($instructions);
    }
}
Container::addTask(new \Lucid\Task\Create());

# load additional tasks from the project directories, if we're in a valid project
Container::findTasks();

# Determine what the task we're trying to run is
# the first element of the array is simply this filename, so get rid of it right away
array_shift($argv);

# Determine if a task is being passed. If not, default to 'usage'
if (count($argv) > 0) {
    $task = array_shift($argv);
} else {
    $task = 'usage';
}

# run the task and exit.
Container::run($task, $argv);
exit();