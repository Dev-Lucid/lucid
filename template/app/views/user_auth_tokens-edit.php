<?php
namespace DevLucid;

# The names of any variables this view needs passed in order to load should be passed to
# lucid::requireParameters. This function will throw an error if those variables are not present and
# log a message that describes the problem as best as possible.
lucid::requireParameters('token_id');

# By default, require that the user be logged in to access the edit form. If you want additional
# permissions, use the lucid::$security->requirePermission() function.
lucid::$security->requireLogin();
# lucid::$security->requirePermission('user_auth_tokens-select');

# Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
# by calling lucid::$response->description() or lucid::$response->keywords()
lucid::$response->title(_('branding:app_name').' - User_auth_tokens');

# Render the navigation controller.
lucid::controller('navigation')->render('view.user_auth_tokens-table', 'view.user_auth_tokens-edit');

# Load the model. If $token_id == 0, then the model's ->create method will be called.
$data = lucid::model('user_auth_tokens', $token_id);

# the ->notFound method will throw an error if the first parameter === false, which will be the case
# if the model function is passed an ID that is not zero, but is not able to retrieve a row for that ID
lucid::$error->notFound($data, '#body');

# Based on whether or not the primary key for the model == 0, the header message will either be the dictionary
# key form:edit_new or form::edit_existing.
$headerMsg = _('form:edit_'.(($data->token_id == 0)?'new':'existing'), [
    'type'=>'user_auth_tokens',
    'name'=>$data->token,
]);

# Construct the form and retrieve the ruleset for the controller. You can have multiple functions in your
# controller if you want to have that controller accept submissions from different forms with different numbers
# of fields, but the auto-generated ruleset-returning function is simply called ->ruleset(). The ->send()
# method of the ruleset object packages up the rules into json, and sends them to the client so that they can be
# used clientside when the form submits.
$form = html::form('user_auth_tokens-edit', '#!user_auth_tokens.save');
lucid::controller('user_auth_tokens')->ruleset()->send($form->name);

$user_id_options = lucid::model('users')
    ->select('user_id', 'value')
    ->select('email', 'label')
    ->order_by_asc('email')
    ->find_array();
$user_id_options = array_merge([0, ''], $user_id_options);

# create the main structure for the form
$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::formGroup(_('model:user_auth_tokens:user_id'), html::select('user_id', $data->user_id, $user_id_options)),
    html::formGroup(_('model:user_auth_tokens:token'), html::input('text', 'token', $data->token)),
    html::formGroup(_('model:user_auth_tokens:created_on'), html::input('text', 'created_on', $data->created_on)),
    html::input('hidden', 'token_id', $data->token_id),
]);
$card->footer()->add(html::formButtons());

$form->add($card);
lucid::$response->replace('#full-width', $form);