<?php

namespace DevLucid;

lucid::$security->require_login();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.roles-table', 'view.regions-table');

$table = html::data_table(_('table:regions'), 'regions-table', lucid::model('regions'), 'app.php?action=view.regions-table');

$table->add(html::data_column(_('model:regions:country_id'), 'country_id', '27', true, function($data){
    return html::anchor('#!view.regions-edit|region_id|'.$data->region_id, $data->country_id);
}));
$table->add(html::data_column(_('model:regions:name'), 'name', '27', true, function($data){
    return html::anchor('#!view.regions-edit|region_id|'.$data->region_id, $data->name);
}));
$table->add(html::data_column(_('model:regions:abbreviation'), 'abbreviation', '27', true, function($data){
    return html::anchor('#!view.regions-edit|region_id|'.$data->region_id, $data->abbreviation);
}));

$table->add(html::data_column('', null, '20%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!regions.delete|region_id|".$data->region_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['country_id','name','abbreviation',]);
$table->enable_add_new_button('#!view.regions-edit|region_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());