<?php
$base = __DIR__.'/../../../../';
include($base.'bootstrap.php');

if ($argc < 4) {
    exit("Usage:\n\tgenerate_vc.php [table] [id-col] [....additional columns]\n");
}

array_shift($argv);
$table = array_shift($argv);
$id    = array_shift($argv);
$cols = [];
while (count($argv) > 0) {
    $cols[] = array_shift($argv);
}
if (count($cols) == 0) {
    $cols[] = 'name';
}


$files['controller']  = realpath($base.'app/controllers/').'/'.$table.'.php';
$files['view-edit']   = realpath($base.'app/views/').'/'.$table.'-edit.php';
$files['view-table']  = realpath($base.'app/views/').'/'.$table.'-table.php';
$files['phpunit']     = realpath($base.'tests/').'/'.$table.'_Test.php';
$files['dictionary1'] = realpath($base.'dictionaries').'/en__models.json';
$files['dictionary2'] = realpath($base.'dictionaries').'/en__navigation.json';


$rules           = '';
$save_parameters = '';
$save_actions    = '';
$inputs          = '';
$table_cols      = '';
$search          = '';
$test_inserts    = '';

# used to setup some alignment
$max_length = 0;
foreach ($cols as $col) {
    if(strlen($col) > $max_length) {
        $max_length = strlen($col);
    }
}

foreach ($cols as $col) {
    # these go into the controller
    $rules .= "            ".'[\'type\'=>\'length_range\', \'label\'=>_(\'model:'.$table.':'.$col.'\'), \'field\'=>\''.$col.'\', \'min\'=>\'2\', \'max\'=>\'255\', ],'."\n";

    # for the save method of the controller
    $save_parameters .= '$'.$col.', ';
    $save_actions    .= "        ".'$data->'.str_pad($col, $max_length) . ' = $'.$col.';'."\n";

    # for the edit form
    $inputs .= "\t".'html::form_group(_(\'model:'.$table.':'.$col.'\'), html::input(\'text\', \''.$col.'\', $data->'.$col.')),'."\n";

    # for the table view
    $table_cols .= '$table->add(html::data_column(_(\'model:'.$table.':'.$col.'\'), \''.$col.'\', \''.(ceil(80 / count($cols))).'%\', true, function($data){
    return html::anchor(\'#!view.'.$table.'-edit|'.$id.'|\'.$data->'.$id.', $data->'.$col.');
}));'."\n";

    # for the table view, setting up which columns are used in the free form search
    $search .= "'$col',";

    # for the unit tests
    $test_inserts .= "        '$col'=>'test-val',\n";
}

echo("Building controller...\n");
$controller = '<'.'?php

namespace DevLucid;
class lucid_controller_'.$table.' extends Controller
{
    public function ruleset()
    {
        return new Ruleset([
'.$rules.'      ]);
    }

