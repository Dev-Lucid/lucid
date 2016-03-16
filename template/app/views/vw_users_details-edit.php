<?php
namespace DevLucid;

lucid::requireParameters('user_id');
lucid::$security->requireLogin();
# lucid::$security->requirePermission('vw_users_details-select'); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Vw_users_details');
lucid::controller('navigation')->render('view.vw_users_details-table', 'view.vw_users_details-edit');

$data = lucid::model('vw_users_details', $user_id);
lucid::$error->notFound($data, '#body');
$headerMsg = _('form:edit_'.(($data->user_id == 0)?'new':'existing'), [
    'type'=>'vw_users_details',
    'name'=>$data->email,
]);

$form = html::form('vw_users_details-edit', '#!vw_users_details.save');
lucid::controller('vw_users_details')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::form_group(_('model:vw_users_details:email'), html::input('text', 'email', $data->email)),
    html::form_group(_('model:vw_users_details:password'), html::input('text', 'password', $data->password)),
    html::form_group(_('model:vw_users_details:first_name'), html::input('text', 'first_name', $data->first_name)),
    html::form_group(_('model:vw_users_details:last_name'), html::input('text', 'last_name', $data->last_name)),
    html::form_group(_('model:vw_users_details:org_id'), html::input('text', 'org_id', $data->org_id)),
    html::form_group(_('model:vw_users_details:organization_name'), html::input('text', 'organization_name', $data->organization_name)),
    html::form_group(_('model:vw_users_details:role_id'), html::input('text', 'role_id', $data->role_id)),
    html::form_group(_('model:vw_users_details:role_name'), html::input('text', 'role_name', $data->role_name)),
    html::input('hidden', 'user_id', $data->user_id),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);