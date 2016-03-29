<?php
namespace App\Controller;
use App\App, Lucid\Lucid, Lucid\Html\html;

/**
  * {{uc(table)}} Controller
  *
  * @package {{uc(table)}}
  */
class {{uc(table)}} extends \App\Controller
{
    public function getList()
    {
        $data = $this->model();

        # put additional where clauses here!
        # Ex: $data->where('org_id', lucid::session()->int('user_id'));

        return $data;
    }

    public function getOne({{primary_key_col_type}} ${{id}})
    {
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
        #lucid::permission()->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset('edit')->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If ${{id}} === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = $this->getOne(${{id}});

{{save_actions}}        $data->save();

        if ($do_redirect === true) {
            lucid::response()->redirect('{{table}}','table');
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
        #lucid::permission()->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        $this->getOne(${{id}})->delete();
        if ($do_redirect === true) {
            lucid::response()->redirect('{{table}}','table');
        }
    }
}
