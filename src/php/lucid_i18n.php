<?php

class lucid_i18n
{
    public static function load_dictionaries()
    {
        $lang_major_files = [];
        $lang_minor_files = [];

        $lang_major_pattern = lucid::$lang_major.'[._]*php';
        $lang_minor_pattern = lucid::$lang_major.lucid::$lang_minor.'*php';
        foreach(lucid::$paths['dictionaries'] as $dict_path)
        {
            $lang_major_files = array_merge($lang_major_files, glob($dict_path.'/'.$lang_major_pattern));
            $lang_minor_files = array_merge($lang_minor_files, glob($dict_path.'/'.$lang_minor_pattern));
        }

        foreach($lang_major_files as $file)
        {
            include($file);
        }
        foreach($lang_minor_files as $file)
        {
            include($file);
        }
    }

    function determine_best_user_language($user_lang)
    {
        # taken from http://stackoverflow.com/questions/6038236/using-the-php-http-accept-language-server-variable
        preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $user_lang, $lang_parse);
        $languages = $lang_parse[1];
        $rank  = $lang_parse[4];
        $user_languages = [];
        for($i=0; $i<count($languages); $i++)
        {
            $user_languages[strtolower($languages[$i])] = floatval( ($rank[$i] == NULL) ? $rank[$i+1] : $rank[$i] );
        }

        # this should sort the user languages from worst to best.
        asort($user_languages, SORT_NUMERIC);

        $best_major = null;
        $best_minor = null;
        foreach($user_languages as $code=>$rank)
        {
            list($major, $minor) = explode('-',$code);
            if (in_array($major,lucid::$lang_supported) or in_array($major.$minor,lucid::$lang_supported))
            {
                if($major == $best_major and is_null($minor))
                {
                    # do nothing! We don't want to overwrite an existing minor language setting if we've already got the
                    # right major language
                }
                else
                {
                    $best_major = $major;
                    $best_minor = $minor;
                }
            }
        }
        if (!is_null($best_major))
        {
            lucid::$lang_major = $best_major;
            lucid::$lang_minor = $best_minor;
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
        $phrase = str_replace(':'.$key, $value, $phrase);
    }
    return $phrase;
}
