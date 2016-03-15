<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - Addresses');
lucid::controller('navigation')->render('view.addresses-table');

$table = html::data_table(_('model:addresses'), 'addresses-table', lucid::model('addresses'), 'app.php?action=view.addresses-table');
$table->renderer = function($data, string $column){
    return html::anchor('#!view.addresses-edit|address_id|'.$data->address_id, $data->$column);
};

$table->add(html::data_column(_('model:addresses:org_id'), 'org_id', '9%', true));
$table->add(html::data_column(_('model:addresses:name'), 'name', '9%', true));
$table->add(html::data_column(_('model:addresses:street_1'), 'street_1', '9%', true));
$table->add(html::data_column(_('model:addresses:street_2'), 'street_2', '9%', true));
$table->add(html::data_column(_('model:addresses:city'), 'city', '9%', true));
$table->add(html::data_column(_('model:addresses:region_id'), 'region_id', '9%', true));
$table->add(html::data_column(_('model:addresses:postal_code'), 'postal_code', '9%', true));
$table->add(html::data_column(_('model:addresses:country_id'), 'country_id', '9%', true));
$table->add(html::data_column(_('model:addresses:phone_number_1'), 'phone_number_1', '9%', true));
$table->add(html::data_column(_('model:addresses:phone_number_2'), 'phone_number_2', '9%', true));

$table->add(html::data_column('', null, '10%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['name','street_1','street_2','city','region_id','postal_code','country_id','phone_number_1','phone_number_2']);
$table->enable_add_new_button('#!view.addresses-edit|address_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());