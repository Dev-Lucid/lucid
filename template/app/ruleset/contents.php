<?php
namespace App\Ruleset;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Contents extends \App\Ruleset
{
    function edit()
    {
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:contents:title'), 'field'=>'title', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:contents:body'), 'field'=>'body', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'checked', 'label'=>lucid::i18n()->translate('model:contents:is_public'), 'field'=>'is_public', ]);
		$this->addRule(['type'=>'validDate', 'label'=>lucid::i18n()->translate('model:contents:creation_date'), 'field'=>'creation_date', ]);
        return $this;
    }
}