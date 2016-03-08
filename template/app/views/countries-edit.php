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
lucid::controller('countries')->ruleset()->send('countries-edit');

$card = $form->add(html::card())->last_child();
$card->header()->add($header_msg);
$block = $card->block();
$block->add(html::form_group(_('model:countries:name'), html::input('text', 'name', $data->name)));
$block->add(html::form_group(_('model:countries:common_name'), html::input('text', 'common_name', $data->common_name)));
$block->add(html::form_group(_('model:countries:alpha_3'), html::input('text', 'alpha_3', $data->alpha_3)));

$block->add(html::input('hidden', 'country_id', $data->country_id));
$group = $card->footer()->add(html::button_group())->last_child();
$group->pull('right');
$group->add(html::button(_('button:cancel'), 'secondary', 'history.go(-1);'));
$group->add(html::submit(_('button:save')));

lucid::$response->replace('#body', $form);