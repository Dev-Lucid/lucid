<?php
namespace DevLucid;

lucid::requireParameters('org_id');
lucid::$security->requireLogin();
# lucid::$security->requirePermission('vw_organizations_details-select'); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Vw_organizations_details');
lucid::controller('navigation')->render('view.vw_organizations_details-table', 'view.vw_organizations_details-edit');

$data = lucid::model('vw_organizations_details', $org_id);
lucid::$error->notFound($data, '#body');
$headerMsg = _('form:edit_'.(($data->org_id == 0)?'new':'existing'), [
    'type'=>'vw_organizations_details',
    'name'=>$data->name,
]);

$form = html::form('vw_organizations_details-edit', '#!vw_organizations_details.save');
lucid::controller('vw_organizations_details')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::form_group(_('model:vw_organizations_details:name'), html::input('text', 'name', $data->name)),
    html::form_group(_('model:vw_organizations_details:role_id'), html::input('text', 'role_id', $data->role_id)),
    html::form_group(_('model:vw_organizations_details:role_name'), html::input('text', 'role_name', $data->role_name)),
    html::form_group(_('model:vw_organizations_details:nbr_of_users'), html::input('text', 'nbr_of_users', $data->nbr_of_users)),
    html::input('hidden', 'org_id', $data->org_id),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);