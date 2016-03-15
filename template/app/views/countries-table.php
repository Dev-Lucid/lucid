<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Countries');
lucid::controller('navigation')->render('view.countries-table');

$table = html::data_table(_('model:countries'), 'countries-table', lucid::model('countries'), 'app.php?action=view.countries-table');
$table->renderer = function($data, string $column){
    return html::anchor('#!view.countries-edit|country_id|'.$data->country_id, $data->$column);
};

$table->add(html::data_column(_('model:countries:alpha_3'), 'alpha_3', '23%', true));
$table->add(html::data_column(_('model:countries:name'), 'name', '23%', true));
$table->add(html::data_column(_('model:countries:common_name'), 'common_name', '23%', true));
$table->add(html::data_column(_('model:countries:official_name'), 'official_name', '23%', true));

$table->add(html::data_column('', null, '10%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['alpha_3','name','common_name','official_name']);
$table->enable_add_new_button('#!view.countries-edit|country_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());