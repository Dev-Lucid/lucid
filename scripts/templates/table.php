<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::$response->title(_('branding:app_name').' - {{title}}');
lucid::controller('navigation')->render('view.{{table}}-table');

$table = html::data_table(_('model:{{table}}'), '{{table}}-table', lucid::model('{{table}}'), 'app.php?action=view.{{table}}-table');
$table->renderer = function($data, string $column){
    return html::anchor('#!view.{{table}}-edit|{{id}}|'.$data->{{id}}, $data->$column);
};

{{table_cols}}
$table->add(html::data_column('', null, '10%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

$table->enable_search_filter([{{search_cols}}]);
$table->enable_add_new_button('#!view.{{table}}-edit|{{id}}|0', _('button:add_new'));

$table->send_refresh();

lucid::$response->replace('#body', $table->render());