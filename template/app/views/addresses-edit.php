<?php
namespace DevLucid;

lucid::requireParameters('address_id');
lucid::$security->requireLogin();
# lucid::$security->requirePermission('addresses-select'); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Addresses');
lucid::controller('navigation')->render('view.addresses-table', 'view.addresses-edit');

$data = lucid::model('addresses', $address_id);
lucid::$error->notFound($data, '#body');
$headerMsg = _('form:edit_'.(($data->address_id == 0)?'new':'existing'), [
    'type'=>'addresses',
    'name'=>$data->name,
]);

$form = html::form('addresses-edit', '#!addresses.save');
lucid::controller('addresses')->ruleset()->send($form->name);

$org_id_options = lucid::model('organizations')
    ->select('org_id', 'value')
    ->select('name', 'label')
    ->order_by_asc('name')
    ->find_array();

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::form_group(_('model:addresses:org_id'), html::select('org_id', $data->org_id, $org_id_options)),
    html::form_group(_('model:addresses:name'), html::input('text', 'name', $data->name)),
    html::form_group(_('model:addresses:street_1'), html::input('text', 'street_1', $data->street_1)),
    html::form_group(_('model:addresses:street_2'), html::input('text', 'street_2', $data->street_2)),
    html::form_group(_('model:addresses:city'), html::input('text', 'city', $data->city)),
    html::form_group(_('model:addresses:region_id'), html::input('text', 'region_id', $data->region_id)),
    html::form_group(_('model:addresses:postal_code'), html::input('text', 'postal_code', $data->postal_code)),
    html::form_group(_('model:addresses:country_id'), html::input('text', 'country_id', $data->country_id)),
    html::form_group(_('model:addresses:phone_number_1'), html::input('text', 'phone_number_1', $data->phone_number_1)),
    html::form_group(_('model:addresses:phone_number_2'), html::input('text', 'phone_number_2', $data->phone_number_2)),
    html::input('hidden', 'address_id', $data->address_id),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);