<?php
lucid::$security->require_login();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.roles-table', 'view.countries-table', 'view.countries-edit');

$data = lucid::model('countries', $country_id);
lucid::$error->not_found($data, '#body');
$header_msg = _('form:edit_'.(($data->country_id == 0)?'new':'existing'), [
    'type'=>'countries',
    'name'=>$data->name,
]);

$form = html::form('countries-edit', '#!countries.save');
lucid::controller('countries')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($header_msg);
$card->block()->add([
	html::form_group(_('model:countries:name'), html::input('text', 'name', $data->name)),
	html::form_group(_('model:countries:common_name'), html::input('text', 'common_name', $data->common_name)),
	html::form_group(_('model:countries:alpha3'), html::input('text', 'alpha3', $data->alpha3)),
    html::input('hidden', 'country_id', $data->country_id),
]);
$card->footer(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);