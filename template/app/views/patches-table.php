<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Patches');
lucid::controller('navigation')->render('view.patches-table');

$table = html::data_table(_('model:patches'), 'patches-table', lucid::model('patches'), 'app.php?action=view.patches-table');
$table->renderer = function($data, string $column){
    return html::anchor('#!view.patches-edit|patch_id|'.$data->patch_id, $data->$column);
};

$table->add(html::data_column(_('model:patches:identifier'), 'identifier', '45%', true));
$table->add(html::data_column(_('model:patches:applied_on_date'), 'applied_on_date', '45%', true));

$table->add(html::data_column('', null, '10%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['identifier']);
$table->enable_add_new_button('#!view.patches-edit|patch_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());