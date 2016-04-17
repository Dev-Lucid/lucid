<?php
namespace Lucid\Task;

class CompileJavascript extends Task implements TaskInterface
{
    public static $trigger = 'compile-javascript';


    public function run()
    {
        $config = include(getcwd().'/config/javascript.php');
        $files = [];
        foreach ($config['include'] as $path=>$pathFiles) {
            foreach ($pathFiles as $pathFile) {
                $files[] = getcwd().'/'.$path.'/'.$pathFile;
            }
        }

        $source = '';
        echo("Loading script files...\n");
        foreach ($files as $file) {
            echo("   $file\n");
            $source .= file_get_contents($file);
        }

        echo("Writing debug.js\n");
        file_put_contents(getcwd().'/'.$config['outputPath'].'/debug.js', $source);

        #$source = \JSMin::minify($source);
        #$source = \JShrink\Minifier::minify($source);

        echo("Writing production.js\n");
        file_put_contents(getcwd().'/'.$config['outputPath'].'/production.js', $source);

        echo("Complete.\n");
    }
}

Container::addTask(new CompileJavascript());