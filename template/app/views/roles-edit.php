<?php
namespace DevLucid;

# The names of any variables this view needs passed in order to load should be passed to
# lucid::requireParameters. This function will throw an error if those variables are not present and
# log a message that describes the problem as best as possible.
lucid::requireParameters('role_id');

# By default, require that the user be logged in to access the edit form. If you want additional
# permissions, use the lucid::$security->requirePermission() function.
lucid::$security->requireLogin();
# lucid::$security->requirePermission('roles-select');

# Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
# by calling lucid::$response->description() or lucid::$response->keywords()
lucid::$response->title(_('branding:app_name').' - Roles');

# Render the navigation controller.
lucid::$mvc->controller('navigation')->render('view.dashboard', 'view.roles-table', 'view.roles-edit');

# Load the model. If $role_id == 0, then the model's ->create method will be called.
$data = lucid::$mvc->model('roles', $role_id);

# the ->notFound method will throw an error if the first parameter === false, which will be the case
# if the model function is passed an ID that is not zero, but is not able to retrieve a row for that ID
lucid::$error->notFound($data, '#body');

# Based on whether or not the primary key for the model == 0, the header message will either be the dictionary
# key form:edit_new or form::edit_existing.
$headerMsg = _('form:edit_'.(($data->role_id == 0)?'new':'existing'), [
    'type'=>'roles',
    'name'=>$data->name,
]);

# Construct the form and retrieve the ruleset for the controller. You can have multiple functions in your
# controller if you want to have that controller accept submissions from different forms with different numbers
# of fields, but the auto-generated ruleset-returning function is simply called ->ruleset(). The ->send()
# method of the ruleset object packages up the rules into json, and sends them to the client so that they can be
# used clientside when the form submits.
$form = html::form('roles-edit', '#!roles.save');
lucid::$mvc->controller('roles')->ruleset()->send($form->name);

# create the main structure for the form
$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::formGroup(_('model:roles:name'), html::input('text', 'name', $data->name)),
    html::input('hidden', 'role_id', $data->role_id),
]);
$card->footer()->add(html::formButtons());

$form->add($card);
lucid::$response->replace('#right-col', $form);