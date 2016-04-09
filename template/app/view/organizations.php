<?php
namespace App\View;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Organizations extends \App\View
{
    public function table()
    {
        # By default, require that the user be logged in to access the table. If you want additional
        # permissions, use the lucid::$security->requirePermission() function.
        #lucid::permission()->requireLogin();
        # lucid::$security->requirePermission(); # add required permissions to this array

        # Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
        # by calling lucid::$response->description() or lucid::$response->keywords()
        lucid::response()->title(lucid::i18n()->translate('branding:app_name').' - {{title}}');

        # Render the navigation controller.
        lucid::factory()->view('navigation')->render('organizations.view.table');

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
        $table = html::dataTable(lucid::i18n()->translate('model:organizations'), 'organizations-table', $this->controller()->getList(), 'actions.php?action=organizations.view.table');

        # Add a default renderer for the table. This function is called when rendering every column (unless it is overridden
        # at the column level), and is passed the data for the entire row. This returns the html that should be placed into
        # the cell for that row/column
        $table->renderer = function($data, string $column){
            return html::anchor('#!organizations.view.edit|org_id|'.$data->org_id, $data->$column);
        };

        # Add the table's columns. The parameters for the constructor are:
        # 0) The label for the column
        # 1) The database field name that should be sorted on when the user sorts the data by this column
        # 3) The width of this column, expressed as a % (ex: 25%)
        # 4) boolean true/false: whether or not this column can be used to sort the table
        # 5) An optional renderer function. This function works like the table rendering function
        $table->add(html::dataColumn(lucid::i18n()->translate('model:organizations:role_id'), 'role_id', '23%', true));
        $table->add(html::dataColumn(lucid::i18n()->translate('model:organizations:name'), 'name', '23%', true));
        $table->add(html::dataColumn(lucid::i18n()->translate('model:organizations:is_enabled'), 'is_enabled', '23%', true));
        $table->add(html::dataColumn(lucid::i18n()->translate('model:organizations:created_on'), 'created_on', '23%', true));


        # Add a column specifically for deleting rows.
        $table->add(html::dataColumn('', null, '10%', false, function($data){
            return html::button(lucid::i18n()->translate('button:delete'), 'danger', "if(confirm('".lucid::i18n()->translate('button:confirm_delete')."')){ lucid.request('#!organizations.controller.delete|org_id|".$data->org_id."');}")->size('sm')->pull('right');
        }));

        # Enable searching this table based on some of the fields
        $table->enableSearchFilter(['name',]);

        # Enable adding rows to the table. This simply links to the edit form, and passes the value 0 into the
        # varialble $org_id on the form.
        $table->enableAddNewButton('#!organizations.view.edit|org_id|0', lucid::i18n()->translate('button:add_new'));

        # This function call is very important. It looks in $_REQUEST to see if this request is from this same table, asking
        # for new data due to sorting, paging, or filtering. If it determines that this is case, only the table's body is rendered,
        # and that html is sent back to the client where it is inserted in place of the existing table data. Sending back that
        # response ends execution of the view.
        $table->sendRefresh();

        # Render out the table, and place it into the webpage.
        lucid::response()->replace('#main-fullwidth', $table->render());
    }

    public function edit(int $org_id)
    {
        # By default, require that the user be logged in to access the edit form. If you want additional
        # permissions, use the lucid::$security->requirePermission() function.
        #lucid::permission()->requireLogin();
        # lucid::$security->requirePermission('organizations-select');

        # Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
        # by calling lucid::$response->description() or lucid::$response->keywords()
        lucid::response()->title(lucid::i18n()->translate('branding:app_name').' - Organizations');

        # Render the navigation controller.
        lucid::factory()->view('navigation')->render('organizations.view.table', 'organizations.view.edit');

        # Load the model. If $org_id == 0, then the model's ->create method will be called.
        $data = $this->controller()->getOne($org_id);

        # the ->notFound method will throw an error if the first parameter === false, which will be the case
        # if the model function is passed an ID that is not zero, but is not able to retrieve a row for that ID
        #lucid::$error->notFound($data, '#body');

        # Based on whether or not the primary key for the model == 0, the header message will either be the dictionary
        # key form:edit_new or form::edit_existing.
        $headerMsg = lucid::i18n()->translate('form:edit_'.(($data->org_id == 0)?'new':'existing'), [
            'type'=>'organizations',
            'name'=>$data->name,
        ]);

        # Construct the form and retrieve the ruleset for the controller. You can have multiple functions in your
        # controller if you want to have that controller accept submissions from different forms with different numbers
        # of fields, but the auto-generated ruleset-returning function is simply called ->ruleset(). The ->send()
        # method of the ruleset object packages up the rules into json, and sends them to the client so that they can be
        # used clientside when the form submits.
        $form = html::form('organizations-edit', '#!organizations.controller.save');
        $this->ruleset('edit')->send($form->name);

        $role_id_options = lucid::factory()->model('roles')
            ->select('role_id', 'value')
            ->select('name', 'label')
            ->order_by_asc('name')
            ->find_array();
        $role_id_options = array_merge([0, ''], $role_id_options);


        # create the main structure for the form
        $card = html::card();
        $card->header()->add($headerMsg);
        $card->block()->add([
            html::formGroup(lucid::i18n()->translate('model:organizations:role_id'), html::select('role_id', $data->role_id, $role_id_options)),
            html::formGroup(lucid::i18n()->translate('model:organizations:name'), html::input('text', 'name', $data->name)),
            html::formGroup(lucid::i18n()->translate('model:organizations:is_enabled'), html::input('checkbox', 'is_enabled', $data->is_enabled)),
            html::formGroup(lucid::i18n()->translate('model:organizations:created_on'), html::input('date', 'created_on', (new \DateTime($data->created_on))->format('Y-m-d H:i'))),
            html::input('hidden', 'org_id', $data->org_id),
        ]);
        $card->footer()->add(html::formButtons());

        $form->add($card);

        $layout = html::row();
        list($left, $right) = $layout->grid([12,12,6,6,6],[12,12,6,6,6]);
        $left->add($form);
        $right->add(lucid::factory()->view('addresses')->_table($org_id));

        lucid::response()->replace('#main-fullwidth', $layout->render());
    }
}