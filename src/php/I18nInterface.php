<?php

namespace DevLucid;

interface I18nInterface
{
    public function get_major_language();
    public function get_minor_language();
    public function add_phrases($contents);
    public function translate($phrase, $parameters);
    public function load_dictionaries($dict_paths=[]);
    public function determine_best_user_language($user_lang);
}