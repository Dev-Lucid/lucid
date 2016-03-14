<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission('select'); # add required permissions to this array

lucid::controller('navigation')->render('view.countries-table', 'view.countries-edit');

$data = lucid::model('countries', $country_id);
lucid::$error->notFound($data, '#body');
$headerMsg = _('form:edit_'.(($data->country_id == 0)?'new':'existing'), [
    'type'=>'countries',
    'name'=>$data->name,
]);

$form = html::form('countries-edit', '#!countries.save');
lucid::controller('countries')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
	html::form_group(_('model:countries:name'), html::input('text', 'name', $data->name)),
	html::form_group(_('model:countries:common_name'), html::input('text', 'common_name', $data->common_name)),
	html::form_group(_('model:countries:alpha_3'), html::input('text', 'alpha_3', $data->alpha_3)),
    html::input('hidden', 'country_id', $data->country_id),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);