<?php

namespace DevLucid;

lucid::$security->require_login();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.roles-table', 'view.roles-table', 'view.roles-edit');

$data = lucid::model('roles', $role_id);
lucid::$error->not_found($data, '#body');
$header_msg = _('form:edit_'.(($data->role_id == 0)?'new':'existing'), [
    'type'=>'roles',
    'name'=>$data->name,
]);

$form = html::form('roles-edit', '#!roles.save');
lucid::controller('roles')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($header_msg);
$card->block()->add([
	html::form_group(_('model:roles:name'), html::input('text', 'name', $data->name)),
    html::input('hidden', 'role_id', $data->role_id),
]);
$card->footer(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);