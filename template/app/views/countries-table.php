<?php

namespace DevLucid;

lucid::$security->require_login();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.roles-table', 'view.countries-table');

$table = html::data_table(_('table:countries'), 'countries-table', lucid::model('countries'), 'app.php?action=view.countries-table');

$table->add(html::data_column(_('model:countries:name'), 'name', '27', true, function($data){
    return html::anchor('#!view.countries-edit|country_id|'.$data->country_id, $data->name);
}));
$table->add(html::data_column(_('model:countries:common_name'), 'common_name', '27', true, function($data){
    return html::anchor('#!view.countries-edit|country_id|'.$data->country_id, $data->common_name);
}));
$table->add(html::data_column(_('model:countries:alpha_3'), 'alpha_3', '27', true, function($data){
    return html::anchor('#!view.countries-edit|country_id|'.$data->country_id, $data->alpha3);
}));

$table->add(html::data_column('', null, '20%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!countries.delete|country_id|".$data->country_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['name','common_name','alpha_3',]);
$table->enable_add_new_button('#!view.countries-edit|country_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());