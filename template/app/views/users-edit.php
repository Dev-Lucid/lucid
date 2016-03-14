<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission('select'); # add required permissions to this array

lucid::controller('navigation')->render('view.users-table', 'view.users-edit');

$data = lucid::model('users', $user_id);
lucid::$error->notFound($data, '#body');
$headerMsg = _('form:edit_'.(($data->user_id == 0)?'new':'existing'), [
    'type'=>'users',
    'name'=>$data->email,
]);

$form = html::form('users-edit', '#!users.save');
lucid::controller('users')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::form_group(_('model:users:org_id'), html::select('org_id', $data->org_id, [])),
    html::form_group(_('model:users:email'), html::input('text', 'email', $data->email)),
    html::form_group(_('model:users:password'), html::input('text', 'password', $data->password)),
    html::form_group(_('model:users:first_name'), html::input('text', 'first_name', $data->first_name)),
    html::form_group(_('model:users:last_name'), html::input('text', 'last_name', $data->last_name)),
    html::form_group(_('model:users:is_enabled'), html::input('checkbox', 'is_enabled', ($data->is_enabled == 1 || $data->is_enabled === true))),
    html::form_group(_('model:users:last_login'), html::input('text', 'last_login', $data->last_login)),
    html::form_group(_('model:users:created_on'), html::input('text', 'created_on', $data->created_on)),
    html::form_group(_('model:users:force_password_change'), html::input('checkbox', 'force_password_change', ($data->force_password_change == 1 || $data->force_password_change === true))),
    html::form_group(_('model:users:register_key'), html::input('text', 'register_key', $data->register_key)),
    html::input('hidden', 'user_id', $data->user_id),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);