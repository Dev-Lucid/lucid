<?php
namespace DevLucid;

/**
  * ControllerRegions
  *
  * @package Regions
  */
class ControllerRegions extends Controller
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
            ['type'=>'anyValue', 'label'=>_('model:regions:country_id'), 'field'=>'country_id', ],
            ['type'=>'lengthRange', 'label'=>_('model:regions:abbreviation'), 'field'=>'abbreviation', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:regions:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:regions:type'), 'field'=>'type', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:regions:parent'), 'field'=>'parent', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'checked', 'label'=>_('model:regions:is_parent'), 'field'=>'is_parent', ],
        ]);
    }

    /**
      * This method is used to save data to the regions table. It can be used to 
      * insert or update. If $region_id is set to zero, then a new row 
      * will be created. The final parameter (bool $do_redirect) will determine if 
      * the response will be redirected to the data table for regions. 
      *
      * @param string $region_id Corresponds to database column regions.region_id.
      * @param string $country_id Corresponds to database column regions.country_id.
      * @param string $abbreviation Corresponds to database column regions.abbreviation.
      * @param string $name Corresponds to database column regions.name.
      * @param string $type Corresponds to database column regions.type.
      * @param string $parent Corresponds to database column regions.parent.
      * @param bool $is_parent Corresponds to database column regions.is_parent.
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(string $region_id, string $country_id, string $abbreviation, string $name, string $type, string $parent, bool $is_parent, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $region_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = lucid::model('regions', $region_id, false);

        $data->country_id   = $country_id;
        $data->abbreviation = $abbreviation;
        $data->name         = $name;
        $data->type         = $type;
        $data->parent       = $parent;
        $data->is_parent    = $is_parent;
        $data->save();

        if ($do_redirect === true) {
            lucid::redirect('regions-table');
        }
    }

    /**
      * This method is used to delete a row from the regions table. The final parameter (bool $do_redirect)
      * will determine if the response will be redirected to the data table for regions.
      *
      * @param int $region_id Corresponds to database column regions.region_id
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function delete(int $region_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('regions')->where('region_id', $region_id)->delete_many();
        if ($do_redirect === true) {
            lucid::redirect('regions-table');
        }
    }
}
