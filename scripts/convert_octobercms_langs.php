<?php

$directories = [
    '/modules/system/lang/',
    '/modules/cms/lang/',
    '/modules/backend/lang/',
];

global $langs;
$langs = [];


if(count($argv) != 3 or paths_are_valid($argv[1], $argv[2]) === false)
{
    echo("Usage:\n-----------------------------\n");
    echo("php -f convert_octobercms_langs.php [full_path_to_october] [full_path_to_lucid_install]\n");
    exit("\n");
}

$october_path = $argv[1];
$lucid_path  = $argv[2];

foreach($directories as $dir)
{
    $lang_dirs = glob($october_path.$dir.'*');
    foreach($lang_dirs as $lang_dir)
    {
        $lang = determine_language ($lang_dir);
        echo("--------------------------------\n");
        echo("Language: $lang\n");
        import_phrases($lang, $lang_dir.'/lang.php', '');
        import_phrases($lang, $lang_dir.'/client.php', '');
        import_phrases($lang, $lang_dir.'/validation.php', 'validation:');
    }
}

foreach($langs as $key=>$list)
{
    ksort($langs[$key]);
}

echo("--------------------------------\n");
echo("Language parsing complete, preparing to write files\n");
echo("--------------------------------\n");

foreach($langs as $lang=>$phrases)
{
    write_lucid_file($lucid_path, $lang, $phrases);
}

echo("--------------------------------\n");
exit("Complete!\n");

function determine_language($name)
{
    $parts = split('-',array_pop(split('/',$name)));
    return strtolower(implode('',$parts));
}

function import_phrases($lang, $filename, $prefix)
{
    global $langs;

    if (!file_exists($filename))
    {
        return;
    }
    $phrases = include($filename);

    echo('   '.$filename."\n");
    foreach($phrases as $category=>$phrase_list)
    {

        if (!is_array($phrase_list))
        {
            $langs[$lang][$prefix.$category] = $phrase_list;
        }
        else
        {
            foreach($phrase_list as $key=>$value)
            {
                if (!is_array($langs[$lang]))
                {
                    $langs[$lang] = [];
                }
                if (is_array($value))
                {
                    foreach($value as $subkey=>$final_value)
                    {
                        $langs[$lang][$prefix.$category.':'.$key.':'.$subkey] = $final_value;
                    }
                }
                else
                {
                    $langs[$lang][$prefix.$category.':'.$key] = $value;
                }
            }
        }
    }
}

function write_lucid_file($lucid_path, $language, $phrases)
{
    echo("writing $language\n");
    $string = '<'."?php\n\n";

    $string .= "# This file was automatically converted from the October CMS language files. Thank you October CMS for all the great work!\n";
    $string .= "# https://octobercms.com\n\n";

    $string .= "lucid::add_phrases([\n";
    foreach($phrases as $key=>$value)
    {
        $string .= "    '$key'=>'".addslashes($value)."',\n";
    }
    $string .= "]);\n";
    file_put_contents($lucid_path.'/dictionaries/'.$language.'.php',$string);
}

function paths_are_valid($october_path, $lucid_path)
{
    if(!file_exists($october_path))
    {
        echo("Invalid october path\n\n");
        return false;
    }
    if(!file_exists($lucid_path))
    {
        echo("Invalid lucid path\n\n");
        return false;
    }
    return true;
}
