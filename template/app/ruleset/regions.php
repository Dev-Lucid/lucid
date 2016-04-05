<?php
namespace App\Ruleset;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Regions extends \App\Ruleset
{
    function edit()
    {
		$this->addRule(['type'=>'anyValue', 'label'=>lucid::i18n()->translate('model:regions:country_id'), 'field'=>'country_id', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:regions:abbreviation'), 'field'=>'abbreviation', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:regions:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:regions:type'), 'field'=>'type', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:regions:parent'), 'field'=>'parent', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'checked', 'label'=>lucid::i18n()->translate('model:regions:is_parent'), 'field'=>'is_parent', ]);
        return $this;
    }
}