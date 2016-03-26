<?php
namespace App\Controller;

/**
  * {{uc(table)}} Controller
  *
  * @package {{uc(table)}}
  */
class {{uc(table)}} extends \Lucid\Component\Factory\Controller implements \Lucid\Component\Factory\ControllerInterface
{
    /**
      * Updates an existing row or inserts a new row into table {{table}}.
      *
{{phpdoc_save_parameters}}      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save({{save_parameters}}bool $do_redirect=true)
    {
        lucid::permission()->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        lucid::factory()->ruleset('{{table}}')->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If ${{id}} === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = lucid::factory()->model('{{table}}', ${{id}}, false);

{{save_actions}}        $data->save();

        if ($do_redirect === true) {
            lucid::redirect('view.{{table}}.table');
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
        lucid::permission()->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::factory()->model('{{table}}', ${{id}})->delete();
        if ($do_redirect === true) {
            lucid::redirect('view.{{table}}.table');
        }
    }
}
