<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission('select'); # add required permissions to this array

lucid::controller('navigation')->render('view.regions-table', 'view.regions-edit');

$data = lucid::model('regions', $region_id);
lucid::$error->notFound($data, '#body');
$headerMsg = _('form:edit_'.(($data->region_id == 0)?'new':'existing'), [
    'type'=>'regions',
    'name'=>$data->country_id,
]);

$form = html::form('regions-edit', '#!regions.save');
lucid::controller('regions')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::form_group(_('model:regions:country_id'), html::input('text', 'country_id', $data->country_id)),
    html::form_group(_('model:regions:abbreviation'), html::input('text', 'abbreviation', $data->abbreviation)),
    html::form_group(_('model:regions:name'), html::input('text', 'name', $data->name)),
    html::form_group(_('model:regions:type'), html::input('text', 'type', $data->type)),
    html::form_group(_('model:regions:parent'), html::input('text', 'parent', $data->parent)),
    html::form_group(_('model:regions:is_parent'), html::input('checkbox', 'is_parent', ($data->is_parent == 1 || $data->is_parent === true))),
    html::input('hidden', 'region_id', $data->region_id),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);