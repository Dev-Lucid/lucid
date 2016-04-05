<?php
namespace App\Ruleset;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Users extends \App\Ruleset
{
    function edit()
    {
		$this->addRule(['type'=>'anyValue', 'label'=>lucid::i18n()->translate('model:users:org_id'), 'field'=>'org_id', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:users:email'), 'field'=>'email', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:users:password'), 'field'=>'password', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:users:first_name'), 'field'=>'first_name', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:users:last_name'), 'field'=>'last_name', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'checked', 'label'=>lucid::i18n()->translate('model:users:is_enabled'), 'field'=>'is_enabled', ]);
		$this->addRule(['type'=>'validDate', 'label'=>lucid::i18n()->translate('model:users:last_login'), 'field'=>'last_login', ]);
		$this->addRule(['type'=>'validDate', 'label'=>lucid::i18n()->translate('model:users:created_on'), 'field'=>'created_on', ]);
		$this->addRule(['type'=>'checked', 'label'=>lucid::i18n()->translate('model:users:force_password_change'), 'field'=>'force_password_change', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:users:register_key'), 'field'=>'register_key', 'min'=>'2', 'max'=>'255', ]);
        return $this;
    }
}