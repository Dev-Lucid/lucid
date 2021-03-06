<?php
namespace Lucid\Task;

class Generate extends Task implements TaskInterface
{
    public static $trigger = 'generate';

    public function __construct()
    {
        $this->parameters[] = new \Lucid\Task\Parameter('name', 'unlabeled', false, null);
        $this->parameters[] = new \Lucid\Task\Parameter('table', 'unlabeled', false, null);
        $this->parameters[] = new \Lucid\Task\Parameter('no-model', 'flag', true, false);
        $this->parameters[] = new \Lucid\Task\Parameter('no-view', 'flag', true, false);
        $this->parameters[] = new \Lucid\Task\Parameter('no-controller', 'flag', true, false);
        $this->parameters[] = new \Lucid\Task\Parameter('no-helper', 'flag', true, false);
        $this->parameters[] = new \Lucid\Task\Parameter('no-ruleset', 'flag', true, false);
        $this->parameters[] = new \Lucid\Task\Parameter('no-test', 'flag', true, false);
        $this->parameters[] = new \Lucid\Task\Parameter('no-dictionary', 'flag', true, false);
    }

    public function run()
    {
        include(getcwd().'/bootstrap.php');


        if (preg_match('#^\p{Lu}#u', $this->config['name']) === 0){
            echo("Error: parameter name must be camel-case. At a minimum, it must start with a capital letter.\n");
            \Lucid\Task\Container::run('usage', [static::$trigger]);
            exit();
        }
        $this->config['meta'] = new \Lucid\Library\Metabase\Metabase(\ORM::get_db());

        if (is_null($this->config['table']) === true) {
            $this->config['table'] = $this->config['name'];
        }
        $this->config['columns'] = $this->config['meta']->getColumns($this->config['table']);

        $this->config['keys'] = [
            'name'=>$this->config['name'],
            'table'=>$this->config['table'],
            'id_type'=>$this->config['columns'][0]['type'],
    	    'id'=>$this->config['columns'][0]['name'],
    		'first_string_col'=>null,
            'title'=>$this->config['name'],
        ];

        foreach($this->config['columns'] as $column) {
    		if ($column['type'] == 'string' && is_null($this->config['keys']['first_string_col']) === true) {
    			$this->config['keys']['first_string_col'] = $column['name'];
    		}
    	}

        # we always run all *BuildKeys methods in case a later *BuildFile function relies on a key built by
        # a component not selected for building
        $this->modelBuildKeys();
        $this->viewBuildKeys();
        $this->controllerBuildKeys();
        $this->helperBuildKeys();
        $this->rulesetBuildKeys();
        $this->testBuildKeys();
        $this->dictionaryBuildKeys();


        if ($this->config['no-model'] === false) {
            echo("Building Model...\n");
            $this->modelBuildFiles();
        }
        if ($this->config['no-view'] === false) {
            echo("Building View...\n");
            $this->viewBuildFiles();
        }
        if ($this->config['no-controller'] === false) {
            echo("Building Controller...\n");
            $this->controllerBuildFiles();
        }
        if ($this->config['no-helper'] === false) {
            echo("Building Helper...\n");
            $this->helperBuildFiles();
        }
        if ($this->config['no-ruleset'] === false) {
            echo("Building Ruleset...\n");
            $this->rulesetBuildFiles();
        }
        if ($this->config['no-test'] === false) {
            echo("Building Test...\n");
            $this->testBuildFiles();
        }
        if ($this->config['no-dictionary'] === false) {
            echo("Building Dictionary...\n");
            $this->dictionaryBuildFiles();
        }
        echo("Complete.\n");
    }

    protected function buildFromTemplate($templateName, $outputName) {

    	$source = file_get_contents(getcwd().'/vendor/dev-lucid/lucid/tasks/GenerateTemplates/'.$templateName.'.php');
    	foreach ($this->config['keys'] as $key=>$value) {
    		$source = str_replace('{{'.$key.'}}', $value, $source);
    	}
    	file_put_contents($outputName, $source);
    }

