<?php

namespace DevLucid;

lucid::$security->require_login();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.organizations-table', 'view.organizations-edit');

$data = lucid::model('organizations', $org_id);
lucid::$error->not_found($data, '#body');
$header_msg = _('form:edit_'.(($data->org_id == 0)?'new':'existing'), [
    'type'=>'organizations',
    'name'=>$data->name,
]);

$form = html::form('organizations-edit', '#!organizations.save');
lucid::controller('organizations')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($header_msg);
$card->block()->add([
	html::form_group(_('model:organizations:name'), html::input('text', 'name', $data->name)),
    html::input('hidden', 'org_id', $data->org_id),
]);
$card->footer(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);