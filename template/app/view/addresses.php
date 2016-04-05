<?php
namespace App\View;
use App\App, Lucid\Lucid, Lucid\Html\html;

class Addresses extends \App\View
{

    public function table($org_id = null)
    {
        # Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
        # by calling lucid::$response->description() or lucid::$response->keywords()
        lucid::response()->title(lucid::i18n()->translate('branding:app_name').' - {{title}}');

        # Render the navigation controller.
        lucid::factory()->view('navigation')->render('addresses.view.table');

        # Render out the table, and place it into the webpage.
        lucid::response()->replace('#main-fullwidth', $this->_table($org_id)->render());
    }

    public function _table($org_id = null)
    {
        # By default, require that the user be logged in to access the table. If you want additional
        # permissions, use the lucid::$security->requirePermission() function.
        #lucid::permission()->requireLogin();
        # lucid::$security->requirePermission(); # add required permissions to this array


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
        $source = $this->controller()->getList()->where('org_id', $org_id);
        $table = html::dataTable(lucid::i18n()->translate('model:addresses'), 'addresses-table', $source, 'actions.php?action=addresses.view.table&org_id='.$org_id);

        # Add a default renderer for the table. This function is called when rendering every column (unless it is overridden
        # at the column level), and is passed the data for the entire row. This returns the html that should be placed into
        # the cell for that row/column
        $table->renderer = function($data, string $column){
            return html::anchor('#!addresses.view.edit|address_id|'.$data->address_id, $data->$column);
        };

        # Add the table's columns. The parameters for the constructor are:
        # 0) The label for the column
        # 1) The database field name that should be sorted on when the user sorts the data by this column
        # 3) The width of this column, expressed as a % (ex: 25%)
        # 4) boolean true/false: whether or not this column can be used to sort the table
        # 5) An optional renderer function. This function works like the table rendering function
        $table->add(html::dataColumn(lucid::i18n()->translate('model:addresses:org_id'), 'org_id', '9%', true));
        $table->add(html::dataColumn(lucid::i18n()->translate('model:addresses:name'), 'name', '9%', true));
        $table->add(html::dataColumn(lucid::i18n()->translate('model:addresses:street_1'), 'street_1', '9%', true));
        $table->add(html::dataColumn(lucid::i18n()->translate('model:addresses:street_2'), 'street_2', '9%', true));
        $table->add(html::dataColumn(lucid::i18n()->translate('model:addresses:city'), 'city', '9%', true));
        $table->add(html::dataColumn(lucid::i18n()->translate('model:addresses:region_id'), 'region_id', '9%', true));
        $table->add(html::dataColumn(lucid::i18n()->translate('model:addresses:postal_code'), 'postal_code', '9%', true));
        $table->add(html::dataColumn(lucid::i18n()->translate('model:addresses:country_id'), 'country_id', '9%', true));
        $table->add(html::dataColumn(lucid::i18n()->translate('model:addresses:phone_number_1'), 'phone_number_1', '9%', true));
        $table->add(html::dataColumn(lucid::i18n()->translate('model:addresses:phone_number_2'), 'phone_number_2', '9%', true));


        # Add a column specifically for deleting rows.
        $table->add(html::dataColumn('', null, '10%', false, function($data){
            return html::button(lucid::i18n()->translate('button:delete'), 'danger', "if(confirm('".lucid::i18n()->translate('button:confirm_delete')."')){ lucid.request('#!addresses.controller.delete|address_id|".$data->address_id."');}")->size('sm')->pull('right');
        }));

        # Enable searching this table based on some of the fields
        $table->enableSearchFilter(['name','street_1','street_2','city','region_id','postal_code','country_id','phone_number_1','phone_number_2',]);

        # Enable adding rows to the table. This simply links to the edit form, and passes the value 0 into the
        # varialble $address_id on the form.
        $table->enableAddNewButton('#!addresses.view.edit|address_id|0', lucid::i18n()->translate('button:add_new'));

        # This function call is very important. It looks in $_REQUEST to see if this request is from this same table, asking
        # for new data due to sorting, paging, or filtering. If it determines that this is case, only the table's body is rendered,
        # and that html is sent back to the client where it is inserted in place of the existing table data. Sending back that
        # response ends execution of the view.
        $table->sendRefresh();

        return $table;
    }

