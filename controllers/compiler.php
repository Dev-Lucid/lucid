<?php

namespace DevLucid;

class ControllerCompiler extends Controller
{
    private function headers($type)
    {
        ob_clean();
        header('Content-Type: text/'.$type);
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
    }

    private function writeBuild($path, $content)
    {
        if (file_Exists($path) === true) {
            unlink($path);
        }
        file_put_contents($path, $content);
    }

    public function javascript()
    {
        lucid::config('js');

        $uncompressed = '';
        foreach (lucid::$jsFiles as $file) {
            $uncompressed .= file_get_contents($file);
        }

        # compression code goes here
        $compressed = $uncompressed;

        $this->writeBuild(lucid::$jsProductionBuild, $compressed);
    }

    public function scss()
    {
        lucid::config('scss');

        $scss = new \Leafo\ScssPhp\Compiler();
        $scss->setFormatter('Leafo\ScssPhp\Formatter\Compressed');

        foreach (lucid::$paths['scss'] as $path) {
            $scss->addImportPath($path);
        }

        $src = lucid::$scssStartSource;
        foreach (lucid::$scssFiles as $file) {
            $src .= "@import '$file';\n";
        }

        $css = $scss->compile($src);
        $this->writeBuild(lucid::$scssProductionBuild, $css);
    }
}
