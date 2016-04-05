<?php
namespace App\Ruleset;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Vw_users_details extends \App\Ruleset
{
    function edit()
    {
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:vw_users_details:email'), 'field'=>'email', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:vw_users_details:password'), 'field'=>'password', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:vw_users_details:first_name'), 'field'=>'first_name', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:vw_users_details:last_name'), 'field'=>'last_name', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'anyValue', 'label'=>lucid::i18n()->translate('model:vw_users_details:org_id'), 'field'=>'org_id', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:vw_users_details:organization_name'), 'field'=>'organization_name', 'min'=>'2', 'max'=>'255', ]);
		$this->addRule(['type'=>'anyValue', 'label'=>lucid::i18n()->translate('model:vw_users_details:role_id'), 'field'=>'role_id', ]);
		$this->addRule(['type'=>'lengthRange', 'label'=>lucid::i18n()->translate('model:vw_users_details:role_name'), 'field'=>'role_name', 'min'=>'2', 'max'=>'255', ]);
        return $this;
    }
}