    public function edit(int $address_id)
    {
        # By default, require that the user be logged in to access the edit form. If you want additional
        # permissions, use the lucid::$security->requirePermission() function.
        #lucid::permission()->requireLogin();
        # lucid::$security->requirePermission('addresses-select');

        # Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
        # by calling lucid::$response->description() or lucid::$response->keywords()
        lucid::response()->title(lucid::i18n()->translate('branding:app_name').' - Addresses');

        # Render the navigation controller.
        lucid::factory()->view('navigation')->render('addresses.view.table', 'addresses.view.edit');

        # Load the model. If $address_id == 0, then the model's ->create method will be called.
        $data = $this->controller()->getOne($address_id);

        # the ->notFound method will throw an error if the first parameter === false, which will be the case
        # if the model function is passed an ID that is not zero, but is not able to retrieve a row for that ID
        #lucid::$error->notFound($data, '#body');

        # Based on whether or not the primary key for the model == 0, the header message will either be the dictionary
        # key form:edit_new or form::edit_existing.
        $headerMsg = lucid::i18n()->translate('form:edit_'.(($data->address_id == 0)?'new':'existing'), [
            'type'=>'addresses',
            'name'=>$data->name,
        ]);

        # Construct the form and retrieve the ruleset for the controller. You can have multiple functions in your
        # controller if you want to have that controller accept submissions from different forms with different numbers
        # of fields, but the auto-generated ruleset-returning function is simply called ->ruleset(). The ->send()
        # method of the ruleset object packages up the rules into json, and sends them to the client so that they can be
        # used clientside when the form submits.
        $form = html::form('addresses-edit', '#!addresses.controller.save');
        $this->ruleset('edit')->send($form->name);

        $org_id_options = lucid::factory()->model('organizations')
            ->select('org_id', 'value')
            ->select('name', 'label')
            ->order_by_asc('name')
            ->find_array();
        $org_id_options = array_merge([0, ''], $org_id_options);

$region_id_options = lucid::factory()->model('regions')
            ->select('region_id', 'value')
            ->select('country_id', 'label')
            ->order_by_asc('country_id')
            ->find_array();
        $region_id_options = array_merge([0, ''], $region_id_options);

$country_id_options = lucid::factory()->model('countries')
            ->select('country_id', 'value')
            ->select('alpha_3', 'label')
            ->order_by_asc('alpha_3')
            ->find_array();
        $country_id_options = array_merge([0, ''], $country_id_options);


        # create the main structure for the form
        $card = html::card();
        $card->header()->add($headerMsg);
        $card->block()->add([
            html::formGroup(lucid::i18n()->translate('model:addresses:org_id'), html::select('org_id', $data->org_id, $org_id_options)),
            html::formGroup(lucid::i18n()->translate('model:addresses:name'), html::input('text', 'name', $data->name)),
            html::formGroup(lucid::i18n()->translate('model:addresses:street_1'), html::input('text', 'street_1', $data->street_1)),
            html::formGroup(lucid::i18n()->translate('model:addresses:street_2'), html::input('text', 'street_2', $data->street_2)),
            html::formGroup(lucid::i18n()->translate('model:addresses:city'), html::input('text', 'city', $data->city)),
            html::formGroup(lucid::i18n()->translate('model:addresses:region_id'), html::select('region_id', $data->region_id, $region_id_options)),
            html::formGroup(lucid::i18n()->translate('model:addresses:postal_code'), html::input('text', 'postal_code', $data->postal_code)),
            html::formGroup(lucid::i18n()->translate('model:addresses:country_id'), html::select('country_id', $data->country_id, $country_id_options)),
            html::formGroup(lucid::i18n()->translate('model:addresses:phone_number_1'), html::input('text', 'phone_number_1', $data->phone_number_1)),
            html::formGroup(lucid::i18n()->translate('model:addresses:phone_number_2'), html::input('text', 'phone_number_2', $data->phone_number_2)),
            html::input('hidden', 'address_id', $data->address_id),
        ]);
        $card->footer()->add(html::formButtons());

        $form->add($card);
        lucid::response()->replace('#main-fullwidth', $form);
    }
}