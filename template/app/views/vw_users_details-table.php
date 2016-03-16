<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Vw_users_details');
lucid::controller('navigation')->render('view.vw_users_details-table');

$table = html::data_table(_('model:vw_users_details'), 'vw_users_details-table', lucid::model('vw_users_details'), 'app.php?action=view.vw_users_details-table');
$table->renderer = function($data, string $column){
    return html::anchor('#!view.vw_users_details-edit|user_id|'.$data->user_id, $data->$column);
};

$table->add(html::data_column(_('model:vw_users_details:email'), 'email', '12%', true));
$table->add(html::data_column(_('model:vw_users_details:password'), 'password', '12%', true));
$table->add(html::data_column(_('model:vw_users_details:first_name'), 'first_name', '12%', true));
$table->add(html::data_column(_('model:vw_users_details:last_name'), 'last_name', '12%', true));
$table->add(html::data_column(_('model:vw_users_details:org_id'), 'org_id', '12%', true));
$table->add(html::data_column(_('model:vw_users_details:organization_name'), 'organization_name', '12%', true));
$table->add(html::data_column(_('model:vw_users_details:role_id'), 'role_id', '12%', true));
$table->add(html::data_column(_('model:vw_users_details:role_name'), 'role_name', '12%', true));

$table->add(html::data_column('', null, '10%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['email','password','first_name','last_name','org_id','organization_name','role_id','role_name']);
$table->enable_add_new_button('#!view.vw_users_details-edit|user_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());