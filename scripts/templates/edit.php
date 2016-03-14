<?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission('select'); # add required permissions to this array

lucid::controller('navigation')->render('view.{{table}}-table', 'view.{{table}}-edit');

$data = lucid::model('{{table}}', ${{id}});
lucid::$error->notFound($data, '#body');
$headerMsg = _('form:edit_'.(($data->{{id}} == 0)?'new':'existing'), [
    'type'=>'{{table}}',
    'name'=>$data->{{first_string_col}},
]);

$form = html::form('{{table}}-edit', '#!{{table}}.save');
lucid::controller('{{table}}')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
{{form_fields}}    html::input('hidden', '{{id}}', $data->{{id}}),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace('#body', $form);