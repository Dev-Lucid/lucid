<?php
namespace DevLucid;

lucid::requireParameters('user_id');
lucid::$security->requireLogin();
# lucid::$security->requirePermission('users-select'); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Users');
lucid::controller('navigation')->render('view.users-table', 'view.users-edit');

$data = lucid::model('users', $user_id);
lucid::$error->notFound($data, '#body');
$headerMsg = _('form:edit_'.(($data->user_id == 0)?'new':'existing'), [
    'type'=>'users',
    'name'=>$data->email,
]);

$form = html::form('users-edit', '#!users.save');
lucid::controller('users')->ruleset()->send($form->name);

$org_id_options = lucid::model('organizations')
    ->select('org_id', 'value')
    ->select('name', 'label')
    ->order_by_asc('name')
    ->find_array();

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::form_group(_('model:users:org_id'), html::select('org_id', $data->org_id, $org_id_options)),
    html::form_group(_('model:users:email'), html::input('text', 'email', $data->email)),
    html::form_group(_('model:users:password'), html::input('text', 'password', $data->password)),
    html::form_group(_('model:users:first_name'), html::input('text', 'first_name', $data->first_name)),
    html::form_group(_('model:users:last_name'), html::input('text', 'last_name', $data->last_name)),
    html::form_group(_('model:users:is_enabled'), html::input('checkbox', 'is_enabled', $data->is_enabled)),
    html::form_group(_('model:users:last_login'), html::input('date', 'last_login', (new \DateTime($data->last_login))->format('Y-m-d H:i'))),
    html::form_group(_('model:users:created_on'), html::input('date', 'created_on', (new \DateTime($data->created_on))->format('Y-m-d H:i'))),
    html::form_group(_('model:users:force_password_change'), html::input('checkbox', 'force_password_change', $data->force_password_change)),
    html::form_group(_('model:users:register_key'), html::input('text', 'register_key', $data->register_key)),
    html::input('hidden', 'user_id', $data->user_id),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);