<?php
namespace App\Controller;
use App\App, Lucid\Lucid, Lucid\Html\html;

/**
  * Organizations Controller
  *
  * @package Organizations
  */
class Organizations extends \App\Controller
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
      * Gets a single row from the organizations table. Note that this method calls
      * $this->getList(), so any permission/business rules that are applied in that function
      * will also be applied.
      *
      * @return \App\Model\Organizations
      */
    public function getOne(int $org_id)
    {
        if ($org_id == 0) {
            return $this->model()->create();
        }
        return $this->getList()->find_one($org_id);
    }

    /**
      * Updates an existing row or inserts a new row into table organizations.
      *
      * @param int $org_id
      * @param int $role_id
      * @param string $name
      * @param bool $is_enabled
      * @param \DateTime $created_on
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(int $org_id, int $role_id, string $name, bool $is_enabled, \DateTime $created_on, bool $do_redirect=true)
    {
        lucid::$app->logger()->debug('starting save function');
        #lucid::$app->permission()->requireLogin();
        # lucid::$app->$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->edit()->validateParameters(func_get_args());
        lucid::$app->logger()->debug('done with parameter check');

        # This loads the table row that you are trying to update. If $org_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = $this->getOne($org_id);
        lucid::$app->logger()->debug('data loaded');

		$data->role_id = $role_id;
		$data->name = $name;
		$data->is_enabled = $is_enabled;
		$data->created_on = $created_on->format(\DateTime::ISO8601);
        lucid::$app->logger()->debug('about to save');
        $data->save();

        lucid::$app->logger()->debug('done saving');
        lucid::$app->response()->message(lucid::$app->i18n()->translate('button:save_response'));
        if ($do_redirect === true) {
            lucid::$app->response()->redirect('organizations','table');
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
        #lucid::$app->permission()->requireLogin();
        # lucid::$app->$security->requirePermission('delete'); # add required permissions to this array

        $this->getOne($org_id)->delete();
        lucid::$app->response()->message(lucid::$app->i18n()->translate('button:delete_response'));
        if ($do_redirect === true) {
            lucid::$app->response()->redirect('organizations','table');
        }
    }
}
