<?php
namespace App\Controller;
use App\App, Lucid\Lucid, Lucid\Html\html;

/**
  * Regions Controller
  *
  * @package Regions
  */
class Regions extends \App\Controller
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
        # Ex: $data->where('org_id', lucid::session()->int('user_id'));

        return $data;
    }

    /**
      * Gets a single row from the regions table. Note that this method calls
      * $this->getList(), so any permission/business rules that are applied in that function
      * will also be applied.
      *
      * @return \App\Model\Regions
      */
    public function getOne(string $region_id)
    {
        if (is_numeric($region_id) === true && $region_id == 0) {
            return $this->model()->create();
        }
        return $this->getList()->find_one($region_id);
    }

    /**
      * Updates an existing row or inserts a new row into table regions.
      *
      * @param string $region_id
      * @param string $country_id
      * @param string $abbreviation
      * @param string $name
      * @param string $type
      * @param string $parent
      * @param bool $is_parent
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(string $region_id, string $country_id, string $abbreviation, string $name, string $type, string $parent, bool $is_parent, bool $do_redirect=true)
    {
        #lucid::permission()->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset('edit')->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $region_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = $this->getOne($region_id);

		$data->country_id = $country_id;
		$data->abbreviation = $abbreviation;
		$data->name = $name;
		$data->type = $type;
		$data->parent = $parent;
		$data->is_parent = $is_parent;
        $data->save();

        lucid::response()->message(lucid::i18n()->translate('button:save_response'));
        if ($do_redirect === true) {
            lucid::response()->redirect('regions','table');
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
        #lucid::permission()->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        $this->getOne($region_id)->delete();
        lucid::response()->message(lucid::i18n()->translate('button:delete_response'));
        if ($do_redirect === true) {
            lucid::response()->redirect('regions','table');
        }
    }
}
