<?php
namespace DevLucid;

/**
  * ControllerAddresses
  *
  * @package Addresses
  */
class ControllerAddresses extends Controller
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
            ['type'=>'anyValue', 'label'=>_('model:addresses:org_id'), 'field'=>'org_id', ],
            ['type'=>'lengthRange', 'label'=>_('model:addresses:name'), 'field'=>'name', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:addresses:street_1'), 'field'=>'street_1', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:addresses:street_2'), 'field'=>'street_2', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:addresses:city'), 'field'=>'city', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'anyValue', 'label'=>_('model:addresses:region_id'), 'field'=>'region_id', ],
            ['type'=>'lengthRange', 'label'=>_('model:addresses:postal_code'), 'field'=>'postal_code', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'anyValue', 'label'=>_('model:addresses:country_id'), 'field'=>'country_id', ],
            ['type'=>'lengthRange', 'label'=>_('model:addresses:phone_number_1'), 'field'=>'phone_number_1', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'lengthRange', 'label'=>_('model:addresses:phone_number_2'), 'field'=>'phone_number_2', 'min'=>'2', 'max'=>'255', ],
        ]);
    }

    /**
      * This method is used to save data to the addresses table. It can be used to 
      * insert or update. If $address_id is set to zero, then a new row 
      * will be created. The final parameter (bool $do_redirect) will determine if 
      * the response will be redirected to the data table for addresses. 
      *
      * @param int $address_id Corresponds to database column addresses.address_id.
      * @param int $org_id Corresponds to database column addresses.org_id.
      * @param string $name Corresponds to database column addresses.name.
      * @param string $street_1 Corresponds to database column addresses.street_1.
      * @param string $street_2 Corresponds to database column addresses.street_2.
      * @param string $city Corresponds to database column addresses.city.
      * @param string $region_id Corresponds to database column addresses.region_id.
      * @param string $postal_code Corresponds to database column addresses.postal_code.
      * @param string $country_id Corresponds to database column addresses.country_id.
      * @param string $phone_number_1 Corresponds to database column addresses.phone_number_1.
      * @param string $phone_number_2 Corresponds to database column addresses.phone_number_2.
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(int $address_id, int $org_id, string $name, string $street_1, string $street_2, string $city, string $region_id, string $postal_code, string $country_id, string $phone_number_1, string $phone_number_2, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $address_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = lucid::$mvc->model('addresses', $address_id, false);

        $data->org_id         = $org_id;
        $data->name           = $name;
        $data->street_1       = $street_1;
        $data->street_2       = $street_2;
        $data->city           = $city;
        $data->region_id      = $region_id;
        $data->postal_code    = $postal_code;
        $data->country_id     = $country_id;
        $data->phone_number_1 = $phone_number_1;
        $data->phone_number_2 = $phone_number_2;
        $data->save();

        if ($do_redirect === true) {
            lucid::redirect('addresses-table');
        }
    }

    /**
      * This method is used to delete a row from the addresses table. The final parameter (bool $do_redirect)
      * will determine if the response will be redirected to the data table for addresses.
      *
      * @param int $address_id Corresponds to database column addresses.address_id
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function delete(int $address_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::$mvc->model('addresses')->where('address_id', $address_id)->delete_many();
        if ($do_redirect === true) {
            lucid::redirect('addresses-table');
        }
    }
}
