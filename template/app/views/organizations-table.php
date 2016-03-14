<?php

namespace DevLucid;

lucid::$security->require_login();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.organizations-table');

$table = html::data_table(_('table:organizations'), 'organizations-table', lucid::model('organizations'), 'app.php?action=view.organizations-table');

$table->add(html::data_column(_('model:organizations:name'), 'name', '80', true, function($data){
    return html::anchor('#!view.organizations-edit|org_id|'.$data->org_id, $data->name);
}));

$table->add(html::data_column('', null, '20%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!organizations.delete|org_id|".$data->org_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['name',]);
$table->enable_add_new_button('#!view.organizations-edit|org_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());