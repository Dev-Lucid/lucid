<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.organizations-table');

$table = html::data_table(_('model:organizations'), 'organizations-table', lucid::model('organizations'), 'app.php?action=view.organizations-table');
$table->renderer = function($data, string $column){
    return html::anchor('#!view.organizations-edit|org_id|'.$data->org_id, $data->$column);
};

$table->add(html::data_column(_('model:organizations:role_id'), 'role_id', '18%', true));
$table->add(html::data_column(_('model:organizations:name'), 'name', '18%', true));
$table->add(html::data_column(_('model:organizations:is_enabled'), 'is_enabled', '18%', true));
$table->add(html::data_column(_('model:organizations:created_on'), 'created_on', '18%', true));
$table->add(html::data_column(_('model:organizations:is_active'), 'is_active', '18%', true));

$table->add(html::data_column('', null, '10%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['name']);
$table->enable_add_new_button('#!view.organizations-edit|org_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());