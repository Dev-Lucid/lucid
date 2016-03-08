<?php
lucid::$security->require_login();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.users-table', 'view.users-edit');

$data = lucid::model('users', $user_id);
lucid::$error->not_found($data, '#body');
$header_msg = _('form:edit_'.(($data->user_id == 0)?'new':'existing'), [
    'type'=>'users',
    'name'=>$data->first_name,
]);

$form = html::form('users-edit', '#!users.save');
lucid::controller('users')->ruleset()->send('users-edit');

$card = $form->add(html::card())->last_child();
$card->header()->add($header_msg);
$block = $card->block();
$block->add(html::form_group(_('model:users:first_name'), html::input('text', 'first_name', $data->first_name)));
$block->add(html::form_group(_('model:users:last_name'), html::input('text', 'last_name', $data->last_name)));
$block->add(html::form_group(_('model:users:email'), html::input('text', 'email', $data->email)));
$block->add(html::form_group(_('model:users:password'), html::input('text', 'password', $data->password)));

$block->add(html::input('hidden', 'user_id', $data->user_id));
$group = $card->footer()->add(html::button_group())->last_child();
$group->pull('right');
$group->add(html::button(_('button:cancel'), 'secondary', 'history.go(-1);'));
$group->add(html::submit(_('button:save')));

lucid::$response->replace('#body', $form);