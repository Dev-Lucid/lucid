<?php
lucid::$security->require_login();
# lucid::$security->require_permission([]); # add required permissions to this array

lucid::controller('navigation')->render('view.addresses-table');

$table = html::data_table(_('table:addresses'), 'addresses-table', lucid::model('addresses'), 'app.php?action=view.addresses-table');

$table->add(html::data_column(_('model:addresses:name'), 'name', '20', true, function($data){
    return html::anchor('#!view.addresses-edit|address_id|'.$data->address_id, $data->name);
}));
$table->add(html::data_column(_('model:addresses:street_1'), 'street_1', '20', true, function($data){
    return html::anchor('#!view.addresses-edit|address_id|'.$data->address_id, $data->street_1);
}));
$table->add(html::data_column(_('model:addresses:street_2'), 'street_2', '20', true, function($data){
    return html::anchor('#!view.addresses-edit|address_id|'.$data->address_id, $data->street_2);
}));
$table->add(html::data_column(_('model:addresses:city'), 'city', '20', true, function($data){
    return html::anchor('#!view.addresses-edit|address_id|'.$data->address_id, $data->city);
}));

$table->add(html::data_column('', null, '20%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!addresses.delete|address_id|".$data->address_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter(['name','street_1','street_2','city',]);
$table->enable_add_new_button('#!view.addresses-edit|address_id|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());