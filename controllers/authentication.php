<?php

namespace DevLucid;

class ControllerAuthentication extends Controller
{
    public function ruleset()
    {
        return new Ruleset(__FILE__, __LINE__, [
            ['type'=>'lengthRange','label'=>'E-mail', 'field'=>'email','min'=>'5','max'=>'255'],
        ]);
    }

    public function process(string $email, string $password)
    {
        lucid::log('Attempting to authenticate user: '.$email);
        $this->ruleset()->sendErrors();

        $user = lucid::$mvc->model('vw_users_details')
            ->where_raw('LOWER(email) = ?',strtolower($email))
            ->find_one();

        if ($user === false) {
            Ruleset::sendError(_('error:authentication:failed1'));
        }

        if (password_verify($password, $user->password) === false) {
            Ruleset::sendError(_('error:authentication:failed2'));
        }

        lucid::$session->setArray($user->as_array());
        \ORM::get_db()->query('update users set last_login=CURRENT_TIMESTAMP where user_id='.$user->user_id);

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
