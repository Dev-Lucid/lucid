<?php

class lucid_controller_authentication extends lucid_controller
{
    public function ruleset()
    {
        return new lucid_ruleset('authform',[
            ['type'=>'length_range','label'=>'E-mail', 'field'=>'email','min'=>'5','max'=>'255'],
        ]);
    }

    public function process($email, $password)
    {
        lucid::log('attempting to authenticate user: '.$email);
        $this->ruleset()->send_errors();

        $user = lucid::model('users')
            ->where_raw('LOWER(email) = ?',strtolower($email))
            ->find_one();

        if($user === false)
        {
            lucid_ruleset::send_error(_('model:users:email'), _('error:authentication:failed1'));
        }

        if (!password_verify($password, $user->password))
        {
            lucid_ruleset::send_error(' ', _('error:authentication:failed2'));
        }

        lucid::log('successful authentication');
        lucid::log($user->as_array());
    }
}
