<?php
namespace App\Ruleset;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Roles extends \App\Ruleset
{
    function edit()
    {
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:roles:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ]);
        return $this;
    }
}