<?php
include_once('Base_Tests.php');

class users_test extends PHPUnit_Framework_TestCase_MyCase
{
    public static $table        = 'users';
    public static $controller   = 'users';

    public static $insert_values = [
        'first_name'=>'test-val',
        'last_name'=>'test-val',
        'email'=>'test-val',
        'password'=>'test-val',
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