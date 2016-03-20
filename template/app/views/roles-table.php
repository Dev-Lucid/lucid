<?php
namespace DevLucid;

# By default, require that the user be logged in to access the table. If you want additional
# permissions, use the lucid::$security->requirePermission() function.
lucid::$security->requireLogin();
# lucid::$security->requirePermission(); # add required permissions to this array

# Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
# by calling lucid::$response->description() or lucid::$response->keywords()
lucid::$response->title(_('branding:app_name').' - Roles');

# Render the navigation controller.
lucid::$mvc->controller('navigation')->render('view.dashboard', 'view.roles-table');

# build the data table. The parameters are as follows:
# 0) The title of the table. This text is placed inside the card header, and defaults to the name of the modelName
# 1) A name for the table. This is used to identify refresh requests for table data. This needs to be unique for each table
# 2) A model for the table. You may add any where clauses you want before passing the model as a parameter.
# 3) A url that will result in this table's code being loaded. It doesn't necessarily need to point to this view, as long
#    as you're sure that this code will be run as a result of loading that url.  This url is used to refresh the data in
#    the table when it is sorted/paged/filtered.
# 4) The default sort column for this table. Starts at 0. If you want the table sorted by default by the 3rd column, the
#    value should be 2.
# 5) The default sort direction for this table. May be either 'asc' or 'desc'
# 6) The page size for the table, defaults to 10
# 7) The current page for the table, defaults to 0 (first page)
$table = html::dataTable(_('model:roles'), 'roles-table', lucid::$mvc->model('roles'), 'app.php?action=view.roles-table');

# Add a default renderer for the table. This function is called when rendering every column (unless it is overridden
# at the column level), and is passed the data for the entire row. This returns the html that should be placed into
# the cell for that row/column
$table->renderer = function($data, string $column){
    return html::anchor('#!view.roles-edit|role_id|'.$data->role_id, $data->$column);
};

# Add the table's columns. The parameters for the constructor are:
# 0) The label for the column
# 1) The database field name that should be sorted on when the user sorts the data by this column
# 3) The width of this column, expressed as a % (ex: 25%)
# 4) boolean true/false: whether or not this column can be used to sort the table
# 5) An optional renderer function. This function works like the table rendering function
$table->add(html::dataColumn(_('model:roles:name'), 'name', '90%', true));


# Add a column specifically for deleting rows.
$table->add(html::dataColumn('', null, '10%', false, function($data){
    return html::button(_('button:delete'), 'danger', "if(confirm('"._('button:confirm_delete')."')){ lucid.request('#!roles.delete|role_id|".$data->role_id."');}")->size('sm')->pull('right');
}));

# Enable searching this table based on some of the fields
$table->enableSearchFilter(['name']);

# Enable adding rows to the table. This simply links to the edit form, and passes the value 0 into the
# varialble $role_id on the form.
$table->enableAddNewButton('#!view.roles-edit|role_id|0', _('button:add_new'));

# This function call is very important. It looks in $_REQUEST to see if this request is from this same table, asking
# for new data due to sorting, paging, or filtering. If it determines that this is case, only the table's body is rendered,
# and that html is sent back to the client where it is inserted in place of the existing table data. Sending back that
# response ends execution of the view.
$table->sendRefresh();

# Render out the table, and place it into the webpage.
lucid::$response->replace('#right-col', $table->render());