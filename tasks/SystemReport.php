<?php
namespace Lucid\Task;

class SystemReport extends Task implements TaskInterface
{
    public static $trigger = 'system-report';
    public $checks = '';
    public $notes = '';
    public $allGood = true;
    public function run()
    {
        $this->checkKernel();
        $this->checkVersion();
        $this->checkPdo();
        $this->checkVcs();

        echo($this->checks);

        if ($this->allGood === true) {
            echo("\nGood to go!\n");
        } else {
            echo("\nProblems :(\n");
        }

        if ($this->notes != '') {
            echo("\n--------------------------------\n".$this->notes);
        }
    }

    public function formatter(bool $isOk, string $prefix, string $description='', string $notes = '')
    {
        $output = '';
        if ($isOk === true) {
            $output .= '[*] ';
        } else {
            $output .= '[ ] ';
        }

        $output .= $prefix.': ';
        $output .= $description ."\n";
        if ($isOk === false) {
            $this->allGood = false;
            if ($notes != '') {
                $this->notes .= $prefix.': '.$notes."\n";
            }
        }
        $this->checks .= $output;
    }

    public function checkVersion()
    {
        $version = phpversion();
        $versionParts = explode('.', $version);
        $this->formatter($version[0] >= 7, 'PHP Version', $version, 'Lucid requires PHP version 7 or higher');
    }

    public function checkPdo()
    {
        $pdoDrivers = \PDO::getAvailableDrivers();
        $ok = (in_array('sqlite', $pdoDrivers) && (in_array('mysql', $pdoDrivers) || in_array('pgsql', $pdoDrivers)));
        $this->formatter($ok, 'PDO Drivers', implode(', ', $pdoDrivers), 'This is more of a suggestion than a requirement as you may configure any PDO driver that you want for your project. This check only checks for sqlite and either mysql or pgsql. If you\'re confidient that your project does not require any of those drivers (ex: you\'re using oracle, etc), then you may safely ignore this check.');
    }

    public function checkVcs()
    {
        $availableVcs = [];
        $svnResult = shell_exec('svn --version');
        if (strpos($svnResult, 'The Apache Software Foundation') !== false) {
            $availableVcs[] = 'svn';
        }

        $gitResult = shell_exec('git --version');
        if (strpos($gitResult, 'git version') !== false) {
            $availableVcs[] = 'git';
        }

        $hgResult = shell_exec('hg --version');
        if (strpos($hgResult, 'mercurial-scm.org') !== false) {
            $availableVcs[] = 'hg';
        }

        $ok = (count($availableVcs) > 0);
        $this->formatter($ok, 'Version Control', implode(', ', $availableVcs), 'This only checks for subversion, git, and mercurial as they are the most common. I recommend git. You may safely ignore this check if you\'re using somethign else, but you *should* be using something.');
    }

    public function checkKernel()
    {
        $availableVcs = [];
        $kernel = strtolower(php_uname('s'));

        $ok = ($kernel == 'darwin' || $kernel == 'linux');
        $this->formatter($ok, 'Kernel', $kernel, 'If you are not running on linux or osx, you\'re in uncharted territory. If on windows, you should probably look into cygwin or setting up some kind of unix-like environment on your machine.');
    }
}
Container::addTask(new SystemReport());
