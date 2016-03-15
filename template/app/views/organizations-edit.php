<?php

namespace DevLucid;

lucid::requireParameters('org_id');
lucid::$security->requireLogin();
# lucid::$security->requirePermission('organizations-select'); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Organizations');
lucid::controller('navigation')->render('view.organizations-table', 'view.organizations-edit');

$data = lucid::model('organizations', $org_id);
lucid::$error->notFound($data, '#body');
$headerMsg = _('form:edit_'.(($data->org_id == 0)?'new':'existing'), [
    'type'=>'organizations',
    'name'=>$data->name,
]);

$form = html::form('organizations-edit', '#!organizations.save');
lucid::controller('organizations')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::form_group(_('model:organizations:role_id'), html::select('role_id', $data->role_id, [])),
    html::form_group(_('model:organizations:name'), html::input('text', 'name', $data->name)),
    html::form_group(_('model:organizations:is_enabled'), html::input('checkbox', 'is_enabled', ($data->is_enabled == 1 || $data->is_enabled === true))),
    html::form_group(_('model:organizations:created_on'), html::input('text', 'created_on', $data->created_on)),
    html::input('hidden', 'org_id', $data->org_id),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);