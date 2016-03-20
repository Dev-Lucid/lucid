<?php
namespace DevLucid;

/**
  * ControllerVw_organizations_details
  *
  * @package Vw_organizations_details
  */
class ControllerVw_organizations_details extends Controller
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
            ['type'=>'lengthRange', 'label'=>_('model:vw_organizations_details:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'anyValue', 'label'=>_('model:vw_organizations_details:role_id'), 'field'=>'role_id', ],
            ['type'=>'lengthRange', 'label'=>_('model:vw_organizations_details:role_name'), 'field'=>'role_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:vw_organizations_details:nbr_of_users'), 'field'=>'nbr_of_users', 'min'=>'2', 'max'=>'255', ],
        ]);
    }

    /**
      * This method is used to save data to the vw_organizations_details table. It can be used to 
      * insert or update. If $org_id is set to zero, then a new row 
      * will be created. The final parameter (bool $do_redirect) will determine if 
      * the response will be redirected to the data table for vw_organizations_details. 
      *
      * @param string $org_id Corresponds to database column vw_organizations_details.org_id.
      * @param string $name Corresponds to database column vw_organizations_details.name.
      * @param string $role_id Corresponds to database column vw_organizations_details.role_id.
      * @param string $role_name Corresponds to database column vw_organizations_details.role_name.
      * @param string $nbr_of_users Corresponds to database column vw_organizations_details.nbr_of_users.
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(string $org_id, string $name, string $role_id, string $role_name, string $nbr_of_users, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $org_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = lucid::$mvc->model('vw_organizations_details', $org_id, false);

        $data->name         = $name;
        $data->role_id      = $role_id;
        $data->role_name    = $role_name;
        $data->nbr_of_users = $nbr_of_users;
        $data->save();

        if ($do_redirect === true) {
            lucid::redirect('vw_organizations_details-table');
        }
    }

    /**
      * This method is used to delete a row from the vw_organizations_details table. The final parameter (bool $do_redirect)
      * will determine if the response will be redirected to the data table for vw_organizations_details.
      *
      * @param int $org_id Corresponds to database column vw_organizations_details.org_id
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function delete(int $org_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::$mvc->model('vw_organizations_details')->where('org_id', $org_id)->delete_many();
        if ($do_redirect === true) {
            lucid::redirect('vw_organizations_details-table');
        }
    }
}
