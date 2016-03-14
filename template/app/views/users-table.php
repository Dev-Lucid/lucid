<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.users-table');

$table = html::data_table(_('navigation:users'), 'users-table', lucid::model('users'), 'app.php?action=view.users-table');

$table->add(html::data_column(_('model:users:first_name'), 'first_name', '20%', true, function($data){
    return html::anchor('#!view.users-edit|user_id|'.$data->user_id, $data->first_name);
}));
$table->add(html::data_column(_('model:users:last_name'), 'last_name', '20%', true, function($data){
    return html::anchor('#!view.users-edit|user_id|'.$data->user_id, $data->last_name);
}));
$table->add(html::data_column(_('model:users:email'), 'email', '20%', true, function($data){
    return html::anchor('#!view.users-edit|user_id|'.$data->user_id, $data->email);
}));
$table->add(html::data_column(_('model:users:password'), 'password', '20%', true, function($data){
    return html::anchor('#!view.users-edit|user_id|'.$data->user_id, $data->password);
}));

$table->add(html::data_column('', null, '20%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!users.delete|user_id|".$data->user_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['first_name','last_name','email','password',]);
$table->enable_add_new_button('#!view.users-edit|user_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());