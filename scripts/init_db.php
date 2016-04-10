<?php
use Lucid\Lucid;

define('BIN_PATH', dirname($_SERVER['PWD'].'/'.$_SERVER['SCRIPT_NAME']));
define('ROOT_PATH', BIN_PATH.'/..');
$lucidScriptPath = __DIR__;
$seedpath = ROOT_PATH."/vendor/devlucid/lucid/template/db/build/";

include(ROOT_PATH.'/bootstrap.php');

$arguments = new \cli\Arguments(compact('strict'));

echo("initing db...\n");
$pdo = \ORM::get_db();
$driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
echo("PDO Driver == ".$pdo->getAttribute(PDO::ATTR_DRIVER_NAME)."\n");
switch($driver) {
    case 'sqlite':
        $pdo->exec(file_get_contents($seedpath.'sqlite.regions.sql'));
        $pdo->exec(file_get_contents($seedpath.'sqlite.main.sql'));
        $pdo->exec(file_get_contents($seedpath.'sqlite.views.sql'));
        echo("Supported DB found, beginning init.\n");
        break;
    default:
        exit("Unfortuntely, pdo driver ".$driver." is not yet implemented. You might be able to hack together your own db by using the sql files located in ".ROOT_PATH."/vendor/devlucid/template/db/build/. Many apologies.\n");
        break;
}

exit("Init complete.\n");