    protected function findTableForKey($table, $key)
    {
    	$tables = $this->config['meta']->getTables(false);

        for ($i=0; $i<count($tables); $i++) {
            $tableCols = $this->config['meta']->getColumns($tables[$i]);
            if ($tableCols[0]['name'] == $key) {
                $return = [
                    $tables[$i],
                    $tableCols[0]['name'],
                ];

                for ($j = 1; $j<count($tableCols); $j++) {
                    if ($tableCols[$j]['type'] == 'string'){
                        $return[] = $tableCols[$j]['name'];
                        return $return;
                    }
                }
                echo('Could not find a label column in table '.$tables[$i].'. Build script looks for the first column that is of a string type (varchar, char, text, etc).');
                return [false, false, false];
            }
        }

        echo('Could not find a table to use as a source for '.$key.' select.');
        return [false, false, false];
    }

    public function modelBuildKeys()
    {
    }

    public function modelBuildFiles()
    {
        $this->buildFromTemplate('model', getcwd().'/app/model/'.$this->config['name'].'.php');
    }

    public function viewBuildKeys()
    {
        # build form form_fields
        $this->config['keys']['select_options'] = '';
        $this->config['keys']['form_fields'] = '';
        $this->config['keys']['table_cols'] = '';
        $this->config['keys']['search_cols'] = '';

        # build the columns for the form
        foreach($this->config['columns'] as $column) {
            if ($column['index'] > 0) {
                switch ($column['type']) {
                    case 'string':
                    case 'int':
                    case 'float':
                        if (strpos(strrev($column['name']), 'di_') === 0) {
                            #echo ("trying to find options for ".$column['name']."\n");
                            # this is likely a foreign key for another table. make it a select list instead of a text field
                            $source = '[]';
                            list($keyTable, $idColumn, $labelColumn) = $this->findTableForKey($this->config['table'], $column['name']);

                            $modelName = null;
                            # so here's the annoying thing: all mvchr class names are camel-case, but when we look up
                            # tables using Metabase lib for keys, we get the actual db table name, which by convention
                            # is lowercase. So, we need to try to find a camel-cased-named model file. Arggh!
                            $existingModels = glob(getcwd().'/app/model/*.php');
                            foreach ($existingModels as $existingModel) {
                                $finalName = basename($existingModel);
                                if (strtolower($finalName) == $keyTable.'.php') {
                                    $modelName = substr($finalName, 0, strlen($keyTable));
                                }
                            }
                            if (is_null($modelName) === true) {
                                echo("Note: Tried to generate a select option list for field ".$column['name'].", but could not find a model for database table $keyTable. You may have to generate that model and rerun this task.\n\n");
                                $keyTable = false;
                            }

                            if ($keyTable !== false) {
                                $source = '$'.$column['name'].'_options';
                                $this->config['keys']['select_options'] .= '        $'.$column['name'].'_options = lucid::$app->factory()->model(\''.$modelName.'\')';
                                $this->config['keys']['select_options'] .= "\n            ->select('$idColumn', 'value')";
                                $this->config['keys']['select_options'] .= "\n            ->select('$labelColumn', 'label')";
                                $this->config['keys']['select_options'] .= "\n            ->order_by_asc('$labelColumn')";
                                $this->config['keys']['select_options'] .= "\n            ->find_array();";
                                $this->config['keys']['select_options'] .= "\n        $".$column['name'].'_options = array_merge([0, \'\'], $'.$column['name']."_options);\n\n";
                            }

                            $this->config['keys']['form_fields'] .= '            html::formGroup(lucid::$app->i18n()->translate(\'model:'.$this->config['table'].':'.$column['name'].'\'), html::select(\''.$column['name'].'\', $data->'.$column['name'].', '.$source.')),'."\n";
                        } else {
                            if ($column['type'] == 'string' && is_null($this->config['keys']['first_string_col']) === true) {
                                $this->config['keys']['first_string_col'] = $column['name'];
                            }
                            $this->config['keys']['form_fields'] .= '            html::formGroup(lucid::$app->i18n()->translate(\'model:'.$this->config['table'].':'.$column['name'].'\'), html::input(\'text\', \''.$column['name'].'\', $data->'.$column['name'].')),'."\n";
                        }

                        break;
                    case 'bool':
                        $this->config['keys']['form_fields'] .= '            html::formGroup(lucid::$app->i18n()->translate(\'model:'.$this->config['table'].':'.$column['name'].'\'), html::input(\'checkbox\', \''.$column['name'].'\', $data->'.$column['name'].')),'."\n";
                        break;
                    case 'timestamp':
                        $this->config['keys']['form_fields'] .= '            html::formGroup(lucid::$app->i18n()->translate(\'model:'.$this->config['table'].':'.$column['name'].'\'), html::input(\'date\', \''.$column['name'].'\', (new \DateTime($data->'.$column['name'].'))->format(\'Y-m-d H:i\'))),'."\n";
                        break;
                    default:
                        echo("no logic for rendering type ". $column['type']."\n");
                        break;
                }
            }
        }

        # build the list of table columns
        foreach($this->config['columns'] as $column) {
            if ($column['index'] > 0) {
                $this->config['keys']['table_cols'] .= '        $table->add(html::dataColumn(lucid::$app->i18n()->translate(\'model:'.$this->config['table'].':'.$column['name'].'\'), \''.$column['name'].'\', \''. ceil(90 / (count($this->config['columns']) - 1)) .'%\', true));'."\n";
            }
        }

        # find all columns that should be part of the search
        foreach($this->config['columns'] as $column) {
            if ($column['index'] > 0 && $column['type'] == 'string') {
                $this->config['keys']['search_cols'] .= "'".$column['name']."',";
            }
        }
    }

