<?php

# Use this file to configure support for various languages / add dictionary paths for your languages
#
# To add a supported language (example: spanish),
# lucid::$lang_supported[] = 'es';
#
# You should only need to add support for the major language family, variants will be automatically detected and loaded if appropriate (es-ar, en-gb, etc);
#
#
# To add a new path for dictionaries,
# lucid::$paths['dictionaries'][] = '/your/new/path';
#
# Notably, two paths should already be in this array. relative to the root of your project, they should be:
# /vendor/devlucid/lucid/dictionaries
# /dictionaries
#
# Each dictionary path is applied on top of the previous one, so for example a phrase in /dictionaries/enus.php will overwrite a phrases
# using the same key in /vendor/devlucid/lucid/dictionaries/enus.php
