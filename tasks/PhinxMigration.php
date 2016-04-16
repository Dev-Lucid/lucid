<?php
namespace Lucid\Task;

class PhinxMigration extends Task implements TaskInterface
{
    public static $trigger = 'migration';

    public function __construct()
    {
        $this->parameters[] = new \Lucid\Task\Parameter('name', 'unlabeled', false, null);
    }

    public function isAvailable()
    {
        return (file_exists(getcwd().'/config/phinx.php') === true);
    }

    public function run()
    {
        include(getcwd().'/bootstrap.php');

        $cmd = 'php bin/phinx create '.$this->config['name'].' -c ./config/phinx.php -p php -vvv';
        echo($cmd."\n\n");
        $result = shell_exec($cmd);
        exit($result);
        /*
        $result = explode("\n", $result);
        while (count($result) > 0 && strpos($result[0], 'using default template') === false) {
            array_shift($result);
        }
        array_shift($result);
        echo(implode("\n", $result));
        */
    }
}
Container::addTask(new PhinxMigration());

