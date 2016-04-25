<?php
namespace Lucid\Task;

class PhinxMigrate extends Task implements TaskInterface
{
    public static $trigger = 'migrate';

    public function __construct()
    {
        $this->parameters[] = new \Lucid\Task\Parameter('migration-id', 'labeled', true, null);
    }

    public function isAvailable()
    {
        return (file_exists(getcwd().'/config/phinx.php') === true);
    }

    public function run()
    {
        include(getcwd().'/bootstrap.php');

        $cmd = 'php bin/phinx migrate -c ./config/phinx.php -p php -e '.\Lucid\Lucid::$app->config()->string('stage').' -vvv';
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
Container::addTask(new PhinxMigrate());

