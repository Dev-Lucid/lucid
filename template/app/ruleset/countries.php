<?php
namespace App\Ruleset;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Countries extends \App\Ruleset
{
    function edit()
    {
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:countries:alpha_3'), 'field'=>'alpha_3', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:countries:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:countries:common_name'), 'field'=>'common_name', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:countries:official_name'), 'field'=>'official_name', 'min'=>'2', 'max'=>'255', ]);
        return $this;
    }
}