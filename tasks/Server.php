<?php
namespace Lucid\Task;

class Server extends Task implements TaskInterface
{
    public static $trigger = 'server';

    public function __construct()
    {
        $this->parameters[] = new \Lucid\Task\Parameter('stage',  'labeled', true, 'development');
        $this->parameters[] = new \Lucid\Task\Parameter('host',   'labeled', true, '127.0.0.1');
        $this->parameters[] = new \Lucid\Task\Parameter('port',   'labeled', true, '9000');
        $this->parameters[] = new \Lucid\Task\Parameter('docs-port', 'labeled', true, '9001');
    }

    public function run()
    {
        echo("Copying fonts...\n");
        shell_exec("php bin/copy_fonts.php");
        echo("Compiling javascript...\n");
        shell_exec("php bin/compile.javascript.php");
        echo("Compiling sass...\n");
        shell_exec("php bin/compile.scss.php");
        echo("Building docs...\n");
        shell_exec("php bin/lucid.php build-docs;");

        echo("Assets ready! starting servers...\nApp server: http://".$this->config['host'].":".$this->config['port']."\nDoc server: http://".$this->config['host'].":".$this->config['docs-port']." \n----------------------------------------------------------\n");

        $cmd_server  = "touch debug.log; export APP_STAGE=".$this->config['stage']."; php -S ".$this->config['host'].":".$this->config['port']." -t web > /dev/null 2>&1";
        $cmd_docs_server  = "php -S ".$this->config['host'].":".$this->config['docs-port']." -t docs > /dev/null 2>&1";
        $cmd_watcher = "php ./bin/watcher.php";
        $cmd_logs    = "tail -n 0 -f ./debug.log | cut -c 76-10000";

        $this->config['proc-server']  = popen($cmd_server, 'w');
        $this->config['proc-docs-server']  = popen($cmd_docs_server, 'w');
        $this->config['proc-watcher'] = popen($cmd_watcher, 'w');
        $this->config['proc-logs']    = popen($cmd_logs, 'w');

        register_shutdown_function([$this, 'shutdown']);

        while (!feof($this->config['proc-logs'])) {
            echo fread($this->config['proc-logs'], 4096);
            @ flush();
            usleep(1000000);
        }
    }

    public function shutdown()
    {
        pclose($this->config['proc-server']);
        pclose($this->config['proc-docs-server']);
        pclose($this->config['proc-watcher']);
        pclose($this->config['proc-logs']);

        proc_terminate($this->config['proc-server']);
        proc_terminate($this->config['proc-docs-server']);
        proc_terminate($this->config['proc-watcher']);
        proc_terminate($this->config['proc-logs']);

        exit();
    }
}

Container::addTask(new Server());