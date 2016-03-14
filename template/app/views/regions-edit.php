<?php

namespace DevLucid;

lucid::$security->require_login();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.roles-table', 'view.regions-table', 'view.regions-edit');

$data = lucid::model('regions', $region_id);
lucid::$error->not_found($data, '#body');
$header_msg = _('form:edit_'.(($data->region_id == 0)?'new':'existing'), [
    'type'=>'regions',
    'name'=>$data->country_id,
]);

$form = html::form('regions-edit', '#!regions.save');
lucid::controller('regions')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($header_msg);
$card->block()->add([
	html::form_group(_('model:regions:country_id'), html::input('text', 'country_id', $data->country_id)),
	html::form_group(_('model:regions:name'), html::input('text', 'name', $data->name)),
	html::form_group(_('model:regions:abbreviation'), html::input('text', 'abbreviation', $data->abbreviation)),
    html::input('hidden', 'region_id', $data->region_id),
]);
$card->footer(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);