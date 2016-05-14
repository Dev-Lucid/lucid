<?php
namespace App\Ruleset;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Authentication extends \App\Ruleset
{
    function login()
    {
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:users:email'), 'field'=>'email', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:users:password'), 'field'=>'password', 'min'=>'2', 'max'=>'255', ]);
        return $this;
    }

    function register()
    {
        $this->login();
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:users:first_name'), 'field'=>'first_name', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:users:last_name'), 'field'=>'last_name', 'min'=>'2', 'max'=>'255', ]);
        return $this;
    }
}