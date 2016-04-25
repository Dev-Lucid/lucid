<?php
namespace App\Controller;
use App\App, Lucid\Lucid, Lucid\Html\html;

/**
  * Addresses Controller
  *
  * @package Addresses
  */
class Addresses extends \App\Controller
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
        # Ex: $data->where('org_id', lucid::$app->session()->int('user_id'));

        return $data;
    }

    /**
      * Gets a single row from the addresses table. Note that this method calls
      * $this->getList(), so any permission/business rules that are applied in that function
      * will also be applied.
      *
      * @return \App\Model\Addresses
      */
    public function getOne(int $address_id)
    {
        if ($address_id == 0) {
            return $this->model()->create();
        }
        return $this->getList()->find_one($address_id);
    }

    /**
      * Updates an existing row or inserts a new row into table addresses.
      *
      * @param int $address_id
      * @param int $org_id
      * @param string $name
      * @param string $street_1
      * @param string $street_2
      * @param string $city
      * @param string $region_id
      * @param string $postal_code
      * @param string $country_id
      * @param string $phone_number_1
      * @param string $phone_number_2
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(int $address_id, int $org_id, string $name, string $street_1, string $street_2, string $city, string $region_id, string $postal_code, string $country_id, string $phone_number_1, string $phone_number_2, bool $do_redirect=true)
    {
        #lucid::$app->permission()->requireLogin();
        # lucid::$app->$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset('edit')->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $address_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = $this->getOne($address_id);

		$data->org_id = $org_id;
		$data->name = $name;
		$data->street_1 = $street_1;
		$data->street_2 = $street_2;
		$data->city = $city;
		$data->region_id = $region_id;
		$data->postal_code = $postal_code;
		$data->country_id = $country_id;
		$data->phone_number_1 = $phone_number_1;
		$data->phone_number_2 = $phone_number_2;
        $data->save();

        lucid::$app->response()->message(lucid::$app->i18n()->translate('button:save_response'));
        if ($do_redirect === true) {
            lucid::$app->response()->redirect('addresses','table');
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
        #lucid::$app->permission()->requireLogin();
        # lucid::$app->$security->requirePermission('delete'); # add required permissions to this array

        $this->getOne($address_id)->delete();
        lucid::$app->response()->message(lucid::$app->i18n()->translate('button:delete_response'));
        if ($do_redirect === true) {
            lucid::$app->response()->redirect('addresses','table');
        }
    }
}
