<?php
namespace App\Ruleset;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Organizations extends \App\Ruleset
{
    function edit()
    {
		$this->addRule(['type'=>'anyValue', 'label'=>lucid::i18n()->translate('model:organizations:role_id'), 'field'=>'role_id', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:organizations:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'checked', 'label'=>lucid::i18n()->translate('model:organizations:is_enabled'), 'field'=>'is_enabled', ]);
		$this->addRule(['type'=>'validDate', 'label'=>lucid::i18n()->translate('model:organizations:created_on'), 'field'=>'created_on', ]);
        return $this;
    }
}