<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission('select'); # add required permissions to this array

lucid::controller('navigation')->render('view.roles-table', 'view.roles-edit');

$data = lucid::model('roles', $role_id);
lucid::$error->notFound($data, '#body');
$headerMsg = _('form:edit_'.(($data->role_id == 0)?'new':'existing'), [
    'type'=>'roles',
    'name'=>$data->name,
]);

$form = html::form('roles-edit', '#!roles.save');
lucid::controller('roles')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::form_group(_('model:roles:name'), html::input('text', 'name', $data->name)),
    html::input('hidden', 'role_id', $data->role_id),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);