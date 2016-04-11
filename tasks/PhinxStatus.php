<?php
namespace Lucid\Task;

class PhinxStatus extends Task implements TaskInterface
{
    public static $trigger = 'status';

    public function isAvailable():bool
    {
        return (file_exists(getcwd().'/config/phinx.php') === true);
    }

    public function run()
    {
        include(getcwd().'/bootstrap.php');
        $cmd = 'bin/phinx status -c config/phinx.php -p php -e '.\Lucid\lucid::$stage.' -vvv';
        echo($cmd."\n\n");
        $result = shell_exec($cmd);
        exit($result);
        /*
        $result = explode("\n", $result);
        while (strpos($result[0], 'using environment ') === false) {
            array_shift($result);
        }
        array_shift($result);

        $result = implode("\n", $result);
        $result = str_replace('using the create command.', 'using the lucid migration command.', $result);

        echo($result);
        */
    }
}
Container::addTask(new PhinxStatus());