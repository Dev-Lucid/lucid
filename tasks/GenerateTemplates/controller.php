<?php
namespace App\Controller;
use App\App, Lucid\Lucid, Lucid\Html\html;

/**
      * {{name}} Controller
  *
  * @package {{name}}
  */
class {{name}} extends \App\Controller
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
      * Gets a single row from the {{table}} table. Note that this method calls
      * $this->getList(), so any permission/business rules that are applied in that function
      * will also be applied.
      *
      * @return \App\Model\{{name}}
      */
    public function getOne({{primary_key_col_type}} ${{id}})
    {
        if (is_numeric(${{id}}) === true && ${{id}} == 0) {
            return $this->model()->create();
        }
        return $this->getList()->find_one(${{id}});
    }

    /**
      * Updates an existing row or inserts a new row into table {{table}}.
      *
{{phpdoc_save_parameters}}      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save({{save_parameters}}bool $do_redirect=true)
    {
        #lucid::$app->permission()->requireLogin();
        # lucid::$app->$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->edit()->validateParameters(func_get_args());

        # This loads the table row that you are trying to update. If ${{id}} === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = $this->getOne(${{id}});

{{save_actions}}        $data->save();

        lucid::$app->response()->message(lucid::$app->i18n()->translate('button:save_response'));
        if ($do_redirect === true) {
            lucid::$app->response()->redirect('{{name}}','table');
        }
    }

    /**
      * This method is used to delete a row from the {{table}} table. The final parameter (bool $do_redirect)
      * will determine if the response will be redirected to the data table for {{table}}.
      *
      * @param int ${{id}} Corresponds to database column {{table}}.{{id}}
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function delete(int ${{id}}, bool $do_redirect=true)
    {
        #lucid::$app->permission()->requireLogin();
        # lucid::$app->$security->requirePermission('delete'); # add required permissions to this array

        $this->getOne(${{id}})->delete();
        lucid::$app->response()->message(lucid::$app->i18n()->translate('button:delete_response'));
        if ($do_redirect === true) {
            lucid::$app->response()->redirect('{{name}}','table');
        }
    }
}