    public function viewBuildFiles()
    {
        $this->buildFromTemplate('view', getcwd().'/app/view/'.$this->config['name'].'.php');
    }

    public function controllerBuildKeys()
    {
        $this->config['keys']['save_parameters'] = '';
        $this->config['keys']['save_actions'] = '';
        $this->config['keys']['phpdoc_save_parameters'] = '';
        $this->config['keys']['primary_key_col_type'] = $this->config['columns'][0]['type'];

        foreach($this->config['columns'] as $column) {
            $type = ($column['type'] == 'timestamp')?'\DateTime':$column['type'];
            $this->config['keys']['save_parameters'] .= $type.' $'.$column['name'].', ';

            $this->config['keys']['phpdoc_save_parameters'] .= "      * @param ".$type.' $'.$column['name']."\n";

            if($column['name'] != $this->config['columns'][0]['name']){
                $this->config['keys']['save_actions'] .= "\t\t$"."data->".$column['name']." = $".$column['name'];
                if($column['type'] == 'timestamp') {
                    $this->config['keys']['save_actions'] .= '->format(\DateTime::ISO8601)';
                }
                $this->config['keys']['save_actions'] .= ";\n";
            }
        }
    }

    public function controllerBuildFiles()
    {
        $this->buildFromTemplate('controller', getcwd().'/app/controller/'.$this->config['name'].'.php');
    }

    public function helperBuildKeys()
    {
    }

    public function helperBuildFiles()
    {
        $this->buildFromTemplate('helper',  getcwd().'/app/helper/'.$this->config['name'].'.php');
    }

