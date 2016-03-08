<?php

$path_base = realpath(__DIR__.'/../../../../');
$path_template = realpath(__DIR__.'/../template/');

$files = [];
$initial_files = explode("\n",file_get_contents(__DIR__.'/../template/file_list.txt'));
foreach($initial_files as $file)
{
    $file = trim($file);
    if($file != '')
    {
        $files[] = $file;
    }
}

$options = [
    'action'=>'make',
    'initial_directories'=>'app,app/controllers,app/media,app/media/js,app/media/scss,app/media/fonts,app/media/images,config,db,db/models,dictionaries,tests',
];


for($i=1; $i < count($argv); $i++)
{
    list($key, $value) = explode('=', $argv[$i]);
    $options[$key] = $value;
}

function ensure_path_exists($path)
{
    $directory = dirname($path);
    if(file_exists($directory) === false)
    {
        mkdir($directory, 0777, true);
    }
}

$origin      = ($options['action'] == 'update')?$path_base:$path_template;
$destination = ($options['action'] == 'update')?$path_template:$path_base;


if($options['action'] == 'make')
{
    $dirs = explode(',',$options['initial_directories']);
    foreach($dirs as $dir)
    {
        echo("Making $path_base/$dir\n");
        if(file_exists($path_base.'/'.$dir) === false)
        {
            mkdir($path_base.'/'.$dir);
        }
    }
}

foreach($files as $file)
{
    ensure_path_exists($destination.'/'.$file);
    if(file_exists($origin.'/'.$file) === true)
    {
        echo("Copying to $destination: $file\n");
        copy($origin.'/'.$file, $destination.'/'.$file);
    }
}






