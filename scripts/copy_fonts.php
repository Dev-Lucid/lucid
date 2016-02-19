<?
$src = __DIR__.'/../../../fortawesome/font-awesome/fonts/';
$dst = __DIR__.'/../../../../app/media/fonts/';
$files = glob($src.'/*.*');

echo("Copying fonts...\n");

foreach($files as $file){
    $file_to_go = str_replace($src,$dst,$file);
    copy($file, $file_to_go);
}

exit("Font copy complete\n");