    public function rulesetBuildKeys()
    {
        $this->config['keys']['rules'] = '';
        for ($i=1; $i<count($this->config['columns']); $i++) {
            $this->config['keys']['rules'] .= "\n\t\t".'$this->addRule(';
            if (strpos(strrev($this->config['columns'][$i]['name']), 'di_') === 0) {
                $this->config['keys']['rules'] .= '[\'type\'=>\'anyValue\', \'label\'=>lucid::$app->i18n()->translate(\'model:'.$this->config['table'].':'.$this->config['columns'][$i]['name'].'\'), \'field\'=>\''.$this->config['columns'][$i]['name'].'\', ]';
            } elseif ($this->config['columns'][$i]['type'] == 'string') {
                $this->config['keys']['rules'] .= '[\'type\'=>\'lengthRange\', \'label\'=>lucid::$app->i18n()->translate(\'model:'.$this->config['table'].':'.$this->config['columns'][$i]['name'].'\'), \'field\'=>\''.$this->config['columns'][$i]['name'].'\', \'min\'=>\'2\', \'max\'=>\'255\', ]';
            } elseif ($this->config['columns'][$i]['type'] == 'bool') {
                $this->config['keys']['rules'] .= '[\'type\'=>\'checked\', \'label\'=>lucid::$app->i18n()->translate(\'model:'.$this->config['table'].':'.$this->config['columns'][$i]['name'].'\'), \'field\'=>\''.$this->config['columns'][$i]['name'].'\', ]';
            } elseif ($this->config['columns'][$i]['type'] == 'int') {
                $this->config['keys']['rules'] .= '[\'type\'=>\'integerValue\', \'label\'=>lucid::$app->i18n()->translate(\'model:'.$this->config['table'].':'.$this->config['columns'][$i]['name'].'\'), \'field\'=>\''.$this->config['columns'][$i]['name'].'\', ]';
            } elseif ($this->config['columns'][$i]['type'] == 'float') {
                $this->config['keys']['rules'] .= '[\'type\'=>\'floatValue\', \'label\'=>lucid::$app->i18n()->translate(\'model:'.$this->config['table'].':'.$this->config['columns'][$i]['name'].'\'), \'field\'=>\''.$this->config['columns'][$i]['name'].'\', ]';
            } elseif ($this->config['columns'][$i]['type'] == 'timestamp') {
                $this->config['keys']['rules'] .= '[\'type\'=>\'validDate\', \'label\'=>lucid::$app->i18n()->translate(\'model:'.$this->config['table'].':'.$this->config['columns'][$i]['name'].'\'), \'field\'=>\''.$this->config['columns'][$i]['name'].'\', ]';
            } else {
                $this->config['keys']['rules'] .= '[\'type\'=>\'anyValue\', \'label\'=>lucid::$app->i18n()->translate(\'model:'.$this->config['table'].':'.$this->config['columns'][$i]['name'].'\'), \'field\'=>\''.$this->config['columns'][$i]['name'].'\', ]';
            }
            $this->config['keys']['rules'] .= ');';
        }
    }

    public function rulesetBuildFiles()
    {
        $this->buildFromTemplate('ruleset', getcwd().'/app/ruleset/'.$this->config['name'].'.php');
    }

    public function dictionaryBuildKeys()
    {
    }

    public function dictionaryBuildFiles()
    {
        $modelDictPath = getcwd().'/app/dictionary/en__models.json';
        if (file_exists($modelDictPath)){
            $dictionaryKeys = json_decode(file_get_contents($modelDictPath), true);
        } else {
            $dictionaryKeys = [];
        }

        if (isset($dictionaryKeys['model:'.$this->config['table']]) === false) {
            $dictionaryKeys['model:'.$this->config['table']] = ucwords($this->config['table']);
        }

        foreach ($this->config['columns'] as $column) {
            if (isset($dictionaryKeys['model:'.$this->config['table'].':'.$column['name']]) === false) {
                $dictionaryKeys['model:'.$this->config['table'].':'.$column['name']] = ucwords(str_replace('_', ' ', $column['name']));
            }
        }

        ksort($dictionaryKeys);

        file_put_contents($modelDictPath, json_encode($dictionaryKeys, JSON_PRETTY_PRINT));

        $navigationDictPath = getcwd().'/app/dictionary/en__navigation.json';
        if (file_exists($modelDictPath)){
            $dictionaryKeys = json_decode(file_get_contents($navigationDictPath), true);
        } else {
            $dictionaryKeys = [];
        }

        if (isset($dictionaryKeys['navigation:'.$this->config['table'].'.view.table']) === false) {
            $dictionaryKeys['navigation:'.$this->config['table'].'.view.table'] = ucwords(str_replace('_', ' ', $this->config['table']));
        }

        ksort($dictionaryKeys);

        file_put_contents($navigationDictPath, json_encode($dictionaryKeys, JSON_PRETTY_PRINT));
    }

    public function testBuildKeys()
    {
    }

    public function testBuildFiles()
    {
        $this->buildFromTemplate('test', getcwd().'/tests/'.$this->config['name'].'_Test.php');
    }
}
Container::addTask(new Generate());