<?php
namespace Lucid\Task;

class Server extends Task implements TaskInterface
{
    public static $trigger = 'server';

    public function __construct()
    {
        $this->parameters[] = new \Lucid\Task\Parameter('host',   'labeled', true, '127.0.0.1');
        $this->parameters[] = new \Lucid\Task\Parameter('port',   'labeled', true, '9000');
        $this->parameters[] = new \Lucid\Task\Parameter('usleep', 'labeled', true, '1000000');
    }

    public function run()
    {
        echo("Copying fonts...\n");
        shell_exec("php bin/copy_fonts.php");
        echo("Compiling javascript...\n");
        shell_exec("php bin/compile.javascript.php");
        echo("Compiling sass...\n");
        shell_exec("php bin/compile.scss.php");

        echo("Assets ready, starting server: http://".$this->config['host'].":".$this->config['port']."\n----------------------------------------------------------\n");

        $cmd_server  = "touch debug.log & php -S ".$this->config['host'].":".$this->config['port']." -t web > /dev/null 2>&1";
        $cmd_watcher = "php ./bin/watcher.php";
        $cmd_logs    = "tail -n 0 -f ./debug.log | cut -c 76-10000";

        $this->config['proc-server']  = popen($cmd_server, 'w');
        $this->config['proc-watcher'] = popen($cmd_watcher, 'w');
        $this->config['proc-logs']    = popen($cmd_logs, 'w');

        register_shutdown_function([$this, 'shutdown']);

        while (!feof($this->config['proc-logs'])) {
            echo fread($this->config['proc-logs'], 4096);
            @ flush();
            usleep($this->config['usleep']);
        }
    }

    public function shutdown()
    {
        pclose($this->config['proc-server']);
        pclose($this->config['proc-watcher']);
        pclose($this->config['proc-logs']);

        proc_terminate($this->config['proc-server']);
        proc_terminate($this->config['proc-watcher']);
        proc_terminate($this->config['proc-logs']);

        exit();
    }
}

Container::addTask(new Server());