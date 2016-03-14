<?php

include(__DIR__.'/../../../../bootstrap.php');

$tables = get_tables();
foreach ($tables as $table) {
    $file_path = DevLucid\lucid::$paths['models'].'/'.$table.'.php';
    if (file_exists($file_path) === false) {
        $id = get_id_col($table);
        echo("Need to create model file for $table/$id\n");
        file_put_contents($file_path, make_model($table,$id));
    } else {
        echo("model file already exists for $table\n");
    }
}

exit("-----------------------\nComplete\n");

function make_model($table, $id_col)
{
    $code = '<'."?php\n\n";
    $code .= "class lucid_model_$table extends \DevLucid\Model\n{\n";
    $code .= "\tpublic static $"."_table = '$table';\n";
    $code .= "\tpublic static $"."_id_column = '$id_col';\n";
    $code .= "}\n";
    return $code;
}

function get_tables()
{
    $db_type = \ORM::get_db()->getAttribute(\PDO::ATTR_DRIVER_NAME);
    switch ($db_type) {
        case 'sqlite':
            $tables = [];
            foreach (\ORM::get_db()->query('SELECT name FROM sqlite_master WHERE type in (\'table\', \'view\');') as $table) {
                $tables[] = $table['name'];
            }
            return $tables;
            break;
        default:
            throw new exception("Haven't setup code to handle ".$db_type." yet :(");
            break;
    }
}

function get_id_col($table)
{
    $db_type = \ORM::get_db()->getAttribute(\PDO::ATTR_DRIVER_NAME);
    switch ($db_type) {
        case 'sqlite':
            $lines    = [];
            $result   = \ORM::get_db()->query('SELECT sql FROM sqlite_master WHERE tbl_name = \''.$table.'\' AND type = \'table\';')->fetchAll();

            if (count($result) === 0) {
                $result   = \ORM::get_db()->query('select * from '.$table)->fetchAll();
                $col_name = null;
                foreach ($result as $row) {
                    foreach ($row as $col=>$value) {
                        if (is_null($col_name) === true) {
                            $col_name = $col;
                        }
                    }
                }
                return $col_name;
            } else {
                $sql = $result[0]['sql'];
                $colsql   = substr($sql, strpos($sql,'(') +1, strpos($sql,')'));
                $colsql   = trim(str_replace("\n",'',$colsql));
                $cols     = explode(',',$colsql);
                $parts    = explode(' ',$cols[0]);
                $col_name = str_replace('`','',$parts[0]);
                return $col_name;
            }

            break;
        default:
            throw new \Exception("Haven't setup code to handle ".$db_type." yet :(");
            break;
    }
}