    public function save($'.$id.', '.$save_parameters.'$do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        $this->ruleset()->checkParameters(func_get_args());
        $data = lucid::model(\''.$table.'\', $'.$id.', false);

'.$save_actions.'        $data->save();

        if ($do_redirect) lucid::redirect(\''.$table.'-table\');
    }

    public function delete($'.$id.', $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission(\'delete\'); # add required permissions to this array

        lucid::model(\''.$table.'\')->where(\''.$id.'\', $'.$id.')->delete_many();
        if ($do_redirect) lucid::redirect(\''.$table.'-table\');
    }
}
';

echo("Building edit view...\n");
$view_edit = '<'.'?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission(\'select\'); # add required permissions to this array

lucid::controller(\'navigation\')->render(\'view.'.$table.'-table\', \'view.'.$table.'-edit\');

$data = lucid::model(\''.$table.'\', $'.$id.');
lucid::$error->notFound($data, \'#body\');
$headerMsg = _(\'form:edit_\'.(($data->'.$id.' == 0)?\'new\':\'existing\'), [
    \'type\'=>\''.$table.'\',
    \'name\'=>$data->'.$cols[0].',
]);

$form = html::form(\''.$table.'-edit\', \'#!'.$table.'.save\');
lucid::controller(\''.$table.'\')->ruleset()->send($form->name);

$card = html::card();
$card->header()->add($headerMsg);
$card->block()->add([
'.$inputs.'    html::input(\'hidden\', \''.$id.'\', $data->'.$id.'),
]);
$card->footer()->add(html::form_buttons());

$form->add($card);
lucid::$response->replace(\'#body\', $form);';

echo("Building table view...\n");
$view_table = '<'.'?php

namespace DevLucid;

lucid::$security->requireLogin();
# lucid::$security->requirePermission([]); # add required permissions to this array

lucid::controller(\'navigation\')->render(\'view.'.$table.'-table\');

$table = html::data_table(_(\'navigation:'.$table.'\'), \''.$table.'-table\', lucid::model(\''.$table.'\'), \'app.php?action=view.'.$table.'-table\');

'.$table_cols.'
$table->add(html::data_column(\'\', null, \'20%\', false, function($data){
    return html::button(_(\'button:delete\'), \'danger\', "if(confirm(\'"._(\'button:confirm_delete\')."\')){ lucid.request(\'#!'.$table.'.delete|'.$id.'|".$data->'.$id.'."\');}")->size(\'sm\')->pull(\'right\');
}));

$table->enable_search_filter(['.$search.']);
$table->enable_add_new_button(\'#!view.'.$table.'-edit|'.$id.'|0\', _(\'button:add_new\'));

$table->send_refresh();

lucid::$response->replace(\'#body\', $table->render());';

echo("Building unit test...\n");
$phpunit = '<'.'?php

namespace DevLucid;

include_once(\'Base_Tests.php\');

class '.$table.'_test extends PHPUnit_Framework_TestCase_MyCase
{
    public static $table        = \''.$table.'\';
    public static $controller   = \''.$table.'\';

    public static $insert_values = [
'.$test_inserts.'    ];

    public static $existing_id    = null;
    public static $update_values  = [
    ];
    public static $original_values  = [
    ];

    public static function setUpBeforeClass()
    {
        parent::_setUpBeforeClass(__CLASS__);
    }

    public static function tearDownAfterClass()
    {
        parent::_tearDownAfterClass(__CLASS__);
    }

    public function test_model_load()
    {
        parent::model_load(__CLASS__);
    }

    public function test_controller_save_existing()
    {
        parent::controller_save_existing(__CLASS__);
    }

    public function test_controller_save_new_and_delete()
    {
        parent::controller_save_new_and_delete(__CLASS__);
    }
}';

file_put_contents($files['controller'], $controller);
file_put_contents($files['view-edit'], $view_edit);
file_put_contents($files['view-table'], $view_table);
file_put_contents($files['phpunit'], $phpunit);

# read in the existing model dictionary entries (assuming they're in dictionaries/en__models.json)
echo("Building dictionary entries...\n");
if (file_exists($files['dictionary1']) === true) {
    $dictionary_entries = json_decode(file_get_contents($files['dictionary1']), true);
} else {
    $dictionary_entries = [];
}

foreach ($cols as $col) {
    if (isset($dictionary_entries['model:'.$table.':'.$col]) === false) {
        $dictionary_entries['model:'.$table.':'.$col] = ucwords(str_replace('_',' ',$col));
    }
}

$dictionary_entries = json_encode($dictionary_entries, JSON_PRETTY_PRINT);
file_put_contents($files['dictionary1'], $dictionary_entries);

if(file_exists($files['dictionary2']) === true) {
    $dictionary_entries = json_decode(file_get_contents($files['dictionary2']), true);
} else {
    $dictionary_entries = [];
}

if (isset($dictionary_entries['navigation:'.$table]) === false) {
    $dictionary_entries['navigation:'.$table] = ucwords(str_replace('_',' ', $table));
}

$dictionary_entries = json_encode($dictionary_entries, JSON_PRETTY_PRINT);
file_put_contents($files['dictionary2'], $dictionary_entries);


echo("----------------------------------\nBuild complete.\n\n");

echo("The following files have been created or updated:\n");
foreach ($files as $file) {
    echo("\t".str_replace(realpath($base), '', $file)."\n");
}

exit("Complete.\n");
