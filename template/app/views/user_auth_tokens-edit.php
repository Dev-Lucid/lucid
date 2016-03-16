<?php
namespace DevLucid;

lucid::requireParameters('token_id');
lucid::$security->requireLogin();
# lucid::$security->requirePermission('user_auth_tokens-select'); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - User_auth_tokens');
lucid::controller('navigation')->render('view.user_auth_tokens-table', 'view.user_auth_tokens-edit');

$data = lucid::model('user_auth_tokens', $token_id);
lucid::$error->notFound($data, '#body');
$headerMsg = _('form:edit_'.(($data->token_id == 0)?'new':'existing'), [
    'type'=>'user_auth_tokens',
    'name'=>$data->token,
]);

$form = html::form('user_auth_tokens-edit', '#!user_auth_tokens.save');
lucid::controller('user_auth_tokens')->ruleset()->send($form->name);

$user_id_options = lucid::model('users')
    ->select('user_id', 'value')
    ->select('email', 'label')
    ->order_by_asc('email')
    ->find_array();

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
    html::form_group(_('model:user_auth_tokens:user_id'), html::select('user_id', $data->user_id, $user_id_options)),
    html::form_group(_('model:user_auth_tokens:token'), html::input('text', 'token', $data->token)),
    html::form_group(_('model:user_auth_tokens:created_on'), html::input('text', 'created_on', $data->created_on)),
    html::input('hidden', 'token_id', $data->token_id),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);