<?php
lucid::$security->require_login();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.roles-table', 'view.roles-table');

$table = html::data_table(_('table:roles'), 'roles-table', lucid::model('roles'), 'app.php?action=view.roles-table');

$table->add(html::data_column(_('model:roles:name'), 'name', '80', true, function($data){
    return html::anchor('#!view.roles-edit|role_id|'.$data->role_id, $data->name);
}));

$table->add(html::data_column('', null, '20%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['name',]);
$table->enable_add_new_button('#!view.roles-edit|role_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());