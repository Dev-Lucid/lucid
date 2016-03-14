<?php

namespace DevLucid;

class I18n implements I18nInterface
{
    private $majorLang = null;
    private $minorLang = null;
    private $phrases = [];

    public function getMajorLanguage()
    {
        return $this->majorLang;
    }

    public function getMinorLanguage()
    {
        return $this->minorLang;
    }

    public function addPhrases(array $contents)
    {
        foreach ($contents as $key=>$value) {
            $this->phrases[$key] = $value;
        }
    }

    public function translate(string $phrase, $parameters=[]): string
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

    public function loadDictionaries(array $dictPaths=[])
    {
        $langMajorFiles = [];
        $langMinorFiles = [];

        $langMajorPattern = $this->majorLang.'[._]*json';
        $langMinorPattern = $this->majorLang.$this->minorLang.'*json';

        foreach ($dictPaths as $dictPath) {
            $langMajorFiles = array_merge($langMajorFiles, glob($dictPath.'/'.$langMajorPattern));
            $langMinorFiles = array_merge($langMinorFiles, glob($dictPath.'/'.$langMinorPattern));
        }

        foreach($langMajorFiles as $file)
        {
            if (file_exists($file) === true) {
                $contents = json_decode(file_get_contents($file), true);
                $this->addPhrases($contents);
            }
        }
        foreach($langMinorFiles as $file)
        {
            if (file_exists($file) === true) {
                $contents = json_decode(file_get_contents($file), true);
                $this->addPhrases($contents);
            }
        }
    }

    public function determineBestUserLanguage(string $userLang)
    {
        # taken from http://stackoverflow.com/questions/6038236/using-the-php-http-accept-language-server-variable
        preg_match_all('/([a-z]{1,8}(-[a-z]{1,8})?)\s*(;\s*q\s*=\s*(1|0\.[0-9]+))?/i', $userLang, $langParse);
        $languages = $langParse[1];
        $rank  = $langParse[4];
        $userLanguages = [];
        for ($i=0; $i<count($languages); $i++) {
            if (isset($rank[$i]) === true) {
                if (isset($rank[$i+1]) === false) {
                    $rank[$i+1] = null;
                }
                $userLanguages[strtolower($languages[$i])] = floatval( ($rank[$i] == NULL) ? $rank[$i+1] : $rank[$i] );
            }
        }

        # this should sort the user languages from worst to best.
        asort($userLanguages, SORT_NUMERIC);

        $bestMajor = null;
        $bestMinor = null;
        foreach ($userLanguages as $code=>$rank) {
            $code = explode('-',$code);
            $major = array_shift($code);
            $minor = (count($code) > 0)?array_shift($code):null;

            if (in_array($major,lucid::$lang_supported) === true or in_array($major.$minor, lucid::$lang_supported) === true) {
                if ($major == $bestMajor and is_null($minor) === true) {
                    # do nothing! We don't want to overwrite an existing minor language setting if we've already got the
                    # right major language
                } else {
                    $bestMajor = $major;
                    $bestMinor = $minor;
                }
            }
        }
        if (is_null($bestMajor) === false) {
            $this->majorLang = $bestMajor;
            $this->minorLang = $bestMinor;
        }
    }
}
