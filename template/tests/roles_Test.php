<?php
include_once('Base_Tests.php');

class roles_test extends PHPUnit_Framework_TestCase_MyCase
{
    public static $table        = 'roles';
    public static $controller   = 'roles';

    public static $insert_values = [
        'name'=>'test-val',
    ];

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
}