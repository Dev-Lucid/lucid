<?php
namespace DevLucid;

/**
  * ControllerPatches
  *
  * @package Patches
  */
class ControllerPatches extends Controller implements ControllerInterface
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
            ['type'=>'lengthRange', 'label'=>_('model:patches:identifier'), 'field'=>'identifier', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'validDate', 'label'=>_('model:patches:applied_on_date'), 'field'=>'applied_on_date', ],
        ]);
    }

    /**
      * This method is used to save data to the patches table. It can be used to 
      * insert or update. If $patch_id is set to zero, then a new row 
      * will be created. The final parameter (bool $do_redirect) will determine if 
      * the response will be redirected to the data table for patches. 
      *
      * @param int $patch_id Corresponds to database column patches.patch_id.
      * @param string $identifier Corresponds to database column patches.identifier.
      * @param \DateTime $applied_on_date Corresponds to database column patches.applied_on_date.
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(int $patch_id, string $identifier, \DateTime $applied_on_date, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $patch_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = lucid::$mvc->model('patches', $patch_id, false);

        $data->identifier      = $identifier;
        $data->applied_on_date = $applied_on_date->format(\DateTime::ISO8601);
        $data->save();

        if ($do_redirect === true) {
            lucid::redirect('patches-table');
        }
    }

    /**
      * This method is used to delete a row from the patches table. The final parameter (bool $do_redirect)
      * will determine if the response will be redirected to the data table for patches.
      *
      * @param int $patch_id Corresponds to database column patches.patch_id
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function delete(int $patch_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::$mvc->model('patches')->where('patch_id', $patch_id)->delete_many();
        if ($do_redirect === true) {
            lucid::redirect('patches-table');
        }
    }
}
