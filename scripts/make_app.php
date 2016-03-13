<?php

$path_base = realpath(__DIR__.'/../../../../');
$path_template = realpath(__DIR__.'/../template/');

$files = [];
$initial_files = explode("\n",file_get_contents(__DIR__.'/../template/file_list.txt'));

foreach ($initial_files as $file {
    $file = trim($file);
    if ($file != '') {
        $files[] = $file;
    }
}

$options = [
    'action'=>'make',
    'initial_directories'=>'app,app/controllers,app/media,app/media/js,app/media/scss,app/media/fonts,docs,app/media/images,config,db,db/models,db/build,db/migrations,dictionaries,tests',
];


for ($i=1; $i < count($argv); $i++) {
    list($key, $value) = explode('=', $argv[$i]);
    $options[$key] = $value;
}

function ensure_path_exists($path)
{
    $directory = dirname($path);
    if (file_exists($directory) === false) {
        mkdir($directory, 0777, true);
    }
}

$origin      = ($options['action'] == 'update')?$path_base:$path_template;
$destination = ($options['action'] == 'update')?$path_template:$path_base;


if ($options['action'] == 'make') {
    echo("\nCreating directories...\n");
    $dirs = explode(',',$options['initial_directories']);
    foreach ($dirs as $dir) {
        echo("Making $path_base/$dir\n");
        if (file_exists($path_base.'/'.$dir) === false) {
            mkdir($path_base.'/'.$dir);
        }
    }
    echo("Done creating directories.\n");
}

echo("\nCopying files...\n");
foreach ($files as $file) {
    ensure_path_exists($destination.'/'.$file);
    if(file_exists($origin.'/'.$file) === true) {
        echo("Copying to $destination: $file\n");
        copy($origin.'/'.$file, $destination.'/'.$file);
    }
}
echo("Done copying files.\n");


# build the database and models
if ($options['action'] == 'make') {
    echo("\nBuilding database...\n");
    shell_exec($path_base.'/scripts/build_db.sh');
    echo("Building models...\n");
    shell_exec('php -f '.$path_base.'/scripts/generate_models.php');
    echo("Initing migrations...\n");
    shell_exec('php -f '.$path_base.'/scripts/phinx init ./db');
    echo("Done with database.\n");
}

# build the database and models
if ($options['action'] == 'make') {
    shell_exec('php -f '.$path_base.'/scripts/copy_fonts.php');
}

exit("\nComplete.");


