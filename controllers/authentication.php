<?php

namespace DevLucid;

class lucid_controller_authentication extends lucid_controller
{
    public function ruleset()
    {
        return new lucid_ruleset([
            ['type'=>'length_range','label'=>'E-mail', 'field'=>'email','min'=>'5','max'=>'255'],
        ]);
    }

    public function process(string $email, string $password)
    {
        lucid::log('Attempting to authenticate user: '.$email);
        $this->ruleset()->send_errors();

        $user = lucid::model('vw_users_details')
            ->where_raw('LOWER(email) = ?',strtolower($email))
            ->find_one();

        if($user === false)
        {
            lucid_ruleset::send_error(_('error:authentication:failed1'));
        }

        if (!password_verify($password, $user->password))
        {
            lucid_ruleset::send_error(_('error:authentication:failed2'));
        }

        lucid::$session->set_array($user->as_array());

        lucid::log('Successful authentication for '.lucid::$session->email);
        lucid::redirect('dashboard');
    }

    public function logout()
    {
        lucid::log('Logging out: '.lucid::$session->email);
        lucid::$session->restart();
        lucid::redirect('login');
    }
}
