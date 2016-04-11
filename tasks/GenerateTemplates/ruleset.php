<?php
namespace App\Ruleset;
use App\App, Lucid\Lucid, Lucid\Html\html;

class {{name}} extends \App\Ruleset
{
    function edit()
    {{{rules}}
        return $this;
    }
}