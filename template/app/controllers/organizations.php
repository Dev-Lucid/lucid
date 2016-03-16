<?php
namespace DevLucid;

/**
  * ControllerOrganizations
  *
  * @package Organizations
  */
class ControllerOrganizations extends Controller
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
        return new Ruleset([
            ['type'=>'length_range', 'label'=>_('model:organizations:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
        ]);
    }

    /**
      * This method is used to save data to the organizations table. It can be used to 
      * insert or update. If $org_id is set to zero, then a new row 
      * will be created. The final parameter (bool $do_redirect) will determine if 
      * the response will be redirected to the data table for organizations. 
      *
      * @param int $org_id Corresponds to database column organizations.org_id.
      * @param int $role_id Corresponds to database column organizations.role_id.
      * @param string $name Corresponds to database column organizations.name.
      * @param bool $is_enabled Corresponds to database column organizations.is_enabled.
      * @param \DateTime $created_on Corresponds to database column organizations.created_on.
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(int $org_id, int $role_id, string $name, bool $is_enabled, \DateTime $created_on, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $org_id contains 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = lucid::model('organizations', $org_id, false);

        $data->role_id    = $role_id;
        $data->name       = $name;
        $data->is_enabled = $is_enabled;
        $data->created_on = $created_on->format(\DateTime::ISO8601);
        $data->save();

        if ($do_redirect === true) {
            lucid::redirect('organizations-table');
        }
    }

    /**
      * This method is used to delete a row from the organizations table. The final parameter (bool $do_redirect)
      * will determine if the response will be redirected to the data table for organizations.
      *
      * @param int $org_id Corresponds to database column organizations.org_id
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function delete(int $org_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('organizations')->where('org_id', $org_id)->delete_many();
        if ($do_redirect === true) {
            lucid::redirect('organizations-table');
        }
    }
}
