<?php

class lucid_controller_compiler extends lucid_controller
{
    private function headers($type)
    {
        ob_clean();
        header('Content-Type: text/'.$type);
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
    }

    private function write_build($path, $content)
    {
        if(file_Exists($path)){
            unlink($path);
        }
        file_put_contents($path, $content);
    }

    public function javascript()
    {
        $this->headers('javascript');
        lucid::config('js');

        $uncompressed = '';
        foreach(lucid::$js_files as $file){
            $uncompressed .= file_get_contents($file);
        }

        # compression code goes here
        $compressed = $uncompressed;

        $this->write_build(lucid::$js_production_build, $compressed);
        exit($uncompressed);
    }

    public function scss()
    {
        $this->headers('css');
        lucid::config('scss');

        $scss = new Leafo\ScssPhp\Compiler();
        $scss->setFormatter('Leafo\ScssPhp\Formatter\Compressed');

        foreach(lucid::$paths['scss'] as $path){
            $scss->addImportPath($path);
        }

        $src = '';
        foreach(lucid::$scss_files as $file){
            $src .= "@import '$file';\n";
        }

        $css = $scss->compile($src);
        $this->write_build(lucid::$scss_production_build, $css);
        exit($css);
    }
}
