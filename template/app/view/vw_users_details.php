<?php
namespace App\View;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Vw_users_details extends \App\View
{
    public function table()
    {
        # By default, require that the user be logged in to access the table. If you want additional
        # permissions, use the lucid::$app->$security->requirePermission() function.
        #lucid::$app->permission()->requireLogin();
        # lucid::$app->$security->requirePermission(); # add required permissions to this array

        # Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
        # by calling lucid::$app->$response->description() or lucid::$app->$response->keywords()
        lucid::$app->response()->title(lucid::$app->i18n()->translate('branding:app_name').' - {{title}}');

        # Render the navigation controller.
        lucid::$app->factory()->view('navigation')->render('vw_users_details.view.table');

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
        $table = html::dataTable(lucid::$app->i18n()->translate('model:vw_users_details'), 'vw_users_details-table', $this->controller()->getList(), 'actions.php?action=vw_users_details.view.table');

        # Add a default renderer for the table. This function is called when rendering every column (unless it is overridden
        # at the column level), and is passed the data for the entire row. This returns the html that should be placed into
        # the cell for that row/column
        $table->renderer = function($data, string $column){
            return html::anchor('#!vw_users_details.view.edit|user_id|'.$data->user_id, $data->$column);
        };

        # Add the table's columns. The parameters for the constructor are:
        # 0) The label for the column
        # 1) The database field name that should be sorted on when the user sorts the data by this column
        # 3) The width of this column, expressed as a % (ex: 25%)
        # 4) boolean true/false: whether or not this column can be used to sort the table
        # 5) An optional renderer function. This function works like the table rendering function
        $table->add(html::dataColumn(lucid::$app->i18n()->translate('model:vw_users_details:email'), 'email', '12%', true));
        $table->add(html::dataColumn(lucid::$app->i18n()->translate('model:vw_users_details:password'), 'password', '12%', true));
        $table->add(html::dataColumn(lucid::$app->i18n()->translate('model:vw_users_details:first_name'), 'first_name', '12%', true));
        $table->add(html::dataColumn(lucid::$app->i18n()->translate('model:vw_users_details:last_name'), 'last_name', '12%', true));
        $table->add(html::dataColumn(lucid::$app->i18n()->translate('model:vw_users_details:org_id'), 'org_id', '12%', true));
        $table->add(html::dataColumn(lucid::$app->i18n()->translate('model:vw_users_details:organization_name'), 'organization_name', '12%', true));
        $table->add(html::dataColumn(lucid::$app->i18n()->translate('model:vw_users_details:role_id'), 'role_id', '12%', true));
        $table->add(html::dataColumn(lucid::$app->i18n()->translate('model:vw_users_details:role_name'), 'role_name', '12%', true));


        # Add a column specifically for deleting rows.
        $table->add(html::dataColumn('', null, '10%', false, function($data){
            return html::button(lucid::$app->i18n()->translate('button:delete'), 'danger', "if(confirm('".lucid::$app->i18n()->translate('button:confirm_delete')."')){ lucid.request('#!vw_users_details.controller.delete|user_id|".$data->user_id."');}")->size('sm')->pull('right');
        }));

        # Enable searching this table based on some of the fields
        $table->enableSearchFilter(['email','password','first_name','last_name','org_id','organization_name','role_id','role_name',]);

        # Enable adding rows to the table. This simply links to the edit form, and passes the value 0 into the
        # varialble $user_id on the form.
        $table->enableAddNewButton('#!vw_users_details.view.edit|user_id|0', lucid::$app->i18n()->translate('button:add_new'));

        # This function call is very important. It looks in $_REQUEST to see if this request is from this same table, asking
        # for new data due to sorting, paging, or filtering. If it determines that this is case, only the table's body is rendered,
        # and that html is sent back to the client where it is inserted in place of the existing table data. Sending back that
        # response ends execution of the view.
        $table->sendRefresh();

        # Render out the table, and place it into the webpage.
        lucid::$app->response()->replace('#main-fullwidth', $table->render());
    }

    public function edit(string $user_id)
    {
        # By default, require that the user be logged in to access the edit form. If you want additional
        # permissions, use the lucid::$app->$security->requirePermission() function.
        #lucid::$app->permission()->requireLogin();
        # lucid::$app->$security->requirePermission('vw_users_details-select');

        # Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
        # by calling lucid::$app->$response->description() or lucid::$app->$response->keywords()
        lucid::$app->response()->title(lucid::$app->i18n()->translate('branding:app_name').' - Vw_users_details');

        # Render the navigation controller.
        lucid::$app->factory()->view('navigation')->render('vw_users_details.view.table', 'vw_users_details.view.edit');

        # Load the model. If $user_id == 0, then the model's ->create method will be called.
        $data = $this->controller()->getOne($user_id);

        # the ->notFound method will throw an error if the first parameter === false, which will be the case
        # if the model function is passed an ID that is not zero, but is not able to retrieve a row for that ID
        #lucid::$app->$error->notFound($data, '#body');

        # Based on whether or not the primary key for the model == 0, the header message will either be the dictionary
        # key form:edit_new or form::edit_existing.
        $headerMsg = lucid::$app->i18n()->translate('form:edit_'.(($data->user_id == 0)?'new':'existing'), [
            'type'=>'vw_users_details',
            'name'=>$data->user_id,
        ]);

        # Construct the form and retrieve the ruleset for the controller. You can have multiple functions in your
        # controller if you want to have that controller accept submissions from different forms with different numbers
        # of fields, but the auto-generated ruleset-returning function is simply called ->ruleset(). The ->send()
        # method of the ruleset object packages up the rules into json, and sends them to the client so that they can be
        # used clientside when the form submits.
        $form = html::form('vw_users_details-edit', '#!vw_users_details.controller.save');
        $this->ruleset('edit')->send($form->name);


        # create the main structure for the form
        $card = html::card();
        $card->header()->add($headerMsg);
        $card->block()->add([
            html::formGroup(lucid::$app->i18n()->translate('model:vw_users_details:email'), html::input('text', 'email', $data->email)),
            html::formGroup(lucid::$app->i18n()->translate('model:vw_users_details:password'), html::input('text', 'password', $data->password)),
            html::formGroup(lucid::$app->i18n()->translate('model:vw_users_details:first_name'), html::input('text', 'first_name', $data->first_name)),
            html::formGroup(lucid::$app->i18n()->translate('model:vw_users_details:last_name'), html::input('text', 'last_name', $data->last_name)),
            html::formGroup(lucid::$app->i18n()->translate('model:vw_users_details:org_id'), html::input('text', 'org_id', $data->org_id)),
            html::formGroup(lucid::$app->i18n()->translate('model:vw_users_details:organization_name'), html::input('text', 'organization_name', $data->organization_name)),
            html::formGroup(lucid::$app->i18n()->translate('model:vw_users_details:role_id'), html::input('text', 'role_id', $data->role_id)),
            html::formGroup(lucid::$app->i18n()->translate('model:vw_users_details:role_name'), html::input('text', 'role_name', $data->role_name)),
            html::input('hidden', 'user_id', $data->user_id),
        ]);
        $card->footer()->add(html::formButtons());

        $form->add($card);
        lucid::$app->response()->replace('#main-fullwidth', $form);
    }
}