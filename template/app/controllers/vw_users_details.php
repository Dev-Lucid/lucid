<?php
namespace DevLucid;

/**
  * ControllerVw_users_details
  *
  * @package Vw_users_details
  */
class ControllerVw_users_details extends Controller implements ControllerInterface
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
            ['type'=>'lengthRange', 'label'=>_('model:vw_users_details:email'), 'field'=>'email', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:vw_users_details:password'), 'field'=>'password', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:vw_users_details:first_name'), 'field'=>'first_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:vw_users_details:last_name'), 'field'=>'last_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'anyValue', 'label'=>_('model:vw_users_details:org_id'), 'field'=>'org_id', ],
            ['type'=>'lengthRange', 'label'=>_('model:vw_users_details:organization_name'), 'field'=>'organization_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'anyValue', 'label'=>_('model:vw_users_details:role_id'), 'field'=>'role_id', ],
            ['type'=>'lengthRange', 'label'=>_('model:vw_users_details:role_name'), 'field'=>'role_name', 'min'=>'2', 'max'=>'255', ],
        ]);
    }

    /**
      * This method is used to save data to the vw_users_details table. It can be used to 
      * insert or update. If $user_id is set to zero, then a new row 
      * will be created. The final parameter (bool $do_redirect) will determine if 
      * the response will be redirected to the data table for vw_users_details. 
      *
      * @param string $user_id Corresponds to database column vw_users_details.user_id.
      * @param string $email Corresponds to database column vw_users_details.email.
      * @param string $password Corresponds to database column vw_users_details.password.
      * @param string $first_name Corresponds to database column vw_users_details.first_name.
      * @param string $last_name Corresponds to database column vw_users_details.last_name.
      * @param string $org_id Corresponds to database column vw_users_details.org_id.
      * @param string $organization_name Corresponds to database column vw_users_details.organization_name.
      * @param string $role_id Corresponds to database column vw_users_details.role_id.
      * @param string $role_name Corresponds to database column vw_users_details.role_name.
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(string $user_id, string $email, string $password, string $first_name, string $last_name, string $org_id, string $organization_name, string $role_id, string $role_name, bool $do_redirect=true)
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
        $data = lucid::$mvc->model('vw_users_details', $user_id, false);

        $data->email             = $email;
        $data->password          = $password;
        $data->first_name        = $first_name;
        $data->last_name         = $last_name;
        $data->org_id            = $org_id;
        $data->organization_name = $organization_name;
        $data->role_id           = $role_id;
        $data->role_name         = $role_name;
        $data->save();

        if ($do_redirect === true) {
            lucid::redirect('vw_users_details-table');
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
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::$mvc->model('vw_users_details', $user_id)->delete();
        if ($do_redirect === true) {
            lucid::redirect('vw_users_details-table');
        }
    }
}
