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
        lucid::$app->logger()->debug('Attempting to authenticate user: '.$email);
        $this->ruleset()->sendErrors();

        $user = lucid::$app->factory()->model('vw_users_details')
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

        lucid::$app->session()->setValues($user->as_array());
        \ORM::get_db()->query('update users set last_login=CURRENT_TIMESTAMP where user_id='.$user->user_id);

        lucid::$app->logger()->debug('Successful authentication for '.lucid::$app->session()->string('email'));
        lucid::$app->response()->redirect('dashboard', lucid::$app->session()->string('role_name'));
    }

    public function logout()
    {
        lucid::$app->logger()->debug('Logging out: '.lucid::$app->session()->get('email'));
        session_destroy();
        session_start();
        lucid::$app->response()->redirect('authentication','login');
    }
}
