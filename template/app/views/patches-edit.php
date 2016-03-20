<?php
namespace DevLucid;

# The names of any variables this view needs passed in order to load should be passed to
# lucid::requireParameters. This function will throw an error if those variables are not present and
# log a message that describes the problem as best as possible.
lucid::requireParameters('patch_id');

# By default, require that the user be logged in to access the edit form. If you want additional
# permissions, use the lucid::$security->requirePermission() function.
lucid::$security->requireLogin();
# lucid::$security->requirePermission('patches-select');

# Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
# by calling lucid::$response->description() or lucid::$response->keywords()
lucid::$response->title(_('branding:app_name').' - Patches');

# Render the navigation controller.
lucid::$mvc->controller('navigation')->render('view.patches-table', 'view.patches-edit');

# Load the model. If $patch_id == 0, then the model's ->create method will be called.
$data = lucid::$mvc->model('patches', $patch_id);

# the ->notFound method will throw an error if the first parameter === false, which will be the case
# if the model function is passed an ID that is not zero, but is not able to retrieve a row for that ID
lucid::$error->notFound($data, '#body');

# Based on whether or not the primary key for the model == 0, the header message will either be the dictionary
# key form:edit_new or form::edit_existing.
$headerMsg = _('form:edit_'.(($data->patch_id == 0)?'new':'existing'), [
    'type'=>'patches',
    'name'=>$data->identifier,
]);

# Construct the form and retrieve the ruleset for the controller. You can have multiple functions in your
# controller if you want to have that controller accept submissions from different forms with different numbers
# of fields, but the auto-generated ruleset-returning function is simply called ->ruleset(). The ->send()
# method of the ruleset object packages up the rules into json, and sends them to the client so that they can be
# used clientside when the form submits.
$form = html::form('patches-edit', '#!patches.save');
lucid::$mvc->controller('patches')->ruleset()->send($form->name);

# create the main structure for the form
$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::formGroup(_('model:patches:identifier'), html::input('text', 'identifier', $data->identifier)),
    html::formGroup(_('model:patches:applied_on_date'), html::input('date', 'applied_on_date', (new \DateTime($data->applied_on_date))->format('Y-m-d H:i'))),
    html::input('hidden', 'patch_id', $data->patch_id),
]);
$card->footer()->add(html::formButtons());

$form->add($card);
lucid::$response->replace('#full-width', $form);