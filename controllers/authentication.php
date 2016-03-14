<?php

namespace DevLucid;

class AuthenticationController extends Controller
{
    public function ruleset()
    {
        return new Ruleset([
            ['type'=>'length_range','label'=>'E-mail', 'field'=>'email','min'=>'5','max'=>'255'],
        ]);
    }

    public function process(string $email, string $password)
    {
        lucid::log('Attempting to authenticate user: '.$email);
        $this->ruleset()->sendErrors();

        $user = lucid::model('vw_users_details')
            ->where_raw('LOWER(email) = ?',strtolower($email))
            ->find_one();

        if ($user === false) {
            lucid_ruleset::sendError(_('error:authentication:failed1'));
        }

        if (password_verify($password, $user->password) === false) {
            lucid_ruleset::sendError(_('error:authentication:failed2'));
        }

        lucid::$session->setArray($user->as_array());

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
