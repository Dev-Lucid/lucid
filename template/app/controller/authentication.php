<?php
namespace App\Controller;
use App\App, Lucid\Lucid, Lucid\Html\html;

/**
  * Authentication Controller
  *
  * @package Addresses
  */
class Authentication extends \App\Controller
{
    public function process(string $email, string $password)
    {
        lucid::logger()->debug('Attempting to authenticate user: '.$email);
        $this->ruleset()->sendErrors();

        $user = lucid::factory()->model('vw_users_details')
            ->where_raw('LOWER(email) = ?', strtolower($email))
            ->find_one();

        /*
        if ($user === false) {
            Ruleset::sendError(_('error:authentication:failed1'));
        }
        */

        if (password_verify($password, $user->password) === false) {
            //Ruleset::sendError(_('error:authentication:failed2'));
        }

        lucid::session()->setValues($user->as_array());
        \ORM::get_db()->query('update users set last_login=CURRENT_TIMESTAMP where user_id='.$user->user_id);

        lucid::logger()->debug('Successful authentication for '.lucid::session()->string('email'));
        lucid::response()->redirect('dashboard', lucid::session()->string('role_name'));
    }

    public function logout()
    {
        lucid::logger()->debug('Logging out: '.lucid::session()->get('email'));
        session_destroy();
        session_start();
        lucid::session()->setSource($_SESSION);
        lucid::response()->redirect('authentication','login');
    }
}
