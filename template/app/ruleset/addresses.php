<?php
namespace App\Ruleset;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Addresses extends \App\Ruleset
{
    function edit()
    {
		$this->addRule(['type'=>'anyValue', 'label'=>lucid::i18n()->translate('model:addresses:org_id'), 'field'=>'org_id', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:addresses:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:addresses:street_1'), 'field'=>'street_1', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:addresses:street_2'), 'field'=>'street_2', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:addresses:city'), 'field'=>'city', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'anyValue', 'label'=>lucid::i18n()->translate('model:addresses:region_id'), 'field'=>'region_id', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:addresses:postal_code'), 'field'=>'postal_code', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'anyValue', 'label'=>lucid::i18n()->translate('model:addresses:country_id'), 'field'=>'country_id', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:addresses:phone_number_1'), 'field'=>'phone_number_1', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:addresses:phone_number_2'), 'field'=>'phone_number_2', 'min'=>'2', 'max'=>'255', ]);
        return $this;
    }
}