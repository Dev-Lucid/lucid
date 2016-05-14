<?php
namespace App\Controller;
use App\App, Lucid\Lucid, Lucid\Html\html;

/**
  * Users Controller
  *
  * @package Users
  */
class Users extends \App\Controller
{
    /**
      * Instantiates a paris query object.
      *
      * @return ???
      */
    public function getList()
    {
        $data = $this->model();

        # put additional where clauses here!
        # Ex: $data->where('org_id', lucid::$app->session()->int('user_id'));

        return $data;
    }

    /**
      * Gets a single row from the users table. Note that this method calls
      * $this->getList(), so any permission/business rules that are applied in that function
      * will also be applied.
      *
      * @return \App\Model\Users
      */
    public function getOne(int $user_id)
    {
        if ($user_id == 0) {
            return $this->model()->create();
        }
        return $this->getList()->find_one($user_id);
    }

    /**
      * Updates an existing row or inserts a new row into table users.
      *
      * @param int $user_id
      * @param int $org_id
      * @param string $email
      * @param string $password
      * @param string $first_name
      * @param string $last_name
      * @param bool $is_enabled
      * @param \DateTime $last_login
      * @param \DateTime $created_on
      * @param bool $force_password_change
      * @param string $register_key
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(int $user_id, int $org_id, string $email, string $password, string $first_name, string $last_name, bool $is_enabled, \DateTime $last_login, \DateTime $created_on, bool $force_password_change, string $register_key, bool $do_redirect=true)
    {
        #lucid::$app->permission()->requireLogin();
        # lucid::$app->$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->edit()->validateParameters(func_get_args());

        # This loads the table row that you are trying to update. If $user_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = $this->getOne($user_id);

		$data->org_id = $org_id;
		$data->email = $email;
		$data->password = $password;
		$data->first_name = $first_name;
		$data->last_name = $last_name;
		$data->is_enabled = $is_enabled;
		$data->last_login = $last_login->format(\DateTime::ISO8601);
		$data->created_on = $created_on->format(\DateTime::ISO8601);
		$data->force_password_change = $force_password_change;
		$data->register_key = $register_key;
        $data->save();

        lucid::$app->response()->message(lucid::$app->i18n()->translate('button:save_response'));
        if ($do_redirect === true) {
            lucid::$app->response()->redirect('users','table');
        }
    }

    /**
      * This method is used to delete a row from the users table. The final parameter (bool $do_redirect)
      * will determine if the response will be redirected to the data table for users.
      *
      * @param int $user_id Corresponds to database column users.user_id
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function delete(int $user_id, bool $do_redirect=true)
    {
        #lucid::$app->permission()->requireLogin();
        # lucid::$app->$security->requirePermission('delete'); # add required permissions to this array

        $this->getOne($user_id)->delete();
        lucid::$app->response()->message(lucid::$app->i18n()->translate('button:delete_response'));
        if ($do_redirect === true) {
            lucid::$app->response()->redirect('users','table');
        }
    }
}
