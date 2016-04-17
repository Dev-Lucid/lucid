<?php
namespace Lucid\Task;

class CompileSass extends Task implements TaskInterface
{
    public static $trigger = 'compile-sass';


    public function run()
    {
        include(getcwd().'/vendor/autoload.php');

        $config = include(getcwd().'/config/scss.php');
        $source = '';

        echo("Loading files...\n");
        foreach ($config['scssFiles'] as $file) {
            echo("   $file\n");
            $source .= file_get_contents(getcwd().'/'. $file);
        }

        $importPaths = [];
        echo("Setting import paths...\n");
        foreach($config['importPaths'] as $path){
            echo("   $path\n");
            $importPaths[] = getcwd().'/'.$path;
        }

        $scss = new \Leafo\ScssPhp\Compiler();
        $scss->setImportPaths($importPaths);

        # build a compressed version first
        echo("Writing production.css...\n");
        $scss->setFormatter('Leafo\\ScssPhp\\Formatter\\Crunched');
        $result = $scss->compile($source);
        $prodOutput = getcwd().'/'.$config['outputPath'].'/production.css';
        if (file_exists($prodOutput) === true) {
            unlink($prodOutput);
        }
        file_put_contents($prodOutput, $result);

        # now build a debug version
        echo("Writing debug.css...\n");
        $scss->setFormatter('Leafo\\ScssPhp\\Formatter\\Expanded');
        $scss->setLineNumberStyle(\Leafo\ScssPhp\Compiler::LINE_COMMENTS);
        $result = $scss->compile($source);
        $debugOutput = getcwd().'/'.$config['outputPath'].'/debug.css';
        if (file_exists($debugOutput) === true) {
            unlink($debugOutput);
        }
        file_put_contents($debugOutput, $result);

        echo("Complete.\n");
    }
}

Container::addTask(new CompileSass());