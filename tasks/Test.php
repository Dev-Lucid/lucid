<?php
namespace Lucid\Task;

class Test extends Task implements TaskInterface
{
    public static $trigger = 'test';

    public function run()
    {
        echo("Running tests...\n");
        echo(shell_exec('phpunit --bootstrap ./bootstrap.php tests/'));
    }
}

Container::addTask(new Test());