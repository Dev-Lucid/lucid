<?php
namespace App\Ruleset;
use Lucid\Lucid;

class {{uc(table)}} extends \Lucid\Component\Ruleset\Ruleset
{
    function setupRules()
    {{{rules}}
    }
}