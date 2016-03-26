<?php
namespace App\View
use Lucid\Html\html;

class {{uc(table)}} extends \Lucid\Component\Factory\View
{
    public function edit({{id_type}} ${{id}})
    {
        # By default, require that the user be logged in to access the edit form. If you want additional
        # permissions, use the lucid::$security->requirePermission() function.
        lucid::permission()->requireLogin();
        # lucid::$security->requirePermission('{{table}}-select');

        # Set the title tag for the page. Optionally, you can also set the description or keywords meta tag
        # by calling lucid::$response->description() or lucid::$response->keywords()
        lucid::response()->title(lucid::i18n()->translate('branding:app_name').' - {{title}}');

        # Render the navigation controller.
        #lucid::factory()->controller('navigation')->render('view.{{table}}-table', 'view.{{table}}-edit');

        # Load the model. If ${{id}} == 0, then the model's ->create method will be called.
        $data = lucid::factory()->model('{{table}}', ${{id}});

        # the ->notFound method will throw an error if the first parameter === false, which will be the case
        # if the model function is passed an ID that is not zero, but is not able to retrieve a row for that ID
        #lucid::$error->notFound($data, '#body');

        # Based on whether or not the primary key for the model == 0, the header message will either be the dictionary
        # key form:edit_new or form::edit_existing.
        $headerMsg = lucid::i18n()->translate('form:edit_'.(($data->{{id}} == 0)?'new':'existing'), [
            'type'=>'{{table}}',
            'name'=>$data->{{first_string_col}},
        ]);

        # Construct the form and retrieve the ruleset for the controller. You can have multiple functions in your
        # controller if you want to have that controller accept submissions from different forms with different numbers
        # of fields, but the auto-generated ruleset-returning function is simply called ->ruleset(). The ->send()
        # method of the ruleset object packages up the rules into json, and sends them to the client so that they can be
        # used clientside when the form submits.
        $form = html::form('{{table}}-edit', '#!controller.{{table}}.save');
        lucid::factory()->ruleset('{{table}}')->send($form->name);

        {{select_options}}# create the main structure for the form
        $card = html::card();
        $card->header()->add($headerMsg);
        $card->block()->add([
        {{form_fields}}    html::input('hidden', '{{id}}', $data->{{id}}),
        ]);
        $card->footer()->add(html::formButtons());

        $form->add($card);
        lucid::response()->replace('#full-width', $form);
    }
}