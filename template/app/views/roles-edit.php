<?php
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
lucid::controller('roles')->ruleset()->send('roles-edit');

$card = $form->add(html::card())->last_child();
$card->header($header_msg);
$card->block()->add(html::form_group(_('model:roles:name'), html::input('text', 'name', $data->name)));
$card->block()->add(html::input('hidden', 'role_id', $data->role_id));
$group = $card->footer()->add(html::button_group())->last_child();
$group->pull('right');
$group->add(html::button(_('button:cancel'), 'secondary', 'history.go(-1);'));
$group->add(html::submit(_('button:save')));

lucid::$response->replace('#body', $form);