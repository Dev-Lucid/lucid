<?php
namespace DevLucid;

/**
  * ControllerCountries
  *
  * @package Countries
  */
class ControllerCountries extends Controller
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
            ['type'=>'length_range', 'label'=>_('model:countries:alpha_3'), 'field'=>'alpha_3', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:countries:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:countries:common_name'), 'field'=>'common_name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'length_range', 'label'=>_('model:countries:official_name'), 'field'=>'official_name', 'min'=>'2', 'max'=>'255', ],
        ]);
    }

    /**
      * This method is used to save data to the countries table. It can be used to 
      * insert or update. If $country_id is set to zero, then a new row 
      * will be created. The final parameter (bool $do_redirect) will determine if 
      * the response will be redirected to the data table for countries. 
      *
      * @param string $country_id Corresponds to database column countries.country_id.
      * @param string $alpha_3 Corresponds to database column countries.alpha_3.
      * @param string $name Corresponds to database column countries.name.
      * @param string $common_name Corresponds to database column countries.common_name.
      * @param string $official_name Corresponds to database column countries.official_name.
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(string $country_id, string $alpha_3, string $name, string $common_name, string $official_name, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $country_id contains 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = lucid::model('countries', $country_id, false);

        $data->alpha_3       = $alpha_3;
        $data->name          = $name;
        $data->common_name   = $common_name;
        $data->official_name = $official_name;
        $data->save();

        if ($do_redirect === true) {
            lucid::redirect('countries-table');
        }
    }

    /**
      * This method is used to delete a row from the countries table. The final parameter (bool $do_redirect)
      * will determine if the response will be redirected to the data table for countries.
      *
      * @param int $country_id Corresponds to database column countries.country_id
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function delete(int $country_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('countries')->where('country_id', $country_id)->delete_many();
        if ($do_redirect === true) {
            lucid::redirect('countries-table');
        }
    }
}
