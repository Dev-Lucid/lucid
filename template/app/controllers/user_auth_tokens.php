<?php
namespace DevLucid;

/**
  * ControllerUser_auth_tokens
  *
  * @package User_auth_tokens
  */
class ControllerUser_auth_tokens extends Controller implements ControllerInterface
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
            ['type'=>'anyValue', 'label'=>_('model:user_auth_tokens:user_id'), 'field'=>'user_id', ],
            ['type'=>'lengthRange', 'label'=>_('model:user_auth_tokens:token'), 'field'=>'token', 'min'=>'2', 'max'=>'255', ],
            ['type'=>'integerValue', 'label'=>_('model:user_auth_tokens:created_on'), 'field'=>'created_on', ],
        ]);
    }

    /**
      * This method is used to save data to the user_auth_tokens table. It can be used to 
      * insert or update. If $token_id is set to zero, then a new row 
      * will be created. The final parameter (bool $do_redirect) will determine if 
      * the response will be redirected to the data table for user_auth_tokens. 
      *
      * @param int $token_id Corresponds to database column user_auth_tokens.token_id.
      * @param int $user_id Corresponds to database column user_auth_tokens.user_id.
      * @param string $token Corresponds to database column user_auth_tokens.token.
      * @param int $created_on Corresponds to database column user_auth_tokens.created_on.
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function save(int $token_id, int $user_id, string $token, int $created_on, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        # This will check the parameters passed to this function, and run them against the rules returned
        # from ->ruleset(). If the data does not pass validation, an error message is sent to the client
        # and the request ends. If the data passes validation, then processing continues. You do not
        # need to check if the data passes or not.
        $this->ruleset()->checkParameters(func_get_args());

        # This loads the table row that you are trying to update. If $token_id === 0, then the model's
        # ->create() method will be called. This does not actually insert a row into the database until the
        # ->save() method is called.
        $data = lucid::$mvc->model('user_auth_tokens', $token_id, false);

        $data->user_id    = $user_id;
        $data->token      = $token;
        $data->created_on = $created_on;
        $data->save();

        if ($do_redirect === true) {
            lucid::redirect('user_auth_tokens-table');
        }
    }

    /**
      * This method is used to delete a row from the user_auth_tokens table. The final parameter (bool $do_redirect)
      * will determine if the response will be redirected to the data table for user_auth_tokens.
      *
      * @param int $token_id Corresponds to database column user_auth_tokens.token_id
      * @param bool $do_redirect Determines whether or not to redirect back to the data table view.
      *
      * @return void
      */
    public function delete(int $token_id, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::$mvc->model('user_auth_tokens', $token_id)->delete();
        if ($do_redirect === true) {
            lucid::redirect('user_auth_tokens-table');
        }
    }
}
