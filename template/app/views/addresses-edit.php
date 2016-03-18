<?php
namespace DevLucid;

# The names of any variables this view needs passed in order to load should be passed to
# lucid::requireParameters. This function will throw an error if those variables are not present and
# log a message that describes the problem as best as possible.
lucid::requireParameters('address_id');

# By default, require that the user be logged in to access the edit form. If you want additional
# permissions, use the lucid::$security->requirePermission() function.
lucid::$security->requireLogin();
# lucid::$security->requirePermission('addresses-select');

# Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
# by calling lucid::$response->description() or lucid::$response->keywords()
lucid::$response->title(_('branding:app_name').' - Addresses');

# Render the navigation controller.
lucid::controller('navigation')->render('view.addresses-table', 'view.addresses-edit');

# Load the model. If $address_id == 0, then the model's ->create method will be called.
$data = lucid::model('addresses', $address_id);

# the ->notFound method will throw an error if the first parameter === false, which will be the case
# if the model function is passed an ID that is not zero, but is not able to retrieve a row for that ID
lucid::$error->notFound($data, '#body');

# Based on whether or not the primary key for the model == 0, the header message will either be the dictionary
# key form:edit_new or form::edit_existing.
$headerMsg = _('form:edit_'.(($data->address_id == 0)?'new':'existing'), [
    'type'=>'addresses',
    'name'=>$data->name,
]);

# Construct the form and retrieve the ruleset for the controller. You can have multiple functions in your
# controller if you want to have that controller accept submissions from different forms with different numbers
# of fields, but the auto-generated ruleset-returning function is simply called ->ruleset(). The ->send()
# method of the ruleset object packages up the rules into json, and sends them to the client so that they can be
# used clientside when the form submits.
$form = html::form('addresses-edit', '#!addresses.save');
lucid::controller('addresses')->ruleset()->send($form->name);

$org_id_options = lucid::model('organizations')
    ->select('org_id', 'value')
    ->select('name', 'label')
    ->order_by_asc('name')
    ->find_array();
$org_id_options = array_merge([0, ''], $org_id_options);

# create the main structure for the form
$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::formGroup(_('model:addresses:org_id'), html::select('org_id', $data->org_id, $org_id_options)),
    html::formGroup(_('model:addresses:name'), html::input('text', 'name', $data->name)),
    html::formGroup(_('model:addresses:street_1'), html::input('text', 'street_1', $data->street_1)),
    html::formGroup(_('model:addresses:street_2'), html::input('text', 'street_2', $data->street_2)),
    html::formGroup(_('model:addresses:city'), html::input('text', 'city', $data->city)),
    html::formGroup(_('model:addresses:region_id'), html::input('text', 'region_id', $data->region_id)),
    html::formGroup(_('model:addresses:postal_code'), html::input('text', 'postal_code', $data->postal_code)),
    html::formGroup(_('model:addresses:country_id'), html::input('text', 'country_id', $data->country_id)),
    html::formGroup(_('model:addresses:phone_number_1'), html::input('text', 'phone_number_1', $data->phone_number_1)),
    html::formGroup(_('model:addresses:phone_number_2'), html::input('text', 'phone_number_2', $data->phone_number_2)),
    html::input('hidden', 'address_id', $data->address_id),
]);
$card->footer()->add(html::formButtons());

$form->add($card);
lucid::$response->replace('#full-width', $form);