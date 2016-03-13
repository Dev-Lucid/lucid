<?php

abstract class PHPUnit_Framework_TestCase_MyCase extends PHPUnit_Framework_TestCase
{
    # you must define these in your inheriting class in order for any of the inheritable tests to work
    public static $table        = null;
    public static $controller   = null;

    # define these to test inserting and deleting
    public static $insert_values = [];

    # define these to test loading
    public static $existing_id   = null;
    public static $update_column = null;
    public static $update_value  = null;

    public static function _setUpBeforeClass($class)
    {
        lucid::log('Setting up '.$class);

        if (is_null($class::$table) === true) {
            print "\n".'WARNING: Cannot perform any tests defined in '.$class.' unless '.$class.'::$table and '.$class.'::$controller are defined in '.__FILE__.".\n";
            return;
        }
        # check to make sure the insert test doesn't have a duplicate value already in the db
        #lucid::model($class::$table)->where($class::$value_column, $class::$insert_value)->delete_many();

    }

    public static function _tearDownAfterClass($class)
    {
        lucid::log('Tearing down '.$class);

        if (is_null($class::$table) === false) {
            # make sure we returned the existing row to its original state
            if (is_null($class::$existing_id) === false) {
                $model = lucid::model($class::$table)->find_one($class::$existing_id);
                foreach ($class::$original_values as $key=>$value) {
                    $model->$key = $value;
                }
                $model->save();
            }

            # delete the test row inserted by test_controller_save_new()
            #lucid::model($class::$table)->where($class::$value_column, $class::$insert_value)->delete_many();
        }
    }

    protected function model_load($class)
    {
        if( is_null($class::$existing_id) === true) {
            print "\n".'WARNING: Cannot perform '.$class.'->'.__FUNCTION__.'(). In order to use this test, you must set '.$class.'::$existing_id in '.__FILE__.".\n";
            return;
        }
        if (is_null($class::$table) === true) {
            return;
        }
        $model = lucid::model($class::$table)->find_one($class::$existing_id);
        $this->assertTrue(($model !== false));
        #$this->assertEquals($class::$existing_value, $model->{$class::$value_column});
    }

    protected function controller_save_existing($class)
    {
        if (is_null($class::$table) === true) {
            return;
        }
        if (is_null($class::$existing_id) === true) {
            print "\n".'WARNING: Cannot perform '.$class.'->'.__FUNCTION__.'(). In order to use this test, you must set '.$class.'::$existing_id in '.__FILE__.".\n";
            return;
        }
        if(count($class::$update_values) === 0) {
            print "\n".'WARNING: Cannot perform '.$class.'->'.__FUNCTION__.'(). In order to use this test, you must set '.$class.'::$update_values to an array of names/values to update row '.$class::$existing_id.' in '.__FILE__.".\n";
            return;
        }

        # update the value using the controller->save() method
        $controller = lucid::controller($class::$controller);
        call_user_func_array([$controller, 'save'], array_merge([$class::$existing_id], array_values($class::$update_values), [false]));

        # reload the value and assert that it has been updated
        $model2 = lucid::model($class::$table)->find_one($class::$existing_id);
        foreach ($class::$update_values as $key=>$value) {
            $this->assertEquals($model2->$key, $value);
        }
    }

    # This test inserts a new value, and ensures that it was inserted into the db
    protected function controller_save_new_and_delete($class)
    {
        if (is_null($class::$table) === true) {
            return;
        }
        if (count($class::$insert_values) === 0) {
            print "\n".'WARNING: Cannot perform '.$class.'->'.__FUNCTION__.'(). In order to use this test, you must set '.$class.'::$insert_values to an array of names/values to insert into your table in '.__FILE__.".\n";
            return;
        }

        # first, make sure it's not already in there
        $model = lucid::model($class::$table);
        foreach ($class::$insert_values as $column=>$value) {
            $model->where($column,$value);
        }
        $model = $model->find_one();
        $this->assertTrue(($model === false));

        # perform the insert using the controller->save() method
        $controller = lucid::controller($class::$table);
        call_user_func_array([$controller, 'save'], array_merge([0], array_values($class::$insert_values), [false]));

        # check to make sure it is now in the table
        $model = lucid::model($class::$table);
        foreach ($class::$insert_values as $column=>$value) {
            $model->where($column,$value);
        }
        $model = $model->find_one();
        $this->assertFalse(($model === false));

        # delete the new row, and recheck
        $model->delete();

        # idiorm does not clear cache on deletes :(
        ORM::clear_cache();

        # make sure the inserted value is no longer in the table
        $model = lucid::model($class::$table);
        foreach ($class::$insert_values as $column=>$value) {
            $model->where($column,$value);
        }
        $model = $model->find_one();
        $this->assertTrue(($model === false));
    }
}
