<?php

function controllerBuildKeys($table, $columns, $keys, $arguments)
{
    echo("Building controller keys\n");
    $keys['save_parameters'] = '';
    $keys['save_actions'] = '';
    $keys['phpdoc_save_parameters'] = '';


    foreach($columns as $column) {
        $type = ($column['type'] == 'timestamp')?'DateTime':$column['type'];
        $keys['save_parameters'] .= $type.' $'.$column['name'].', ';

        $keys['phpdoc_save_parameters'] .= "      * @param ".$type.' $'.$column['name']."\n";

        if($column['name'] != $columns[0]['name']){
            $keys['save_actions'] .= "\t\t$"."data->".$column['name']." = $".$column['name'].";\n";
        }
    }

    return $keys;
}

function controllerBuildFiles($table, $columns, $keys, $arguments)
{
    buildFromTemplate('controller', $keys, $arguments['appdir'].'/controller/'.$table.'.php');
}
