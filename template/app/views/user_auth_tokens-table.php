<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - User_auth_tokens');
lucid::controller('navigation')->render('view.user_auth_tokens-table');

$table = html::data_table(_('model:user_auth_tokens'), 'user_auth_tokens-table', lucid::model('user_auth_tokens'), 'app.php?action=view.user_auth_tokens-table');
$table->renderer = function($data, string $column){
    return html::anchor('#!view.user_auth_tokens-edit|token_id|'.$data->token_id, $data->$column);
};

$table->add(html::data_column(_('model:user_auth_tokens:user_id'), 'user_id', '30%', true));
$table->add(html::data_column(_('model:user_auth_tokens:token'), 'token', '30%', true));
$table->add(html::data_column(_('model:user_auth_tokens:created_on'), 'created_on', '30%', true));

$table->add(html::data_column('', null, '10%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['token']);
$table->enable_add_new_button('#!view.user_auth_tokens-edit|token_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());