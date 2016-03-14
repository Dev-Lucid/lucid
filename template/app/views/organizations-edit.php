<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission('select'); # add required permissions to this array

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
	html::form_group(_('model:organizations:name'), html::input('text', 'name', $data->name)),
    html::input('hidden', 'org_id', $data->org_id),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);