<?php
namespace Lucid\Task;

class VCS extends Task implements TaskInterface
{
    public static $trigger = 'vcs';

    public function parseArguments(array $arguments)
    {
        $this->config = $arguments;
    }

    public function isAvailable():bool
    {
        return (file_exists(getcwd().'/.git') === true || file_exists(getcwd().'/.hg') === true || file_exists(getcwd().'/.svn') === true);
    }

    public function run()
    {
        $vcs = '';
        $vcs = (file_exists(getcwd().'/.git') === true)?'git':$vcs;
        $vcs = (file_exists(getcwd().'/.hg') === true)?'hg':$vcs;
        $vcs = (file_exists(getcwd().'/.svn') === true)?'svn':$vcs;

        $cmd = $vcs.' '.implode(' ', $this->config);

        echo('> '.$cmd."\n\n");
        $result = shell_exec($cmd);
        exit($result);

    }
}
Container::addTask(new VCS());