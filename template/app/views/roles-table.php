<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Roles');
lucid::controller('navigation')->render('view.roles-table');

$table = html::data_table(_('model:roles'), 'roles-table', lucid::model('roles'), 'app.php?action=view.roles-table');
$table->renderer = function($data, string $column){
    return html::anchor('#!view.roles-edit|role_id|'.$data->role_id, $data->$column);
};

$table->add(html::data_column(_('model:roles:name'), 'name', '90%', true));

$table->add(html::data_column('', null, '10%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['name']);
$table->enable_add_new_button('#!view.roles-edit|role_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());