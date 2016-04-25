<?php
namespace App\Controller;
use App\App, Lucid\Lucid, Lucid\Html\html;

/**
  * Contents Controller
  *
  * @package Contents
  */
class Contents extends \App\Controller
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
      * Gets a single row from the contents table. Note that this method calls
      * $this->getList(), so any permission/business rules that are applied in that function
      * will also be applied.
      *
      * @return \App\Model\Contents
      */
    public function getOne(int $content_id)
    {
        if ($content_id == 0) {
            return $this->model()->create();
        }
        return $this->getList()->find_one($content_id);
    }

    /**
      * Updates an existing row or inserts a new row into table contents.
      *
      * @param int $content_id
      * @param string $title
      * @param string $body
      * @param bool $is_public
      * @param \DateTime $creation_date
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(int $content_id, string $title, string $body, bool $is_public, \DateTime $creation_date, bool $do_redirect=true)
    {
        #lucid::$app->permission()->requireLogin();
        # lucid::$app->$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset('edit')->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $content_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = $this->getOne($content_id);

		$data->title = $title;
		$data->body = $body;
		$data->is_public = $is_public;
		$data->creation_date = $creation_date->format(\DateTime::ISO8601);
        $data->save();

        lucid::$app->response()->message(lucid::$app->i18n()->translate('button:save_response'));
        if ($do_redirect === true) {
            lucid::$app->response()->redirect('contents','table');
        }
    }

    /**
      * This method is used to delete a row from the contents table. The final parameter (bool $do_redirect)
      * will determine if the response will be redirected to the data table for contents.
      *
      * @param int $content_id Corresponds to database column contents.content_id
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function delete(int $content_id, bool $do_redirect=true)
    {
        #lucid::$app->permission()->requireLogin();
        # lucid::$app->$security->requirePermission('delete'); # add required permissions to this array

        $this->getOne($content_id)->delete();
        lucid::$app->response()->message(lucid::$app->i18n()->translate('button:delete_response'));
        if ($do_redirect === true) {
            lucid::$app->response()->redirect('contents','table');
        }
    }
}
