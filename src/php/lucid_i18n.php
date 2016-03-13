<?php

namespace DevLucid;

interface i_lucid_i18n
{
    public function get_major_language();
    public function get_minor_language();
    public function add_phrases($contents);
    public function translate($phrase, $parameters);
    public function load_dictionaries($dict_paths=[]);
    public function determine_best_user_language($user_lang);
}

class lucid_i18n implements i_lucid_i18n
{
    private $major_lang = null;
    private $minor_lang = null;
    private $phrases = [];

    public function get_major_language()
    {
        return $this->major_lang;
    }

    public function get_minor_language()
    {
        return $this->minor_lang;
    }

    public function add_phrases($contents)
    {
        foreach ($contents as $key=>$value) {
            $this->phrases[$key] = $value;
        }
    }

    public function translate($phrase, $parameters=[])
    {
        if (isset(lucid::$i18n->phrases[$phrase]) === false) {
            return $phrase;
        }
        $phrase = lucid::$i18n->phrases[$phrase];
        foreach ($parameters as $key=>$value) {
            $phrase = str_replace(':'.$key, $value, $phrase);
        }
        return $phrase;
    }

    public function load_dictionaries($dict_paths=[])
    {
        $lang_major_files = [];
        $lang_minor_files = [];

        $lang_major_pattern = $this->major_lang.'[._]*json';
        $lang_minor_pattern = $this->major_lang.$this->minor_lang.'*json';

        foreach ($dict_paths as $dict_path) {
            $lang_major_files = array_merge($lang_major_files, glob($dict_path.'/'.$lang_major_pattern));
            $lang_minor_files = array_merge($lang_minor_files, glob($dict_path.'/'.$lang_minor_pattern));
        }

        foreach($lang_major_files as $file)
        {
            if (file_exists($file) === true) {
                $contents = json_decode(file_get_contents($file), true);
                $this->add_phrases($contents);
            }
        }
        foreach($lang_minor_files as $file)
        {
            if (file_exists($file) === true) {
                $contents = json_decode(file_get_contents($file), true);
                $this->add_phrases($contents);
            }
        }
    }

    public function determine_best_user_language($user_lang)
    {
        # taken from http://stackoverflow.com/questions/6038236/using-the-php-http-accept-language-server-variable
        preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $user_lang, $lang_parse);
        $languages = $lang_parse[1];
        $rank  = $lang_parse[4];
        $user_languages = [];
        for ($i=0; $i<count($languages); $i++) {
            if (isset($rank[$i]) === true) {
                if (isset($rank[$i+1]) === false) {
                    $rank[$i+1] = null;
                }
                $user_languages[strtolower($languages[$i])] = floatval( ($rank[$i] == NULL) ? $rank[$i+1] : $rank[$i] );
            }
        }

        # this should sort the user languages from worst to best.
        asort($user_languages, SORT_NUMERIC);

        $best_major = null;
        $best_minor = null;
        foreach ($user_languages as $code=>$rank) {
            $code = explode('-',$code);
            $major = array_shift($code);
            $minor = (count($code) > 0)?array_shift($code):null;

            if (in_array($major,lucid::$lang_supported) === true or in_array($major.$minor,lucid::$lang_supported) === true) {
                if ($major == $best_major and is_null($minor)) {
                    # do nothing! We don't want to overwrite an existing minor language setting if we've already got the
                    # right major language
                } else {
                    $best_major = $major;
                    $best_minor = $minor;
                }
            }
        }
        if (is_null($best_major) === false) {
            $this->major_lang = $best_major;
            $this->minor_lang = $best_minor;
        }
    }
}
