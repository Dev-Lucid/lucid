<?php

namespace DevLucid;

interface I18nInterface
{
    public function getMajorLanguage();
    public function getMinorLanguage();
    public function addPhrases(array $contents);
    public function translate(string $phrase, $parameters);
    public function loadDictionaries(array $dict_paths=[]);
    public function determineBestUserLanguage(string $user_lang);
}