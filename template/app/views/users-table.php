<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Users');
lucid::controller('navigation')->render('view.users-table');

$table = html::data_table(_('model:users'), 'users-table', lucid::model('users'), 'app.php?action=view.users-table');
$table->renderer = function($data, string $column){
    return html::anchor('#!view.users-edit|user_id|'.$data->user_id, $data->$column);
};

$table->add(html::data_column(_('model:users:org_id'), 'org_id', '9%', true));
$table->add(html::data_column(_('model:users:email'), 'email', '9%', true));
$table->add(html::data_column(_('model:users:password'), 'password', '9%', true));
$table->add(html::data_column(_('model:users:first_name'), 'first_name', '9%', true));
$table->add(html::data_column(_('model:users:last_name'), 'last_name', '9%', true));
$table->add(html::data_column(_('model:users:is_enabled'), 'is_enabled', '9%', true));
$table->add(html::data_column(_('model:users:last_login'), 'last_login', '9%', true));
$table->add(html::data_column(_('model:users:created_on'), 'created_on', '9%', true));
$table->add(html::data_column(_('model:users:force_password_change'), 'force_password_change', '9%', true));
$table->add(html::data_column(_('model:users:register_key'), 'register_key', '9%', true));

$table->add(html::data_column('', null, '10%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['email','password','first_name','last_name','register_key']);
$table->enable_add_new_button('#!view.users-edit|user_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());