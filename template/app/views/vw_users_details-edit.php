<?php
namespace DevLucid;

# The names of any variables this view needs passed in order to load should be passed to
# lucid::requireParameters. This function will throw an error if those variables are not present and
# log a message that describes the problem as best as possible.
lucid::requireParameters('user_id');

# By default, require that the user be logged in to access the edit form. If you want additional
# permissions, use the lucid::$security->requirePermission() function.
lucid::$security->requireLogin();
# lucid::$security->requirePermission('vw_users_details-select');

# Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
# by calling lucid::$response->description() or lucid::$response->keywords()
lucid::$response->title(_('branding:app_name').' - Vw_users_details');

# Render the navigation controller.
lucid::controller('navigation')->render('view.vw_users_details-table', 'view.vw_users_details-edit');

# Load the model. If $user_id == 0, then the model's ->create method will be called.
$data = lucid::model('vw_users_details', $user_id);

# the ->notFound method will throw an error if the first parameter === false, which will be the case
# if the model function is passed an ID that is not zero, but is not able to retrieve a row for that ID
lucid::$error->notFound($data, '#body');

# Based on whether or not the primary key for the model == 0, the header message will either be the dictionary
# key form:edit_new or form::edit_existing.
$headerMsg = _('form:edit_'.(($data->user_id == 0)?'new':'existing'), [
    'type'=>'vw_users_details',
    'name'=>$data->email,
]);

# Construct the form and retrieve the ruleset for the controller. You can have multiple functions in your
# controller if you want to have that controller accept submissions from different forms with different numbers
# of fields, but the auto-generated ruleset-returning function is simply called ->ruleset(). The ->send()
# method of the ruleset object packages up the rules into json, and sends them to the client so that they can be
# used clientside when the form submits.
$form = html::form('vw_users_details-edit', '#!vw_users_details.save');
lucid::controller('vw_users_details')->ruleset()->send($form->name);

# create the main structure for the form
$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::formGroup(_('model:vw_users_details:email'), html::input('text', 'email', $data->email)),
    html::formGroup(_('model:vw_users_details:password'), html::input('text', 'password', $data->password)),
    html::formGroup(_('model:vw_users_details:first_name'), html::input('text', 'first_name', $data->first_name)),
    html::formGroup(_('model:vw_users_details:last_name'), html::input('text', 'last_name', $data->last_name)),
    html::formGroup(_('model:vw_users_details:org_id'), html::input('text', 'org_id', $data->org_id)),
    html::formGroup(_('model:vw_users_details:organization_name'), html::input('text', 'organization_name', $data->organization_name)),
    html::formGroup(_('model:vw_users_details:role_id'), html::input('text', 'role_id', $data->role_id)),
    html::formGroup(_('model:vw_users_details:role_name'), html::input('text', 'role_name', $data->role_name)),
    html::input('hidden', 'user_id', $data->user_id),
]);
$card->footer()->add(html::formButtons());

$form->add($card);
lucid::$response->replace('#full-width', $form);