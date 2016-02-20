<?php

class lucid_i18n
{
    public static function load_dictionaries()
    {
        $lang_major_files = [];
        $lang_minor_files = [];

        $lang_major_pattern = lucid::$lang_major.'[._]*php';
        $lang_minor_pattern = lucid::$lang_major.lucid::$lang_minor.'*php';
        $lang_major_files = array_merge($lang_major_files, glob(lucid::$paths['dictionaries'].'/'.$lang_major_pattern));
        $lang_minor_files = array_merge($lang_minor_files, glob(lucid::$paths['dictionaries'].'/'.$lang_minor_pattern));

        foreach($lang_major_files as $file)
        {
            include($file);
        }
        foreach($lang_minor_files as $file)
        {
            include($file);
        }
    }
}

function _($phrase,$parameters=[])
{
    if (!isset(lucid::$lang_phrases[$phrase]))
    {
        return $phrase;
    }
    $phrase = lucid::$lang_phrases[$phrase];
    foreach($parameters as $key=>$value)
    {
        $phrase = str_replace('{{'.$key.'}}', $value, $phrase);
    }
    return $phrase;
}
