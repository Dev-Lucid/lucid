<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Vw_organizations_details');
lucid::controller('navigation')->render('view.vw_organizations_details-table');

$table = html::data_table(_('model:vw_organizations_details'), 'vw_organizations_details-table', lucid::model('vw_organizations_details'), 'app.php?action=view.vw_organizations_details-table');
$table->renderer = function($data, string $column){
    return html::anchor('#!view.vw_organizations_details-edit|org_id|'.$data->org_id, $data->$column);
};

$table->add(html::data_column(_('model:vw_organizations_details:name'), 'name', '23%', true));
$table->add(html::data_column(_('model:vw_organizations_details:role_id'), 'role_id', '23%', true));
$table->add(html::data_column(_('model:vw_organizations_details:role_name'), 'role_name', '23%', true));
$table->add(html::data_column(_('model:vw_organizations_details:nbr_of_users'), 'nbr_of_users', '23%', true));

$table->add(html::data_column('', null, '10%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['name','role_id','role_name','nbr_of_users']);
$table->enable_add_new_button('#!view.vw_organizations_details-edit|org_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());