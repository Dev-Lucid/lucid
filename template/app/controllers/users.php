<?php
namespace DevLucid;

/**
  * ControllerUsers
  *
  * @package Users
  */
class ControllerUsers extends Controller implements ControllerInterface
{
    /**
      * This method is used to construct the validation rules that should be enforced both
      * server-side and client side. It may be called from either the edit view, or the save
      * method of the controller.
      *
      * @return Ruleset
      */
    public function ruleset(): Ruleset
    {
        return new Ruleset(__FILE__, __LINE__, [
            ['type'=>'anyValue', 'label'=>_('model:users:org_id'), 'field'=>'org_id', ],
            ['type'=>'lengthRange', 'label'=>_('model:users:email'), 'field'=>'email', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:users:password'), 'field'=>'password', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:users:first_name'), 'field'=>'first_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:users:last_name'), 'field'=>'last_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'checked', 'label'=>_('model:users:is_enabled'), 'field'=>'is_enabled', ],
            ['type'=>'validDate', 'label'=>_('model:users:last_login'), 'field'=>'last_login', ],
            ['type'=>'validDate', 'label'=>_('model:users:created_on'), 'field'=>'created_on', ],
            ['type'=>'checked', 'label'=>_('model:users:force_password_change'), 'field'=>'force_password_change', ],
            ['type'=>'lengthRange', 'label'=>_('model:users:register_key'), 'field'=>'register_key', 'min'=>'2', 'max'=>'255', ],
        ]);
    }

    /**
      * This method is used to save data to the users table. It can be used to 
      * insert or update. If $user_id is set to zero, then a new row 
      * will be created. The final parameter (bool $do_redirect) will determine if 
      * the response will be redirected to the data table for users. 
      *
      * @param int $user_id Corresponds to database column users.user_id.
      * @param int $org_id Corresponds to database column users.org_id.
      * @param string $email Corresponds to database column users.email.
      * @param string $password Corresponds to database column users.password.
      * @param string $first_name Corresponds to database column users.first_name.
      * @param string $last_name Corresponds to database column users.last_name.
      * @param bool $is_enabled Corresponds to database column users.is_enabled.
      * @param \DateTime $last_login Corresponds to database column users.last_login.
      * @param \DateTime $created_on Corresponds to database column users.created_on.
      * @param bool $force_password_change Corresponds to database column users.force_password_change.
      * @param string $register_key Corresponds to database column users.register_key.
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(int $user_id, int $org_id, string $email, string $password, string $first_name, string $last_name, bool $is_enabled, \DateTime $last_login, \DateTime $created_on, bool $force_password_change, string $register_key, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $user_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = lucid::$mvc->model('users', $user_id, false);

        $data->org_id                = $org_id;
        $data->email                 = $email;
        $data->password              = $password;
        $data->first_name            = $first_name;
        $data->last_name             = $last_name;
        $data->is_enabled            = $is_enabled;
        $data->last_login            = $last_login->format(\DateTime::ISO8601);
        $data->created_on            = $created_on->format(\DateTime::ISO8601);
        $data->force_password_change = $force_password_change;
        $data->register_key          = $register_key;
        $data->save();

        if ($do_redirect === true) {
            lucid::redirect('users-table');
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
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::$mvc->model('users')->where('user_id', $user_id)->delete_many();
        if ($do_redirect === true) {
            lucid::redirect('users-table');
        }
    }
}
