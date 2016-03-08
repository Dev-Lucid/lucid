<?php
lucid::$security->require_login();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.addresses-table', 'view.addresses-edit');

$data = lucid::model('addresses', $address_id);
lucid::$error->not_found($data, '#body');
$header_msg = _('form:edit_'.(($data->address_id == 0)?'new':'existing'), [
    'type'=>'addresses',
    'name'=>$data->name,
]);

$form = html::form('addresses-edit', '#!addresses.save');
lucid::controller('addresses')->ruleset()->send('addresses-edit');

$card = $form->add(html::card())->last_child();
$card->header()->add($header_msg);
$block = $card->block();
$block->add(html::form_group(_('model:addresses:name'), html::input('text', 'name', $data->name)));
$block->add(html::form_group(_('model:addresses:street_1'), html::input('text', 'street_1', $data->street_1)));
$block->add(html::form_group(_('model:addresses:street_2'), html::input('text', 'street_2', $data->street_2)));
$block->add(html::form_group(_('model:addresses:city'), html::input('text', 'city', $data->city)));

$block->add(html::input('hidden', 'address_id', $data->address_id));
$group = $card->footer()->add(html::button_group())->last_child();
$group->pull('right');
$group->add(html::button(_('button:cancel'), 'secondary', 'history.go(-1);'));
$group->add(html::submit(_('button:save')));

lucid::$response->replace('#body', $form);