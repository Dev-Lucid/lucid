<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Regions');
lucid::controller('navigation')->render('view.regions-table');

$table = html::data_table(_('model:regions'), 'regions-table', lucid::model('regions'), 'app.php?action=view.regions-table');
$table->renderer = function($data, string $column){
    return html::anchor('#!view.regions-edit|region_id|'.$data->region_id, $data->$column);
};

$table->add(html::data_column(_('model:regions:country_id'), 'country_id', '15%', true));
$table->add(html::data_column(_('model:regions:abbreviation'), 'abbreviation', '15%', true));
$table->add(html::data_column(_('model:regions:name'), 'name', '15%', true));
$table->add(html::data_column(_('model:regions:type'), 'type', '15%', true));
$table->add(html::data_column(_('model:regions:parent'), 'parent', '15%', true));
$table->add(html::data_column(_('model:regions:is_parent'), 'is_parent', '15%', true));

$table->add(html::data_column('', null, '10%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['country_id','abbreviation','name','type','parent']);
$table->enable_add_new_button('#!view.regions-edit|region_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());