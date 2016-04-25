<?php
namespace App\Controller;
use App\App, Lucid\Lucid, Lucid\Html\html;

/**
  * Vw_users_details Controller
  *
  * @package Vw_users_details
  */
class Vw_users_details extends \App\Controller
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
        # Ex: $data->where('org_id', lucid::session()->int('user_id'));

        return $data;
    }

    /**
      * Gets a single row from the vw_users_details table. Note that this method calls
      * $this->getList(), so any permission/business rules that are applied in that function
      * will also be applied.
      *
      * @return \App\Model\Vw_users_details
      */
    public function getOne(string $user_id)
    {
        if ($user_id == 0) {
            return $this->model()->create();
        }
        return $this->getList()->find_one($user_id);
    }

    /**
      * Updates an existing row or inserts a new row into table vw_users_details.
      *
      * @param string $user_id
      * @param string $email
      * @param string $password
      * @param string $first_name
      * @param string $last_name
      * @param string $org_id
      * @param string $organization_name
      * @param string $role_id
      * @param string $role_name
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(string $user_id, string $email, string $password, string $first_name, string $last_name, string $org_id, string $organization_name, string $role_id, string $role_name, bool $do_redirect=true)
    {
        #lucid::permission()->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset('edit')->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $user_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = $this->getOne($user_id);

		$data->email = $email;
		$data->password = $password;
		$data->first_name = $first_name;
		$data->last_name = $last_name;
		$data->org_id = $org_id;
		$data->organization_name = $organization_name;
		$data->role_id = $role_id;
		$data->role_name = $role_name;
        $data->save();

        lucid::response()->message(lucid::$app->i18n()->translate('button:save_response'));
        if ($do_redirect === true) {
            lucid::$app->response()->redirect('vw_users_details','table');
        }
    }

    /**
      * This method is used to delete a row from the vw_users_details table. The final parameter (bool $do_redirect)
      * will determine if the response will be redirected to the data table for vw_users_details.
      *
      * @param int $user_id Corresponds to database column vw_users_details.user_id
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function delete(int $user_id, bool $do_redirect=true)
    {
        #lucid::permission()->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        $this->getOne($user_id)->delete();
        lucid::$app->response()->message(lucid::$app->i18n()->translate('button:delete_response'));
        if ($do_redirect === true) {
            lucid::$app->response()->redirect('vw_users_details','table');
        }
    }
}
