<?php
namespace DevLucid;

lucid::requireParameters('patch_id');
lucid::$security->requireLogin();
# lucid::$security->requirePermission('patches-select'); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Patches');
lucid::controller('navigation')->render('view.patches-table', 'view.patches-edit');

$data = lucid::model('patches', $patch_id);
lucid::$error->notFound($data, '#body');
$headerMsg = _('form:edit_'.(($data->patch_id == 0)?'new':'existing'), [
    'type'=>'patches',
    'name'=>$data->identifier,
]);

$form = html::form('patches-edit', '#!patches.save');
lucid::controller('patches')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::form_group(_('model:patches:identifier'), html::input('text', 'identifier', $data->identifier)),
    html::form_group(_('model:patches:applied_on_date'), html::input('date', 'applied_on_date', (new \DateTime($data->applied_on_date))->format('Y-m-d H:i'))),
    html::input('hidden', 'patch_id', $data->patch_id),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);