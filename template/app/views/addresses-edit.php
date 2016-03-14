<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.addresses-table', 'view.addresses-edit');

$data = lucid::model('addresses', $address_id);
lucid::$error->notFound($data, '#body');
$header_msg = _('form:edit_'.(($data->address_id == 0)?'new':'existing'), [
    'type'=>'addresses',
    'name'=>$data->name,
]);

$form = html::form('addresses-edit', '#!addresses.save');
lucid::controller('addresses')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($header_msg);
$card->block()->add([
	html::form_group(_('model:addresses:name'), html::input('text', 'name', $data->name)),
	html::form_group(_('model:addresses:street_1'), html::input('text', 'street_1', $data->street_1)),
	html::form_group(_('model:addresses:street_2'), html::input('text', 'street_2', $data->street_2)),
	html::form_group(_('model:addresses:city'), html::input('text', 'city', $data->city)),
    html::input('hidden', 'address_id', $data->address_id),
]);
$card->footer(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);