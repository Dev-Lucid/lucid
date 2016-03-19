<?php
namespace DevLucid;

/**
  * ControllerRoles
  *
  * @package Roles
  */
class ControllerRoles extends Controller
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
            ['type'=>'lengthRange', 'label'=>_('model:roles:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
        ]);
    }

    /**
      * This method is used to save data to the roles table. It can be used to 
      * insert or update. If $role_id is set to zero, then a new row 
      * will be created. The final parameter (bool $do_redirect) will determine if 
      * the response will be redirected to the data table for roles. 
      *
      * @param int $role_id Corresponds to database column roles.role_id.
      * @param string $name Corresponds to database column roles.name.
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(int $role_id, string $name, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $role_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = lucid::model('roles', $role_id, false);

        $data->name = $name;
        $data->save();

        if ($do_redirect === true) {
            lucid::redirect('roles-table');
        }
    }

    /**
      * This method is used to delete a row from the roles table. The final parameter (bool $do_redirect)
      * will determine if the response will be redirected to the data table for roles.
      *
      * @param int $role_id Corresponds to database column roles.role_id
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function delete(int $role_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('roles')->where('role_id', $role_id)->delete_many();
        if ($do_redirect === true) {
            lucid::redirect('roles-table');
        }
    }
}
