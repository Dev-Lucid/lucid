<?php
lucid::$security->require_login();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.roles-table', 'view.regions-table', 'view.regions-edit');

$data = lucid::model('regions', $region_id);
lucid::$error->not_found($data, '#body');
$header_msg = _('form:edit_'.(($data->region_id == 0)?'new':'existing'), [
    'type'=>'regions',
    'name'=>$data->name,
]);

$form = html::form('regions-edit', '#!regions.save');
lucid::controller('regions')->ruleset()->send('regions-edit');

$card = $form->add(html::card())->last_child();
$card->header()->add($header_msg);
$block = $card->block();
$block->add(html::form_group(_('model:regions:name'), html::input('text', 'name', $data->name)));
$block->add(html::form_group(_('model:regions:abbreviation'), html::input('text', 'abbreviation', $data->abbreviation)));

$block->add(html::input('hidden', 'region_id', $data->region_id));
$group = $card->footer()->add(html::button_group())->last_child();
$group->pull('right');
$group->add(html::button(_('button:cancel'), 'secondary', 'history.go(-1);'));
$group->add(html::submit(_('button:save')));

lucid::$response->replace('#body', $form);