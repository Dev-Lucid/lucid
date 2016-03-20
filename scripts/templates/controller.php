<?php
namespace DevLucid;

/**
  * Controller{{uc(table)}}
  *
  * @package {{uc(table)}}
  */
class Controller{{uc(table)}} extends Controller
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
{{rules}}        ]);
    }

    /**
{{phpdoc_save_summary}}
      *
{{phpdoc_save_params}}      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save({{save_parameters}}bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If ${{id}} === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = lucid::$mvc->model('{{table}}', ${{id}}, false);

{{save_actions}}        $data->save();

        if ($do_redirect === true) {
            lucid::redirect('{{table}}-table');
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
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::$mvc->model('{{table}}')->where('{{id}}', ${{id}})->delete_many();
        if ($do_redirect === true) {
            lucid::redirect('{{table}}-table');
        }
    }
}
