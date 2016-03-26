<?php

function viewBuildKeys($table, $columns, $keys, $arguments)
{
    # build form form_fields
    $keys['select_options'] = '';
    $keys['form_fields'] = '';
    $keys['table_cols'] = '';
    $keys['search_cols'] = '';

    # build the columns for the form
    foreach($columns as $column) {
        if ($column['index'] > 0) {
            switch ($column['type']) {
                case 'string':
                case 'int':
                case 'float':

                    if ($column['type'] == 'int' && strpos($column['name'], '_id') !== false) {
                        echo ("trying to find options for ".$column['name']."\n");
                        # this is likely a foreign key for another table. make it a select list instead of a text field
                        $source = '[]';
                        list($keyTable, $idColumn, $labelColumn) = findTableForKey($table, $column['name']);
                        if ($keyTable !== false) {
                            $source = '$'.$column['name'].'_options';
                            $keys['select_options'] .= '$'.$column['name'].'_options = lucid::factory()->model(\''.$keyTable.'\')';
                            $keys['select_options'] .= "\n            ->select('$idColumn', 'value')";
                            $keys['select_options'] .= "\n            ->select('$labelColumn', 'label')";
                            $keys['select_options'] .= "\n            ->order_by_asc('$labelColumn')";
                            $keys['select_options'] .= "\n            ->find_array();";
                            $keys['select_options'] .= "\n        $".$column['name'].'_options = array_merge([0, \'\'], $'.$column['name']."_options);\n\n";
                        }

                        $keys['form_fields'] .= '            html::formGroup(lucid::i18n()->translate(\'model:'.$table.':'.$column['name'].'\'), html::select(\''.$column['name'].'\', $data->'.$column['name'].', '.$source.')),'."\n";
                    } else {
                        if ($column['type'] == 'string' && is_null($keys['first_string_col']) === true) {
                            $keys['first_string_col'] = $column['name'];
                        }
                        $keys['form_fields'] .= '            html::formGroup(lucid::i18n()->translate(\'model:'.$table.':'.$column['name'].'\'), html::input(\'text\', \''.$column['name'].'\', $data->'.$column['name'].')),'."\n";
                    }

                    break;
                case 'bool':
                    $keys['form_fields'] .= '            html::formGroup(lucid::i18n()->translate(\'model:'.$table.':'.$column['name'].'\'), html::input(\'checkbox\', \''.$column['name'].'\', $data->'.$column['name'].')),'."\n";
                    break;
                case 'timestamp':
                    $keys['form_fields'] .= '            html::formGroup(lucid::i18n()->translate(\'model:'.$table.':'.$column['name'].'\'), html::input(\'date\', \''.$column['name'].'\', (new \DateTime($data->'.$column['name'].'))->format(\'Y-m-d H:i\'))),'."\n";
                    break;
                default:
                    echo("no logic for rendering type ". $column['type']."\n");
                    break;
            }
        }
    }

    # build the list of table columns
    foreach($columns as $column) {
        if ($column['index'] > 0) {
            $keys['table_cols'] .= '$table->add(html::dataColumn(lucid::i18n()->translate(\'model:'.$table.':'.$column['name'].'\'), \''.$column['name'].'\', \''. ceil(90 / (count($columns) - 1)) .'%\', true));'."\n";
        }
    }

    # find all columns that should be part of the search
    foreach($columns as $column) {
        if ($column['index'] > 0 && $column['type'] == 'string') {
            $keys['search_cols'] .= "'".$column['name']."',";
        }
    }
    return $keys;
}

function viewBuildFiles($table, $columns, $keys, $arguments)
{
    buildFromTemplate('view', $keys, $arguments['appdir'].'/view/'.$table.'.php');
}
